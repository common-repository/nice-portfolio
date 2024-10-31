<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file adds actions and filters to hooks that are fired within templates,
 * setting up the visibility of single projects and portfolio pages.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/** ==========================================================================
 *  HTML wrappers.
 *  ======================================================================= */
/**
 * Print opening wrapper before the main content of a portfolio page, category
 * tag, archive or single project.
 *
 * @since  1.0
 *
 * Hook origin:
 * @see All portfolio page templates.
 *
 * @uses nice_portfolio_wrapper_start()
 */
add_action( 'nice_portfolio_before_main_content', 'nice_portfolio_wrapper_start', 10 );

/**
 * Print opening wrapper after the main content of a portfolio page, category
 * tag or archive.
 *
 * @since  1.0
 *
 * Hook origin:
 * @see All portfolio page templates.
 *
 * @uses nice_portfolio_wrapper_end()
 */
add_action( 'nice_portfolio_after_main_content', 'nice_portfolio_wrapper_end', 10 );

/**
 * Print opening wrapper before processing a loop of projects.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio()
 *
 * @uses nice_portfolio_loop_main_wrapper_start()
 */
add_action( 'nice_portfolio_before_loop', 'nice_portfolio_loop_main_wrapper_start', 10 );

/**
 * Print closing wrapper after processing a loop of projects.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio()
 *
 * @uses nice_portfolio_loop_main_wrapper_end()
 */
add_action( 'nice_portfolio_after_loop', 'nice_portfolio_loop_main_wrapper_end', 10 );

/**
 * Print opening wrapper for a looped project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio_loop_project()
 *
 * @uses nice_portfolio_loop_project_wrapper_start()
 */
add_action( 'nice_portfolio_loop_project', 'nice_portfolio_loop_project_wrapper_start', 10 );

/**
 * Print closing wrapper for a looped project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio_loop_project()
 *
 * @uses nice_portfolio_loop_project_wrapper_end()
 */
add_action( 'nice_portfolio_loop_project', 'nice_portfolio_loop_project_wrapper_end', 40 );

/** ==========================================================================
 *  Navigation.
 *  ======================================================================= */
/**
 * Print navigation for single projects after the project has been processed.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_navigation()
 */
add_action( 'nice_portfolio_after_single_project', 'nice_portfolio_single_project_navigation', 10 );

/**
 * Print navigation for categories, tags and archives after page main contents
 * and before the closing wrapper.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Portfolio category, tag and archive templates.
 *
 * @uses nice_portfolio_loop_projects_page_navigation()
 */
add_action( 'nice_portfolio_after_main_content', 'nice_portfolio_loop_projects_page_navigation', 0 );

/**
 * Display a sidebar in portfolio pages and single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see All portfolio page templates.
 *
 * @uses nice_portfolio_sidebar()
 */
add_action( 'nice_portfolio_sidebar', 'nice_portfolio_sidebar', 10 );

/** ==========================================================================
 *  Page Header.
 *  ======================================================================= */
/**
 * Display the title of the current page.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see All portfolio page templates.
 *
 * @uses nice_portfolio_title()
 */
add_action( 'nice_portfolio_header', 'nice_portfolio_title' );

/** ==========================================================================
 *  Content.
 *  ======================================================================= */
/**
 * Print empty message when a list of projects has no data.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio()
 *
 * @uses nice_portfolio_loop_empty()
 */
add_action( 'nice_portfolio_empty', 'nice_portfolio_loop_empty', 10 );

/**
 * Display category filter before the loop of projects.
 *
 * This action is fired by default in the portfolio page template.
 *
 * @since 1.0
 *
 * @uses  nice_portfolio_loop_filter_project_category()
 */
add_action( 'nice_portfolio_before_loop', 'nice_portfolio_loop_filter_project_category', 0 );

/**
 * Print all portfolio-related loops.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see All portfolio page templates.
 *
 * @uses nice_portfolio()
 */
add_action( 'nice_portfolio', 'nice_portfolio', 10 );

/**
 * Print the list of projects based on Portfolio > Settings.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio()
 *
 * @uses nice_portfolio_loop_projects()
 */
add_action( 'nice_portfolio_loop', 'nice_portfolio_loop_projects', 10 );

/**
 * Print the thumbnail of a project inside the loop.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio_loop_project()
 *
 * @uses nice_portfolio_loop_article_thumbnail()
 */
add_action( 'nice_portfolio_loop_project', 'nice_portfolio_loop_project_thumbnail', 20 );

/**
 * Print the title of a project inside the loop.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see nice_portfolio_loop_project()
 *
 * @uses nice_portfolio_loop_article_title()
 */
add_action( 'nice_portfolio_loop_project', 'nice_portfolio_loop_project_title', 30 );

/**
 * Print the thumbnail of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_thumbnail()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_thumbnail', 10 );

/**
 * Print the embed code of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_embed()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_embed', 20 );

/**
 * Print the description of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_description()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_description', 30 );

/**
 * Print the gallery of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_gallery()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_gallery', 40 );

/**
 * Print the attributes of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_meta()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_meta', 50 );

/**
 * Print the categories of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_categories()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_categories', 60 );

/**
 * Print the tags of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_tags()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_tags', 70 );

/**
 * Print the list of related projects of a single project.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see Single project content template.
 *
 * @uses nice_portfolio_single_project_related()
 */
add_action( 'nice_portfolio_single_project_content', 'nice_portfolio_single_project_related', 80 );

/**
 * Add meta data for single projects.
 *
 * @since 1.0
 *
 * Hook origin:
 * @see templates/single-project/meta.php
 *
 * @uses nice_portfolio_single_project_details()
 * @uses nice_portfolio_single_project_url()
 */
add_action( 'nice_portfolio_single_project_meta', 'nice_portfolio_single_project_details', 10 );
add_action( 'nice_portfolio_single_project_meta', 'nice_portfolio_single_project_url', 20 );
