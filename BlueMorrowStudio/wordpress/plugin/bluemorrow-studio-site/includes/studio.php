<?php
/**
 * BlueMorrow Studio marketing components.
 *
 * @package BlueMorrowStudioSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bluemorrow_studio_home_hero_block() {
	$is_chinese = batchora_is_chinese();
	$labels     = $is_chinese
		? array(
			'eyebrow' => 'BlueMorrow Studio',
			'heading' => '简单工具，用心打造。',
			'lede'    => '为日常重复任务打造清晰、克制并从一开始就考虑隐私的 App。',
			'primary' => '查看 App',
			'about'   => '了解 Studio',
			'proofs'  => array( '专注真实任务', '清晰而克制', '隐私始于设计' ),
		)
		: array(
			'eyebrow' => 'BlueMorrow Studio',
			'heading' => 'Simple tools, thoughtfully made.',
			'lede'    => 'Focused apps for everyday tasks, with clear controls and privacy considered from the start.',
			'primary' => 'Explore our apps',
			'about'   => 'About the studio',
			'proofs'  => array( 'Focused on real tasks', 'Clear by design', 'Privacy considered' ),
		);

	return sprintf(
		'<section class="bluemorrow-studio-hero alignwide"><div class="bluemorrow-studio-hero__copy"><p class="batchora-eyebrow">%1$s</p><h1>%2$s</h1><p class="bluemorrow-studio-hero__lede">%3$s</p><div class="batchora-actions"><a class="batchora-button" href="%4$s">%5$s</a><a class="batchora-text-link" href="%6$s">%7$s</a></div><div class="bluemorrow-studio-proof"><span>%8$s</span><span>%9$s</span><span>%10$s</span></div></div><div class="bluemorrow-studio-hero__visual" aria-hidden="true"><div class="bluemorrow-orbit bluemorrow-orbit--one"></div><div class="bluemorrow-orbit bluemorrow-orbit--two"></div><div class="bluemorrow-hero-mark"><span>B</span><span>M</span></div></div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		esc_url( batchora_page_url( 'apps' ) ),
		esc_html( $labels['primary'] ),
		esc_url( batchora_page_url( 'studio-about' ) ),
		esc_html( $labels['about'] ),
		esc_html( $labels['proofs'][0] ),
		esc_html( $labels['proofs'][1] ),
		esc_html( $labels['proofs'][2] )
	);
}

function bluemorrow_studio_page_hero_block() {
	$is_chinese = batchora_is_chinese();
	$key        = batchora_translation_key();
	$configs    = $is_chinese
		? array(
			'apps' => array( 'App', '专注解决真实任务的产品。', '每款 App 都有独立的功能、支持和隐私说明。' ),
			'studio-about' => array( '关于 Studio', '从真实任务开始。', '我们重视清晰体验、准确说明，以及用户对自己文件和选择的控制。' ),
			'studio-privacy' => array( '网站隐私', '只收集运营网站所需的最少信息。', 'App 的数据处理方式由各自独立的隐私政策说明。' ),
			'studio-support' => array( '支持', '为你使用的 App 找到准确帮助。', '选择产品，查看对应的操作说明、隐私信息和故障排查。' ),
		)
		: array(
			'apps' => array( 'Apps', 'Focused products for real tasks.', 'Each app has its own capabilities, support, and privacy details.' ),
			'studio-about' => array( 'About the studio', 'Start with the real task.', 'We value clear experiences, accurate explanations, and user control over files and choices.' ),
			'studio-privacy' => array( 'Website privacy', 'Only the information needed to operate the site.', 'Each app explains its own data handling in a separate product privacy policy.' ),
			'studio-support' => array( 'Support', 'Find accurate help for the app you use.', 'Choose a product for its instructions, privacy details, and troubleshooting.' ),
		);
	if ( empty( $configs[ $key ] ) ) {
		return '';
	}

	$config = $configs[ $key ];
	return sprintf(
		'<section class="bluemorrow-page-hero alignwide"><p class="batchora-eyebrow">%1$s</p><h1>%2$s</h1><p>%3$s</p></section>',
		esc_html( $config[0] ),
		esc_html( $config[1] ),
		esc_html( $config[2] )
	);
}

function bluemorrow_batchora_icon() {
	return sprintf(
		'<picture><source type="image/avif" srcset="%1$s 128w, %2$s 256w"><source type="image/webp" srcset="%3$s 128w, %4$s 256w"><img src="%3$s" width="128" height="128" loading="lazy" decoding="async" alt=""></picture>',
		esc_url( batchora_media_url( 'app-icon-128.avif' ) ),
		esc_url( batchora_media_url( 'app-icon-256.avif' ) ),
		esc_url( batchora_media_url( 'app-icon-128.webp' ) ),
		esc_url( batchora_media_url( 'app-icon-256.webp' ) )
	);
}

function bluemorrow_studio_apps_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array(
			'eyebrow' => '现已推出',
			'heading' => '认识 Batchora',
			'lede'    => '把照片和视频压缩、重命名、改尺寸、转换与 ZIP 导出放进一个清晰的 iPhone 批处理流程。',
			'open'    => '查看 Batchora',
			'store'   => '前往 App Store',
			'alt'     => 'Batchora 照片批处理界面',
			'features' => array( '照片与视频', '设备本地处理', '批量导出' ),
		)
		: array(
			'eyebrow' => 'Available now',
			'heading' => 'Meet Batchora',
			'lede'    => 'Compress, rename, resize, convert, and package photos and videos in one clear iPhone batch workflow.',
			'open'    => 'Explore Batchora',
			'store'   => 'View on the App Store',
			'alt'     => 'Batchora photo batch interface',
			'features' => array( 'Photos + videos', 'On-device processing', 'Batch export' ),
		);

	$screen = batchora_responsive_picture(
		$locale,
		'01-home',
		$labels['alt'],
		'bluemorrow-app-card__screen',
		array( 'sizes' => '(max-width: 800px) 68vw, 22rem' )
	);

	return sprintf(
		'<section class="bluemorrow-app-showcase alignwide"><div class="bluemorrow-app-showcase__heading"><p class="batchora-eyebrow">%1$s</p><h2>%2$s</h2><p>%3$s</p></div><article class="bluemorrow-app-card"><div class="bluemorrow-app-card__copy"><div class="bluemorrow-app-card__identity">%4$s<div><strong>Batchora</strong><span>Photo &amp; Video</span></div></div><div class="bluemorrow-app-card__features"><span>%5$s</span><span>%6$s</span><span>%7$s</span></div><div class="batchora-actions"><a class="batchora-button" href="%8$s">%9$s</a><a class="batchora-text-link" href="%10$s" rel="noopener">%11$s</a></div></div><div class="bluemorrow-app-card__visual"><div class="bluemorrow-app-card__glow" aria-hidden="true"></div>%12$s</div></article></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		bluemorrow_batchora_icon(),
		esc_html( $labels['features'][0] ),
		esc_html( $labels['features'][1] ),
		esc_html( $labels['features'][2] ),
		esc_url( batchora_page_url( 'batchora-home' ) ),
		esc_html( $labels['open'] ),
		esc_url( bluemorrow_app_store_url( 'batchora' ) ),
		esc_html( $labels['store'] ),
		$screen
	);
}

function bluemorrow_studio_principles_block() {
	$is_chinese = batchora_is_chinese();
	$labels     = $is_chinese
		? array(
			'eyebrow' => '我们的原则',
			'heading' => '让工具安静地把事情做好。',
			'items'   => array(
				array( '01', '清晰而克制', '优先呈现任务和选择，不用多余界面制造复杂感。' ),
				array( '02', '隐私始于设计', '在产品允许的情况下，让处理留在设备，并准确说明边界。' ),
				array( '03', '真实而有用', '不使用无法保证的数字、效果或功能承诺。' ),
			),
		)
		: array(
			'eyebrow' => 'How we work',
			'heading' => 'Tools that quietly get the job done.',
			'items'   => array(
				array( '01', 'Clear by design', 'Put the task and its choices first instead of adding interface for its own sake.' ),
				array( '02', 'Privacy considered', 'Keep work on device when the product allows it, and explain the boundaries accurately.' ),
				array( '03', 'Useful and honest', 'Avoid numbers, outcomes, or capabilities the software cannot reliably promise.' ),
			),
		);
	$items      = array();

	foreach ( $labels['items'] as $item ) {
		$items[] = sprintf(
			'<article><span>%1$s</span><h3>%2$s</h3><p>%3$s</p></article>',
			esc_html( $item[0] ),
			esc_html( $item[1] ),
			esc_html( $item[2] )
		);
	}

	return sprintf(
		'<section class="bluemorrow-principles alignwide"><div class="batchora-section-heading"><p class="batchora-eyebrow">%1$s</p><h2>%2$s</h2></div><div class="bluemorrow-principles__grid">%3$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		implode( '', $items )
	);
}

function bluemorrow_studio_support_block() {
	$is_chinese = batchora_is_chinese();
	$labels     = $is_chinese
		? array(
			'heading' => 'Batchora 支持',
			'text'    => '查看照片与视频处理、导出、订阅、隐私和常见问题帮助。',
			'support' => '打开支持页面',
			'privacy' => '查看隐私政策',
		)
		: array(
			'heading' => 'Batchora support',
			'text'    => 'Find help for photo and video processing, exports, subscriptions, privacy, and common issues.',
			'support' => 'Open support',
			'privacy' => 'Read the privacy policy',
		);

	return sprintf(
		'<section class="bluemorrow-support-card alignwide">%1$s<div><h2>%2$s</h2><p>%3$s</p><div class="batchora-actions"><a class="batchora-button" href="%4$s">%5$s</a><a class="batchora-text-link" href="%6$s">%7$s</a></div></div></section>',
		bluemorrow_batchora_icon(),
		esc_html( $labels['heading'] ),
		esc_html( $labels['text'] ),
		esc_url( batchora_page_url( 'support' ) ),
		esc_html( $labels['support'] ),
		esc_url( batchora_page_url( 'privacy' ) ),
		esc_html( $labels['privacy'] )
	);
}
