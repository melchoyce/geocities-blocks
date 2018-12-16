/**
 * External Dependencies
 */
import { __ } from '@wordpress/i18n';
import { RawHTML } from '@wordpress/element';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import '../css/example-block.scss';

const Edit = () => {
	return <div>Hello</div>;
};

registerBlockType( 'geocities/example', {
	title: __( 'Example Block', 'geocities-blocks' ),
	icon: 'star',
	category: 'geocities',
	description: __(
		'Example block to show how building works.',
		'geocities-blocks'
	),
	attributes: {
		align: {
			type: 'string',
		},
	},

	getEditWrapperProps( attributes ) {
		const { align } = attributes;
		if ( -1 !== [ 'wide', 'full' ].indexOf( align ) ) {
			return { 'data-align': align };
		}
	},

	edit( props ) {
		return <Edit { ...props } />;
	},

	save( props ) {
		const {
			align,
		} = props.attributes; /* eslint-disable-line react/prop-types */
		return (
			<RawHTML className={ align ? `align${ align }` : '' }>
				BLOCKS
			</RawHTML>
		);
	},
} );

