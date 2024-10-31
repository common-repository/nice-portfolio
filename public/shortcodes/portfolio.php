<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles shortcode functionality.
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

if ( ! function_exists( 'nice_portfolio_shortcode' ) ) :
/**
 * Process HTML for the `portfolio` shortcode.
 *
 * @since  1.0
 *
 * @param  array  $atts
 * @param  string $content
 * @param  string $tag
 *
 * @return string
 */
function nice_portfolio_shortcode( $atts = array(), $content = '', $tag ) {
	$atts      = is_array( $atts ) ? $atts : array();
	$shortcode = new Nice_Portfolio_Shortcode( $atts, $content, $tag );

	return $shortcode->output;
}
endif;

if ( ! shortcode_exists( 'portfolio' ) ) :
/**
 * Register `portfolio` shortcode.
 *
 * @since 1.0
 */
add_shortcode( 'portfolio', 'nice_portfolio_shortcode' );
endif;
