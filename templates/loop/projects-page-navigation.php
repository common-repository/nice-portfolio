<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for page navigation.
 *
 * Override this template by copying it to `your-theme/portfolio/loop/projects-page-navigation.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<nav id="<?php nice_portfolio_page_navigation_id(); ?>" class="nice-portfolio-projects-navigation">

		<h3 class="assistive-text"><?php esc_html_e( 'Projects navigation', 'nice-portfolio' ); ?></h3>

		<?php echo paginate_links(); // WPCS: XSS ok. ?>

	</nav>
