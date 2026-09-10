import { mkdir, rm } from "node:fs/promises";
import { spawnSync } from "node:child_process";
import path from "node:path";
import process from "node:process";

const root = path.resolve(import.meta.dirname, "..");
const releaseDirectory = path.join(root, "release");
const version = process.env.BATCHORA_SITE_VERSION || "1.0.0";

await mkdir(releaseDirectory, { recursive: true });

const packages = [
  {
    source: path.join(root, "theme", "batchora"),
    output: path.join(releaseDirectory, `batchora-theme-${version}.zip`)
  },
  {
    source: path.join(root, "plugin", "batchora-site"),
    output: path.join(releaseDirectory, `batchora-site-${version}.zip`)
  },
  {
    source: path.join(root, "theme", "batchora", "assets", "media"),
    output: path.join(releaseDirectory, `batchora-media-${version}.zip`)
  }
];

for (const item of packages) {
  await rm(item.output, { force: true });
  const result = spawnSync(
    "ditto",
    ["-c", "-k", "--keepParent", item.source, item.output],
    { stdio: "inherit" }
  );
  if (result.status !== 0) {
    throw new Error(`Failed to create ${path.basename(item.output)}`);
  }
}

console.log(`Created WordPress packages in ${releaseDirectory}`);
