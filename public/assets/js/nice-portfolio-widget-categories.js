/**
 * Nice Portfolio by NiceThemes
 *
 * @package Nice_Portfolio
 * @license GPL-2.0+
 */

/**
 * Handle interactions with Portfolio Categories widget.
 *
 * @since   1.0
 * @package Nice_Portfolio
 */
var NicePortfolioCategoryWidget = ( function( $ ) {
	// Tell browsers we're not doing anything silly.
	'use strict';

	/**
	 * Redirect to the category page when an item in the dropdown gets clicked.
	 *
	 * @since 1.0
	 */
	var handleSwitching = function() {
		$( '.portfolio-widget-categories-select' ).change( function() {
			var permalink = $( this ).find( 'option:selected' ).attr( 'data-permalink' );

			if ( permalink ) {
				window.location = permalink;
			}
		} );
	},

    /**
     * Fire events on document ready, and bind other events.
     *
     * @since 1.0
     */
	ready = function() {
		handleSwitching();
	};

	// Expose the ready function to the world.
	return {
		ready: ready
	}
		;
} )( jQuery );

jQuery( NicePortfolioCategoryWidget.ready );
