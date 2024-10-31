/**
 * Nice Portfolio by NiceThemes
 *
 * @package Nice_Portfolio
 * @license GPL-2.0+
 */

/**
 * Manage Masonry implementation.
 *
 * @since   1.0
 * @package Nice_Portfolio
 */
var NicePortfolio = ( function( $ ) {
	// Tell browsers we're not doing anything silly.
	'use strict';

	/**
	 * Manage filtering of terms.
	 *
	 * @since 1.0
	 */
	var handleTermFilter = function() {
		if ( ! window.NicePortfolioVars.useTermFilter ) {
			return;
		}

		var grids = $( '.nice-portfolio.grid.filterable' );

		grids.each( function( i ) {
			var grid    = $( this ),
			    trigger = getFilters( i );

			trigger.click( function( e ) {
				e.preventDefault();

				// Store name of class to show.
				var category = $( this ).attr( 'data-class' ),
				    items    = grid.find( '.item' ),
				    columns  = grid.data( 'columns' );

				// Set clicked button to active state.
				trigger.removeClass( 'active' );
				$( this ).addClass( 'active' );

				// Show elements with obtained class.
				if ( '.item' !== category ) {
					items.hide().each( function() {
						if ( $( this ).hasClass( category.substr( 1 ) ) ) {
							$( this ).show();
						}
					} );

				} else {
					items.show();
				}

				// Mark all items as filtered.
				items.addClass( 'filtered' ).removeClass( 'first' );

				// Set special classes for visible items.
				items.filter( ':visible' ).each( function( i ) {
					var modulus = ( i + 1 ) % ( columns + 1 );
					if ( modulus === 0 ) {
						$( this ).addClass( 'first' );
					}
				} );
			} );
		} );
	},

    /**
     * Obtain list of filters by grid.
     *
     * @returns {Array}
     */
    getFilters = function( i ) {
	    return $( $.makeArray( $( '.nice-portfolio-filter' ) )[ i ] ).find( 'a.filter' );
    },

	/**
	 * Implement Fancybox in single project gallery.
	 *
	 * @since 1.0
	 */
	handleGallery = function() {
		// Not implemented yet.
	},

	/**
	 * Fire events on document ready, and bind other events.
	 *
	 * @since 1.0
	 */
	ready = function() {
		handleTermFilter();
		handleGallery();
	};

	// Expose the ready function to the world.
	return {
		ready: ready
	};

} )( jQuery );

jQuery( NicePortfolio.ready );
