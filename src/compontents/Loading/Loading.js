/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * External dependencies
 */
import { Helmet } from 'react-helmet';

function Loading() {
	return (
		<>
			<Helmet>
				<title>{ __( 'Loading…', 'wp-react-theme' ) }</title>
			</Helmet>
			<h4>{ __( 'Loading…', 'wp-react-theme' ) }</h4>
		</>
	);
}

export default Loading;