<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the title of a portfolio page.
 *
 * Override this template by copying it to `your-theme/portfolio/global/title.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<header class="entry-header">
		<?php nice_portfolio_the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
