<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the attributes of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/meta.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<section id="nice-portfolio-project-data">
		<?php
			/**
			 * @hook nice_portfolio_single_project_meta
			 *
			 * Hook here to add or remove meta data for a single project.
			 *
			 * In case you need to display more data, you may want to check
			 * `nice_portfolio_single_project_meta()` and hook into the
			 * `nice_portfolio_single_project_meta_load_template` filter.
			 *
			 * @see nice_portfolio_single_project_meta()
			 *
			 * Hooked here:
			 * @see nice_portfolio_single_project_details() - 10 (prints contents of templates/single-project/details.php)
			 * @see nice_portfolio_single_project_url()     - 20 (prints contents of templates/single-project/url.php)
			 */
			do_action( 'nice_portfolio_single_project_meta' );
		?>
	</section>
