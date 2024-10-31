<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for Portfolio Categories widget form.
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
	<input type="checkbox" name="<?php echo esc_attr( $widget->get_field_name( 'dropdown' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'dropdown' ) ); ?>" class="checkbox" <?php checked( $widget->args['dropdown'], true ); ?>>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'dropdown' ) ); ?>"><?php esc_html_e( 'Display as dropdown', 'nice-portfolio' ); ?></label><br>

	<input type="checkbox" name="<?php echo esc_attr( $widget->get_field_name( 'count' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'count' ) ); ?>" class="checkbox" <?php checked( $widget->args['count'], true ); ?>>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Show post counts', 'nice-portfolio' ); ?></label><br>

	<input type="checkbox" name="<?php echo esc_attr( $widget->get_field_name( 'hierarchical' ) ); ?>" id="<?php echo esc_attr( $widget->get_field_id( 'hierarchical' ) ); ?>" class="checkbox" <?php checked( $widget->args['hierarchical'], true ); ?>>
	<label for="<?php echo esc_attr( $widget->get_field_id( 'hierarchical' ) ); ?>"><?php esc_html_e( 'Show hierarchy', 'nice-portfolio' ); ?></label><br>
</p>
