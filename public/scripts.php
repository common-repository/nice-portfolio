<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file includes actions to handle scripts for the public-facing side of
 * the plugin.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'nice_portfolio_enqueue_scripts' ) ) :
add_action( 'nice_portfolio_plugin_enqueue_scripts', 'nice_portfolio_enqueue_scripts' );
/**
 * Enqueue scripts for portfolio functionality.
 *
 * @since 1.0
 */
function nice_portfolio_enqueue_scripts() {
	if ( nice_portfolio_needs_assets() ) {
		$debug = ( nice_portfolio_debug() || nice_portfolio_development_mode() );

		// If not debugging, use minified scripts.
		$scripts = array(
			'portfolio' => $debug ? 'js/nice-portfolio.js'  : 'js/min/nice-portfolio.min.js',
		);

		$slug    = nice_portfolio_plugin_slug();
		$version = nice_portfolio_plugin_version();

		// Enqueue handler file.
		wp_enqueue_script(
			$slug . '-script',
			NICE_PORTFOLIO_ASSETS_URL . $scripts['portfolio'],
			array( 'jquery' ),
			$version
		);

		$local_vars = apply_filters( 'nice_portfolio_script_vars', array(
				'useTermFilter' => true,
			)
		);

		wp_localize_script( $slug . '-script', 'NicePortfolioVars', $local_vars );
	}
}
endif;
