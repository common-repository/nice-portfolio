<?php
if ( ! class_exists( 'Nice_Portfolio_Shortcode') ) :
/**
 * Class Nice_Portfolio_Shortcode
 *
 * This class manages functionality for the portfolio shortcode.
 *
 * @since 1.0
 *
 * @property-read $query_args
 */
class Nice_Portfolio_Shortcode extends Nice_Portfolio_WP_Shortcode {
	/**
	 * Name of the template that will be used to display the output.
	 *
	 * @since 1.0
	 * @var   null
	 */
	public $template = 'shortcodes/portfolio.php';

	/**
	 * Arguments to construct a WP_Query based on user input.
	 *
	 * @since 1.0
	 * @var   null|array
	 */
	protected $query_args = null;

	/**
	 * Set up initial data.
	 *
	 * @since 1.0
	 *
	 * @param array  $atts
	 * @param null   $content
	 * @param string $name
	 */
	public function __construct( array $atts = array(), $content = null, $name = '' ) {
		parent::__construct( $atts, $content, $name );

		$this->query_args = $this->get_query_args();
	}

	/**
	 * Sanitize attributes to construct the output.
	 *
	 * @since  1.0
	 *
	 * @param  array            $atts
	 *
	 * @return array|mixed|void
	 */
	protected function sanitize_atts( array $atts = array() ) {
		/**
		 * @hook nice_portfolio_shortcode_atts
		 *
		 * Hook here if you want to modify the attributes that were passed to
		 * the shortcode.
		 *
		 * @since 1.0
		 */
		$atts = apply_filters( 'nice_portfolio_shortcode_atts', $atts );

		return parent::sanitize_atts( $atts );
	}

	/**
	 * Obtain default attributes to generate the output.
	 *
	 * @since  1.0
	 *
	 * @return array
	 */
	protected function get_default_atts() {
		$settings = nice_portfolio_settings();

		/**
		 * @hook nice_portfolio_shortcode_default_atts
		 *
		 * Hook here if you want to modify the default attributes for the
		 * shortcode.
		 *
		 * @since 1.0
		 */
		$default_atts = apply_filters( 'nice_portfolio_shortcode_default_atts', array(
				'avoidcss'              => '',
				'limit'                 => $settings['limit'],
				'columns'               => $settings['columns'],
				'orderby'               => $settings['orderby'],
				'order'                 => $settings['order'],
				'category'              => '',
				'exclude_category'      => '',
				'tag'                   => '',
				'exclude_tag'           => '',
				'embed'                 => $settings['visible_data']['embed'],
				'client'                => $settings['visible_data']['client'],
				'url'                   => $settings['visible_data']['url'],
				'start_date'            => $settings['visible_data']['start_date'],
				'end_date'              => $settings['visible_data']['end_date'],
				'image_width'           => $settings['archive_image_size']['width'],
				'image_height'          => $settings['archive_image_size']['height'],
				'display_empty_message' => false,
				'category_filter'       => $settings['display_category_filter'],
			)
		);

		return $default_atts;
	}

	/**
	 * Obtain arguments for a WP_Query.
	 *
	 * This arguments will be used by the `nice_portfolio()` function to
	 * construct the output of the shortcode.
	 *
	 * @see   nice_portfolio()
	 *
	 * @since 1.0
	 */
	public function get_query_args() {
		if ( is_null( $this->query_args ) ) {
			$this->set_query_args();
		}

		return $this->query_args;
	}

	/**
	 * Set arguments for a WP_Query.
	 *
	 * This arguments will be used by the `nice_portfolio()` function to
	 * construct the output of the shortcode.
	 *
	 * @see   nice_portfolio()
	 *
	 * @since 1.0
	 */
	protected function set_query_args() {
		$atts = $this->atts;

		/**
		 * Obtain query arguments.
		 */
		$query_args = array(
			'avoidcss'              => in_array( $atts['avoidcss'], array( 'true', '1' ), true ),
			'orderby'               => $atts['orderby'],
			'order'                 => $atts['order'],
			'limit'                 => nice_portfolio_intval( $atts['limit'] ),
			'columns'               => intval( $atts['columns'] ),
			'category'              => $atts['category'],
			'exclude_category'      => $atts['exclude_category'],
			'tag'                   => $atts['tag'],
			'exclude_tag'           => $atts['exclude_tag'],
			'display_empty_message' => nice_portfolio_bool( $atts['display_empty_message'] ),
		);

		/**
		 * @hook nice_portfolio_shortcode_query_args
		 *
		 * Hook here if you want to modify the query arguments for the shortcode.
		 *
		 * @since 1.0
		 */
		$query_args = apply_filters( 'nice_portfolio_shortcode_query_args', $query_args );

		$this->query_args = $query_args;
	}
}
endif;
