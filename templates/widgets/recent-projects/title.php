<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for project excerpt in Recent Projects widget.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/recent-projects/excerpt.php`.
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
?>
	<?php if ( get_the_title() ) : ?>

		<a href="<?php the_permalink(); ?>" class="project-title"><?php the_title(); ?></a>

	<?php endif; ?>
