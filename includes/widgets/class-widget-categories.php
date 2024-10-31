<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Handle portfolio categories widget.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Nice_Portfolio_Categories_Widget' ) ) :
/**
 * Class Nice_Portfolio_Categories_Widget
 *
 * This class creates a widget to show portfolio categories.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
class Nice_Portfolio_Categories_Widget extends Nice_Portfolio_WP_Widget {
	/**
	 * Internal handler for this widget.
	 *
	 * @since 1.0
	 * @var   string
	 */
	public $id = 'nice-portfolio-categories';

	/**
	 * List of categories for this widget.
	 *
	 * @since 1.0
	 * @var   null|array
	 */
	public $categories = null;

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
	public $template = 'widgets/portfolio-categories.php';

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
	public $form_template = 'widget-categories-form.php';

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
			$this->name = esc_html__( '(NiceThemes) Portfolio Categories', $this->textdomain );
		}

		/**
		 * Define widget options. Check first, to allow inheritance.
		 */
		$this->options = array_merge( array(
			'classname'   => 'nice-portfolio-categories',
			'description' => esc_html__( 'A widget that displays the portfolio categories.', $this->textdomain ),
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
			'title'        => array( '',    'sanitize_text_field' ),
			'dropdown'     => array( false, 'nice_portfolio_bool', false ),
			'count'        => array( false, 'nice_portfolio_bool', false ),
			'hierarchical' => array( true,  'nice_portfolio_bool', false ),
		);

		/**
		 * @hook nice_portfolio_widget_categories_instance_defaults
		 *
		 * Modify the default values for instances of this widget by hooking
		 * in here.
		 *
		 * @since 1.0
		 */
		return apply_filters( 'nice_portfolio_widget_categories_instance_defaults', $defaults, $this );
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
			 * Print a selectable dropdown of categories.
			 *
			 * @see Nice_Portfolio_Categories_Widget::dropdown()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_categories_content',
				'function' => array( __CLASS__, 'dropdown' ),
			),
			/**
			 * Print a list of categories.
			 *
			 * @see Nice_Portfolio_Categories_Widget::list_categories()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_categories_content',
				'function' => array( __CLASS__, 'list_categories' ),
			),
			/**
			 * Enqueue scripts for this widget.
			 *
			 * @see Nice_Portfolio_Categories_Widget::enqueue_scripts()
			 *
			 * @since 1.0
			 */
			array(
				'tag'      => 'nice_portfolio_widget_categories_content',
				'function' => array( __CLASS__, 'enqueue_scripts' ),
			),
		);

		/**
		 * @hook nice_portfolio_widget_categories_template_hooks
		 *
		 * Add or remove hooks for the template of this widget before they get
		 * passed to the WordPress API.
		 *
		 * @since 1.0
		 */

		return apply_filters( 'nice_portfolio_widget_categories_template_hooks', $hooks, $this );
	}

	/**
	 * Fire actions before widget output.
	 *
	 * @since  1.0
	 */
	function before_output() {
		/**
		 * @hook nice_portfolio_widget_categories_instance
		 *
		 * All modifications to the instance that will be used to process the
		 * projects should be hooked here.
		 *
		 * @since 1.0
		 */
		$this->args = apply_filters( 'nice_portfolio_widget_categories_instance', $this->args );

		/**
		 * Obtain categories.
		 */
		$this->categories = $this->get_categories( $this->args );

		parent::before_output();
	}

	/**
	 * Obtain the list of categories for this widget.
	 *
	 * @since  1.0
	 *
	 * @uses   get_terms()
	 *
	 * @param  $instance
	 *
	 * @return array|int|WP_Error
	 */
	protected function get_categories( $instance ) {
		/**
		 * @hook nice_portfolio_widget_categories_terms_args
		 *
		 * Hook here to modify the arguments to obtain the list of categories
		 * for this widget.
		 *
		 * @since 1.0
		 */
		$terms_args = apply_filters( 'nice_portfolio_widget_categories_terms_args', array(), $instance );

		return get_terms( array( nice_portfolio_category_name() ), $terms_args );
	}

	/**
	 * Lod template for the list of categories.
	 *
	 * @since 1.0
	 */
	public static function list_categories() {
		nice_portfolio_get_template( 'widgets/portfolio-categories/list-categories.php' );
	}

	/**
	 * Load template for the dropdown-style list of categories.
	 *
	 * @since 1.0
	 */
	public static function dropdown() {
		nice_portfolio_get_template( 'widgets/portfolio-categories/dropdown.php' );
	}

	/**
	 * Load scripts for this widget.
	 *
	 * @since 1.0
	 *
	 * @param Nice_Portfolio_Categories_Widget $widget
	 */
	public static function enqueue_scripts( Nice_Portfolio_Categories_Widget $widget ) {
		$args = $widget->args;

		/**
		 * Don't load if we're not using the dropdown option.
		 */
		if ( empty( $args['dropdown'] ) ) {
			return;
		}

		static $loaded = false;

		/**
		 * Only load script if it hasn't been loaded previously.
		 */
		if ( nice_portfolio_needs_assets() && ! $loaded ) {
			// If not debugging, use minified scripts.
			$script = nice_portfolio_debug() ? 'js/nice-portfolio-widget-categories.js' : 'js/min/nice-portfolio-widget-categories.min.js';

			wp_enqueue_script(
				nice_portfolio_plugin_slug() . '-widget-categories-script',
				NICE_PORTFOLIO_ASSETS_URL . $script,
				array( 'jquery' ),
				nice_portfolio_plugin_version()
			);

			$loaded = true;
		}
	}
}
endif;
