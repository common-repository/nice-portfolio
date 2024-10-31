<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * @package   Nice_Portfolio
 * @author    NiceThemes <hello@nicethemes.com>
 * @license   GPL-2.0+
 * @link      https://nicethemes.com/product/nice-portfolio
 * @copyright 2016 NiceThemes
 * @since     1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Nice_Portfolio_Project' ) ) :
/**
 * Class Nice_Portfolio_Project
 *
 * Manage internal information for portfolio projects.
 *
 * @since 1.0
 *
 * @property-read array    $categories
 * @property-read array    $tags
 * @property-read WP_Query $related_projects
 */
class Nice_Portfolio_Project {
	/**
	 * Post object to obtain project data.
	 *
	 * @var   null|WP_Post
	 * @since 1.0
	 */
	protected $post = null;

	/**
	 * Numeric ID for the project instance.
	 *
	 * @var   null|int
	 * @since 1.0
	 */
	protected $ID = null;

	/**
	 * Name of the project.
	 *
	 * @var   null|string
	 * @since 1.0
	 */
	protected $name = null;

	/**
	 * Project meta data.
	 *
	 * @var   null|array
	 * @since 1.0
	 */
	protected $custom_fields = null;

	/**
	 * List of categories that this project is associated to.
	 *
	 * @var   null
	 * @since 1.0
	 */
	protected $categories = null;

	/**
	 * List of tags that this project is associated to.
	 *
	 * @var   null
	 * @since 1.0
	 */
	protected $tags = null;

	/**
	 * WP_Query object containing all related projects.
	 *
	 * @var   WP_Query
	 * @since 1.0
	 */
	protected $related_projects = null;

	/**
	 * Context where the portfolio project is being requested.
	 *
	 * @since 1.0
	 * @var   string
	 */
	protected $context = null;

	/**
	 * Setup initial data.
	 *
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 */
	public function __construct( WP_Post $post ) {
		$post_type_name = nice_portfolio_post_type_name();

		/**
		 * Trigger error if the post type doesn't match.
		 */
		if ( ! ( $post->post_type === $post_type_name ) ) {
			_nice_portfolio_doing_it_wrong( __FUNCTION__, sprintf( esc_html__( 'The WP_Post object passed to %s class must belong of the %s post type', 'nice-portfolio' ), __CLASS__, $post_type_name ) );
			return;
		}

		$this->post          = $post;
		$this->ID            = $post->ID;
		$this->name          = $this->get_name();
		$this->custom_fields = $this->get_custom_fields();
		$this->context       = $this->get_context();
	}

	/**
	 * Obtain a Nice_Portfolio_Project object by post ID or WP_Post object.
	 *
	 * New instances are saved to a static variable, so they can be retrieved
	 * later without needing to be reinitialized.
	 *
	 * @since 1.0
	 *
	 * @param  int|WP_Post            $post Post ID or full post object.
	 *
	 * @return Nice_Portfolio_Project
	 */
	public static function obtain( $post = null ) {
		static $projects = array();

		$post_id = $post;

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// Allow a `WP_Post` object as input parameter.
		if ( $post instanceof WP_Post ) {
			$post_id = $post->ID;
		}

		if ( isset( $projects[ $post_id ] ) ) {
			/**
			 * @var Nice_Portfolio_Project $project
			 **/
			$project = $projects[ $post_id ];

			/**
			 * The context where the project is called may have changed from one
			 * call to another, so we need to try to update it.
			 */
			$project->update_context_maybe();

			return $project;
		}

		$projects[ $post_id ] = new self( get_post( $post_id ) );

		return $projects[ $post_id ];
	}

	/**
	 * Obtain the value of a property.
	 *
	 * @since  1.0
	 *
	 * @param  string $property
	 *
	 * @return null|string
	 */
	public function __get( $property ) {
		if ( method_exists( $this, 'get_' . $property ) ) {
			return call_user_func( array( $this, 'get_' . $property ) );
		}

		if ( property_exists( $this, $property ) ) {
			return $this->{$property};
		}

		return null;
	}

	/**
	 * Obtain the ID of the project.
	 *
	 * @since  1.0
	 *
	 * @return null|string
	 */
	public function get_the_ID() {
		if ( is_null( $this->ID ) ) {
			$this->set_the_ID();
		}

		return $this->ID;
	}

	/**
	 * Set the name of the project.
	 *
	 * @since 1.0
	 */
	protected function set_the_ID() {
		$this->ID = $this->post->ID;
	}

	/**
	 * Obtain the name of the project.
	 *
	 * @since  1.0
	 *
	 * @return null|string
	 */
	public function get_name() {
		if ( is_null( $this->name ) ) {
			$this->set_name();
		}

		return $this->name;
	}

	/**
	 * Set the name of the project.
	 *
	 * @since 1.0
	 */
	protected function set_name() {
		$this->name = $this->post->post_title;
	}

	/**
	 * Obtain custom fields for the project.
	 *
	 * If there's no value given to the function, it will retrieve all meta data.
	 *
	 * @since  1.0
	 *
	 * @param  string     $value Name of the custom field to obtain value from.
	 *
	 * @return null|array
	 */
	public function get_custom_fields( $value = '' ) {
		if ( is_null( $this->custom_fields ) ) {
			$this->set_custom_fields( $this->post );
		}

		if ( $value ) {
			if ( isset( $this->custom_fields[ $value ] ) ) {
				return $this->custom_fields[ $value ];
			}

			return null;
		}

		return $this->custom_fields;
	}

	/**
	 * Set custom fields for the project.
	 *
	 * @since  1.0
	 *
	 * @param  WP_Post    $post
	 *
	 * @return null|array
	 */
	protected function set_custom_fields( WP_Post $post ) {
		$custom_fields = array(
			'embed',
			'client',
			'start_date',
			'end_date',
			'url',
			'gallery',
		);

		/**
		 * @hook nice_portfolio_project_custom_fields
		 *
		 * Hook here to modify the custom fields for a single project.
		 */
		$custom_fields = apply_filters( 'nice_portfolio_project_custom_fields', $custom_fields );

		foreach ( $custom_fields as $key ) {
			$this->custom_fields[ $key ] = get_post_meta( $post->ID, '_project_' . $key, true );
		}
	}

	/**
	 * Obtain the list of categories that this project is attached to.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function get_categories() {
		if ( ! $this->categories ) {
			$this->set_categories();
		}

		return $this->categories;
	}

	/**
	 * Set the list of categories that this project is attached to.
	 *
	 * @since  1.0
	 */
	protected function set_categories() {
		$categories = get_the_terms( $this->get_the_ID(), nice_portfolio_category_name() );
		$this->categories = empty( $categories ) ? array() : $categories;
	}

	/**
	 * Obtain the list of tags that this project is attached to.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function get_tags() {
		if ( ! $this->tags ) {
			$this->set_tags();
		}

		return $this->tags;
	}

	/**
	 * Set the list of tags that this project is attached to.
	 *
	 * @since  1.0
	 */
	protected function set_tags() {
		$tags = get_the_terms( $this->get_the_ID(), nice_portfolio_tag_name() );
		$this->tags = empty( $tags ) ? array() : $tags;
	}

	/**
	 * Obtain the list of terms that this project is attached to.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function get_terms() {
		return array_merge( $this->get_categories(), $this->get_tags() );
	}

	/**
	 * Obtain a query for projects related to the current instance.
	 *
	 * @since  1.0
	 *
	 * @return WP_Query
	 */
	public function get_related_projects() {
		if ( ! $this->related_projects ) {
			$this->set_related_projects();
		}

		return $this->related_projects;
	}

	/**
	 * Create a query for projects related to the current instance.
	 *
	 * @since  1.0
	 */
	protected function set_related_projects() {
		if ( $this->get_categories() ) {
			$this->related_projects = null;
		}

		$category_ids = array();

		foreach ( $this->categories as $category ) {
			$category_ids[] = $category->term_id;
		}

		/**
		 * @hook nice_portfolio_project_related_projects_limit
		 *
		 * Hook here to modify the maximum number of related projects to show
		 * for a single project.
		 */
		$limit = apply_filters( 'nice_portfolio_project_related_projects_limit', 5, $this );

		$query_args = array(
			'post_type'           => nice_portfolio_post_type_name(),
			'tax_query'           => array(
				array(
					'taxonomy' => nice_portfolio_category_name(),
					'field'    => 'id',
					'operator' => 'IN',
					'terms'    => $category_ids,
				),
			),
			'post__not_in'        => array( $this->get_the_ID() ),
			'posts_per_page'      => $limit, // Number of related projects that will be shown.
			'ignore_sticky_posts' => 1,
		);

		$this->related_projects = new WP_Query( $query_args );
	}

	/**
	 * Obtain currently visible data.
	 *
	 * This list may be different depending on the context where the portfolio
	 * project is called from.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	public function get_visible_data() {
		switch ( $this->context ) {
			case 'shortcode':
				$visible_data = $this->get_shortcode_visible_data();
				break;

			case 'widget':
				$visible_data = $this->get_widget_visible_data();
				break;

			default:
				$visible_data = $this->get_global_visible_data();
				break;
		}

		return $visible_data;
	}

	/**
	 * Obtain currently visible data for shortcode context.
	 *
	 * We get the user-defined attributes and match them against the plugin settings.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	protected function get_shortcode_visible_data() {
		static $shortcodes = array();

		// Obtain shortcode data.
		$shortcode = nice_portfolio_current_shortcode();

		if ( ! isset( $shortcodes[ $shortcode->id ] ) ) {
			// Obtain global visible data.
			$global_visible_data = $this->get_global_visible_data();

			// Limit fields to the ones allowed globally.
			$visible_data = array_intersect_key( $shortcode->atts, $global_visible_data );

			// Use global values for the fields that were not passed to the shortcode.
			$visible_data = wp_parse_args( $visible_data, $global_visible_data );

			// Ensure we have boolean values.
			if ( is_array( $visible_data ) && ! empty( $visible_data ) ) {
				foreach ( $visible_data as &$visible_data_item ) {
					$visible_data_item = nice_portfolio_bool( $visible_data_item );
				}
			}

			$shortcodes[ $shortcode->id ] = $visible_data;
		}

		return $shortcodes[ $shortcode->id ];
	}

	/**
	 * Obtain currently visible data for widget context.
	 *
	 * We use the widget-specific settings.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	protected function get_widget_visible_data() {
		static $widgets = array();

		// Obtain widget data.
		$widget = nice_portfolio_current_widget();

		if ( ! isset( $widgets[ $widget->id ] ) ) {
			// Assign widget settings.
			$visible_data = array(
				'excerpt'   => $widget->args['display_excerpt'],
				'thumbnail' => $widget->args['display_thumbnail'],
			);

			// Ensure we have boolean values.
			if ( is_array( $visible_data ) && ! empty( $visible_data ) ) {
				foreach ( $visible_data as &$visible_data_item ) {
					$visible_data_item = nice_portfolio_bool( $visible_data_item );
				}
			}

			$widgets[ $widget->id ] = $visible_data;
		}

		return $widgets[ $widget->id ];
	}

	/**
	 * Obtain currently visible data for global context.
	 *
	 * We use the plugin settings.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	protected function get_global_visible_data() {
		static $visible_data = null;

		if ( is_null( $visible_data ) ) {
			// Obtain plugin settings.
			$settings = nice_portfolio_settings();

			// Obtain data from plugin settings.
			$visible_data = $settings['visible_data'];

			// Ensure we have boolean values.
			if ( is_array( $visible_data ) && ! empty( $visible_data ) ) {
				foreach ( $visible_data as &$visible_data_item ) {
					$visible_data_item = nice_portfolio_bool( $visible_data_item );
				}
			}
		}

		return $visible_data;
	}

	/**
	 * Obtain the name of the current context.
	 *
	 * @since  1.0
	 *
	 * @return null|string
	 */
	public function get_context() {
		return nice_portfolio_context();
	}

	/**
	 * Update contextual properties to the current context where the portfolio
	 * project is being called.
	 *
	 * @since 1.0
	 */
	protected function update_context_maybe() {
		if ( $this->context !== $this->get_context() ) {
			// Update context.
			$this->context = $this->get_context();
		}
	}

	/**
	 * Check if the given field can be displayed.
	 *
	 * @since  1.0
	 *
	 * @param  string $data
	 *
	 * @return bool
	 */
	public function can_display( $data ) {
		$visible_data = $this->get_visible_data();
		return isset( $visible_data[ $data ] ) && $visible_data[ $data ];
	}
}
endif;
