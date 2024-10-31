<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file includes actions to handle styles for the public-facing side of
 * the plugin.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'nice_portfolio_enqueue_styles' ) ) :
add_action( 'nice_portfolio_plugin_enqueue_styles', 'nice_portfolio_enqueue_styles' );
/**
 * Enqueue styles for portfolio.
 *
 * @since 1.0
 */
function nice_portfolio_enqueue_styles() {
	$settings = nice_portfolio_settings();

	if ( nice_portfolio_needs_assets() && ! $settings['avoidcss'] ) {
		$slug    = nice_portfolio_plugin_slug();
		$version = nice_portfolio_plugin_version();

		// Enqueue portfolio styles.
		wp_enqueue_style(
			$slug . '-styles',
			NICE_PORTFOLIO_ASSETS_URL . 'css/nice-portfolio.css',
			array(),
			$version
		);
	}
}
endif;
