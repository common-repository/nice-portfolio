<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains hooks for compatibility with the Jetpack plugin.
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

if ( ! function_exists( 'nice_portfolio_jp_carousel_maybe_disable' ) ) :
add_action( 'jp_carousel_maybe_disable', 'nice_portfolio_jp_carousel_maybe_disable' );
/**
 * Disable Jetpack Carousel, so it doesn't conflict with our Fancybox implementation.
 *
 * You can still use Jetpack Carousel by hooking into the
 * `nice_portfolio_disable_jetpack_carousel` filter and returning `false`.
 *
 * @since  1.0
 *
 * @return bool
 */
function nice_portfolio_jp_carousel_maybe_disable() {
	if ( apply_filters( 'nice_portfolio_disable_jetpack_carousel', true ) ) {
		$post_id = isset( $_SERVER['REQUEST_URI'] ) ? url_to_postid( $url = get_site_url() . wp_unslash( $_SERVER['REQUEST_URI'] ) ) : 0;
		$post    = get_post( $post_id );

		if ( ! empty( $post ) && nice_portfolio_post_type_name() === $post->post_type ) {
			return true;
		}
	}

	return false;
}
endif;
