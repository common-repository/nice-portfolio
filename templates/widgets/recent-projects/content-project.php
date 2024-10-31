<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for project inside Recent Projects widget loop.
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
?>

<?php
	/**
	 * @hook nice_portfolio_before_widget_recent_project_content
	 *
	 * All actions that print HTML before the contents of the current project
	 * should be hooked here.
	 *
	 * @since 1.0
	 */
	do_action( 'nice_portfolio_before_widget_recent_project_content' );
?>

<li class="recent-widget">
	<?php
		/**
		 * @hook nice_portfolio_widget_recent_project_content
		 *
		 * All actions that print HTML for the contents of the current project
		 * should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see Nice_Portfolio_Recent_Projects_Widget::project_wrapper_start() - 10 (prints the opening tag for the project's wrapper)
		 * @see Nice_Portfolio_Recent_Projects_Widget::project_thumbnail() - 20 (prints the thumbnail of the current project)
		 * @see Nice_Portfolio_Recent_Projects_Widget::project_title() - 30 (prints the title of the current project)
		 * @see Nice_Portfolio_Recent_Projects_Widget::project_excerpt() - 40 (prints the excerpt of the current project)
		 * @see Nice_Portfolio_Recent_Projects_Widget::project_wrapper_end() - 50 (prints the closing tag for the project's wrapper)
		 */
		do_action( 'nice_portfolio_widget_recent_project_content', $widget );
	?>
</li>

<?php
	/**
	 * @hook nice_portfolio_after_widget_recent_project_content
	 *
	 * All actions that print HTML after the contents of the current project
	 * should be hooked here.
	 *
	 * @since 1.0
	 */
	do_action( 'nice_portfolio_after_widget_recent_project_content' );
?>
