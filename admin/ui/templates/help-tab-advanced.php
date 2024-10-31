<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Header for Advanced Settings tab.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>

<h3><?php esc_html_e( 'Advanced Settings', 'nice-portfolio' ); ?></h3>

<p><?php esc_html_e( 'This screen provides settings for advanced users, such as removing all the configurations for this plugin when you deactivate it, and changing the post type slug.', 'nice-portfolio' ); ?></p>

<p><?php printf( esc_html__( 'If you need further support, please consider checking the %sdocumentation%s or %sreporting a bug%s.', 'nice-portfolio' ), '<a href="https://nicethemes.com/documentation/portfolio/" target="_blank">', '</a>', '<a href="https://nicethemes.com/support/support-forum/" target="_blank">', '</a>' ); ?></p>
