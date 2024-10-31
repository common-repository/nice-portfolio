<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Opening wrapper for looped project.
 *
 * Override this template by copying it to `your-theme/portfolio/loop/project/wrapper-start.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<div id="nice-portfolio-project-<?php the_ID(); ?>" <?php nice_portfolio_project_class(); ?>>
