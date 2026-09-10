<?php
/**
 * Reusable frontend shortcodes.
 *
 * @package BatchoraSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_app_store_cta_shortcode( $attributes ) {
	$attributes = shortcode_atts(
		array( 'compact' => 'false' ),
		$attributes,
		'batchora_app_store_cta'
	);
	$is_chinese = batchora_is_chinese();
	$label      = $is_chinese ? '在 App Store 下载' : 'Download on the App Store';
	$class      = 'batchora-button';
	if ( 'true' === $attributes['compact'] ) {
		$class .= ' batchora-button--compact';
	}

	return sprintf(
		'<a class="%1$s" href="%2$s" rel="noopener">%3$s</a>',
		esc_attr( $class ),
		esc_url( batchora_app_store_url() ),
		esc_html( $label )
	);
}
add_shortcode( 'batchora_app_store_cta', 'batchora_app_store_cta_shortcode' );

function batchora_app_store_cta_block( $attributes ) {
	return batchora_app_store_cta_shortcode(
		array(
			'compact' => ! empty( $attributes['compact'] ) ? 'true' : 'false',
		)
	);
}

function batchora_language_switcher_shortcode() {
	$current_locale = batchora_current_locale();
	$links          = array();
	foreach (
		array(
			'en-US'   => 'English',
			'zh-Hans' => '中文',
		) as $locale => $label
	) {
		$current = $locale === $current_locale ? ' aria-current="page"' : '';
		$links[] = sprintf(
			'<a href="%1$s" hreflang="%2$s"%3$s>%4$s</a>',
			esc_url( batchora_translation_url( $locale ) ),
			esc_attr( $locale ),
			$current,
			esc_html( $label )
		);
	}

	return '<nav class="batchora-language" aria-label="Language">' .
		implode( '', $links ) .
		'</nav>';
}
add_shortcode(
	'batchora_language_switcher',
	'batchora_language_switcher_shortcode'
);

function batchora_language_switcher_block() {
	return batchora_language_switcher_shortcode();
}

function batchora_primary_navigation_block() {
	$is_chinese = batchora_is_chinese();
	$current_key = batchora_translation_key();
	$links      = $is_chinese
		? array(
			'batchora-home'    => '首页',
			'photo-compressor' => '照片压缩',
			'video-compressor' => '视频压缩',
			'guides'           => '使用指南',
			'support'          => '支持',
		)
		: array(
			'batchora-home'    => 'Home',
			'photo-compressor' => 'Photos',
			'video-compressor' => 'Videos',
			'guides'           => 'Guides',
			'support'          => 'Support',
		);
	$html       = array();

	foreach ( $links as $key => $label ) {
		$url = batchora_page_url( $key );
		if ( ! $url ) {
			continue;
		}
		$current = $key === $current_key ? ' aria-current="page"' : '';
		$html[] = sprintf(
			'<a href="%1$s"%2$s>%3$s</a>',
			esc_url( $url ),
			$current,
			esc_html( $label )
		);
	}

	$menu_label = $is_chinese ? '打开导航菜单' : 'Open navigation menu';
	$nav_label  = $is_chinese ? '主导航' : 'Primary navigation';

	return sprintf(
		'<div class="primary-navigation-shell"><button class="batchora-menu-toggle" type="button" aria-expanded="false" aria-controls="batchora-primary-navigation" aria-label="%1$s"><span aria-hidden="true"></span><span aria-hidden="true"></span></button><nav id="batchora-primary-navigation" class="primary-navigation" aria-label="%2$s">%3$s</nav></div>',
		esc_attr( $menu_label ),
		esc_attr( $nav_label ),
		implode( '', $html )
	);
}

function batchora_footer_navigation_block() {
	$is_chinese = batchora_is_chinese();
	$groups     = $is_chinese
		? array(
			'产品' => array(
				'photo-compressor' => '照片压缩',
				'video-compressor' => '视频压缩',
				'batch-rename'     => '批量重命名',
				'heic-to-jpg'      => 'HEIC 转 JPG',
			),
			'了解更多' => array(
				'guides'  => '使用指南',
				'faq'     => '常见问题',
				'about'   => '关于 Batchora',
			),
			'帮助' => array(
				'support' => '应用支持',
				'privacy' => '隐私政策',
				'terms'   => '使用条款',
			),
		)
		: array(
			'Product' => array(
				'photo-compressor' => 'Photo compression',
				'video-compressor' => 'Video compression',
				'batch-rename'     => 'Batch rename',
				'heic-to-jpg'      => 'HEIC to JPG',
			),
			'Learn' => array(
				'guides' => 'Guides',
				'faq'    => 'FAQ',
				'about'  => 'About Batchora',
			),
			'Help' => array(
				'support' => 'Support',
				'privacy' => 'Privacy',
				'terms'   => 'Terms',
			),
		);
	$html       = array();

	foreach ( $groups as $heading => $links ) {
		$items = array();
		foreach ( $links as $key => $label ) {
			$url = batchora_page_url( $key );
			if ( ! $url ) {
				continue;
			}
			$items[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				esc_url( $url ),
				esc_html( $label )
			);
		}
		if ( $items ) {
			$html[] = sprintf(
				'<div><h2>%1$s</h2>%2$s</div>',
				esc_html( $heading ),
				implode( '', $items )
			);
		}
	}

	return '<nav class="batchora-footer-navigation" aria-label="' .
		esc_attr( $is_chinese ? '页脚导航' : 'Footer navigation' ) .
		'">' . implode( '', $html ) . '</nav>';
}

function batchora_legal_links_shortcode() {
	$is_chinese = batchora_is_chinese();
	$links      = array(
		array(
			'url'   => batchora_page_url( 'batchora-home' ),
			'label' => $is_chinese ? '首页' : 'Home',
		),
	);

	foreach (
		array(
			'privacy' => $is_chinese ? '隐私政策' : 'Privacy',
			'terms'   => $is_chinese ? '使用条款' : 'Terms',
			'support' => $is_chinese ? '应用支持' : 'Support',
		) as $key => $label
	) {
		$url = batchora_page_url( $key );
		if ( $url ) {
			$links[] = array(
				'url'   => $url,
				'label' => $label,
			);
		}
	}

	$html = array_map(
		function( $link ) {
			return sprintf(
				'<a href="%s">%s</a>',
				esc_url( $link['url'] ),
				esc_html( $link['label'] )
			);
		},
		$links
	);

	return '<nav class="batchora-legal-links">' .
		implode( '', $html ) .
		'</nav>';
}
add_shortcode( 'batchora_legal_links', 'batchora_legal_links_shortcode' );

function batchora_legal_links_block() {
	return batchora_legal_links_shortcode();
}
