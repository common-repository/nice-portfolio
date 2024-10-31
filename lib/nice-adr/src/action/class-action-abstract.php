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
 * Class Nice_Portfolio_ActionAbstract
 *
 * This class takes charge of the plugin activation process and the preparation
 * of the related responder.
 *
 * @package Nice_Portfolio_ADR
 * @author  NiceThemes <hello@nicethemes.com>
 * @since   1.0
 */
abstract class Nice_Portfolio_ActionAbstract implements Nice_Portfolio_ActionInterface {
	/**
	 * @var   Nice_Portfolio_ServiceInterface
	 * @since 1.0
	 */
	protected $domain;

	/**
	 * @var   Nice_Portfolio_ResponderInterface
	 * @since 1.0
	 */
	protected $responder;

	/**
	 * Set up initial state of action.
	 *
	 * @since 1.0
	 *
	 * @param Nice_Portfolio_ServiceInterface   $domain
	 * @param Nice_Portfolio_ResponderInterface $responder
	 */
	public function __construct(
		Nice_Portfolio_ServiceInterface $domain,
		Nice_Portfolio_ResponderInterface $responder
	) {
		$this->domain    = $domain;
		$this->responder = $responder;
	}

	/**
	 * Create new Nice_Portfolio_EntityInterface instance and fire responder.
	 *
	 * @since  1.0
	 *
	 * @param  array                          $data Data to create the new instance.
	 *
	 * @return Nice_Portfolio_EntityInterface
	 */
	public function __invoke( array $data ) {}

	/**
	 * Prepare instance to be displayed or updated.
	 *
	 * @since  1.0
	 *
	 * @param  array $data Data to prepare the instance.
	 */
	public function prepare( array $data ) {}
}
