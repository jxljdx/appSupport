<?php
/**
 * Search and social metadata.
 *
 * @package BatchoraSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_document_title( $parts ) {
	if ( ! is_singular() ) {
		return $parts;
	}

	$title = get_post_meta(
		get_queried_object_id(),
		'_batchora_seo_title',
		true
	);
	if ( $title ) {
		$parts['title'] = $title;
		unset( $parts['site'] );
	}

	return $parts;
}
add_filter( 'document_title_parts', 'batchora_document_title' );

function batchora_language_attributes( $output ) {
	if ( ! is_singular() ) {
		return $output;
	}

	$locale = batchora_current_locale();
	$output = preg_replace(
		'/lang=(["\']).*?\1/',
		'lang="' . esc_attr( $locale ) . '"',
		$output
	);
	return $output;
}
add_filter( 'language_attributes', 'batchora_language_attributes' );

function batchora_social_image() {
	$post_id = get_queried_object_id();
	if ( $post_id && has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'full' );
	}

	$path = get_theme_file_path( 'assets/social-card.png' );
	return file_exists( $path )
		? get_theme_file_uri( 'assets/social-card.png' )
		: '';
}

function batchora_output_metadata() {
	if ( ! is_singular() ) {
		return;
	}

	$post_id     = get_queried_object_id();
	$title       = get_post_meta( $post_id, '_batchora_seo_title', true );
	$description = get_post_meta(
		$post_id,
		'_batchora_seo_description',
		true
	);
	$canonical   = get_permalink( $post_id );
	$locale      = batchora_current_locale( $post_id );
	$image       = batchora_social_image();

	if ( $description ) {
		printf(
			"<meta name=\"description\" content=\"%s\">\n",
			esc_attr( $description )
		);
	}
	printf(
		"<link rel=\"canonical\" href=\"%s\">\n",
		esc_url( $canonical )
	);

	foreach ( array( 'en-US', 'zh-Hans' ) as $alternate_locale ) {
		printf(
			"<link rel=\"alternate\" hreflang=\"%s\" href=\"%s\">\n",
			esc_attr( $alternate_locale ),
			esc_url( batchora_translation_url( $alternate_locale, $post_id ) )
		);
	}
	printf(
		"<link rel=\"alternate\" hreflang=\"x-default\" href=\"%s\">\n",
		esc_url( batchora_translation_url( 'en-US', $post_id ) )
	);

	$properties = array(
		'og:type'        => batchora_is_guide( $post_id ) ? 'article' : 'website',
		'og:title'       => $title ?: get_the_title( $post_id ),
		'og:description' => $description,
		'og:url'         => $canonical,
		'og:locale'      => 'zh-Hans' === $locale ? 'zh_CN' : 'en_US',
		'og:site_name'   => 'Batchora',
		'og:image'       => $image,
	);
	foreach ( $properties as $property => $content ) {
		if ( $content ) {
			printf(
				"<meta property=\"%s\" content=\"%s\">\n",
				esc_attr( $property ),
				esc_attr( $content )
			);
		}
	}
	echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
}
remove_action( 'wp_head', 'rel_canonical' );
add_action( 'wp_head', 'batchora_output_metadata', 2 );

function batchora_breadcrumb_schema( $post_id ) {
	$ancestors = array_reverse( get_post_ancestors( $post_id ) );
	$items     = array();
	$position  = 1;

	foreach ( array_merge( $ancestors, array( $post_id ) ) as $item_id ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title( $item_id ),
			'item'     => get_permalink( $item_id ),
		);
		++$position;
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);
}

function batchora_extract_faq_schema( $content ) {
	if ( ! preg_match_all(
		'/<details>\s*<summary>(.*?)<\/summary>\s*<p>(.*?)<\/p>\s*<\/details>/s',
		$content,
		$matches,
		PREG_SET_ORDER
	) ) {
		return null;
	}

	$questions = array();
	foreach ( $matches as $match ) {
		$questions[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $match[1] ),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $match[2] ),
			),
		);
	}

	return array(
		'@type'      => 'FAQPage',
		'mainEntity' => $questions,
	);
}

function batchora_output_schema() {
	if ( ! is_singular() ) {
		return;
	}

	$post_id     = get_queried_object_id();
	$locale      = batchora_current_locale( $post_id );
	$description = get_post_meta(
		$post_id,
		'_batchora_seo_description',
		true
	);
	$graph       = array(
		array(
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
			'name'  => 'Batchora',
			'url'   => home_url( '/' ),
			'email' => 'jxstudio.apps@gmail.com',
		),
		array(
			'@type'       => 'WebSite',
			'@id'         => home_url( '/#website' ),
			'url'         => home_url( '/' ),
			'name'        => 'Batchora',
			'inLanguage'  => array( 'en-US', 'zh-Hans' ),
			'publisher'   => array( '@id' => home_url( '/#organization' ) ),
		),
		batchora_breadcrumb_schema( $post_id ),
	);

	if ( 'home' === batchora_translation_key( $post_id ) ) {
		$graph[] = array(
			'@type'                => 'MobileApplication',
			'name'                 => 'Batchora: Photo & Video',
			'operatingSystem'      => 'iOS 17 or later',
			'applicationCategory'  => 'MultimediaApplication',
			'downloadUrl'          => batchora_app_store_url(),
			'description'          => $description,
			'inLanguage'           => $locale,
			'isAccessibleForFree'  => true,
			'offers'               => array(
				'@type'         => 'Offer',
				'price'         => '0',
				'priceCurrency' => 'USD',
			),
		);
	}

	if ( batchora_is_guide( $post_id ) ) {
		$graph[] = array(
			'@type'            => 'Article',
			'headline'         => get_the_title( $post_id ),
			'description'      => $description,
			'datePublished'    => get_the_date( DATE_W3C, $post_id ),
			'dateModified'     => get_the_modified_date( DATE_W3C, $post_id ),
			'inLanguage'       => $locale,
			'mainEntityOfPage' => get_permalink( $post_id ),
			'author'           => array(
				'@type' => 'Organization',
				'name'  => 'Batchora Team',
			),
			'publisher'        => array( '@id' => home_url( '/#organization' ) ),
		);
	}

	$faq = batchora_extract_faq_schema(
		get_post_field( 'post_content', $post_id )
	);
	if ( $faq ) {
		$graph[] = $faq;
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
	printf(
		"<script type=\"application/ld+json\">%s</script>\n",
		wp_json_encode(
			$schema,
			JSON_UNESCAPED_SLASHES |
			JSON_UNESCAPED_UNICODE |
			JSON_HEX_TAG |
			JSON_HEX_AMP |
			JSON_HEX_APOS |
			JSON_HEX_QUOT
		)
	);
}
add_action( 'wp_head', 'batchora_output_schema', 20 );
