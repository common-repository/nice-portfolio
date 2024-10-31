<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for details of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/details.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<section id="nice-portfolio-project-details">

		<h3><?php esc_html_e( 'Project Details', 'nice-portfolio' ); ?></h3>

		<ul class="clearfix">

			<?php if ( nice_portfolio_get_project_client() ) : ?>
				<li class="client"><strong><?php esc_html_e( 'Client:', 'nice-portfolio' ); ?></strong> <?php nice_portfolio_project_client(); ?></li>
			<?php endif; ?>

			<?php if ( nice_portfolio_get_project_start_date() ) : ?>
				<li class="start"><strong><?php esc_html_e( 'Start Date:', 'nice-portfolio' ); ?></strong> <?php nice_portfolio_project_start_date(); ?></li>
			<?php endif; ?>

			<?php if ( nice_portfolio_get_project_end_date() ) : ?>
				<li class="end"><strong><?php esc_html_e( 'End Date:', 'nice-portfolio' ); ?></strong> <?php nice_portfolio_project_end_date(); ?></li>
			<?php endif; ?>

		</ul>

	</section>
