<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * About Page Header for Admin UI.
 *
 * @package Nice_Portfolio_Admin_UI
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<div class="heading">
		<div class="masthead about">
			<h1><?php printf( esc_html__( 'Nice Portfolio %s', 'nice-portfolio' ), esc_html( nice_portfolio_plugin_version() ) ); ?></h1>
			<h2><?php esc_html_e( 'The most powerful portfolio plugin you\'ve ever seen', 'nice-portfolio' ); ?></h2>
		</div>
	</div>
