<?php
/**
 * Versioned content updates for existing BlueMorrow Studio sites.
 *
 * @package BlueMorrowStudioSite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function bluemorrow_site_upgrade_1_0_2() {
	if ( version_compare(
		get_option( 'bluemorrow_site_content_version', '1.0.1' ),
		'1.0.2',
		'>='
	) ) {
		return;
	}

	$replacements = array(
		'BlueMorrow Studio creates simple tools with careful design, clear controls, and privacy considered from the start. Its first app, Batchora, processes photos and videos in batches on iPhone.' =>
			'BlueMorrow Studio creates simple iPhone tools with careful design, clear controls, and privacy considered from the start. Batchora handles photo and video batches, while Tucklet keeps temporary details only while they matter.',
		'BlueMorrow Studio currently offers Batchora, an iPhone app for compressing, renaming, resizing, converting, and exporting photos and videos in batches.' =>
			'BlueMorrow Studio offers Batchora for compressing, renaming, resizing, converting, and exporting media in batches, plus Tucklet for useful details that should expire.',
		'Tucklet is coming soon to the App Store.' =>
			'Download Tucklet on iPhone to keep temporary details only while they matter.',
		'BlueMorrow Studio 专注于清晰、克制并从一开始就考虑隐私的实用工具。首款 App Batchora 可在 iPhone 本地批量处理照片与视频。' =>
			'BlueMorrow Studio 专注于清晰、克制并从一开始就考虑隐私的 iPhone 工具。Batchora 用于批量处理照片与视频，Tucklet 让临时信息只留到真正需要为止。',
		'BlueMorrow Studio 目前推出了 Batchora，一款可在 iPhone 批量压缩、重命名、改尺寸、转换并导出照片和视频的 App。' =>
			'BlueMorrow Studio 推出了 Batchora 和 Tucklet：前者用于批量压缩、重命名、改尺寸和导出媒体，后者用于保存会到期的临时信息。',
		'Tucklet 即将在 App Store 推出。' =>
			'在 iPhone 下载 Tucklet，让临时信息只留到真正需要为止。',
	);
	$metadata = array(
		'en-US:studio-home' => array(
			'_bluemorrow_seo_description' =>
				'BlueMorrow Studio makes privacy-conscious iPhone tools. Explore Batchora for media batches and Tucklet for expiring temporary details.',
		),
		'en-US:apps' => array(
			'_bluemorrow_seo_description' =>
				'Explore Batchora for private media batch processing and Tucklet for temporary details that expire on iPhone.',
		),
		'zh-Hans:studio-home' => array(
			'_bluemorrow_seo_description' =>
				'BlueMorrow Studio 打造注重隐私的 iPhone 工具，包括媒体批处理 Batchora 和临时信息 App Tucklet。',
		),
		'zh-Hans:apps' => array(
			'_bluemorrow_seo_description' =>
				'了解 BlueMorrow Studio 的 Batchora 媒体批处理工具和 Tucklet 临时信息 App。',
		),
	);
	$posts = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => '_bluemorrow_translation_key',
					'value'   => array(
						'studio-home',
						'apps',
						'tucklet-home',
						'tucklet-faq',
						'tucklet-about',
					),
					'compare' => 'IN',
				),
			),
		)
	);

	foreach ( $posts as $post ) {
		$translation_key = batchora_translation_key( $post->ID );
		$locale          = batchora_current_locale( $post->ID );
		$content = str_replace(
			array_keys( $replacements ),
			array_values( $replacements ),
			$post->post_content
		);
		if ( $content !== $post->post_content ) {
			wp_update_post(
				array(
					'ID'           => $post->ID,
					'post_content' => $content,
				)
			);
		}

		$metadata_key = $locale . ':' . $translation_key;
		foreach ( $metadata[ $metadata_key ] ?? array() as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

	update_option( 'bluemorrow_site_content_version', '1.0.2', false );
}
add_action( 'admin_init', 'bluemorrow_site_upgrade_1_0_2' );
