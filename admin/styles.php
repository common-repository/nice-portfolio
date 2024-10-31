<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Enqueue styles for admin-facing side.
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

if ( ! function_exists( 'nice_portfolio_admin_enqueue_styles' ) ) :
add_action( 'nice_portfolio_admin_enqueue_styles', 'nice_portfolio_admin_enqueue_styles' );
/**
 * Register and enqueue admin-specific stylesheet.
 *
 * @since 1.0
 */
function nice_portfolio_admin_enqueue_styles() {
	$screen = get_current_screen();

	if ( nice_portfolio_post_type_name() === $screen->post_type ) {
		wp_enqueue_style(
			nice_portfolio_plugin_slug() . '-admin-styles',
			NICE_PORTFOLIO_ADMIN_ASSETS_URL . 'css/nice-portfolio-admin.css',
			array(),
			nice_portfolio_plugin_version()
		);
	}
}
endif;
