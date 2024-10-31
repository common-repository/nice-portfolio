<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Opening wrapper for widgets.
 *
 * Override this template by copying it to `your-theme/portfolio/widgets/wrapper-start.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

echo apply_filters( 'nice_portfolio_widget_wrapper_start', '<aside class="widget"><div ' . nice_portfolio_widget_class( array(), false ) . '>' ); // WPCS: XSS ok.
