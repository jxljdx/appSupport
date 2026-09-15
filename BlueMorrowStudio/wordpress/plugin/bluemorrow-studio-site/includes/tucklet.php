<?php
/**
 * Tucklet product blocks.
 *
 * @package BlueMorrowStudioSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tucklet_home_hero_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array(
			'eyebrow' => 'Tucklet iPhone 版',
			'heading' => '临时信息，留到不再需要。',
			'lede'    => '粘贴重要细节，设置到期时间；需要时随手可用，到期后自动永久删除。',
			'proofs'  => array( '主动粘贴收好', '到期自动删除', '本地加密存储' ),
			'main_alt' => 'Tucklet 到期自动删除界面',
			'secondary_alt' => 'Tucklet 粘贴临时信息界面',
		)
		: array(
			'eyebrow' => 'Tucklet for iPhone',
			'heading' => 'Keep temporary details until you do not need them.',
			'lede'    => 'Paste the details that matter, set an expiry, and keep them useful until Tucklet permanently removes them.',
			'proofs'  => array( 'Paste with intent', 'Automatic deletion', 'Encrypted on device' ),
			'main_alt' => 'Tucklet automatic deletion screen',
			'secondary_alt' => 'Tucklet paste temporary information screen',
		);

	$main = batchora_responsive_picture(
		$locale,
		'01-auto-delete',
		$labels['main_alt'],
		'tucklet-hero-screen tucklet-hero-screen--primary',
		array( 'eager' => true, 'sizes' => '(max-width: 800px) 72vw, 24rem' )
	);
	$secondary = batchora_responsive_picture(
		$locale,
		'02-fast-capture',
		$labels['secondary_alt'],
		'tucklet-hero-screen tucklet-hero-screen--secondary',
		array( 'sizes' => '(max-width: 800px) 48vw, 16rem' )
	);

	return sprintf(
		'<section class="tucklet-home-hero alignwide"><div class="tucklet-home-hero__copy"><p class="tucklet-eyebrow">%1$s</p><h1 class="tucklet-display">%2$s</h1><p class="tucklet-lede">%3$s</p><div class="batchora-actions">%4$s</div><div class="tucklet-proof" aria-label="%5$s"><span>%6$s</span><span>%7$s</span><span>%8$s</span></div></div><div class="tucklet-home-hero__visual" aria-label="%9$s"><div class="tucklet-hero-glow" aria-hidden="true"></div>%10$s%11$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		batchora_app_store_cta_block( array() ),
		esc_attr( $is_chinese ? 'Tucklet 产品特点' : 'Tucklet product highlights' ),
		esc_html( $labels['proofs'][0] ),
		esc_html( $labels['proofs'][1] ),
		esc_html( $labels['proofs'][2] ),
		esc_attr( $is_chinese ? '真实 Tucklet 界面' : 'Real Tucklet interface' ),
		$main,
		$secondary
	);
}

function tucklet_workflow_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array(
			'eyebrow' => '只留到需要为止',
			'heading' => '收好、使用、放心忘掉。',
			'lede'    => 'Tucklet 把临时信息留在一个清楚的本地流程里，直到你选择的到期时间。',
			'items'   => array(
				array( '01', '粘贴', '在你主动操作后，从剪贴板收好一段临时信息。', '02-fast-capture', 'Tucklet 粘贴信息界面' ),
				array( '02', '设定到期', '选一个删除时间；到期后，信息会从 Tucklet 中永久移除。', '01-auto-delete', 'Tucklet 到期删除设置' ),
				array( '03', '随手使用', '复制识别出的代码，并使用可用的电话、邮箱或地址详情。', '03-useful-actions', 'Tucklet 实用详情操作' ),
			),
		)
		: array(
			'eyebrow' => 'Keep it only while it matters',
			'heading' => 'Tuck it away. Use it. Let it go.',
			'lede'    => 'Tucklet keeps temporary information in one clear, local flow until the expiry time you choose.',
			'items'   => array(
				array( '01', 'Paste', 'Deliberately tuck away temporary information from your clipboard.', '02-fast-capture', 'Tucklet paste capture screen' ),
				array( '02', 'Set an expiry', 'Choose a deletion time; when it expires, the detail is permanently removed from Tucklet.', '01-auto-delete', 'Tucklet expiry settings' ),
				array( '03', 'Use the detail', 'Copy detected codes and use available phone, email, or address details.', '03-useful-actions', 'Tucklet useful detail actions' ),
			),
		);
	$items      = array();

	foreach ( $labels['items'] as $item ) {
		$items[] = sprintf(
			'<article class="tucklet-workflow-card"><div class="tucklet-workflow-card__media">%1$s</div><div class="tucklet-workflow-card__copy"><span>%2$s</span><h3>%3$s</h3><p>%4$s</p></div></article>',
			batchora_responsive_picture(
				$locale,
				$item[3],
				$item[4],
				'tucklet-workflow-screen',
				array( 'sizes' => '(max-width: 700px) 72vw, 19rem' )
			),
			esc_html( $item[0] ),
			esc_html( $item[1] ),
			esc_html( $item[2] )
		);
	}

	return sprintf(
		'<section class="tucklet-section tucklet-workflow alignwide"><div class="batchora-section-heading"><p class="tucklet-eyebrow">%1$s</p><h2>%2$s</h2><p>%3$s</p></div><div class="tucklet-workflow-grid">%4$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		implode( '', $items )
	);
}

function tucklet_screenshot_gallery_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array( 'eyebrow' => '真实界面', 'heading' => '每个细节，都有清楚的去处。', 'lede' => '从粘贴、到期和提醒，到私密内容与可用信息，查看真实 Tucklet 界面。' )
		: array( 'eyebrow' => 'Real app screens', 'heading' => 'Every temporary detail has a clear place.', 'lede' => 'See Tucklet’s real flow for pasting, expiry, reminders, confidential content, and useful details.' );
	$names      = array(
		'01-auto-delete',
		'02-fast-capture',
		'03-useful-actions',
		'04-confidential',
		'05-expiry-reminders',
	);
	$pictures   = array();

	foreach ( $names as $index => $name ) {
		$pictures[] = batchora_responsive_picture(
			$locale,
			$name,
			$is_chinese ? 'Tucklet 功能界面' : 'Tucklet feature screen',
			'tucklet-media-card',
			array( 'sizes' => '(max-width: 700px) 72vw, 18rem', 'eager' => 0 === $index )
		);
	}

	return sprintf(
		'<section class="tucklet-section tucklet-gallery alignwide"><div class="batchora-section-heading"><p class="tucklet-eyebrow">%1$s</p><h2>%2$s</h2><p>%3$s</p></div><div class="tucklet-media-gallery">%4$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		implode( '', $pictures )
	);
}

function tucklet_trust_panel_block() {
	$is_chinese = batchora_is_chinese();
	$labels     = $is_chinese
		? array(
			'eyebrow' => '由你掌控',
			'heading' => '临时，不代表轻率。',
			'lede'    => 'Tucklet 专为暂时需要的信息设计：本地加密、可选设备认证，以及由你设定的到期和提醒。',
			'facts'   => array(
				array( '01', '本地加密存储', '详情会加密保存在你的设备上。' ),
				array( '02', '私密内容按需打开', '标为保密的信息会要求设备认证后才显示内容。' ),
				array( '03', '到期前提醒', '为还需要处理的详情开启到期提醒。' ),
			),
		)
		: array(
			'eyebrow' => 'Under your control',
			'heading' => 'Temporary should not mean careless.',
			'lede'    => 'Tucklet is designed for details you need briefly: encrypted local storage, optional device authentication, and the expiry and reminders you choose.',
			'facts'   => array(
				array( '01', 'Encrypted local storage', 'Details are encrypted and stored on your device.' ),
				array( '02', 'Reveal confidential content when needed', 'Confidential details require device authentication before their content is shown.' ),
				array( '03', 'Remember before it expires', 'Turn on an expiry reminder for a detail you still need to act on.' ),
			),
		);
	$facts      = array();

	foreach ( $labels['facts'] as $fact ) {
		$facts[] = sprintf(
			'<article class="tucklet-trust-fact"><span>%1$s</span><h3>%2$s</h3><p>%3$s</p></article>',
			esc_html( $fact[0] ),
			esc_html( $fact[1] ),
			esc_html( $fact[2] )
		);
	}

	return sprintf(
		'<section class="tucklet-trust-panel alignwide"><div class="tucklet-trust-panel__copy"><p class="tucklet-eyebrow">%1$s</p><h2>%2$s</h2><p>%3$s</p></div><div class="tucklet-trust-panel__facts">%4$s</div></section>',
		esc_html( $labels['eyebrow'] ),
		esc_html( $labels['heading'] ),
		esc_html( $labels['lede'] ),
		implode( '', $facts )
	);
}
