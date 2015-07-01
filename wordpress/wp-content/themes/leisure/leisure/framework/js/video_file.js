( function( $ ) {

	$('.vc_upload_video').on('click', function (e) {
		e.preventDefault();
		
		var el = $(this).parent();
		var button = $(this);
		var uploader = wp.media({
			title : button.data('upload-title'),
			button : {
				text : button.data('upload-button')
			},
			multiple : false
		})
		.on('select', function () {
			var selection = uploader.state().get('selection');
			var attachment = selection.first().toJSON();
			$('input[type=text]', el).val(attachment.url);
		})
		.open();
		
	});
	
	$('.vc_clear_video').on('click', function (e) {
		e.preventDefault();
		
		var el = $(this).parent();
		$('input[type=text]', el).val('');
		
	});

} )( jQuery );