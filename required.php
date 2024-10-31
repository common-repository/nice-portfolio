<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Set paths of libraries that will be loaded through the NiceThemes Plugin API.
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

add_filter( 'nice_portfolio_plugin_libraries', 'nice_portfolio_plugin_libraries' );
/**
 * Set location of common plugin libraries to be loaded.
 *
 * @since  1.0
 *
 * @param  array $libraries
 *
 * @return array
 */
function nice_portfolio_plugin_libraries( array $libraries ) {
	return array_merge( $libraries, array( plugin_dir_path( __FILE__ ) . 'includes' ) );
}

add_filter( 'nice_portfolio_public_libraries', 'nice_portfolio_public_libraries' );
/**
 * Set location of public libraries to be loaded.
 *
 * @since  1.0
 *
 * @param  array $libraries
 *
 * @return array
 */
function nice_portfolio_public_libraries( array $libraries ) {
	return array_merge( $libraries, array( plugin_dir_path( __FILE__ ) . 'public' ) );
}

add_filter( 'nice_portfolio_admin_libraries', 'nice_portfolio_admin_libraries' );
/**
 * Set location of admin libraries to be loaded.
 *
 * @since  1.0
 *
 * @param  array $libraries
 *
 * @return array
 */
function nice_portfolio_admin_libraries( array $libraries ) {
	return array_merge( $libraries, array( plugin_dir_path( __FILE__ ) . 'admin' ) );
}
