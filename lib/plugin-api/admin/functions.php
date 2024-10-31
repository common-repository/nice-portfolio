<?php
/**
 * NiceThemes Plugin API
 *
 * This file contains general helper functions that allow interactions with
 * this module in an easier way.
 *
 * @package Nice_Portfolio_Plugin_API
 * @license GPL-2.0+
 * @since   1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Obtain current admin-facing instance of plugin.
 *
 * @uses   nice_portfolio_create()
 *
 * @since  1.0
 *
 * @return Nice_Portfolio_Admin
 */
function nice_portfolio_plugin_admin() {
	static $admin = null;

	// Return early if we're out of admin context.
	if ( ! is_admin() ) {
		return null;
	}

	// Return early if the admin instance has already been set.
	if ( ! is_null( $admin ) ) {
		return $admin;
	}

	/**
	 * Allow external data for admin initialization.
	 */
	$data = apply_filters( 'nice_portfolio_plugin_admin_data', array() );

	/**
	 * Initialize admin side of plugin.
	 */
	return $admin = nice_portfolio_create( 'Nice_Portfolio_Admin', $data );
}

/**
 * Initialize admin-facing side of plugin.
 *
 * @uses  nice_portfolio_plugin_admin()
 * @uses  nice_portfolio_display()
 *
 * @since 1.0
 */
function nice_portfolio_plugin_admin_init() {
	// Return early if we're out of admin context.
	if ( ! is_admin() ) {
		return;
	}

	// Return early if we don't want to initialize the admin.
	if ( ! apply_filters( 'nice_portfolio_plugin_admin_init', true ) ) {
		return;
	}

	// Initialize a counter to check if this function is being called more than once.
	static $i = 0;

	/**
	 * Trigger error if this function is being called recursively.
	 */
	if ( $i ) {
		_nice_portfolio_doing_it_wrong( __FUNCTION__, esc_html__( 'This function should not be called more than once. Please hook your actions to nice_portfolio_plugin_admin_after_init in order to prevent recursion.', 'nice-portfolio' ) );
	}

	// Update counter.
	$i++;

	/**
	 * @hook nice_portfolio_plugin_admin_before_init
	 *
	 * Process actions before the main admin object gets initialized.
	 *
	 * Functions and methods that use internal functionality of the
	 * Nice_Portfolio_Admin domain should not be hooked here in order to
	 * prevent recursion.
	 *
	 * @since 1.0
	 */
	do_action( 'nice_portfolio_plugin_admin_before_init' );

	/**
	 * Initialize admin instance.
	 */
	$admin = nice_portfolio_plugin_admin();

	/**
	 * @hook nice_portfolio_plugin_admin_after_init
	 *
	 * Process actions after the main admin object gets initialized.
	 *
	 * Functions and methods that use internal functionality of the
	 * Nice_Portfolio_Admin domain are safe from recursion and can be hooked
	 * from this point on.
	 *
	 * @since 1.0
	 *
	 * Hooked here:
	 * @see Nice_Portfolio_AdminService::set_templates_path()     - 10 (sets the path for the admin templates folder)
	 * @see Nice_Portfolio_AdminService::set_post_types()         - 20 (sets the admin-side part of the plugin's post types)
	 * @see Nice_Portfolio_AdminService::set_admin_ui()           - 30 (sets the Admin UI for the plugin)
	 * @see Nice_Portfolio_AdminService::set_pointer_collection() - 40 (sets help pointers for the admin)
	 * @see nice_portfolio_display()                              - 50 (processes the views for the admin-facing side of the plugin)
	 */
	do_action( 'nice_portfolio_plugin_admin_after_init', $admin );
}

/**
 * Obtain an instance of this domain's service.
 *
 * @uses   nice_portfolio_service()
 *
 * @since  1.0
 *
 * @return Nice_Portfolio_AdminService
 */
function nice_portfolio_admin_service() {
	return nice_portfolio_service( 'Nice_Portfolio_Admin' );
}

/**
 * Get the value for a property of the current plugin instance.
 *
 * @uses   nice_portfolio_plugin_admin()
 *
 * @since  1.0
 *
 * @param  string $property Name of the property to get value from.
 *
 * @return mixed
 */
function nice_portfolio_plugin_admin_property( $property ) {
	$admin = nice_portfolio_plugin_admin();

	if ( $property && property_exists( $admin, $property ) ) {
		return $admin->{$property};
	}

	return null;
}

/**
 * Return the Admin UI object for the admin instance.
 *
 * @uses   nice_portfolio_plugin_admin_property()
 *
 * @since  1.0
 *
 * @return Nice_Portfolio_Admin_UI
 */
function nice_portfolio_plugin_admin_ui() {
	return apply_filters( 'nice_portfolio_plugin_admin_ui', nice_portfolio_plugin_admin_property( 'ui' ) );
}

/**
 * Return the Admin UI object for the admin instance.
 *
 * @uses   nice_portfolio_plugin_admin_property()
 *
 * @since  1.0
 *
 * @return Nice_Portfolio_Pointer_Collection
 */
function nice_portfolio_plugin_admin_pointer_collection() {
	return apply_filters( 'nice_portfolio_plugin_admin_pointer_collection', nice_portfolio_plugin_admin_property( 'pointer_collection' ) );
}

/**
 * Check if we're running a registered widget.
 *
 * @since  1.0
 *
 * @return bool
 */
function nice_portfolio_admin_doing_widget() {
	$current_widget = nice_portfolio_admin_current_widget();
	return ( ! empty( $current_widget ) );
}

/**
 * Obtain the name of the current widget, if registered.
 *
 * @since  1.0
 *
 * @return Nice_Portfolio_WP_Widget|null
 */
function nice_portfolio_admin_current_widget() {
	return nice_portfolio_plugin_admin_property( 'current_widget' );
}

/**
 * Register the name of the current widget.
 *
 * This function is meant to be applied as soon as possible inside the function
 * or method that processes the widget.
 *
 * @since 1.0
 *
 * @param string $name
 */
function nice_portfolio_admin_set_current_widget( $name ) {
	nice_portfolio_update( nice_portfolio_plugin_admin(), array( 'current_widget' => $name ) );
}

/**
 * Unset the current widget.
 *
 * This function is meant to be applied inside the function or method that
 * processes the widget, at some point after using
 * `nice_portfolio_admin_set_current_widget()` and before returning its output.
 *
 * @see   nice_portfolio_admin_set_current_widget()
 *
 * @since 1.0
 */
function nice_portfolio_admin_unset_current_widget() {
	nice_portfolio_update( nice_portfolio_plugin_admin(), array( 'current_widget' => null ) );
}
