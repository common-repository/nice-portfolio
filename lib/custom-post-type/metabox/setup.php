<?php
/**
 * NiceThemes Post Type API
 *
 * This file hooks processes to internal actions within this domain.
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
 * Fire the display action for this domain once a metabox has been created.
 *
 * @since 1.0
 *
 * @uses  nice_portfolio_display()
 *
 * Hook origin:
 * @see Nice_Portfolio_MetaboxCreateResponder::loaded()
 */
add_action( 'nice_portfolio_metabox_created', 'nice_portfolio_display' );

/**
 * Fire the update process for this domain once a metabox has been created.
 *
 * @since 1.0
 *
 * @uses  nice_portfolio_update()
 *
 * Hook origin:
 * @see Nice_Portfolio_MetaboxCreateResponder::loaded()
 */
add_action( 'nice_portfolio_metabox_created', 'nice_portfolio_update' );
