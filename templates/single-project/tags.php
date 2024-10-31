<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the list of tags of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/tags.php`.
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
$tags = nice_portfolio_get_project_tags();

// Print only if we have tags.
if ( ! empty( $tags ) ) : ?>

	<section id="nice-portfolio-project-tags">

		<h3><?php esc_html_e( 'Tags', 'nice-portfolio' ); ?></h3>

		<ul class="clearfix">

			<?php foreach ( $tags as $tag ) : ?>

				<li><a href="<?php echo esc_url( get_term_link( $tag->term_id, nice_portfolio_tag_name() ) ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>

			<?php endforeach; ?>

		</ul>

	</section>

<?php endif; ?>
