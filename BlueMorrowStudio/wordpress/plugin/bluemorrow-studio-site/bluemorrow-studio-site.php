<?php
/**
 * Plugin Name: BlueMorrow Studio Site
 * Description: Product metadata and discovery behavior for the BlueMorrow Studio website.
 * Version: 1.0.0
 * Requires at least: 6.8
 * Requires PHP: 7.4
 * Author: BlueMorrow Studio
 * Text Domain: bluemorrow-studio-site
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BLUEMORROW_SITE_VERSION', '1.0.0' );
define( 'BLUEMORROW_SITE_PATH', plugin_dir_path( __FILE__ ) );

require_once BLUEMORROW_SITE_PATH . 'includes/apps.php';
require_once BLUEMORROW_SITE_PATH . 'includes/content.php';
require_once BLUEMORROW_SITE_PATH . 'includes/metadata.php';
require_once BLUEMORROW_SITE_PATH . 'includes/discovery.php';
require_once BLUEMORROW_SITE_PATH . 'includes/shortcodes.php';
require_once BLUEMORROW_SITE_PATH . 'includes/media.php';
require_once BLUEMORROW_SITE_PATH . 'includes/studio.php';
require_once BLUEMORROW_SITE_PATH . 'includes/settings.php';

function bluemorrow_site_register_meta() {
	$fields = array(
		'_bluemorrow_locale',
		'_bluemorrow_translation_key',
		'_bluemorrow_seo_title',
		'_bluemorrow_seo_description',
		'_bluemorrow_target_intent',
		'_bluemorrow_app_version',
		'_bluemorrow_scope',
		'_bluemorrow_app_key',
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
add_action( 'init', 'bluemorrow_site_register_meta' );

function bluemorrow_site_register_blocks() {
	wp_register_script(
		'bluemorrow-site-blocks',
		plugins_url( 'assets/blocks.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-server-side-render' ),
		BLUEMORROW_SITE_VERSION,
		true
	);

	register_block_type(
		'bluemorrow/site-brand',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'bluemorrow_site_brand_block',
		)
	);
	register_block_type(
		'bluemorrow/app-store-cta',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
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
		'bluemorrow/language-switcher',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_language_switcher_block',
		)
	);
	register_block_type(
		'bluemorrow/primary-navigation',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_primary_navigation_block',
		)
	);
	register_block_type(
		'bluemorrow/legal-links',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_legal_links_block',
		)
	);
	register_block_type(
		'bluemorrow/footer-brand',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'bluemorrow_footer_brand_block',
		)
	);
	register_block_type(
		'bluemorrow/footer-navigation',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_footer_navigation_block',
		)
	);
	register_block_type(
		'bluemorrow/studio-home-hero',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'bluemorrow_studio_home_hero_block',
		)
	);
	register_block_type(
		'bluemorrow/studio-page-hero',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'bluemorrow_studio_page_hero_block',
		)
	);
	register_block_type(
		'bluemorrow/studio-apps',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'bluemorrow_studio_apps_block',
		)
	);
	register_block_type(
		'bluemorrow/studio-principles',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'bluemorrow_studio_principles_block',
		)
	);
	register_block_type(
		'bluemorrow/studio-support',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'bluemorrow_studio_support_block',
		)
	);
	register_block_type(
		'bluemorrow/batchora-product-media',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_product_media_block',
		)
	);
	register_block_type(
		'bluemorrow/batchora-home-hero',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_home_hero_block',
		)
	);
	register_block_type(
		'bluemorrow/batchora-home-workflow',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_home_workflow_block',
		)
	);
	register_block_type(
		'bluemorrow/batchora-feature-explorer',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_feature_explorer_block',
		)
	);
	register_block_type(
		'bluemorrow/batchora-trust-panel',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_trust_panel_block',
		)
	);
	register_block_type(
		'bluemorrow/batchora-feature-hero',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_feature_hero_block',
		)
	);
	register_block_type(
		'bluemorrow/batchora-related-features',
		array(
			'api_version'     => 3,
			'editor_script'   => 'bluemorrow-site-blocks',
			'render_callback' => 'batchora_related_features_block',
		)
	);
}
add_action( 'init', 'bluemorrow_site_register_blocks' );
