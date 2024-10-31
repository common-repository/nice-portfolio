<?php
/**
 * NiceThemes Admin UI
 *
 * This file hooks processes to internal actions within this domain.
 *
 * @package Nice_Portfolio_Admin_UI
 * @license GPL-2.0+
 * @since   1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Schedule the current instance of this domain to be displayed.
 *
 * @since 1.0
 *
 * @uses  nice_portfolio_display()
 *
 * Hooke origin:
 * @see Nice_Portfolio_Admin_UICreateResponder::loaded()
 */
add_action( 'nice_portfolio_admin_ui_created', 'nice_portfolio_display' );

/**
 * Process current state of Admin UI instances once they have received registers.
 *
 * @since 1.0
 *
 * @uses  Nice_Portfolio_Admin_UIService::process_context()
 *
 * Hook here:
 * @see Nice_Portfolio_Admin_UIRegisterResponder::loaded()
 */
add_action( 'nice_portfolio_admin_ui_registered', array( 'Nice_Portfolio_Admin_UIService', 'process_context' ) );
