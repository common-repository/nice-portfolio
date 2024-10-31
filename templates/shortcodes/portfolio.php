<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the `portfolio` shortcode.
 *
 * Override this template by copying it to `your-theme/portfolio/shortcodes/portfolio.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Obtain the current instance of the shortcode.
 */
$shortcode = nice_portfolio_current_shortcode();

/**
 * Obtain attributes to create a list of projects.
 *
 * @see Nice_Portfolio_Shortcode::get_default_atts() For the complete list of accepted shortcode attributes.
 */
$atts = $shortcode->atts;
?>
	<?php
		/**
		 * Display Portfolio grid using the shortcode attributes.
		 *
		 * @since 1.0
		 */
		nice_portfolio( array(
				'avoidcss'              => nice_portfolio_bool( $atts['avoidcss'] ),
				'orderby'               => $atts['orderby'],
				'order'                 => $atts['order'],
				'limit'                 => $atts['limit'],
				'columns'               => $atts['columns'],
				'category'              => $atts['category'],
				'exclude_category'      => $atts['exclude_category'],
				'tag'                   => $atts['tag'],
				'exclude_tag'           => $atts['exclude_tag'],
				'image_width'           => $atts['image_width'],
				'image_height'          => $atts['image_height'],
				'embed'                 => nice_portfolio_bool( $atts['embed'] ),
				'client'                => nice_portfolio_bool( $atts['client'] ),
				'url'                   => nice_portfolio_bool( $atts['url'] ),
				'start_date'            => nice_portfolio_bool( $atts['start_date'] ),
				'end_date'              => nice_portfolio_bool( $atts['end_date'] ),
				'display_empty_message' => nice_portfolio_bool( $atts['display_empty_message'] ),
				'category_filter'       => nice_portfolio_bool( $atts['category_filter'] ),
			)
		);
	?>
