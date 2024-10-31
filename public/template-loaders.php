<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains functions that load templates.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/** ==========================================================================
 *  Global Templates.
 *  ======================================================================= */

if ( ! function_exists( 'nice_portfolio_wrapper_start' ) ) :
/**
 * Print the opening content wrapper.
 *
 * @uses nice_portfolio_get_template()
 *
 * Remove this action using:
 *
	remove_action( 'nice_portfolio_before_main_content', 'nice_portfolio_wrapper_start', 10 );
 *
 * Then you can use `get_template_part()` to use your custom wrapper.
 *
 * @since 1.0
 */
function nice_portfolio_wrapper_start() {
	nice_portfolio_get_template( 'global/wrapper-start.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_wrapper_end' ) ) :
/**
 * Print the closing content wrapper.
 *
 * @uses nice_portfolio_get_template()
 *
 * Remove this action using:
 *
	remove_action( 'nice_portfolio_after_main_content', 'nice_portfolio_wrapper_end', 10 );
 *
 * Then you can use `get_template_part()` to use your custom wrapper.
 *
 * @since 1.0
 */
function nice_portfolio_wrapper_end() {
	nice_portfolio_get_template( 'global/wrapper-end.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_title' ) ) :
/**
 * Display a pre-formatted version of the title.
 *
 * Use this function only to display top-level page titles. It will not work for
 * titles within loops.
 *
 * @since 1.0
 *
 * @uses  nice_portfolio_the_title()
 */
function nice_portfolio_title() {
	nice_portfolio_get_template( 'global/title.php' );
}
endif;

/** ==========================================================================
 *  Loop Templates.
 *  ======================================================================= */

if ( ! function_exists( 'nice_portfolio_loop_empty' ) ) :
/**
 * Load template for the empty message.
 *
 * @since 1.0
 */
function nice_portfolio_loop_empty() {
	nice_portfolio_get_template( 'loop/empty/empty.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_filter_project_category' ) ) :
/**
 * HTML needed to filter projects by category in a portfolio page.
 *
 * @since 1.0
 */
function nice_portfolio_loop_filter_project_category() {
	if ( ! nice_portfolio_can_display_category_filter() ) {
		return;
	}

	nice_portfolio_get_template( 'loop/filter-project-category.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_filter_project_tag' ) ) :
/**
 * HTML needed to filter projects by tag in a portfolio page.
 *
 * @since 1.0
 */
function nice_portfolio_loop_filter_project_tag() {
	nice_portfolio_get_template( 'loop/filter-project-tag.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_filter_project_term' ) ) :
/**
 * HTML needed to filter projects by tag in a portfolio page.
 *
 * @since 1.0
 */
function nice_portfolio_loop_filter_project_term() {
	nice_portfolio_get_template( 'loop/filter-project-term.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_main_wrapper_start' ) ) :
/**
 * Load opening wrapper before the loop from `nice_portfolio()` has been processed.
 *
 * @since 1.0
 */
function nice_portfolio_loop_main_wrapper_start() {
	nice_portfolio_get_template( 'loop/main-wrapper-start.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_main_wrapper_end' ) ) :
/**
 * Load closing wrapper after the loop from `nice_portfolio()` has been processed.
 *
 * @since 1.0
 */
function nice_portfolio_loop_main_wrapper_end() {
	nice_portfolio_get_template( 'loop/main-wrapper-end.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_projects_page_navigation' ) ) :
/**
 * Display navigation to next/previous pages.
 *
 * @since 1.0
 */
function nice_portfolio_loop_projects_page_navigation() {
	global $wp_query;

	// Only load if we have more than one page.
	if ( $wp_query->max_num_pages > 1 ) {
		nice_portfolio_get_template( 'loop/projects-page-navigation.php' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_project_wrapper_start' ) ) :
/**
 * Load template with the opening wrapper for a looped project.
 *
 * @since 1.0
 */
function nice_portfolio_loop_project_wrapper_start() {
	nice_portfolio_get_template( 'loop/project/wrapper-start.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_project_wrapper_end' ) ) :
/**
 * Load template with the closing wrapper for a looped project.
 *
 * @since 1.0
 */
function nice_portfolio_loop_project_wrapper_end() {
	nice_portfolio_get_template( 'loop/project/wrapper-end.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_project_thumbnail' ) ) :
/**
 * Load template for the looped project thumbnail.
 *
 * @since 1.0
 */
function nice_portfolio_loop_project_thumbnail() {
	nice_portfolio_get_template( 'loop/project/featured-image.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_project_title' ) ) :
/**
 * Load template for the looped project title.
 *
 * @since 1.0
 */
function nice_portfolio_loop_project_title() {
	nice_portfolio_get_template( 'loop/project/title.php' );
}
endif;

/** ==========================================================================
 *  Single Project Templates.
 *  ======================================================================= */

if ( ! function_exists( 'nice_portfolio_single_project_embed' ) ) :
/**
 * Load template for the embed code of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_embed() {
	if ( nice_portfolio_project_can_display( 'embed' ) ) {
		nice_portfolio_get_template( 'single-project/embed.php' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_description' ) ) :
/**
 * Load template for the description of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_description() {
	nice_portfolio_get_template( 'single-project/description.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_thumbnail' ) ) :
/**
 * Load template for the thumbnail of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_thumbnail() {
	if ( ! nice_portfolio_project_can_display( 'embed' ) || ! nice_portfolio_get_project_embed() ) {
		nice_portfolio_get_template( 'single-project/featured-image.php' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_gallery' ) ) :
/**
 * Load template for the gallery of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_gallery() {
	nice_portfolio_get_template( 'single-project/gallery.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_meta' ) ) :
/**
 * Load template for the attributes of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_meta() {
	$display_template = ( nice_portfolio_project_can_display( 'url' ) && nice_portfolio_get_project_url() )
	                 || ( nice_portfolio_project_can_display( 'client' ) && nice_portfolio_get_project_client() )
	                 || ( nice_portfolio_project_can_display( 'start_date' ) && nice_portfolio_get_project_start_date() )
	                 || ( nice_portfolio_project_can_display( 'end_date' ) && nice_portfolio_get_project_end_date() );

	if ( apply_filters( 'nice_portfolio_single_project_meta_display_template', $display_template ) ) {
		nice_portfolio_get_template( 'single-project/meta.php' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_details' ) ) :
/**
 * Load template for the details of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_details() {
	$display_template = ( nice_portfolio_project_can_display( 'client' ) && nice_portfolio_get_project_client() )
	                 || ( nice_portfolio_project_can_display( 'start_date' ) && nice_portfolio_get_project_start_date() )
	                 || ( nice_portfolio_project_can_display( 'end_date' ) && nice_portfolio_get_project_end_date() );

	if ( apply_filters( 'nice_portfolio_single_project_details_display_template', $display_template ) ) {
		nice_portfolio_get_template( 'single-project/details.php' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_url' ) ) :
/**
 * Load template for the URL of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_url() {
	if ( nice_portfolio_project_can_display( 'url' ) ) {
		nice_portfolio_get_template( 'single-project/url.php' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_categories' ) ) :
/**
 * Load template for the categories of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_categories() {
	nice_portfolio_get_template( 'single-project/categories.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_tags' ) ) :
/**
 * Load template for the tags of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_tags() {
	nice_portfolio_get_template( 'single-project/tags.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_related' ) ) :
/**
 * Load template for related projects.
 *
 * @since 1.0
 */
function nice_portfolio_single_project_related() {
	nice_portfolio_get_template( 'single-project/related.php' );
}
endif;

if ( ! function_exists( 'nice_portfolio_single_project_navigation' ) ) :
/**
 * Display navigation for portfolio projects.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_single_project_navigation() {
	nice_portfolio_get_template( 'single-project/navigation.php' );
}
endif;
