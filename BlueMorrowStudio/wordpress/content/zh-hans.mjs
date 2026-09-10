import {
  answer,
  bullets,
  cta,
  faq,
  heading,
  pageContent,
  paragraph,
  section,
  steps,
  withFeatureExperience
} from "./shared.mjs";

const page = (entry) => ({
  locale: "zh-Hans",
  type: "page",
  parent: "batchora-home",
  scope: "app",
  appKey: "batchora",
  status: "draft",
  ...withFeatureExperience(entry)
});

const studioPage = (entry) => ({
  locale: "zh-Hans",
  type: "page",
  parent: "studio-home",
  scope: "studio",
  appKey: "",
  status: "draft",
  ...entry
});

const article = (entry) => ({
  locale: "zh-Hans",
  type: "page",
  parent: "guides",
  scope: "app",
  appKey: "batchora",
  status: "draft",
  ...entry
});

const featureCta = cta(
  "用 Batchora 完成整批处理",
  "在 iPhone 上批量压缩、重命名、改尺寸、转换并导出成功处理的副本。"
);

export const chineseEntries = [
  studioPage({
    key: "studio-home",
    slug: "zh-hans",
    parent: null,
    title: "BlueMorrow Studio",
    seoTitle: "BlueMorrow Studio｜用心打造的实用 App",
    description:
      "BlueMorrow Studio 打造清晰、注重隐私的日常工具。了解 Batchora iPhone 照片与视频批处理 App。",
    intent: "BlueMorrow Studio App",
    template: "front-page",
    content: pageContent(
      "BlueMorrow Studio 专注于清晰、克制并从一开始就考虑隐私的实用工具。首款 App Batchora 可在 iPhone 本地批量处理照片与视频。",
      section(
        "简单工具，用心打造。",
        paragraph(
          "用专注的 App 解决重复任务，不强加多余账号、复杂界面或无法兑现的宣传。"
        )
      )
    )
  }),
  studioPage({
    key: "apps",
    slug: "apps",
    title: "App",
    seoTitle: "BlueMorrow Studio App",
    description:
      "了解 BlueMorrow Studio 的 App，包括用于 iPhone 照片与视频本地批处理的 Batchora。",
    intent: "BlueMorrow Studio App",
    content: pageContent(
      "BlueMorrow Studio 目前推出了 Batchora，一款可在 iPhone 批量压缩、重命名、改尺寸、转换并导出照片和视频的 App。",
      section(
        "Batchora",
        paragraph(
          "Batchora 把照片和视频批处理能力整合到一个清晰、设备本地完成的流程中。"
        )
      )
    )
  }),
  studioPage({
    key: "studio-about",
    slug: "about",
    title: "关于 BlueMorrow Studio",
    seoTitle: "关于 BlueMorrow Studio",
    description:
      "了解 BlueMorrow Studio 对实用软件、清晰体验、隐私和准确产品内容的设计原则。",
    intent: "关于 BlueMorrow Studio",
    content: pageContent(
      "BlueMorrow Studio 为日常任务打造专注的 App。产品页面和指南会依据当前真实功能维护，不宣传软件无法可靠做到的效果。",
      section(
        "我们的方式",
        paragraph(
          "从真实任务出发，让流程容易理解，并让用户始终掌控自己的文件和选择。"
        )
      )
    )
  }),
  studioPage({
    key: "studio-privacy",
    slug: "privacy",
    title: "BlueMorrow Studio 网站隐私",
    seoTitle: "网站隐私｜BlueMorrow Studio",
    description:
      "了解 BlueMorrow Studio 网站如何使用聚合分析和处理联系信息，并查看每款 App 的独立隐私政策。",
    intent: "BlueMorrow Studio 隐私",
    content: pageContent(
      "BlueMorrow Studio 网站使用注重隐私的聚合访问分析来了解页面使用情况。每款 App 都有独立隐私政策，说明该产品的数据处理方式。",
      section(
        "App 独立隐私政策",
        paragraph(
          "请从 App 或支持页面选择产品，查看真正适用于该 App 的隐私说明。"
        )
      )
    )
  }),
  studioPage({
    key: "studio-support",
    slug: "support",
    title: "BlueMorrow Studio 支持",
    seoTitle: "支持｜BlueMorrow Studio",
    description:
      "选择 BlueMorrow Studio App，查看对应的帮助、隐私信息、故障排查和联系入口。",
    intent: "BlueMorrow Studio 支持",
    content: pageContent(
      "支持内容按 App 整理，确保操作说明、隐私细节和故障排查准确对应你正在使用的产品。",
      section(
        "Batchora 支持",
        paragraph(
          "Batchora 支持涵盖照片与视频处理、导出、订阅、隐私和常见问题排查。"
        )
      )
    )
  }),
  page({
    key: "batchora-home",
    slug: "batchora",
    parent: "apps",
    title: "Batchora iPhone 版",
    seoTitle: "Batchora：iPhone 照片视频批处理工具",
    description:
      "在 iPhone 本地批量压缩照片和视频、重命名、改尺寸、HEIC 转 JPG、清除元数据并导出 ZIP。",
    intent: "iPhone 照片视频批处理工具",
    content: [
      `<!-- wp:bluemorrow/batchora-home-hero /-->`,
      answer(
        "Batchora 是一款 iPhone 照片与视频批处理 App。它可以批量压缩媒体、预览新文件名、调整照片尺寸与格式、移除选定元数据，并导出单独文件或一个 ZIP；你的媒体不会上传到 Batchora 服务器。"
      ),
      `<!-- wp:bluemorrow/batchora-home-workflow /-->`,
      `<!-- wp:bluemorrow/batchora-feature-explorer /-->`,
      `<!-- wp:bluemorrow/batchora-product-media /-->`,
      `<!-- wp:bluemorrow/batchora-trust-panel /-->`,
      section(
        "常见问题",
        faq([
          {
            question: "Batchora 会上传我的照片或视频吗？",
            response:
              "不会。媒体处理在你的设备本地完成，Batchora 不会把所选媒体上传到自己的服务器。"
          },
          {
            question: "Batchora 会自动删除原件吗？",
            response:
              "不会。App 会先保存成功副本；删除原件必须由你主动选择，并再次确认 Apple 的“照片”系统提示。"
          },
          {
            question: "可以输出哪些格式？",
            response:
              "照片副本支持 HEIC、JPEG 和 PNG；压缩视频输出为兼容的 H.264 MP4。"
          }
        ])
      ),
      featureCta
    ].join("\n")
  }),
  page({
    key: "photo-compressor",
    slug: "photo-compressor",
    title: "iPhone 图片压缩工具",
    seoTitle: "iPhone 图片压缩工具｜Batchora",
    description:
      "在 iPhone 批量压缩照片，自定义画质和尺寸，并导出 HEIC、JPEG 或 PNG 副本。",
    intent: "iPhone 图片压缩",
    content: pageContent(
      "Batchora 可以在 iPhone 上压缩单张照片或整批图片。你可以选择画质预设或自定义设置，控制输出尺寸，并保存新的 HEIC、JPEG 或 PNG 副本，不会自动替换原件。",
      section(
        "哪些设置会影响文件体积",
        paragraph(
          "输出大小取决于照片尺寸、格式、源图细节和画质设置。想进一步减小体积，通常需要降低尺寸、加强压缩，或同时调整两者；任何工具都无法对所有图片承诺同一个压缩比例。"
        ),
        bullets([
          "均衡压缩、最小体积、高画质和自定义选择。",
          "按最长边限制或按百分比缩放。",
          "导出 HEIC、JPEG 或 PNG 副本。",
          "导出前预览整批新文件名。"
        ])
      ),
      section(
        "如何批量压缩照片",
        steps([
          "从 Batchora 可访问的“照片”项目中选择一张或多张图片。",
          "根据存储或分享需求选择画质。",
          "按需调整尺寸、格式、文件名或元数据。",
          "检查批处理预览并开始处理。",
          "把成功副本保存到“照片”或直接分享。"
        ])
      ),
      featureCta
    )
  }),
  page({
    key: "video-compressor",
    slug: "video-compressor",
    title: "iPhone 视频压缩工具",
    seoTitle: "iPhone 视频压缩与减小体积｜Batchora",
    description:
      "在 iPhone 选择画质和分辨率，生成更小的 H.264 MP4 视频副本并保留音频。",
    intent: "iPhone 视频压缩",
    content: pageContent(
      "Batchora 会把所选视频导出为更小的 H.264 MP4 副本，同时保留音频。你可以根据存储或分享场景选择画质和输出分辨率。",
      section(
        "为什么压缩后的大小不同",
        paragraph(
          "视频体积与时长、分辨率、画面运动、源编码和所选画质有关。较长或细节丰富的视频即使压缩后仍可能很大；降低输出分辨率通常还能进一步减小体积。"
        )
      ),
      section(
        "如何压缩视频",
        steps([
          "选择 Batchora 通过“照片”权限可以访问的视频。",
          "设置输出画质和分辨率。",
          "确认计入免费额度的源视频时长。",
          "导出期间保持 Batchora 打开。",
          "检查并保存或分享成功的 MP4 副本。"
        ])
      ),
      section(
        "免费版与 Pro",
        paragraph(
          "免费版每天包含最多 10 分钟成功压缩的源视频时长；Batchora Pro 移除该每日时长限制。处理失败的导出不会算作成功压缩时长。"
        )
      ),
      featureCta
    )
  }),
  page({
    key: "batch-rename",
    slug: "batch-rename-photos",
    title: "批量重命名照片和视频",
    seoTitle: "iPhone 批量重命名照片和视频｜Batchora",
    description:
      "用文字、日期、序号和原文件名组合新名称，导出前预览整批照片和视频文件名。",
    intent: "iPhone 批量重命名照片",
    content: pageContent(
      "Batchora 可以在导出前为整批媒体生成新文件名。你可以组合自定义文字、序号、拍摄日期和原文件名，并预览每一项结果。",
      section(
        "先预览，再应用到副本",
        paragraph(
          "Batchora 不会在 Apple“照片”中原地改名。命名方案会应用到处理后的副本和分享文件，因此你可以先检查完整列表。"
        ),
        bullets([
          "加入项目、旅行或活动名称。",
          "生成位数一致的连续序号。",
          "在可用时加入拍摄日期。",
          "保留全部或部分原文件名。",
          "ZIP 导出保留预览过的名称与顺序。"
        ])
      ),
      section(
        "建立统一命名",
        steps([
          "选择需要处理的照片或视频。",
          "设置文件名组成和顺序。",
          "检查重复警告与每个预览名称。",
          "调整方案，直到所有名称唯一。",
          "导出处理副本或一个 ZIP。"
        ])
      ),
      featureCta
    )
  }),
  page({
    key: "heic-to-jpg",
    slug: "heic-to-jpg",
    title: "iPhone HEIC 转 JPG",
    seoTitle: "iPhone HEIC 转 JPG 与 PNG｜Batchora",
    description:
      "在 iPhone 把一张或整批 HEIC 转为 JPG 或 PNG，并可同时改尺寸、画质、文件名和元数据。",
    intent: "iPhone HEIC 转 JPG",
    content: pageContent(
      "Batchora 可以在 iPhone 上把所选 HEIC 照片转换为 JPEG 或 PNG 副本，并在同一次处理中完成改尺寸、画质控制、批量重命名和元数据选择。",
      section(
        "选择输出格式",
        bullets([
          "<strong>JPEG：</strong>适合需要广泛兼容的照片与分享场景。",
          "<strong>PNG：</strong>适合需要无损图片格式的场景，但文件可能更大。",
          "<strong>HEIC：</strong>适合继续在 Apple 生态中使用，并保持较高存储效率。"
        ])
      ),
      section(
        "一次转换整批照片",
        steps([
          "选择需要转换的 HEIC 照片。",
          "把输出格式设为 JPEG 或 PNG。",
          "设置图片画质与可选尺寸。",
          "预览文件名与元数据选项。",
          "导出新副本，不替换 HEIC 原件。"
        ])
      ),
      section(
        "格式转换不会增加原始细节",
        paragraph(
          "转换文件格式不能恢复源图中不存在的细节。JPEG 画质只控制新副本的编码方式，不会提升原始分辨率。"
        )
      ),
      featureCta
    )
  }),
  page({
    key: "resize-images",
    slug: "resize-images",
    title: "批量调整图片尺寸",
    seoTitle: "iPhone 批量调整图片尺寸｜Batchora",
    description:
      "按最长边或百分比批量缩放照片，并同时完成压缩、格式转换、重命名与导出。",
    intent: "iPhone 批量调整图片尺寸",
    content: pageContent(
      "Batchora 可以用一个统一设置调整整批照片尺寸。你可以限制最长边或按百分比缩放，再结合压缩、格式转换、命名与导出。",
      section(
        "最长边与百分比",
        paragraph(
          "最长边限制会保留照片方向和宽高比，同时让较长的一边不超过目标尺寸；百分比缩放会按相同比例调整宽度和高度。"
        )
      ),
      section(
        "适合哪些任务",
        bullets([
          "为有尺寸限制的表单或网站准备图片。",
          "发送邮件或消息前减少不必要的分辨率。",
          "让一组横竖不同的照片使用统一尺寸规则。",
          "把较小尺寸与 JPEG 或 HEIC 压缩结合。"
        ])
      ),
      section(
        "导出后检查清晰度",
        paragraph(
          "过小的尺寸会让文字和细节更难辨认。删除或归档原件前，请在实际使用场景中检查输出副本。"
        )
      ),
      featureCta
    )
  }),
  page({
    key: "remove-metadata",
    slug: "remove-photo-metadata",
    title: "清除照片定位和元数据",
    seoTitle: "清除照片定位与 EXIF 元数据｜Batchora",
    description:
      "在分享前，从 iPhone 上处理后的照片副本中移除 GPS 定位或更多相机元数据。",
    intent: "iPhone 清除照片定位元数据",
    content: pageContent(
      "Batchora Pro 可以在分享前，从处理后的照片副本中移除 GPS 定位或更多非必要元数据。操作在 iPhone 本地完成，不会原地修改所选原件。",
      section(
        "选择隐私级别",
        bullets([
          "<strong>移除定位：</strong>从处理副本中删除 GPS 坐标。",
          "<strong>更多详情：</strong>在可用时移除额外相机和设备信息。",
          "<strong>保留元数据：</strong>不需要隐私清理时保留支持的信息。"
        ])
      ),
      section(
        "元数据清理不是绝对匿名",
        paragraph(
          "移除嵌入元数据不会删除画面中可见的路牌、人脸、证件、文字或地标。其他 App 或服务也可能在导出后添加自己的信息。"
        )
      ),
      section(
        "分享前检查",
        steps([
          "选择照片并设置处理方案。",
          "开启定位或更多元数据清理。",
          "导出新副本。",
          "在实际分享目的地再次检查结果。"
        ])
      ),
      featureCta
    )
  }),
  page({
    key: "zip-photos",
    slug: "zip-photos-iphone",
    title: "iPhone 照片视频打包 ZIP",
    seoTitle: "iPhone 照片视频打包 ZIP｜Batchora",
    description:
      "把成功处理的照片和视频打包为一个 ZIP，同时保留预览过的文件名与整批顺序。",
    intent: "iPhone 照片打包 ZIP",
    content: pageContent(
      "Batchora 可以在 iPhone 上把成功处理的输出打包成一个 ZIP，并保留你预览过的文件名和顺序，让多文件批次可以作为一个项目分享。",
      section(
        "ZIP 中包含什么",
        paragraph(
          "压缩包只包含当前批次中成功生成的处理结果，不会静默加入 Apple“照片”里的原件。如果某项处理失败，请在分享前检查结果列表。"
        )
      ),
      section(
        "创建一个整洁的 ZIP",
        steps([
          "选择照片或视频并配置处理选项。",
          "预览输出文件名和顺序。",
          "开启 ZIP 打包。",
          "运行批处理并检查成功结果。",
          "保存或分享生成的压缩包。"
        ])
      ),
      section(
        "ZIP 不等于媒体压缩",
        paragraph(
          "JPEG、HEIC、PNG 和 MP4 本身已经是编码格式，仅打包 ZIP 通常不会显著缩小它们。Batchora 会先执行所选媒体处理，再打包输出。"
        )
      ),
      featureCta
    )
  }),
  page({
    key: "faq",
    slug: "faq",
    title: "Batchora 常见问题",
    seoTitle: "Batchora 常见问题：压缩、隐私、额度与 Pro",
    description:
      "了解 Batchora 照片视频压缩、原件控制、本地隐私、免费额度、ZIP 导出和 Pro 订阅。",
    intent: "Batchora 常见问题",
    content: pageContent(
      "Batchora 在 iPhone 本地处理所选照片和视频，先保存成功副本，并让你明确决定分享或是否请求删除原件。",
      faq([
        {
          question: "Batchora 需要注册账号吗？",
          response: "不需要。Batchora 不要求登录或创建 Batchora 账号。"
        },
        {
          question: "Batchora 会上传媒体吗？",
          response:
            "不会。照片和视频处理在设备本地完成，所选媒体和批处理项目不会上传到 Batchora 服务器。"
        },
        {
          question: "免费版每天有哪些额度？",
          response:
            "单张照片不限次数；多图批处理每天包含最多 5 张成功处理的照片，视频压缩每天包含最多 10 分钟成功压缩的源视频时长。"
        },
        {
          question: "Batchora Pro 解锁什么？",
          response: "Pro 会移除两项每日额度，并解锁元数据隐私控制。"
        },
        {
          question: "如何恢复购买？",
          response:
            "在 App 中打开 Batchora Pro，使用购买订阅的同一 Apple 账户点按“恢复购买”。"
        },
        {
          question: "Batchora 会自动删除原件吗？",
          response:
            "不会。App 会先保存副本；原件删除必须由你主动操作，并确认 Apple 单独显示的系统提示。"
        }
      ]),
      featureCta
    )
  }),
  page({
    key: "guides",
    slug: "guides",
    title: "Batchora 使用指南",
    seoTitle: "Batchora 照片视频处理指南",
    description:
      "查看 iPhone 图片压缩、视频减小体积、HEIC 转 JPG、定位清理、重命名和 ZIP 导出指南。",
    intent: "iPhone 照片视频处理指南",
    content: pageContent(
      "Batchora 使用指南围绕真实任务说明如何为存储和分享准备照片与视频，并清楚说明限制和检查步骤。",
      section(
        "从常见任务开始",
        bullets([
          '<a href="/zh-hans/guides/compress-photos-iphone/">如何压缩照片并保留原件</a>',
          '<a href="/zh-hans/guides/reduce-video-file-size-iphone/">分享前如何减小视频体积</a>',
          '<a href="/zh-hans/guides/convert-heic-to-jpg-iphone/">如何在 iPhone 将 HEIC 转为 JPG</a>',
          '<a href="/zh-hans/guides/remove-photo-location-iphone/">如何从照片副本移除定位信息</a>'
        ])
      )
    )
  }),
  page({
    key: "support",
    slug: "support",
    title: "Batchora 应用支持",
    seoTitle: "Batchora iPhone 应用支持",
    description:
      "获取 Batchora 照片权限、批处理、照片视频压缩、导出、订阅和恢复购买帮助。",
    intent: "Batchora 应用支持",
    content: pageContent(
      "遇到 Batchora 问题时，请先检查“照片”权限和媒体可用性；联系支持时请提供 iOS 与 Batchora 版本。",
      section(
        "快速检查",
        bullets([
          "在 iPhone 设置中确认 Batchora 已获得“照片”访问权限。",
          "使用“有限访问”时，把需要处理的媒体加入允许范围。",
          "视频压缩运行期间保持 Batchora 打开。",
          "大型视频导出前检查设备剩余空间。",
          "使用订阅时的同一 Apple 账户恢复购买。"
        ])
      ),
      section(
        "联系支持",
        paragraph(
          '发送邮件至 <a href="mailto:jxstudio.apps@gmail.com?subject=Batchora%20Support">jxstudio.apps@gmail.com</a>，说明执行的任务、出现的情况，以及 iOS 和 Batchora 版本。除非确有必要，请勿附加私人媒体。'
        )
      )
    )
  }),
  page({
    key: "privacy",
    slug: "privacy",
    title: "Batchora 隐私政策",
    seoTitle: "Batchora 隐私政策",
    description:
      "了解 Batchora 设备本地媒体处理、本地数据、支持邮件、Apple 购买和网站分析方式。",
    intent: "Batchora 隐私政策",
    content: pageContent(
      "Batchora 不要求注册账号，也不会把所选照片、视频、文件名或批处理项目上传到 Batchora 服务器。媒体处理在你的设备本地完成。",
      section(
        "照片与视频",
        bullets([
          "“照片”权限用于读取所选原件、保存处理副本和可选的删除请求。",
          "压缩、缩放、转换、重命名、元数据调整和 ZIP 创建都在本地完成。",
          "相关流程结束后会移除临时导出文件，App 也会清理遗留会话。",
          "Batchora 永远不会自动删除原件。"
        ])
      ),
      section(
        "保存在设备上的数据",
        paragraph(
          "批处理项目、处理方案、预设、偏好与免费额度计数保存在 App 本地容器中。删除 App 会依照 iOS 标准行为移除其本地容器。"
        )
      ),
      section(
        "购买与支持",
        paragraph(
          "Apple 通过 StoreKit 处理 Batchora Pro 购买，Batchora 只接收权益状态，不获取完整付款信息。如果你发送支持邮件，支持邮箱会收到地址、邮件内容和你主动提供的信息。"
        )
      ),
      section(
        "网站分析",
        paragraph(
          "Batchora 网站计划使用 Cloudflare Web Analytics 统计汇总访问，不建立广告画像。正式上线前会按最终生产配置再次核对本政策。"
        )
      ),
      section(
        "联系",
        paragraph(
          '隐私问题请发送邮件至 <a href="mailto:jxstudio.apps@gmail.com?subject=Batchora%20Privacy">jxstudio.apps@gmail.com</a>。最后更新：2026 年 9 月 10 日。'
        )
      )
    )
  }),
  page({
    key: "terms",
    slug: "terms",
    title: "Batchora 使用条款",
    seoTitle: "Batchora 使用条款",
    description:
      "Batchora 使用 Apple 标准许可协议，并通过 Apple 账户管理自动续订订阅。",
    intent: "Batchora 使用条款",
    content: pageContent(
      "Batchora 使用 Apple 的标准许可应用最终用户许可协议。订阅通过 Apple 账户管理，并按 Apple 适用条款自动续订或取消。",
      section(
        "Apple 标准协议",
        paragraph(
          '请阅读 <a href="https://www.apple.com/legal/internet-services/itunes/dev/stdeula/" rel="noopener">Apple 标准 EULA</a>。除非另行提供有效协议，否则该协议约束 App 的许可使用。'
        )
      ),
      section(
        "订阅",
        paragraph(
          "Batchora Pro 是自动续订订阅。你可以在 App Store 账户设置中管理或取消，取消时间按 Apple 的订阅规则生效。"
        )
      )
    )
  }),
  page({
    key: "about",
    slug: "about",
    title: "关于 Batchora",
    seoTitle: "关于 Batchora",
    description:
      "Batchora 是一款 iPhone 照片视频批处理工具，坚持先保存成功副本，并让用户控制原件。",
    intent: "关于 Batchora",
    content: pageContent(
      "Batchora 是一款 iPhone 工具，用于简化重复的照片和视频准备工作：一次选择媒体、预览整批结果、创建成功副本，并保留对原件的控制。",
      section(
        "内容原则",
        paragraph(
          "本网站由 Batchora 团队维护。产品页和指南只描述已发布行为，不承诺固定压缩比例，并明确重要限制。App 功能或政策变化时会更新相关内容。"
        )
      ),
      section(
        "官方产品信息",
        bullets([
          "App：Batchora：照片视频批处理",
          "平台：iPhone，最低 iOS 17",
          "App Store ID：6810283756",
          "支持邮箱：jxstudio.apps@gmail.com"
        ])
      )
    )
  }),
  article({
    key: "guide-compress-photos",
    slug: "compress-photos-iphone",
    title: "如何在 iPhone 压缩照片并保留原件",
    seoTitle: "如何在 iPhone 压缩照片并保留原件",
    description:
      "通过调整尺寸、格式或画质创建更小的照片副本，同时保留对原件的控制。",
    intent: "iPhone 如何压缩照片",
    content: pageContent(
      "想在不替换原件的情况下压缩照片，可以导出尺寸更小、格式更高效或画质设置更低的新副本。Batchora 会先保存成功副本，不会自动删除所选原件。",
      heading("开始前先确定用途"),
      paragraph(
        "先考虑照片最终在哪里查看。用于聊天分享的图片通常不需要与打印或细节编辑相同的分辨率。"
      ),
      heading("操作步骤"),
      steps([
        "打开 Batchora 并选择照片。",
        "选择均衡、最小体积、高画质或自定义设置。",
        "按需限制最长边，并选择 HEIC 或 JPEG。",
        "预览文件名并开始处理。",
        "检查保存的副本，再决定是否请求删除任何原件。"
      ]),
      heading("为什么没有统一压缩比例"),
      paragraph(
        "高分辨率细节照片、已经压缩过的文件和简单截图会有不同结果。尺寸、格式与画质都会影响体积，因此无法对所有图片承诺同一个节省比例。"
      ),
      featureCta
    )
  }),
  article({
    key: "guide-reduce-video",
    slug: "reduce-video-file-size-iphone",
    title: "分享前如何减小 iPhone 视频文件体积",
    seoTitle: "分享前如何减小 iPhone 视频文件体积",
    description:
      "选择合适的分辨率和画质，生成更小的 MP4 视频副本，并在分享前检查结果。",
    intent: "iPhone 如何减小视频体积",
    content: pageContent(
      "分享 iPhone 视频前，可以按实际观看场景生成分辨率和画质更合适的新副本。Batchora 输出保留音频的 H.264 MP4，并保持所选原件不变。",
      heading("按分享目的选择"),
      paragraph(
        "用于聊天的短视频可能不需要源分辨率；准备在大屏幕播放的视频则需要更高设置。时长和画面运动仍会显著影响压缩后的大小。"
      ),
      heading("操作步骤"),
      steps([
        "在 Batchora 中选择视频。",
        "设置输出画质与分辨率。",
        "导出期间保持 App 打开。",
        "检查成功生成的 MP4 副本。",
        "分享副本，并根据自己的存储需求保留或处理原件。"
      ]),
      heading("结果仍然太大怎么办"),
      paragraph(
        "可以尝试更低分辨率或更小画质预设。Batchora 当前批量压缩流程不提供剪辑时长，需要时请先使用合适的视频编辑工具。"
      ),
      featureCta
    )
  }),
  article({
    key: "guide-heic-jpg",
    slug: "convert-heic-to-jpg-iphone",
    title: "如何在 iPhone 将 HEIC 转为 JPG",
    seoTitle: "如何在 iPhone 将 HEIC 转为 JPG",
    description:
      "把一张或整批 HEIC 转为兼容的 JPG 副本，并可同时调整尺寸和预览文件名。",
    intent: "iPhone 如何 HEIC 转 JPG",
    content: pageContent(
      "在 iPhone 将 HEIC 转为 JPG，可以先选择 HEIC 照片，把输出格式设为 JPEG，再设置画质和尺寸并导出新副本。Batchora 可以一次转换整批照片。",
      heading("为什么选择 JPEG"),
      paragraph(
        "JPEG 被网站、表单、聊天工具和非 Apple 设备广泛支持。HEIC 往往更节省空间，因此只有在兼容性或接收方要求时才需要转换。"
      ),
      heading("操作步骤"),
      steps([
        "在 Batchora 中选择 HEIC 照片。",
        "把输出格式设为 JPEG。",
        "选择图片画质和可选尺寸。",
        "预览整批文件名。",
        "导出并检查 JPG 副本。"
      ]),
      heading("合理理解画质"),
      paragraph(
        "格式转换不会增加源图细节。较高 JPEG 画质可以保留更多可见细节，但也可能产生更大的文件。"
      ),
      featureCta
    )
  }),
  article({
    key: "guide-remove-location",
    slug: "remove-photo-location-iphone",
    title: "如何从 iPhone 照片副本移除定位信息",
    seoTitle: "如何从 iPhone 照片副本移除定位信息",
    description:
      "在分享前创建不含 GPS 定位元数据的照片副本，并继续检查画面中可见的隐私信息。",
    intent: "iPhone 如何移除照片定位",
    content: pageContent(
      "分享前想移除照片定位，可以启用 GPS 清理并创建处理副本。Batchora Pro 会在 iPhone 本地完成修改，不会原地改变所选原件。",
      heading("操作步骤"),
      steps([
        "在 Batchora 中选择照片或整批媒体。",
        "打开元数据隐私控制。",
        "选择移除定位或更广泛的元数据清理。",
        "导出处理后的副本。",
        "分享前检查嵌入信息和画面中可见内容。"
      ]),
      heading("元数据只是隐私的一部分"),
      paragraph(
        "即使 GPS 已移除，地标、路牌、反射、证件、文字或人脸仍可能暴露地点或身份。需要时请使用合适的编辑工具裁切或遮挡可见信息。"
      ),
      featureCta
    )
  })
];
