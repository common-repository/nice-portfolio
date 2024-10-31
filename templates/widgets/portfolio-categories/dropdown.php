<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for category dropdown in Categories widget.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/portfolio-categories/dropdown.php`.
 *
 * @see     Nice_Portfolio_Categories_Widget
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
$widget = nice_portfolio_current_widget();
?>
	<?php if ( ! empty( $widget->categories ) && ! empty( $widget->args['dropdown'] ) ) : ?>

		<?php
			/**
			 * Display a dropdown list of selectable categories.
			 *
			 * If you want to use a different criteria for the dropdown, you
			 * can override this template and modify the arguments that are
			 * passed to `wp_dropdown_categories()`.
			 *
			 * @uses wp_dropdown_categories()
			 * @link https://codex.wordpress.org/Function_Reference/wp_dropdown_categories
			 */
			wp_dropdown_categories( array(
					'taxonomy'         => nice_portfolio_category_name(),
					'hierarchical'     => $widget->args['hierarchical'], // Obtained from widget settings.
					'show_count'       => $widget->args['count'], // Obtained from widget settings.
					'pad_counts'       => false,
					'orderby'          => 'name',
					'order'            => 'ASC',
					'name'             => 'portfolio-categories',
					'class'            => 'portfolio-widget-categories-select postform',
					'show_option_none' => esc_html__( 'Select Category', 'nice-portfolio' ),
					'walker'           => new Nice_Portfolio_Walker_CategoryDropdown(),
				)
			);
		?>

	<?php endif; ?>
