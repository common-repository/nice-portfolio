<?php
/**
 * NiceThemes Post Type API
 *
 * @package Nice_Portfolio_Post_Type_API
 * @since   1.1
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Nice_Portfolio_Post_Type_CreateResponder
 *
 * This class takes charge of the interaction of created Nice_Portfolio_Post_Type
 * instances with WordPress APIs.
 *
 * @since 1.1
 */
class Nice_Portfolio_Post_TypeCreateResponder extends Nice_Portfolio_CreateResponder {
	/**
	 * Schedule interactions with WordPress APIs.
	 *
	 * @since 1.1
	 */
	protected function set_interactions() {
		/**
		 * Get service instance.
		 */
		$service = nice_portfolio_post_type_service();

		/**
		 * Schedule post types and taxonomies to be registered.
		 */
		add_action( 'init', array( $this, 'register' ), 0 );

		/**
		 * Schedule activation and deactivation processes.
		 */
		add_action( 'nice_portfolio_activate',   array( get_class( $service ), 'create_rewrite_rules_option' ) );
		add_action( 'nice_portfolio_deactivate', array( get_class( $service ), 'delete_rewrite_rules_option' ) );

		/**
		 * Fire default functionality.
		 */
		parent::set_interactions();
	}

	/**
	 * Delegate post type registration to service.
	 *
	 * @see   Nice_Portfolio_Post_TypeService::register()
	 *
	 * @since 1.1
	 */
	public function register() {
		if ( ! $this->data instanceof Nice_Portfolio_Post_Type ) {
			return;
		}

		$service = nice_portfolio_post_type_service();
		$service->register( $this->data );
	}
}
