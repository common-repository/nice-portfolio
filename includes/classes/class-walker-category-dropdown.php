<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Nice_Portfolio_Walker_CategoryDropdown' ) ) :
/**
 * Class Nice_Portfolio_Walker_CategoryDropdown
 *
 * This class creates a customized walker for `wp_dropdown_categories()`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
class Nice_Portfolio_Walker_CategoryDropdown extends Walker_CategoryDropdown {
	/**
	 * Start the element output.
	 *
	 * @see Walker_CategoryDropdown::start_el()
	 * @since 1.0
	 *
	 * @param string $output
	 * @param object $category
	 * @param int    $depth
	 * @param array  $args
	 * @param int    $id
	 */
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		$pad = str_repeat( '&nbsp;', $depth * 3 );

		$cat_name       = apply_filters( 'list_cats', $category->name, $category );
		$data_permalink = get_term_link( $category->slug, nice_portfolio_category_name() );

		if ( isset( $args['value_field'] ) && isset( $category->{$args['value_field']} ) ) {
			$value_field = $args['value_field'];
		} else {
			$value_field = 'term_id';
		}

		$output .= "\t" . '<option class="level-' . $depth . '" value="' . esc_attr( $category->{$value_field} ) . '" data-permalink="' . $data_permalink . '"';

		if ( $category->{$value_field} == $args['selected'] ) {
			$output .= ' selected="selected"';
		}

		$output .= '>';

		$output .= $pad.$cat_name;

		if ( $args['show_count'] ) {
			$output .= '&nbsp;&nbsp;('. number_format_i18n( $category->count ) .')';
		}

		$output .= "</option>\n";
	}
}
endif;
