( function( $ ) {
	
	/** Start Masonry */
	$( document ).ready(function() {
		
		$('#gridly').sortable({
			placeholder: "ui-state-highlight",
			start: function( event, ui ) {
				if ( $( '.inner' , ui.placeholder ).length === 0 ) {
					$(ui.placeholder).append('<div class="inner"></div>');
				}
				$( ui.placeholder ).width( $( ui.item ).width() );
			}
	    });
	    $('#gridly').disableSelection();
		
		$('.size').on('change', function () {
			var css = null;
			
			switch ( $(this).val() ) {
				case '2' : css = 'col_1_2'; break;
				case '3' : css = 'col_1_3'; break;
				case '4' : css = 'col_1_4'; break;
				case '5' : css = 'col_2_3'; break;
				case '6' : css = 'col_2_4'; break;
				case '7' : css = 'col_3_4'; break;
			}
			
			$(this).siblings('input[type=hidden]').val( $(this).val() );
			$(this).parent().parent().removeClass('col_1_2 col_1_3 col_1_4 col_2_3 col_2_4 col_3_4').addClass( css );
			
		});
		
	});
	
	
	
} )( jQuery );