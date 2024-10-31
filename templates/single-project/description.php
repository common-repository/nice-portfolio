<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the description of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/description.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<?php if ( get_the_content() ) : ?>

		<section id="nice-portfolio-project-description">

			<?php the_content(); ?>

		</section>

	<?php endif; ?>
