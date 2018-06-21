
jQuery(document).ready(function($){

	$('.header-r .head-search-form').hide();
	$('.header-r .header-search > .fa').click(function(e){
		$(this).siblings('.head-search-form').slideToggle();
		e.stopPropagation();
	});
	$('.header-r .head-search-form').click(function(e){
		e.stopPropagation();
	});

	$(window).click(function(){
		$('.head-search-form').slideUp();
	});

	$('.site-header .header-r .fa.fa-bars').click(function(e){
		$('body').addClass('menu-toggled');
		e.stopPropagation();
	});
	$('.site-header .header-r .menu-wrap').click(function(e){
		e.stopPropagation();
	});
	$(window).click(function(e){
		$('body').removeClass('menu-toggled');
	});

	$('.site-header .main-navigation .toggle-button').click(function(){
		$('body').removeClass('menu-toggled');
	});

	$('.main-navigation ul li.menu-item-has-children').append('<span class="fa fa-angle-down"></span>');
	$('.main-navigation ul li ul').hide();
	$('.main-navigation ul li .fa').on('click', function(){
		$(this).siblings('ul').slideToggle();
	});

	var winWidth = $(window).width();
	$(window).scroll(function(){
		if($(this).scrollTop() > 200) {
			$('.back-to-top').addClass('show');
		}
		else{
			$('.back-to-top').removeClass('show');
		}
	});

	$('.back-to-top').click(function(){
		$('html, body').animate({
			scrollTop:0
		}, 1000);
	});

	if( $('.widget_rrtc_description_widget').length ){
        $('.description').each(function(){ 
            var psw = new PerfectScrollbar('.widget_rrtc_description_widget .rtc-team-holder-modal .text-holder .description');
        });
    }

    if( $('.header-r .menu-wrap').length ){
		var psw = new PerfectScrollbar('.menu-wrap'); 
	}

	$(".gallery-section.style3 .gallery-wrap").owlCarousel({
		center: true,
		items:3,
		loop:true,
		margin:25,
		autoWidth: true,
		dots: false,
		nav: true,
		autoplay: false,
	});

	$(".gal-carousel .gallery-wrap").owlCarousel({
		center: true,
		items:3,
		loop:true,
		margin:25,
		autoWidth: true,
		dots: false,
		nav: true,
		autoplay: true,
	});

	$(".slider .test-wrap").owlCarousel({
		center: true,
		//items:5,
		loop:true,
		margin:25,
		autoWidth: false,
		dots: false,
		nav: true,
		autoplay: false,
		responsive: {
			801: {
				items:5,
			},
			641: {
				items:3,
			},
			640: {
				items:1,
			}, 
			0: {
				items:1,
			}
		}
	});

	$("ul.slider").owlCarousel({
		items:1,
		loop:true,
		autoWidth: false,
		dots: false,
		nav: true,
		autoplay: true,
	});

	$('.slider .owl-item .test-content').each(function(){;
		var testContentHeight = $(this).height();
		if(winWidth >=641) {
			$(this).parent('.test-block').css('padding-bottom', testContentHeight);
		}
	})
	var $grid = $('.article-wrap.grid').imagesLoaded( function() {
		  $grid.isotope({
		    itemSelector: '.post',
		    percentPosition: true,
		    gutter: 10,
		    masonry: {
		      columnWidth: '.grid-sizer'
		    }
		  });
		});

		// init Isotope
		var $grid1 = $('.gallery-section:not(.style3) .gallery-wrap').imagesLoaded(function(){
			$grid1.isotope({
				itemSelector: '.gallery-img',
			});	
		});

		var $innergrid = $('body.page-template-portfolio:not(.gal-carousel) .site-main .gallery-wrap').imagesLoaded(function(){
			$innergrid.isotope({
				itemSelector: '.gallery-img',
			});	
		});

	// filter items on button click
	$('.filter-button-group').on('click', 'button', function() {
		var filterValue = $(this).attr('data-filter');
		$grid1.isotope({ filter: filterValue });
		$innergrid.isotope({ filter: filterValue });
	});
// change is-checked class on buttons
$('.button-group').each(function(i, buttonGroup) {
	var $buttonGroup = $(buttonGroup);
	$buttonGroup.on('click', 'button', function() {
		$buttonGroup.find('.is-checked').removeClass('is-checked');
		$(this).addClass('is-checked');
	});
});

}); //document close