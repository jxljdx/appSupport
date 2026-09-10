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
}
add_action( 'after_setup_theme', 'batchora_theme_setup' );

function batchora_enqueue_assets() {
	$theme = wp_get_theme();
	wp_enqueue_style(
		'batchora-site',
		get_theme_file_uri( 'assets/site.css' ),
		array(),
		$theme->get( 'Version' )
	);
	wp_enqueue_script(
		'batchora-site',
		get_theme_file_uri( 'assets/site.js' ),
		array(),
		$theme->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'batchora_enqueue_assets' );

