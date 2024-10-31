<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Extra styles for Admin UI.
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

if ( ! function_exists( 'nice_portfolio_admin_ui_add_style' ) ) :
add_filter( 'nice_portfolio_admin_ui_style_extra', 'nice_portfolio_admin_ui_add_style' );
/**
 * Add custom CSS file to Admin UI.
 *
 * @since 1.0
 */
function nice_portfolio_admin_ui_add_style() {
	return NICE_PORTFOLIO_ADMIN_ASSETS_URL . 'css/nice-portfolio-admin-ui.css';
}
endif;
