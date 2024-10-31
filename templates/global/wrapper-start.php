<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template starting wrapper.
 *
 * Override this template by copying it to `your-theme/portfolio/global/wrapper-start.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

echo apply_filters( 'nice_portfolio_wrapper_start', '<div id="container"><div id="content" class="nice-portfolio-content" role="main">' ); // WPCS: XSS ok.
