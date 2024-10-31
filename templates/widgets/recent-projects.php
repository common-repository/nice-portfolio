<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for Recent Projects widget.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/recent-projects.php`.
 *
 * @see     Nice_Portfolio_Recent_Projects_Widget
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
 * @var Nice_Portfolio_Recent_Projects_Widget $widget
 */
$widget = nice_portfolio_current_widget();

// Print only if the query has posts.
if ( $widget->portfolio->have_posts() ) : ?>

<?php
	/**
	 * @hook nice_portfolio_before_widget_content
	 *
	 * All hooks that print contents before the widget contents are displayed
	 * should be hooked here.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see nice_portfolio_widget_wrapper_start()    - 10 (prints the opening HTML for the widget)
	 * @see Nice_Portfolio_WP_Widget::widget_title() - 20 (prints the title of the widget)
	 */
	do_action( 'nice_portfolio_before_widget_content', $widget );
?>

	<ul class="widget_recent_entries">

		<?php
			/**
			 * @hook nice_portfolio_before_widget_recent_project_loop
			 *
			 * All actions that print HTML before the loop of projects run
			 * should be hooked here.
			 *
			 * @since 1.0
			 */
			do_action( 'nice_portfolio_before_widget_recent_project_loop', $widget );
		?>

		<?php while ( $widget->portfolio->have_posts() ) : $widget->portfolio->the_post(); ?>

			<?php nice_portfolio_get_template( 'widgets/recent-projects/content-project.php' ); ?>

		<?php endwhile; ?>

		<?php
			/**
			 * @hook nice_portfolio_after_widget_recent_project_loop
			 *
			 * All actions that print HTML after the loop of projects run
			 * should be hooked here.
			 *
			 * @since 1.0
			 */
			do_action( 'nice_portfolio_after_widget_recent_project_loop', $widget );
		?>

	</ul>

<?php
	/**
	 * @hook nice_portfolio_after_widget_content
	 *
	 * All hooks that print contents before the widget contents are displayed
	 * should be hooked here.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see nice_portfolio_widget_wrapper_end() - 10 (prints the closing HTML for the widget)
	 */
	do_action( 'nice_portfolio_after_widget_content', $widget );

endif;
