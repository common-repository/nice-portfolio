<?php
/**
 * Nice Portfolio by NiceThemes
 *
 * A great portfolio plugin to display your work in a clean, responsive and beautiful way. You can
 * show your projects in a specific page, using a shortcode, widgets or template tags.
 *
 * @package   Nice_Portfolio
 * @author    NiceThemes <hello@nicethemes.com>
 * @license   GPL-2.0+
 * @link      https://nicethemes.com/product/nice-portfolio
 * @copyright 2016-2018 NiceThemes
 *
 * @wordpress-plugin
 * Plugin Name:       Nice Portfolio
 * Plugin URI:        https://nicethemes.com/product/nice-portfolio
 * Description:       A great portfolio plugin to show your work to the world in a clean, responsive and beautiful way. You can show your projects in a specific page, using a shortcode, widgets or template tags.
 * Version:           1.0.4
 * Author:            NiceThemes
 * Author URI:        https://nicethemes.com
 * Contributors:      nicethemes, juanfra, andrezrv
 * Text Domain:       nice-portfolio
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/nicethemes/nice-portfolio
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load a file for development purposes if we have one.
 *
 * This is useful for plugin developers and users that want to test things
 * without breaking the rest of the codebase.
 *
 * @since 1.0
 */
if ( file_exists( $develop = plugin_dir_path( __FILE__ ) . 'develop.php' ) ) {
	include $develop;
}

/**
 * Define plugin file.
 */
if ( ! defined( 'NICE_PORTFOLIO_PLUGIN_FILE' ) ) {
	define( 'NICE_PORTFOLIO_PLUGIN_FILE', __FILE__ );
}

/**
 * Define plugin domain.
 */
if ( ! defined( 'NICE_PORTFOLIO_PLUGIN_DOMAIN_FILE' ) ) {
	define( 'NICE_PORTFOLIO_PLUGIN_DOMAIN_FILE', __FILE__ );
}

/**
 * Define path for public templates.
 */
if ( ! defined( 'NICE_PORTFOLIO_TEMPLATES_PATH' ) ) {
	define( 'NICE_PORTFOLIO_TEMPLATES_PATH', plugin_dir_path( __FILE__ ) . 'templates' );
}

/**
 * Define URL for public assets.
 */
if ( ! defined( 'NICE_PORTFOLIO_ASSETS_URL' ) ) {
	define( 'NICE_PORTFOLIO_ASSETS_URL', trailingslashit( plugins_url( 'public/assets', __FILE__ ) ) );
}

/**
 * Define path for admin templates.
 */
if ( ! defined( 'NICE_PORTFOLIO_ADMIN_TEMPLATES_PATH' ) ) {
	define( 'NICE_PORTFOLIO_ADMIN_TEMPLATES_PATH', plugin_dir_path( __FILE__ ) . 'admin/templates' );
}

/**
 * Define URL for admin assets.
 */
if ( ! defined( 'NICE_PORTFOLIO_ADMIN_ASSETS_URL' ) ) {
	define( 'NICE_PORTFOLIO_ADMIN_ASSETS_URL', trailingslashit( plugins_url( 'admin/assets', __FILE__ ) ) );
}

/**
 * Define path for integrations folder.
 */
if ( ! defined( 'NICE_PORTFOLIO_INTEGRATIONS_PATH' ) ) {
	define( 'NICE_PORTFOLIO_INTEGRATIONS_PATH', plugin_dir_path( __FILE__ ) . 'integrations' );
}

/**
 * Define path for compatibility folder.
 */
if ( ! defined( 'NICE_PORTFOLIO_COMPATIBILITY_PATH' ) ) {
	define( 'NICE_PORTFOLIO_COMPATIBILITY_PATH', plugin_dir_path( __FILE__ ) . 'compatibility' );
}

/**
 * Load file for plugin initialization.
 */
require plugin_dir_path( __FILE__ ) . 'init.php';

/**
 * Trigger plugin functionality.
 *
 * @since 1.0
 */
do_action( 'nice_portfolio_plugin_do' );
