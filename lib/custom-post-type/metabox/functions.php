<?php
/**
 * NiceThemes Post Type API
 *
 * This file includes functions to handle the admin-facing side of custom post
 * types for the current plugin.
 *
 * @package Nice_Portfolio_Post_Type
 * @license GPL-2.0+
 * @since   1.1
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create a metabox.
 *
 * @uses   nice_portfolio_create()
 *
 * @since  1.1
 *
 * @param  array|null $args
 *
 * @return Nice_Portfolio_Metabox
 *
 * Accepted $args:
 *
	array(
		'post_types' => {all possible content types},
		'fields'     => array(
			array(
				'type'  => {info|text|select|textarea|upload|checkbox|radio},
				'label' => 'Field label',
				'name'  => 'field-name',
				'desc'  => 'Field description',
			),
		),
		'settings'  => {all possible meta box settings},
	)
 */
function nice_portfolio_metabox_create( array $args = null ) {
	return nice_portfolio_create( 'Nice_Portfolio_Metabox', $args );
}

/**
 * Callback to print a metabox.
 *
 * @see   Nice_Portfolio_MetaboxCreateResponder::get_metabox_settings()
 *
 * @uses  Nice_Portfolio_Metabox_HTMLHandler::print_html()
 *
 * @param WP_Post $post Current post.
 * @param array   $data Metabox arguments.
 */
function nice_portfolio_metabox_print( WP_Post $post, array $data ) {
	do_action( 'nice_portfolio_metabox', $data['args']['instance'], $post );
}

/**
 * Schedule update process.
 *
 * @since 1.1
 */
function nice_portfolio_metabox_enqueue_update() {
	add_filter( 'edit_post', 'nice_portfolio_update' );
}
