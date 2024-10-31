<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains hooks for compatibility with the Twenty Eleven theme.
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

if ( ! function_exists( 'nice_portfolio_twentyeleven_wrapper_start' ) ) :
add_filter( 'nice_portfolio_wrapper_start', 'nice_portfolio_twentyeleven_wrapper_start' );
/**
 * Define opening template wrapper.
 *
 * @since 1.0
 */
function nice_portfolio_twentyeleven_wrapper_start() {
	return '<div id="primary"><div id="content" role="main" class="nice-portfolio-content twentyeleven">';
}
endif;

if ( ! function_exists( 'nice_portfolio_twentyeleven_remove_sidebar' ) ) :
add_action( 'nice_portfolio_after_page_setup', 'nice_portfolio_twentyeleven_remove_sidebar', 10 );
/**
 * Remove default plugin sidebar.
 *
 * @since 1.0
 */
function nice_portfolio_twentyeleven_remove_sidebar() {
	remove_action( 'nice_portfolio_sidebar', 'nice_portfolio_sidebar', 10 );
}
endif;

if ( ! function_exists( 'nice_portfolio_twentyeleven_page_navigation' ) ) :
remove_action( 'nice_portfolio_after_main_content', 'nice_portfolio_loop_projects_page_navigation', 0 );
add_action( 'nice_portfolio_after_main_content', 'nice_portfolio_twentyeleven_page_navigation', 0 );
/**
 * Display custom page navigation.
 *
 * @since 1.0
 */
function nice_portfolio_twentyeleven_page_navigation() {
	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	?>
		<nav id="<?php nice_portfolio_page_navigation_id(); ?>">
			<h3 class="assistive-text"><?php esc_html_e( 'Project navigation', 'nice-portfolio' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( wp_kses( __( '<span class="meta-nav">&larr;</span> Older projects', 'nice-portfolio' ), array( 'span' => array( 'class' => array() ) ) ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( wp_kses( __( 'Newer projects <span class="meta-nav">&rarr;</span>', 'nice-portfolio' ), array( 'span' => array( 'class' => array() ) ) ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php
}
endif;

if ( ! function_exists( 'nice_portfolio_twentyeleven_project_navigation' ) ) :
remove_action( 'nice_portfolio_after_single_project', 'nice_portfolio_single_project_navigation', 10 );
add_action( 'nice_portfolio_before_single_project', 'nice_portfolio_twentyeleven_project_navigation', 10 );
/**
 * Display page navigation for Twenty Eleven.
 *
 * @since 1.0
 */
function nice_portfolio_twentyeleven_project_navigation() {
	?>
		<nav id="nav-single">
			<h3 class="assistive-text"><?php esc_html_e( 'Project navigation', 'nice-portfolio' ); ?></h3>
			<span class="nav-previous"><?php previous_post_link( '%link', wp_kses( __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ), array( 'span' => array( 'class' => array() ) ) ) ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', wp_kses( __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ), array( 'span' => array( 'class' => array() ) ) ) ); ?></span>
		</nav><!-- #nav-single -->
	<?php
}
endif;

/**
 * Remove thumbnail from single project in Twenty Eleven.
 *
 * @since 1.0
 */
remove_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_thumbnail', 10 );
