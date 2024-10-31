<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles processes that fire on plugin activation.
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

if ( ! function_exists( 'nice_portfolio_create_settings' ) ) :
add_action( 'nice_portfolio_activate', 'nice_portfolio_create_settings' );
/**
 * Create settings on plugin activation.
 *
 * @since 1.0
 */
function nice_portfolio_create_settings() {
	/**
	 * Create settings holder.
	 */
	if ( ! get_option( $settings_name = nice_portfolio_settings_name() ) ) {
		add_option( $settings_name, nice_portfolio_default_settings() );
	}
}
endif;
