<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Register widgets for this plugin and schedule related hooks.
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

if ( ! function_exists( 'nice_portfolio_register_widgets' ) ) :
add_action( 'widgets_init', 'nice_portfolio_register_widgets' );
/**
 * Register widgets for this plugin.
 *
 * @since 1.0
 */
function nice_portfolio_register_widgets() {
	/**
	 * @hook nice_portfolio_enable_widget_categories
	 *
	 * Hook here if you don't want to register this widget.
	 *
	 * @since 1.0
	 */
	if ( apply_filters( 'nice_portfolio_enable_widget_categories', true ) ) {
		/**
		 * Portfolio Categories.
		 *
		 * @since 1.0
		 */
		register_widget( 'Nice_Portfolio_Categories_Widget' );
	}

	/**
	 * @hook nice_portfolio_enable_widget_recent_projects
	 *
	 * Hook here if you don't want to register this widget.
	 *
	 * @since 1.0
	 */
	if ( apply_filters( 'nice_portfolio_enable_widget_recent_projects', true ) ) {
		/**
		 * Recent Projects.
		 *
		 * @since 1.0
		 */
		register_widget( 'Nice_Portfolio_Recent_Projects_Widget' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_widget_loaded' ) ) :
add_action( 'nice_portfolio_widget_loaded', 'nice_portfolio_widget_loaded' );
/**
 * Schedule hooks when a widget is loaded.
 *
 * @since 1.0
 *
 * @param Nice_Portfolio_WP_Widget $widget Current widget being processed.
 */
function nice_portfolio_widget_loaded( Nice_Portfolio_WP_Widget $widget ) {
	add_action( 'save_post',    array( $widget, 'flush_cache' ) );
	add_action( 'deleted_post', array( $widget, 'flush_cache' ) );
	add_action( 'switch_theme', array( $widget, 'flush_cache' ) );
}
endif;

if ( ! function_exists( 'nice_portfolio_widgets_setup_assets' ) ) :
add_action( 'nice_portfolio_widget_loaded', 'nice_portfolio_widgets_setup_assets' );
/**
 * Schedule hooks when the widgets are displayed in the front end.
 *
 * @since 1.0
 */
function nice_portfolio_widgets_setup_assets() {
	$settings = nice_portfolio_settings();

	/**
	 * Load assets when Portfolio Categories widget needs to be displayed.
	 */
	if ( ! is_admin() && ! nice_portfolio_doing_ajax() && ! $settings['avoidcss'] ) {
		add_filter( 'nice_portfolio_needs_assets', '__return_true' );
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_widget_wrapper_start' ) ) :
add_action( 'nice_portfolio_before_widget_content', 'nice_portfolio_widget_wrapper_start', 10 );
/**
 * Print the opening HTML for our widgets.
 *
 * @since 1.0
 */
function nice_portfolio_widget_wrapper_start() {
	nice_portfolio_get_template_part( 'widgets/wrapper-start' );
}
endif;

if ( ! function_exists( 'nice_portfolio_widget_wrapper_end' ) ) :
add_action( 'nice_portfolio_after_widget_content', 'nice_portfolio_widget_wrapper_end', 10 );
/**
 * Print the closing HTML for our widgets.
 *
 * @since 1.0
 */
function nice_portfolio_widget_wrapper_end() {
	nice_portfolio_get_template_part( 'widgets/wrapper-end' );
}
endif;
