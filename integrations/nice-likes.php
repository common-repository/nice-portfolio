<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Manage integration with Likes plugin.
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

if ( ! function_exists( 'nice_portfolio_likes_admin_ui_add_to_custom_options' ) ) :
add_filter( 'nice_likes_admin_ui_add_to_options', 'nice_portfolio_likes_admin_ui_add_to_custom_options' );
/**
 * Add "Portfolio Projects" option to "add to" settings.
 *
 * @since  1.0
 *
 * @param  array $options Filterable options.
 * @return array
 */
function nice_portfolio_likes_admin_ui_add_to_custom_options( $options = array() ) {
	$options['portfolio'] = esc_html__( 'Portfolio Projects', 'nice-portfolio' );

	return $options;
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_can_display' ) ) :
/**
 * Check if Likes can be displayed in portfolio-related pages.
 *
 * This function will return true (meaning likes can be displayed) only in case
 * all the following conditions are given:
 *
 * - The Likes plugin is enabled.
 * - Likes are set to be displayed in portfolio projects.
 *
 * @since  1.0.0
 *
 * @return bool
 */
function nice_portfolio_likes_can_display() {
	static $can_display_likes = null;

	if ( $can_display_likes !== null ) {
		return $can_display_likes;
	}

	$nice_likes_settings = nice_likes_settings();

	// Check if Likes plugin is enabled.
	$likes_enabled =    ! empty( $nice_likes_settings['enable'] )
	                 && $nice_likes_settings['enable'];

	// Check if portfolio projects are selected to be displayed.
	$portfolio_is_checked = ! empty( $nice_likes_settings['add_to']['portfolio'] );

	$can_display_likes = $likes_enabled && $portfolio_is_checked;

	// Allow modifications.
	$can_display_likes = apply_filters( 'nice_portfolio_likes_can_display', $can_display_likes );

	return $can_display_likes;
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_add_locations' ) ) :
add_filter( 'nice_likes_locations', 'nice_portfolio_likes_add_locations' );
/**
 * Add location to display likes.
 *
 * @since  1.0
 *
 * @param  array $locations List of current possible locations for likes.
 *
 * @return array
 */
function nice_portfolio_likes_add_locations( array $locations = array() ) {
	return array_merge( $locations, array(
			nice_portfolio_post_type_name(),
		)
	);
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_apply_locations' ) ) :
add_filter( 'nice_likes_apply_locations', 'nice_portfolio_likes_apply_locations' );
/**
 * Register callback to apply likes to portfolio projects.
 *
 * @since  1.0
 *
 * @param  array $apply_locations Current map of locations and callbacks.
 *
 * @return array
 */
function nice_portfolio_likes_apply_locations( array $apply_locations = array() ) {
	return array_merge( $apply_locations, array(
			nice_portfolio_post_type_name() => 'nice_portfolio_likes_apply_to_projects',
		)
	);
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_apply_to_pages' ) ) :
add_filter( 'nice_likes_apply_to_pages', 'nice_portfolio_likes_apply_to_pages' );
/**
 * Apply Likes to portfolio page when seeing it.
 *
 * @since  1.0
 *
 * @param  bool $apply
 *
 * @return bool
 */
function nice_portfolio_likes_apply_to_pages( $apply = false ) {
	if ( nice_portfolio_is_page() ) {
		return nice_likes_apply_to( nice_portfolio_post_type_name() );
	}

	return $apply;
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_apply_to_single' ) ) :
add_filter( 'nice_likes_apply_to', 'nice_portfolio_likes_apply_to_single', 10, 3 );
/**
 * Hook into Likes by NiceThemes so likes can be loaded for single portfolio projects.
 *
 * This functionality can be disabled with the following hook:
 *
	remove_filter( 'nice_likes_apply_to', 'nice_portfolio_likes_apply_to_single' );
 *
 * @since  1.0
 *
 * @param  bool $needed Whether Likes are needed at this point or not.
 * @return bool
 */
function nice_portfolio_likes_apply_to_single( $needed ) {
	if ( ! $needed && nice_portfolio_is_single() && nice_portfolio_likes_can_display() ) {
		$needed = true;
	}

	return $needed;
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_apply_to_projects' ) ) :
/**
 * Apply likes to portfolio projects when needed.
 *
 * @since  1.0
 *
 * @return bool
 */
function nice_portfolio_likes_apply_to_projects() {
	if ( ! apply_filters( 'nice_portfolio_likes_apply_to_projects', false ) ) {
		return null;
	}

	static $apply = null;

	if ( ! is_null( $apply ) ) {
		return $apply;
	}

	/**
	 * Obtain current post.
	 */
	$post = get_post();

	/**
	 * Only apply likes if:
	 *
	 * - We're seeing a blog page and the current post uses the shortcode
	 * - or we're seeing an archive page and the current post uses the shortcode
	 * - or we're seeing a portfolio page
	 * - or the current page belongs to a single project.
	 */
	$apply = (   is_home()
	          || is_archive()
	          || nice_portfolio_is_page()
	          || $post->post_type == nice_portfolio_post_type_name()
              || has_shortcode( $post->post_content, 'portfolio' )
	         )
	         && nice_portfolio_likes_can_display();

	return $apply;
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_apply_to_current' ) ) :
add_filter( 'nice_portfolio_likes_apply_to_projects', 'nice_portfolio_likes_apply_to_current' );
/**
 * Hook into Likes by NiceThemes so likes can be loaded for portfolio pages.
 *
 * By default, this function returns the same input that it receives. You can activate its
 * functionality with the following hook:
 *
	add_filter( 'nice_portfolio_likes_apply_to_current', '__return_true' );
 *
 * @since  1.0
 *
 * @param  false $apply
 *
 * @return bool
 */
function nice_portfolio_likes_apply_to_current( $apply ) {
	if ( apply_filters( 'nice_portfolio_likes_apply_to_current', false ) ) {
		$apply = true;
	}

	/**
	 * Check that the current page is a portfolio category page.
	 */
	if ( nice_portfolio_is_category()
		/**
		 * @hook nice_portfolio_likes_apply_to_category
		 *
		 * Hook here if you want Likes to be applied to category pages.
		 *
		 * @since 1.0
		 */
	     && apply_filters( 'nice_portfolio_likes_apply_to_category', false )
	) {
		$apply = true;
	}

	/**
	 * Check that the current page is a portfolio tag page.
	 */
	if ( nice_portfolio_is_tag()
		/**
		 * @hook nice_portfolio_likes_apply_to_tag
		 *
		 * Hook here if you want Likes to be applied to tag pages.
		 *
		 * @since 1.0
		 */
	     && apply_filters( 'nice_portfolio_likes_apply_to_tag', false )
	) {
		$apply = true;
	}

	/**
	 * Check that the current page is a portfolio archive page.
	 */
	if ( nice_portfolio_is_archive()
	    /**
         * @hook nice_portfolio_likes_apply_to_archive
         *
         * Hook here if you want Likes to be applied to archive pages.
         *
         * @since 1.0
         */
	     && apply_filters( 'nice_portfolio_likes_apply_to_archive', false )
	) {
		$apply = true;
	}

	/**
	 * Check that the current page is a blog page.
	 */
	if ( is_home()
	    /**
         * @hook nice_portfolio_likes_apply_to_home
         *
         * Hook here if you want Likes to be applied to blog pages.
         *
         * @since 1.0
         */
	     && apply_filters( 'nice_portfolio_likes_apply_to_home', false )
	) {
		$apply = true;
	}

	/**
	 * Check that the current view is a post or page.
	 */
	if ( is_singular()
	    /**
         * @hook nice_portfolio_likes_apply_to_singular
         *
         * Hook here if you want Likes to be applied to single posts and pages.
         *
         * @since 1.0
         */
	     && apply_filters( 'nice_portfolio_likes_apply_to_singular', false )
	) {
		$apply = true;
	}

	/**
	 * Check that the current page is a portfolio page.
	 */
	if ( nice_portfolio_is_page()
	    /**
         * @hook nice_portfolio_likes_apply_to_page
         *
         * Hook here if you want Likes to be applied to the portfolio page.
         *
         * @since 1.0
         */
	     && apply_filters( 'nice_portfolio_likes_apply_to_page', false )
	) {
		$apply = true;
	}

	/**
	 * Check that the current page is a single project page.
	 */
	if ( nice_portfolio_is_project_post_type() && is_singular( nice_portfolio_post_type_name() )
	    /**
         * @hook nice_portfolio_likes_apply_to_single
         *
         * Hook here if you want Likes to be applied to single project pages.
         *
         * @since 1.0
         */
	     && apply_filters( 'nice_portfolio_likes_apply_to_single', true )
	) {
		$apply = true;
	}

	return $apply;
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_remove_from_widget' ) ) :
add_filter( 'nice_likes_content_filter', 'nice_portfolio_likes_remove_from_widget', 10, 2 );
/**
 * Remove Likes from the projects content.
 *
 * @since 1.0
 *
 * @param string $content
 * @param string $original_content
 *
 * @return string
 */
function nice_portfolio_likes_remove_from_widget( $content, $original_content ) {
	if ( nice_portfolio_is_project_post_type() ) {
		return $original_content;
	}

	return $content;
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_before_single_project_content' ) ) :
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_likes_before_single_project_content', 0 );
/**
 * Show Likes before the content of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_likes_before_single_project_content() {
	$settings = nice_likes_settings();

	if ( nice_likes_apply() && nice_likes_bool( $settings['enable'] ) && 'before' == $settings['position'] ) {
		nice_likes( array(
				'post_id' => get_the_ID(),
				'echo'    => true
			)
		);
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_after_single_project_content' ) ) :
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_likes_after_single_project_content', 999 );
/**
 * Show Likes after the content of a single project.
 *
 * @since 1.0
 */
function nice_portfolio_likes_after_single_project_content() {
	$settings = nice_likes_settings();

	if ( nice_likes_bool( $settings['enable'] ) && 'after' == $settings['position'] ) {
		nice_likes( array(
				'post_id' => get_the_ID(),
				'echo'    => true
			)
		);
	}
}
endif;

if ( ! function_exists( 'nice_portfolio_likes_custom_column_context' ) ) :
add_filter( 'nice_likes_posts_custom_column_context', 'nice_portfolio_likes_custom_column_context', 10, 2 );
/**
 * Modify custom columns context for project lists.
 *
 * @since 1.0.3
 *
 * @param string $context
 * @param string $post_type
 *
 * @return string
 */
function nice_portfolio_likes_custom_column_context( $context, $post_type ) {
	if ( nice_portfolio_post_type_name() === $post_type ) {
		$context = 'portfolio';
	}

	return $context;
}
endif;
