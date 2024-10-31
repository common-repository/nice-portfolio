<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file includes general functions that can be used from both the public
 * and admin-facing side of this plugin.
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

if ( ! function_exists( 'nice_portfolio_post_type_name' ) ) :
/**
 * Name of main custom post type of this plugin.
 *
 * @since 1.0
 */
function nice_portfolio_post_type_name() {
	static $post_type_name = null;

	if ( $post_type_name !== null ) {
		return $post_type_name;
	}

	/**
	 * @hook nice_portfolio_post_type_name
	 *
	 * Hook here if you want to modify the name of the post type.
	 *
	 * @since 1.0
	 */
	$post_type_name = apply_filters( 'nice_portfolio_post_type_name', 'portfolio_project' );

	return $post_type_name;
}
endif;

if ( ! function_exists( 'nice_portfolio_category_name' ) ) :
/**
 * Name of category for this plugin's post type.
 *
 * @since 1.0
 */
function nice_portfolio_category_name() {
	static $category_name = null;

	if ( $category_name !== null ) {
		return $category_name;
	}

	/**
	 * @hook nice_portfolio_category_name
	 *
	 * Hook here if you want to modify the name of the category.
	 *
	 * @since 1.0
	 */
	$category_name = apply_filters( 'nice_portfolio_category_name', 'portfolio_category' );

	return $category_name;
}
endif;

if ( ! function_exists( 'nice_portfolio_tag_name' ) ) :
/**
 * Name of tag for this plugin's post type.
 *
 * @since 1.0
 */
function nice_portfolio_tag_name() {
	static $tag_name = null;

	if ( $tag_name !== null ) {
		return $tag_name;
	}

	/**
	 * @hook nice_portfolio_tag_name
	 *
	 * Hook here if you want to modify the name of the tag.
	 *
	 * @since 1.0
	 */
	$tag_name = apply_filters( 'nice_portfolio_tag_name', 'portfolio_tag' );

	return $tag_name;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_current_post' ) ) :
/**
 * Obtain currently viewed post from custom post type.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_get_current_post() {
	static $current_post = null;

	if ( $current_post !== null ) {
		return $current_post;
	}

	$current_post = get_query_var( nice_portfolio_post_type_name() );

	return $current_post;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_current_category' ) ) :
/**
 * Obtain currently viewed category from portfolio category.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_get_current_category() {
	static $current_category = null;

	if ( $current_category !== null ) {
		return $current_category;
	}

	$current_category = get_query_var( nice_portfolio_category_name() );

	return $current_category;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_current_tag' ) ) :
/**
 * Obtain currently viewed tag from custom post type.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_get_current_tag() {
	static $current_tag = null;

	if ( $current_tag !== null ) {
		return $current_tag;
	}

	$current_tag = get_query_var( nice_portfolio_tag_name() );

	return $current_tag;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_page_permalink' ) ) :
/**
 * Obtain the URI of the selected portfolio page.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_get_page_permalink() {
	static $portfolio_page_uri = null;

	if ( ! is_null( $portfolio_page_uri ) ) {
		return $portfolio_page_uri;
	}

	$settings = nice_portfolio_settings();

	$permalink = empty( $settings['portfolio_page'] ) ? null : get_permalink( $settings['portfolio_page'] );

	return $permalink;
}
endif;

if ( ! function_exists( 'nice_portfolio_page_permalink' ) ) :
/**
 * Print result from nice_portfolio_get_page_permalink().
 *
 * @see   nice_portfolio_get_page_permalink()
 *
 * @since 1.0
 */
function nice_portfolio_page_permalink() {
	echo nice_portfolio_get_page_permalink();
}
endif;

if ( ! function_exists( 'nice_portfolio_is_page' ) ) :
/**
 * Check if the current page is the selected portfolio page.
 *
 * @since  1.0
 *
 * @param  int  $post_id Check if the current (or given) page is the selected portfolio page.
 *
 * @return bool
 */
function nice_portfolio_is_page( $post_id = null ) {
	static $is_portfolio_page = null;

	if ( $is_portfolio_page !== null ) {
		return $is_portfolio_page;
	}

	$settings = nice_portfolio_settings();

	// Obtain post from current loop iteration (if any).
	$post = get_post( $post_id );

	// Set an initial value for the return variable.
	$is_portfolio_page = false;

	// Check if the current page is the selected one.
	if ( $post instanceof WP_Post && $post->ID && $post->ID == $settings['portfolio_page'] ) {
		$is_portfolio_page = true;
	}

	return $is_portfolio_page;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_project_post_type' ) ) :
/**
 * Check if the current page belongs to the portfolio project post type.
 *
 * @since 1.0
 *
 * @return bool
 */
function nice_portfolio_is_project_post_type() {
	$post_type = get_post_type();

	if ( ! $post_type && is_admin() && function_exists( 'get_current_screen' ) ) {
		$screen = get_current_screen();
		$post_type = isset( $screen->post_type ) ? $screen->post_type : $post_type;
	}

	// Compare custom post type with current post type.
	$is_project_post_type = ( nice_portfolio_post_type_name() == $post_type );

	return $is_project_post_type;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_404' ) ) :
/**
 * Check if the current page is a 404 error page triggered by a portfolio post type or taxonomy.
 *
 * @since  1.0
 *
 * @return bool
 */
function nice_portfolio_is_404() {
	return nice_portfolio_is_project_404() || nice_portfolio_is_category_404() || nice_portfolio_is_tag_404();
}
endif;

if ( ! function_exists( 'nice_portfolio_is_project_404' ) ) :
/**
 * Check if the current page is a 404 error page triggered by a portfolio menu item.
 *
 * @since  1.0
 *
 * @return bool
 *
 */
function nice_portfolio_is_project_404() {
	static $is_project_404 = null;

	if ( ! is_null( $is_project_404 ) ) {
		return $is_project_404;
	}

	// Check if we're in a 404 page.
	$is_404 = is_404();

	// Set initial state.
	$is_project_404 = false;

	// Initialize filter arguments.
	$filter_args = array(
		'is_404' => $is_404,
	);

	if ( $is_404 ) {
		// Retrieve relevant query vars.
		$query_post_type = get_query_var( 'post_type' );

		// Check if the current 404 page was triggered from a portfolio project.
		$is_query_project_404 = ( $query_post_type == nice_portfolio_post_type_name() );

		// Evaluate all previous values.
		$is_project_404 = $is_404 && $is_query_project_404;

		// Add corresponding filter arguments.
		$filter_args['is_menu_item_404'] = $is_query_project_404;
	}

	return $is_project_404;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_category_404' ) ) :
/**
 * Check if the current page is a 404 error page triggered by a portfolio category.
 *
 * @since 1.0
 *
 * @return bool
 *
 */
function nice_portfolio_is_category_404() {
	static $is_category_404 = null;

	if ( ! is_null( $is_category_404 ) ) {
		return $is_category_404;
	}

	$is_category_404 = false;

	// Check if we're in a 404 page.
	$is_404 = is_404();

	// Initialize filter arguments.
	$filter_args = array(
		'is_404' => $is_404,
	);

	if ( $is_404 ) {

		// Retrieve relevant query vars.
		$query_taxonomy  = get_query_var('taxonomy');

		// Check if the current 404 page was triggered from a portfolio category.
		$is_query_category_404  = ( $query_taxonomy  == nice_portfolio_category_name() );

		// Evaluate all previous values.
		$is_category_404 = $is_404 && $is_query_category_404;

		// Add corresponding filter arguments.
		$filter_args['is_category_404'] = $is_query_category_404;
	}

	return $is_category_404;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_tag_404' ) ) :
/**
 * Check if the current page is a 404 error page triggered by a portfolio tag.
 *
 * @since 1.0
 *
 * @return bool
 *
 */
function nice_portfolio_is_tag_404() {
	static $is_tag_404 = null;

	if ( ! is_null( $is_tag_404 ) ) {
		return $is_tag_404;
	}

	$is_tag_404 = false;

	// Check if we're in a 404 page.
	$is_404 = is_404();

	// Initialize filter arguments.
	$filter_args = array(
		'is_404' => $is_404,
	);

	if ( $is_404 ) {

		// Retrieve relevant query vars.
		$query_taxonomy  = get_query_var('taxonomy');

		// Check if the current 404 page was triggered from a portfolio tag.
		$is_query_tag_404  = ( $query_taxonomy  == nice_portfolio_tag_name() );

		// Evaluate all previous values.
		$is_tag_404 = $is_404 && $is_query_tag_404;

		// Add corresponding filter arguments.
		$filter_args['is_tag_404'] = $is_query_tag_404;
	}

	return $is_tag_404;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_single' ) ) :
/**
 * Check if the current page is a single portfolio project.
 *
 * @since  1.0
 *
 * @return bool
 *
 */
function nice_portfolio_is_single() {
	static $is_portfolio_single = null;

	if ( is_null( $is_portfolio_single ) ) {
		// Check if we're in a portfolio project page.
		$is_portfolio_single = nice_portfolio_bool( nice_portfolio_get_current_post() );
	}

	return $is_portfolio_single;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_archive' ) ) :
/**
 * Check if the current page is a portfolio archive.
 *
 * @since 1.0
 *
 * @return bool
 */
function nice_portfolio_is_archive() {
	static $is_portfolio_archive = null;

	if ( $is_portfolio_archive !== null ) {
		return $is_portfolio_archive;
	}

	// Check if the current page is an archive.
	$is_archive = is_archive() && ! is_tax();

	// Check if the current page belongs to the portfolio project post type.
	$is_portfolio = nice_portfolio_is_project_post_type();

	// Evaluate both previous values.
	$is_portfolio_archive = $is_archive && $is_portfolio;

	return $is_portfolio_archive;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_category' ) ) :
/**
 * Check if the current page is a portfolio category.
 *
 * @since 1.0
 *
 * @return mixed|string|bool Slug of the current category, or false if not found.
 */
function nice_portfolio_is_category() {
	static $is_portfolio_category = null;

	if ( $is_portfolio_category !== null ) {
		return $is_portfolio_category;
	}

	// Check for a current portfolio category.
	$is_portfolio_category = nice_portfolio_get_current_category();

	return $is_portfolio_category;
}
endif;

if ( ! function_exists( 'nice_portfolio_is_tag' ) ) :
/**
 * Check if the current page is a portfolio tag.
 *
 * @since 1.0
 *
 * @return mixed|string|bool  Slug of the current tag, or false if not found.
 */
function nice_portfolio_is_tag() {
	static $is_portfolio_tag = null;

	if ( $is_portfolio_tag !== null ) {
		return $is_portfolio_tag;
	}

	// Check for a current portfolio category.
	$is_portfolio_tag = nice_portfolio_get_current_tag();

	return $is_portfolio_tag;
}
endif;
