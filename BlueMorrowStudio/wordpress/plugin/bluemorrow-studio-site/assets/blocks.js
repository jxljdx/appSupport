( function ( blocks, element, ServerSideRender ) {
	const el = element.createElement;

	function registerDynamicBlock( name, title, attributes ) {
		blocks.registerBlockType( name, {
			apiVersion: 3,
			title,
			category: 'widgets',
			attributes: attributes || {},
			edit: function ( props ) {
				return el( ServerSideRender, {
					block: name,
					attributes: props.attributes,
				} );
			},
			save: function () {
				return null;
			},
		} );
	}

	registerDynamicBlock( 'bluemorrow/site-brand', 'BlueMorrow Site Brand' );
	registerDynamicBlock( 'bluemorrow/app-store-cta', 'App Store CTA', {
		compact: {
			type: 'boolean',
			default: false,
		},
	} );
	registerDynamicBlock(
		'bluemorrow/language-switcher',
		'BlueMorrow Language Switcher'
	);
	registerDynamicBlock(
		'bluemorrow/primary-navigation',
		'BlueMorrow Primary Navigation'
	);
	registerDynamicBlock(
		'bluemorrow/footer-navigation',
		'BlueMorrow Footer Navigation'
	);
	registerDynamicBlock( 'bluemorrow/footer-brand', 'BlueMorrow Footer Brand' );
	registerDynamicBlock( 'bluemorrow/legal-links', 'BlueMorrow Legal Links' );
	registerDynamicBlock(
		'bluemorrow/studio-home-hero',
		'BlueMorrow Studio Home Hero'
	);
	registerDynamicBlock(
		'bluemorrow/studio-page-hero',
		'BlueMorrow Studio Page Hero'
	);
	registerDynamicBlock( 'bluemorrow/studio-apps', 'BlueMorrow Studio Apps' );
	registerDynamicBlock(
		'bluemorrow/studio-principles',
		'BlueMorrow Studio Principles'
	);
	registerDynamicBlock(
		'bluemorrow/studio-support',
		'BlueMorrow Studio Support'
	);
	registerDynamicBlock(
		'bluemorrow/batchora-product-media',
		'Batchora Product Media'
	);
	registerDynamicBlock(
		'bluemorrow/batchora-home-hero',
		'Batchora Home Hero'
	);
	registerDynamicBlock(
		'bluemorrow/batchora-home-workflow',
		'Batchora Home Workflow'
	);
	registerDynamicBlock(
		'bluemorrow/batchora-feature-explorer',
		'Batchora Feature Explorer'
	);
	registerDynamicBlock(
		'bluemorrow/batchora-trust-panel',
		'Batchora Trust Panel'
	);
	registerDynamicBlock(
		'bluemorrow/batchora-feature-hero',
		'Batchora Feature Hero'
	);
	registerDynamicBlock(
		'bluemorrow/batchora-related-features',
		'Batchora Related Features'
	);
} )( window.wp.blocks, window.wp.element, window.wp.serverSideRender );
