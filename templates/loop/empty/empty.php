<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template for the empty (no content) message of the list of projects.
 *
 * Override this template by copying it to `your-theme/portfolio/loop/empty/empty.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?>
	<div class="entry-content no-results not-found">
		<p><?php esc_html_e( 'Sorry, it seems there is nothing to see here.', 'nice-portfolio' ); ?></p>
	</div><!-- .entry-content.no-results.not-found -->
