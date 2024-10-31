<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for Portfolio Categories widget.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/portfolio-categories.php`.
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

// Only process contents if we have categories.
if ( ! empty( $widget->categories ) ) : ?>

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

	<?php
		/**
		 * @hook nice_portfolio_before_widget_categories_loop
		 *
		 * All actions that print HTML before the loop of categories run
		 * should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_before_widget_categories_loop', $widget );
	?>

	<?php
		/**
		 * @hook nice_portfolio_widget_categories_content
		 *
		 * All actions that print HTML for the content of the current
		 * widget should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see Nice_Portfolio_Categories_Widget::dropdown() - 10 (prints a dropdown with all available categories)
		 * @see Nice_Portfolio_Categories_Widget::list_categories() - 10 (prints an HTML list with available categories)
		 * @see Nice_Portfolio_Categories_Widget::enqueue_scripts() - 20 (loads scripts for the current widget)
		 */
		do_action( 'nice_portfolio_widget_categories_content', $widget );
	?>

	<?php
		/**
		 * @hook nice_portfolio_after_widget_categories_loop
		 *
		 * All actions that print HTML after the loop of categories run
		 * should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_after_widget_categories_loop', $widget );
	?>

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
