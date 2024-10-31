<?php
/**
 * NiceThemes ADR
 *
 * @package Nice_Portfolio_ADR
 * @license GPL-2.0+
 * @since   1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Nice_Portfolio_DisplayActionAbstract
 *
 * This class takes charge of the plugin activation process and the preparation
 * of the related responder.
 *
 * @package Nice_Portfolio_ADR
 * @author  NiceThemes <hello@nicethemes.com>
 * @since   1.0
 */
abstract class Nice_Portfolio_DisplayActionAbstract extends Nice_Portfolio_ActionAbstract {
	/**
	 * Create new Nice_Portfolio_EntityInterface instance and fire responder.
	 *
	 * @since  1.0
	 *
	 * @param  array                          $data Data to create the new instance.
	 *
	 * @return Nice_Portfolio_EntityInterface
	 */
	public function __invoke( array $data ) {
		$instance = $this->domain->prepare( $data );
		$this->responder->__invoke( $instance );
	}
}
