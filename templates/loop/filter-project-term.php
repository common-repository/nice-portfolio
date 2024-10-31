<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for term filter.
 *
 * Override this template by copying it to `your-theme/portfolio/filter-term.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Obtain list of terms.
 *
 * Each term is treated the same way as the result of `get_term()`.
 *
 * @see get_term()
 */
$terms = nice_portfolio_get_terms();

// Print only if we have terms.
if ( ! empty( $terms ) ) : ?>

	<div class="nice-portfolio-filter">
		<ul>
			<li><a href="#" class="filter term active" data-class=".item"><?php esc_html_e( 'All', 'nice-portfolio' ); ?></a></li>

			<?php foreach ( $terms as $term ) : ?>

				<li><a href="#" class="filter term" data-class=".term-<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></a></li>

			<?php endforeach; ?>

		</ul>
	</div>

<?php endif; ?>
