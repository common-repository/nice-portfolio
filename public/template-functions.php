<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file contains functions for templating purposes.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/** ==========================================================================
 *  Contents.
 *  ======================================================================= */
if ( ! function_exists( 'nice_portfolio' ) ) :
/**
 * Display a loop of portfolio projects.
 *
 * @since 1.0
 *
 * @param array $args {
 *      Optional. Arguments to construct the loop of projects.
 *      @see Nice_Portfolio::sanitize_args() For the full list of arguments and default values.
 *
 *      @type bool   $avoidcss              Indicates if the default CSS should be avoided or not.
 *      @type int    $columns               Number of columns to show in the grid of projects.
 *      @type int    $limit                 Maximum number of projects to retrieve for each page of the loop.
 *      @type string $orderby               Which field to order projects by. Accepts post fields.
 *      @type string $order                 Whether the order of the projects should be ascendant (asc) or descendant (desc).
 *      @type bool   $paged                 Whether the loop should show more than one page (only for archive pages).
 *      @type string $image_width           Width of the featured project image (in pixels).
 *      @type string $image_height          Height of the featured project image (in pixels).
 *      @type bool   $display_empty_message Whether a message should be displayed if no content is found.
 * }
 */
function nice_portfolio( $args = array() ) {
	/**
	 * Initialize the Nice_Portfolio object.
	 */
	$portfolio = nice_portfolio_obtain_instance( $args );

	// Return early if we don't have projects to loop.
	if ( ! $portfolio->have_posts() ) {
		if ( $portfolio->args['display_empty_message'] ) {
			/**
			 * @hook  nice_portfolio_empty
			 *
			 * All HTML corresponding to a "no content found" message should be printed at this point.
			 *
			 * @since 1.0
			 *
			 * Hooked here:
			 * @see nice_portfolio_loop_empty() - 10 (prints contents of templates/loop/empty/empty.php)
			 */
			do_action( 'nice_portfolio_empty' );
		}

		return;
	}

	/**
	 * @hook  nice_portfolio_before_loop
	 *
	 * All HTML before the loop of projects gets processed should be
	 * printed at this point.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see nice_portfolio_loop_filter_project_category() - 0
	 * @see nice_portfolio_loop_main_wrapper_start()      - 10
	 */
	do_action( 'nice_portfolio_before_loop' );

	/**
	 * @hook nice_portfolio_loop
	 *
	 * All portfolio-related loops should be processed at this point.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see nice_portfolio_loop_projects()
	 */
	do_action( 'nice_portfolio_loop', $portfolio );

	/**
	 * @hook  nice_portfolio_after_loop
	 *
	 * All HTML after the loop of projects gets processed should be
	 * printed at this point.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see nice_portfolio_loop_main_wrapper_end() - 10
	 */
	do_action( 'nice_portfolio_after_loop' );

	wp_reset_postdata();
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_projects' ) ) :
/**
 * Fire the loop of projects.
 *
 * @since 1.0
 *
 * @param Nice_Portfolio $portfolio
 */
function nice_portfolio_loop_projects( Nice_Portfolio $portfolio ) {
	while ( $portfolio->have_posts() ) : $portfolio->the_post();
		/**
		 * @hook nice_portfolio_loop_projects
		 *
		 * All actions that print HTML during the loop process should be hooked
		 * here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_loop_project_wrapper_start() - 10 (prints the opening wrapper for the current project)
		 * @see nice_portfolio_loop_project_thumbnail()     - 20 (prints the thumbnail of the current project)
		 * @see nice_portfolio_loop_project_title()         - 30 (prints the title for the current project)
		 * @see nice_portfolio_loop_project_wrapper_end()   - 40 (prints the closing wrapper for the current project)
		 */
		do_action( 'nice_portfolio_loop_project' );

	endwhile;
}
endif;

if ( ! function_exists( 'nice_portfolio_loop_position' ) ) :
/**
 * Print the current loop position.
 *
 * @since  1.0
 *
 * @return int
 */
function nice_portfolio_loop_position() {
	echo intval( nice_portfolio_get_loop_position() );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_loop_position' ) ) :
/**
 * Obtain the current loop position.
 *
 * @since  1.0
 *
 * @return int
 */
function nice_portfolio_get_loop_position() {
	$portfolio = nice_portfolio_obtain_instance();

	return $portfolio->get_loop_position();
}
endif;

if ( ! function_exists( 'nice_portfolio_the_ID' ) ) :
/**
 * Print the ID of the current project in the loop.
 *
 * @since  1.0
 *
 * @return int
 */
function nice_portfolio_the_ID() {
	echo intval( nice_portfolio_get_the_ID() );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_the_ID' ) ) :
/**
 * Obtain the ID of the current project in the loop.
 *
 * @since  1.0
 *
 * @return int
 */
function nice_portfolio_get_the_ID() {
	$project = nice_portfolio_obtain_project();

	if ( $project instanceof Nice_Portfolio_Project ) {
		return $project->get_the_ID();
	}

	return null;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_valid_ID' ) ) :
/**
 * Check if the given ID is valid and return it in case it is.
 *
 * @since  1.0
 *
 * @param  int|WP_Post $project_id
 *
 * @return null|int
 */
function nice_portfolio_get_valid_ID( $project_id = null ) {
	// Allow a `WP_Post` object as input parameter.
	if ( $project_id instanceof WP_Post ) {
		$project_id = $project_id->ID;
	}

	// Return early if the ID doesn't match our post type.
	if ( $project_id && nice_portfolio_post_type_name() === get_post_type( $project_id ) ) {
		return $project_id;
	}

	return nice_portfolio_get_the_ID();
}
endif;

if ( ! function_exists( 'nice_portfolio_can_display_category_filter' ) ) :
/**
 * Check if the category filter can be displayed.
 *
 * @since  1.0
 *
 * @return bool
 */
function nice_portfolio_can_display_category_filter() {
	// Don't display for category and tag pages, and neither on widgets.
	if ( nice_portfolio_is_category() || nice_portfolio_is_tag() || nice_portfolio_doing_widget() ) {
		$can_display = false;
	}

	// Check if we're in a shortcode context and can display the filter.
	if ( ! isset( $can_display ) && nice_portfolio_doing_shortcode() && $shortcode = nice_portfolio_current_shortcode() ) {
		$can_display = nice_portfolio_bool( $shortcode->atts['category_filter'] );
	}

	// If we haven't returned anything yet, default to settings.
	if ( ! isset( $can_display ) ) {
		$settings = nice_portfolio_settings();
		$can_display = $settings['display_category_filter'];
	}

	/**
	 * @hook nice_portfolio_can_display_category_filter
	 *
	 * Hook here if you want to modify the conditions for the filter to be
	 * displayed.
	 *
	 * @since 1.0
	 */
	return apply_filters( 'nice_portfolio_can_display_category_filter', $can_display );
}
endif;

if ( ! function_exists( 'nice_portfolio_project_can_display' ) ) :
/**
 * Check if the given data of a project should be displayed.
 *
 * @since  1.0
 *
 * @param  string  $data_name
 * @param  int     $project_id
 *
 * @return bool
 */
function nice_portfolio_project_can_display( $data_name, $project_id = null ) {
	$project = nice_portfolio_obtain_project( nice_portfolio_get_valid_ID( $project_id ) );
	return $project->can_display( $data_name );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_field' ) ) :
/**
 * Obtain meta data of a project by ID and field name.
 *
 * @since  1.0
 *
 * @param  int    $project_id
 * @param  string $field
 *
 * @return mixed
 */
function nice_portfolio_get_project_field( $project_id = null, $field = null ) {
	$project = nice_portfolio_obtain_project( nice_portfolio_get_valid_ID( $project_id ) );
	return $project->get_custom_fields( $field );
}
endif;

if ( ! function_exists( 'nice_portfolio_project_thumbnail' ) ) :
/**
 * Print the thumbnail of a project by ID.
 *
 * If no ID is given, it will be resolved from the current project inside the
 * loop.
 *
 * @since  1.0
 *
 * @param  int    $project_id
 * @param  string $image_size
 * @param  array  $attributes
 *
 * @return string
 */
function nice_portfolio_project_thumbnail( $project_id = null, $image_size = null, $attributes = array() ) {
	echo nice_portfolio_get_project_thumbnail( $project_id, $image_size, $attributes ); // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_thumbnail' ) ) :
/**
 * Obtain the thumbnail of a project by ID.
 *
 * If no ID is given, it will be resolved from the current project inside the
 * loop.
 *
 * @since  1.0
 *
 * @param  int    $project_id
 * @param  string $image_size
 * @param  array  $attributes
 *
 * @return string
 */
function nice_portfolio_get_project_thumbnail( $project_id = null, $image_size = '', $attributes = array() ) {
	// Return early if we couldn't get an ID.
	if ( ! ( $project_id = nice_portfolio_get_valid_ID( $project_id ) ) ) {
		return null;
	}

	static $thumbnails = array();

	$settings = nice_portfolio_settings();

	/**
	 * Define image size if not set yet.
	 */
	// Obtain values if called from from widget.
	if ( ! $image_size && nice_portfolio_doing_widget() ) {
		$widget = nice_portfolio_current_widget();
		$image_size = array( $widget->args['thumbnail_width'], $widget->args['thumbnail_height'] );
	}

	// Obtain values if called from a shortcode. Both image_width and image_height are required.
	if ( ! $image_size && nice_portfolio_doing_shortcode() ) {
		$shortcode = nice_portfolio_current_shortcode();
		$atts = $shortcode->atts;
		$default_size = $settings['archive_image_size'];

		if ( ( $atts['image_width'] && $atts['image_width'] != $default_size['width'] ) // WPCS: loose comparison ok.
		       || ( $atts['image_height'] && $atts['image_height'] != $default_size['height'] ) // WPCS: loose comparison ok.
		) {
			$image_size = array(
				0 => $atts['image_width'] ? $atts['image_width'] : $atts['image_height'],
				1 => $atts['image_height'] ? $atts['image_height'] : $atts['image_width'],
			);
		}
	}

	// Obtain default/fallback values.
	if ( ! $image_size ) {
		$is_singular = is_singular( nice_portfolio_post_type_name() );
		$image_size  = $is_singular ? 'nice-portfolio-single' : 'nice-portfolio-archive';
	}

	/**
	 * @hook nice_portfolio_project_thumbnail_size
	 *
	 * Hook here to change the size of the thumbnail.
	 *
	 * @since 1.0
	 */
	$image_size = apply_filters( 'nice_portfolio_project_thumbnail_size', $image_size, $project_id );

	/**
	 * Define collection name.
	 */
	$collection = is_array( $image_size ) ? join( 'x', $image_size ) : $image_size;

	/**
	 * Return image, if found in the collection.
	 */
	if ( isset( $thumbnails[ $collection ][ $project_id ] ) ) {
		return $thumbnails[ $collection ][ $project_id ];
	}

	/**
	 * Try to obtain the image using the `nice_image()` function, available in
	 * our themes.
	 */
	if ( function_exists( 'nice_image' ) && has_post_thumbnail( $project_id ) ) {
		/**
		 * Try to get image dimensions from settings.
		 */
		switch ( $image_size ) {
			case 'nice-portfolio-archive' :
				$width  = $settings['archive_image_size']['width'];
				$height = $settings['archive_image_size']['height'];
				break;

			case 'nice-portfolio-single' :
				$width  = $settings['single_image_size']['width'];
				$height = $settings['single_image_size']['height'];
				break;

			default:
				$width  = is_array( $image_size ) ? intval( $image_size[0] ) : 300;
				$height = is_array( $image_size ) ? intval( $image_size[1] ) : 300;
				break;
		}

		$thumbnail = nice_image( array_merge( array(
				'size'   => is_string( $image_size ) ? $image_size : '',
				'width'  => $width,
				'height' => $height,
				'id'     => $project_id,
				'echo'   => false,
		), $attributes ) );
	}

	/**
	 * Use WP functionality if we couldn't get the thumbnail yet.
	 */
	if ( ! isset( $thumbnail ) ) {
		if ( isset( $attributes['attr'] ) && is_array( $attributes['attr'] ) && ! empty( $attributes['attr'] ) ) {
			$attributes = array_merge( $attributes, $attributes['attr'] );
			unset( $attributes['attr'] );
		}

		$thumbnail = get_the_post_thumbnail( $project_id, $image_size, $attributes );
	}

	/**
	 * @hook nice_portfolio_project_thumbnail
	 *
	 * Hook here to modify the output for the thumbnail.
	 *
	 * @since 1.0
	 */
	$thumbnail = apply_filters( 'nice_portfolio_project_thumbnail', $thumbnail, $project_id );

	$thumbnails[ $collection ][ $project_id ] = $thumbnail;

	return $thumbnail;
}
endif;

if ( ! function_exists( 'nice_portfolio_project_thumbnail_url' ) ) :
/**
 * Print the URL for the thumbnail of the project.
 *
 * @since  1.0
 *
 * @param  int $project_id
 *
 * @return string
 */
function nice_portfolio_project_thumbnail_url( $project_id = null ) {
	echo nice_portfolio_get_project_thumbnail_url( $project_id ); // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_thumbnail_url' ) ) :
/**
 * Obtain the URL for the thumbnail of the project.
 *
 * @since  1.0
 *
 * @param  int $project_id
 *
 * @return string
 */
function nice_portfolio_get_project_thumbnail_url( $project_id = null ) {
	$project_id = nice_portfolio_get_valid_ID( $project_id );
	$src        = wp_get_attachment_image_src( get_post_thumbnail_id( $project_id ), 'full' );

	/**
	 * @hook nice_portfolio_project_thumbnail_url
	 *
	 * Hook here to modify the URL of the thumbnail.
	 *
	 * @since 1.0
	 */
	return apply_filters( 'nice_portfolio_project_thumbnail_url', $src[0], $project_id );
}
endif;

if ( ! function_exists( 'nice_portfolio_project_class' ) ) :
/**
 * Print HTML class(es) for the wrapper of a looped project.
 *
 * This function will only work as expected inside a loop of projects.
 *
 * @see   nice_portfolio()
 *
 * @since 1.0
 *
 * @param string|array $class String or array containing custom classes.
 */
function nice_portfolio_project_class( $class = '' ) {
	echo 'class="' . esc_attr( join( ' ', nice_portfolio_get_project_class( nice_portfolio_get_the_ID(), $class ) ) ) . '"';
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_class' ) ) :
/**
 * Print HTML class(es) for the wrapper of a looped project.
 *
 * This function will only work as expected inside a loop of projects.
 *
 * @see    nice_portfolio()
 *
 * @since  1.0
 *
 * @param  int          $project_id
 * @param  string|array $class      String or array containing custom classes.
 *
 * @return string
 */
function nice_portfolio_get_project_class( $project_id = null, $class = '' ) {
	$project_id = nice_portfolio_get_valid_ID( $project_id );

	/**
	 * Construct class.
	 */
	$classes = array(
		'nice-portfolio-project',
		'item',
		'portfolio-project-' . $project_id,
	);

	/**
	 * Add the names of the terms associated to the current post.
	 */
	$terms = nice_portfolio_get_project_categories( $project_id );
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$classes[] = 'term-' . $term->term_id;
		}
	}

	/**
	 * Add number of columns for grids.
	 */
	if ( ! nice_portfolio_doing_widget() && ! nice_portfolio_is_single() ) {
		$classes[] = 'columns-' . nice_portfolio_get_grid_columns();
	}

	/**
	 * Add classes for single projects.
	 */
	if ( nice_portfolio_is_single() ) {
		$classes[] = 'nice-portfolio';
		$classes[] = 'single';
		$classes[] = 'hentry';

		if ( ! nice_portfolio_needs_assets() ) {
			$classes[] = 'no-default-styles';
		}
	}

	/**
	 * Add custom classes.
	 */
	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}

		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	/**
	 * @hook nice_portfolio_project_class
	 *
	 * Hook here to modify the name of the class for the project wrapper.
	 *
	 * @since 1.0
	 */
	$classes = apply_filters( 'nice_portfolio_project_class', $classes, $class, $project_id );

	return array_unique( $classes );
}
endif;

if ( ! function_exists( 'nice_portfolio_class' ) ) :
/**
 * Print HTML class(es) for the wrapper of the list of portfolio projects.
 *
 * @see    nice_portfolio()
 *
 * @since  1.0
 *
 * @param  string|array $class String or array containing custom classes.
 * @param  bool         $echo  Wheter to print the HTML or just return it.
 * 
 * @return string
 */
function nice_portfolio_class( $class = '', $echo = true ) {
	$html = 'class="' . esc_attr( join( ' ', nice_portfolio_get_class( $class ) ) ) . '"';

	if ( $echo ) {
		echo $html;
	}

	return $html;
}
endif;

if ( ! function_exists( 'nice_portfolio_widget_class' ) ) :
/**
 * Print HTML class(es) for the wrapper of a widget.
 *
 * @see    nice_portfolio()
 *
 * @since  1.0
 *
 * @param  string|array $class String or array containing custom classes.
 * @param  bool         $echo  Wheter to print the HTML or just return it.
 * 
 * @return string
 */
function nice_portfolio_widget_class( $class = '', $echo = true ) {
	$html = 'class="' . esc_attr( join( ' ', nice_portfolio_get_widget_class( $class ) ) ) . '"';

	if ( $echo ) {
		echo $html;
	}

	return $html;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_class' ) ) :
/**
 * Print HTML class(es) for the wrapper of the list of portfolio projects.
 *
 * @see    nice_portfolio()
 *
 * @since  1.0
 *
 * @param  string|array $class String or array containing custom classes.
 *
 * @return array
 */
function nice_portfolio_get_class( $class = '' ) {
	/**
	 * Show warning and return early if using this function in a widget context.
	 *
	 * @since 1.0.1
	 */
	if ( nice_portfolio_doing_widget() ) {
		_nice_portfolio_doing_it_wrong( __FUNCTION__, esc_html__( 'This function should not be used in widget context.', 'nicethemes' ), '1.0.1' );

		return array();
	}

	/**
	 * Construct class.
	 */
	$classes = array(
		'nice-portfolio',
	);

	/**
	 * Add classes depending on context.
	 */

	if ( ! nice_portfolio_is_single() ) {
		$classes[] = 'grid';
	}

	if ( nice_portfolio_doing_shortcode() ) {
		$shortcode = nice_portfolio_current_shortcode();

		/**
		 * Add class to avoid using the default plugin styles.
		 */
		if ( isset( $shortcode->atts['avoidcss'] ) && nice_portfolio_bool( $shortcode->atts['avoidcss'] ) ) {
			$avoidcss = true;
		}
	}

	/**
	 * Identify filterable lists.
	 */
	if ( nice_portfolio_can_display_category_filter() ) {
		$classes[] = 'filterable';
	}

	/**
	 * Add class to avoid using the default plugin styles, if not added yet.
	 */
	if ( empty( $avoidcss ) && nice_portfolio_needs_assets() ) {
		$classes[] = 'default-styles';
	}

	/**
	 * Add custom classes.
	 */
	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}

		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	/**
	 * @hook nice_portfolio_class
	 *
	 * Hook here to modify the name of the class for the portfolio wrapper.
	 *
	 * @since 1.0
	 */
	$classes = apply_filters( 'nice_portfolio_class', $classes, $class );

	return array_unique( $classes );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_widget_class' ) ) :
/**
 * Print HTML class(es) for the wrapper of the list of portfolio projects.
 *
 * @see    nice_portfolio()
 *
 * @since  1.0
 *
 * @param  string|array $class String or array containing custom classes.
 *
 * @return array
 */
function nice_portfolio_get_widget_class( $class = '' ) {
	/**
	 * Show warning and return early if not using this function in a widget context.
	 *
	 * @since 1.0.1
	 */
	if ( ! nice_portfolio_doing_widget() ) {
		_nice_portfolio_doing_it_wrong( __FUNCTION__, esc_html__( 'This function should not be used outside of a widget context.', 'nicethemes' ), '1.0.1' );

		return array();
	}

	/**
	 * Construct class.
	 */
	$classes = array(
		'widget-text',
		'nice-portfolio',
		'nice-portfolio-widget-box',
	);

	/**
	 * Add class to avoid using the default plugin styles, if not added yet.
	 */
	if ( empty( $avoidcss ) && nice_portfolio_needs_assets() ) {
		$classes[] = 'default-styles';
	}

	/**
	 * Add custom classes.
	 */
	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}

		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	/**
	 * @hook nice_portfolio_class
	 *
	 * Hook here to modify the name of the class for the portfolio wrapper.
	 *
	 * @since 1.0
	 */
	$classes = apply_filters( 'nice_portfolio_widget_class', $classes, $class );

	return array_unique( $classes );
}
endif;

if ( ! function_exists( 'nice_portfolio_grid_columns' ) ) :
/**
 * Print the number of columns for the current Portfolio grid.
 *
 * @since  1.0
 */
function nice_portfolio_grid_columns() {
	echo intval( nice_portfolio_get_grid_columns() );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_grid_columns' ) ) :
/**
 * Obtain the number of columns for the current Portfolio grid.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_get_grid_columns() {
	$portfolio = nice_portfolio_obtain_instance();
	$args      = $portfolio->args;

	if ( empty( $args['columns'] ) || $args['columns'] < 1 ) {
		$args = nice_portfolio_settings();
	}

	return $args['columns'];
}
endif;

if ( ! function_exists( 'nice_portfolio_project_embed' ) ) :
/**
 * Print the embed code of a portfolio project.
 *
 * @since  1.0
 *
 * @param  Nice_Portfolio_Project $project
 * @param  array                  $embed_size
 * @param  array                  $attributes
 *
 * @return string
 */
function nice_portfolio_project_embed( $project = null, $embed_size = array(), $attributes = array() ) {
	echo nice_portfolio_get_project_embed( $project, $embed_size, $attributes ); // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_embed' ) ) :
/**
 * Obtain the embed code of a portfolio project.
 *
 * @since  1.0
 *
 * @param  int    $project_id
 * @param  array  $embed_size
 * @param  array  $attributes
 *
 * @return string
 */
function nice_portfolio_get_project_embed( $project_id = null, $embed_size = array(), $attributes = array() ) {
	$project_id = nice_portfolio_get_valid_ID( $project_id );

	/**
	 * Try to obtain the embed code using the `nice_embed()` function,
	 * available in our themes.
	 */
	if ( function_exists( 'nice_embed' ) ) {
		$embed = nice_embed( array_merge( array(
				'field'  => '_project_embed',
				'width'  => isset( $embed_size[0] ) ? intval( $embed_size[0] ) : null,
				'height' => isset( $embed_size[1] ) ? intval( $embed_size[1] ) : null,
				'id'     => $project_id,
				'echo'   => false,
		), $attributes ) );
	}

	/**
	 * Use the value of the field if we couldn't get an embed code yet.
	 */
	if ( ! isset( $embed ) ) {
		$embed = html_entity_decode( nice_portfolio_get_project_field( $project_id, 'embed' ) );
	}

	/**
	 * @hook nice_portfolio_project_embed
	 *
	 * Hook here if you want to modify the embed code for this project.
	 *
	 * @since 1.0
	 */
	$embed = apply_filters( 'nice_portfolio_project_embed', $embed, $project_id );

	return $embed;
}
endif;

if ( ! function_exists( 'nice_portfolio_project_gallery' ) ) :
/**
 * Print the gallery of a portfolio project.
 *
 * @since  1.0
 *
 * @param  int $project_id
 *
 * @return string
 */
function nice_portfolio_project_gallery( $project_id = null ) {
	echo nice_portfolio_get_project_gallery( $project_id ); // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_gallery' ) ) :
/**
 * Obtain the gallery of a portfolio project.
 *
 * @since  1.0
 *
 * @param  int $project_id
 *
 * @return string
 */
function nice_portfolio_get_project_gallery( $project_id = null ) {
	static $galleries = array();

	$project_id = nice_portfolio_get_valid_ID( $project_id );

	// Don't process the gallery for this project more than once.
	if ( isset( $galleries[ $project_id ] ) ) {
		return $galleries[ $project_id ];
	}

	/**
	 * Try to obtain data for the gallery from a transient, and generate one if
	 * it doesn't exist.
	 */
	if ( ! $gallery_images = get_transient( 'nice_portfolio_project_gallery_' . $project_id ) ) {
		/**
		 * Obtain the comma-separated list of gallery image IDs.
		 */
		$gallery_raw = nice_portfolio_get_project_field( $project_id, 'gallery' );

		/**
		 * Obtain array of image IDs.
		 */
		$gallery_images = $gallery_raw ? explode( ',', $gallery_raw ) : array();

		/**
		 * Make sure all IDs are numeric.
		 */
		foreach ( $gallery_images as $key => $image_id ) {
			if ( ! is_numeric( $image_id ) ) {
				$gallery_images[ $key ] = nice_portfolio_get_attachment_id_by_name( $image_id );
			}
		}

		/**
		 * Set transient to prevent lots of queries in further requests.
		 *
		 * This transient is removed after 24 hours or every time the
		 * project is saved.
		 *
		 * @see nice_portfolio_delete_project_gallery_transients()
		 *
		 * @since 1.0
		 */
		set_transient( 'nice_portfolio_project_gallery_' . $project_id, $gallery_images, 60 * 60 * 24 );
	}

	if ( ! empty( $gallery_images ) ) {
		/**
		 * @hook nice_portfolio_project_gallery_columns
		 *
		 * Hook here to modify the number of columns in project galleries.
		 */
		$columns = apply_filters( 'nice_portfolio_project_gallery_columns', 3, $project_id );

		/**
		 * Use `gallery` shortcode to generate gallery HTML.
		 */
		$gallery = do_shortcode( '[gallery ids="' . implode( ',', $gallery_images ) . '" link="file" columns="' . $columns . '"]' );
	}

	$gallery = isset( $gallery ) ? $gallery : null;

	$galleries[ $project_id ] = $gallery;

	/**
	 * @hook nice_portfolio_project_gallery
	 *
	 * Hook here to modify the HTML of the project gallery.
	 *
	 * @since 1.0
	 */
	return apply_filters( 'nice_portfolio_project_gallery', $gallery, $project_id );
}
endif;

if ( ! function_exists( 'nice_portfolio_project_client' ) ) :
/**
 * Print the client for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_project_client( $project_id = null ) {
	echo esc_html( nice_portfolio_get_project_client( $project_id ) );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_client' ) ) :
/**
 * Obtain the client for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_get_project_client( $project_id = null ) {
	$client = nice_portfolio_get_project_field( $project_id, 'client' );

	return apply_filters( 'nice_portfolio_project_client', $client, $project_id );
}
endif;

if ( ! function_exists( 'nice_portfolio_project_start_date' ) ) :
/**
 * Print the start date for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_project_start_date( $project_id = null ) {
	echo esc_html( nice_portfolio_get_project_start_date( $project_id ) );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_start_date' ) ) :
/**
 * Obtain the start date for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_get_project_start_date( $project_id = null ) {
	$start_date = nice_portfolio_get_project_field( $project_id, 'start_date' );

	return apply_filters( 'nice_portfolio_project_start_date', $start_date, $project_id );
}
endif;

if ( ! function_exists( 'nice_portfolio_project_end_date' ) ) :
/**
 * Print the end date for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_project_end_date( $project_id = null ) {
	echo esc_html( nice_portfolio_get_project_end_date( $project_id ) );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_end_date' ) ) :
/**
 * Obtain the end date for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_get_project_end_date( $project_id = null ) {
	$end_date = nice_portfolio_get_project_field( $project_id, 'end_date' );

	return apply_filters( 'nice_portfolio_project_end_date', $end_date, $project_id );
}
endif;

if ( ! function_exists( 'nice_portfolio_project_url' ) ) :
/**
 * Print the URL for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_project_url( $project_id = null ) {
	echo esc_url( nice_portfolio_get_project_url( $project_id ) );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_url' ) ) :
/**
 * Obtain the URL for a given project.
 *
 * @since  1.0
 *
 * @param  int         $project_id
 *
 * @return null|string
 */
function nice_portfolio_get_project_url( $project_id = null ) {
	$url = nice_portfolio_get_project_field( $project_id, 'url' );

	return apply_filters( 'nice_portfolio_project_url', $url, $project_id );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_related_projects' ) ) :
/**
 * Print a list of related related portfolio projects by taxonomy.
 *
 * @since  1.0
 *
 * @param  int      $project_id
 *
 * @return WP_Query
 */
function nice_portfolio_get_related_projects( $project_id = null ) {
	$project = nice_portfolio_obtain_project( $project_id );
	return $project->related_projects;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_categories' ) ) :
/**
 * Obtain the list of categories that a project is attached to.
 *
 * @since  1.0
 *
 * @uses  get_the_terms()
 *
 * @param  int   $project_id
 *
 * @return array
 */
function nice_portfolio_get_project_categories( $project_id = null ) {
	$project = nice_portfolio_obtain_project( nice_portfolio_get_valid_ID( $project_id ) );
	return $project->categories;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_tags' ) ) :
/**
 * Obtain the list of tags that a project is attached to.
 *
 * @since  1.0
 *
 * @param  int   $project_id
 *
 * @return array
 */
function nice_portfolio_get_project_tags( $project_id = null ) {
	$project = nice_portfolio_obtain_project( nice_portfolio_get_valid_ID( $project_id ) );
	return $project->tags;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_project_terms' ) ) :
/**
 * Obtain the list of terms that a project is attached to.
 *
 * @since  1.0
 *
 * @param  int   $project_id
 *
 * @return array
 */
function nice_portfolio_get_project_terms( $project_id = null ) {
	$project = nice_portfolio_obtain_project( nice_portfolio_get_valid_ID( $project_id ) );
	return $project->get_terms();
}
endif;

if ( ! function_exists( 'nice_portfolio_get_categories' ) ) :
/**
 * Obtain a list of all created portfolio categories.
 *
 * @since  1.0
 *
 * @uses   get_categories()
 *
 * @param  array $args
 *
 * @return array
 */
function nice_portfolio_get_categories( $args = array() ) {
	$categories = get_categories( array_merge( $args, array(
			'taxonomy' => nice_portfolio_category_name(),
		)
	) );

	return $categories;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_tags' ) ) :
/**
 * Obtain a list of all created portfolio tags.
 *
 * @since  1.0
 *
 * @return array
 */
function nice_portfolio_get_tags() {
	$tags = get_terms( array( nice_portfolio_tag_name() ) );

	return $tags;
}
endif;

if ( ! function_exists( 'nice_portfolio_get_terms' ) ) :
/**
 * Obtain a list of all created portfolio terms.
 *
 * @since  1.0
 *
 * @return array
 */
function nice_portfolio_get_terms() {
	$terms = array_merge( nice_portfolio_get_categories(), nice_portfolio_get_tags() );

	return $terms;
}
endif;

/** ==========================================================================
 *  HTML Handlers.
 *  ======================================================================= */

if ( ! function_exists( 'nice_portfolio_archive_title' ) ) :
/**
 * Print the title of the current archive.
 *
 * @since 1.0
 */
function nice_portfolio_archive_title() {
	echo nice_portfolio_get_archive_title(); // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_archive_title' ) ) :
/**
 * Obtain the title of an archive page.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_get_archive_title() {
	$title = function_exists( 'get_the_archive_title' ) ? get_the_archive_title() : esc_html__( 'Projects Archive', 'nice-portfolio' );

	/**
	 * @hook nice_portfolio_archive_title
	 *
	 * Hook here if you want to modify the archive's title.
	 *
	 * @since 1.0
	 */
	$title = apply_filters( 'nice_portfolio_archive_title', $title );

	return $title;
}
endif;

if ( ! function_exists( 'nice_portfolio_category_title' ) ) :
/**
 * Print the title of the current category.
 *
 * @since 1.0
 */
function nice_portfolio_category_title() {
	echo nice_portfolio_get_category_title(); // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_category_title' ) ) :
/**
 * Obtain the title of the current category.
 *
 * @since 1.0
 */
function nice_portfolio_get_category_title() {
	$category = nice_portfolio_category_name();
	$term     = get_term_by( 'slug', $GLOBALS[ $category ], $category );

	/**
	 * @hook nice_portfolio_category_title
	 *
	 * Hook here if you want to modify the category's title.
	 *
	 * @since 1.0
	 */
	$title = apply_filters( 'nice_portfolio_category_title', $term->name );

	return $title;
}
endif;

if ( ! function_exists( 'nice_portfolio_tag_title' ) ) :
/**
 * Print the title of the current tag.
 *
 * @since 1.0
 */
function nice_portfolio_tag_title() {
	echo nice_portfolio_get_tag_title(); // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_tag_title' ) ) :
/**
 * Obtain the title of the current tag.
 *
 * @since 1.0
 */
function nice_portfolio_get_tag_title() {
	$tag  = nice_portfolio_tag_name();
	$term = get_term_by( 'slug', $GLOBALS[ $tag ], $tag );

	/**
	 * @hook nice_portfolio_tag_title
	 *
	 * Hook here if you want to modify the tag's title.
	 *
	 * @since 1.0
	 */
	$title = apply_filters( 'nice_portfolio_tag_title', $term->name );

	return $title;
}
endif;

if ( ! function_exists( 'nice_portfolio_the_title' ) ) :
/**
 * Prints out the title of the current page.
 *
 * Use this function only to display top-level page titles. It will not work for
 * titles within loops.
 *
 * @since 1.0
 *
 * @uses  nice_portfolio_get_title()
 *
 * @param string $before HTML to display before the title.
 * @param string $after  HTML to display after the title.
 */
function nice_portfolio_the_title( $before = '', $after = '' ) {
	echo $before . nice_portfolio_get_title() . $after; // WPCS: XSS ok.
}
endif;

if ( ! function_exists( 'nice_portfolio_get_title' ) ) :
/**
 * Obtain the title of the current page.
 *
 * Use this function only to obtain top-level page titles. It will not work for
 * titles within loops.
 *
 * @since 1.0
 */
function nice_portfolio_get_title() {
	$title = get_the_title();

	/**
	 * @hook nice_portfolio_the_title
	 *
	 * All modifications to the page title in portfolio pages should be hooked
	 * here.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see nice_portfolio_get_category_title() - 10 (returns the current category title)
	 * @see nice_portfolio_get_tag_title() - 10 (returns the current tag title)
	 * @see nice_portfolio_get_archive_title() - 10 (returns the current archive title)
	 */
	$title = apply_filters( 'nice_portfolio_the_title', $title );

	return $title;
}
endif;

/** ==========================================================================
 *  Navigation.
 *  ======================================================================= */

if ( ! function_exists( 'nice_portfolio_page_navigation_id' ) ) :
/**
 * Print the ID for the main HTML element in page navigation.
 *
 * @since  1.0
 */
function nice_portfolio_page_navigation_id() {
	echo esc_attr( nice_portfolio_get_page_navigation_id() );
}
endif;

if ( ! function_exists( 'nice_portfolio_get_page_navigation_id' ) ) :
/**
 * Obtain the ID for the main HTML element in page navigation.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_get_page_navigation_id() {
	$html_id = 'nice-portfolio-nav';

	$locations = array(
		'nice-portfolio-category-nav' => nice_portfolio_is_category(),
		'nice-portfolio-tag-nav'      => nice_portfolio_is_tag(),
		'nice-portfolio-archive-nav'  => nice_portfolio_is_archive(),
	);

	foreach ( $locations as $id => $value ) {
		if ( $value ) {
			$html_id = $id;
			break;
		}
	}

	/**
	 * @hook nice_portfolio_page_navigation_id
	 *
	 * Hook here if you want to modify the ID of page navigation.
	 *
	 * @since 1.0
	 */
	$html_id = apply_filters( 'nice_portfolio_page_navigation_id', $html_id );

	return $html_id;
}
endif;

if ( ! function_exists( 'nice_portfolio_sidebar' ) ) :
/**
 * Load a sidebar in the current page.
 *
 * @uses get_sidebar()
 * @link https://codex.wordpress.org/Function_Reference/get_sidebar
 *
 * Remove this action using:
 *
	remove_action( 'nice_portfolio_sidebar', 'nice_portfolio_sidebar', 10 );
 *
 * Then you can use `get_sidebar()` to display your custom sidebar anywhere you want.
 *
 * @since 1.0
 */
function nice_portfolio_sidebar() {
	/**
	 * Load the `sidebar.php file` in the root folder of your theme.
	 *
	 * If you want to use a specific sidebar for portfolio pages, create the file
	 * `sidebar-nice-portfolio.php` in the root folder of your theme.
	 */
	get_sidebar( 'nice-portfolio' );
}
endif;

