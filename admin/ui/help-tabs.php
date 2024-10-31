<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Create help tabs for Admin UI.
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

if ( ! function_exists( 'nice_portfolio_admin_ui_add_help_tabs' ) ) :
add_filter( 'nice_portfolio_admin_ui_help_tabs', 'nice_portfolio_admin_ui_add_help_tabs', 10, 2 );
/**
 * Create help tabs.
 *
 * @since 1.0
 *
 * @param array                   $help_tabs List of current help tabs.
 * @param Nice_Portfolio_Admin_UI $ui        Current Admin UI object.
 *
 * @return array
 */
function nice_portfolio_admin_ui_add_help_tabs( $help_tabs = array(), Nice_Portfolio_Admin_UI $ui ) {
	$help_tabs = ! empty( $help_tabs ) && is_array( $help_tabs ) ? $help_tabs : array();

	$help_tabs = array_merge( $help_tabs, array(
		array(
			'section' => 'settings',
			'args'    => array(
				'nice-portfolio-general-settings' => array(
					'id'      => 'nice-portfolio-general-settings',
					'title'   => esc_html__( 'General Settings', 'nice-portfolio' ),
					'content' => $ui->get_template_part( 'help-tab-general', '', true ),
				),
				'nice-portfolio-images-settings' => array(
					'id'      => 'nice-portfolio-images-settings',
					'title'   => esc_html__( 'Images Settings', 'nice-portfolio' ),
					'content' => $ui->get_template_part( 'help-tab-images', '', true ),
				),
				'nice-portfolio-advanced-settings' => array(
					'id'      => 'nice-portfolio-advanced-settings',
					'title'   => esc_html__( 'Advanced Settings', 'nice-portfolio' ),
					'content' => $ui->get_template_part( 'help-tab-advanced', '', true ),
				),
				'nice-portfolio-help-support' => array(
					'id'      => 'nice-portfolio-help-support',
					'title'   => esc_html__( 'Help & Support', 'nice-portfolio' ),
					'content' => $ui->get_template_part( 'help-tab-help', '', true ),
				),
				'nice-portfolio-compatible-themes' => array(
					'id'      => 'nice-portfolio-compatible-themes',
					'title'   => esc_html__( 'Compatible Themes', 'nice-portfolio' ),
					'content' => $ui->get_template_part( 'help-tab-themes', '', true ),
				),
			),
		),
	) );

	return $help_tabs;
}
endif;
