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
 * Interface Nice_Portfolio_FactoryInterface
 *
 * @package Nice_Portfolio_ADR
 * @author  NiceThemes <hello@nicethemes.com>
 * @since   1.0
 */
interface Nice_Portfolio_FactoryInterface {
	/**
	 * Create an instance instance of a given class.
	 *
	 * @since  1.0
	 *
	 * @param  array                          $data Information for the new instance.
	 *
	 * @return Nice_Portfolio_EntityInterface
	 */
	public static function create( array $data );
}
