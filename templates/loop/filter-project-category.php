<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for category filter.
 *
 * Override this template by copying it to `your-theme/portfolio/filter-category.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Arguments to obtain categories.
$args = array();

// Use only specified categories (if we have any) when processing shortcodes.
if ( nice_portfolio_doing_shortcode() ) {
	$shortcode = nice_portfolio_current_shortcode();
	$args['include'] = $shortcode->atts['category'];
}

/**
 * Obtain list of categories.
 *
 * Each category is treated the same way as the result of `get_term()`.
 *
 * @see get_term()
 */
$categories = nice_portfolio_get_categories( $args );

// Print only if we have categories.
if ( ! empty( $categories ) ) : ?>

	<div class="nice-portfolio-filter">
		<ul>
			<li><a href="#" class="filter category active" data-class=".item"><?php esc_html_e( 'All', 'nice-portfolio' ); ?></a></li>

			<?php foreach ( $categories as $category ) : ?>

				<li><a href="#" class="filter category" data-class=".term-<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></a></li>

			<?php endforeach; ?>

		</ul>
	</div>

<?php endif; ?>
