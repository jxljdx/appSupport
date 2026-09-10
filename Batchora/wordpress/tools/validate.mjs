import { access, readFile, readdir } from "node:fs/promises";
import path from "node:path";
import process from "node:process";
import { englishEntries } from "../content/en.mjs";

const root = path.resolve(import.meta.dirname, "..");
const requiredFiles = [
  "theme/batchora/style.css",
  "theme/batchora/theme.json",
  "theme/batchora/functions.php",
  "theme/batchora/templates/index.html",
  "theme/batchora/templates/page.html",
  "theme/batchora/templates/single.html",
  "theme/batchora/parts/header.html",
  "theme/batchora/parts/footer.html",
  "plugin/batchora-site/batchora-site.php"
];

for (const relativePath of requiredFiles) {
  await access(path.join(root, relativePath));
}

JSON.parse(
  await readFile(path.join(root, "theme/batchora/theme.json"), "utf8")
);

const themeHeader = await readFile(
  path.join(root, "theme/batchora/style.css"),
  "utf8"
);
for (const field of ["Theme Name:", "Version:", "Requires at least:"]) {
  if (!themeHeader.includes(field)) {
    throw new Error(`Theme header is missing ${field}`);
  }
}

const pluginSource = await readFile(
  path.join(root, "plugin/batchora-site/batchora-site.php"),
  "utf8"
);
for (const field of ["Plugin Name:", "Version:", "Requires at least:"]) {
  if (!pluginSource.includes(field)) {
    throw new Error(`Plugin header is missing ${field}`);
  }
}

const templateFiles = await readdir(
  path.join(root, "theme/batchora/templates")
);
if (!templateFiles.every((file) => file.endsWith(".html"))) {
  throw new Error("Block theme templates must use .html files");
}

const slugs = new Set();
const translationKeys = new Set();
for (const entry of englishEntries) {
  if (!entry.slug || !entry.title || !entry.seoTitle || !entry.description) {
    throw new Error(`English content entry is incomplete: ${entry.key}`);
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
    throw new Error(`Duplicate English slug: ${entry.slug}`);
  }
  if (translationKeys.has(entry.key)) {
    throw new Error(`Duplicate English translation key: ${entry.key}`);
  }
  slugs.add(entry.slug);
  translationKeys.add(entry.key);
}

console.log("Batchora WordPress source is valid.");
