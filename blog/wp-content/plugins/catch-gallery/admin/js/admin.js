(function( $ ) {
	'use strict';
	$(function() {
		// Tabs
		$('.catch_widget_settings .nav-tab-wrapper a').on('click', function(e){
			e.preventDefault();

			if( !$(this).hasClass('ui-state-active') ){
				$('.nav-tab').removeClass('nav-tab-active');

				$('.wpcatchtab').removeClass('active').fadeOut(0);

				$(this).addClass('nav-tab-active');

				var anchorAttr = $(this).attr('href');

				$(anchorAttr).addClass('active').fadeOut(0).fadeIn(500);
			}

		});
	});

	// jQuery Match Height init for sidebar spots
    $(document).ready(function() {
        $('.catch-sidebar-spot .sidebar-spot-inner, .col-2 .catch-lists li, .col-3 .catch-lists li, .catch-modules').matchHeight();
    });
})( jQuery );
