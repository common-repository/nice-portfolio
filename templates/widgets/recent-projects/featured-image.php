<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for project thumbnail in Recent Projects widget.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/recent-projects/featured-image.php`.
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
	<?php if ( nice_portfolio_get_project_thumbnail() ) : ?>

		<?php
			/**
			 * Print out the project's thumbnail.
			 *
			 * The values that you entered the "Thumbnail Size" option of the
			 * widget will be used for the width and the height of the image.
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

	<?php endif; ?>
