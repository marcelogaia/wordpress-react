(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	jQuery(document).ready(function ($) {

		$(document).on( "click", ".upload-media-button", function (e) {
		  e.preventDefault();
		  var $button = $(this);

		  // Create the media frame.
		  var file_frame = wp.media.frames.file_frame = wp.media({
		     title: 'Select or upload media',
		     button: {
		        text: 'Select'
		     },
		     multiple: false  // Set to true to allow multiple files to be selected
		  });

		  // When an image is selected, run a callback.
		  file_frame.on('select', function () {
		     // We set multiple to false so only get one image from the uploader

		     var attachment = file_frame.state().get('selection').first().toJSON();

		     $button.siblings('input').val(attachment.url);
		     $button.siblings('span.image-holder').html('<img src="' + attachment.url + '">');
		  });

		  // Finally, open the modal
		  file_frame.open();
		});

		$('.image-url').each(function(){
		   $(this).on('keyup', function(){
		   		$(this).siblings('span.image-holder').html('<img src="' + $(this).val() + '">');
		   });
		});


		/* Show More event */
		$('.more').on('click', function() {
		    $(this).next('div.advanced-section').toggle();
		});

		$(".more").toggle(function() {
		    $(this).html('Hide Options<i class="dashicons dashicons-arrow-up"></i>')
		        .stop();
		}, function() {
		    $(this).html('More Options<i class="dashicons dashicons-arrow-down"></i>')
		        .stop();
		});

		$(document).on('widget-added', function(e, widget) {
			/* Show More event */
			$('.more').on('click', function() {
			    $(this).next('div.advanced-section').toggle();
			});

			$(".more").toggle(function() {
			    $(this).html('Hide Options<i class="dashicons dashicons-arrow-up"></i>')
			        .stop();
			}, function() {
			    $(this).html('More Options<i class="dashicons dashicons-arrow-down"></i>')
			        .stop();
			});
		});

		$(document).on('widget-updated', function(e, widget) {
			/* Show More event */
			$('.more').on('click', function() {
			    $(this).next('div.advanced-section').toggle();
			});

			$(".more").toggle(function() {
			    $(this).html('Hide Options<i class="dashicons dashicons-arrow-up"></i>')
			        .stop();
			}, function() {
			    $(this).html('More Options<i class="dashicons dashicons-arrow-down"></i>')
			        .stop();
			});
		});

	});

})( jQuery );
