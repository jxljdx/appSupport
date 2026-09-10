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

	registerDynamicBlock( 'batchora/app-store-cta', 'Batchora App Store CTA', {
		compact: {
			type: 'boolean',
			default: false,
		},
	} );
	registerDynamicBlock(
		'batchora/language-switcher',
		'Batchora Language Switcher'
	);
	registerDynamicBlock(
		'batchora/primary-navigation',
		'Batchora Primary Navigation'
	);
	registerDynamicBlock( 'batchora/legal-links', 'Batchora Legal Links' );
	registerDynamicBlock( 'batchora/product-media', 'Batchora Product Media' );
} )( window.wp.blocks, window.wp.element, window.wp.serverSideRender );
