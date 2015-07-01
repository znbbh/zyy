<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $before = $after = $parallax = $row_id = $video = $parallax_offset = $layer_1 = $layer_2 = $layer_3 = $parallax_css = '';
$style = array();
global $post;
$template = $template_file = get_post_meta( $post->ID, '_wp_page_template', TRUE);
if ( $template_file == 'page-templates/page-fullwidth.php' ) {
	$fullwidth = true;
} else {
	$fullwidth = false;
}
//var_dump($atts);
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => ''
), $atts)); 

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass($el_class);

// Initial CSS
if ( $fullwidth === true ) {
	$css = substr( $css, strpos( $css, '{') + 1, -2 ); 
	$css = explode(';', $css);
	foreach ( $css as $key => $value) {
		if ( strpos( $value, 'background-position:' ) === false ) {
			array_push( $style, str_replace('!important', '', $value).'; ');
		} elseif ( $parallax == '' ) {
			array_push( $style, str_replace('!important', '', $value).'; ');
		}
	}
}

// Background Position
if ( isset( $atts['position'] ) ) {
	switch ( $atts['position'] ) {
		case 'top left' : $position = '0% 0%'; break;
		case 'top center' : $position = '50% 0%'; break;
		case 'top right' : $position = '100% 0%'; break;
		case 'center left' : $position = '0% 50%'; break;
		case 'center center' : $position = '50% 50%'; break;
		case 'center right' : $position = '100% 50%'; break;
		case 'bottom left' : $position = '0% 100%'; break;
		case 'bottom center' : $position = '50% 100%'; break;
		case 'bottom right' : $position = '100% 100%'; break;
		default : $position = '0% 0%';
	}
	array_push( $style , "background-position: {$position};" );
}

// Min Height
if ( isset( $atts['min_height'] ) ) {
	array_push( $style , "min-height: {$atts['min_height']};" );
}

// Font Color
if ( isset( $font_color ) && ! empty( $font_color ) ) {
	array_push( $style , vc_get_css_color( 'color', $font_color ) );
}

// Parallax Bg
if ( isset( $atts['parallax'] ) ) {
	array_push( $style , "background-attachment: fixed;" );
	if ( isset( $atts['parallax_ratio'] ) && $atts['parallax_ratio'] != 0 ) {
		$parallax_ratio = ( isset( $atts['parallax_ratio'] ) ) ? $atts['parallax_ratio'] : 0.5;
		$parallax = " data-stellar-background-ratio='{$parallax_ratio}' ";
	}
}

// Parallax Layers
if ( isset( $atts['parallax_layers'] ) ) {
	$parallax_offset  = ( isset( $atts['parallax_offset'] ) ) ? "data-stellar-vertical-offset={$atts['parallax_offset']}" : null;
	$parallax_offset .= ( $parallax_offset ) ? ' data-stellar-offset-parent="true"' : null;
	
	if ( isset( $atts['layer_1'] ) ) {
		$src = wp_get_attachment_image_src( $atts['layer_1'], 'full' );
		$vertical = ( isset( $atts['layer_1_vertical'] ) ) ? $atts['layer_1_vertical'].';' : null;
		$horizontal = ( isset( $atts['layer_1_horizontal'] ) ) ? $atts['layer_1_horizontal'].';' : null;
		$ratio = ( isset( $atts['layer_1_ratio'] ) ) ? $atts['layer_1_ratio'] : 0;
		$width = ( isset( $atts['layer_1_width'] ) ) ? 'width:'.$atts['layer_1_width'].';' : null;
		$height = ( isset( $atts['layer_1_height'] ) ) ? 'height:'.$atts['layer_1_height'].';' : null;
		$index = ( isset( $atts['layer_1_z'] ) ) ? 'z-index:'.$atts['layer_1_z'].';' : null;
		
		$layer_1 = "<img src='{$src[0]}' alt='' style='position: absolute; $vertical $horizontal $width $height $index;' data-stellar-ratio='$ratio' class='hidden-xs ".( isset($atts['style_images']) && $atts['style_images'] == 'yes' ? 'parallax-image' : null )."'>";
	}
	
	if ( isset( $atts['layer_2'] ) ) {
		$src = wp_get_attachment_image_src( $atts['layer_2'], 'full' );
		$vertical = ( isset( $atts['layer_2_vertical'] ) ) ? $atts['layer_2_vertical'].';' : null;
		$horizontal = ( isset( $atts['layer_2_horizontal'] ) ) ? $atts['layer_2_horizontal'].';' : null;
		$ratio = ( isset( $atts['layer_2_ratio'] ) ) ? $atts['layer_2_ratio'] : 0;
		$width = ( isset( $atts['layer_2_width'] ) ) ? 'width:'.$atts['layer_2_width'].';' : null;
		$height = ( isset( $atts['layer_2_height'] ) ) ? 'height:'.$atts['layer_2_height'].';' : null;
		$index = ( isset( $atts['layer_2_z'] ) ) ? 'z-index:'.$atts['layer_2_z'].';' : null;
		
		$layer_2 = "<img src='{$src[0]}' alt='' style='position: absolute; $vertical $horizontal $width $height $index;' data-stellar-ratio='$ratio' class='hidden-xs ".( isset($atts['style_images']) && $atts['style_images'] == 'yes' ? 'parallax-image' : null )."'>";
	}
	
	if ( isset( $atts['layer_3'] ) ) {
		$src = wp_get_attachment_image_src( $atts['layer_3'], 'full' );
		$vertical = ( isset( $atts['layer_3_vertical'] ) ) ? $atts['layer_3_vertical'].';' : null;
		$horizontal = ( isset( $atts['layer_3_horizontal'] ) ) ? $atts['layer_3_horizontal'].';' : null;
		$ratio = ( isset( $atts['layer_3_ratio'] ) ) ? $atts['layer_3_ratio'] : 0;
		$width = ( isset( $atts['layer_3_width'] ) ) ? 'width:'.$atts['layer_3_width'].';' : null;
		$height = ( isset( $atts['layer_3_height'] ) ) ? 'height:'.$atts['layer_3_height'].';' : null;
		$index = ( isset( $atts['layer_3_z'] ) ) ? 'z-index:'.$atts['layer_3_z'].';' : null;
		
		$layer_3 = "<img src='{$src[0]}' alt='' style='position: absolute; $vertical $horizontal $width $height $index;' data-stellar-ratio='$ratio' class='hidden-xs ".( isset($atts['style_images']) && $atts['style_images'] == 'yes' ? 'parallax-image' : null )."'>";
	}
}
if ( $layer_1 || $layer_2 || $layer_3 ) {
	$parallax_css .= ' parallax-container ';
}

// Check for Video Background
if ( isset( $atts['video_cover'] ) || isset( $atts['video'] ) || isset( $atts['video_mp4'] ) || isset( $atts['video_ogg'] ) || isset( $atts['video_webm'] ) ) {
	
	$_SESSION['curly_vc_row'] = ( isset( $_SESSION['curly_vc_row'] ) ) ? + 1 : 0;
	
	$row_id = "id='curly_row_{$_SESSION['curly_vc_row']}'";
	
	if ( isset( $atts['video_mp4'] ) ) {
		$video_mp4 = 'mp4: "'.$atts['video_mp4'].'",';
	}
	
	if ( isset( $atts['video_ogg'] ) ) {
		$video_ogg = 'ogg: "'.$atts['video_ogg'].'",';
	}
	
	if ( isset( $atts['video_webm'] ) ) {
		$video_webm = 'webm: "'.$atts['video_webm'].'",';
	}
	
	if ( isset( $atts['video'] ) ) {
		$video 		= 'video: "'.$atts['video'].'",';
	}
	
	if ( isset( $atts['video_cover'] ) ) {
		$video_cover = wp_get_attachment_image_src($atts['video_cover']);
		$video_cover = 'cover: "'.$video_cover[0].'",';
	}
	
	$after .= "<script type='text/javascript'>( function( $ ) {
				
		$( document ).ready(function() {
		    $('#curly_row_{$_SESSION['curly_vc_row']}').wallpaper({
		    	source: {
		    		{$video_cover}
		    		{$video}
		    		{$video_mp4}
		    		{$video_ogg}
		    		{$video_webm}
		    	}
		    });
		});
				
	} )( jQuery );</script>";
}

if ( $fullwidth === true ) {
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() , $this->settings['base'], $atts );
	
	$style = count( $style ) > 0  ? ' style="'.implode( $style ).'" ' : null;
	
	$output .= "<div $row_id class='content-padding-lg ".$el_class.$parallax_css."' $style $parallax_offset $parallax >";
	$output .= $layer_1.$layer_2.$layer_3;
	$output .= '<div class="container">';
	$output .= '<div class="'.$css_class.'">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= $after.'</div>'.$this->endBlockComment('row');
	$output .= '</div></div>';
	
} else {
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
	$style = ( count( $style ) > 0 ) ? ' style="'.implode( $style ).'" ' : null;

	$output .= '<div class="'.$css_class.'"'.$style.'>';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>'.$this->endBlockComment('row');
	
}


echo $output;