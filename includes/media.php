<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles processes for media management.
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

if ( ! function_exists( 'nice_portfolio_add_image_sizes' ) ) :
add_action( 'init', 'nice_portfolio_add_image_sizes' );
/**
 * Add custom image sizes
 *
 * @since 1.0
 */
function nice_portfolio_add_image_sizes() {
	$settings           = nice_portfolio_settings();
	$archive_image_size = $settings['archive_image_size'];
	$single_image_size  = $settings['single_image_size'];

	// Add size for archive images.
	add_image_size(
		'nice-portfolio-archive',
		absint( $archive_image_size['width'] ),
		absint( $archive_image_size['height'] ),
		$archive_image_size['crop']
	);

	// Add size for single project images.
	add_image_size(
		'nice-portfolio-single',
		absint( $single_image_size['width'] ),
		absint( $single_image_size['height'] ),
		$single_image_size['crop']
	);
}
endif;

if ( ! function_exists( 'nice_portfolio_get_attachment_id_by_name' ) ) :
/**
 * Obtain the numeric ID of an attachment by its name.
 *
 * @param $name
 *
 * @return mixed
 */
function nice_portfolio_get_attachment_id_by_name( $name ) {
	global $wpdb;

	$attachment = $wpdb->get_row( "SELECT ID FROM $wpdb->posts WHERE post_name = '$name'" );

	if ( $attachment !== null ) {
		return $attachment->ID;
	}

	return null;
}
endif;
