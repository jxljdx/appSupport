import {
  answer,
  bullets,
  cta,
  faq,
  heading,
  pageContent,
  paragraph,
  section,
  steps
} from "./shared.mjs";

const page = (entry) => ({
  locale: "en-US",
  type: "page",
  parent: "home",
  status: "draft",
  ...entry
});

const post = (entry) => ({
  locale: "en-US",
  type: "page",
  parent: "guides",
  status: "draft",
  ...entry
});

const featureCta = cta(
  "Process the batch with Batchora",
  "Download Batchora on iPhone to compress, rename, resize, convert, and export successful copies."
);

export const englishEntries = [
  page({
    key: "home",
    slug: "en",
    parent: null,
    title: "Batchora for iPhone",
    seoTitle: "Batchora: Photo & Video Batch Processing for iPhone",
    description:
      "Compress photos and videos, batch rename, resize, convert HEIC, remove metadata, and export ZIP files privately on iPhone.",
    intent: "photo and video batch processing app",
    template: "front-page",
    content: [
      answer(
        "Batchora is an iPhone app for processing photos and videos in batches. It compresses media, previews new filenames, resizes and converts photos, removes selected metadata, and exports individual files or one ZIP without uploading your media to Batchora servers."
      ),
      `<!-- wp:pattern {"slug":"batchora/product-hero"} /-->`,
      `<!-- wp:pattern {"slug":"batchora/feature-grid"} /-->`,
      section(
        "Built around successful copies",
        paragraph(
          "Batchora saves successful processed copies first. It never silently replaces an original. If you choose to request deletion, Apple shows a separate Photos confirmation before eligible originals can change."
        ),
        bullets([
          "Photo and video processing happens on your device.",
          "Single-photo processing is unlimited in the free version.",
          "Batchora Pro removes the daily multi-photo and video-duration limits.",
          "Metadata privacy controls are available with Batchora Pro."
        ])
      ),
      section(
        "Choose the task you need",
        bullets([
          '<a href="/en/photo-compressor/">Compress photos and control image quality</a>',
          '<a href="/en/video-compressor/">Reduce video file size for sharing</a>',
          '<a href="/en/batch-rename-photos/">Preview and batch rename media</a>',
          '<a href="/en/heic-to-jpg/">Convert HEIC to JPG or PNG</a>',
          '<a href="/en/resize-images/">Resize a whole photo selection</a>',
          '<a href="/en/remove-photo-metadata/">Remove location or broader metadata from copies</a>',
          '<a href="/en/zip-photos-iphone/">Package processed files into one ZIP</a>'
        ])
      ),
      `<!-- wp:pattern {"slug":"batchora/faq"} /-->`,
      featureCta
    ].join("\n")
  }),
  page({
    key: "photo-compressor",
    slug: "photo-compressor",
    title: "Photo Compressor for iPhone",
    seoTitle: "Photo Compressor for iPhone | Batchora",
    description:
      "Compress photos on iPhone in a batch, choose image quality and dimensions, and save HEIC, JPEG, or PNG copies.",
    intent: "photo compressor for iPhone",
    content: pageContent(
      "Batchora compresses one photo or a whole selection on your iPhone. You choose a quality preset or custom settings, control output dimensions, and save new HEIC, JPEG, or PNG copies without automatically replacing the originals.",
      section(
        "What photo compression changes",
        paragraph(
          "File size depends on image dimensions, output format, source detail, and the quality setting. A smaller output can require lower dimensions, stronger compression, or both. Batchora shows practical controls rather than promising one percentage for every image."
        ),
        bullets([
          "Balanced, smallest-file, high-quality, and custom choices.",
          "Optional longest-edge or percentage resizing.",
          "HEIC, JPEG, and PNG output for processed copies.",
          "Batch naming preview before export."
        ])
      ),
      section(
        "How to compress photos with Batchora",
        steps([
          "Choose one or more photos from your permitted Photos selection.",
          "Select the quality approach that fits storage or sharing.",
          "Optionally change dimensions, output format, filenames, or metadata.",
          "Review the batch and start processing.",
          "Save successful copies to Photos or share the exported files."
        ])
      ),
      section(
        "Keep the original under your control",
        paragraph(
          "Batchora creates successful copies before offering any original-deletion action. Deletion is optional and requires Apple’s separate Photos confirmation. With Limited Photos access, only permitted items are available."
        )
      ),
      featureCta
    )
  }),
  page({
    key: "video-compressor",
    slug: "video-compressor",
    title: "Video Compressor for iPhone",
    seoTitle: "Video Compressor for iPhone | Batchora",
    description:
      "Reduce video file size on iPhone with quality and resolution controls. Create H.264 MP4 copies while keeping audio.",
    intent: "video compressor for iPhone",
    content: pageContent(
      "Batchora creates smaller H.264 MP4 copies of selected iPhone videos while keeping audio. You choose a quality preset and output resolution based on how you plan to store or share the result.",
      section(
        "Why output sizes vary",
        paragraph(
          "Video size depends on duration, resolution, motion, source codec, and the quality setting. A long or highly detailed source can remain large after compression. Lowering the output resolution or choosing a smaller preset usually reduces size further."
        )
      ),
      section(
        "How to compress a video",
        steps([
          "Choose videos that Batchora can access through Photos.",
          "Select the output quality and resolution.",
          "Review the source duration counted toward the free allowance.",
          "Keep Batchora open while the export is running.",
          "Save or share the successful MP4 copy."
        ])
      ),
      section(
        "Free and Pro video processing",
        paragraph(
          "The free version includes up to 10 minutes of successfully compressed source video per day. Batchora Pro removes that daily duration limit. Failed exports do not count as successful compressed duration."
        )
      ),
      featureCta
    )
  }),
  page({
    key: "batch-rename",
    slug: "batch-rename-photos",
    title: "Batch Rename Photos and Videos",
    seoTitle: "Batch Rename Photos and Videos on iPhone | Batchora",
    description:
      "Preview and batch rename photos and videos using text, dates, sequence numbers, and original filenames before export.",
    intent: "batch rename photos iPhone",
    content: pageContent(
      "Batchora builds new filenames for a whole media selection before export. Combine custom text, sequence numbers, capture dates, and original names, then preview every result before processing.",
      section(
        "A naming preview before files change",
        paragraph(
          "Batchora does not rename items inside Apple Photos in place. The chosen naming recipe is applied to processed copies and shared exports, so you can verify the full list first."
        ),
        bullets([
          "Add a project or event name.",
          "Create padded sequence numbers.",
          "Include capture dates when available.",
          "Keep all or part of the original filename.",
          "Preserve the previewed order in ZIP exports."
        ])
      ),
      section(
        "Build a consistent batch",
        steps([
          "Select the photos or videos for the task.",
          "Choose the filename components and their order.",
          "Review duplicate warnings and every generated name.",
          "Adjust the recipe until each name is unique.",
          "Export the processed copies or one ZIP archive."
        ])
      ),
      featureCta
    )
  }),
  page({
    key: "heic-to-jpg",
    slug: "heic-to-jpg",
    title: "Convert HEIC to JPG on iPhone",
    seoTitle: "Convert HEIC to JPG on iPhone | Batchora",
    description:
      "Convert HEIC photos to JPG or PNG on iPhone, with optional resizing, quality controls, batch names, and metadata choices.",
    intent: "HEIC to JPG converter iPhone",
    content: pageContent(
      "Batchora converts selected HEIC photos into JPEG or PNG copies on your iPhone. You can combine format conversion with resizing, quality control, batch renaming, and optional metadata removal in one export.",
      section(
        "Choose the output format",
        bullets([
          "<strong>JPEG:</strong> a widely compatible choice for photos and sharing.",
          "<strong>PNG:</strong> useful when you prefer a lossless image format, although files can be larger.",
          "<strong>HEIC:</strong> an efficient Apple-friendly output when broad compatibility is not required."
        ])
      ),
      section(
        "Convert a whole selection",
        steps([
          "Choose the HEIC photos you want to process.",
          "Select JPEG or PNG as the output format.",
          "Choose image quality and optional dimensions.",
          "Preview filenames and metadata choices.",
          "Export successful copies without replacing the HEIC originals."
        ])
      ),
      section(
        "Conversion does not improve source quality",
        paragraph(
          "Changing a file format cannot restore detail that is not present in the source. JPEG quality controls how the new copy is encoded; it does not increase the original resolution."
        )
      ),
      featureCta
    )
  }),
  page({
    key: "resize-images",
    slug: "resize-images",
    title: "Resize Images in a Batch",
    seoTitle: "Resize Images in a Batch on iPhone | Batchora",
    description:
      "Resize multiple photos on iPhone by longest edge or percentage, then combine resizing with compression, conversion, and renaming.",
    intent: "resize images batch iPhone",
    content: pageContent(
      "Batchora resizes multiple photos with one shared setting. Limit the longest edge or scale by percentage, then combine the new dimensions with compression, format conversion, naming, and export choices.",
      section(
        "Longest edge or percentage",
        paragraph(
          "A longest-edge limit keeps each photo’s orientation and aspect ratio while preventing its wider dimension from exceeding the selected size. Percentage scaling reduces both dimensions proportionally."
        )
      ),
      section(
        "When resizing helps",
        bullets([
          "Preparing photos for forms or websites with dimension limits.",
          "Reducing unnecessary resolution before messaging or email.",
          "Creating consistent output dimensions across a mixed batch.",
          "Combining smaller dimensions with JPEG or HEIC compression."
        ])
      ),
      section(
        "Review the exported copy",
        paragraph(
          "Very small dimensions can make text and fine detail harder to read. Check the output at the size where it will be viewed before deleting or archiving any original."
        )
      ),
      featureCta
    )
  }),
  page({
    key: "remove-metadata",
    slug: "remove-photo-metadata",
    title: "Remove Photo Location and Metadata",
    seoTitle: "Remove Photo Location and EXIF Metadata | Batchora",
    description:
      "Remove GPS location or broader camera metadata from processed photo copies on iPhone before sharing.",
    intent: "remove photo location metadata iPhone",
    content: pageContent(
      "Batchora Pro can remove GPS location or broader nonessential metadata from processed photo copies before you share them. The operation happens on your iPhone and does not modify the selected original in place.",
      section(
        "Choose the privacy level",
        bullets([
          "<strong>Location:</strong> remove GPS coordinates from the processed copy.",
          "<strong>Broader details:</strong> remove additional camera and device metadata when available.",
          "<strong>Keep metadata:</strong> preserve supported details when privacy removal is not needed."
        ])
      ),
      section(
        "What metadata removal cannot guarantee",
        paragraph(
          "Removing embedded metadata does not remove information visible in the image itself, such as signs, faces, documents, or landmarks. Other apps or services can also add their own data after export."
        )
      ),
      section(
        "Check before sharing",
        steps([
          "Select the photos and choose a processing recipe.",
          "Enable the location or broader metadata privacy option.",
          "Export the new copies.",
          "Review the exported result in the destination where you plan to share it."
        ])
      ),
      featureCta
    )
  }),
  page({
    key: "zip-photos",
    slug: "zip-photos-iphone",
    title: "ZIP Photos and Videos on iPhone",
    seoTitle: "ZIP Photos and Videos on iPhone | Batchora",
    description:
      "Package processed photos and videos into one ZIP file while preserving previewed filenames and batch order.",
    intent: "ZIP photos on iPhone",
    content: pageContent(
      "Batchora can package successful processed outputs into one ZIP archive on your iPhone. The archive keeps the filenames and order you previewed, making a multi-file batch easier to share as one item.",
      section(
        "What goes into the archive",
        paragraph(
          "The ZIP contains successful processed outputs from the current batch. It does not silently add the original Photos items. If an output fails, review the results before sharing the archive."
        )
      ),
      section(
        "Create one clean ZIP",
        steps([
          "Choose the photos or videos and configure processing.",
          "Preview the output filenames and order.",
          "Enable ZIP packaging.",
          "Run the batch and review successful results.",
          "Share or save the generated archive."
        ])
      ),
      section(
        "ZIP packaging is not media compression",
        paragraph(
          "JPEG, HEIC, PNG, and MP4 files are already encoded formats, so ZIP alone may not reduce them substantially. Batchora applies the selected photo or video processing first, then packages those outputs."
        )
      ),
      featureCta
    )
  }),
  page({
    key: "faq",
    slug: "faq",
    title: "Batchora Frequently Asked Questions",
    seoTitle: "Batchora FAQ: Compression, Privacy, Limits, and Pro",
    description:
      "Answers about Batchora photo and video compression, originals, privacy, free limits, ZIP exports, and Pro subscriptions.",
    intent: "Batchora FAQ",
    content: pageContent(
      "Batchora processes selected photos and videos on your iPhone, saves successful copies first, and gives you explicit control over sharing or requesting deletion of originals.",
      faq([
        {
          question: "Does Batchora require an account?",
          response:
            "No. Batchora does not require a login or a Batchora account."
        },
        {
          question: "Does Batchora upload my media?",
          response:
            "No. Photo and video processing happens on your device. Selected media and batch projects are not uploaded to Batchora servers."
        },
        {
          question: "What are the free daily limits?",
          response:
            "Single-photo processing is unlimited. Free multi-photo batches include up to 5 successfully processed photos per day, and free video compression includes up to 10 minutes of successfully compressed source video per day."
        },
        {
          question: "What does Batchora Pro unlock?",
          response:
            "Batchora Pro removes both daily limits and unlocks metadata privacy controls."
        },
        {
          question: "How do I restore a purchase?",
          response:
            "Open Batchora Pro in the app and choose Restore Purchases while signed in to the Apple Account used for the subscription."
        },
        {
          question: "Does Batchora automatically delete originals?",
          response:
            "No. Copies are saved first. Original deletion is optional and requires your action plus Apple’s separate Photos confirmation."
        }
      ]),
      featureCta
    )
  }),
  page({
    key: "guides",
    slug: "guides",
    title: "Batchora Guides",
    seoTitle: "Batchora Guides for Photo and Video Processing",
    description:
      "Practical iPhone guides for photo compression, video file size, HEIC conversion, metadata privacy, renaming, and ZIP exports.",
    intent: "iPhone photo video processing guides",
    content: pageContent(
      "Batchora Guides explain practical ways to prepare photos and videos for storage or sharing, with clear limits and steps grounded in the app’s real behavior.",
      section(
        "Start with a common task",
        bullets([
          '<a href="/en/guides/how-to-compress-photos-on-iphone/">How to compress photos without replacing originals</a>',
          '<a href="/en/guides/how-to-reduce-video-file-size-iphone/">How to reduce video file size before sharing</a>',
          '<a href="/en/guides/how-to-convert-heic-to-jpg-iphone/">How to convert HEIC to JPG on iPhone</a>',
          '<a href="/en/guides/how-to-remove-location-from-photo-iphone/">How to remove location metadata from a photo copy</a>'
        ])
      )
    )
  }),
  page({
    key: "support",
    slug: "support",
    title: "Batchora Support",
    seoTitle: "Batchora Support for iPhone",
    description:
      "Get help with Batchora Photos access, photo and video processing, exports, subscriptions, and purchase restoration.",
    intent: "Batchora support",
    content: pageContent(
      "For Batchora help, check Photos permission, confirm the selected media is available, and include your iOS and Batchora versions when contacting support.",
      section(
        "Quick checks",
        bullets([
          "Confirm Batchora has Photos access in iPhone Settings.",
          "With Limited Photos access, add the media you want to process.",
          "Keep Batchora open while video compression is running.",
          "Check available device storage before a large video export.",
          "Use Restore Purchases with the Apple Account that subscribed."
        ])
      ),
      section(
        "Contact support",
        paragraph(
          'Email <a href="mailto:jxstudio.apps@gmail.com?subject=Batchora%20Support">jxstudio.apps@gmail.com</a> and describe the task, what happened, and the iOS and Batchora versions. Do not attach private media unless it is necessary.'
        )
      )
    )
  }),
  page({
    key: "privacy",
    slug: "privacy",
    title: "Batchora Privacy Policy",
    seoTitle: "Batchora Privacy Policy",
    description:
      "How Batchora handles on-device media processing, local app data, support email, Apple purchases, and website analytics.",
    intent: "Batchora privacy policy",
    content: pageContent(
      "Batchora does not require an account and does not upload your selected photos, videos, filenames, or batch projects to Batchora servers. Media processing happens on your device.",
      section(
        "Photos and videos",
        bullets([
          "Photos access is used to read selected originals, save processed copies, and optionally request deletion.",
          "Compression, resizing, conversion, renaming, metadata changes, and ZIP creation happen locally.",
          "Temporary export files are removed after the relevant workflow, and abandoned sessions are cleaned up.",
          "Originals are never deleted automatically."
        ])
      ),
      section(
        "Data stored on your device",
        paragraph(
          "Batch projects, recipes, presets, preferences, and free-usage counters are stored in the app’s local container. Removing the app deletes its local container subject to standard iOS behavior."
        )
      ),
      section(
        "Purchases and support",
        paragraph(
          "Apple processes Batchora Pro purchases through StoreKit. Batchora receives entitlement status but not full payment details. If you email support, the support mailbox receives the address, message, and information you choose to include."
        )
      ),
      section(
        "Website analytics",
        paragraph(
          "The Batchora website plans to use Cloudflare Web Analytics for aggregate traffic measurement without advertising profiles. This policy will be reviewed against the final production configuration before launch."
        )
      ),
      section(
        "Contact",
        paragraph(
          'For privacy questions, email <a href="mailto:jxstudio.apps@gmail.com?subject=Batchora%20Privacy">jxstudio.apps@gmail.com</a>. Last updated September 10, 2026.'
        )
      )
    )
  }),
  page({
    key: "terms",
    slug: "terms",
    title: "Batchora Terms of Use",
    seoTitle: "Batchora Terms of Use",
    description:
      "Terms for using Batchora, including Apple’s standard licensed application agreement and subscription management.",
    intent: "Batchora terms of use",
    content: pageContent(
      "Batchora uses Apple’s Standard Licensed Application End User License Agreement. Subscriptions are managed through your Apple Account and renew unless canceled under Apple’s applicable terms.",
      section(
        "Apple standard agreement",
        paragraph(
          'Read the <a href="https://www.apple.com/legal/internet-services/itunes/dev/stdeula/" rel="noopener">Apple Standard EULA</a>. Apple’s agreement controls the licensed use of the app unless a separate valid agreement is presented.'
        )
      ),
      section(
        "Subscriptions",
        paragraph(
          "Batchora Pro is an auto-renewable subscription. Manage or cancel it in App Store account settings. Cancellation takes effect according to Apple’s subscription rules."
        )
      )
    )
  }),
  page({
    key: "about",
    slug: "about",
    title: "About Batchora",
    seoTitle: "About Batchora",
    description:
      "Batchora is an iPhone utility for private photo and video batch processing, built around successful copies and user control.",
    intent: "about Batchora",
    content: pageContent(
      "Batchora is an iPhone utility designed to make repetitive photo and video preparation clearer: choose media once, preview the batch, create successful copies, and keep control of the originals.",
      section(
        "Editorial approach",
        paragraph(
          "This website is maintained by the Batchora team. Product pages and guides describe released behavior, avoid fixed compression promises, and identify meaningful limitations. Content is reviewed when the app’s capabilities or policies change."
        )
      ),
      section(
        "Official product identity",
        bullets([
          "App: Batchora: Photo & Video",
          "Platform: iPhone, iOS 17 or later",
          "App Store ID: 6810283756",
          "Support: jxstudio.apps@gmail.com"
        ])
      )
    )
  }),
  post({
    key: "guide-compress-photos",
    slug: "how-to-compress-photos-on-iphone",
    title: "How to Compress Photos on iPhone Without Replacing Originals",
    seoTitle: "How to Compress Photos on iPhone Without Replacing Originals",
    description:
      "Compress photo copies on iPhone by changing dimensions, format, or quality while keeping the originals under your control.",
    intent: "how to compress photos on iPhone",
    content: pageContent(
      "To compress photos without replacing the originals, export new copies with smaller dimensions, a more efficient format, or a lower quality setting. Batchora saves successful copies first and never automatically deletes the selected originals.",
      heading("Before you start"),
      paragraph(
        "Decide where the photos will be viewed. A file intended for messaging usually needs less resolution than one intended for printing or detailed editing."
      ),
      heading("Steps"),
      steps([
        "Open Batchora and choose the photos.",
        "Select balanced, smallest-file, high-quality, or custom settings.",
        "Optionally limit the longest edge and choose HEIC or JPEG.",
        "Review filenames and start processing.",
        "Inspect the saved copies before considering any original-deletion request."
      ]),
      heading("Why there is no universal compression percentage"),
      paragraph(
        "A detailed high-resolution source, an already-compressed file, and a simple screenshot respond differently. Dimensions, format, and quality all affect the result, so a responsible compressor cannot promise one saving for every image."
      ),
      featureCta
    )
  }),
  post({
    key: "guide-reduce-video",
    slug: "how-to-reduce-video-file-size-iphone",
    title: "How to Reduce Video File Size on iPhone Before Sharing",
    seoTitle: "How to Reduce Video File Size on iPhone Before Sharing",
    description:
      "Reduce iPhone video file size by choosing an appropriate output resolution and quality, then review the new MP4 copy.",
    intent: "reduce video file size iPhone",
    content: pageContent(
      "To reduce an iPhone video before sharing, create a new copy at an appropriate resolution and quality. Batchora exports H.264 MP4 while keeping audio, and the selected original remains unchanged unless you later request deletion.",
      heading("Choose based on the destination"),
      paragraph(
        "A short clip for messaging may not need the source resolution. A video intended for a large screen may need a higher setting. Duration and motion can still make a compressed result large."
      ),
      heading("Steps"),
      steps([
        "Select the video in Batchora.",
        "Choose an output quality and resolution.",
        "Keep the app open while the export runs.",
        "Review the successful MP4 copy.",
        "Share the copy and keep or delete the original according to your own storage needs."
      ]),
      heading("If the result is still too large"),
      paragraph(
        "Try a lower resolution or smaller preset. Trimming content is outside Batchora’s current batch-compression workflow, so edit duration in an appropriate video editor before compression if necessary."
      ),
      featureCta
    )
  }),
  post({
    key: "guide-heic-jpg",
    slug: "how-to-convert-heic-to-jpg-iphone",
    title: "How to Convert HEIC to JPG on iPhone",
    seoTitle: "How to Convert HEIC to JPG on iPhone",
    description:
      "Convert one or many HEIC photos to compatible JPG copies on iPhone, with optional resizing and filename previews.",
    intent: "how to convert HEIC to JPG iPhone",
    content: pageContent(
      "To convert HEIC to JPG on iPhone, choose the HEIC photos, select JPEG output, choose the desired quality and dimensions, and export new copies. Batchora can apply the same conversion to a whole selection.",
      heading("Why choose JPEG"),
      paragraph(
        "JPEG is widely supported by websites, forms, messaging tools, and non-Apple devices. HEIC can be more storage-efficient, so only convert when compatibility or a receiving service requires it."
      ),
      heading("Steps"),
      steps([
        "Choose the HEIC photos in Batchora.",
        "Set the output format to JPEG.",
        "Select image quality and optional resizing.",
        "Preview the filenames.",
        "Export and review the JPG copies."
      ]),
      heading("Keep expectations realistic"),
      paragraph(
        "Format conversion does not add source detail. A high JPEG quality can preserve more visible detail but may produce a larger file."
      ),
      featureCta
    )
  }),
  post({
    key: "guide-remove-location",
    slug: "how-to-remove-location-from-photo-iphone",
    title: "How to Remove Location Metadata from a Photo Copy on iPhone",
    seoTitle: "How to Remove Location Metadata from a Photo on iPhone",
    description:
      "Create a processed photo copy without GPS location metadata on iPhone and review visible details before sharing.",
    intent: "remove location from photo iPhone",
    content: pageContent(
      "To remove location metadata before sharing, create a processed copy with GPS removal enabled. Batchora Pro performs the change on your iPhone and leaves the selected original unchanged.",
      heading("Steps"),
      steps([
        "Select the photo or batch in Batchora.",
        "Open the metadata privacy controls.",
        "Choose location removal or the broader metadata option.",
        "Export the processed copies.",
        "Review both embedded details and visible content before sharing."
      ]),
      heading("Metadata is only part of privacy"),
      paragraph(
        "A photo can reveal a place through landmarks, signs, reflections, documents, or faces even after GPS data is removed. Crop or edit visible information with an appropriate editor when needed."
      ),
      featureCta
    )
  })
];
