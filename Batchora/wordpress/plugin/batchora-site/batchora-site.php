<?php
/**
 * Plugin Name: Batchora Site
 * Description: Product metadata and discovery behavior for the Batchora website.
 * Version: 1.0.0
 * Requires at least: 6.8
 * Requires PHP: 7.4
 * Author: Batchora
 * Text Domain: batchora-site
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BATCHORA_SITE_VERSION', '1.0.0' );
define( 'BATCHORA_APP_STORE_ID', '6810283756' );
define( 'BATCHORA_SITE_PATH', plugin_dir_path( __FILE__ ) );

require_once BATCHORA_SITE_PATH . 'includes/content.php';
require_once BATCHORA_SITE_PATH . 'includes/metadata.php';
require_once BATCHORA_SITE_PATH . 'includes/discovery.php';
require_once BATCHORA_SITE_PATH . 'includes/shortcodes.php';
require_once BATCHORA_SITE_PATH . 'includes/media.php';
require_once BATCHORA_SITE_PATH . 'includes/settings.php';

function batchora_site_register_meta() {
	$fields = array(
		'_batchora_locale',
		'_batchora_translation_key',
		'_batchora_seo_title',
		'_batchora_seo_description',
		'_batchora_target_intent',
		'_batchora_app_version',
	);

	foreach ( $fields as $field ) {
		register_post_meta(
			'',
			$field,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
add_action( 'init', 'batchora_site_register_meta' );

function batchora_site_register_blocks() {
	wp_register_script(
		'batchora-site-blocks',
		plugins_url( 'assets/blocks.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-server-side-render' ),
		BATCHORA_SITE_VERSION,
		true
	);

	register_block_type(
		'batchora/app-store-cta',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'attributes'      => array(
				'compact' => array(
					'type'    => 'boolean',
					'default' => false,
				),
			),
			'render_callback' => 'batchora_app_store_cta_block',
		)
	);
	register_block_type(
		'batchora/language-switcher',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_language_switcher_block',
		)
	);
	register_block_type(
		'batchora/primary-navigation',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_primary_navigation_block',
		)
	);
	register_block_type(
		'batchora/legal-links',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_legal_links_block',
		)
	);
	register_block_type(
		'batchora/footer-navigation',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_footer_navigation_block',
		)
	);
	register_block_type(
		'batchora/product-media',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_product_media_block',
		)
	);
	register_block_type(
		'batchora/home-hero',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_home_hero_block',
		)
	);
	register_block_type(
		'batchora/home-workflow',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_home_workflow_block',
		)
	);
	register_block_type(
		'batchora/feature-explorer',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_feature_explorer_block',
		)
	);
	register_block_type(
		'batchora/trust-panel',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_trust_panel_block',
		)
	);
	register_block_type(
		'batchora/feature-hero',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_feature_hero_block',
		)
	);
	register_block_type(
		'batchora/related-features',
		array(
			'api_version'     => 3,
			'editor_script'   => 'batchora-site-blocks',
			'render_callback' => 'batchora_related_features_block',
		)
	);
}
add_action( 'init', 'batchora_site_register_blocks' );
