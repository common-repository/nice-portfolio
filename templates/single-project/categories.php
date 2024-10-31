<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the list of categories of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/categories.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Obtain list of categories.
 *
 * Each category is treated the same way as the result of `get_term()`.
 *
 * @see get_term()
 */
$categories = nice_portfolio_get_project_categories();

// Print only if we have categories.
if ( ! empty( $categories ) ) : ?>

	<section id="nice-portfolio-project-categories">

		<h3><?php esc_html_e( 'Categories', 'nice-portfolio' ); ?></h3>

		<ul class="clearfix">

			<?php foreach ( $categories as $category ) : ?>

				<li><a href="<?php echo esc_url( get_term_link( $category->term_id, nice_portfolio_category_name() ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>

			<?php endforeach; ?>

		</ul>

	</section>

<?php endif; ?>
