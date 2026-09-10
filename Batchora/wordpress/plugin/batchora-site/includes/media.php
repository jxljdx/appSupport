<?php
/**
 * Responsive product media.
 *
 * @package BatchoraSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function batchora_media_url( $relative_path ) {
	return get_theme_file_uri( 'assets/media/' . ltrim( $relative_path, '/' ) );
}

function batchora_responsive_picture( $locale, $name, $alt, $class = '' ) {
	$base = $locale . '/' . $name;
	return sprintf(
		'<picture><source type="image/avif" srcset="%1$s 480w, %2$s 768w" sizes="(max-width: 700px) 78vw, 24vw"><source type="image/webp" srcset="%3$s 480w, %4$s 768w" sizes="(max-width: 700px) 78vw, 24vw"><img class="%5$s" src="%3$s" width="480" height="1039" loading="lazy" decoding="async" alt="%6$s"></picture>',
		esc_url( batchora_media_url( $base . '-480.avif' ) ),
		esc_url( batchora_media_url( $base . '-768.avif' ) ),
		esc_url( batchora_media_url( $base . '-480.webp' ) ),
		esc_url( batchora_media_url( $base . '-768.webp' ) ),
		esc_attr( $class ),
		esc_attr( $alt )
	);
}

function batchora_product_media_block() {
	$is_chinese = batchora_is_chinese();
	$locale     = $is_chinese ? 'zh-Hans' : 'en-US';
	$labels     = $is_chinese
		? array(
			'heading' => '真实界面，一眼了解 Batchora',
			'photo'   => '照片批量处理界面',
			'video'   => '视频压缩界面',
			'rename'  => '批量重命名界面',
			'play'    => '播放 18 秒 App 预览',
			'watch'   => '观看 App 预览',
		)
		: array(
			'heading' => 'See the real Batchora workflow',
			'photo'   => 'Batch photo processing screen',
			'video'   => 'Video compression screen',
			'rename'  => 'Batch rename screen',
			'play'    => 'Play the 18-second app preview',
			'watch'   => 'Watch the app preview',
		);

	$pictures = array(
		batchora_responsive_picture(
			$locale,
			'01-home',
			$labels['photo'],
			'batchora-media-card'
		),
		batchora_responsive_picture(
			$locale,
			'03-video-compression',
			$labels['video'],
			'batchora-media-card'
		),
		batchora_responsive_picture(
			$locale,
			'04-rename',
			$labels['rename'],
			'batchora-media-card'
		),
	);
	$poster = batchora_responsive_picture(
		$locale,
		'preview-poster',
		$labels['play'],
		'batchora-preview-poster'
	);
	$video  = esc_url(
		batchora_media_url( $locale . '/batchora-app-preview.mp4' )
	);

	return sprintf(
		'<section class="batchora-product-media" aria-labelledby="batchora-product-media-heading"><h2 id="batchora-product-media-heading">%1$s</h2><div class="batchora-media-gallery">%2$s</div><div class="batchora-preview"><button class="batchora-preview-trigger" type="button" aria-label="%3$s">%4$s<span>%3$s</span></button><video class="batchora-preview-video" controls playsinline preload="none" hidden data-src="%5$s"></video><noscript><a href="%5$s">%6$s</a></noscript></div></section>',
		esc_html( $labels['heading'] ),
		implode( '', $pictures ),
		esc_attr( $labels['play'] ),
		$poster,
		$video,
		esc_html( $labels['watch'] )
	);
}
