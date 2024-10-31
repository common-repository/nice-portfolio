<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Register the portfolio post type.
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

if ( ! function_exists( 'nice_portfolio_add_post_type' ) ) :
add_filter( 'nice_portfolio_post_types', 'nice_portfolio_add_post_type' );
/**
 * Register the portfolio post type using our CPT creator library.
 *
 * @since  1.0
 *
 * @param  array $post_types Current list of post type data.
 *
 * @return array
 */
function nice_portfolio_add_post_type( array $post_types = array() ) {
	/**
	 * Prepare arguments.
	 */
	$args = array(
		'args'       => apply_filters( 'nice_portfolio_post_type', array() ),
		'taxonomies' => array(
			apply_filters( 'nice_portfolio_category', array() ),
			apply_filters( 'nice_portfolio_tag', array() ),
		),
		'textdomain' => nice_portfolio_textdomain(),
	);
	$args = apply_filters( 'nice_portfolio_register_portfolio_args', $args );

	$post_types[] = $args;

	return $post_types;
}
endif;
