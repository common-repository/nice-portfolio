<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles the initialization of the plugin's templating system.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/** ==========================================================================
 *  Initial basic setup.
 *  ======================================================================= */
if ( ! function_exists( 'nice_portfolio_templates_dir' ) ) :
add_filter( 'nice_portfolio_templates_dir', 'nice_portfolio_templates_dir' );
/**
 * Define the name of the directory where templates should be placed within a
 * theme.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Nice_Portfolio_Template_Handler::get_theme_template_dir_name()
 *
 * @return string
 */
function nice_portfolio_templates_dir() {
	return 'portfolio';
}
endif;

if ( ! function_exists( 'nice_portfolio_current_page_template' ) ) :
add_filter( 'nice_portfolio_template_include', 'nice_portfolio_current_page_template' );
/**
 * Set the location of the current template.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Nice_Portfolio_PublicDisplayResponder::template_include()
 *
 * @param  string $template Current page template.
 *
 * @return string
 */
function nice_portfolio_current_page_template( $template ) {
	return Nice_Portfolio_Page_Template::obtain( $template );
}
endif;

if ( ! function_exists( 'nice_portfolio_setup_current_page' ) ) :
add_action( 'nice_portfolio_setup_page', 'nice_portfolio_setup_current_page' );
/**
 * Setup hooks for the current page.
 *
 * All actions that generate specific HTML output for different portfolio
 * pages should be hooked to the actions that are fired within the
 * following function.
 *
 * @uses  Nice_Portfolio_Setup_Page::init()
 *
 * @see   nice_portfolio_setup_page()
 * @see   nice_portfolio_setup_category_page()
 * @see   nice_portfolio_setup_tag_page()
 * @see   nice_portfolio_setup_archive_page()
 *
 * Hook origin:
 * @see Nice_Portfolio_PublicDisplayResponder::setup_page()
 *
 * @since 1.0
 */
function nice_portfolio_setup_current_page() {
	Nice_Portfolio_Setup_Page::init();
}
endif;

/** ==========================================================================
 *  Page setup.
 *  ======================================================================= */
if ( ! function_exists( 'nice_portfolio_setup_page' ) ) :
add_action( 'nice_portfolio_page', 'nice_portfolio_setup_page' );
/**
 * Setup hooks for portfolio page.
 *
 * Hook origin:
 * @see nice_portfolio_setup_current_page()
 * @see Nice_Portfolio_Setup_Page::setup_portfolio_page()
 *
 * @since 1.0
 */
function nice_portfolio_setup_page() {

}
endif;

if ( ! function_exists( 'nice_portfolio_setup_category_page' ) ) :
add_action( 'nice_portfolio_category_page', 'nice_portfolio_setup_category_page' );
/**
 * Setup hooks for portfolio category page.
 *
 * Hook origin:
 * @see nice_portfolio_setup_current_page()
 * @see Nice_Portfolio_Setup_Page::setup_portfolio_category_page()
 *
 * @since 1.0
 */
function nice_portfolio_setup_category_page() {
	/**
	 * Set the title of the current page to the category title.
	 *
	 * @since 1.0
	 *
	 * @uses  nice_portfolio_get_category_title()
	 */
	add_filter( 'nice_portfolio_the_title', 'nice_portfolio_get_category_title', 10 );
}
endif;

if ( ! function_exists( 'nice_portfolio_setup_tag_page' ) ) :
add_action( 'nice_portfolio_tag_page', 'nice_portfolio_setup_tag_page' );
/**
 * Setup hooks for portfolio tag page.
 *
 * Hook origin:
 * @see nice_portfolio_setup_current_page()
 * @see Nice_Portfolio_Setup_Page::setup_portfolio_tag_page()
 *
 * @since 1.0
 */
function nice_portfolio_setup_tag_page() {
	/**
	 * Set the title of the current page to the tag title.
	 *
	 * @since 1.0
	 *
	 * @uses  nice_portfolio_get_tag_title()
	 */
	add_filter( 'nice_portfolio_the_title', 'nice_portfolio_get_tag_title', 10 );
}
endif;

if ( ! function_exists( 'nice_portfolio_setup_archive_page' ) ) :
add_action( 'nice_portfolio_archive_page', 'nice_portfolio_setup_archive_page' );
/**
 * Setup hooks for portfolio archive page.
 *
 * Hook origin:
 * @see nice_portfolio_setup_current_page()
 * @see Nice_Portfolio_Setup_Page::setup_portfolio_archive_page()
 *
 * @since 1.0
 */
function nice_portfolio_setup_archive_page() {
	/**
	 * Set the title of the current page to the archive title.
	 *
	 * @since 1.0
	 *
	 * @uses  nice_portfolio_get_archive_title()
	 */
	add_filter( 'nice_portfolio_the_title', 'nice_portfolio_get_archive_title', 10 );
}
endif;
