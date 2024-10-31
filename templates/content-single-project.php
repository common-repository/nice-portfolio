<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Content for single portfolio project.
 *
 * Override this template by copying it to `your-theme/portfolio/content-single-project.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<?php
	/**
	 * @hook nice_portfolio_before_single_project
	 *
	 * All actions that print HTML before the single project is displayed
	 * should be hooked here.
	 *
	 * @since 1.0
	 */
	do_action( 'nice_portfolio_before_single_project' );
?>

<div id="nice-portfolio-project-<?php the_ID(); ?>" <?php nice_portfolio_project_class(); ?>>

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

	<?php
		/**
		 * @hook nice_portfolio_before_single_project_content
		 *
		 * All actions that print HTML before the contents of the single project
		 * should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_before_single_project_content' );
	?>

	<div class="entry-content">
		<?php
			if ( post_password_required() ) :
				echo get_the_password_form(); // WPCS: XSS ok.
			else :
				/**
				 * @hook  nice_portfolio_single_project_content
				 *
				 * All actions that print HTML for the main contents of the
				 * single project should be hooked here.
				 *
				 * @since 1.0
				 *
				 * Hooked here:
				 * @see nice_portfolio_single_project_thumbnail()   - 10 (prints thumbnail of the current project)
				 * @see nice_portfolio_single_project_embed()       - 20 (prints embed code of the current project)
				 * @see nice_portfolio_single_project_description() - 30 (prints description of the current project)
				 * @see nice_portfolio_single_project_gallery()     - 40 (prints gallery of the current project)
				 * @see nice_portfolio_single_project_meta()        - 50 (prints attributes of the current project)
				 * @see nice_portfolio_single_project_categories()  - 60 (prints categories of the current project)
				 * @see nice_portfolio_single_project_tags()        - 70 (prints tags of the current project)
				 * @see nice_portfolio_single_project_related()     - 80 (prints projects related to the current project)
				 */
				do_action( 'nice_portfolio_single_project_content' );
			endif;
		?>
	</div><!-- .entry-content -->

	<?php
		/**
		 * @hook nice_portfolio_after_single_project_content
		 *
		 * All actions that print HTML after the contents of the single project
		 * should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_after_single_project_content' );
	?>

</div><!-- #nice-portfolio-project-<?php the_ID(); ?> -->

<?php
	/**
	 * @hook nice_portfolio_after_single_project
	 *
	 * All actions that print HTML after the single project was displayed
	 * should be hooked here.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see nice_portfolio_single_project_navigation() - 10 (prints previous/next project navigation)
	 */
	do_action( 'nice_portfolio_after_single_project' );
?>
