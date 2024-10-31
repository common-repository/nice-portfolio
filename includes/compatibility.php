<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Manage functionality for compatible themes and plugins.
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

if ( ! function_exists( 'nice_portfolio_compatibility' ) ) :
add_filter( 'nice_portfolio_supported_integrations', 'nice_portfolio_compatibility' );
/**
 * Setup data for compatibility with plugins and themes.
 *
 * @since  1.0
 *
 * @param  array $integrations List of existing integrations.
 *
 * @return array
 */
function nice_portfolio_compatibility( $integrations = array() ) {
	$theme_compatibility_path  = trailingslashit( NICE_PORTFOLIO_COMPATIBILITY_PATH ) . 'themes/';
	$plugin_compatibility_path = trailingslashit( NICE_PORTFOLIO_COMPATIBILITY_PATH ) . 'plugins/';

	/**
	 * Create an array containing data to initialize our integrations when needed.
	 */
	$integrations = array_merge( $integrations, array(
		/**
		 * Jetpack.
		 *
		 * @link https://wordpress.org/plugins/jetpack/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'jetpack',
			'path'            => $plugin_compatibility_path . 'jetpack.php',
			'action'          => 'plugins_loaded',
			'class_exists'    => 'Jetpack',
		),

		/**
		 * Twenty Ten.
		 *
		 * @link https://wordpress.org/themes/twentyten/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'twentyten',
			'type'            => 'theme',
			'path'            => $theme_compatibility_path . 'twentyten.php',
			'action'          => 'after_setup_theme',
			'function_exists' => 'twentyten_setup',
		),

		/**
		 * Twenty Eleven.
		 *
		 * @link https://wordpress.org/themes/twentyeleven/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'twentyeleven',
			'type'            => 'theme',
			'path'            => $theme_compatibility_path . 'twentyeleven.php',
			'action'          => 'after_setup_theme',
			'function_exists' => 'twentyeleven_setup',
		),

		/**
		 * Twenty Twelve.
		 *
		 * @link https://wordpress.org/themes/twentytwelve/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'twentytwelve',
			'type'            => 'theme',
			'path'            => $theme_compatibility_path . 'twentytwelve.php',
			'action'          => 'after_setup_theme',
			'function_exists' => 'twentytwelve_setup',
		),

		/**
		 * Twenty Thirteen.
		 *
		 * @link https://wordpress.org/themes/twentythirteen/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'twentythirteen',
			'type'            => 'theme',
			'path'            => $theme_compatibility_path . 'twentythirteen.php',
			'action'          => 'after_setup_theme',
			'function_exists' => 'twentythirteen_setup',
		),

		/**
		 * Twenty Fourteen.
		 *
		 * @link https://wordpress.org/themes/twentyfourteen/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'twentyfourteen',
			'type'            => 'theme',
			'path'            => $theme_compatibility_path . 'twentyfourteen.php',
			'action'          => 'after_setup_theme',
			'function_exists' => 'twentyfourteen_setup',
		),

		/**
		 * Twenty Fifteen.
		 *
		 * @link https://wordpress.org/themes/twentyfifteen/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'twentyfifteen',
			'type'            => 'theme',
			'path'            => $theme_compatibility_path . 'twentyfifteen.php',
			'action'          => 'after_setup_theme',
			'function_exists' => 'twentyfifteen_setup',
		),

		/**
		 * Twenty Sixteen.
		 *
		 * @link https://wordpress.org/themes/twentysixteen/
		 *
		 * @since 1.0
		 */
		array(
			'name'            => 'twentysixteen',
			'type'            => 'theme',
			'path'            => $theme_compatibility_path . 'twentysixteen.php',
			'action'          => 'after_setup_theme',
			'function_exists' => 'twentysixteen_setup',
		),
	) );

	return $integrations;
}
endif;
