<?php
$output = $title = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $partial_view = '';
$mode = $slides_per_view = $wrap = $autoplay = $hide_pagination_control = $hide_prev_next_buttons = $speed = '';
extract( shortcode_atts( array(
	'title' => '',
	'onclick' => 'link_image',
	'custom_links' => null,
	'custom_links_target' => null,
	'img_size' => 'thumbnail',
	'images' => '',
	'el_class' => null,
	'slides_per_view' => '1',
	'wrap' => null,
	'autoplay' => null,
	'hide_pagination_control' => null,
	'hide_prev_next_buttons' => null,
	'speed' => '5000',
	'next' => null,
	'prev' => null
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$_SESSION['curly_gallery_carousel'] = ( isset( $_SESSION['curly_gallery_carousel'] ) ) ? + 1 : 0;
$images	= isset( $images ) ? explode( ',', $images ) : null;
$links 	= isset( $custom_links ) ? explode( ',', $custom_links ) : null;
$items 	= isset( $slides_per_view ) ? $slides_per_view : 1;
$nav 	= isset( $hide_prev_next_buttons ) ? 'false' : 'true';
$dots	= isset( $hide_pagination_control ) ? 'false' : 'true';
$loop	= isset( $wrap ) ? 'true' : 'false';
$autoplay = isset( $autoplay ) ? 'true' : 'false';
$autoplay_speed = isset( $speed ) ? $speed : 5000;
$nav_text = ( isset( $next ) && isset( $prev ) ) ? '["'.$next .'","'.$prev.'"]' : '["Next", "Prev"]';

$output  = wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) );
$output .= '<div id="gallery_carousel_'.$_SESSION['curly_gallery_carousel'].'" '.( $el_class ? 'class="'.$el_class.'"' : null ).' >';
if ( is_array( $images ) ) {
	foreach ( $images as $key => $image ) {
		$output .= '<div class="item">';
		$output .= $onclick == 'link_image' ? '<a href="'.wp_get_attachment_url($image).'" rel="lightbox" title="'.get_the_title($image).'">' : null;
		$output .= $onclick == 'custom_link' ? '<a href="'.$links[$key].'" title="'.get_the_title($image).'" target="'.( isset( $custom_links_target ) ? $custom_links_target : null ).'" >' : null;
		$output .= wp_get_attachment_image( $image, 'full' );
		$output .= $onclick == 'link_image' || $onclick == 'custom_link' ? '</a>' : null;
		$output .= '</div>';
	}
}
$output .= '</div>';
$output .= "<script type='text/javascript'>( function( $ ) {
			
	$( document ).ready(function() {
	    $('#gallery_carousel_".$_SESSION['curly_gallery_carousel']."').owlCarousel({
	    	items				: {$items},
	    	margin				: 20,
	    	nav					: {$nav},
	    	navText				: {$nav_text},
	    	loop 				: {$loop},
	    	autoplay 			: {$autoplay},
	    	autoplayTimeout		: {$autoplay_speed},
	    	autoplayHoverPause	: true,
	    	lazyLoad			: true,
	    	responsive			: {
	    		0 : {
	    			items 	: 1,
	    			dots	: {$dots},
	    			nav		: {$nav}
	    		},
	    		992 : {
	    			items 	: {$items},
	    			dots	: {$dots}
	    		}
	    	}
	    });
	});
			
} )( jQuery );</script>";

echo $output;

?>