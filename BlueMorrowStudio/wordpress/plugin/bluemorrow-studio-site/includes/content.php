<?php
/**
 * Shared product content helpers.
 *
 * @package BatchoraSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_current_locale( $post_id = 0 ) {
	$post_id = $post_id ?: get_queried_object_id();
	$locale  = $post_id ? get_post_meta( $post_id, '_batchora_locale', true ) : '';

	return in_array( $locale, array( 'en-US', 'zh-Hans' ), true )
		? $locale
		: 'en-US';
}

function batchora_is_chinese( $post_id = 0 ) {
	return 'zh-Hans' === batchora_current_locale( $post_id );
}

function batchora_translation_key( $post_id = 0 ) {
	$post_id = $post_id ?: get_queried_object_id();
	return $post_id
		? get_post_meta( $post_id, '_batchora_translation_key', true )
		: '';
}

function batchora_translation_posts( $post_id = 0 ) {
	$key = batchora_translation_key( $post_id );
	if ( ! $key ) {
		return array();
	}

	$status = is_user_logged_in()
		? array( 'publish', 'draft', 'pending', 'private' )
		: array( 'publish' );

	return get_posts(
		array(
			'post_type'              => array( 'page', 'post' ),
			'post_status'            => $status,
			'posts_per_page'         => 4,
			'meta_key'               => '_batchora_translation_key',
			'meta_value'             => $key,
			'orderby'                => 'ID',
			'order'                  => 'ASC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => false,
		)
	);
}

function batchora_translation_url( $locale, $post_id = 0 ) {
	foreach ( batchora_translation_posts( $post_id ) as $translation ) {
		if ( $locale === batchora_current_locale( $translation->ID ) ) {
			return get_permalink( $translation );
		}
	}

	$fallback = 'zh-Hans' === $locale ? '/zh-hans/' : '/en/';
	return home_url( $fallback );
}

function batchora_page_url( $key, $locale = '' ) {
	$locale = $locale ?: batchora_current_locale();
	$posts  = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'meta_query'     => array(
				array(
					'key'   => '_batchora_translation_key',
					'value' => $key,
				),
				array(
					'key'   => '_batchora_locale',
					'value' => $locale,
				),
			),
			'no_found_rows'  => true,
		)
	);

	if ( $posts ) {
		return get_permalink( $posts[0] );
	}

	return 'home' === $key
		? home_url( 'zh-Hans' === $locale ? '/zh-hans/' : '/en/' )
		: '';
}

function batchora_app_store_url() {
	return 'https://apps.apple.com/app/id' . BATCHORA_APP_STORE_ID;
}

function batchora_is_guide( $post_id = 0 ) {
	$post_id = $post_id ?: get_queried_object_id();
	if ( ! $post_id ) {
		return false;
	}

	$parent_id = wp_get_post_parent_id( $post_id );
	return $parent_id && 'guides' === batchora_translation_key( $parent_id );
}
