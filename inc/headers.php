<?php

remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );

/**
 * Outputs rel=canonical for singular queries.
 *
 */
function wp_react_theme_rel_canonical() {
	if ( ! is_singular() ) {
		return;
	}

	$id = get_queried_object_id();

	if ( 0 === $id ) {
		return;
	}

	$url = wp_get_canonical_url( $id );

	if ( ! empty( $url ) ) {
		echo '<link rel="canonical" href="' . esc_url( $url ) . '" data-react-helmet="true" />' . "\n";
	}
}
add_action( 'wp_head', 'wp_react_theme_rel_canonical' );

/**
 * Injects rel=shortlink into the head if a shortlink is defined for the current page.
 *
 * Attached to the {@see 'wp_head'} action.
 *
 */
function wp_react_theme_shortlink_wp_head() {
	$shortlink = wp_get_shortlink( 0, 'query' );

	if ( empty( $shortlink ) ) {
		return;
	}

	echo "<link rel='shortlink' href='" . esc_url( $shortlink ) . "' data-react-helmet='true' />\n";
}
add_action( 'wp_head', 'wp_react_theme_shortlink_wp_head' );


/**
 * Outputs the REST API link tag into page header.
 *
 * @see get_rest_url()
 */
function wp_react_theme_output_link_wp_head() {
	$api_root = get_rest_url();

	if ( empty( $api_root ) ) {
		return;
	}

	printf( '<link rel="https://api.w.org/" href="%s" />', esc_url( $api_root ) );

	$resource = rest_get_queried_resource_route();

	if ( $resource ) {
		printf( '<link rel="alternate" type="application/json" href="%s"  data-react-helmet="true" />', esc_url( rest_url( $resource ) ) );
	}
}
add_action( 'wp_head', 'wp_react_theme_output_link_wp_head' );