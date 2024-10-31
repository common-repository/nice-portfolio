<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles functionality for this plugin's custom post type.
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

if ( ! function_exists( 'nice_portfolio_get_post_type' ) ) :
add_filter( 'nice_portfolio_post_type', 'nice_portfolio_get_post_type' );
/**
 * Obtain values to construct the portfolio custom post type.
 *
 * This file is meant to ensure compatibility with content type standards.
 * {link https://github.com/justintadlock/content-type-standards}
 *
 * @since  1.0
 *
 * @return array
 */
function nice_portfolio_get_post_type() {
	$settings       = nice_portfolio_settings();
	$textdomain     = nice_portfolio_textdomain();
	$post_type_name = nice_portfolio_post_type_name();

	$labels = array(
		'name'               => esc_html__( 'Projects',                   $textdomain ),
		'singular_name'      => esc_html__( 'Portfolio Item',             $textdomain ),
		'menu_name'          => esc_html__( 'Portfolio',                  $textdomain ),
		'name_admin_bar'     => esc_html__( 'Portfolio Project',          $textdomain ),
		'add_new'            => esc_html__( 'Add New',                    $textdomain ),
		'add_new_item'       => esc_html__( 'Add New Project',            $textdomain ),
		'edit_item'          => esc_html__( 'Edit Project',               $textdomain ),
		'new_item'           => esc_html__( 'New Project',                $textdomain ),
		'view_item'          => esc_html__( 'View Project',               $textdomain ),
		'search_items'       => esc_html__( 'Search Projects',            $textdomain ),
		'not_found'          => esc_html__( 'No projects found',          $textdomain ),
		'not_found_in_trash' => esc_html__( 'No projects found in trash', $textdomain ),
		'all_items'          => esc_html__( 'All Projects',               $textdomain ),
	);
	$labels = apply_filters( 'nice_portfolio_post_type_labels', $labels );

	$args = array(
		'menu_icon'           => 'dashicons-art',
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 12,
		'can_export'          => true,
		'delete_with_user'    => false,
		'hierarchical'        => false,
		'has_archive'         => ! empty( $settings['rewrite_archive_slug'] ) ? $settings['rewrite_archive_slug'] : 'portfolio',
		'query_var'           => $post_type_name,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'rewrite' => array(
			'slug'       => ! empty( $settings['rewrite_project_slug'] ) ? $settings['rewrite_project_slug'] : 'portfolio',
			'with_front' => apply_filters( 'nice_portfolio_project_with_front', false ),
			'pages'      => true,
			'feeds'      => true,
			'ep_mask'    => EP_PERMALINK,
		),
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
		),
	);
	$args = apply_filters( 'nice_portfolio_post_type_args', $args );

	$portfolio_post_type = array(
		'name'            => $post_type_name,
		'labels'          => $labels,
		'args'            => $args,
		'dashicons_glyph' => '\\f309',
	);

	return $portfolio_post_type;
}
endif;

if ( ! function_exists( 'nice_portfolio_flush_rewrite_rules_maybe' ) ) :
add_filter( 'pre_update_option_nice_portfolio_settings', 'nice_portfolio_add_flush_rewrite_rules_flag', 100, 2 );
/**
 * Flush rewrite rules if post type slug changes.
 *
 * @since  1.0
 *
 * @param  mixed $value
 * @param  mixed $old_value
 *
 * @return mixed
 */
function nice_portfolio_add_flush_rewrite_rules_flag( $value, $old_value ) {
	if (    $value['rewrite_archive_slug']  != $old_value['rewrite_archive_slug']
	     || $value['rewrite_project_slug']  != $old_value['rewrite_project_slug']
	     || $value['rewrite_category_slug'] != $old_value['rewrite_category_slug']
	     || $value['rewrite_tag_slug']      != $old_value['rewrite_tag_slug']
	) {
		add_option( 'nice_portfolio_flush_rewrite_rules', true );
	}

	return $value;
}
endif;

if ( ! function_exists( 'nice_portfolio_flush_rewrite_rules_maybe' ) ) :
add_action( 'init', 'nice_portfolio_flush_rewrite_rules_maybe', 0 );
/**
 * Flush rewrite rules if needed.
 *
 * @since 1.0
 */
function nice_portfolio_flush_rewrite_rules_maybe() {
	if ( get_option( 'nice_portfolio_flush_rewrite_rules' ) ) {
		flush_rewrite_rules();
		delete_option( 'nice_portfolio_flush_rewrite_rules' );
	}
}
endif;
