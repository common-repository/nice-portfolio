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
 * Class Nice_Portfolio_Metabox
 *
 * Dynamically create and manage meta boxes.
 *
 * @since 1.1
 */
class Nice_Portfolio_Metabox extends Nice_Portfolio_Entity {
	/**
	 * Internal ID for our meta box.
	 *
	 * @var   string
	 * @since 1.1
	 */
	protected $id = '';

	/**
	 * List of posts that this meta box will be applied to.
	 *
	 * @var   array
	 * @since 1.1
	 */
	protected $post_types = array( 'post' );

	/**
	 * Context for this meta box.
	 *
	 * @var   string
	 * @since 1.1
	 */
	protected $context = '';

	/**
	 * Fields that this meta box will include.
	 *
	 * @var   array
	 * @since 1.1
	 */
	protected $fields = array();

	/**
	 * Current settings for this meta box.
	 *
	 * @var   array
	 * @since 1.1
	 */
	protected $settings = array();

	/**
	 * Text domain for the current meta box.
	 *
	 * @var   string
	 * @since 1.1
	 */
	protected $textdomain = 'nice-portfolio-metabox';
}
