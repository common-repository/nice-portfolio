<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the title of a looped project.
 *
 * Override this template by copying it to `your-theme/portfolio/loop/project/title.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<?php if ( get_the_title() ) : ?>
		<div class="nice-portfolio-project-title">
			<?php the_title( '<h3><a href="' . get_the_permalink() . '">', '</a></h3>' ); ?>
		</div>
	<?php endif; ?>
