<?php
/**
 * NiceThemes Plugin API
 *
 * This file contains general helper functions that allow interactions with
 * this module in an easier way.
 *
 * @package Nice_Portfolio_Plugin_API
 * @license GPL-2.0+
 * @since   1.1
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create and return an instance of Nice_Portfolio_glancer.
 *
 * @uses   nice_portfolio_create()
 *
 * @since  1.1
 *
 * @param  array           $data Information for new instance.
 *
 * @return Nice_Portfolio_Glancer
 */
function nice_portfolio_glancer_create( array $data ) {
	/**
	 * Create a glancer instance and initialize its functionality.
	 */
	return nice_portfolio_create( 'Nice_Portfolio_Glancer', $data );
}

/**
 * Obtain an instance of this domain's service.
 *
 * @uses   nice_portfolio_service()
 *
 * @since  1.1
 *
 * @return Nice_Portfolio_GlancerService
 */
function nice_portfolio_glancer_service() {
	return nice_portfolio_service( 'Nice_Portfolio_Glancer' );
}

/**
 * Register one or more post type items to be shown on the dashboard widget.
 *
 * @uses  nice_portfolio_glancer_service()
 * @uses  Nice_Portfolio_GlancerService::add_item()
 *
 * @since 1.1
 *
 * @param Nice_Portfolio_Glancer $glancer Instance to be updated.
 * @param array|string  $post_types Post type name, or array of post type names.
 * @param array|string  $statuses Post status or array of different post type statuses
 * @param string $glyph Dashicons glyph for current post type.
 */
function nice_portfolio_glancer_add_item( Nice_Portfolio_Glancer $glancer, $post_types, $statuses = 'publish', $glyph = '' ) {
	$glancer_service = nice_portfolio_glancer_service();
	$glancer_service->add_item( $glancer, $post_types, $statuses, $glyph );
}
