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

function batchora_legal_links_shortcode() {
	$is_chinese = batchora_is_chinese();
	$links      = array(
		array(
			'url'   => batchora_page_url( 'home' ),
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
