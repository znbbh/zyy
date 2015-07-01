<?php

class CurlyMetaBoxOption {
	
	private $_id;
	private $_label;
	private $_default;
	private $_description;
	private $_array;
	private $_class;
	
	
	public function __construct( $id = null, $label = null, $default = null, $description = null, $array = null, $class = null ) {
		
		$this->_id = $id;
		$this->_label = $label;
		$this->_default = $default;
		$this->_description = $description;
		$this->_array = $array;
		$this->_class = $class;
		
	}
	
	public function checkbox( $html = null ) {
		$html .= '<div class="form-control checkbox '.$this->_class.'" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
				$html .= '<label class="description"><input type="checkbox" name="'.$this->_id.'" id="'.$this->_id.'" value="true" '.checked( $this->_default, 'true' , false).' />';
				$html .= ( $this->_description ) ? $this->_description : null;
				$html .= '</label>';
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function select( $html = null ) {
		$html .= '<div class="form-control select '.$this->_class.'" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
				$html .= '<select class="select" name="'.$this->_id.'" id="'.$this->_id.'">';
				
					foreach ($this->_array as $value) {
						$html .= '<option value="'.$value['value'].'" '.selected( $this->_default, $value['value'], false ).'>';
						$html .= $value['name'];
						$html .= '</option>';
					}
				
				$html .= '</select>';
				$html .= ( $this->_description ) ? '<span class="description">'.$this->_description.'</span>' : null;
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function color( $html = null ) {
		$html .= '<div class="form-control color '.$this->_class.'" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
				$html .= '<input class="color-picker" type="text" name="'.$this->_id.'" id="'.$this->_id.'" value="'.$this->_default.'" />';
				$html .= ( $this->_description ) ? '<span class="description">'.$this->_description.'</span>' : null;
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function image( $html = null ) {
		
		$clear_style = ( $this->_default ) ? 'style="display:inline-block"' : 'style="display:none"';
	
		$html .= '<div class="form-control image-field '.$this->_class.'" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
				$html .= '<input type="hidden" name="'.$this->_id.'_id" id="'.$this->_id.'_id" value="'.$this->_default[0].'">';
				$html .= '<input class="text-field" type="text" name="'.$this->_id.'" id="'.$this->_id.'" value="'.$this->_default[1].'" />';
				$html .= '<a href="#" class="image-upload-button button button-primary button-large" data-upload-title="'.$this->_array['upload_title'].'" data-upload-button="'.$this->_array['upload_button'].'">'.$this->_array['upload_link'].'</a>';
				$html .= '<a href="#" class="image-clear-button button button-large" '.$clear_style.'>'.$this->_array['clear_link'].'</a>';
				$html .= ( isset( $this->_default[1] ) ) ? '<img src="'.$this->_default[1].'" class="image-preview" />' : null;
				$html .= ( $this->_description ) ? '<span class="description">'.$this->_description.'</span>' : null;
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function video( $html = null ) {
		
		$clear_style = ( $this->_default ) ? 'style="display:inline-block"' : 'style="display:none"';
	
		$html .= '<div class="form-control image-field '.$this->_class.'" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
				$html .= '<input class="text-field" type="text" name="'.$this->_id.'" id="'.$this->_id.'" value="'.$this->_default.'" />';
				$html .= '<a href="#" class="video-upload-button button button-primary button-large" data-upload-title="'.$this->_array['upload_title'].'" data-upload-button="'.$this->_array['upload_button'].'">'.$this->_array['upload_link'].'</a>';
				$html .= '<a href="#" class="video-clear-button button button-large" '.$clear_style.'>'.$this->_array['clear_link'].'</a>';
				$html .= ( $this->_description ) ? '<span class="description">'.$this->_description.'</span>' : null;
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function slider( $html = null ) {
		$html .= '<div class="form-control" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div style="position: relative;">';
				$html .= '<input type="hidden" name="'.$this->_id.'" id="'.$this->_id.'" value="'.$this->_default.'" />';
				$html .= '<div class="slider" id="'.$this->_id.'_slider"></div>';
				$html .= '<div class="slider_value">'.(( $this->_default ) ? $this->_default.$this->_array['suf'] :  null ).'</div>';
				$html .= ( $this->_description ) ? '<span class="description">'.$this->_description.'</span>' : null;
				$html .= '<script type="text/javascript">';
					$html .= 'jQuery(function() { 
									jQuery( "#'.$this->_id.'_slider" ).slider({ 
										value: '.$this->_default.' , 
										step: '.$this->_array['step'].' , 
										min: '.$this->_array['min'].' , 
										max: '.$this->_array['max'].' , 
										slide: function( event, ui ) { 
											jQuery(this).siblings(".slider_value").text( ui.value + "'.$this->_array['suf'].'" );
											jQuery(this).siblings("input[type=hidden]").val(ui.value); 
										}
									}); 
								});';
				$html .= '</script>';
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function editor( $html = null ) {
		
		ob_start(); wp_editor( $this->_default , $this->_id, array('textarea_rows' => 10 , 'teeny' => true) );
		
		$html .= '<div class="form-control" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
				$html .= ob_get_clean();
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function input( $html = null ) {
		$html .= '<div class="form-control" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
				$html .= '<input class="text-field" type="text" name="'.$this->_id.'" id="'.$this->_id.'" value="'.$this->_default.'" />';
				$html .= ( $this->_description ) ? '<span class="description">'.$this->_description.'</span>' : null;
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function radio( $html = null ) {
		$selected = ( $this->_default ) ? $this->_default : $this->_array[0]['value'];
		$html .= '<div class="form-control radio" id="wrapper_'.$this->_id.'">';
			$html .= '<label for="'.$this->_id.'" class="name">'.$this->_label.'</label>';
			$html .= '<div>';
			
				foreach ($this->_array as $value) {
					$html .= '<label class="'.$this->_id.'_'.$value['value'].'">';
						$html .= '<input type="radio" name="'.$this->_id.'" id="'.$value['id'].'" value="'.$value['value'].'" '.checked( $selected, $value['value'], false ).' />';
						$html .= $value['name'];
					$html .= '</label>';
				}
				
				$html .= ( $this->_description ) ? '<span class="description">'.$this->_description.'</span>' : null;
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
}

// Meta Data Box
add_action( 'add_meta_boxes', 'curly_individual_page_settings' );
function curly_individual_page_settings()
{	
	$post_types = get_post_types();
	
	foreach ($post_types as $post_type) {
		add_meta_box( 'individual-page-settings', 'Individual Page Settings', 'curly_individual_page_settings_cb', $post_type, 'normal', 'high' );
	}
}

// Meta Data Form
function curly_individual_page_settings_cb( $post )
{

	/** Check if is Contact Page */
	function curly_check_contact_page_template( $post_id ) {
		
		$template_file = get_post_meta( $post_id, '_wp_page_template', TRUE);
		
		if ( $template_file == 'page-templates/contact.php' || $template_file == 'page-templates/contact-2.php' || $template_file == 'page-templates/contact-3.php' ) {
			return true;
		} else {
			return false;
		}
	}
	
	/** Check if is Coming Soon Page */
	function curly_check_coming_soon_page_template( $post_id ) {
		
		$template_file = get_post_meta( $post_id, '_wp_page_template', TRUE);
		
		if ( $template_file == 'page-templates/coming-soon.php' ) {
			return true;
		} else {
			return false;
		}
	}
	
	/** Set value */
	function curly_meta( $values, $value, $null = null, $esc = false ) {
		if ( $esc === true ) {
			return ( isset( $values[ THEMEPREFIX.$value ] ) ) ? $values[THEMEPREFIX.$value][0] : $null;
		} else {
			return ( isset( $values[ THEMEPREFIX.$value ] ) ) ? esc_attr( $values[THEMEPREFIX.$value][0] ) : $null;
		}
		
	}
	
	/** Get Revolution Sliders */
	function curly_get_revolution_sliders() {
		global $wpdb;
		$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
		$revsliders[0] = array( 'name' => __( '- Select Revolution Slider -', 'CURLYTHEME' ), 'value' => null );
		if( $sliders ) {
			foreach( $sliders as $value ) {
				array_push( $revsliders, array( 'name' => $value->title, 'value' => $value->alias ) );
			}
		}
		return $revsliders;
	}
	
	global $theme_options;
	
	$values				= get_post_custom( $post->ID );
	
	/** Video */
	$header_video_cover 	= curly_meta( $values, '_video_cover', null );
	$header_video_cover_id 	= curly_meta( $values, '_video_cover_id', null );
	$header_video_mp4 		= curly_meta( $values, '_video_mp4', null );
	$header_video_webm 		= curly_meta( $values, '_video_webm', null );
	$header_video_ogg 		= curly_meta( $values, '_video_ogg', null );
	
	/** Background */
	$bg_color 			= curly_meta( $values, '_bg_color', null );
	$bg_img 			= curly_meta( $values, '_bg_image', null );
	$bg_img_id 			= curly_meta( $values, '_bg_image_id', null );
	$bg_pos 			= curly_meta( $values, '_bg_position', null );
	$bg_rep 			= curly_meta( $values, '_bg_repeat', null );
	$bg_size 			= curly_meta( $values, '_bg_size', null );
	$bg_att 			= curly_meta( $values, '_bg_attachment', null );
	
	/** Header */
	$subtitle			= curly_meta( $values, '_header_subtitle', null );
	$slider				= curly_meta( $values, '_header_slider', null );
	$header_text		= curly_meta( $values, '_header_text', null );
	$header_bg 			= curly_meta( $values, '_header_bg_color', null );
	$header_opac 		= curly_meta( $values, '_header_opacity', $theme_options['header_shading_opacity'] );
	$header_img 		= curly_meta( $values, '_header_image', null );
	$header_img_id 		= curly_meta( $values, '_header_image_id', null );
	$header_height 		= curly_meta( $values, '_header_height', null );
	$header_height_val 	= curly_meta( $values, '_header_height_value', 370 );
	$heading			= curly_meta( $values, '_heading', null );
	$header_align 		= curly_meta( $values, '_header_align', $theme_options['header_align']  );
	
	/** Page */
	
	/** Contact */
	$contact_side		= curly_meta( $values, '_contact_side', null, true );
	$latitude			= curly_meta( $values, '_latitude', null );
	$longitude			= curly_meta( $values, '_longitude', null );
	$map_type			= curly_meta( $values, '_map_type', null );
	$map_height			= curly_meta( $values, '_map_height', 400 );
	$map_zoom			= curly_meta( $values, '_map_zoom', 15 );
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	
    <div id="individual-page-settings-wrapper">
    
		<ul class="hashTabber-nav" data-hashtabber-id="tabs">
			<?php if ( curly_check_coming_soon_page_template( $post->ID ) ) : ?>
			<li><a href="#video"><?php _e('Video Background', 'CURLYTHEME'); ?></a></li>
			<?php endif; ?>
			<?php if ( curly_check_contact_page_template( $post->ID ) ) : ?>
			<li><a href="#contact"><?php _e('Contact Details', 'CURLYTHEME'); ?></a></li>
			<?php endif; ?>
			<li><a href="#title"><?php _e('Page Title', 'CURLYTHEME'); ?></a></li>
			<li><a href="#header"><?php _e('Header Options', 'CURLYTHEME'); ?></a></li>
			<li><a href="#bg"><?php _e('Background', 'CURLYTHEME'); ?></a></li>
		</ul>
		
		<ul class="hashTabber-data" data-hashtabber-id="tabs">
			
			<?php if ( curly_check_coming_soon_page_template( $post->ID ) ) : ?>
			<li id="video">
				<div>
					<?php
						
						$object_video_cover = new CurlyMetaBoxOption( THEMEPREFIX.'_video_cover' , __('Video Background Cover Image', 'CURLYTHEME') , array( $header_video_cover_id , $header_video_cover ) , null , array( 'upload_title' => __('Upload Cover Image', 'CURLYTHEME'), 'upload_button' => __('Insert Cover Image', 'CURLYTHEME'), 'upload_link' => __('Upload Cover Image', 'CURLYTHEME') , 'clear_link' => __('Clear Cover Image', 'CURLYTHEME') ) ); 
						$object_video_cover->image();
						
						$object_video_mp4 = new CurlyMetaBoxOption( THEMEPREFIX.'_video_mp4' , __('Video Background MP4 File', 'CURLYTHEME') , $header_video_mp4 , null , array( 'upload_title' => __('Upload MP4 Video', 'CURLYTHEME'), 'upload_button' => __('Insert MP4 Video', 'CURLYTHEME'), 'upload_link' => __('Upload MP4 Video', 'CURLYTHEME') , 'clear_link' => __('Clear MP4 Video', 'CURLYTHEME') ) ); 
						$object_video_mp4->video();
						
						$object_video_webm = new CurlyMetaBoxOption( THEMEPREFIX.'_video_webm' , __('Video Background WEBM File', 'CURLYTHEME') , $header_video_webm , null , array( 'upload_title' => __('Upload WEBM Video', 'CURLYTHEME'), 'upload_button' => __('Insert WEBM Video', 'CURLYTHEME'), 'upload_link' => __('Upload WEBM Video', 'CURLYTHEME') , 'clear_link' => __('Clear WEBM Video', 'CURLYTHEME') ) ); 
						$object_video_webm->video();
						
						$object_video_ogg = new CurlyMetaBoxOption( THEMEPREFIX.'_video_ogg' , __('Video Background OGG File', 'CURLYTHEME'), $header_video_ogg , null , array( 'upload_title' => __('Upload OGG Video', 'CURLYTHEME'), 'upload_button' => __('Insert OGG Video', 'CURLYTHEME'), 'upload_link' => __('Upload OGG Video', 'CURLYTHEME') , 'clear_link' => __('Clear OGG Video', 'CURLYTHEME') ) ); 
						$object_video_ogg->video();
					
					?>
					
				</div>
			</li><!-- end video-->
			<?php endif; ?>
		
			<?php if ( curly_check_contact_page_template( $post->ID ) ) : ?>
			<li id="contact">
				<div>
					<?php 
					
						$object_side_content = new CurlyMetaBoxOption( THEMEPREFIX.'_contact_side' , __('Side Content', 'CURLYTHEME') , $contact_side ); 
						$object_side_content->editor();
						
						$object_latitude = new CurlyMetaBoxOption( THEMEPREFIX.'_latitude' , __('Map Latitude', 'CURLYTHEME') , $latitude , __('Latitude Coordinates (Please use decimal coordinates. ie. 51.508056)', 'CURLYTHEME') ); 
						$object_latitude->input(); 
						
						$object_longitude = new CurlyMetaBoxOption( THEMEPREFIX.'_longitude' , __('Map Longitude', 'CURLYTHEME') , $longitude , __('Longitude Coordinates (Please use decimal coordinates. ie. -0.128056)', 'CURLYTHEME') ); 
						$object_longitude->input();
						
						$object_map_type = new CurlyMetaBoxOption( 
							THEMEPREFIX.'_map_type' , 
							__('Map Type', 'CURLYTHEME') , 
							$map_type , null , array( array( 'id' => THEMEPREFIX . '_map_type_roadmap', 'name' => __('Roadmap', 'CURLYTHEME'), 'value' => 'roadmap' ), array( 'id' => THEMEPREFIX . '_map_type_satellite', 'name' => __('Satellite', 'CURLYTHEME'), 'value' => 'satellite' ), array( 'id' => THEMEPREFIX . '_map_type_hybrid', 'name' => __('Hybrid', 'CURLYTHEME'), 'value' => 'hybrid'), array('id' => THEMEPREFIX . '_map_type_terrain','name' => __('Terrain', 'CURLYTHEME'), 'value' => 'terrain') ) ); 
						$object_map_type->radio(); 
						
						$object_map_height = new CurlyMetaBoxOption( THEMEPREFIX.'_map_height' , __('Map Height', 'CURLYTHEME') , $map_height , __('Choose the map height. Default is 400px.', 'CURLYTHEME') , array( 'step' => 1, 'min' => 100, 'max' => 800, 'suf' => 'px' ) ); 
						$object_map_height->slider(); 
						
						$object_map_zoom = new CurlyMetaBoxOption( THEMEPREFIX.'_map_zoom' , __('Map Zoom', 'CURLYTHEME') , $map_zoom , __('Choose the map zoom level. Default level is 15', 'CURLYTHEME') , array( 'step' => 1, 'min' => 1, 'max' => 18, 'suf' => null ) ); 
						$object_map_zoom->slider();
					
					?>
					
				</div>
			</li><!-- end contact -->
			<?php endif; ?>
		
			<li id="title">
				<div>
					<?php 
					
					$object_subtitle = new CurlyMetaBoxOption( THEMEPREFIX.'_header_subtitle' , __('Page Subtitle', 'CURLYTHEME') , $subtitle , __('Enter your page subtitle', 'CURLYTHEME') ); 
					$object_subtitle->input();
					
					$object_heading = new CurlyMetaBoxOption( THEMEPREFIX.'_heading' , __('Hide Page Title', 'CURLYTHEME') , $heading , __('Check this to hide the page title', 'CURLYTHEME') ); 
					$object_heading->checkbox();
					
					$object_header_align = new CurlyMetaBoxOption( THEMEPREFIX.'_header_align', __('Header Alignment', 'CURLYTHEME'), $header_align, null, array( array( 'id' => THEMEPREFIX.'_header_align', 'name' => __( 'Left', 'CURLYTHEME' ), 'value' => 0 ), array( 'id' => THEMEPREFIX.'_header_align', 'name' => __( 'Center', 'CURLYTHEME' ), 'value' => 1 ), array( 'id' => THEMEPREFIX.'_header_align', 'name' => __( 'Right', 'CURLYTHEME' ), 'value' => 2 ) ) ); 
					$object_header_align->radio();
					
					$object_header_text = new CurlyMetaBoxOption( THEMEPREFIX.'_header_text' , __('Page Title Color', 'CURLYTHEME') , $header_text, null, null ); 
					$object_header_text->color();
						
					?>
				</div>
			</li><!-- end title -->
			
			<li id="header">
				<div>
					<?php
					
					$object_header_img = new CurlyMetaBoxOption( THEMEPREFIX.'_header_image' , __('Header Image', 'CURLYTHEME') , array( $header_img_id , $header_img ) , null , array( 'upload_title' => __('Upload Header Image', 'CURLYTHEME'), 'upload_button' => __('Insert Image', 'CURLYTHEME'), 'upload_link' => __('Upload Header Image', 'CURLYTHEME') , 'clear_link' => __('Clear Header Image', 'CURLYTHEME') ) ); 
					$object_header_img->image();
					
					$object_slider = new CurlyMetaBoxOption( THEMEPREFIX.'_header_slider', __('Header Slider', 'CURLYTHEME'), $slider, null, curly_get_revolution_sliders() ); 
					$object_slider->select(); 
					
					$object_header_height = new CurlyMetaBoxOption( THEMEPREFIX.'_header_height', __('Header Height', 'CURLYTHEME'), $header_height, null, array( array( 'id' => THEMEPREFIX.'_header_height', 'name' => __( 'Default', 'CURLYTHEME' ), 'value' => 0 ), array( 'id' => THEMEPREFIX.'_header_height', 'name' => __( 'Match Image', 'CURLYTHEME' ), 'value' => 1 ), array( 'id' => THEMEPREFIX.'_header_height', 'name' => __( 'Match Slider', 'CURLYTHEME' ), 'value' => 2 ), array( 'id' => THEMEPREFIX.'_header_height', 'name' => __( 'Fixed Height', 'CURLYTHEME' ), 'value' => 3 ) ) ); 
					$object_header_height->radio();
					
					$object_header_height_val = new CurlyMetaBoxOption( THEMEPREFIX.'_header_height_value', __('Fixed Header Height', 'CURLYTHEME'), $header_height_val, __('Header Height must be set to "Fixed Height"', 'CURLYTHEME'), array( 'step' => 1, 'min' => 200, 'max' => 1500, 'suf' => 'px' ) );
					$object_header_height_val->slider();
					
					$object_header_bg = new CurlyMetaBoxOption( THEMEPREFIX.'_header_bg_color' , __('Header Background Color', 'CURLYTHEME') , $header_bg, null, null ); 
					$object_header_bg->color();
					
					$object_header_bg_opac = new CurlyMetaBoxOption( THEMEPREFIX.'_header_opacity' , __('Header Background Color Opacity', 'CURLYTHEME') , $header_opac , sprintf( __('Choose the header background color opacity. Default is %d&#37;', 'CURLYTHEME'), $theme_options['header_shading_opacity'] ) , array( 'step' => 0.1, 'min' => 0, 'max' => 100, 'suf' => '%' ) ); 
					$object_header_bg_opac->slider();
					
					?>
				</div>
			</li><!-- end header -->
			
			<li id="bg">
				<div>
					<?php 
					
					$object_bg_color = new CurlyMetaBoxOption( THEMEPREFIX.'_bg_color' , __('Background Color', 'CURLYTHEME') , $bg_color , null, null ); 
					$object_bg_color->color();
					
					$object_bg_image = new CurlyMetaBoxOption( THEMEPREFIX.'_bg_image' , __('Background Image', 'CURLYTHEME') , array( $bg_img_id , $bg_img ) , null , array( 'upload_title' => __('Upload Background Image', 'CURLYTHEME'), 'upload_button' => __('Insert Image', 'CURLYTHEME'), 'upload_link' => __('Upload Background', 'CURLYTHEME') , 'clear_link' => __('Clear Background', 'CURLYTHEME') ) ); 
					$object_bg_image->image();
					
					$object_bg_pos = new CurlyMetaBoxOption( THEMEPREFIX.'_bg_position' , __('Background Position', 'CURLYTHEME') , $bg_pos , null , array( array( 'id' => THEMEPREFIX.'_bg_position', 'name' => __('Left', 'CURLYTHEME'), 'value' => 0 ), array( 'id' => THEMEPREFIX.'_bg_position', 'name' => __('Center', 'CURLYTHEME'), 'value' => 1 ), array( 'id' => THEMEPREFIX.'_bg_position', 'name' => __('Right', 'CURLYTHEME'), 'value' => 2 ) ) ); 
					$object_bg_pos->radio(); 
					
					$object_bg_repeat = new CurlyMetaBoxOption( THEMEPREFIX.'_bg_repeat' , __('Background Repeat', 'CURLYTHEME') , $bg_rep , null , array( array( 'id' => THEMEPREFIX.'_bg_repeat', 'name' => __('Repeat', 'CURLYTHEME'), 'value' => 0 ), array( 'id' => THEMEPREFIX.'_bg_repeat', 'name' => __('No Repeat', 'CURLYTHEME'), 'value' => 1 ), array( 'id' => THEMEPREFIX.'_bg_repeat', 'name' => __('Vertically', 'CURLYTHEME'), 'value' => 2 ), array( 'id' => THEMEPREFIX.'_bg_repeat', 'name' => __('Horizontally', 'CURLYTHEME'), 'value' => 3 ) ) ); 
					$object_bg_repeat->radio(); 
					
					$object_bg_size = new CurlyMetaBoxOption( THEMEPREFIX.'_bg_size' , __('Background Size', 'CURLYTHEME') , $bg_size , null , array( array( 'id' => THEMEPREFIX.'_bg_size', 'name' => __('Auto', 'CURLYTHEME'), 'value' => 0 ), array( 'id' => THEMEPREFIX.'_bg_size', 'name' => __('Cover', 'CURLYTHEME'), 'value' => 1 ), array( 'id' => THEMEPREFIX.'_bg_size', 'name' => __('Contain', 'CURLYTHEME'), 'value' => 2 ) ) ); 
					$object_bg_size->radio(); 
					
					$object_bg_att = new CurlyMetaBoxOption( THEMEPREFIX.'_bg_attachment' , __('Background Attachment', 'CURLYTHEME') , $bg_att , null , array( array( 'id' => THEMEPREFIX.'_bg_attachment', 'name' => __('Scroll', 'CURLYTHEME'), 'value' => 0 ), array( 'id' => THEMEPREFIX.'_bg_attachment', 'name' => __('Fixed', 'CURLYTHEME'), 'value' => 1 ), array( 'id' => THEMEPREFIX.'_bg_attachment', 'name' => __('Local', 'CURLYTHEME'), 'value' => 2 ) ) ); 
					$object_bg_att->radio(); 
					
					?>
	
				</div>
			</li><!-- end background -->
			
    </div>
    <script type="text/javascript">
    (function($) {
      	"use strict";
      	
      	// Tabs
      	var tabber = new HashTabber();
      	tabber.run();
      	
      	// Clear Buttons
      	$('.image-clear-button').click( function (e) {
      		$(this).siblings('input[type=text]').val(null);
      		$(this).siblings('input[type=hidden]').val(null).trigger('change');
      		$(this).siblings('.image-preview').remove();
      		e.preventDefault();
      	});
      	
      	// Clear Buttons
      	$('.video-clear-button').click( function (e) {
      		$(this).siblings('input[type=text]').val(null);
      		e.preventDefault();
      	});
      	
      	// Document Ready
      	$(document).ready( function() {
      		
      		// Color Picker	
      		$('.color-picker').wpColorPicker();
      		
      		// Panels Height
      		var list_height = 100;
      		$('#individual-page-settings-wrapper > ul > li[role*=tab]').each(function () {
      			list_height += $(this).outerHeight();
      		});
      		
      		$('#individual-page-settings-wrapper div.ui-tabs-panel').each(function () {
      			var existing_style = $(this).attr('style');
      			var new_style = ( existing_style ) ? (existing_style + ' min-height: ' + list_height + 'px;') : 'min-height: ' + list_height + 'px;';
      			$(this).attr('style', new_style);
      		});
      		
      		// Image Field
      		call_image_field();
      		call_video_field();
      		
      		function call_image_field() {
      			// Function Upload Media
      			$('.image-upload-button').click(function (e) {
      				var el = $(this).parent();
      				var button = $(this);
      				e.preventDefault();
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
      					$('input[type=hidden]', el).val(attachment.id).trigger('change');
      					if (!el.hasClass('upload_file')) {
      						if ($('img', el).length > 0) {
      							$('.image-preview', el).attr('src', attachment.url);
      						} else {
      							$('<img src="'+ attachment.url +'" class="image-preview">').insertBefore($(':last-child', el));
      							$('.image-clear-button', el).attr('style', 'display:inline-block');
      						}
      					}
      				})
      				.open();
      			});
      		}
      		
      		function call_video_field() {
      			// Function Upload Media
      			$('.video-upload-button').click(function (e) {
      				var el = $(this).parent();
      				var button = $(this);
      				e.preventDefault();
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
      					if (!el.hasClass('upload_file')) {
      						$('.video-clear-button', el).attr('style', 'display:inline-block');
      					}
      				})
      				.open();
      			});
      		}
      		
      	});
      	
    })(jQuery); 
    </script>
	<?php	
}

// Save Meta Data
add_action( 'save_post', 'curly_save_individual_page_settings', 10, 2 );
function curly_save_individual_page_settings( $post_id, $post ){
	
	global $theme_options;
	
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );
	
	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	
	$values = array(
		
		THEMEPREFIX.'_bg_color',
		THEMEPREFIX.'_bg_image', 
		THEMEPREFIX.'_bg_image_id', 
		THEMEPREFIX.'_bg_position',
		THEMEPREFIX.'_bg_repeat',
		THEMEPREFIX.'_bg_size',
		THEMEPREFIX.'_bg_attachment',
		THEMEPREFIX.'_header_subtitle',
		THEMEPREFIX.'_header_slider',
		THEMEPREFIX.'_header_align',
		THEMEPREFIX.'_header_text',
		THEMEPREFIX.'_header_bg_color',
		THEMEPREFIX.'_header_opacity',
		THEMEPREFIX.'_header_image',
		THEMEPREFIX.'_header_image_id',
		THEMEPREFIX.'_header_height',
		THEMEPREFIX.'_header_height_value',
		THEMEPREFIX.'_heading',
		THEMEPREFIX.'_contact_side',
		THEMEPREFIX.'_latitude',
		THEMEPREFIX.'_longitude',
		THEMEPREFIX.'_map_type',
		THEMEPREFIX.'_map_height',
		THEMEPREFIX.'_map_zoom',
		THEMEPREFIX.'_video_cover',
		THEMEPREFIX.'_video_cover_id',
		THEMEPREFIX.'_video_mp4',
		THEMEPREFIX.'_video_webm',
		THEMEPREFIX.'_video_ogg'
	);
	
	// Update Post Meta or Delete Empty Post Meta
	foreach ( $values as $value) {
		if( isset( $_POST[$value] ) ) {
				
			if ( $value == THEMEPREFIX.'_header_opacity' ) {
				if ( $_POST[$value] != $theme_options['header_shading_opacity'] ) {
					update_post_meta( $post_id, $value, wp_kses_post( $_POST[$value] ) );
				} else {
					delete_post_meta( $post_id, $value );
				}
			} elseif ( $value == THEMEPREFIX.'_contact_side' ) {
				update_post_meta( $post_id, $value, wp_kses_post( $_POST[$value] ) );
			} elseif ( $value == THEMEPREFIX.'_header_align' ) {
				if ( $_POST[$value] != $theme_options['header_align'] ) {
					update_post_meta( $post_id, $value, wp_kses_post( $_POST[$value] ) );
				} else {
					delete_post_meta( $post_id, $value );
				}
			} else {
				update_post_meta( $post_id, $value, wp_kses( $_POST[$value] , null ) );
			}
				
		} else {
			delete_post_meta( $post_id, $value );
		}
	}
}
?>