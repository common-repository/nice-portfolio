<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for portfolio tag archive.
 *
 * Override this template by copying it to `your-theme/portfolio/portfolio-tag.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header( 'nice-portfolio' ); ?>

	<?php
		/**
		 * @hook nice_portfolio_before_main_content
		 *
		 * All actions that print HTML before the current page contents are
		 * displayed should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_wrapper_start() - 10 (prints the opening content wrapper)
		 */
		do_action( 'nice_portfolio_before_main_content' );
	?>

	<div class="hentry">

		<?php
			/**
			 * @hook nice_portfolio_header
			 *
			 * All actions that add HTML to the title of the current page should be
			 * hooked here.
			 *
			 * @since 1.0
			 *
			 * Hooked here:
			 * @see nice_portfolio_title() - 10 (prints out the title of the current page)
			 */
			do_action( 'nice_portfolio_header' );
		?>

		<div class="entry-content">
			<?php
				/**
				 * @hook nice_portfolio
				 *
				 * All actions that output HTML for the main content of the
				 * portfolio category page should be hooked here, preferably
				 * through the`nice_portfolio_tag_page` hook instead of the
				 * global context.
				 *
				 * Hooked here:
				 * @see nice_portfolio_tag() - 10 (prints all published projects with the current tag)
				 *
				 * Hooked in:
				 * @see nice_portfolio_setup_tag_page()
				 *
				 * @since  1.0
				 */
				do_action( 'nice_portfolio' );
			?>
		</div>

	</div>

	<?php
		/**
		 * @hook nice_portfolio_after_main_content
		 *
		 * All actions that print HTML after the current page contents are
		 * displayed should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_loop_projects_page_navigation() - 0 (prints previous/next page navigation)
		 * @see nice_portfolio_wrapper_end() - 10 (prints the closing content wrapper)
		 */
		do_action( 'nice_portfolio_after_main_content' );
	?>

	<?php
		/**
		 * @hook nice_portfolio_sidebar
		 *
		 * All actions that call a sidebar for the current page should be
		 * hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_sidebar() - 10
		 */
		do_action( 'nice_portfolio_sidebar' );
	?>

<?php get_footer( 'nice-portfolio' ); ?>
