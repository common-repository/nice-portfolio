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

if ( ! class_exists( 'Nice_Portfolio_Setup_Page' ) ) :
/**
 * Class Nice_Portfolio_Setup_Page
 *
 * This class manages the hooks to be fired on each kind of portfolio page.
 *
 * @since 1.0
 */
class Nice_Portfolio_Setup_Page {
	/**
	 * Internal name for the current page.
	 *
	 * @var   null|string
	 * @since 1.0
	 */
	protected $current_page = null;

	/**
	 * Set the current page.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		$this->current_page = $this->get_current_page();
	}

	/**
	 * Initialize an instance of this class and setup the current page.
	 *
	 * @since 1.0
	 *
	 * @param Nice_Portfolio_Setup_Page $setup
	 */
	public static function init( Nice_Portfolio_Setup_Page $setup = null ) {
		if ( ! $setup ) {
			$setup = new self;
		}

		$setup->setup_current_page();
	}

	/**
	 * Obtain an internal name for the current page.
	 *
	 * @since 1.0
	 *
	 * @return null|string
	 */
	public function get_current_page() {
		if ( $this->current_page ) {
			return $this->current_page;
		}

		$current_page = null;

		if ( nice_portfolio_is_project_404() ) {
			$current_page = '404-single-project';

		} elseif ( nice_portfolio_is_category_404() ) {
			$current_page = '404-category';

		} elseif ( nice_portfolio_is_tag_404() ) {
			$current_page = '404-tag';

		} elseif ( nice_portfolio_is_single() ) {
			$current_page = 'single-project';

		} elseif ( nice_portfolio_is_page() ) {
			$current_page = 'portfolio-page';

		} elseif ( nice_portfolio_is_category() ) {
			$current_page = 'portfolio-category';

		} elseif ( nice_portfolio_is_tag() ) {
			$current_page = 'portfolio-tag';

		} elseif ( nice_portfolio_is_archive() ) {
			$current_page = 'portfolio-archive';

		} elseif ( ! nice_portfolio_is_project_post_type() && ! nice_portfolio_is_page() ) {
			$current_page = null;

		}

		return $current_page;
	}

	/**
	 * Setup before, after and specific hooks for the current page.
	 *
	 * @since 1.0
	 */
	public function setup_current_page() {
		// Return early if the current page is not set.
		if ( ! $this->current_page ) {
			return;
		}

		/**
		 * @hook  nice_portfolio_before_page_setup
		 *
		 * All actions that add functionality or output right before the
		 * current page is setup should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_before_page_setup' );

		/**
		 * Setup hooks for the current page.
		 */
		switch ( $this->current_page ) {
			case '404-menu-item':
				$this::setup_single_project_404_page();
				break;

			case '404-category':
				$this::setup_category_404_page();
				break;

			case '404-tag':
				$this::setup_tag_404_page();
				break;

			case 'single-project':
				$this::setup_single_project_page();
				break;

			case 'portfolio-page':
				$this::setup_portfolio_page();
				break;

			case 'portfolio-category':
				$this::setup_portfolio_category();
				break;

			case 'portfolio-tag':
				$this::setup_portfolio_tag();
				break;

			case 'portfolio-archive':
				$this::setup_portfolio_archive();
				break;

			default:
				$this::setup_page();
				break;
		}

		/**
		 * @hook  nice_portfolio_after_page_setup
		 *
		 * All actions that add functionality or output right after the
		 * current page is setup should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_after_page_setup' );
	}

	/**
	 * Fire actions for 404 pages triggered by menu items.
	 *
	 * @since 1.0
	 */
	public static function setup_single_project_404_page() {
		/**
		 * @hook  nice_portfolio_single_project_404
		 *
		 * All specific actions for menu item 404 pages that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_single_project_404' );
	}

	/**
	 * Fire actions for 404 pages triggered by categories.
	 *
	 * @since 1.0
	 */
	public static function setup_category_404_page() {
		/**
		 * @hook  nice_portfolio_category_404
		 *
		 * All specific actions for menu item 404 pages that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_category_404' );
	}

	/**
	 * Fire actions for 404 pages triggered by tags.
	 *
	 * @since 1.0
	 */
	public static function setup_tag_404_page() {
		/**
		 * @hook  nice_portfolio_tag_404
		 *
		 * All specific actions for menu item 404 pages that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_tag_404' );
	}

	/**
	 * Fire actions for single project pages.
	 *
	 * @since 1.0
	 */
	public static function setup_single_project_page() {
		/**
		 * @hook  nice_portfolio_single_project
		 *
		 * All specific actions for single project pages that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 */
		do_action( 'nice_portfolio_single_project' );
	}

	/**
	 * Fire actions for the portfolio page.
	 *
	 * @since 1.0
	 */
	public static function setup_portfolio_page() {
		/**
		 * @hook  nice_portfolio_page
		 *
		 * All specific actions for the portfolio page that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_setup_page() - 10
		 */
		do_action( 'nice_portfolio_page' );
	}

	/**
	 * Fire actions for portfolio category pages.
	 *
	 * @since 1.0
	 */
	public static function setup_portfolio_category() {
		/**
		 * @hook nice_portfolio_category_page
		 *
		 * All specific actions for portfolio category pages that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_setup_category_page() - 10
		 */
		do_action( 'nice_portfolio_category_page' );
	}

	/**
	 * Fire actions for portfolio tag pages.
	 *
	 * @since 1.0
	 */
	public static function setup_portfolio_tag() {
		/**
		 * @hook  nice_portfolio_tag_page
		 *
		 * All specific actions for portfolio tag pages that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_setup_tag_page() - 10
		 */
		do_action( 'nice_portfolio_tag_page' );
	}

	/**
	 * Fire actions for portfolio archive pages.
	 *
	 * @since 1.0
	 */
	public static function setup_portfolio_archive() {
		/**
		 * @hook  nice_portfolio_archive_page
		 *
		 * All specific actions for portfolio archive pages that need to be
		 * processed before loading the template should be hooked here.
		 *
		 * @since 1.0
		 *
		 * Hooked here:
		 * @see nice_portfolio_setup_archive_page() - 10
		 */
		do_action( 'nice_portfolio_archive_page' );
	}

	/**
	 * Placeholder method for extensibility purposes.
	 *
	 * @since 1.0
	 */
	public function setup_page() {}
}
endif;
