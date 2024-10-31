<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles processes that fire on plugin deactivation.
 *
 * @package   Nice_Portfolio
 * @author    NiceThemes <hello@nicethemes.com>
 * @license   GPL-2.0+
 * @link      https://nicethemes.com/product/nice-portfolio
 * @copyright 2016 NiceThemes
 * @since     1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'nice_portfolio_remove_settings' ) ) :
add_action( 'nice_portfolio_deactivate', 'nice_portfolio_remove_settings' );
/**
 * Remove settings on plugin deactivation.
 *
 * @since 1.0
 */
function nice_portfolio_remove_settings() {
	/**
	 * Remove plugin data only if requested.
	 */
	$settings = nice_portfolio_settings();

	if (   ! empty( $settings['remove_data_on_deactivation'] )
	       && $settings['remove_data_on_deactivation']
	) {
		/**
		 * Remove settings holder.
		 */
		delete_option( nice_portfolio_settings_name() );
	}
}
endif;
