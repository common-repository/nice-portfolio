<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Manage functionality for localization features.
 *
 * @package   Nice_Portfolio
 * @author    NiceThemes <hello@nicethemes.com>
 * @license   GPL-2.0+
 * @link      https://nicethemes.com/product/nice-portfolio
 * @copyright 2016 NiceThemes
 * @since     1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The following strings define translatable data that's not tied to any
 * particular output.
 *
 * @since 1.0
 */
$nice_portfolio_i18n_plugin_data = array(
	'plugin_name'        => esc_html__( 'Nice Portfolio' ),
	'plugin_name_author' => esc_html__( 'Nice Portfolio By NiceThemes' ),
	'plugin_description' => esc_html__( 'A great portfolio plugin to show your work to the world in a clean, responsive and beautiful way. You can show your projects in a specific page, using a shortcode, widgets or template tags.' ),
);

add_filter( 'nice_portfolio_plugin_i18n_data', 'nice_portfolio_plugin_i18n_domain_path' );
/**
 * Set the right location of language files.
 *
 * @since  1.0
 *
 * @param  array $data
 *
 * @return array
 */
function nice_portfolio_plugin_i18n_domain_path( array $data = array() ) {
	return array_merge( $data, array(
			'path' => nice_portfolio_plugin_domain() . 'languages',
		)
	);
}
