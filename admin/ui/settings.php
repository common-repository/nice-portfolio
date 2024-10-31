<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Register settings for Admin UI.
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

if ( ! function_exists( 'nice_portfolio_admin_ui_add_settings' ) ) :
add_filter( 'nice_portfolio_admin_ui_settings', 'nice_portfolio_admin_ui_add_settings' );
/**
 * Create settings.
 *
 * @since 1.0
 */
function nice_portfolio_admin_ui_add_settings() {
	$settings = nice_portfolio_settings();

	// Fields for General tab.
	$general_settings = array(
		'portfolio_page' => array(
			'id'          => 'portfolio_page',
			'title'       => esc_html__( 'Portfolio Page', 'nice-portfolio' ),
			'description' => esc_html__( 'This is the page where all your projects will appear.', 'nice-portfolio' ),
			'type'        => 'select_pages',
			'placeholder' => esc_html__( 'Select an option', 'nice-portfolio' ),
			'priority'    => 0,
		),
		'limit' => array(
			'id'          => 'limit',
			'title'       => esc_html__( 'Number of Projects', 'nice-portfolio' ),
			'description' => esc_html__( 'The maximum number of items to be displayed in a list of projects. A value of 0 (zero) means no projects will display. Use -1 (minus one) to display unlimited projects.', 'nice-portfolio' ) . ' ' . sprintf( esc_html__( 'You can override this setting in shortcodes using the %s property.', 'nice-portfolio' ), '<code>limit</code>' ),
			'type'        => 'text-small',
			'priority'    => 10,
		),
		'columns' => array(
			'id'          => 'columns',
			'title'       => esc_html__( 'Number of Columns', 'nice-portfolio' ),
			'description' => esc_html__( 'The number of columns to be displayed in a list of projects.', 'nice-portfolio' ) . ' ' . sprintf( esc_html__( 'You can override this setting in shortcodes using the %s property.', 'nice-portfolio' ), '<code>columns</code>' ),
			'type'        => 'text-small',
			'priority'    => 20,
		),
		'display_category_filter' => array(
			'id'          => 'display_category_filter',
			'title'       => esc_html__( 'Display category filter', 'nice-portfolio' ),
			'description' => esc_html__( 'Show filter by category when listing projects.', 'nice-portfolio' ),
			'type'        => 'checkbox',
			'priority'    => 30,
		),
		'visible_data' => array(
			'id'          => 'visible_data',
			'title'       => esc_html__( 'Visible Data', 'nice-portfolio' ),
			'description' => esc_html__( 'Check which fields should be displayed within a project.', 'nice-portfolio' ),
			'type'        => 'checkbox-group',
			'options'     => array(
				'embed'      => esc_html__( 'Video Embed', 'nice-portfolio' ),
				'client'     => esc_html__( 'Client', 'nice-portfolio' ),
				'start_date' => esc_html__( 'Start Date', 'nice-portfolio' ),
				'end_date'   => esc_html__( 'End Date', 'nice-portfolio' ),
				'url'        => esc_html__( 'URL', 'nice-portfolio' ),
			),
			'priority'    => 40,
		),
		'orderby' => array(
			'id'          => 'orderby',
			'title'       => esc_html__( 'Order items by', 'nice-portfolio' ),
			'description' => sprintf( esc_html__( 'You can override this setting in shortcodes using the %s property.', 'nice-portfolio' ), '<code>orderby</code>' ),
			'type'        => 'select',
			'options'     => array(
				'ID'         => esc_html__( 'Project ID', 'nice-portfolio' ),
				'title'      => esc_html__( 'Title', 'nice-portfolio' ),
				'menu_order' => esc_html__( 'Menu Order', 'nice-portfolio' ),
				'date'       => esc_html__( 'Date', 'nice-portfolio' ),
				'random'     => esc_html__( 'Random Order', 'nice-portfolio' ),
			),
			'placeholder' => esc_html__( 'Select an option', 'nice-portfolio' ),
			'priority'    => 50,
		),
		'order' => array(
			'id'          => 'order',
			'title'       => esc_html__( 'Sort items by', 'nice-portfolio' ),
			'description' => sprintf( esc_html__( 'You can override this setting in shortcodes using the %s property.', 'nice-portfolio' ), '<code>order</code>' ),
			'type'        => 'select',
			'options'     => array(
				'asc'  => esc_html__( 'Ascending Order', 'nice-portfolio' ),
				'desc' => esc_html__( 'Descending Order', 'nice-portfolio' ),
			),
			'placeholder' => esc_html__( 'Select an option', 'nice-portfolio' ),
			'priority'    => 60,
		),
		'avoidcss' => array(
			'id'          => 'avoidcss',
			'title'       => esc_html__( 'Avoid Plugin CSS', 'nice-portfolio' ),
			'description' => esc_html__( 'Apply styles to portfolio elements using your own CSS.', 'nice-portfolio' ),
			'type'        => 'checkbox',
			'priority'    => 70,
		),
	);

	// Fields for Images tab.
	$images_settings = array(
		'archive_image_size' => array(
			'id'          => 'archive_image_size',
			'title'       => esc_html__( 'Archive Images', 'nice-portfolio' ),
			'description' => esc_html__( 'Size of your project images in lists of projects.', 'nice-portfolio' ),
			'type'        => 'image_size',
			'priority'    => 0,
		),
		'single_image_size' => array(
			'id'          => 'single_image_size',
			'title'       => esc_html__( 'Single Images', 'nice-portfolio' ),
			'description' => esc_html__( 'Size of project image in portfolio project pages.', 'nice-portfolio' ),
			'type'        => 'image_size',
			'priority'    => 10,
		),
	);

	// Fields for Advanced tab.
	$advanced_settings = array(
		'rewrite_archive_slug' => array(
			'id'          => 'rewrite_archive_slug',
			'title'       => esc_html__( 'Archives Base Slug', 'nice-portfolio' ),
			'description' => sprintf( esc_html__( 'Base name for permalinks to portfolio archives. &mdash; i.e.: %s/%s/.', 'nice-portfolio' ), get_site_url(), sprintf( '<strong>%s</strong>', $settings['rewrite_archive_slug'] ) ),
			'type'        => 'text',
			'priority'    => 0,
		),
		'rewrite_project_slug' => array(
			'id'          => 'rewrite_project_slug',
			'title'       => esc_html__( 'Project Base Slug', 'nice-portfolio' ),
			'description' => sprintf( esc_html__( 'Base name for permalinks to portfolio projects. &mdash; i.e.: %s/%s/%s/.', 'nice-portfolio' ), get_site_url(), sprintf( '<strong>%s</strong>', $settings['rewrite_project_slug'] ), 'your-project' ),
			'type'        => 'text',
			'priority'    => 10,
		),
		'rewrite_category_slug' => array(
			'id'          => 'rewrite_category_slug',
			'title'       => esc_html__( 'Category Base Slug', 'nice-portfolio' ),
			'description' => sprintf( esc_html__( 'Base name for permalinks to portfolio categories. &mdash; i.e.: %s/%s/%s/.', 'nice-portfolio' ), get_site_url(), sprintf( '<strong>%s</strong>', $settings['rewrite_category_slug'] ), 'your-category' ),
			'type'        => 'text',
			'priority'    => 20,
		),
		'rewrite_tag_slug' => array(
			'id'          => 'rewrite_tag_slug',
			'title'       => esc_html__( 'Tag Base Slug', 'nice-portfolio' ),
			'description' => sprintf( esc_html__( 'Base name for permalinks to portfolio tags. &mdash; i.e.: %s/%s/%s/.', 'nice-portfolio' ), get_site_url(), sprintf( '<strong>%s</strong>', $settings['rewrite_tag_slug'] ), 'your-tag' ),
			'type'        => 'text',
			'priority'    => 30,
		),
		'remove_data_on_deactivation' => array(
			'id'          => 'remove_data_on_deactivation',
			'title'       => esc_html__( 'Remove Data On Deactivation', 'nice-portfolio' ),
			'description' => esc_html__( 'Delete all plugin settings once you deactivate it.', 'nice-portfolio' ),
			'type'        => 'checkbox',
			'priority'    => 40,
		),
	);

	// Construct settings array.
	$settings = array(
		'general' => array(
			'settings_section' => 'general-settings',
			'tab'              => 'general',
			'section'          => 'settings',
			'args'             => $general_settings,
		),
		'images' => array(
			'settings_section' => 'images-settings',
			'tab'              => 'images',
			'section'          => 'settings',
			'args'             => $images_settings,
		),
		'advanced' => array(
			'settings_section' => 'advanced-settings',
			'tab'              => 'advanced',
			'section'          => 'settings',
			'args'             => $advanced_settings,
		),
	);

	return $settings;
}
endif;

if ( ! function_exists( 'nice_portfolio_admin_ui_select_pages' ) ) :
add_filter( 'nice_portfolio_admin_ui_setting_field_select_pages', 'nice_portfolio_admin_ui_select_pages', 10, 2 );
/**
 * Custom field processor for page selector.
 *
 * @since  1.0
 *
 * @param  string $output Original HTML contents.
 * @param  array  $args   List of arguments to construct the field.
 *
 * @return string
 */
function nice_portfolio_admin_ui_select_pages( $output, $args ) {
	$settings_name = nice_portfolio_settings_name();

	$dropdown_args = array(
		'echo'             => false,
		'name'             => $settings_name . '[' . $args['field']['id'] . ']',
		'id'               => $settings_name . '[' . $args['field']['id'] . ']',
		'selected'         => absint( $args['value'] ),
		'sort_column'      => 'menu_order',
		'sort_order'       => 'ASC',
		'show_option_none' => esc_html__( 'Select an option', 'nice-portfolio' ),
	);
	$dropdown_args = apply_filters( 'nice_portfolio_select_pages_dropdown_args',
		$dropdown_args, $output, $args
	);

	$dropdown_pages = wp_dropdown_pages( $dropdown_args );
	$dropdown_pages = apply_filters( 'nice_portfolio_select_pages',
		$dropdown_pages, $dropdown_args, $output, $args
	);

	return $dropdown_pages;
}
endif;

if ( ! function_exists( 'nice_portfolio_admin_ui_image_size' ) ) :
add_filter( 'nice_portfolio_admin_ui_setting_field_image_size', 'nice_portfolio_admin_ui_image_size', 10, 2 );
/**
 * Add new fields for image size.
 *
 * @since  1.0
 *
 * @param  string $output Original HTML contents.
 * @param  array  $args   List of arguments to construct the field.
 *
 * @return string
 */
function nice_portfolio_admin_ui_image_size( $output, $args ) {
	$id = nice_portfolio_settings_name() . '[' . $args['field']['id'] . ']';

	$defaults = array(
		'width'  => '',
		'height' => '',
		'crop'   => '',
	);
	$defaults = apply_filters( 'nice_portfolio_admin_ui_image_size_defaults', $defaults );

	$value = wp_parse_args( $args['value'], $defaults );
	$value = apply_filters( 'nice_portfolio_admin_ui_image_size_value', $value );

	ob_start();

	?>
	<label for="<?php echo esc_attr( $id ); ?>[width]"><?php esc_html_e( 'Width:', 'nice-portfolio' ); ?></label>
	<input id="<?php echo esc_attr( $id ); ?>[width]" class="nice-text small-text" type="text" value="<?php echo esc_attr( $value['width'] ); ?>" name="<?php echo esc_attr( $id ); ?>[width]">
	<label for="<?php echo esc_attr( $id ); ?>[height]"><?php esc_html_e( 'Height:', 'nice-portfolio' ); ?></label>
	<input id="<?php echo esc_attr( $id ); ?>[height]" class="nice-text small-text" type="text" value="<?php echo esc_attr( $value['height'] ); ?>" name="<?php echo esc_attr( $id ); ?>[height]">
	<label for="<?php echo esc_attr( $id ); ?>[crop]"> <?php esc_html_e( 'Crop:', 'nice-portfolio' ); ?></label>
	<input type="hidden" value="0" name="<?php echo esc_attr( $id ); ?>[crop]">
	<input id="<?php echo esc_attr( $id ); ?>[crop]" class="nice-checkbox" type="checkbox" <?php checked( 1, $value['crop'] ); ?> value="1" name="<?php echo esc_attr( $id ); ?>[crop]">
	<p class="description">
		<?php echo $args['field']['description']; // WPCS: XSS ok. ?>
	</p>
	<?php

	$output .= ob_get_contents();
	$output = apply_filters( 'nice_portfolio_admin_ui_image_size', $output );

	ob_end_clean();

	return $output;
}
endif;
