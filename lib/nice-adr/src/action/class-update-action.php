<?php
/**
 * NiceThemes ADR
 *
 * @package Nice_Portfolio_ADR
 * @since   1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Nice_Portfolio_UpdateAction
 *
 * This class takes charge of the update process of
 * Nice_Portfolio_EntityInterface instances, and the preparation of the related
 * responder. It's meant to be used as a default class for domains that, while
 * needing to implement an Update action, don't need any specific functionality
 * for it.
 *
 * @since 1.0
 */
class Nice_Portfolio_UpdateAction extends Nice_Portfolio_UpdateActionAbstract {}
