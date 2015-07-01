/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
	
	function hextorgb(hex, opacity) {
	    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	    result = result ? {
	        r: parseInt(result[1], 16),
	        g: parseInt(result[2], 16),
	        b: parseInt(result[3], 16)
	    } : null;
	    
	    opacity = opacity ? opacity : 1;
	    
	    return 'rgba( '+ result.r +' , '+ result.g +' , '+ result.b +' , '+ opacity +' )';
	}

	// Background Color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) { console.log(newval);
			$('#main-nav').css('background-color', newval );
			$('#site').css('background-color', newval );
		} );
	} );
	
	// Link Color
	wp.customize( 'link_color', function( value ) {
		value.bind( function( newval ) {
			$('#main-nav li:not(.current-menu-item) a, #content a:not(.btn-primary), h1, h2, h3, h4, h6, blockquote p, .pullquote, .page-title, .btn.btn-link, .btn.btn-default, .panel-default > .panel-heading .accordion-toggle.collapsed, #footer a:hover, #footer .widget-title, .owl-theme .owl-controls .owl-nav [class*=owl-], #search-form .close-search, .sidebar-widget h5, #custom-search-form, .room.dark h4').css('color', newval );
			$('.embed-responsive').css('border-color', newval );
			$('#header, .fa-boxed:not(.fa-facebook, .fa-twitter, .fa-rss, .fa-pinterest)').css( 'background-color', newval );
			$('#main-nav .menu > .menu-item:not(.current-menu-item):hover > a, .btn.btn-default').css( 'border-color', hextorgb( newval, 0.5 ) );
			$('.btn.btn-default:hover, .services-carousel .item:hover .item-content, .pricing-table .content-column').css( 'background-color', hextorgb( newval, 0.1 ) );
		} );
	} );
	
	// Text Color
	wp.customize( 'text_color', function( value ) {
		value.bind( function( newval ) {
			$('html, body, a:hover, h1 small, h2 small, h3 small, h4 small, h5 small, h6 small, .btn.btn-link:hover, #site, #main-nav, #map-description .col-lg-4 > div, .panel-default > .panel-heading .accordion-toggle.collapsed:hover, #goog-wm-qt, #main-nav .sub-menu .menu-item:hover > a, .form-control, #footer, #footer a').css('color', newval );
			$('.panel.panel-default, #goog-wm-qt, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, #isotope .item-content, .nav-tabs > li > a, .tab-pane, .nav-tabs, .form-control').css( 'border-color' , hextorgb( newval, 0.25 ) );
			$('.panel-default > .panel-heading .accordion-toggle.collapsed, #main-nav .sub-menu .menu-item:hover > a, #isotope .item:hover .item-content, .nav-tabs > li > a, .nav-tabs > li > a:hover').css( 'background-color' , hextorgb( newval, 0.25 ) );
			$('.pullquote.pull-left').css( 'border-right', '3px solid '+hextorgb( newval, 0.25 ) );
			$('.pullquote.pull-right').css( 'border-left', '3px solid '+hextorgb( newval, 0.25 ) );
			$('#search-form-inline').css( 'border-top', '1px solid '+hextorgb( newval, 0.25 ) );
			$('.comments > ul > li > ul').css( 'border-left', '1px solid '+hextorgb( newval, 0.25 ) );
			$('.comments h6').css( 'border-bottom', '1px solid '+hextorgb( newval, 0.25 ) );
			$('.form-control:focus').css( 'border-color', hextorgb( newval, 0.65 ) );
			$('#main-footer + #absolute-footer .widget').css( 'border-color', hextorgb( newval, 0.1 ) );
		} );
	} );
	
	// Primary Color
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( newval ) {
			$('#main-nav .menu > .current-menu-item > a, .btn.btn-link:hover::before').css('color', newval ).css('border-top-color', newval );
			$('#main-nav .sub-menu, .btn.btn-primary:hover').css('color', newval ).css('border-color', newval );
			$('h5:not(.widget-title)').css('color', newval );
			$('blockquote').css('color', newval );
			$('.list-bullet li::before, .list-square li::before, .list-center li::before, .list-center li::after').css('color', newval );
			$('.list-pointer li::before').css('border-color', 'transparent transparent transparent' + newval );
			$('.btn.btn-primary, #commentform input[type="submit"]').css('background-color', newval ).css('border-color', newval );
			$('.btn.btn-link::before').css('color', newval );
			$('.panel-default > .panel-heading .accordion-toggle').css('color', newval );
			$('.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus').css('color', newval );
			$('.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span').css('color', newval );
			$('.owl-theme .owl-controls .owl-nav .owl-next:after, .owl-theme .owl-controls .owl-nav .owl-prev:before').css('color', newval );
			$('.form-group[data-required]::before, div[data-required]::before').css('color', newval );
			$('#goog-wm-sb').css('background', newval ).css('border-color', newval );
			$('.entry h1 > small, .entry h2 > small, .entry h3 > small, .entry.quote blockquote > small').css('color', newval );
			$('.meta .fa').css('color', newval );
			$('.comments .comment-author h6').css('border-bottom-color', newval );
			$('#main-nav .menu > .current-menu-item > a, #main-nav .menu > .current-menu-ancestor > a, #main-nav .sub-menu, h5:not(.widget-title), blockquote, .list-bullet li::before, .list-square li::before, .list-center li::before, .list-center li::after, .btn.btn-link::before, .panel-default > .panel-heading .accordion-toggle, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span, .owl-theme .owl-controls .owl-nav .owl-next:after, .owl-theme .owl-controls .owl-nav .owl-prev:before, .form-group[data-required]::before, div[data-required]::before, .entry h1 > small, .entry h2 > small, .entry h3 > small, .entry.quote blockquote > small, .meta .fa, .list-center li::before, .list-center li::after, hr').css( 'color', newval );
			$('#main-nav .menu > .current-menu-item > a, #main-nav .menu > .current-menu-ancestor > a, #main-nav .sub-menu').css( 'border-color', newval );
		} );
	} );
	
	// Footer Columns
	wp.customize( 'footer_columns', function( value ) {
		value.bind( function( newval ) {
			
			var css = null;
			
			switch ( newval ) {
				case '1' : css = 'col-sm-12 col-md-12'; break;
				case '2' : css = 'col-sm-6 col-md-6'; break;
				case '3' : css = 'col-sm-4 col-md-4'; break;
				case '4' : css = 'col-sm-4 col-md-3'; break;
				case '6' : css = 'col-sm-4 col-md-2'; break;
			}
			$('#main-footer > aside').each(function () {
				$(this)
					.removeClass('col-sm-2 col-sm-3 col-sm-4 col-sm-6 col-sm-12 col-md-2 col-md-3 col-md-4 col-md-6 col-md-12 col-lg-2 col-lg-3 col-lg-4 col-lg-6 col-lg-12')
					.addClass(css);
			});
		} );
	} );
	
	// Copyright
	wp.customize( 'footer_copyright', function( value ) {
		value.bind( function( newval ) {
			if ( newval === 0 ) {
				$('#absolute-footer').hide();
			} else {
				$('#absolute-footer').show();
				$('.widget > p', '#absolute-footer').html( newval );
			}
		} );
	} );
	
	// Header Color
	wp.customize( 'header_bg_color', function( value ) {
		value.bind( function( newval ) {
			$('#header').css( 'background-color', newval );
		} );
	} );
	
} )( jQuery );