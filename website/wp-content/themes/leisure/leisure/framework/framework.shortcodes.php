<?php 

class CurlyShortcodes {
	
	function __construct() {
		
		/** Icon Shortcode */
		add_shortcode( 'icon', array( $this, 'icon_shortcode' ) );
		
		/** Dropcap Shortcode */
		add_shortcode( 'dropcap', array( $this, 'dropcap_shortcode' ) );
		
		/** Lead Shortcode */
		add_shortcode( 'lead', array( $this, 'lead_shortcode' ) );
		
		/** Append Shortcodes to Visual Composer  */
		if ( defined( 'WPB_VC_VERSION' ) ){ 
			add_action( 'vc_before_init', array( $this, 'icon_shortcode_vc' ) );
		}
		
	}
	
	/** Lead Shortcode */
	function lead_shortcode( $atts, $content = null ) {
		return '<p class="lead">'.$content.'</p>';
	}
	
	/** Dropcap Shortcode */
	function dropcap_shortcode( $atts, $content = null ) {
		return '<span class="dropcap">'.$content.'</span>';
	}
	
	/** Append the Icon Shortcode to Visual Composer */
	function icon_shortcode_vc() {
	
		vc_map( array(
			"name" => __("FontAwesome Icon", "CURLYTHEME"),
			"base" => "icon",
			"show_settings_on_create" => true,
			"admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			"icon" => "curly_icon",
			"class" => "",
			"category" => __('Curly Themes Extension', "CURLYTHEME"),
			"params" => array( 
				array(
					"type" => "textfield",
					"heading" => __("FontAwesome Icon", 'CURLYTHEME'),
					"param_name" => "icon",
					"description" => __( "You can find a list of all icons available here: <a href='http://fortawesome.github.io/Font-Awesome/icons/' targt='_blank'>http://fortawesome.github.io/Font-Awesome/icons/</a>", "CURLYTHEME" )
				),
				array(
					"type" => "dropdown",
					"heading" => __("Icon Size", 'CURLYTHEME'),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					"param_name" => "size",
					"value"	=> array(
						__('Normal Size', 'CURLYTHEME') => null,
						__('Double Size (2x)', 'CURLYTHEME') => '2x',
						__('Triple Size (3x)', 'CURLYTHEME') => '3x',
						__('Quadruple Size (4x)', 'CURLYTHEME') => '4x',
						__('Quintuple Size (5x)', 'CURLYTHEME') => '5x'
					)
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Icon Color", 'CURLYTHEME'),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					"param_name" => "color",
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Background Color", 'CURLYTHEME'),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					"param_name" => "background",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Border Size", 'CURLYTHEME'),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					"param_name" => "border_size",
					"value" => array( __('Choose size', 'CURLYTHEME') => null, '1px', '2px', '3px', '4px', '5px', '6px', '7px', '8px', '9px', '10px')
				),
				array(
					"type" => "dropdown",
					"heading" => __("Border Style", 'CURLYTHEME'),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					"param_name" => "border_style",
					"value" => array( __('Choose style', 'CURLYTHEME') => null, 'solid', 'dotted', 'dashed', 'double', 'groove', 'ridge')
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Border Color", 'CURLYTHEME'),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					"param_name" => "border_color"
				),
			)
		) );
	}
	
	/** Icon Shortcode */
	function icon_shortcode( $atts, $content = null ) {
		
		$css = $style = array();
		
		/** Check for icon */
		if ( isset( $atts['icon'] ) ) {
			
			/** Set icon */
			if ( strpos( $atts['icon'] ,'fa-') !== false ){
				$icon = $atts['icon'];
			} else {
				$icon = 'fa-'.$atts['icon'];
			}
			
			/** Set icon size */
			if ( isset( $atts['size'] ) ) {
				switch ( strtolower( $atts['size'] ) ) {
					case '2x' : $icon .= ' fa-2x'; break;
					case '3x' : $icon .= ' fa-3x'; break;
					case '4x' : $icon .= ' fa-4x'; break;
					case '5x' : $icon .= ' fa-5x'; break;
					case 'lg' : $icon .= ' fa-lg'; break;
				}
			}
			
			/** Display */
			if ( isset( $atts['display'] ) ) {
				switch ( strtolower( $atts['display'] ) ) {
					case 'inline' : $icon .= ' display-inline'; break;
					case 'block' : $icon .= ' center-block'; break;
				}
			}
			
			/** Icon color */
			if ( isset( $atts['color'] ) ) {
				array_push( $style, 'color: '.$atts['color'] );
			}
			
			/** Border */
			if ( isset( $atts['border'] ) ) {
				array_push( $css, 'fa-bordered' );
				array_push( $style, 'border: '.$atts['border'] );
			}
			if ( isset( $atts['border_color'] ) || isset( $atts['border_style'] ) || isset( $atts['border_size'] ) ) {
				array_push( $css, 'fa-bordered' );
				if ( isset( $atts['border_color'] )  ) {
					array_push( $style, 'border-color: '.$atts['border_color'] );
				}
				if ( isset( $atts['border_style'] )  ) {
					array_push( $style, 'border-style: '.$atts['border_style'] );
				}
				if ( isset( $atts['border_size'] )  ) {
					array_push( $style, 'border-width: '.$atts['border_size'] );
				}
			}
			
			/** Style */
			if ( isset( $atts['boxed'] ) && $atts['boxed'] == 'yes' ) {
				array_push( $css, 'fa-boxed' );
			}
			
			/** Background */
			if ( isset( $atts['background'] ) ) {
				array_push( $css, 'fa-boxed' );
				array_push( $style, 'background-color: '.$atts['background'] );
			}
			
		}
		
		return isset( $atts['icon'] ) ? "<i class='fa fa-fw $icon ".implode( ' ', $css )."' style='".implode( '; ', $style )."'></i>" : null;
	}
}

new CurlyShortcodes();
?>