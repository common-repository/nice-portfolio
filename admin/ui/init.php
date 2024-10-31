<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Initialize Admin UI.
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

if ( ! function_exists( 'nice_portfolio_admin_ui_data' ) ) :
add_filter( 'nice_portfolio_admin_ui_data', 'nice_portfolio_admin_ui_data' );
/**
 * Create a new Admin UI.
 *
 * @since 1.0
 */
function nice_portfolio_admin_ui_data() {
	$admin_ui = array(
		'submenu_parent_slug' => 'edit.php?post_type=' . nice_portfolio_post_type_name(),
		'name'                => nice_portfolio_plugin_slug(),
		'title'               => esc_html__( 'Settings', 'nice-portfolio' ),
		'textdomain'          => 'nice-portfolio',
		'settings_name'       => nice_portfolio_settings_name(),
		'templates_path'      => plugin_dir_path( __FILE__ ) . 'templates/',
	);

	return $admin_ui;
}
endif;
