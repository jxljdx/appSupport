<?php
/**
 * Batchora theme setup.
 *
 * @package Batchora
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_editor_style( 'assets/site.css' );
	register_block_pattern_category(
		'batchora',
		array( 'label' => __( 'Batchora', 'batchora' ) )
	);
}
add_action( 'after_setup_theme', 'batchora_theme_setup' );

function batchora_enqueue_assets() {
	$style_path  = get_theme_file_path( 'assets/site.css' );
	$script_path = get_theme_file_path( 'assets/site.js' );
	wp_enqueue_style(
		'batchora-site',
		get_theme_file_uri( 'assets/site.css' ),
		array(),
		file_exists( $style_path ) ? (string) filemtime( $style_path ) : null
	);
	wp_enqueue_script(
		'batchora-site',
		get_theme_file_uri( 'assets/site.js' ),
		array(),
		file_exists( $script_path ) ? (string) filemtime( $script_path ) : null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'batchora_enqueue_assets' );
