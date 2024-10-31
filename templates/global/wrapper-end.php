<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Template closing wrapper.
 *
 * Override this template by copying it to `your-theme/portfolio/global/wrapper-end.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

echo apply_filters( 'nice_portfolio_wrapper_end', '</div></div>' ); // WCS: XSS ok.
