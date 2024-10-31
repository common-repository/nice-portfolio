<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Enqueue scripts for admin-facing side.
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

if ( ! function_exists( 'nice_portfolio_admin_enqueue_scripts' ) ) :
add_action( 'nice_portfolio_admin_enqueue_scripts', 'nice_portfolio_admin_enqueue_scripts' );
/**
 * Register and enqueue admin-specific JavaScript.
 *
 * @since 1.0
 */
function nice_portfolio_admin_enqueue_scripts() {
	// Obtain plugin slug and version.
	$slug    = nice_portfolio_plugin_slug();
	$version = nice_portfolio_plugin_version();

	// Obtain whether or not we're in debug mode.
	$debug = ( nice_portfolio_debug() || nice_portfolio_development_mode() );

	// Define script URLs.
	$scripts = array(
		$slug . '-admin-notices-script' => NICE_PORTFOLIO_ADMIN_ASSETS_URL . ( $debug ? 'js/nice-portfolio-admin-notices.js' : 'js/min/nice-portfolio-admin-notices.min.js' ),
		$slug . '-admin-script'         => NICE_PORTFOLIO_ADMIN_ASSETS_URL . ( $debug ? 'js/nice-portfolio-admin.js' : 'js/min/nice-portfolio-admin.min.js' ),
	);

	/**
	 * Admin notices script.
	 */
	if ( nice_portfolio_admin_is_update_notice_enabled() ) {
		wp_register_script( $slug . '-admin-notices-script', $scripts[ $slug . '-admin-notices-script' ], array( 'jquery' ), $version );
		wp_enqueue_script( $slug . '-admin-notices-script' );

		wp_localize_script( $slug . '-admin-notices-script', 'nice_portfolio_admin_notices_vars', array(
			'ajax_url' => admin_url() . 'admin-ajax.php',
			'nonce'    => wp_create_nonce( 'nice-portfolio-admin-notices-nonce' ),
		) );
	}

	/**
	 * Main admin script.
	 */
	$screen = get_current_screen();

	if ( 'edit' !== $screen->base ) {
		global $post, $wp_version;

		if ( ! empty( $post ) ) {
			if ( nice_portfolio_post_type_name() === $post->post_type ) {
				wp_register_script( $slug . '-admin-script', $scripts[ $slug . '-admin-script' ], array( 'jquery' ), $version );
				wp_enqueue_script( $slug . '-admin-script' );

				wp_localize_script( $slug . '-admin-script', 'nice_portfolio_vars', array(
					'post_id'               => isset( $post->ID ) ? $post->ID : null,
					'nice_version'          => $version,
					'wp_version'            => $wp_version,
					'use_this_file'         => esc_html__( 'Use This File', 'nice-portfolio' ),
					'new_media_ui'          => apply_filters( 'nice_portfolio_use_35_media_ui', 1 ),
					'remove_text'           => esc_html__( 'Remove', 'nice-portfolio' ),
					'edit_text'             => esc_html__( 'Edit', 'nice-portfolio' ),
					'add_to_gallery'        => esc_html__( 'Add Images to Project Gallery', 'nice-portfolio' ),
					'add_to_gallery_button' => esc_html__( 'Add to gallery', 'nice-portfolio' ),
				) );
			}
		}
	}
}
endif;
