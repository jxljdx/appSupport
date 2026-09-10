import { copyFile, cp, mkdir, readFile, rm, writeFile } from "node:fs/promises";
import { spawnSync } from "node:child_process";
import { createHash } from "node:crypto";
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

const artifactNames = [
  `batchora-theme-${version}.zip`,
  `batchora-site-${version}.zip`,
  `batchora-media-${version}.zip`,
  `batchora-content-${version}.xml`
];
const checksumLines = [];
for (const artifactName of artifactNames) {
  const artifact = await readFile(path.join(releaseDirectory, artifactName));
  checksumLines.push(
    `${createHash("sha256").update(artifact).digest("hex")}  ${artifactName}`
  );
}
await writeFile(
  path.join(releaseDirectory, "SHA256SUMS"),
  `${checksumLines.join("\n")}\n`
);

const bundleName = `batchora-wordpress-release-${version}`;
const bundleDirectory = path.join(releaseDirectory, bundleName);
await rm(bundleDirectory, { recursive: true, force: true });
await mkdir(bundleDirectory, { recursive: true });
for (const artifactName of [...artifactNames, "SHA256SUMS"]) {
  await copyFile(
    path.join(releaseDirectory, artifactName),
    path.join(bundleDirectory, artifactName)
  );
}
await cp(
  path.join(root, "deployment"),
  path.join(bundleDirectory, "deployment"),
  { recursive: true }
);

const bundleOutput = path.join(releaseDirectory, `${bundleName}.zip`);
await rm(bundleOutput, { force: true });
const bundleResult = spawnSync(
  "ditto",
  ["-c", "-k", "--keepParent", bundleDirectory, bundleOutput],
  { stdio: "inherit" }
);
if (bundleResult.status !== 0) {
  throw new Error(`Failed to create ${path.basename(bundleOutput)}`);
}
await rm(bundleDirectory, { recursive: true, force: true });

console.log(`Created WordPress packages in ${releaseDirectory}`);
