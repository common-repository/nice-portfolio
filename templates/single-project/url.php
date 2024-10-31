<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the URL of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/url.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<?php if ( nice_portfolio_get_project_url() ) : ?>

		<section id="nice-portfolio-project-url">

			<p class="url">
				<a class="info button" href="<?php nice_portfolio_project_url(); ?>"><?php esc_html_e( 'Visit Project', 'nice-portfolio' ); ?></a>
			</p>

		</section>

	<?php endif; ?>
