<?php
/**
 * NiceThemes Plugin API
 *
 * This file contains general helper functions that allow interactions with
 * this module in an easier way.
 *
 * @package Nice_Portfolio_Plugin_API
 * @license GPL-2.0+
 * @since   1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create and return an instance of Nice_Portfolio_i18n.
 *
 * @uses   nice_portfolio_create()
 *
 * @since  1.0
 *
 * @param  array           $data Information for new instance.
 *
 * @return Nice_Portfolio_i18n
 */
function nice_portfolio_i18n_create( array $data ) {
	/**
	 * Create an i18n instance and initialize its functionality.
	 */
	return nice_portfolio_create( 'Nice_Portfolio_i18n', $data );
}

/**
 * Obtain an instance of this domain's service.
 *
 * @uses   nice_portfolio_service()
 *
 * @since  1.0
 *
 * @return Nice_Portfolio_DefaultService
 */
function nice_portfolio_i18n_service() {
	return nice_portfolio_service( 'Nice_Portfolio_i18n' );
}
