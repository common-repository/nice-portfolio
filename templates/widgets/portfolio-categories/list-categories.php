<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for list of categories in Categories widget.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/portfolio-categories/list-categories.php`.
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
	<?php if ( ! empty( $widget->categories ) && empty( $widget->args['dropdown'] ) ) : ?>

		<ul class="widget-categories">

			<?php
				/**
				 * Display a list of categories with their respective permalinks.
				 *
				 * If you want to use a different criteria for the list, you
				 * can override this template and modify the arguments that are
				 * passed to `wp_list_categories()`.
				 *
				 * @uses wp_list_categories()
				 * @link https://codex.wordpress.org/Function_Reference/wp_list_categories
				 */
				wp_list_categories( array(
						'taxonomy'     => nice_portfolio_category_name(),
						'title_li'     => '',
						'hierarchical' => $widget->args['hierarchical'], // Obtained from widget settings.
						'show_count'   => $widget->args['count'], // Obtained from widget settings.
					)
				);
			?>

		</ul>

	<?php endif; ?>
