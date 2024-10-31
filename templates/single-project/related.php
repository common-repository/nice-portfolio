<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the related projects of a single project.
 *
 * Override this template by copying it to `your-theme/portfolio/single-project/related.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Obtain related projects as a WP_Query instance.
 *
 * @see WP_Query
 *
 * @var WP_Query $related_projects
 */
$related_projects = nice_portfolio_get_related_projects();

if ( $related_projects->have_posts() ) : ?>

	<section id="nice-portfolio-project-related">

		<h3><?php esc_html_e( 'Related Projects', 'nice-portfolio' ) ?></h3>

		<ul class="clearfix">

			<?php while ( $related_projects->have_posts() ) : $related_projects->the_post(); ?>

				<li>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</a>
				</li>

			<?php endwhile; ?>

		</ul>

	</section>
<?php endif;

/**
 * Important: post data needs to be reset at the end of this template to make
 * the information of the single project accessible again.
 */
wp_reset_postdata();
