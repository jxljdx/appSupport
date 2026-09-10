<?php
/**
 * Production settings.
 *
 * @package BatchoraSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_register_settings() {
	register_setting(
		'reading',
		'batchora_cloudflare_analytics_token',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		)
	);

	add_settings_field(
		'batchora_cloudflare_analytics_token',
		__( 'Cloudflare Web Analytics token', 'batchora-site' ),
		'batchora_cloudflare_token_field',
		'reading'
	);
}
add_action( 'admin_init', 'batchora_register_settings' );

function batchora_cloudflare_token_field() {
	$value = get_option( 'batchora_cloudflare_analytics_token', '' );
	printf(
		'<input class="regular-text" type="text" name="batchora_cloudflare_analytics_token" value="%s" autocomplete="off">',
		esc_attr( $value )
	);
	echo '<p class="description">';
	esc_html_e(
		'Leave empty until the production domain is connected.',
		'batchora-site'
	);
	echo '</p>';
}

function batchora_output_cloudflare_analytics() {
	$token = get_option( 'batchora_cloudflare_analytics_token', '' );
	if ( ! $token ) {
		return;
	}

	printf(
		'<script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon="%s"></script>' . "\n",
		esc_attr( wp_json_encode( array( 'token' => $token ) ) )
	);
}
add_action( 'wp_footer', 'batchora_output_cloudflare_analytics', 100 );

