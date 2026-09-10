<?php
/**
 * Responsive product media.
 *
 * @package BatchoraSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_media_url( $relative_path ) {
	return get_theme_file_uri( 'assets/media/' . ltrim( $relative_path, '/' ) );
}

function batchora_responsive_picture( $locale, $name, $alt, $class = '', $options = array() ) {
	$base          = $locale . '/' . $name;
	$loading       = ! empty( $options['eager'] ) ? 'eager' : 'lazy';
	$fetchpriority = ! empty( $options['eager'] ) ? ' fetchpriority="high"' : '';
	$sizes         = ! empty( $options['sizes'] )
		? $options['sizes']
		: '(max-width: 700px) 78vw, 24vw';

	return sprintf(
		'<picture><source type="image/avif" srcset="%1$s 480w, %2$s 768w" sizes="%7$s"><source type="image/webp" srcset="%3$s 480w, %4$s 768w" sizes="%7$s"><img class="%5$s" src="%3$s" width="480" height="1039" loading="%8$s"%9$s decoding="async" alt="%6$s"></picture>',
		esc_url( batchora_media_url( $base . '-480.avif' ) ),
		esc_url( batchora_media_url( $base . '-768.avif' ) ),
		esc_url( batchora_media_url( $base . '-480.webp' ) ),
		esc_url( batchora_media_url( $base . '-768.webp' ) ),
		esc_attr( $class ),
		esc_attr( $alt ),
		esc_attr( $sizes ),
		esc_attr( $loading ),
		$fetchpriority
	);
}

function batchora_home_hero_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array(
			'eyebrow'   => 'Batchora iPhone 版',
			'heading'   => '照片和视频，一次批量搞定。',
			'lede'      => '压缩、重命名、改尺寸、格式转换与 ZIP 打包，全程在你的 iPhone 本地完成。',
			'explore'   => '观看 18 秒 App 预览',
			'proof_one' => '照片 + 视频',
			'proof_two' => '设备本地处理',
			'proof_three' => '无需注册账号',
			'photo'     => 'Batchora 照片批处理首页',
			'video'     => 'Batchora 视频压缩设置',
		)
		: array(
			'eyebrow'   => 'Batchora for iPhone',
			'heading'   => 'Process photos and videos in one clean batch.',
			'lede'      => 'Compress, rename, resize, convert, and package files into a ZIP—privately on your iPhone.',
			'explore'   => 'Watch the 18-second app preview',
			'proof_one' => 'Photos + videos',
			'proof_two' => 'On-device processing',
			'proof_three' => 'No account required',
			'photo'     => 'Batchora photo batch home screen',
			'video'     => 'Batchora video compression settings',
		);

	$photo = batchora_responsive_picture(
		$locale,
		'01-home',
		$labels['photo'],
		'batchora-hero-screen batchora-hero-screen--primary',
		array(
			'eager' => true,
			'sizes' => '(max-width: 800px) 72vw, 24rem',
		)
	);
	$video = batchora_responsive_picture(
		$locale,
		'03-video-compression',
		$labels['video'],
		'batchora-hero-screen batchora-hero-screen--secondary',
		array( 'sizes' => '(max-width: 800px) 48vw, 16rem' )
	);

	return sprintf(
		'<section class="batchora-home-hero alignwide"><div class="batchora-home-hero__copy"><p class="batchora-eyebrow">%1$s</p><h1 class="batchora-display">%2$s</h1><p class="batchora-lede">%3$s</p><div class="batchora-actions">%4$s<a class="batchora-text-link" href="#app-preview">%5$s</a></div><div class="batchora-proof" aria-label="%6$s"><span>%7$s</span><span>%8$s</span><span>%9$s</span></div></div><div class="batchora-home-hero__visual" aria-label="%10$s"><div class="batchora-hero-glow" aria-hidden="true"></div>%11$s%12$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		batchora_app_store_cta_block( array() ),
		esc_html( $labels['explore'] ),
		esc_attr( $is_chinese ? '产品特点' : 'Product highlights' ),
		esc_html( $labels['proof_one'] ),
		esc_html( $labels['proof_two'] ),
		esc_html( $labels['proof_three'] ),
		esc_attr( $is_chinese ? '真实 Batchora 界面' : 'Real Batchora interface' ),
		$photo,
		$video
	);
}

function batchora_home_workflow_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array(
			'eyebrow' => '清楚的批处理流程',
			'heading' => '选择一次，整批完成。',
			'lede'    => '每一步都可以预览和确认；Batchora 先生成成功副本，再把分享或原件操作交给你决定。',
			'items'   => array(
				array( '01', '选择', '选择照片或视频，不需要上传到服务器。', '02-photo-compression', '照片压缩设置界面' ),
				array( '02', '设置', '统一配置画质、尺寸、格式和新文件名。', '04-rename', '批量重命名预览界面' ),
				array( '03', '导出', '保存成功副本、分享文件，或打包为 ZIP。', '07-private-results', '批处理成功结果界面' ),
			),
		)
		: array(
			'eyebrow' => 'A clear batch workflow',
			'heading' => 'Choose once. Finish the whole batch.',
			'lede'    => 'Preview and confirm each step. Batchora creates successful copies first, then leaves sharing and original-file choices to you.',
			'items'   => array(
				array( '01', 'Select', 'Choose photos or videos without uploading them to a server.', '02-photo-compression', 'Photo compression settings' ),
				array( '02', 'Configure', 'Set quality, dimensions, format, and filenames for the batch.', '04-rename', 'Batch rename preview' ),
				array( '03', 'Export', 'Save successful copies, share files, or package one ZIP.', '07-private-results', 'Successful batch results' ),
			),
		);
	$items      = array();

	foreach ( $labels['items'] as $item ) {
		$items[] = sprintf(
			'<article class="batchora-workflow-card"><div class="batchora-workflow-card__media">%1$s</div><div class="batchora-workflow-card__copy"><span>%2$s</span><h3>%3$s</h3><p>%4$s</p></div></article>',
			batchora_responsive_picture(
				$locale,
				$item[3],
				$item[4],
				'batchora-workflow-screen',
				array( 'sizes' => '(max-width: 700px) 72vw, 19rem' )
			),
			esc_html( $item[0] ),
			esc_html( $item[1] ),
			esc_html( $item[2] )
		);
	}

	return sprintf(
		'<section class="batchora-section batchora-home-workflow alignwide"><div class="batchora-section-heading"><p class="batchora-eyebrow">%1$s</p><h2>%2$s</h2><p>%3$s</p></div><div class="batchora-workflow-grid">%4$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		implode( '', $items )
	);
}

function batchora_feature_explorer_block() {
	$is_chinese = batchora_is_chinese();
	$labels     = $is_chinese
		? array(
			'eyebrow' => '按你的任务开始',
			'heading' => '一套流程，处理更多重复工作。',
			'lede'    => '进入对应功能页，了解真实输出、限制和操作步骤。',
			'items'   => array(
				array( 'photo-compressor', '照片压缩', '控制画质、尺寸与 HEIC、JPEG 或 PNG 输出。', '照片' ),
				array( 'video-compressor', '视频压缩', '生成更易分享的 H.264 MP4 副本并保留音频。', '视频' ),
				array( 'batch-rename', '批量重命名', '组合文字、日期、原文件名和连续序号。', '命名' ),
				array( 'heic-to-jpg', '格式转换', '把 HEIC 转为 JPEG 或 PNG，并统一处理整批照片。', '格式' ),
				array( 'remove-metadata', '元数据控制', '从处理副本中移除定位或更完整的元数据。', '隐私' ),
				array( 'zip-photos', 'ZIP 打包', '保留预览过的文件名和顺序，合并为一份归档。', '导出' ),
			),
		)
		: array(
			'eyebrow' => 'Start with your task',
			'heading' => 'One workflow for repetitive media work.',
			'lede'    => 'Open a feature guide for the real output, limits, and steps.',
			'items'   => array(
				array( 'photo-compressor', 'Compress photos', 'Control quality, dimensions, and HEIC, JPEG, or PNG output.', 'Photos' ),
				array( 'video-compressor', 'Compress videos', 'Create share-ready H.264 MP4 copies while keeping audio.', 'Videos' ),
				array( 'batch-rename', 'Batch rename', 'Combine text, dates, original names, and sequence numbers.', 'Names' ),
				array( 'heic-to-jpg', 'Convert formats', 'Turn HEIC into JPEG or PNG across a whole photo selection.', 'Formats' ),
				array( 'remove-metadata', 'Control metadata', 'Remove location or broader metadata from processed copies.', 'Privacy' ),
				array( 'zip-photos', 'Package a ZIP', 'Keep previewed filenames and order in one archive.', 'Export' ),
			),
		);
	$items      = array();

	foreach ( $labels['items'] as $item ) {
		$url = batchora_page_url( $item[0] );
		if ( ! $url ) {
			continue;
		}
		$items[] = sprintf(
			'<a class="batchora-feature-card" href="%1$s"><span class="batchora-feature-card__label">%2$s</span><h3>%3$s</h3><p>%4$s</p><span class="batchora-feature-card__arrow" aria-hidden="true">↗</span></a>',
			esc_url( $url ),
			esc_html( $item[3] ),
			esc_html( $item[1] ),
			esc_html( $item[2] )
		);
	}

	return sprintf(
		'<section id="features" class="batchora-section batchora-feature-explorer alignwide"><div class="batchora-section-heading"><p class="batchora-eyebrow">%1$s</p><h2>%2$s</h2><p>%3$s</p></div><div class="batchora-feature-explorer__grid">%4$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		implode( '', $items )
	);
}

function batchora_product_media_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array(
			'eyebrow' => '18 秒真实演示',
			'heading' => '从选择到导出，一眼看完整流程。',
			'lede'    => '真实 App 界面、真实点击与本地处理流程。点击后视频会在原位置播放。',
			'play'    => '播放 18 秒 App 预览',
			'watch'   => '观看 App 预览',
			'badge'   => '18 秒',
			'loading' => '正在载入预览…',
			'manual'  => '预览已就绪，点击播放按钮开始。',
			'error'   => '预览暂时无法载入，请稍后重试。',
		)
		: array(
			'eyebrow' => 'An 18-second real demo',
			'heading' => 'See the workflow from selection to export.',
			'lede'    => 'Real app screens, real taps, and the on-device flow. The video plays in place when you choose it.',
			'play'    => 'Play the 18-second app preview',
			'watch'   => 'Watch the app preview',
			'badge'   => '18 sec',
			'loading' => 'Loading the preview…',
			'manual'  => 'The preview is ready. Press play to begin.',
			'error'   => 'The preview could not load. Please try again.',
		);

	$poster = batchora_responsive_picture(
		$locale,
		'preview-poster',
		$labels['play'],
		'batchora-preview-poster',
		array( 'sizes' => '(max-width: 800px) 86vw, 25rem' )
	);
	$video  = esc_url(
		batchora_media_url( $locale . '/batchora-app-preview.mp4' )
	);
	$poster_url = esc_url(
		batchora_media_url( $locale . '/preview-poster-480.webp' )
	);

	return sprintf(
		'<section id="app-preview" class="batchora-product-media alignwide" aria-labelledby="batchora-product-media-heading"><div class="batchora-product-media__copy"><p class="batchora-eyebrow">%1$s</p><h2 id="batchora-product-media-heading">%2$s</h2><p>%3$s</p><ul><li>%4$s</li><li>%5$s</li><li>%6$s</li></ul></div><div class="batchora-preview" data-loading-label="%12$s" data-manual-label="%13$s" data-error-label="%14$s"><span class="batchora-preview__duration">%7$s</span><button class="batchora-preview-trigger" type="button" aria-label="%8$s">%9$s<span>%8$s</span></button><video class="batchora-preview-video" controls playsinline preload="none" poster="%15$s" hidden data-src="%10$s"></video><p class="batchora-preview-status" aria-live="polite"></p><noscript><a href="%10$s">%11$s</a></noscript></div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		esc_html( $is_chinese ? '照片与视频批处理' : 'Photo and video batching' ),
		esc_html( $is_chinese ? '批量重命名与格式设置' : 'Batch naming and format controls' ),
		esc_html( $is_chinese ? '本地处理与副本优先' : 'On-device and copy-first' ),
		esc_html( $labels['badge'] ),
		esc_attr( $labels['play'] ),
		$poster,
		$video,
		esc_html( $labels['watch'] ),
		esc_attr( $labels['loading'] ),
		esc_attr( $labels['manual'] ),
		esc_attr( $labels['error'] ),
		$poster_url
	);
}

function batchora_trust_panel_block() {
	$is_chinese = batchora_is_chinese();
	$labels     = $is_chinese
		? array(
			'eyebrow' => '你的媒体，由你掌控',
			'heading' => '本地处理。先保存副本。删除前再次确认。',
			'lede'    => 'Batchora 不要求账号，也不会把所选照片、视频、文件名或批处理项目上传到自己的服务器。',
			'facts'   => array(
				array( '01', '设备本地处理', '照片与视频处理在你的 iPhone 上完成。' ),
				array( '02', '先生成成功副本', '原件不会被静默覆盖。' ),
				array( '03', '删除由你确认', '只有你主动请求并确认 Apple 系统提示后才会继续。' ),
			),
		)
		: array(
			'eyebrow' => 'Your media stays under your control',
			'heading' => 'On device. Copies first. Confirmation before deletion.',
			'lede'    => 'Batchora requires no account and does not upload selected photos, videos, filenames, or batch projects to its own servers.',
			'facts'   => array(
				array( '01', 'Processed on device', 'Photo and video work happens on your iPhone.' ),
				array( '02', 'Successful copies first', 'Originals are never silently replaced.' ),
				array( '03', 'Deletion needs confirmation', 'Nothing continues until you request it and confirm Apple’s prompt.' ),
			),
		);
	$facts      = array_map(
		function( $fact ) {
			return sprintf(
				'<div class="batchora-trust-fact"><span>%1$s</span><h3>%2$s</h3><p>%3$s</p></div>',
				esc_html( $fact[0] ),
				esc_html( $fact[1] ),
				esc_html( $fact[2] )
			);
		},
		$labels['facts']
	);

	return sprintf(
		'<section class="batchora-section batchora-trust-panel alignwide"><div class="batchora-trust-panel__copy"><p class="batchora-eyebrow">%1$s</p><h2>%2$s</h2><p>%3$s</p></div><div class="batchora-trust-panel__facts">%4$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		implode( '', $facts )
	);
}

function batchora_feature_page_config( $key, $is_chinese ) {
	$configs = $is_chinese
		? array(
			'photo-compressor' => array( '照片压缩', '控制整批照片的画质、尺寸和输出格式。', '02-photo-compression', array( 'HEIC / JPEG / PNG', '画质与尺寸', '副本优先' ) ),
			'video-compressor' => array( '视频压缩', '生成更易保存和分享的 H.264 MP4 视频副本。', '03-video-compression', array( 'H.264 MP4', '保留音频', '分辨率选择' ) ),
			'batch-rename'     => array( '批量重命名', '导出前预览文字、日期、原文件名与连续序号。', '04-rename', array( '完整预览', '顺序编号', '保留导出顺序' ) ),
			'heic-to-jpg'      => array( '格式转换', '把整批 HEIC 照片转换为 JPEG 或 PNG 副本。', '05-format-resize', array( 'HEIC 转 JPEG', 'PNG 输出', '整批统一设置' ) ),
			'resize-images'    => array( '照片改尺寸', '按最长边或比例统一调整整批照片尺寸。', '05-format-resize', array( '最长边限制', '比例缩放', '画质可控' ) ),
			'remove-metadata'  => array( '元数据控制', '从处理副本中移除定位或更多照片元数据。', '06-privacy-zip', array( '移除定位', '副本处理', 'Pro 功能' ) ),
			'zip-photos'       => array( 'ZIP 打包', '把成功处理的文件按预览名称和顺序打包分享。', '06-privacy-zip', array( '一份 ZIP', '保留文件名', '保持顺序' ) ),
		)
		: array(
			'photo-compressor' => array( 'Photo compression', 'Control quality, dimensions, and output format across a photo batch.', '02-photo-compression', array( 'HEIC / JPEG / PNG', 'Quality and size', 'Copies first' ) ),
			'video-compressor' => array( 'Video compression', 'Create H.264 MP4 copies that are easier to store and share.', '03-video-compression', array( 'H.264 MP4', 'Audio kept', 'Resolution choices' ) ),
			'batch-rename'     => array( 'Batch rename', 'Preview text, dates, original names, and sequence numbers before export.', '04-rename', array( 'Full preview', 'Sequence numbers', 'Export order kept' ) ),
			'heic-to-jpg'      => array( 'Format conversion', 'Convert a whole HEIC selection into JPEG or PNG copies.', '05-format-resize', array( 'HEIC to JPEG', 'PNG output', 'One batch setting' ) ),
			'resize-images'    => array( 'Photo resizing', 'Resize a photo batch by longest edge or percentage.', '05-format-resize', array( 'Longest edge', 'Percentage resize', 'Quality control' ) ),
			'remove-metadata'  => array( 'Metadata control', 'Remove location or broader photo metadata from processed copies.', '06-privacy-zip', array( 'Remove location', 'Copy-based', 'Pro feature' ) ),
			'zip-photos'       => array( 'ZIP packaging', 'Package successful files using the names and order you previewed.', '06-privacy-zip', array( 'One ZIP', 'Names preserved', 'Order preserved' ) ),
		);

	return isset( $configs[ $key ] ) ? $configs[ $key ] : array();
}

function batchora_feature_hero_block() {
	$is_chinese = batchora_is_chinese();
	$key        = batchora_translation_key();
	$config     = batchora_feature_page_config( $key, $is_chinese );
	if ( ! $config ) {
		return '';
	}

	$locale      = $is_chinese ? 'zh-Hans' : 'en-US';
	$title       = get_the_title();
	$description = get_post_meta( get_queried_object_id(), '_bluemorrow_seo_description', true );
	$chips       = array_map(
		function( $label ) {
			return '<span>' . esc_html( $label ) . '</span>';
		},
		$config[3]
	);
	$picture     = batchora_responsive_picture(
		$locale,
		$config[2],
		$title,
		'batchora-feature-hero__screen',
		array(
			'eager' => true,
			'sizes' => '(max-width: 800px) 72vw, 22rem',
		)
	);

	return sprintf(
		'<section class="batchora-feature-hero alignwide"><div class="batchora-feature-hero__copy"><nav class="batchora-breadcrumb" aria-label="%1$s"><a href="%2$s">%3$s</a><span aria-hidden="true">/</span><span aria-current="page">%4$s</span></nav><p class="batchora-eyebrow">%5$s</p><h1>%6$s</h1><p class="batchora-lede">%7$s</p><div class="batchora-actions">%8$s<a class="batchora-text-link" href="#feature-details">%9$s</a></div><div class="batchora-proof">%10$s</div></div><div class="batchora-feature-hero__visual">%11$s</div></section>',
		esc_attr( $is_chinese ? '面包屑' : 'Breadcrumb' ),
		esc_url( batchora_page_url( 'home' ) ),
		esc_html( $is_chinese ? '首页' : 'Home' ),
		esc_html( $config[0] ),
		esc_html( $config[0] ),
		esc_html( $title ),
		esc_html( $description ? $description : $config[1] ),
		batchora_app_store_cta_block( array() ),
		esc_html( $is_chinese ? '了解工作方式' : 'See how it works' ),
		implode( '', $chips ),
		$picture
	);
}

function batchora_related_features_block() {
	$is_chinese = batchora_is_chinese();
	$current    = batchora_translation_key();
	$items      = $is_chinese
		? array(
			'photo-compressor' => array( '照片压缩', '控制画质和输出格式。' ),
			'video-compressor' => array( '视频压缩', '生成更易分享的 MP4 副本。' ),
			'batch-rename'     => array( '批量重命名', '导出前预览整批文件名。' ),
			'heic-to-jpg'      => array( '格式转换', '把 HEIC 转为 JPEG 或 PNG。' ),
			'remove-metadata'  => array( '元数据控制', '从副本中移除定位信息。' ),
			'zip-photos'       => array( 'ZIP 打包', '把成功结果合并为一份归档。' ),
		)
		: array(
			'photo-compressor' => array( 'Compress photos', 'Control quality and output format.' ),
			'video-compressor' => array( 'Compress videos', 'Create more shareable MP4 copies.' ),
			'batch-rename'     => array( 'Batch rename', 'Preview every filename before export.' ),
			'heic-to-jpg'      => array( 'Convert formats', 'Turn HEIC into JPEG or PNG.' ),
			'remove-metadata'  => array( 'Control metadata', 'Remove location data from copies.' ),
			'zip-photos'       => array( 'Package a ZIP', 'Combine successful results in one archive.' ),
		);
	unset( $items[ $current ] );
	$cards = array();

	foreach ( array_slice( $items, 0, 3, true ) as $key => $item ) {
		$url = batchora_page_url( $key );
		if ( ! $url ) {
			continue;
		}
		$cards[] = sprintf(
			'<a class="batchora-related-card" href="%1$s"><h3>%2$s</h3><p>%3$s</p><span aria-hidden="true">↗</span></a>',
			esc_url( $url ),
			esc_html( $item[0] ),
			esc_html( $item[1] )
		);
	}

	return sprintf(
		'<section class="batchora-related-features alignwide"><div><p class="batchora-eyebrow">%1$s</p><h2>%2$s</h2></div><div class="batchora-related-features__grid">%3$s</div></section>',
		esc_html( $is_chinese ? '继续探索' : 'Keep exploring' ),
		esc_html( $is_chinese ? '下一项批处理任务' : 'Your next batch task' ),
		implode( '', $cards )
	);
}
