<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles functionality for this plugin's category.
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

if ( ! function_exists( 'nice_portfolio_get_category' ) ) :
add_filter( 'nice_portfolio_category', 'nice_portfolio_get_category' );
/**
 * Obtain values to construct the category for portfolio post type.
 *
 * This method is meant to ensure compatibility with content type standards.
 * {link https://github.com/justintadlock/content-type-standards}
 *
 * @since  1.0
 *
 * @return array
 */
function nice_portfolio_get_category() {
	$settings      = nice_portfolio_settings();
	$textdomain    = nice_portfolio_textdomain();
	$category_name = nice_portfolio_category_name();

	$labels = array(
		'name'                       => esc_html__( 'Project Categories', $textdomain ),
		'singular_name'              => esc_html__( 'Project Category',   $textdomain ),
		'menu_name'                  => esc_html__( 'Categories',         $textdomain ),
		'name_admin_bar'             => esc_html__( 'Category',           $textdomain ),
		'search_items'               => esc_html__( 'Search Categories',  $textdomain ),
		'popular_items'              => esc_html__( 'Popular Categories', $textdomain ),
		'all_items'                  => esc_html__( 'All Categories',     $textdomain ),
		'edit_item'                  => esc_html__( 'Edit Category',      $textdomain ),
		'view_item'                  => esc_html__( 'View Category',      $textdomain ),
		'update_item'                => esc_html__( 'Update Category',    $textdomain ),
		'add_new_item'               => esc_html__( 'Add New Category',   $textdomain ),
		'new_item_name'              => esc_html__( 'New Category Name',  $textdomain ),
		'parent_item'                => esc_html__( 'Parent Category',    $textdomain ),
		'parent_item_colon'          => esc_html__( 'Parent Category:',   $textdomain ),
		'separate_items_with_commas' => null,
		'add_or_remove_items'        => null,
		'choose_from_most_used'      => null,
		'not_found'                  => null,
	);
	$labels = apply_filters( 'nice_portfolio_category_labels', $labels );

	$project_rewrite_slug = ! empty( $settings['rewrite_project_slug'] ) ? $settings['rewrite_project_slug'] : 'article';

	$args = array(
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'query_var'         => $category_name,
		'rewrite' => array(
			'slug'         => ! empty( $settings['rewrite_category_slug'] ) ? $settings['rewrite_category_slug'] : $project_rewrite_slug . '-category',
			'with_front'   => apply_filters( 'nice_portfolio_category_with_front', false ),
			'hierarchical' => apply_filters( 'nice_portfolio_category_hierarchical', false ),
			'ep_mask'      => EP_NONE
		),
	);
	$args = apply_filters( 'nice_portfolio_category_args', $args );

	$portfolio_category = array(
		'name'   => $category_name,
		'labels' => $labels,
		'args'   => $args,
	);

	return $portfolio_category;
}
endif;
