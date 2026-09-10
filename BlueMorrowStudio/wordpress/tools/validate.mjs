import { access, readFile, readdir, stat } from "node:fs/promises";
import path from "node:path";
import process from "node:process";
import { englishEntries } from "../content/en.mjs";
import { chineseEntries } from "../content/zh-hans.mjs";

const root = path.resolve(import.meta.dirname, "..");
const requiredFiles = [
  "theme/bluemorrow-studio/style.css",
  "theme/bluemorrow-studio/theme.json",
  "theme/bluemorrow-studio/functions.php",
  "theme/bluemorrow-studio/templates/index.html",
  "theme/bluemorrow-studio/templates/page.html",
  "theme/bluemorrow-studio/templates/single.html",
  "theme/bluemorrow-studio/parts/header.html",
  "theme/bluemorrow-studio/parts/footer.html",
  "theme/bluemorrow-studio/assets/social-card.png",
  "plugin/bluemorrow-studio-site/bluemorrow-studio-site.php"
];

for (const relativePath of requiredFiles) {
  await access(path.join(root, relativePath));
}

const mediaRoot = path.join(
  root,
  "theme/bluemorrow-studio/assets/media"
);
for (const icon of [
  "app-icon-128.webp",
  "app-icon-128.avif",
  "app-icon-256.webp",
  "app-icon-256.avif",
  "app-icon-512.png"
]) {
  await access(path.join(mediaRoot, icon));
}

for (const locale of ["en-US", "zh-Hans"]) {
  for (const name of [
    "01-home",
    "02-photo-compression",
    "03-video-compression",
    "04-rename",
    "05-format-resize",
    "06-privacy-zip",
    "07-private-results",
    "preview-poster"
  ]) {
    for (const width of [480, 768]) {
      for (const format of ["webp", "avif"]) {
        const mediaPath = path.join(
          mediaRoot,
          locale,
          `${name}-${width}.${format}`
        );
        const mediaStat = await stat(mediaPath);
        if (mediaStat.size > 120 * 1024) {
          throw new Error(`Responsive image exceeds 120 KB: ${mediaPath}`);
        }
      }
    }
  }

  const videoPath = path.join(
    mediaRoot,
    locale,
    "batchora-app-preview.mp4"
  );
  const videoStat = await stat(videoPath);
  if (videoStat.size > 5 * 1024 * 1024) {
    throw new Error(`App preview exceeds 5 MB: ${videoPath}`);
  }
}

const socialCardStat = await stat(
  path.join(root, "theme/bluemorrow-studio/assets/social-card.png")
);
if (socialCardStat.size > 500 * 1024) {
  throw new Error("Social card exceeds 500 KB");
}

JSON.parse(
  await readFile(
    path.join(root, "theme/bluemorrow-studio/theme.json"),
    "utf8"
  )
);

const themeHeader = await readFile(
  path.join(root, "theme/bluemorrow-studio/style.css"),
  "utf8"
);
for (const field of ["Theme Name:", "Version:", "Requires at least:"]) {
  if (!themeHeader.includes(field)) {
    throw new Error(`Theme header is missing ${field}`);
  }
}

const pluginSource = await readFile(
  path.join(
    root,
    "plugin/bluemorrow-studio-site/bluemorrow-studio-site.php"
  ),
  "utf8"
);
for (const field of ["Plugin Name:", "Version:", "Requires at least:"]) {
  if (!pluginSource.includes(field)) {
    throw new Error(`Plugin header is missing ${field}`);
  }
}

const templateFiles = await readdir(
  path.join(root, "theme/bluemorrow-studio/templates")
);
if (!templateFiles.every((file) => file.endsWith(".html"))) {
  throw new Error("Block theme templates must use .html files");
}

const serializedSources = [
  path.join(root, "theme/bluemorrow-studio/parts/header.html"),
  path.join(root, "theme/bluemorrow-studio/parts/footer.html"),
  path.join(root, "theme/bluemorrow-studio/patterns/hero.php"),
  path.join(root, "theme/bluemorrow-studio/patterns/download-cta.php")
];

const validateSerializedBlocks = (source, sourceLabel) => {
  const blockPattern =
    /<!--\s+wp:([^\s/>]+)(?:\s+(\{.*?\}))?\s*\/?-->/gs;

  for (const match of source.matchAll(blockPattern)) {
    const attributes = match[2];
    if (!attributes) {
      continue;
    }

    const line = source.slice(0, match.index).split("\n").length;
    let parsed;
    try {
      parsed = JSON.parse(attributes);
    } catch (error) {
      throw new Error(
        `Invalid block JSON in ${sourceLabel}:${line}: ${error.message}`
      );
    }

    const serialized = JSON.stringify(parsed);
    if (/https?:\/\//i.test(serialized)) {
      throw new Error(
        `Block JSON must not serialize an absolute URL in ${sourceLabel}:${line}`
      );
    }
  }
};

for (const sourcePath of serializedSources) {
  const source = await readFile(sourcePath, "utf8");
  validateSerializedBlocks(source, sourcePath);
  if (
    source.includes("[batchora_app_store_cta") ||
    source.includes("[batchora_language_switcher") ||
    source.includes("[batchora_legal_links")
  ) {
    throw new Error(
      `Batchora UI must use dynamic blocks instead of shortcode blocks: ${sourcePath}`
    );
  }
}

const validateEntries = (entries, label) => {
const slugs = new Set();
const translationKeys = new Set();
for (const entry of entries) {
  if (!entry.slug || !entry.title || !entry.seoTitle || !entry.description) {
    throw new Error(`${label} content entry is incomplete: ${entry.key}`);
  }
  if (entry.seoTitle.length > 60) {
    throw new Error(`SEO title exceeds 60 characters: ${entry.key}`);
  }
  if (entry.description.length > 160) {
    throw new Error(`SEO description exceeds 160 characters: ${entry.key}`);
  }
  if (!entry.content.includes("batchora-answer")) {
    throw new Error(`Entry has no answer-first summary: ${entry.key}`);
  }
  if (slugs.has(entry.slug)) {
    throw new Error(`Duplicate ${label} slug: ${entry.slug}`);
  }
  if (translationKeys.has(entry.key)) {
    throw new Error(`Duplicate ${label} translation key: ${entry.key}`);
  }
  slugs.add(entry.slug);
  translationKeys.add(entry.key);
}
};

validateEntries(englishEntries, "English");
validateEntries(chineseEntries, "Chinese");

for (const entry of [...englishEntries, ...chineseEntries]) {
  validateSerializedBlocks(entry.content, `${entry.locale}:${entry.key}`);
}

const englishKeys = englishEntries.map((entry) => entry.key).sort();
const chineseKeys = chineseEntries.map((entry) => entry.key).sort();
if (JSON.stringify(englishKeys) !== JSON.stringify(chineseKeys)) {
  throw new Error("English and Chinese content entries are not aligned");
}

console.log("BlueMorrow Studio WordPress source is valid.");
