<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Manage functionality for integrations.
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

if ( ! function_exists( 'nice_portfolio_integrations' ) ) :
add_filter( 'nice_portfolio_supported_integrations', 'nice_portfolio_integrations' );
/**
 * Setup data for integrations with other plugins.
 *
 * @since  1.0
 *
 * @param  array $integrations List of existing integrations.
 *
 * @return array
 */
function nice_portfolio_integrations( $integrations = array() ) {
	$integrations_path = trailingslashit( NICE_PORTFOLIO_INTEGRATIONS_PATH );

	/**
	 * Create an array containing data to initialize our integrations when needed.
	 */
	$integrations = array_merge( $integrations, array(
		/**
		 * Likes by NiceThemes.
		 *
		 * @link https://nicethemes.com/product/likes
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'nice-likes',
			'path'            => $integrations_path . 'nice-likes.php',
			'action'          => 'plugins_loaded',
			'function_exists' => 'nice_likes_plugin',
		),
	) );

	return $integrations;
}
endif;
