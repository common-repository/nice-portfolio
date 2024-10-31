<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Handle the Portfolio Categories widget.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Nice_Portfolio_Recent_Projects_Widget' ) ) :
/**
 * Class Nice_Portfolio_Recent_Projects_Widget
 *
 * This class creates a widget to display recent projects.
 *
 * @package Nice_Portfolio
 * @since   1.0
 *
 * @property-read Nice_Portfolio $portfolio
 */
class Nice_Portfolio_Recent_Projects_Widget extends Nice_Portfolio_WP_Widget {
	/**
	 * Internal handler for this widget.
	 *
	 * @since 1.0
	 * @var   string
	 */
	public $id = 'nice-portfolio-recent-projects';

	/**
	 * Portfolio instance containing projects.
	 *
	 * @since 1.0
	 * @var   null|Nice_Portfolio
	 */
	protected $portfolio = null;

	/**
	 * Name of the template for the public-facing side of the widget.
	 *
	 * This template will be loaded by the parent class.
	 *
	 * @see Nice_Portfolio_WP_Widget::widget()
	 * @see Nice_Portfolio_WP_Widget::print_widget()
	 *
	 * @since 1.0
	 * @var   string
	 */
	public $template = 'widgets/recent-projects.php';

	/**
	 * Name of the template for the admin-facing side of the widget.
	 *
	 * This template will be loaded by the parent class.
	 *
	 * @see Nice_Portfolio_WP_Widget::form()
	 *
	 * @since 1.0
	 * @var   string
	 */
	public $form_template = 'widget-recent-projects-form.php';

	/**
	 * Initialize widget.
	 *
	 * @since 1.0
	 */
	function __construct() {
		/**
		 * Define name of widget. Check first, to allow inheritance.
		 */
		if ( ! $this->name ) {
			$this->name = esc_html__( '(NiceThemes) Recent Projects', $this->textdomain );
		}

		/**
		 * Define widget options. Check first, to allow inheritance.
		 */
		$this->options = array_merge( array(
			'classname'   => 'nice-portfolio-recent-projects',
			'description' => esc_html__( 'A widget that displays the most recent portfolio projects.', $this->textdomain ),
		), $this->options );

		/**
		 * Create widget.
		 */
		parent::__construct();
	}

	/**
	 * Obtain default values for widget instance.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	protected function get_instance_defaults() {
		/**
		 * Obtain values.
		 *
		 * Format for each value: {key} => array( {value}, {sanitization_function}, {fallback_value} )
		 */
		$defaults = array(
			'title'             => array( '', 'sanitize_text_field' ),
			'number'            => array( get_option( 'posts_per_page' ), 'nice_portfolio_intval', 0 ),
			'display_excerpt'   => array( false, 'nice_portfolio_bool', false ),
			'display_thumbnail' => array( true, 'nice_portfolio_bool', false ),
			'thumbnail_width'   => array( 20, 'absint', 20 ),
			'thumbnail_height'  => array( 20, 'absint', 20 ),
		);

		/**
		 * @hook nice_portfolio_widget_recent_projects_instance_defaults
		 *
		 * Modify the default values for instances of this widget by hooking
		 * in here.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'nice_portfolio_widget_recent_projects_instance_defaults', $defaults, $this );
	}

	/**
	 * Obtain the list of hooks to be applied to the template of the widget.
	 *
	 * @see    Nice_Portfolio_WP_Widget::add_template_hooks()
	 *
	 * @since  1.0
	 *
	 * @return mixed|void|array
	 */
	protected function get_template_hooks() {
		$hooks = array(
			/**
			 * Print widget title.
			 *
			 * @see Nice_Portfolio_WP_Widget::widget_title()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_before_widget_content',
				'function' => array( __CLASS__, 'widget_title' ),
				'priority' => 20,
			),
			/**
			 * Print the opening tag for a looped project's wrapper.
			 *
			 * @see Nice_Portfolio_Recent_Projects_Widget::project_thumbnail()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_recent_project_content',
				'function' => array( __CLASS__, 'project_wrapper_start' ),
				'priority' => 10,
			),
			/**
			 * Print the thumbnail of a looped project.
			 *
			 * @see Nice_Portfolio_Recent_Projects_Widget::project_thumbnail()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_recent_project_content',
				'function' => array( __CLASS__, 'project_thumbnail' ),
				'priority' => 20,
			),
			/**
			 * Print the title of a looped project.
			 *
			 * @see Nice_Portfolio_Recent_Projects_Widget::project_title()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_recent_project_content',
				'function' => array( __CLASS__, 'project_title' ),
				'priority' => 30,
			),
			/**
			 * Print the excerpt of a looped project.
			 *
			 * @see Nice_Portfolio_Recent_Projects_Widget::project_excerpt()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_recent_project_content',
				'function' => array( __CLASS__, 'project_excerpt' ),
				'priority' => 40,
			),
			/**
			 * Print the closing tag for a looped project's wrapper.
			 *
			 * @see Nice_Portfolio_Recent_Projects_Widget::project_thumbnail()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_recent_project_content',
				'function' => array( __CLASS__, 'project_wrapper_end' ),
				'priority' => 50,
			),
		);

		/**
		 * @hook nice_portfolio_widget_recent_projects_template_hooks
		 *
		 * Add or remove hooks for the template of this widget before they get
		 * passed to the WordPress API.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'nice_portfolio_widget_recent_projects_template_hooks', $hooks, $this );
	}

	/**
	 * Fire actions before widget output.
	 *
	 * @since  1.0
	 */
	public function before_output() {
		/**
		 * @hook nice_portfolio_widget_recent_projects_instance
		 *
		 * All modifications to the instance that will be used to process the
		 * projects should be hooked here.
		 *
		 * @since 1.0
		 */
		$this->args = apply_filters( 'nice_portfolio_widget_recent_projects_instance', $this->args );

		/**
		 * Obtain portfolio.
		 */
		$this->portfolio = $this->get_portfolio( $this->args );

		parent::before_output();
	}

	/**
	 * Fire actions after widget output.
	 *
	 * @since  1.0
	 */
	public function after_output() {
		// Reset post data if we have an active query.
		if ( $this->portfolio->projects instanceof WP_Query ) {
			wp_reset_postdata();
		}

		parent::after_output();
	}

	/**
	 * Obtain the result of a query of projects.
	 *
	 * @since  1.0
	 *
	 * @param  array $instance
	 *
	 * @return array
	 */
	protected function get_portfolio( array $instance = array() ) {
		$query_args = array(
			'orderby' => 'post_date',
			'order'   => 'DESC',
			'limit'   => $instance['number'],
		);

		/**
		 * @hook nice_portfolio_widget_recent_projects_query_args
		 *
		 * Hook here if you want to modify the projects query.
		 *
		 * @since 1.0
		 */
		$query_args = apply_filters( 'nice_portfolio_widget_recent_projects_query_args', $query_args, $instance );

		$portfolio = nice_portfolio_obtain_instance( $query_args );

		return $portfolio;
	}

	/**
	 * Print the the opening tag for the project's wrapper.
	 *
	 * @since 1.0
	 */
	public static function project_wrapper_start() {
		$classes = array(
			'recent-project-wrapper',
		);

		if ( nice_portfolio_project_can_display( 'thumbnail' ) ) {
			array_push( $classes, 'has-thumbnail' );
		}

		if ( nice_portfolio_project_can_display( 'excerpt' ) ) {
			array_push( $classes, 'has-excerpt' );
		}

		?>
			<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">
		<?php
	}

	/**
	 * Print the the opening tag for the project's wrapper.
	 *
	 * @since 1.0
	 */
	public static function project_wrapper_end() {
		?>
			</div>
		<?php
	}

	/**
	 * Print the thumbnail of the currently looped project inside the Recent
	 * Projects widget.
	 *
	 * @since 1.0
	 */
	public static function project_thumbnail() {
		if ( nice_portfolio_project_can_display( 'thumbnail' ) ) {
			nice_portfolio_get_template( 'widgets/recent-projects/featured-image.php' );
		}
	}

	/**
	 * Print HTML for the title of the currently looped project inside the Recent
	 * Projects widget.
	 *
	 * @since 1.0
	 */
	public static function project_title() {
		nice_portfolio_get_template( 'widgets/recent-projects/title.php' );
	}

	/**
	 * Print HTML for the excerpt of the currently looped project inside the Recent
	 * Projects widget.
	 *
	 * @since 1.0
	 */
	public static function project_excerpt() {
		if ( nice_portfolio_project_can_display( 'excerpt' ) ) {
			nice_portfolio_get_template( 'widgets/recent-projects/excerpt.php' );
		}
	}
}
endif;
