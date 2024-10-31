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

if ( ! class_exists( 'Nice_Portfolio_Page_Template' ) ) :
/**
 * class Nice_Portfolio_Template
 *
 * This class manages the templates to be loaded for the public-facing side
 * of this plugin, depending on the current view.
 *
 * @since 1.0
 */
class Nice_Portfolio_Page_Template {
	/**
	 * Path of the current non-filtered template.
	 *
	 * @since 1.0
	 * @var   null|string
	 */
	protected $original_template = null;

	/**
	 * Path of the template to be used for the current page.
	 *
	 * @since 1.0
	 * @var   null|string
	 */
	protected $current_template = null;

	/**
	 * Set initial values.
	 *
	 * @since 1.0
	 *
	 * @param string $original_template Location of the current non-hooked template.
	 */
	public function __construct( $original_template ) {
		$this->original_template = $original_template;
	}

	/**
	 * Create an instance of this class and return the current template.
	 *
	 * @since  1.0
	 *
	 * @param  string      $original_template Location of the current non-hooked template.
	 *
	 * @return null|string
	 */
	public static function obtain( $original_template ) {
		$template = new self( $original_template );
		return $template->get_current_template();
	}

	/**
	 * Obtain the template for the current page.
	 *
	 * @since  1.0
	 *
	 * @return null|string
	 */
	public function get_current_template() {
		if ( ! $this->current_template ) {
			$this->current_template = $this->process_current_template();
		}

		return $this->current_template;
	}

	/**
	 * Process the template for the current page.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	protected function process_current_template() {
		if ( nice_portfolio_is_404() ) {
			/**
			 * Keep original template for 404 error pages.
			 */
			$template = $this->original_template;

		} elseif ( nice_portfolio_is_single() ) {
			/**
			 * Setup template for single portfolio projects.
			 */
			$template = self::get_single_template();

		} elseif ( nice_portfolio_is_page() ) {
			/**
			 * Setup template for portfolio page.
			 */
			$template = self::get_portfolio_template();

		} elseif ( nice_portfolio_is_category() ) {
			/**
			 * Setup template for project category.
			 */
			$template = self::get_category_template();

		} elseif ( nice_portfolio_is_tag() ) {
			/**
			 * Setup template for project tag.
			 */
			$template = self::get_tag_template();

		} elseif ( nice_portfolio_is_archive() ) {
			/**
			 * Setup template for project archive.
			 */
			$template = self::get_archive_template();

		} else {
			/**
			 * Use current template as fallback value.
			 */
			$template = $this->original_template;
		}

		return $template;
	}

	/**
	 * Obtain the location of the default single template.
	 *
	 * @since  1.0
	 */
	public static function get_single_template() {
		// Allow bypassing.
		/**
		 * @hook nice_portfolio_single_template
		 *
		 * Modify the project template for single project pages by hooking here.
		 *
		 * @since 1.0
		 */
		$template = apply_filters( 'nice_portfolio_single_template', '' );

		// Look for a custom file before loading default.
		if ( ! $template && ! file_exists( $template = locate_template( 'portfolio/single-project.php' ) ) ) {
			$template = nice_portfolio_locate_template( 'single-project.php' );
		}

		return $template;
	}

	/**
	 * Obtain the location of the default single template.
	 *
	 * @since  1.0
	 *
	 * @return string
	 */
	public static function get_portfolio_template() {
		// Allow bypassing.
		/**
		 * @hook nice_portfolio_page_template
		 *
		 * Modify the project template for the portfolio page by hooking here.
		 *
		 * @since 1.0
		 */
		$template = apply_filters( 'nice_portfolio_page_template', '' );

		// Look for a custom file before loading default.
		if ( ! $template && ! file_exists( $template = locate_template( 'portfolio/portfolio-page.php' ) ) ) {
			$template = nice_portfolio_locate_template( 'portfolio-page.php' );
		}

		return $template;
	}

	/**
	 * Obtain the location of the default category template.
	 *
	 * @since  1.0
	 */
	public static function get_category_template() {
		// Allow bypassing.
		/**
		 * @hook nice_portfolio_category_template
		 *
		 * Modify the project template for portfolio category pages by hooking here.
		 *
		 * @since 1.0
		 */
		$template = apply_filters( 'nice_portfolio_category_template', '' );

		// Look for a custom file before loading default.
		if ( ! $template && ! file_exists( $template = locate_template( 'portfolio/portfolio-category.php' ) ) ) {
			$template = nice_portfolio_locate_template( 'portfolio-category.php' );
		}

		return $template;
	}

	/**
	 * Obtain the location of the default tag template.
	 *
	 * @since 1.0
	 */
	public static function get_tag_template() {
		// Allow bypassing.
		/**
		 * @hook nice_portfolio_tag_template
		 *
		 * Modify the project template for portfolio tag pages by hooking here.
		 *
		 * @since 1.0
		 */
		$template = apply_filters( 'nice_portfolio_tag_template', '' );

		// Look for a custom file before loading default.
		if ( ! $template && ! file_exists( $template = locate_template( 'portfolio/portfolio-tag.php' ) ) ) {
			$template = nice_portfolio_locate_template( 'portfolio-tag.php' );
		}

		return $template;
	}

	/**
	 * Obtain the location of the default archive template.
	 *
	 * @since  1.0
	 */
	public function get_archive_template() {
		// Allow bypassing.
		/**
		 * @hook nice_portfolio_archive_template
		 *
		 * Modify the project template for portfolio archive pages by hooking here.
		 *
		 * @since 1.0
		 */
		$template = apply_filters( 'nice_portfolio_archive_template', '' );

		// Look for a custom file before loading default.
		if ( ! $template && ! file_exists( $template = locate_template( 'portfolio/portfolio-archive.php' ) ) ) {
			$template = nice_portfolio_locate_template( 'portfolio-archive.php' );
		}

		return $template;
	}
}
endif;
