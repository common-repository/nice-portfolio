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
 * Class Nice_Portfolio_Service
 *
 * This class deals with typical operations over Nice_Portfolio_EntityInterface
 * instances. It's meant to be used as a default class for domains that, while
 * needing to implement a service, don't need any specific functionality for it.
 *
 * @package Nice_Portfolio_ADR
 * @author  NiceThemes <hello@nicethemes.com>
 * @since   1.0
 */
class Nice_Portfolio_Service implements Nice_Portfolio_ServiceInterface {
	/**
	 * Entity factory instance.
	 *
	 * @var   Nice_Portfolio_FactoryInterface
	 * @since 1.0
	 */
	protected $factory;

	/**
	 * Entity instance.
	 *
	 * @var   Nice_Portfolio_EntityInterface
	 * @since 1.0
	 */
	protected $data;

	/**
	 * Set up initial state of service.
	 *
	 * @since 1.0
	 *
	 * @param Nice_Portfolio_FactoryInterface $factory
	 */
	public function __construct( Nice_Portfolio_FactoryInterface $factory ) {
		$this->factory = $factory;
	}

	/**
	 * Create and return a new Nice_Portfolio_Abstract instance.
	 *
	 * @since  1.0
	 *
	 * @param  array $data Information to create the new instance.
	 *
	 * @return Nice_Portfolio_EntityInterface
	 */
	public function create( array $data ) {
		return $this->factory->create( wp_parse_args( $data, $this::get_init_data() ) );
	}

	/**
	 * Obtain data for instance initialization.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	protected static function get_init_data() {
		return array();
	}

	/**
	 * Update the state of a given instance.
	 *
	 * @since 1.0
	 *
	 * @param Nice_Portfolio_EntityInterface $instance
	 * @param array $data
	 */
	public function update( Nice_Portfolio_EntityInterface $instance, array $data ) {
		if ( ! $instance instanceof Nice_Portfolio_Entity ) {
			return;
		}

		$instance->set_data( $data );
	}

	/**
	 * Update and return an instance.
	 *
	 * @since 1.0
	 *
	 * @param array $data
	 *
	 * @return Nice_Portfolio_EntityInterface
	 */
	public function get_updated( array $data ) {
		$this->update( ( $entity = $this->prepare( $data ) ), $data );

		return $entity;
	}

	/**
	 * Prepare instance to be displayed or updated.
	 *
	 * @since  1.0
	 *
	 * @param  array                          $data Data to prepare the instance.
	 *
	 * @return Nice_Portfolio_EntityInterface
	 */
	public function prepare( array $data ) {
		if ( isset( $data['instance'] ) && $data['instance'] instanceof Nice_Portfolio_EntityInterface ) {
			return $data['instance'];
		}

		return null;
	}
}
