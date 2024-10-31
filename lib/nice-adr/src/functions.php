<?php
/**
 * NiceThemes ADR
 *
 * This file contains general helper functions that allow deeper-level
 * interactions with the Plugin API in an easier way.
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
 * Make a request for an action and obtain a response.
 *
 * @uses   nice_portfolio_action()
 * @uses   Nice_Portfolio_ActionInterface::__invoke()
 *
 * @since  1.0
 *
 * @param  string $domain Name of the class to get a new instance from.
 * @param  string $action Name of the action to execute.
 * @param  array  $data   Information for requested instance properties.
 *
 * @return Nice_Portfolio_EntityInterface
 */
function nice_portfolio_request( $domain, $action, array $data = array() ) {
	if ( ! class_exists( $domain ) ) {
		return null;
	}

	/**
	 * Initialize action instance.
	 */
	$action = nice_portfolio_action( $domain, $action );

	/**
	 * Set domain as part of data.
	 */
	$data['classname'] = $domain;

	if ( method_exists( $action, '__invoke' ) ) {
		return $action->__invoke( $data );
	}

	return null;
}

/**
 * Obtain a requested instance factory.
 *
 * @uses   nice_portfolio_get_instance_maybe()
 *
 * @since  1.0
 *
 * @param  string                      $domain Name of the class to get a new factory instance from.
 *
 * @return Nice_Portfolio_FactoryInterface
 */
function nice_portfolio_factory( $domain ) {
	$classname = nice_portfolio_factory_classname( $domain );

	return nice_portfolio_get_instance_maybe( $classname );
}

/**
 * Obtain the name of a factory class.
 *
 * @since  1.0
 *
 * @param  string $domain Name of the domain of the factory.
 *
 * @return string
 */
function nice_portfolio_factory_classname( $domain ) {
	// List possible classes.
	$classnames = array(
		$domain . 'Factory'      => true,
		'Nice_Portfolio_Factory' => true,
	);

	foreach ( $classnames as $classname => $validate ) {
		if ( class_exists( $classname ) && $validate ) {
			return $classname;
		}
	}

	return null;
}

/**
 * Obtain a requested service.
 *
 * @uses   nice_portfolio_get_instance_maybe()
 * @uses   nice_portfolio_factory()
 *
 * @since  1.0
 *
 * @param  string                          $domain Name of the class to get a new service instance from.
 *
 * @return Nice_Portfolio_ServiceInterface
 */
function nice_portfolio_service( $domain ) {
	$classname = nice_portfolio_service_classname( $domain );

	return nice_portfolio_get_instance_maybe( $classname, array(
			'factory' => nice_portfolio_factory( $domain ),
		)
	);
}

/**
 * Obtain the name of a service class.
 *
 * @since  1.0
 *
 * @param  string $domain Name of the domain of the action.
 *
 * @return string
 */
function nice_portfolio_service_classname( $domain ) {
	// List possible classes.
	$classnames = array(
		$domain . 'Service',
		'Nice_Portfolio_Service',
	);

	foreach ( $classnames as $classname ) {
		if ( class_exists( $classname ) ) {
			return $classname;
		}
	}

	return null;
}

/**
 * Obtain a requested responder.
 *
 * @uses   nice_portfolio_get_instance_maybe()
 *
 * @since  1.0
 *
 * @param  string                          $domain Name of the domain to get a new responder instance from.
 * @param  string                          $action Name of the action to be processed.
 *
 * @return Nice_Portfolio_ResponderInterface
 */
function nice_portfolio_responder( $domain, $action ) {
	$classname = nice_portfolio_responder_classname( $domain, $action );

	return nice_portfolio_get_instance_maybe( $classname );
}

/**
 * Obtain the name of a responder class.
 *
 * @since  1.0
 *
 * @param  string $domain Name of the domain of the action.
 * @param  string $action Name of the action.
 *
 * @return string
 */
function nice_portfolio_responder_classname( $domain, $action ) {
	// Uppercase name of action.
	$action = ucfirst( $action );

	// List possible classes.
	$classnames = array(
		$domain . $action . 'Responder'                    => true,
		'Nice_Portfolio_' . $action . 'Responder'   => true,
	);

	foreach ( $classnames as $classname => $validate ) {
		if ( class_exists( $classname ) && $validate ) {
			return $classname;
		}
	}

	return null;
}

/**
 * Obtain a requested action.
 *
 * @uses   nice_portfolio_get_instance_maybe()
 * @uses   nice_portfolio_service()
 * @uses   nice_portfolio_responder()
 *
 * @since  1.0
 *
 * @param  string                     $domain Name of the class to get a new service instance from.
 * @param  string                     $action Name of the action to be processed.
 *
 * @return Nice_Portfolio_ActionInterface
 */
function nice_portfolio_action( $domain, $action ) {
	$classname = nice_portfolio_action_classname( $domain, $action );

	return nice_portfolio_get_instance_maybe( $classname, array(
		'domain'    => nice_portfolio_service( $domain ),
		'responder' => nice_portfolio_responder( $domain, $action ),
	) );
}

/**
 * Obtain the name of an action class.
 *
 * @since  1.0
 *
 * @param  string $domain Name of the domain of the action.
 * @param  string $action Name of the action.
 *
 * @return string
 */
function nice_portfolio_action_classname( $domain, $action ) {
	// Uppercase name of action.
	$action = ucfirst( $action );

	// List possible classes.
	$classnames = array(
		$domain . $action . 'Action'                    => true,
		'Nice_Portfolio_' . $action . 'Action'   => true,
	);

	foreach ( $classnames as $classname => $validate ) {
		if ( class_exists( $classname ) && $validate ) {
			return $classname;
		}
	}

	wp_die( sprintf( esc_html__( '%s action does not exist. You need to create it in order to proceed.', 'nice-portfolio' ), esc_html( $action ) ) );

	return null;
}

/**
 * Obtain an initialized object of a given class name, whether is a singleton
 * or not.
 *
 * @uses  Nice_Portfolio_SingletonEntity::get_instance()
 * @uses  ReflectionClass::newInstanceArgs()
 *
 * @since 1.0
 *
 * @param  string                     $classname Name of the class to get an object from.
 * @param  array                      $data      Information to construct the object.
 *
 * @return Nice_Portfolio_EntityInterface
 */
function nice_portfolio_get_instance_maybe( $classname, array $data = array() ) {
	if ( method_exists( $classname, 'get_instance' ) && is_callable( array( $classname, 'get_instance' ) ) ) {
		return $classname::get_instance( $data );
	}

	if ( empty( $data ) ) {
		return new $classname;
	}

	$reflect  = new ReflectionClass( $classname );
	$instance = $reflect->newInstanceArgs( $data );

	return $instance;
}

/**
 * Create a new instance of the given class.
 *
 * @uses   nice_portfolio_request()
 *
 * @since  1.0
 *
 * @param  string                     $classname Name of the new object's class.
 * @param  array                      $data      Information to create the new instance.
 *
 * @return Nice_Portfolio_EntityInterface
 */
function nice_portfolio_create( $classname, array $data ) {
	return nice_portfolio_request( $classname, 'create', $data );
}

/**
 * Setup an instance to be displayed.
 *
 * @uses  nice_portfolio_request()
 *
 * @since 1.0
 *
 * @param Nice_Portfolio_EntityInterface $instance
 */
function nice_portfolio_display( Nice_Portfolio_EntityInterface $instance ) {
	nice_portfolio_request( get_class( $instance ), 'display', array( 'instance' => $instance ) );
}

/**
 * Setup an instance to be updated.
 *
 * @uses  nice_portfolio_request()
 *
 * @since 1.0
 *
 * @param Nice_Portfolio_EntityInterface $instance
 * @param array                          $data      Information to update instance.
 */
function nice_portfolio_update( Nice_Portfolio_EntityInterface $instance, array $data = array() ) {
	nice_portfolio_request( get_class( $instance ), 'update', array_merge( $data, array( 'instance' => $instance ) ) );
}
