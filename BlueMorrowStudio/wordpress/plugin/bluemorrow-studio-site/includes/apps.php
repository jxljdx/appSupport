<?php
/**
 * BlueMorrow Studio app registry and page-scope helpers.
 *
 * @package BlueMorrowStudioSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bluemorrow_apps() {
	$apps = array(
		'batchora' => array(
			'key'             => 'batchora',
			'slug'            => 'batchora',
			'name'            => 'Batchora',
			'store_name'      => 'Batchora: Photo & Video',
			'app_store_id'    => '6810283756',
			'home_key'        => 'batchora-home',
			'icon'            => 'app-icon-512.png',
			'supported_locales' => array( 'en-US', 'zh-Hans' ),
		),
		'tucklet' => array(
			'key'               => 'tucklet',
			'slug'              => 'tucklet',
			'name'              => 'Tucklet',
			'store_name'        => 'Tucklet',
			'app_store_url'     => '',
			'home_key'          => 'tucklet-home',
			'icon'              => 'tucklet-icon-512.png',
			'supported_locales' => array( 'en-US', 'zh-Hans' ),
		),
	);

	return apply_filters( 'bluemorrow_apps', $apps );
}

function bluemorrow_app( $app_key ) {
	$apps = bluemorrow_apps();
	return isset( $apps[ $app_key ] ) ? $apps[ $app_key ] : null;
}

function bluemorrow_page_scope( $post_id = 0 ) {
	$post_id = $post_id ?: get_queried_object_id();
	$scope   = $post_id
		? get_post_meta( $post_id, '_bluemorrow_scope', true )
		: '';

	return in_array( $scope, array( 'studio', 'app' ), true )
		? $scope
		: 'app';
}

function bluemorrow_page_app_key( $post_id = 0 ) {
	$post_id = $post_id ?: get_queried_object_id();
	if ( ! $post_id || 'app' !== bluemorrow_page_scope( $post_id ) ) {
		return '';
	}

	$app_key = get_post_meta( $post_id, '_bluemorrow_app_key', true );
	return bluemorrow_app( $app_key ) ? $app_key : 'batchora';
}

function bluemorrow_current_app( $post_id = 0 ) {
	$app_key = bluemorrow_page_app_key( $post_id );
	return $app_key ? bluemorrow_app( $app_key ) : null;
}

function bluemorrow_app_store_url( $app_key = '' ) {
	$app = bluemorrow_app(
		$app_key ?: bluemorrow_page_app_key()
	);
	if ( ! $app ) {
		return '';
	}

	if ( ! empty( $app['app_store_url'] ) ) {
		return esc_url_raw( $app['app_store_url'] );
	}

	if ( empty( $app['app_store_id'] ) ) {
		return '';
	}

	return 'https://apps.apple.com/app/id' . $app['app_store_id'];
}
