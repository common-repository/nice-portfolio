<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for recent portfolio projects widget form.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Obtain current widget.
 *
 * @var Nice_Portfolio_Categories_Widget $widget
 */
$widget = nice_portfolio_admin_current_widget();
?>
<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title', 'nice-portfolio' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $widget->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget->args['title'] ); ?>"/>
</p>
<p>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'nice-portfolio' ); ?></label>
	<input type="text" size="3" value="<?php echo esc_attr( $widget->args['number'] ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'number' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'number' ) ); ?>">
</p>
<p>
	<input type="checkbox" name="<?php echo esc_attr( $widget->get_field_name( 'display_excerpt' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'display_excerpt' ) ); ?>" class="checkbox" <?php checked( $widget->args['display_excerpt'], true ); ?>>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'display_excerpt' ) ); ?>"><?php esc_html_e( 'Display project excerpt?', 'nice-portfolio' ); ?></label><br>

	<input type="checkbox" name="<?php echo esc_attr( $widget->get_field_name( 'display_thumbnail' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'display_thumbnail' ) ); ?>" class="checkbox" <?php checked( $widget->args['display_thumbnail'], true ); ?>>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'display_thumbnail' ) ); ?>"><?php esc_html_e( 'Display project thumbnail?', 'nice-portfolio' ); ?></label><br>
</p>
<p>
	<strong><?php esc_html_e( 'Thumbnail Size:', 'nice-portfolio' ); ?></strong><br />
	<label for="<?php echo esc_attr( $widget->get_field_id( 'thumbnail_width' ) ); ?>"><?php esc_html_e( 'Width:', 'nice-portfolio' ); ?></label>
	<input type="text" size="3" value="<?php echo esc_attr( $widget->args['thumbnail_width'] ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'thumbnail_width' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'thumbnail_width' ) ); ?>">
	<label for="<?php echo esc_attr( $widget->get_field_id( 'thumbnail_height' ) ); ?>"><?php esc_html_e( 'Height:', 'nice-portfolio' ); ?></label>
	<input type="text" size="3" value="<?php echo esc_attr( $widget->args['thumbnail_height'] ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'thumbnail_height' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'thumbnail_height' ) ); ?>">
</p>
