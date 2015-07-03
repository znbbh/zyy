(function ($) {
    "use strict";

	/** Define Mobile Enviroment */
	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};

  	/** Main Navigation Dropdown */
  	$('#header .menu > ul, #header .menu-container > ul, #header #secondary-nav .menu').dropdown_menu();
	
	/** Secondary Navigation Submenu Background */
	$('#secondary-nav .sub-menu').each(function () {
		if ( $(this).parent().attr("data-background") ) {
			$(this).css('background-image', 'url('+$(this).parent().data("background")+')');
		}
	});
	
	/** Secondary Navigation */
	var menu_items = $('.menu:first-of-type > .menu-item', '#secondary-nav').length;
	$('.menu:first-of-type > .menu-item', '#secondary-nav').each(function () {
		$(this).css( 'width', 100 / menu_items + '%' );
	});
	

  	/** Mobile Menu */
  	if( isMobile.any() ){
  		$( '.menu li:has(ul)' ).doubleTapToGo();
  	}
  	
  	/** Main Navigation Sticky */
  	if ( !isMobile.any() && data.sticky_menu ) {
  		$('#main-nav').waypoint('sticky', {
  			handler : function (direction) {
  				if ( direction === "down" ) {
  					var offset = $('#site').offset();
  					$('#main-nav').css('left', offset.left );
  				} else {
  					$('#main-nav').css('left', 0 );
  				}
  				
  			},
  			offset : - $('#header').outerHeight(),
  			stuckClass: 'stuck',
  		});
  	}
  	
  	/** Services Carousel */
  	if ( $(".services-carousel").length > 0 ) {
  		$(".services-carousel").owlCarousel({
  			items				: 4,
  			margin				: 20,
  			loop 				: true,
  			autoplay 			: true,
  			autoplayTimeout		: 2000,
  			autoplayHoverPause	: true,
  			responsive			: {
  				0 : {
  					items 	: 1,
  					dots	: true
  				},
  				767 : {
  					items 	: 2,
  					dots	: false
  				},
  				992 : {
  					items 	: 3,
  					dots	: false
  				},
  				1200 : {
  					items 	: 4,
  					dots	: false
  				}
  			}
  		});
  	}
  	
  	/** Gallery Carousel */
  	if ( $('.gallery-carousel').length > 0 ) {
  		$(".gallery-carousel").owlCarousel({
  			items				: 1,
  			nav					: true,
  			stagePadding		: 0,
  			margin				: 0,
  			dots				: true,
  			loop 				: true
  		});
  	}
  	
  	/** Content Carousel */
  	if ( $('.content-carousel').length > 0 ) {
  		$(".content-carousel").owlCarousel({
  			items				: 1,
  			nav					: false,
  			loop 				: false,
  			dots				: false,
  			URLhashListener		: true,
  			autoplay 			: false,
  			autoplayTimeout		: 2000,
  			autoplayHoverPause	: true
  		});
  	}
  	
  	/** Stellar */  	
  	if( ! isMobile.any() && $('.parallax-container, .parallax, .parallax-image, div[data-stellar-background-ratio]').length > 0 ){
  		$.stellar({
  			horizontalScrolling: false,
  			parallaxBackgrounds: true,
  			hideDistantElements: false
  		});
  	}
  	
  	/** Coming Soon */
  	if ( $('#coming-soon').length > 0 ) {
  		$('#coming-soon').css( 'margin-top', - ( $('#coming-soon').outerHeight() / 2 ) );
  	}
  	
  	/** Nice Self Scroll */
  	$('a[target="_self"]').on('click', function (e) {
  		e.preventDefault();
  		var target = $(this).attr('href');
  		$(target).velocity("scroll", { duration: 1000, easing: "easeOutCubic", offset: -( $('#main-nav').outerHeight() + 30 ) });
  	});
  	
  	/** Lightbox */
  	if ( $('a[rel="lightbox"]').length > 0 ) {
  		$(function () {
  		    $('a[rel="lightbox"]').boxer({
  		        fixed: true
  		    });
  		});
  	}
  	
  	/** Search Form */
  	$('.search-button').on('click', function (e) {
  		e.preventDefault();
  		
		$('#search-form').velocity('fadeIn');
		$('#search-form .search-field').focus();
  		
  		$('#main-nav').mouseleave(function () {
  			$('#search-form').velocity('fadeOut');
  		});
  	});
  	
  	$('.close-search').on('click', function (e) {
  		e.preventDefault();
  		
  		$('#search-form').velocity('fadeOut');
  	});
  	
  	/** Tooltips */
  	$("[data-toggle='tooltip']").tooltip();
  	
  	/** Animations */
  	if ( $('.animated').length > 0 && ! isMobile.any() && data.animations !== 'true' ) {
  		$('.animated').waypoint(function() {
  			var target = $(this);
  			if ( ! target.hasClass( 'animated_off' ) ) {
  				$(target).delay(150).velocity("transition.fadeIn");
  				target.addClass( 'animated_off' );
  			}
  		},{
  			offset: $.waypoints('viewportHeight')
  		});
  	} else {
  		$('.animated').css('opacity', 1);
  	}
  	if ( $('.animated-children').length > 0 && ! isMobile.any() && data.animations !== 'true' ) {
  		$('.animated-children').waypoint(function() {
  			var target = $(this);
  			if ( ! target.hasClass( 'animated_off' ) ) {
  				$('[class*="col-"]', target).children().velocity("transition.fadeIn", { stagger: 100 });
  				target.addClass( 'animated_off' );
  			}
  		},{
  			offset: $.waypoints('viewportHeight')
  		});
  	} else {
  		$('[class*="col-"]', '.animated-children').css( 'opacity', 1 );
  	}
  	if ( ! isMobile.any() && data.animations !== 'true' ) {
  		$('#footer').waypoint(function() {
  			if ( ! $('#footer').hasClass( 'animated_off' ) ) {
  				$('aside', '#footer').delay(75).velocity("transition.fadeIn", { drag: true, stagger: 75 });
  				$('#footer').addClass( 'animated_off' );
  			}
  		},{
  			offset: $.waypoints('viewportHeight')
  		});
  	} else {
  		$('aside', '#footer').css( 'opacity', 1 );
  	}
  	
  	/** Mobile Navigation */
  	if ( isMobile.any() ) {
  		$('#toggle-secondary-nav').change(function () {
  			if ( $(this).is(':checked') ){
  				$('#toggle-main-nav').prop('checked', false);
  			}
  		});
  		$('#toggle-main-nav').change(function () {
  			if ( $(this).is(':checked') ){
  				$('#toggle-secondary-nav').prop('checked', false);
  			}
  		});
  	}
  	
  	/** Gallery Isotope */
  	$(function() {
  	    if ( $('.gallery').length > 0 ) {
  	    	var $container = $('.gallery');
  	    	$container.isotope({
  	    		layoutMode: 'fitRows',
  	    		itemSelector: '.gallery-item'
  	    	});
  	    	$container.imagesLoaded( function() {
				$container.isotope('layout');
  	    	});
  	    	$('img[class*=attachment-]', $container).tooltip({
  	    		title : function () {
  	    			return $(this).attr('alt');
  	    		}
  	    	});
  	    }
  	});
  	
})(jQuery);
