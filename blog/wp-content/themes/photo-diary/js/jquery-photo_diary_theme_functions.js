jQuery(document).ready(function($) {
	
	// Toggle Nav on mobile
	var mainNav = $('.main-nav');
	var navIcon = $('.main-nav-icon');
	var MENU_OPEN = false;
	var itemWithChildren = mainNav.find('.menu-item-has-children');
	var tabletUp = 1159;

	itemWithChildren.append('<span class="toggle-child-items fa fa-angle-down"></span>');
	var toggleChildItems = $('.toggle-child-items');

	navIcon.stop().click(function() {
		if(MENU_OPEN == false) {
			MENU_OPEN = true;
			navIcon.addClass('is-active');
			mainNav.slideToggle();

			itemWithChildren.off();
			toggleChildItems.stop().click(function(e) {
				$(this).siblings('.sub-menu').first().slideToggle();
			});
		} else {
			MENU_OPEN = false;
			navIcon.removeClass('is-active');
			mainNav.slideToggle();	
			itemWithChildren.hover(function(e) {
				$(this).find('.sub-menu').first().slideToggle();
			});
		}
	});

	itemWithChildren.hover(function(e) {
		$(this).find('.sub-menu').first().slideToggle();
	});

	$(window).resize(function() {
	 var width = $(window).width();
	if(width > tabletUp && mainNav.is(':hidden')) { 
		mainNav.removeAttr('style');
		itemWithChildren.find('.sub-menu').removeAttr('style');
		} 
	});


	// Featured Overlay Thumbnails in Posts
	$('.entry-content figure').not('.gallery-item').wrap('<p></p>');	
	var featuredThumbnail = $('img.size-photo-diary-featured-overlay');
	featuredThumbnail.parents('p').addClass('img-featured-overlay');

	 // Search Animation with Overlay
	var search = $('#search');
	var searchIcon = $('.search-icon');
	var searchInput = $('.search-input');
	var searchOverlay = $('.search-overlay');
	var SEARCH_OPEN = false;

	searchIcon.stop().click(function() {

		var infobar = $('.info-bar');
		var fromTop = infobar.css('height');

		var nav = $('.nav-bar');
		var navheight = nav.css('height');

		var overlayTop = parseInt(fromTop) + parseInt(navheight);
		
		searchInput.css({'top': fromTop, 'height' : navheight});

		if(SEARCH_OPEN == false) {
			SEARCH_OPEN = true;
			searchInput.slideToggle(function() {
				searchOverlay.slideToggle();
				searchOverlay.css({'top': overlayTop});
			});
			searchIcon.removeClass('fa-search');
			searchIcon.addClass('fa-times');
		} else {
			SEARCH_OPEN = false;
				searchOverlay.slideToggle(function() {
					searchOverlay.removeAttr('style');
					searchInput.slideToggle();
					searchIcon.removeClass('fa-times');
					searchIcon.addClass('fa-search');
			});
		}
	
	});

	// Close the search-overlay when click on .search-overlay
	searchOverlay.stop().click(function() {
		if(SEARCH_OPEN == true) {
			SEARCH_OPEN = false;
				searchOverlay.slideToggle(function() {
					searchOverlay.removeAttr('style');
					searchInput.slideToggle();
					searchIcon.removeClass('fa-times');
					searchIcon.addClass('fa-search');
			});
		}
	});

											
});