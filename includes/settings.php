<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles functionality related to plugin settings.
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

if ( ! function_exists( 'nice_portfolio_set_default_settings' ) ) :
add_filter( 'nice_portfolio_default_settings', 'nice_portfolio_set_default_settings' );
/**
 * Set default plugin settings.
 *
 * @see    nice_portfolio_default_settings()
 *
 * @since  1.0
 *
 * @return array
 */
function nice_portfolio_set_default_settings() {
	$defaults = array(
		'remove_data_on_deactivation'   => false,
		'rewrite_archive_slug'          => 'portfolio',
		'rewrite_project_slug'          => 'portfolio',
		'rewrite_category_slug'         => 'portfolio-category',
		'rewrite_tag_slug'              => 'portfolio-tag',
		'avoidcss'                      => false,
		'portfolio_page'                => null,
		'limit'                         => get_option( 'posts_per_page' ),
		'columns'                       => 3,
		'orderby'                       => 'id',
		'order'                         => 'desc',
		'display_category_filter'       => true,
		'visible_data'                  => array(
			'embed'      => 1,
			'client'     => 1,
			'location'   => 1,
			'start_date' => 1,
			'end_date'   => 1,
			'url'        => 1,
		),
		'archive_image_size'            => array(
			'width'  => 300,
			'height' => 300,
			'crop'   => true,
		),
		'single_image_size'             => array(
			'width'  => 1024,
			'height' => 1024,
			'crop'   => false,
		),
	);

	return $defaults;
}
endif;
