import { mkdir, writeFile } from "node:fs/promises";
import path from "node:path";
import { englishEntries } from "../content/en.mjs";
import { chineseEntries } from "../content/zh-hans.mjs";

const root = path.resolve(import.meta.dirname, "..");
const releaseDirectory = path.join(root, "release");
const outputPath = path.join(
  releaseDirectory,
  "bluemorrow-studio-content-1.0.0.xml"
);

const xml = (value) =>
  String(value)
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&apos;");

const cdata = (value) => String(value).replaceAll("]]>", "]]]]><![CDATA[>");

const now = "2026-09-10 00:00:00";
const entries = [...englishEntries, ...chineseEntries];
const entryIds = new Map();
let nextId = 1000;

for (const entry of entries) {
  entryIds.set(`${entry.locale}:${entry.key}`, nextId);
  entry._exportId = nextId;
  nextId += 1;
}

const items = entries
  .map((entry) => {
    const parent = entry.parent
      ? entryIds.get(`${entry.locale}:${entry.parent}`) || 0
      : 0;
    const metadata = {
      _bluemorrow_locale: entry.locale,
      _bluemorrow_translation_key: entry.key,
      _bluemorrow_seo_title: entry.seoTitle,
      _bluemorrow_seo_description: entry.description,
      _bluemorrow_target_intent: entry.intent,
      _bluemorrow_app_version: entry.appVersion || "1.0",
      _bluemorrow_scope: entry.scope || "app",
      _bluemorrow_app_key:
        entry.scope === "studio" ? "" : entry.appKey || "batchora"
    };
    if (entry.template) {
      metadata._wp_page_template = entry.template;
    }

    const metaXml = Object.entries(metadata)
      .map(
        ([key, value]) => `<wp:postmeta>
  <wp:meta_key><![CDATA[${cdata(key)}]]></wp:meta_key>
  <wp:meta_value><![CDATA[${cdata(value)}]]></wp:meta_value>
</wp:postmeta>`
      )
      .join("\n");

    return `<item>
<title>${xml(entry.title)}</title>
<link>https://example.com/${xml(entry.slug)}/</link>
<pubDate>Thu, 10 Sep 2026 00:00:00 +0000</pubDate>
<dc:creator><![CDATA[batchora]]></dc:creator>
<guid isPermaLink="false">https://example.com/?p=${entry._exportId}</guid>
<description></description>
<content:encoded><![CDATA[${cdata(entry.content)}]]></content:encoded>
<excerpt:encoded><![CDATA[${cdata(entry.description)}]]></excerpt:encoded>
<wp:post_id>${entry._exportId}</wp:post_id>
<wp:post_date><![CDATA[${now}]]></wp:post_date>
<wp:post_date_gmt><![CDATA[${now}]]></wp:post_date_gmt>
<wp:post_modified><![CDATA[${now}]]></wp:post_modified>
<wp:post_modified_gmt><![CDATA[${now}]]></wp:post_modified_gmt>
<wp:comment_status><![CDATA[closed]]></wp:comment_status>
<wp:ping_status><![CDATA[closed]]></wp:ping_status>
<wp:post_name><![CDATA[${cdata(entry.slug)}]]></wp:post_name>
<wp:status><![CDATA[${cdata(entry.status)}]]></wp:status>
<wp:post_parent>${parent}</wp:post_parent>
<wp:menu_order>0</wp:menu_order>
<wp:post_type><![CDATA[${cdata(entry.type)}]]></wp:post_type>
<wp:post_password><![CDATA[]]></wp:post_password>
<wp:is_sticky>0</wp:is_sticky>
${metaXml}
</item>`;
  })
  .join("\n");

const document = `<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0"
  xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:wfw="http://wellformedweb.org/CommentAPI/"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:wp="http://wordpress.org/export/1.2/">
<channel>
<title>BlueMorrow Studio</title>
<link>https://example.com</link>
<description>BlueMorrow Studio WordPress content package</description>
<pubDate>Thu, 10 Sep 2026 00:00:00 +0000</pubDate>
<language>en-US</language>
<wp:wxr_version>1.2</wp:wxr_version>
<wp:base_site_url>https://example.com</wp:base_site_url>
<wp:base_blog_url>https://example.com</wp:base_blog_url>
<wp:author>
  <wp:author_id>1</wp:author_id>
  <wp:author_login><![CDATA[batchora]]></wp:author_login>
  <wp:author_email><![CDATA[]]></wp:author_email>
  <wp:author_display_name><![CDATA[Batchora Team]]></wp:author_display_name>
  <wp:author_first_name><![CDATA[Batchora]]></wp:author_first_name>
  <wp:author_last_name><![CDATA[Team]]></wp:author_last_name>
</wp:author>
${items}
</channel>
</rss>
`;

await mkdir(releaseDirectory, { recursive: true });
await writeFile(outputPath, document, "utf8");
console.log(`Created ${outputPath}`);
