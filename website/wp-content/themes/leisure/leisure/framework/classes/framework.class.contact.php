<?php 

class CurlyThemesContact {
	
	public function __construct() {
		
		// Contact Form - Send Mail
		add_action( 'wp_ajax_contact_form_sender', array( $this, 'form_sender') );
		add_action( 'wp_ajax_nopriv_contact_form_sender', array( $this, 'form_sender') );
	}
	
	// Side Content
	public function side( $side ) {
		if (function_exists('curly_shortcode_sanitizer')) {
			echo do_shortcode( curly_shortcode_sanitizer( wpautop( $side ) ) );
		} else {
			echo do_shortcode( wpautop( $side ) );
		}
	}
	
	// Generate Map
	public function map( $latitude, $longitude, $height, $map_type, $zoom ) {
		
		// Enqueue Map Scripts
		if( ! wp_script_is('curly-google-maps') ) { 
			wp_enqueue_script('curly-google-maps');
		}
		if( ! wp_script_is('curly-gmap3') ) { 
			wp_enqueue_script('curly-gmap3');
		}
	
		$html  = '<div id="map-container"></div>';
		$html .= '<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery("#map-container").width("100%").height("100%").gmap3({
							map:{
								options:{
										center: ['.$latitude.','.$longitude.'],
										zoom: '.$zoom.',
										disableDefaultUI: true,
										draggable: false,
										mapTypeId: google.maps.MapTypeId.'.strtoupper($map_type).',
										mapTypeControl: false,
										mapTypeControlOptions: {},
										navigationControl: false,
										scrollwheel: false,
										streetViewControl: false,
										styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}]
								}
							},
							marker:{
								latLng: ['.$latitude.','.$longitude.']
							}
						});
					});	
					</script>';
		
		echo $html;
	}
}

$curly_contact = new CurlyThemesContact();

?>