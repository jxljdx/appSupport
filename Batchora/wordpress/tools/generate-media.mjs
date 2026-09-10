import { copyFile, mkdir, rm } from "node:fs/promises";
import { spawnSync } from "node:child_process";
import path from "node:path";
import process from "node:process";
import sharp from "sharp";

const root = path.resolve(import.meta.dirname, "..");
const appRoot = process.env.BATCHORA_APP_ROOT
  ? path.resolve(process.env.BATCHORA_APP_ROOT)
  : path.resolve(root, "../../../Batchly");
const outputRoot = path.join(root, "theme/batchora/assets/media");
const widths = [480, 768];
const locales = ["en-US", "zh-Hans"];
const screenshots = [
  "01-home",
  "02-photo-compression",
  "03-video-compression",
  "04-rename",
  "05-format-resize",
  "06-privacy-zip",
  "07-private-results"
];

const createResponsiveImage = async (input, outputBase) => {
  for (const width of widths) {
    await sharp(input)
      .resize({ width, withoutEnlargement: true })
      .webp({ quality: 82, effort: 5 })
      .toFile(`${outputBase}-${width}.webp`);
    await sharp(input)
      .resize({ width, withoutEnlargement: true })
      .avif({ quality: 56, effort: 5 })
      .toFile(`${outputBase}-${width}.avif`);
  }
};

await rm(outputRoot, { recursive: true, force: true });
await mkdir(outputRoot, { recursive: true });

const iconSource = path.join(
  appRoot,
  "Batchly/Assets.xcassets/AppIcon.appiconset/AppIcon.png"
);
for (const width of [128, 256]) {
  await sharp(iconSource)
    .resize(width, width)
    .webp({ quality: 88, effort: 5 })
    .toFile(path.join(outputRoot, `app-icon-${width}.webp`));
  await sharp(iconSource)
    .resize(width, width)
    .avif({ quality: 64, effort: 5 })
    .toFile(path.join(outputRoot, `app-icon-${width}.avif`));
}
await sharp(iconSource)
  .resize(512, 512)
  .png({ compressionLevel: 9, palette: true })
  .toFile(path.join(outputRoot, "app-icon-512.png"));

const socialCard = Buffer.from(`
<svg width="1200" height="630" viewBox="0 0 1200 630" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <linearGradient id="background" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#18265f"/>
      <stop offset="0.55" stop-color="#3158e8"/>
      <stop offset="1" stop-color="#7a3de2"/>
    </linearGradient>
  </defs>
  <rect width="1200" height="630" fill="url(#background)"/>
  <circle cx="1050" cy="80" r="260" fill="#ffffff" opacity="0.08"/>
  <circle cx="80" cy="610" r="300" fill="#ffffff" opacity="0.06"/>
  <text x="470" y="265" fill="#ffffff" font-family="-apple-system, BlinkMacSystemFont, sans-serif" font-size="92" font-weight="750">Batchora</text>
  <text x="470" y="355" fill="#ffffff" opacity="0.9" font-family="-apple-system, BlinkMacSystemFont, sans-serif" font-size="42" font-weight="500">Photo &amp; Video Batch Processing</text>
</svg>`);
await sharp(socialCard)
  .composite( [
    {
      input: await sharp(iconSource).resize(250, 250).png().toBuffer(),
      left: 145,
      top: 190
    }
  ] )
  .png({ compressionLevel: 9 })
  .toFile(path.join(root, "theme/batchora/assets/social-card.png"));

for (const locale of locales) {
  const localeOutput = path.join(outputRoot, locale);
  await mkdir(localeOutput, { recursive: true });

  for (const screenshot of screenshots) {
    const input = path.join(
      appRoot,
      "fastlane/screenshots",
      locale,
      `${screenshot}.png`
    );
    await createResponsiveImage(input, path.join(localeOutput, screenshot));
  }

  const previewSource = path.join(
    appRoot,
    "fastlane/previews",
    locale,
    "Batchly-App-Preview.mp4"
  );
  const previewOutput = path.join(localeOutput, "batchora-app-preview.mp4");
  const posterSource = path.join(localeOutput, "preview-poster.png");
  const extractPoster = spawnSync(
    "ffmpeg",
    [
      "-hide_banner",
      "-loglevel",
      "error",
      "-y",
      "-ss",
      "0.5",
      "-i",
      previewSource,
      "-frames:v",
      "1",
      posterSource
    ],
    { stdio: "inherit" }
  );
  if (extractPoster.status !== 0) {
    throw new Error(`Failed to extract ${locale} preview poster`);
  }

  await createResponsiveImage(
    posterSource,
    path.join(localeOutput, "preview-poster")
  );
  await rm(posterSource);

  const optimizePreview = spawnSync(
    "ffmpeg",
    [
      "-hide_banner",
      "-loglevel",
      "error",
      "-y",
      "-i",
      previewSource,
      "-c",
      "copy",
      "-movflags",
      "+faststart",
      previewOutput
    ],
    { stdio: "inherit" }
  );
  if (optimizePreview.status !== 0) {
    await copyFile(previewSource, previewOutput);
  }
}

console.log(`Created responsive Batchora media in ${outputRoot}`);
