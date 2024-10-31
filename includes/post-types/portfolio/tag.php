<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles functionality for this plugin's tag.
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

if ( ! function_exists( 'nice_portfolio_get_tag' ) ) :
add_filter( 'nice_portfolio_tag', 'nice_portfolio_get_tag' );
/**
 * Obtain values to construct the tag for portfolio post type.
 *
 * This function is meant to ensure compatibility with content type standards.
 * {link https://github.com/justintadlock/content-type-standards}
 *
 * @since  1.0
 *
 * @return array
 */
function nice_portfolio_get_tag() {
	$settings   = nice_portfolio_settings();
	$textdomain = nice_portfolio_textdomain();
	$tag_name   = nice_portfolio_tag_name();

	$labels = array(
		'name'                       => esc_html__( 'Project Tags',                   $textdomain ),
		'singular_name'              => esc_html__( 'Project Tag',                    $textdomain ),
		'menu_name'                  => esc_html__( 'Tags',                           $textdomain ),
		'name_admin_bar'             => esc_html__( 'Tag',                            $textdomain ),
		'search_items'               => esc_html__( 'Search Tags',                    $textdomain ),
		'popular_items'              => esc_html__( 'Popular Tags',                   $textdomain ),
		'all_items'                  => esc_html__( 'All Tags',                       $textdomain ),
		'edit_item'                  => esc_html__( 'Edit Tag',                       $textdomain ),
		'view_item'                  => esc_html__( 'View Tag',                       $textdomain ),
		'update_item'                => esc_html__( 'Update Tag',                     $textdomain ),
		'add_new_item'               => esc_html__( 'Add New Tag',                    $textdomain ),
		'new_item_name'              => esc_html__( 'New Tag Name',                   $textdomain ),
		'separate_items_with_commas' => esc_html__( 'Separate tags with commas',      $textdomain ),
		'add_or_remove_items'        => esc_html__( 'Add or remove tags',             $textdomain ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used tags', $textdomain ),
		'not_found'                  => esc_html__( 'No tags found',                  $textdomain ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
	);
	$labels = apply_filters( 'nice_portfolio_tag_labels', $labels );

	$project_rewrite_slug = ! empty( $settings['project_rewrite_slug'] ) ? $settings['project_rewrite_slug'] : 'portfolio';

	$args = array(
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'query_var'         => 'portfolio_tag',

		// The rewrite handles the URL structure.
		'rewrite' => array(
			'slug'         => ! empty( $settings['rewrite_tag_slug'] ) ? $settings['rewrite_tag_slug'] : $project_rewrite_slug . '-tag',
			'with_front' => apply_filters( 'nice_portfolio_category_with_front', false ),
			'hierarchical' => false,
			'ep_mask'      => EP_NONE
		),
	);
	$args = apply_filters( 'nice_portfolio_tag_args', $args );

	$portfolio_tag = array(
		'name'   => $tag_name,
		'labels' => $labels,
		'args'   => $args,
	);

	return $portfolio_tag;
}
endif;
