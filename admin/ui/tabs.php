<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Register section tabs for Admin UI.
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

if ( ! function_exists( 'nice_portfolio_admin_ui_add_tabs' ) ) :
add_filter( 'nice_portfolio_admin_ui_tabs', 'nice_portfolio_admin_ui_add_tabs' );
/**
 * Create tabs.
 *
 * @since 1.0
 */
function nice_portfolio_admin_ui_add_tabs() {
	$tabs = array(
		array(
			'section' => 'settings',
			'args'    => array(
				'general' => array(
					'title'    => esc_html__( 'General', 'nice-portfolio' ),
					'icon'     => 'dashicons-admin-generic',
					'priority' => 10,
				),
			),
		),
		array(
			'section' => 'settings',
			'args'    => array(
				'images'  => array(
					'title'    => esc_html__( 'Images', 'nice-portfolio' ),
					'icon'     => 'dashicons-format-image',
					'priority' => 20,
				),
			),
		),
		array(
			'section' => 'settings',
			'args'    => array(
				'advanced' => array(
					'title'    => esc_html__( 'Advanced', 'nice-portfolio' ),
					'icon'     => 'dashicons-admin-settings',
					'priority' => 30,
				),
			),
		),
	);

	return $tabs;
}
endif;
