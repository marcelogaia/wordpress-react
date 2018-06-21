(function($) {
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

    $(function() {
        var welcomePanel = $( '#welcome-panel' );
        var updateWelcomePanel;

        updateWelcomePanel = function( visible ) {
            $.post( ajaxurl, {
                action: 'catch_instagram_feed_gallery_widget_update_welcome_panel',
                visible: visible,
                welcomenonce: $( '#catch-instagram-feed-gallery-widget-welcome-nonce' ).val()
            } );
        };

        $( 'a.welcome-panel-close', welcomePanel ).click( function( event ) {
            event.preventDefault();
            welcomePanel.addClass( 'hidden' );
            updateWelcomePanel( 0 );
        } );

        // Tabs
        $('.catchp_widget_settings .nav-tab-wrapper a').on('click', function(e){
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
        $('.catchp-sidebar-spot .sidebar-spot-inner, .col-2 .catchp-lists li, .col-3 .catchp-lists li').matchHeight();
    });

})(jQuery);