<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains general functions that can be used from the public side
 * of the plugin.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'nice_portfolio_obtain_instance' ) ) :
/**
 * Obtain an instance of the Nice_Portfolio class.
 *
 * A new instance will be created with the given arguments. If no arguments
 * are given, the function will return the last created instance of
 * Nice_Portfolio.
 *
 * @since  1.0
 *
 * @param  array          $args Arguments to create a new instance.
 *
 * @return Nice_Portfolio
 */
function nice_portfolio_obtain_instance( $args = null ) {
	return Nice_Portfolio::obtain( $args );
}
endif;

if ( ! function_exists( 'nice_portfolio_obtain_project' ) ) :
/**
 * Obtain a project by its ID.
 *
 * If no ID is provided, the one of the currently looped element will be
 * used instead.
 *
 * @since  1.0
 *
 * @param  null|int               $project_id
 *
 * @return Nice_Portfolio_Project
 */
function nice_portfolio_obtain_project( $project_id = null ) {
	return Nice_Portfolio_Project::obtain( $project_id );
}
endif;

if ( ! function_exists( 'nice_portfolio_needs_assets' ) ) :
/**
 * Check if we need to load assets.
 *
 * @since  1.0
 *
 * @return bool
 */
function nice_portfolio_needs_assets() {
	$post = get_post();

	$settings     = nice_portfolio_settings();
	$needs_assets = false;

	if ( ! $settings['avoidcss']                                                // Usage of scripts is permitted.
	     && (    ( $post && has_shortcode( $post->post_excerpt, 'portfolio' ) ) // Excerpt uses the shortcode.
	          || ( $post && has_shortcode( $post->post_content, 'portfolio' ) ) // Content uses the shortcode
	          || is_home()                                                      // Current page is home page.
	          || is_archive()                                                   // Current page is some kind of archive page.
	          || nice_portfolio_is_page()                                       // Current page is portfolio page.
	          || nice_portfolio_is_project_post_type()                          // Current page is for project post type.
	          || nice_portfolio_is_category()                                   // Current page is a portfolio category.
	          || nice_portfolio_is_tag()                                        // Current page is a portfolio tag.
		)
	) {
		$needs_assets = true;
	}

	/**
	 * @hook nice_portfolio_needs_assets
	 *
	 * Hook here in case you need to modify the result of this function.
	 *
	 * @since 1.0
	 */
	$needs_assets = apply_filters( 'nice_portfolio_needs_assets', $needs_assets );

	return $needs_assets;
}
endif;
