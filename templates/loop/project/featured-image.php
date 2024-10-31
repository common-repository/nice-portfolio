<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the thumbnail of a looped project.
 *
 * Override this template by copying it to `your-theme/portfolio/loop/project/featured-image.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<?php if ( has_post_thumbnail() ) : ?>

		<figure class="nice-portfolio-project-featured-image featured-image">
			<a href="<?php the_permalink(); ?>">
				<?php
					/**
					 * Print out the project's thumbnail.
					 *
					 * The values that you entered in Portfolio > Settings > Images
					 * will be used for the width and the height of the image.
					 *
					 * If you want to use different dimensions for your image,
					 * just override this template and call
					 * `nice_portfolio_project_thumbnail()` this way:
					 *
					 * <?php
					 *      nice_portfolio_project_thumbnail( get_the_ID(), array(
									300, // Or your custom width in pixels.
									300, // Or your custom height in pixels.
					 *          )
					 *      );
					 * ?>
					 */
					nice_portfolio_project_thumbnail();
				?>
			</a>
		</figure>

	<?php endif; ?>
