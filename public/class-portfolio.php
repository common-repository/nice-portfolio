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

if ( ! class_exists( 'Nice_Portfolio' ) ) :
/**
 * Class Nice_Portfolio
 *
 * Manage internal portfolio information.
 *
 * @since 1.0
 *
 * @property-read array                  $args
 * @property-read WP_Query               $projects
 * @property-read Nice_Portfolio_Project $project
 * @property-read int                    $loop_position
 */
class Nice_Portfolio {
	/**
	 * Instance arguments to help constructing output.
	 *
	 * @since 1.0
	 * @var   array|mixed|void
	 */
	protected $args = array();

	/**
	 * Projects contained by this instance.
	 *
	 * @since 1.0
	 * @var   array|WP_Query
	 */
	protected $projects = array();

	/**
	 * Current project being looped.
	 *
	 * @since 1.0
	 * @var   Nice_Portfolio_Project|null
	 */
	protected $project = null;

	/**
	 * Context where the portfolio project is being requested.
	 *
	 * @since 1.0
	 * @var   string
	 */
	protected $context = null;

	/**
	 * Current position within the loop.
	 *
	 * @since 1.0
	 * @var   int
	 */
	protected $loop_position = -1;

	/**
	 * Setup initial data.
	 *
	 * @param array $args Arguments for the new instance.
	 *
	 * @since 1.0
	 */
	public function __construct( $args = array() ) {
		$this->args     = $this::sanitize_args( $args );
		$this->context  = $this->get_context();
		$this->projects = $this->get_projects();
		$this->project  = $this->get_project();
	}

	/**
	 * Obtain a Nice_Portfolio object.
	 *
	 * New instances are saved to a static variable, so they can be retrieved
	 * later without needing to be reinitialized.
	 *
	 * @since 1.0
	 *
	 * @param  array          $args Arguments for the new instance.
	 *
	 * @return Nice_Portfolio
	 */
	public static function obtain( $args = null ) {
		static $portfolios = array();

		if ( is_null( $args ) ) {
			if ( is_array( $portfolios ) && ! empty( $portfolios ) ) {
				return end( $portfolios );
			}

			/**
			 * Trigger error if we don't have arguments and the array of
			 * instances is empty.
			 */
			_nice_portfolio_doing_it_wrong(
				__METHOD__,
				esc_html__( 'You need to create at least one instance before trying to obtain one.', 'nice-portfolio' ),
				'1.0'
			);

			return null;
		}

		$portfolio = new self( $args );

		$portfolios[] = $portfolio;

		return $portfolio;
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
		if ( property_exists( $this, $property ) ) {
			return $this->{$property};
		}

		return null;
	}

	/**
	 * Sanitize arguments.
	 *
	 * @since  1.0
	 * @param  array       $args
	 *
	 * @return mixed|void
	 */
	protected static function sanitize_args( $args = array() ) {
		$settings = nice_portfolio_settings();

		/**
		 * @hook nice_portfolio_default_args
		 *
		 * All modifications to the default arguments should be hooked here.
		 *
		 * @since 1.0
		 */
		$defaults = apply_filters( 'nice_portfolio_default_args', array(
				'avoidcss'              => $settings['avoidcss'],
				'columns'               => intval( $settings['columns'] ),
				'limit'                 => $settings['limit'],
				'orderby'               => $settings['orderby'],
				'order'                 => strtoupper( $settings['order'] ),
				'category'              => null,
				'exclude_category'      => null,
				'tag'                   => null,
				'exclude_tag'           => null,
				'paged'                 => null,
				'image_width'           => null,
				'image_height'          => null,
				'embed'                 => $settings['visible_data']['embed'],
				'client'                => $settings['visible_data']['client'],
				'url'                   => $settings['visible_data']['url'],
				'start_date'            => $settings['visible_data']['start_date'],
				'end_date'              => $settings['visible_data']['end_date'],
				'display_empty_message' => true,
			)
		);

		$args = wp_parse_args( $args, $defaults );

		// Force the number of columns to be at least 1.
		$args['columns'] = intval( $args['columns'] );

		/**
		 * @hook nice_portfolio_args
		 *
		 * All modifications to the arguments should hooked here.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'nice_portfolio_args', $args );
	}

	/**
	 * Create and return a custom query for portfolio projects.
	 *
	 * @since 1.0
	 *
	 * @return null|WP_Query
	 */
	protected function query() {
		$settings      = nice_portfolio_settings();
		$category_name = nice_portfolio_category_name();
		$tag_name      = nice_portfolio_tag_name();
		$query         = null;
		$args          = $this->args;

		/**
		 * Declare default query arguments.
		 */
		$defaults = array(
			'limit'     => $settings['limit'],
			'orderby'   => $settings['orderby'],
			'order'     => strtoupper( $settings['order'] ),
			'paged'     => null,
		);

		/**
		 * @hook nice_portfolio_query_default_args
		 *
		 * Hook here if you want to modify the default query arguments.
		 *
		 * @since 1.0
		 */
		$defaults = apply_filters( 'nice_portfolio_query_default_args', $defaults, $this );

		$args = wp_parse_args( $args, $defaults );
		/**
		 * @hook nice_portfolio_query_args
		 *
		 * Hook here if you want to modify the query arguments.
		 *
		 * @since 1.0
		 */
		$args = apply_filters( 'nice_portfolio_query_args', $args, $this );

		/**
		 * Build taxonomy query.
		 */
		$tax_query = array();
		if ( $this->args['category'] ) {
			$tax_query[] = array(
				'taxonomy' => $category_name,
				'field'    => 'id',
				'terms'    => explode( ',', $this->args['category'] ),
			);
		}
		if ( $this->args['tag'] ) {
			$tax_query[] = array(
				'taxonomy' => $tag_name,
				'field'    => 'id',
				'terms'    => explode( ',', $this->args['tag'] ),
			);
		}
		if ( $this->args['exclude_category'] ) {
			$tax_query[] = array(
				'taxonomy' => $category_name,
				'field'    => 'id',
				'terms'    => explode( ',', $this->args['exclude_category'] ),
				'operator' => 'NOT IN',
			);
		}
		if ( $this->args['exclude_tag'] ) {
			$tax_query[] = array(
				'taxonomy' => $tag_name,
				'field'    => 'id',
				'terms'    => explode( ',', $this->args['exclude_tag'] ),
				'operator' => 'NOT IN',
			);
		}

		/**
		 * @hook nice_portfolio_tax_query
		 *
		 * Hook here if you want to modify the default taxonomy query.
		 *
		 * @since 1.0
		 */
		$tax_query = apply_filters( 'nice_portfolio_tax_query', $tax_query, $this );

		if ( 0 != $args['limit'] ) { // WPCS: loose comparison ok.
			$query = new WP_Query( array(
					'post_type'      => nice_portfolio_post_type_name(),
					'orderby'        => $args['orderby'],
					'posts_per_page' => $args['limit'],
					'order'          => $args['order'],
					'tax_query'      => $tax_query,
					'paged'          => $args['paged'],
				)
			);
		}

		return $query;
	}

	/**
	 * Return the query of projects for the current instance.
	 *
	 * @since  1.0
	 *
	 * @return WP_Query
	 */
	public function get_projects() {
		if ( ! $this->projects ) {
			$this->set_projects();
		}

		return $this->projects;
	}

	protected function set_projects() {
		global $wp_query;

		$projects = null;

		/**
		 * Try to get the query from the current one, if it's being processed.
		 */
		if ( 'global' === $this->context && ( nice_portfolio_is_project_post_type() || nice_portfolio_is_category() || nice_portfolio_is_tag() ) ) {
			$projects = $wp_query;
		}

		/**
		 * Make our custom query if a valid WP_Query hasn't been set yet.
		 */
		if ( is_null( $projects ) || $projects->is_single ) {
			$projects = $this->query();
		}

		$this->projects = $projects;
	}

	/**
	 * Obtain the current project.
	 *
	 * @since  1.0
	 *
	 * @return Nice_Portfolio_Project
	 */
	protected function get_project() {
		if ( ! $this->project && ( $projects = $this->get_projects() ) ) {
			$this->set_project( isset( $projects->post->ID ) ? $projects->post->ID : null );
		}

		return $this->project;
	}

	/**
	 * Set the project for this instance.
	 *
	 * @since 1.0
	 *
	 * @param int $project_id ID of the project.
	 */
	protected function set_project( $project_id = null ) {
		$this->project = $project_id ? nice_portfolio_obtain_project( $project_id ) : null;
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
	 * Check if the projects query has posts.
	 *
	 * This method is a wrapper for WP_Query::have_posts()
	 *
	 * @see WP_Query::have_posts()
	 *
	 * @since  1.0
	 *
	 * @return bool
	 */
	public function have_posts() {
		$projects = $this->get_projects();

		if ( $projects ) {
			return $projects->have_posts();
		}

		return null;
	}

	/**
	 * Process information for the current project in the loop.
	 *
	 * This method is a wrapper for WP_Query::the_post() with some additional
	 * functionality.
	 *
	 * @see WP_Query::the_post()
	 *
	 * @since  1.0
	 */
	public function the_post() {
		/**
		 * Obtain the projects query.
		 */
		$projects = $this->get_projects();

		/**
		 * Process the current WP_Post object in the loop.
		 */
		$projects->the_post();

		/**
		 * Update the current project of this object to the one in the loop.
		 */
		$this->update_project();

		/**
		 * Update the loop count.
		 */
		$this->increase_loop();
	}

	/**
	 * Update the project to match the current item inside the loop.
	 *
	 * @since 1.0
	 */
	public function update_project() {
		$this->set_project();
	}

	/**
	 * Update the loop position.
	 *
	 * @since 1.0
	 */
	public function increase_loop() {
		$this->loop_position++;
	}

	/**
	 * Return the current loop position.
	 *
	 * @since 1.0
	 */
	public function get_loop_position() {
		return $this->loop_position;
	}
}
endif;
