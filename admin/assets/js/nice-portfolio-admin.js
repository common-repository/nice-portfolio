/**
 * Nice Portfolio by NiceThemes
 *
 * @package Nice_Portfolio
 * @license GPL-2.0+
 */

/**
 * Manage interactions for post editor elements.
 *
 * @since   1.0
 * @package Nice_Portfolio
 */
var NicePortfolioAdmin = ( function( $ ) {
	// Tell browsers we're not doing anything silly.
	'use strict';

	/**
	 * Implement media uploader and image preview for form elements.
	 *
	 * @since 1.0
	 */
	var handleUploader = function() {
		// Show modal box for uploads.
		if ( nice_portfolio_vars.wp_version >= '3.5' ) {
			// WP 3.5+ uploader.
			var file_frame;

			window.formfield = '';
				$( 'body' ).on( 'click', '.nice_portfolio_upload_button', function( e ) {
				e.preventDefault();

				var button = $( this );

				window.formfield = $( this ).parent().prev();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media( {
					title: nice_portfolio_vars.add_to_gallery,
					button: { text: nice_portfolio_vars.add_to_gallery_button },
					library: { type: button.data( 'library' ) ? button.data( 'library' ) : '' },
					multiple: true
				} );

				// When images are selected, run a callback.
				file_frame.on( 'select', function () {
					var selection = file_frame.state().get( 'selection'),
						image_content;

					// Remove clear element.
					$( '.nice-portfolio-gallery-placeholder .clear').remove();

					// Build HTML for the selected images.
					selection.each( function ( attachment, index ) {
						attachment = attachment.toJSON();
						var image_url = ( 'undefined' != typeof attachment.sizes.thumbnail ) ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
						window.formfield.val( attachment.url );
						image_content = '<li class="image-container" data-attachment-name="' + attachment.name + '">';
						image_content += '<img src="' + image_url + '" alt="" />';
						image_content += '<ul class="actions">';
						image_content += '<li><a href="#" class="remove nice_upload_' + attachment.id + '">' + nice_portfolio_vars.remove_text + '</a></li>';
						image_content += '<li><a href="' + attachment.editLink + '" class="edit nice_upload_' + attachment.id + '">' + nice_portfolio_vars.edit_text + '</a></li>';
						image_content += '</ul>';
						image_content += '</li>';

						// Add HTML at the end of the list.
						$( '.nice-portfolio-gallery-placeholder' ).append( image_content );
					} );

					// Add clear element again.
					$( '.nice-portfolio-gallery-placeholder' ).append( '<div class="clear"></div>' );

					updateGallery();

				} );

				// Finally, open the modal.
				file_frame.open();
			} );
		}
	},

	/**
	 * Remove image from gallery.
	 */
	handleRemoval = function() {
		$( 'body' ).on( 'click', '.remove', function( e ) {
			e.preventDefault();
			$( e.target ).closest( '.image-container' ).remove();
			updateGallery();
		} );
	},

	/**
	 * Sort order or elements.
	 */
	handleSorting = function() {
		var placeholder = $( '.nice-portfolio-gallery-placeholder' );
		placeholder.sortable( {
			stop: function() {
				updateGallery();
			}
		} );
		placeholder.disableSelection();
	},

	/**
	 * Update gallery with current IDs.
	 */
	updateGallery = function() {
		var names = [];

		$( '.image-container' ).each( function() {
			names.push( $( this ).attr( 'data-attachment-name' ) );
		} );

		$( 'input[name="_project_gallery"]').val( names.join() );
	},

	/**
	 * Fire events on document ready, and bind other events.
	 *
	 * @since 1.0
	 */
	ready = function() {
		handleUploader();
		handleRemoval();
		handleSorting();
	};

	// Expose the ready function to the world.
	return {
		ready: ready
	};

} )( jQuery );

jQuery( NicePortfolioAdmin.ready );
