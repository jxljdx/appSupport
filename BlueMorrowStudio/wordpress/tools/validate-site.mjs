import process from "node:process";
import { englishEntries } from "../content/en.mjs";
import { chineseEntries } from "../content/zh-hans.mjs";

const baseUrl = new URL(
  process.env.BLUEMORROW_SITE_URL || "http://127.0.0.1:9401"
);
const entries = [...englishEntries, ...chineseEntries];
const byLocaleAndKey = new Map(
  entries.map((entry) => [`${entry.locale}:${entry.key}`, entry])
);

const entryPath = (entry) => {
  const segments = [entry.slug];
  let parentKey = entry.parent;
  while (parentKey) {
    const parent = byLocaleAndKey.get(`${entry.locale}:${parentKey}`);
    if (!parent) {
      throw new Error(`Missing parent ${entry.locale}:${parentKey}`);
    }
    segments.unshift(parent.slug);
    parentKey = parent.parent;
  }
  return `/${segments.join("/")}/`;
};

const request = async (pathname) => {
  let response;
  let body = "";
  for (let attempt = 1; attempt <= 4; attempt += 1) {
    response = await fetch(new URL(pathname, baseUrl), {
      redirect: "manual"
    });
    body = await response.text();
    if (response.status === 200) {
      break;
    }
    if (![404, 502].includes(response.status) || attempt === 4) {
      throw new Error(`${pathname} returned ${response.status}`);
    }
    await new Promise((resolve) => setTimeout(resolve, attempt * 250));
  }
  if (/Fatal error|Warning:|Notice:|Deprecated:/i.test(body)) {
    throw new Error(`${pathname} contains a PHP diagnostic`);
  }
  return body;
};

const internalLinks = new Set();

const rootResponse = await fetch(baseUrl, { redirect: "manual" });
if (
  rootResponse.status !== 302 ||
  new URL(rootResponse.headers.get("location"), baseUrl).pathname !== "/en/"
) {
  throw new Error("The site root must redirect to /en/");
}

for (const entry of entries) {
  const pathname = entryPath(entry);
  const html = await request(pathname);
  const expectedLocale = entry.locale;

  if (!new RegExp(`<html[^>]+lang=["']${expectedLocale}["']`, "i").test(html)) {
    throw new Error(`${pathname} has the wrong lang attribute`);
  }
  if (!/<meta name="description" content="[^"]+">/i.test(html)) {
    throw new Error(`${pathname} is missing a meta description`);
  }
  if (!/<link rel="canonical" href="[^"]+">/i.test(html)) {
    throw new Error(`${pathname} is missing a canonical URL`);
  }
  if (!/<meta property="og:image" content="[^"]+">/i.test(html)) {
    throw new Error(`${pathname} is missing an Open Graph image`);
  }
  for (const locale of ["en-US", "zh-Hans", "x-default"]) {
    const expression = new RegExp(
      `<link rel="alternate" hreflang="${locale}" href="[^"]+">`,
      "i"
    );
    if (!expression.test(html)) {
      throw new Error(`${pathname} is missing hreflang ${locale}`);
    }
  }

  const schemaMatches = [
    ...html.matchAll(
      /<script type="application\/ld\+json">([\s\S]*?)<\/script>/gi
    )
  ];
  if (schemaMatches.length === 0) {
    throw new Error(`${pathname} is missing JSON-LD`);
  }
  for (const match of schemaMatches) {
    JSON.parse(match[1]);
  }

  for (const match of html.matchAll(/href=["'](\/[^"'#?]*)/gi)) {
    if (!match[1].startsWith("//") && !match[1].startsWith("/wp-")) {
      internalLinks.add(match[1]);
    }
  }

  if ("home" === entry.key) {
    if (!html.includes('type="image/avif"') || !html.includes('type="image/webp"')) {
      throw new Error(`${pathname} is missing responsive product media`);
    }
    if (!/<video[^>]+data-src="[^"]+"[^>]*><\/video>/i.test(html)) {
      throw new Error(`${pathname} is missing a deferred app preview`);
    }
    if (/<video[^>]+\ssrc=/i.test(html)) {
      throw new Error(`${pathname} eagerly loads the app preview`);
    }
  }
}

for (const pathname of internalLinks) {
  await request(pathname);
}

const robots = await request("/robots.txt");
for (const token of [
  "User-agent: OAI-SearchBot",
  "User-agent: GPTBot",
  "User-agent: Applebot-Extended",
  "Sitemap:"
]) {
  if (!robots.includes(token)) {
    throw new Error(`robots.txt is missing ${token}`);
  }
}

const sitemap = await request("/wp-sitemap.xml");
if (
  sitemap.includes("wp-sitemap-users") ||
  sitemap.includes("wp-sitemap-taxonomies")
) {
  throw new Error("Sitemap includes disabled user or taxonomy providers");
}

const llms = await request("/llms.txt");
if (!llms.includes("# Batchora") || !llms.includes("App Store:")) {
  throw new Error("llms.txt is incomplete");
}

console.log(
  `Validated ${entries.length} pages, ${internalLinks.size} internal links, robots.txt, sitemap, and llms.txt.`
);
