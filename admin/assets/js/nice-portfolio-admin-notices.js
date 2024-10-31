/**
 * Nice Portfolio by NiceThemes
 *
 * @package Nice_Portfolio
 * @license GPL-2.0+
 */

/**
 * Handle admin notices.
 *
 * @since   1.0
 * @package Nice_Portfolio
 */
var NicePortfolioAdminNotices = ( function( $ ) {
	// Tell browsers we're not doing anything silly.
	'use strict';

	/**
	 * Make an AJAX call when dismissing the admin settings notice.
	 */
	var dismissNotice = function() {
		var notice = $( '#nice_portfolio_admin_update_notice.is-dismissible' );

		var nice_ajax_settings = {
			action: 'nice_portfolio_admin_dismiss_update_notice',
			url:    nice_portfolio_admin_notices_vars.ajax_url,
			nonce:  nice_portfolio_admin_notices_vars.nonce
		};

		notice.on('click', '.notice-dismiss', function ( event ) {
			event.preventDefault();

			$.post( nice_portfolio_admin_notices_vars.ajax_url, nice_ajax_settings );
		});

		notice.on('click', '.nice-notice-dismiss', function ( event ) {
			notice.fadeTo( 100, 0, function() {
				notice.slideUp( 100, function() {
					notice.remove();
				});
			});

			$.post( nice_portfolio_admin_notices_vars.ajax_url, nice_ajax_settings );
		});
	},

	/**
	 * Fire events on document ready, and bind other events.
	 *
	 * @since 1.0
	 */
	ready = function() {
		dismissNotice();
	};

	// Expose the ready function to the world.
	return {
		ready: ready
	};

} )( jQuery );

jQuery( NicePortfolioAdminNotices.ready );
