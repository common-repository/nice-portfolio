<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * General Settings tab content.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>

<h3><?php esc_html_e( 'General Settings', 'nice-portfolio' ); ?></h3>

<p><?php esc_html_e( 'Configure how your projects will be displayed by default. The options presented here can be overridden in a shortcode basis. You can pick the portfolio page, set the number of projects to display by default, etc.', 'nice-portfolio' ); ?></p>

<p><?php printf( esc_html__( 'This screen provides the most basic settings for configuring the plugin. If you need further support, please consider checking the %sdocumentation%s or %sreporting a bug%s.', 'nice-portfolio' ), '<a href="https://nicethemes.com/documentation/portfolio/" target="_blank">', '</a>', '<a href="https://nicethemes.com/support/support-forum/" target="_blank">', '</a>' ); ?></p>
