<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains hooks for compatibility with the Twenty Thirteen theme.
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

if ( ! function_exists( 'nice_portfolio_twentythirteen_wrapper_start' ) ) :
add_filter( 'nice_portfolio_wrapper_start', 'nice_portfolio_twentythirteen_wrapper_start' );
/**
 * Define opening template wrapper.
 *
 * @since 1.0
 */
function nice_portfolio_twentythirteen_wrapper_start() {
	return '<div id="primary" class="site-content"><div id="content" role="main" class="nice-portfolio-content twentythirteen">';
}
endif;

if ( ! function_exists( 'nice_portfolio_twentythirteen_page_navigation' ) ) :
remove_action( 'nice_portfolio_after_main_content', 'nice_portfolio_loop_projects_page_navigation', 0 );
add_action( 'nice_portfolio_after_main_content', 'nice_portfolio_twentythirteen_page_navigation', 0 );
/**
 * Display page navigation for Twenty Thirteen.
 *
 * @since 1.0
 */
function nice_portfolio_twentythirteen_page_navigation() {
	twentythirteen_paging_nav();
}
endif;

if ( ! function_exists( 'nice_portfolio_twentythirteen_project_navigation' ) ) :
remove_action( 'nice_portfolio_after_single_project', 'nice_portfolio_single_project_navigation', 10 );
add_filter( 'nice_portfolio_after_single_project', 'nice_portfolio_twentythirteen_project_navigation', 10 );
/**
 * Display page navigation for Twenty Thirteen.
 *
 * @since 1.0
 */
function nice_portfolio_twentythirteen_project_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( $next || $previous ) : ?>

		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Project navigation', 'nice-portfolio' ); ?></h1>
			<div class="nav-links">

				<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous project link', 'nice-portfolio' ) ); ?>
				<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next project link', 'nice-portfolio' ) ); ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->

	<?php endif;
}
endif;
