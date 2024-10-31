<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Closing wrapper for widgets.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/wrapper-end.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

echo apply_filters( 'nice_portfolio_widget_wrapper_end', '</div></aside>' ); // WPCS: XSS ok.
