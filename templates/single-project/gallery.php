<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the image gallery of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/gallery.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<?php if ( nice_portfolio_get_project_gallery() ) : ?>

		<section id="nice-portfolio-project-gallery">

			<h3><?php esc_html_e( 'Project Gallery', 'nice-portfolio' ); ?></h3>

			<div class="gallery-container">

				<?php nice_portfolio_project_gallery(); ?>

			</div>

		</section>

	<?php endif; ?>
