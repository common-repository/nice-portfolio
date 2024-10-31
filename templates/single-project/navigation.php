<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for projects navigation.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/navigation.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$next     = get_next_post_link( '%link' );
$previous = get_previous_post_link( '%link' );
?>
	<?php if ( $next or $previous ) : ?>

		<section id="nice-portfolio-project-navigation" class="project-navigation">

			<?php if ( $next ) : ?>
				<span class="project-navigation next-project-link"><?php echo $next; // WPCS: XSS ok. ?></span>
			<?php endif; ?>

			<?php if ( $previous ) : ?>
				<span class="project-navigation previous-project-link"><?php echo $previous; // WPCS: XSS ok. ?></span>
			<?php endif; ?>

		</section>

	<?php endif; ?>
