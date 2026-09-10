<?php
/**
 * Reusable frontend blocks and shortcodes.
 *
 * @package BlueMorrowStudioSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bluemorrow_site_brand_block() {
	$is_chinese = batchora_is_chinese();

	return sprintf(
		'<a class="bluemorrow-brand" href="%1$s" aria-label="%2$s"><span class="bluemorrow-mark" aria-hidden="true"><span>B</span><span>M</span></span><span class="bluemorrow-wordmark">BlueMorrow <strong>Studio</strong></span></a>',
		esc_url( batchora_page_url( 'studio-home' ) ),
		esc_attr( $is_chinese ? 'BlueMorrow Studio 首页' : 'BlueMorrow Studio home' )
	);
}

function batchora_app_store_cta_shortcode( $attributes ) {
	if ( 'app' !== bluemorrow_page_scope() ) {
		return '';
	}

	$url = bluemorrow_app_store_url();
	if ( ! $url ) {
		return '';
	}

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
		esc_url( $url ),
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

function bluemorrow_navigation_links( $is_chinese, $scope ) {
	if ( 'studio' === $scope ) {
		return $is_chinese
			? array(
				'studio-home'    => '首页',
				'apps'           => 'App',
				'studio-about'   => '关于',
				'studio-support' => '支持',
			)
			: array(
				'studio-home'    => 'Home',
				'apps'           => 'Apps',
				'studio-about'   => 'About',
				'studio-support' => 'Support',
			);
	}

	return $is_chinese
		? array(
			'studio-home'      => 'Studio',
			'batchora-home'    => 'Batchora',
			'photo-compressor' => '照片',
			'video-compressor' => '视频',
			'guides'           => '指南',
			'support'          => '支持',
		)
		: array(
			'studio-home'      => 'Studio',
			'batchora-home'    => 'Batchora',
			'photo-compressor' => 'Photos',
			'video-compressor' => 'Videos',
			'guides'           => 'Guides',
			'support'          => 'Support',
		);
}

function batchora_primary_navigation_block() {
	$is_chinese = batchora_is_chinese();
	$current_key = batchora_translation_key();
	$scope       = bluemorrow_page_scope();
	$links       = bluemorrow_navigation_links( $is_chinese, $scope );
	$html        = array();

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
		'<div class="primary-navigation-shell"><button class="batchora-menu-toggle" type="button" aria-expanded="false" aria-controls="bluemorrow-primary-navigation" aria-label="%1$s"><span aria-hidden="true"></span><span aria-hidden="true"></span></button><nav id="bluemorrow-primary-navigation" class="primary-navigation" aria-label="%2$s">%3$s</nav></div>',
		esc_attr( $menu_label ),
		esc_attr( $nav_label ),
		implode( '', $html )
	);
}

function bluemorrow_footer_groups( $is_chinese, $scope ) {
	if ( 'studio' === $scope ) {
		return $is_chinese
			? array(
				'产品' => array(
					'apps'          => '所有 App',
					'batchora-home' => 'Batchora',
				),
				'Studio' => array(
					'studio-about'   => '关于',
					'studio-support' => '支持',
					'studio-privacy' => '网站隐私',
				),
			)
			: array(
				'Products' => array(
					'apps'          => 'All apps',
					'batchora-home' => 'Batchora',
				),
				'Studio' => array(
					'studio-about'   => 'About',
					'studio-support' => 'Support',
					'studio-privacy' => 'Website privacy',
				),
			);
	}

	return $is_chinese
		? array(
			'产品' => array(
				'photo-compressor' => '照片压缩',
				'video-compressor' => '视频压缩',
				'batch-rename'     => '批量重命名',
				'heic-to-jpg'      => 'HEIC 转 JPG',
			),
			'了解更多' => array(
				'guides' => '使用指南',
				'faq'    => '常见问题',
				'about'  => '关于 Batchora',
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
}

function batchora_footer_navigation_block() {
	$is_chinese = batchora_is_chinese();
	$groups     = bluemorrow_footer_groups(
		$is_chinese,
		bluemorrow_page_scope()
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

function bluemorrow_footer_brand_block() {
	$is_chinese = batchora_is_chinese();
	$scope      = bluemorrow_page_scope();
	$text       = 'studio' === $scope
		? (
			$is_chinese
				? '简单工具，用心打造。'
				: 'Simple tools, thoughtfully made.'
		)
		: (
			$is_chinese
				? '在 iPhone 本地完成照片与视频批处理。'
				: 'Private photo and video batch processing for iPhone.'
		);

	return '<div class="bluemorrow-footer-brand">' .
		bluemorrow_site_brand_block() .
		'<p>' . esc_html( $text ) . '</p>' .
		batchora_app_store_cta_block( array() ) .
		'</div>';
}

function batchora_legal_links_shortcode() {
	$is_chinese = batchora_is_chinese();
	$scope      = bluemorrow_page_scope();
	$link_map   = 'studio' === $scope
		? array(
			'studio-home'    => $is_chinese ? '首页' : 'Home',
			'studio-privacy' => $is_chinese ? '网站隐私' : 'Website privacy',
			'studio-support' => $is_chinese ? '支持' : 'Support',
		)
		: array(
			'batchora-home' => $is_chinese ? 'Batchora 首页' : 'Batchora home',
			'privacy'       => $is_chinese ? '隐私政策' : 'Privacy',
			'terms'         => $is_chinese ? '使用条款' : 'Terms',
			'support'       => $is_chinese ? '应用支持' : 'Support',
		);
	$links      = array();

	foreach ( $link_map as $key => $label ) {
		$url = batchora_page_url( $key );
		if ( $url ) {
			$links[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				esc_url( $url ),
				esc_html( $label )
			);
		}
	}

	return '<nav class="batchora-legal-links">' .
		implode( '', $links ) .
		'</nav>';
}
add_shortcode( 'batchora_legal_links', 'batchora_legal_links_shortcode' );

function batchora_legal_links_block() {
	return batchora_legal_links_shortcode();
}
