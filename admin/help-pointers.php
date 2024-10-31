<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles help pointers for the admin-facing side of the plugin.
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

if ( ! function_exists( 'nice_portfolio_admin_pointers_data' ) ) :
add_filter( 'nice_portfolio_admin_pointers_data', 'nice_portfolio_admin_pointers_data' );
/**
 * Register help pointers.
 *
 * @since  1.0
 *
 * @param  array $pointers Current lis of help pointers.
 *
 * @return array
 */
function nice_portfolio_admin_pointers_data( array $pointers = null ) {
	$pointers[] = array(
		'id'       => 'nice_portfolio_help_pointer',
		'screen'   => nice_portfolio_post_type_name() . '_page_' . nice_portfolio_plugin_slug(),
		'target'   => '#navtabs a:first-child',
		'title'    => nice_portfolio_plugin_name(),
		'content'  => esc_html__( 'Thank you for installing this plugin :) In this page you can set all the available options to display your projects the way you want.', 'nice-portfolio' ),
		'position' => array(
			'edge'  => 'left',   // top, bottom, left, right
			'align' => 'middle', // top, bottom, left, right, middle
		),
	);

	return $pointers;
}
endif;
