<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains hooks for compatibility with the Twenty Twelve theme.
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

if ( ! function_exists( 'nice_portfolio_twentytwelve_wrapper_start' ) ) :
add_filter( 'nice_portfolio_wrapper_start', 'nice_portfolio_twentytwelve_wrapper_start' );
/**
 * Define opening template wrapper.
 *
 * @since 1.0
 */
function nice_portfolio_twentytwelve_wrapper_start() {
	return '<div id="primary" class="site-content"><div id="content" role="main" class="nice-portfolio-content twentytwelve">';
}
endif;

if ( ! function_exists( 'nice_portfolio_twentytwelve_before_single_project' ) ) :
add_action( 'nice_portfolio_before_single_project', 'nice_portfolio_twentytwelve_before_single_project' );
/**
 * Print HTML before a single project.
 *
 * @since 1.0
 */
function nice_portfolio_twentytwelve_before_single_project() {
	echo '<article>';
}
endif;

if ( ! function_exists( 'nice_portfolio_twentytwelve_after_single_project' ) ) :
add_action( 'nice_portfolio_after_single_project', 'nice_portfolio_twentytwelve_after_single_project' );
/**
 * Print HTML after a single project.
 *
 * @since 1.0
 */
function nice_portfolio_twentytwelve_after_single_project() {
	echo '</article>';
}
endif;

if ( ! function_exists( 'nice_portfolio_twentytwelve_page_navigation' ) ) :
remove_action( 'nice_portfolio_after_main_content', 'nice_portfolio_loop_projects_page_navigation', 0 );
add_action( 'nice_portfolio_after_main_content', 'nice_portfolio_twentytwelve_page_navigation', 0 );
/**
 * Display page navigation for Twenty Thirteen.
 *
 * @since 1.0
 */
function nice_portfolio_twentytwelve_page_navigation() {
	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	twentytwelve_content_nav( 'nav-below' );
}
endif;

if ( ! function_exists( 'nice_portfolio_twentytwelve_project_navigation' ) ) :
remove_action( 'nice_portfolio_after_single_project', 'nice_portfolio_single_project_navigation', 10 );
add_action( 'nice_portfolio_after_single_project', 'nice_portfolio_twentytwelve_project_navigation', 10 );
/**
 * Display page navigation for Twenty Twelve.
 *
 * @since 1.0
 */
function nice_portfolio_twentytwelve_project_navigation() {
	?>
		<nav class="nav-single">
			<h3 class="assistive-text"><?php esc_html_e( 'Projects navigation', 'nice-portfolio' ); ?></h3>
			<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous project link', 'nice-portfolio' ) . '</span> %title' ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next project link', 'nice-portfolio' ) . '</span>' ); ?></span>
		</nav><!-- .nav-single -->
	<?php
}
endif;
