import { access, readFile, readdir } from "node:fs/promises";
import path from "node:path";
import process from "node:process";

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

console.log("Batchora WordPress source is valid.");

