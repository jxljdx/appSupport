<?php
/**
 * Sitemap, robots, and AI discovery endpoints.
 *
 * @package BatchoraSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_robots_directives( $robots ) {
	if ( is_search() || is_author() || is_tag() || is_category() || is_attachment() ) {
		$robots['noindex'] = true;
		unset( $robots['index'] );
	}

	return $robots;
}
add_filter( 'wp_robots', 'batchora_robots_directives' );

function batchora_disable_user_sitemap( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}
add_filter( 'wp_sitemaps_add_provider', 'batchora_disable_user_sitemap', 10, 2 );

function batchora_disable_taxonomy_sitemap( $taxonomies ) {
	unset( $taxonomies['category'], $taxonomies['post_tag'] );
	return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'batchora_disable_taxonomy_sitemap' );

function batchora_robots_txt( $output, $public ) {
	if ( ! $public ) {
		return "User-agent: *\nDisallow: /\n";
	}

	$rules = array(
		'User-agent: *',
		'Allow: /',
		'Disallow: /wp-admin/',
		'Allow: /wp-admin/admin-ajax.php',
		'',
		'# Search and answer retrieval crawlers are allowed.',
		'User-agent: OAI-SearchBot',
		'Allow: /',
		'User-agent: ChatGPT-User',
		'Allow: /',
		'User-agent: Claude-SearchBot',
		'Allow: /',
		'User-agent: PerplexityBot',
		'Allow: /',
		'',
		'# Dedicated model-training crawlers are not allowed.',
		'User-agent: GPTBot',
		'Disallow: /',
		'User-agent: ClaudeBot',
		'Disallow: /',
		'User-agent: Applebot-Extended',
		'Disallow: /',
		'User-agent: CCBot',
		'Disallow: /',
		'',
		'Sitemap: ' . home_url( '/wp-sitemap.xml' ),
	);

	return implode( "\n", $rules ) . "\n";
}
add_filter( 'robots_txt', 'batchora_robots_txt', 10, 2 );

function batchora_sitemap_status() {
	if ( get_query_var( 'sitemap' ) ) {
		status_header( 200 );
	}
}
add_action( 'template_redirect', 'batchora_sitemap_status', 0 );

function batchora_redirect_site_root() {
	if ( is_admin() || wp_doing_ajax() || ! is_front_page() ) {
		return;
	}

	$request_path = wp_parse_url(
		isset( $_SERVER['REQUEST_URI'] )
			? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) )
			: '/',
		PHP_URL_PATH
	);
	if ( '/' !== $request_path ) {
		return;
	}

	wp_safe_redirect( home_url( '/en/' ), 302 );
	exit;
}
add_action( 'template_redirect', 'batchora_redirect_site_root', 0 );

function batchora_register_discovery_routes() {
	add_rewrite_rule( '^llms\.txt$', 'index.php?batchora_llms=1', 'top' );
	add_rewrite_tag( '%batchora_llms%', '1' );
}
add_action( 'init', 'batchora_register_discovery_routes' );

function batchora_preserve_llms_url( $redirect_url ) {
	return get_query_var( 'batchora_llms' ) ? false : $redirect_url;
}
add_filter( 'redirect_canonical', 'batchora_preserve_llms_url' );

function batchora_discovery_activate() {
	batchora_register_discovery_routes();
	flush_rewrite_rules();
}
register_activation_hook(
	BATCHORA_SITE_PATH . 'batchora-site.php',
	'batchora_discovery_activate'
);

function batchora_output_llms_txt() {
	if ( ! get_query_var( 'batchora_llms' ) ) {
		return;
	}

	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 100,
			'meta_key'       => '_batchora_translation_key',
			'orderby'        => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
		)
	);

	header( 'Content-Type: text/plain; charset=utf-8' );
	echo "# Batchora\n\n";
	echo "> Official product information and guides for Batchora, an iPhone photo and video batch processing app.\n\n";
	echo "App Store: " . esc_url_raw( batchora_app_store_url() ) . "\n\n";
	foreach ( $pages as $page ) {
		$description = get_post_meta(
			$page->ID,
			'_batchora_seo_description',
			true
		);
		printf(
			"- [%s](%s): %s\n",
			wp_strip_all_tags( get_the_title( $page ) ),
			esc_url_raw( get_permalink( $page ) ),
			wp_strip_all_tags( $description )
		);
	}
	exit;
}
add_action( 'template_redirect', 'batchora_output_llms_txt' );
