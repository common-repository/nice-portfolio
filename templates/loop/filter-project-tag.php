<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for tag filter.
 *
 * Override this template by copying it to `your-theme/portfolio/filter-tag.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Obtain list of tags.
 *
 * Each tag is treated the same way as the result of `get_term()`.
 *
 * @see get_term()
 */
$tags = nice_portfolio_get_tags();

// Print only if we have tags.
if ( ! empty( $tags ) ) : ?>

	<div class="nice-portfolio-filter">
		<ul>
			<li><a href="#" class="filter tag active" data-class=".item"><?php esc_html_e( 'All', 'nice-portfolio' ); ?></a></li>

			<?php foreach ( $tags as $tag ) : ?>

				<li><a href="#" class="filter tag" data-class=".term-<?php echo esc_attr( $tag->term_id ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>

			<?php endforeach; ?>

		</ul>
	</div>

<?php endif; ?>
