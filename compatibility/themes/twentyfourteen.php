<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains hooks for compatibility with the Twenty Fourteen theme.
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

if ( ! function_exists( 'nice_portfolio_twentyfourteen_wrapper_start' ) ) :
add_filter( 'nice_portfolio_wrapper_start', 'nice_portfolio_twentyfourteen_wrapper_start' );
/**
 * Define opening template wrapper.
 *
 * @since 1.0
 */
function nice_portfolio_twentyfourteen_wrapper_start() {
	return '<div id="primary" class="content-area"><div id="content" role="main" class="site-content nice-portfolio-content twentyfourteen"><div class="nice-portfolio-twentyfourteen">';
}
endif;

if ( ! function_exists( 'nice_portfolio_twentyfourteen_wrapper_end' ) ) :
add_filter( 'nice_portfolio_wrapper_end', 'nice_portfolio_twentyfourteen_wrapper_end' );
/**
 * Define opening template wrapper.
 *
 * @since 1.0
 */
function nice_portfolio_twentyfourteen_wrapper_end() {
	ob_start();

	echo '</div></div></div>';

	// Twenty Fourteen needs to display the content sidebar at this point.
	get_sidebar( 'content' );

	$html = ob_get_contents();
	ob_end_clean();

	return $html;
}
endif;

if ( ! function_exists( 'nice_portfolio_twentyfourteen_page_navigation' ) ) :
remove_action( 'nice_portfolio_after_main_content', 'nice_portfolio_loop_projects_page_navigation', 0 );
add_action( 'nice_portfolio_after_main_content', 'nice_portfolio_twentyfourteen_page_navigation', 0 );
/**
 * Display page navigation for Twenty Fourteen.
 *
 * @since 1.0
 */
function nice_portfolio_twentyfourteen_page_navigation() {
	twentyfourteen_paging_nav();
}
endif;

if ( ! function_exists( 'nice_portfolio_twentyfourteen_project_navigation' ) ) :
remove_action( 'nice_portfolio_after_single_project', 'nice_portfolio_single_project_navigation', 10 );
add_action( 'nice_portfolio_after_single_project', 'nice_portfolio_twentyfourteen_project_navigation', 10 );
/**
 * Display page navigation for Twenty Fifteen.
 *
 * @since 1.0
 */
function nice_portfolio_twentyfourteen_project_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( $next || $previous ) : ?>

		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Project navigation', 'nice-portfolio' ); ?></h1>

			<div class="nav-links">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link', wp_kses( __( '<span class="meta-nav">Published In</span>%title', 'twentyfourteen' ), array( 'span' => array( 'class' => array() ) ) ) );
				else :
					previous_post_link( '%link', wp_kses( __( '<span class="meta-nav">Previous Project</span>%title', 'nice-portfolio' ), array( 'span' => array( 'class' => array() ) ) ) );
					next_post_link( '%link', wp_kses( __( '<span class="meta-nav">Next Project</span>%title', 'nice-portfolio' ), array( 'span' => array( 'class' => array() ) ) ) );
				endif;
				?>
			</div>
			<!-- .nav-links -->
		</nav><!-- .navigation -->

	<?php endif;
}
endif;
