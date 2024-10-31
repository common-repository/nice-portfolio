<?php
/**
 * NiceThemes Admin UI
 *
 * @package Nice_Portfolio_Admin_UI
 * @since   1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Nice_Portfolio_AdminUIRegisterAction
 *
 * This class takes charge of the update processes fired against the WordPress API.
 *
 * @since   1.0
 */
class Nice_Portfolio_Admin_UIRegisterAction extends Nice_Portfolio_ActionAbstract {
	/**
	 * Prepare a Nice_Portfolio_Admin_UI instance to be registered.
	 *
	 * @since  1.0
	 *
	 * @param  array                          $data Data to register the instance.
	 *
	 * @return Nice_Portfolio_Admin_UI
	 */
	public function __invoke( array $data ) {
		if ( ! $this->domain instanceof Nice_Portfolio_Admin_UIService ) {
			return;
		}

		$instance = $this->domain->get_registered( $data );
		$this->responder->__invoke( $instance );
	}
}
