<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * This file handles meta boxes for this plugin's custom post type.
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

if ( ! function_exists( 'nice_portfolio_sanitize_embed' ) ) :
/**
 * Sanitize video embed code.
 *
 * @since  1.0
 *
 * @param  string $html
 *
 * @return string
 */
function nice_portfolio_sanitize_embed( $html ) {
	// Allow bypass.
	if ( $sanitized_embed = apply_filters( 'nice_portfolio_sanitized_embed', '', $html ) ) {
		return $sanitized_embed;
	}

	$allowed_html = array(
		'iframe' => array(
			'src'                   => true,
			'width'                 => true,
			'height'                => true,
			'frameborder'           => true,
			'webkitallowfullscreen' => true,
			'mozallowfullscreen'    => true,
			'allowfullscreen'       => true,
		),
		'video'  => array(
			'width'    => true,
			'height'   => true,
			'controls' => true,
		),
		'source'   => array(
			'src'  => true,
			'type' => true,
		),
	);

	$sanitized_embed = wp_kses( $html, $allowed_html );

	return $sanitized_embed;
}
endif;

if ( ! function_exists( 'nice_portfolio_create_metabox_info' ) ) :
add_filter( 'nice_portfolio_metaboxes', 'nice_portfolio_create_metabox_info' );
/**
 * Create a metabox for our custom post type.
 *
 * @since  1.0
 *
 * @param  array $metaboxes Current list of metaboxes data.
 *
 * @return array
 */
function nice_portfolio_create_metabox_info( array $metaboxes = array() ) {
	// Define post types.
	$post_types = array( nice_portfolio_post_type_name() );
	$post_types = apply_filters( 'nice_portfolio_metabox_info_post_types', $post_types );

	// Define embed field.
	$embed = array(
		'type'                  => 'textarea',
		'label'                 => esc_html__( 'Video Embed Code', 'nice-portfolio' ),
		'name'                  => '_project_embed',
		'sanitization_callback' => 'nice_portfolio_sanitize_embed',
		'desc'                  => esc_html__( 'Enter the video embed code for your video (YouTube, Vimeo or similar). It will show instead of your image.', 'nice-portfolio' ),
	);
	$embed = apply_filters( 'nice_portfolio_metabox_info_embed', $embed );

	// Define client field.
	$client = array(
		'type'  => 'text',
		'label' => esc_html__( 'Client', 'nice-portfolio' ),
		'name'  => '_project_client',
		'desc'  => esc_html__( 'Enter the name of the client of the project, e.g Google or John Doe.', 'nice-portfolio' ),
	);
	$client = apply_filters( 'nice_portfolio_metabox_info_client', $client );

	// Define start date field.
	$start_date = array(
		'type'  => 'text',
		'label' => esc_html__( 'Start Date', 'nice-portfolio' ),
		'name'  => '_project_start_date',
		'desc'  => esc_html__( 'When was this project started?', 'nice-portfolio' ),
	);
	$start_date = apply_filters( 'nice_portfolio_metabox_info_start_date', $start_date );

	// Define end date field.
	$end_date = array(
		'type'  => 'text',
		'label' => esc_html__( 'End Date', 'nice-portfolio' ),
		'name'  => '_project_end_date',
		'desc'  => esc_html__( 'When was this project finished?', 'nice-portfolio' ),
	);
	$end_date = apply_filters( 'nice_portfolio_metabox_info_end_date', $end_date );

	// Define URL field.
	$url = array(
		'type'                  => 'text',
		'label'                 => esc_html__( 'Project URL', 'nice-portfolio' ),
		'name'                  => '_project_url',
		'sanitization_callback' => 'esc_url_raw',
		'desc'                  => esc_html__( 'Enter URL of your client\'s site.', 'nice-portfolio' ),
	);
	$url = apply_filters( 'nice_portfolio_metabox_info_url', $url );

	// Group all fields.
	$fields = array(
		$embed,
		$client,
		$start_date,
		$end_date,
		$url,
	);
	$fields = apply_filters( 'nice_portfolio_metabox_info_fields', $fields );

	// Define meta box settings.
	$settings = array(
		'title' => esc_html__( 'Project Details', 'nice-portfolio' ),
	);
	$settings = apply_filters( 'nice_portfolio_metabox_info_settings', $settings );

	// Prepare arguments.
	$args = array(
		'id'         => 'nice-portfolio-project-details',
		'post_types' => $post_types,
		'fields'     => $fields,
		'settings'   => $settings,
	);

	$metaboxes[] = apply_filters( 'nice_portfolio_metabox_info_args', $args );

	return $metaboxes;
}
endif;

if ( ! function_exists( 'nice_portfolio_create_metabox_gallery' ) ) :
add_filter( 'nice_portfolio_metaboxes', 'nice_portfolio_create_metabox_gallery' );
/**
 * Create a gallery metabox for our custom post type.
 *
 * @since  1.0
 *
 * @param  array $metaboxes Current list of metaboxes data.
 *
 * @return array
 */
function nice_portfolio_create_metabox_gallery( array $metaboxes = array() ) {
	// Define post types.
	$post_types = array( nice_portfolio_post_type_name() );
	$post_types = apply_filters( 'nice_portfolio_metabox_gallery_post_types', $post_types );

	// Define embed field.
	$field = array(
		'type'  => 'gallery-upload',
		'label' => esc_html__( 'Add project gallery images', 'nice-portfolio' ),
		'name'  => '_project_gallery',
		'desc'  => '',
	);
	$field = apply_filters( 'nice_portfolio_metabox_gallery_field', $field );

	// Group all fields.
	$fields = array( $field );
	$fields = apply_filters( 'nice_portfolio_metabox_gallery_fields', $fields );

	// Define meta box settings.
	$settings = array(
		'title' => esc_html__( 'Project Gallery', 'nice-portfolio' ),
	);
	$settings = apply_filters( 'nice_portfolio_metabox_gallery_settings', $settings );

	// Prepare arguments.
	$args = array(
		'id'         => 'nice-portfolio-project-gallery',
		'post_types' => $post_types,
		'fields'     => $fields,
		'settings'   => $settings,
		'context'    => 'side',
	);

	$metaboxes[] = apply_filters( 'nice_portfolio_metabox_gallery_args', $args );

	return $metaboxes;
}
endif;

if ( ! function_exists( 'nice_portfolio_metabox_gallery_uploader' ) ) :
add_filter( 'nice_portfolio_post_type_metabox_add_field_html_gallery-upload', 'nice_portfolio_metabox_gallery_uploader' );
/**
 * Callback for `gallery-upload` field type.
 *
 * Obtain HTML for the project gallery uploader.
 *
 * @since  1.0
 *
 * @return string
 */
function nice_portfolio_metabox_gallery_uploader() {
	// Allow bypass.
	if ( $output = apply_filters( 'nice_portfolio_metabox_gallery_uploader', '' ) ) {
		return $output;
	}

	global $post;

	$gallery = get_post_meta( $post->ID, '_project_gallery', true );

	/**
	 * Try to obtain data for the gallery from a transient, and generate one if
	 * it doesn't exist.
	 */
	if ( $gallery && ! $images = get_transient( 'nice_portfolio_metabox_project_gallery_' . $post->ID ) ) {
		$gallery_array = explode( ',', $gallery );
		$images = array();

		foreach ( $gallery_array as $key => $image_id ) {
			$image_name = $image_id;
			$image_id   = is_numeric( $image_id ) ? $image_id : nice_portfolio_get_attachment_id_by_name( $image_id );

			$images[] = array(
				'id'         => $image_id,
				'name'       => $image_name,
				'attachment' => wp_get_attachment_image_src( $image_id, array( 150, 150 ) ),
			);
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
		set_transient( 'nice_portfolio_metabox_project_gallery_' . $post->ID, $images, 60 * 60 * 24 );
	}

	ob_start();
	?>
	<ul class="nice-portfolio-gallery-placeholder">
		<?php
			if ( isset( $images ) ) :
				foreach ( $images as $image ) :
		?>
			<li class="image-container" data-attachment-name="<?php echo esc_attr( $image['name'] ); ?>">
				<img src="<?php echo esc_attr( $image['attachment'][0] ); ?>" width="<?php echo esc_attr( $image['attachment'][1] ); ?>" height="<?php echo esc_attr( $image['attachment'][2] ); ?>" alt="" />

				<ul class="actions">
					<li>
						<a href="#" class="remove nice_upload_<?php echo esc_attr( $image['id'] ); ?>"><?php esc_html_e( 'Remove', 'nice-portfolio' ); ?></a>
					</li>

					<li>
						<a href="<?php echo esc_url( get_edit_post_link( $image['id'] ) ); ?>" class="edit nice_upload_<?php echo esc_attr( $image['id'] ); ?>"><?php esc_html_e( 'Edit', 'nice-portfolio' ); ?></a>
					</li>
				</ul>
			</li>
		<?php
				endforeach;
			endif;
		?>
	</ul>

	<input type="hidden" name="_project_gallery" value="<?php echo esc_attr( $gallery ); ?>" />

	<a href="#" class="nice_portfolio_upload_button"><?php esc_html_e( 'Add images to project gallery', 'nice-portfolio' ); ?></a>
	<?php

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
endif;

if ( ! function_exists( 'nice_portfolio_project_title_placeholder_text' ) ) :
add_filter( 'enter_title_here', 'nice_portfolio_project_title_placeholder_text', 20 );
/**
 * Modify the default placeholder for projects in the editor.
 *
 * @param $title
 *
 * @return string
 */
function nice_portfolio_project_title_placeholder_text( $title ) {
	$screen = get_current_screen();

	if ( nice_portfolio_post_type_name() === $screen->post_type ) {
		$title = esc_html__( 'Enter the project title here', 'nice-portfolio' );
	}

	return $title;
}
endif;

if ( ! function_exists( 'nice_portfolio_thumbnail_meta_box_html_title' ) ) :
add_action( 'add_meta_boxes', 'nice_portfolio_thumbnail_meta_box_html_title' );
/**
 * Modify the title of the Featured Image meta box.
 *
 * @since  1.0
 */
function nice_portfolio_thumbnail_meta_box_html_title() {
	global $wp_meta_boxes;

	$wp_meta_boxes[ nice_portfolio_post_type_name() ]['side']['low']['postimagediv']['title'] = esc_html__( 'Project image', 'nice-portfolio' );
}
endif;

if ( ! function_exists( 'nice_portfolio_thumbnail_meta_box_html' ) ) :
add_filter( 'admin_post_thumbnail_html', 'nice_portfolio_thumbnail_meta_box_html' );
/**
 * Modify the output of the Featured Image meta box.
 *
 * @since  1.0
 *
 * @param  string $content
 *
 * @return string
 */
function nice_portfolio_thumbnail_meta_box_html( $content ) {
	global $typenow;

	$post_type = $typenow;
	$post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0; // WPCS: CSRF ok.

	if ( ! $post_type ) {
		$post = ( $p = get_post() ) ? $p : get_post( $post_id ); // WPCS: override ok.
		$post_type = $post->post_type;
	}

	if ( nice_portfolio_post_type_name() === $post_type ) {
		$content = str_replace(
			esc_html__( 'Set featured image', 'nice-portfolio' ),
			esc_html__( 'Set project image', 'nice-portfolio' ),
			$content
		);

		$content = str_replace(
			esc_html__( 'Remove featured image', 'nice-portfolio' ),
			esc_html__( 'Remove project image', 'nice-portfolio' ),
			$content
		);
	}
	$content = apply_filters( 'nice_portfolio_thumbnail_meta_box_html', $content );

	return $content;
}
endif;

if ( ! function_exists( 'nice_portfolio_media_view_strings' ) ) :
add_filter( 'media_view_strings', 'nice_portfolio_media_view_strings' );
/**
 * Modify strings for media uploader localization.
 *
 * @since  1.0.0
 *
 * @param  array $strings List of localized strings.
 *
 * @return array
 */
function nice_portfolio_media_view_strings( array $strings = array() ) {
	global $typenow;

	$post_type = $typenow;
	$post_id = ! empty( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0; // WPCS: CSRF ok.

	if ( ! $post_type ) {
		$post = ( $p = get_post() ) ? $p : get_post( $post_id ); // WPCS: override ok.

		if ( ! $post ) {
			return $strings;
		}

		$post_type = $post->post_type;
	}

	if ( nice_portfolio_post_type_name() === $post_type ) {
		$strings = array_merge( $strings, array(
				'setFeaturedImage'      => esc_html__( 'Set Project Image', 'nice-portfolio' ),
				'setFeaturedImageTitle' => esc_html__( 'Set Project Image', 'nice-portfolio' ),
			)
		);
	}

	return $strings;
}
endif;

if ( ! function_exists( 'nice_portfolio_delete_project_gallery_transients' ) ) :
add_action( 'save_post', 'nice_portfolio_delete_project_gallery_transients' );
/**
 * Remove transients for the gallery of the current project.
 *
 * @since 1.0
 *
 * @param int $project_id
 */
function nice_portfolio_delete_project_gallery_transients( $project_id ) {
	delete_transient( 'nice_portfolio_metabox_project_gallery_' . $project_id );
	delete_transient( 'nice_portfolio_project_gallery_' . $project_id );
}
endif;
