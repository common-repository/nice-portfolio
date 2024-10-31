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
 * Interface Nice_Portfolio_EntityInterface
 *
 * @package Nice_Portfolio_ADR
 * @author  NiceThemes <hello@nicethemes.com>
 * @since   1.0
 */
interface Nice_Portfolio_EntityInterface {
	/**
	 * Obtain the current value of a property.
	 *
	 * @since 1.0
	 *
	 * @param string $property Name of a property of this class.
	 */
	function __get( $property );

	/**
	 * Obtain current state of this instance.
	 *
	 * @since 1.0
	 *
	 * @param bool $array
	 */
	function get_info( $array );
}
