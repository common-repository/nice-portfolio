<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the embed code of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/embed.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<?php if ( nice_portfolio_get_project_embed() ) : ?>

		<section id="nice-portfolio-project-embed">

			<?php nice_portfolio_project_embed(); ?>

		</section>

	<?php endif; ?>
