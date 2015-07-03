<?php 

	class CurlyLeisureVisualComposer {
		
		public function __construct() {
			
			/** We safely integrate with VC with this hook */
			add_action( 'init', array( $this, 'integrateWithVC' ) );
			
			/** Set as Theme */
			add_action( 'vc_before_init', array( $this, 'set_as_theme' ) );
			
			/** Construct Services List */
			add_action( 'vc_before_init', array( $this, 'services_list_vc' ) );
			add_shortcode( 'curly_services_list', array( $this, 'services_list' ) );
			add_shortcode( 'curly_services_list_item', array( $this, 'services_list_item' ) );
		
			/** Construct Testimonials Carousel*/
			add_action( 'vc_before_init', array( $this, 'testimonials_carousel_vc' ) );
			add_shortcode( 'curly_testimonials_carousel', array( $this, 'testimonials_carousel' ) );
			add_shortcode( 'curly_testimonial', array( $this, 'testimonial' ) );
			
			/** Construct Services Carousel */
			add_action( 'vc_before_init', array( $this, 'services_carousel_vc' ) );
			add_shortcode( 'curly_services_carousel', array( $this, 'services_carousel' ) );
			add_shortcode( 'curly_service', array( $this, 'service' ) );
			
			/** Construct Isotope Grid */
			add_action( 'vc_before_init', array( $this, 'isotope_vc' ) );
			add_shortcode( 'curly_isotope', array( $this, 'isotope' ) );
			add_shortcode( 'curly_isotope_item', array( $this, 'isotope_item' ) );
			
			/** Construct Person */
			add_action( 'vc_before_init', array( $this, 'person_vc' ) );
			add_shortcode( 'curly_person', array( $this, 'person' ) );
			
		}
		
		/** VC Integration */
		public function integrateWithVC() {
	        if ( ! defined( 'WPB_VC_VERSION' ) ) {
	        	
	            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
	            return;
	            
	        } else {
        		
        		/** Add Video Tyep */
        		add_shortcode_param('curly_video_file', array( $this, 'curly_video_file' ) , get_template_directory_uri().'/framework/js/video_file.js' );
        		
        		/** Construct Row Params */
        		$this->construct_row();
        		
        		/** Construct Images Carousel Params */
        		$this->construct_images_carousel();
        		
        		/** Construct Tabs Params */
        		$this->construct_tabs();
        		
        		/** Construct Image Gallery Params */
        		$this->construct_gallery();
        		
        		/** Remove Elements */
        		vc_remove_element("vc_tour");
        		
        		/** Remove Params */
        		vc_remove_param("vc_images_carousel", "mode");
        		vc_remove_param("vc_images_carousel", "partial_view");
        		vc_remove_param("vc_images_carousel", "img_size");
        		vc_remove_param("vc_gallery", "type");
        		vc_remove_param("vc_gallery", "interval");
        		vc_remove_param("vc_tabs", "interval");
	        	
	        }
	    }
		
		/** Show notice if your plugin is activated but Visual Composer is not */
	    public function showVcVersionNotice() {
	        $plugin_data = get_plugin_data(__FILE__);
	        echo '
	        <div class="updated">
	          <p>'.sprintf(__('<strong>%s WordPress Theme</strong> requires <strong><a href="http://'.'codecanyon'.'.net/item/visual-composer-page-builder-for-wordpress/242431?ref=CurlyThemes" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'CURLYTHEME'), wp_get_theme()->get( 'Name' ) ).'</p>
	        </div>';
	    }
	    
	    /** Isotope Shortcode */
	    public function person( $atts, $content = null ){
	    
	    	$size = isset( $atts['size'] ) ? 'person-mini' : 'person-large';
	    	$image = isset( $atts['image'] ) ? wp_get_attachment_image_src( $atts['image'], 'large' ) : null;
	    	
	    	$html  = '<div class="'.$size.'">';
	    	$html .= $image ? '<img src="'.$image[0].'" alt="" />' : null;
	    	$html .= isset( $atts['name'] ) ? "<strong>".$atts['name']."</strong>" : null;
	    	$html .= isset( $atts['title'] ) ? $atts['title'] : null;
	    	$html .= isset( $atts['phone'] ) ? "<br>".$atts['phone'] : null;
	    	$html .= isset( $atts['email'] ) ? "<br>".$atts['email'] : null;
	    	$html .= isset( $atts['description'] ) ? "<br>".do_shortcode( $atts['description'] ) : null;	
	    	$html .= '</div>';
	    	
	    	return $html;
	    	
	    }
	    
	    /** Visual Composer Person */
	    public function person_vc() {
	    	
	    	/** Isotope Item */
	    	vc_map( array(
	    	    "name" => __("Person", "CURLYTHEME"),
	    	    "base" => "curly_person",
	    	    "content_element" => true,
	    	    "icon" => "curly_icon",		    
	    	    "params" => array(
	    	        array(
	    	            "type" => "textfield",
	    	            "heading" => __("Person Name", "CURLYTHEME"),
	    	            "holder" => "div",
	    	            "param_name" => "name"
	    	        ),
	    	        array(
	    	            "type" => "attach_image",
	    	            "heading" => __("Image", "CURLYTHEME"),
	    	            "param_name" => "image"
	    	        ),
	    	        array(
	    	            "type" => "textfield",
	    	            "heading" => __("Title", "CURLYTHEME"),
	    	            'edit_field_class' => 'vc_col-sm-4 vc_column',
	    	            "param_name" => "title"
	    	        ),
	    	        array(
	    	            "type" => "textfield",
	    	            "heading" => __("E-mail", "CURLYTHEME"),
	    	            'edit_field_class' => 'vc_col-sm-4 vc_column',
	    	            "param_name" => "email"
	    	        ),
	    	        array(
	    	            "type" => "textfield",
	    	            "heading" => __("Phone", "CURLYTHEME"),
	    	            'edit_field_class' => 'vc_col-sm-4 vc_column',
	    	            "param_name" => "phone"
	    	        ),
	    	        array(
	    	            "type" => "textarea",
	    	            "heading" => __("Extra Description", "CURLYTHEME"),
	    	            'edit_field_class' => 'vc_col-sm-8 vc_column',
	    	            "param_name" => "description"
	    	        ),
	    	        array(
	    	            "type" => "dropdown",
	    	            "heading" => __("Size", "CURLYTHEME"),
	    	            'edit_field_class' => 'vc_col-sm-4 vc_column',
	    	            "param_name" => "size",
	    	            'value' => array( 
	    	            	__('Large', 'CURLYTHEME') => null,
	    	            	__('Small', 'CURLYTHEME') => 'small',
	    	            ),
	    	        ),
	    	    )
	    	) );
	    }
		
		/** Isotope Shortcode */
		public function services_list( $atts, $content = null ){
			
			$el_class = isset( $atts['css'] ) ? $atts['css'] : null;
			if ( $el_class != '' ) {
				$el_class = " " . str_replace( ".", "", $el_class );
				$el_class = substr( $el_class , 0, strpos( $el_class, '{' ) );
			}
			$el_class .= isset( $atts['el_class'] ) ? ' '.$atts['el_class'] : null;
			
			$html = '<ul class="list-services '.$el_class.'">';
			$html .= do_shortcode( $content );	
			$html .= '</ul>';
			
			return $html;
			
		}
		
		/** Isotope Shortcode */
		public function services_list_item( $atts, $content = null ){
			
			$html = '<li>';
			$html .= '<h3><a href="'.( isset( $atts['link'] ) ? $atts['link'] : '#' ).'">'.( isset( $atts['title'] ) ? $atts['title'] : null );
			$html .= '<small>'.( isset( $atts['description'] ) ? $atts['description'] : null ).'</small>';
			$html .= '</a></h3>';
			$html .= '</li>';
			
			return $html;
			
		}
		
		/** Visual Composer Isotope */
		public function services_list_vc() {
		
			/** Services Container */
			vc_map( array(
			   "name" => __("Services List", "CURLYTHEME"),
			   "base" => "curly_services_list",
			   "as_parent" => array('only' => 'curly_services_list_item'),
			   "content_element" => true,
			   'is_container' => true,
			   "show_settings_on_create" => false,
			   "admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			   "icon" => "curly_icon",
			   "params" => array(
			   		array(
			   			'type' => 'textfield',
			   			'heading' => __( 'Extra class name', 'js_composer' ),
			   			'param_name' => 'el_class',
			   			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			   		),
			   		array(
			   			'type' => 'css_editor',
			   			'heading' => __( 'Css', 'js_composer' ),
			   			'param_name' => 'css'
			   		)
			   ),
			   "category" => __('Curly Themes Extension', "CURLYTHEME"),
			   "js_view" => 'VcColumnView'
			) );
			
			/** Services List Item */
			vc_map( array(
			    "name" => __("Services List Item", "CURLYTHEME"),
			    "base" => "curly_services_list_item",
			    "content_element" => true,
			    "icon" => "curly_icon",
			    "as_child" => array('only' => 'curly_services_list'), 			    
			    "params" => array(
			        array(
			            "type" => "textfield",
			            "heading" => __("Title", "CURLYTHEME"),
			            "holder" => "div",
			            "value" => "Some title here",
			            "param_name" => "title"
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Description", "CURLYTHEME"),
			            "value" => "Nihil hic munitissimus habendi senatus locus, nihil horum?",
			            "param_name" => "description"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Link", "CURLYTHEME"),
			            "value" => "#",
			            "param_name" => "link"
			        )
			    )
			) );
		}
		
		/** Isotope Shortcode */
		public function isotope( $atts, $content = null ){
			
			wp_enqueue_script('curly-isotope');
			
			$filters = ( isset( $atts['filters'] ) ) ? explode(',', $atts['filters'] ) : null;
			
			$html = '<ul class="list-inline" id="isotope-filter">';
			$html .= ( isset( $atts['filters_before'] ) ) ? '<li><strong>'.$atts['filters_before'].'</strong></li>' : null;
			$html .= ( isset( $atts['filters_all'] ) ) ? '<li class="selected" data-filter="*"><a href="#">'.$atts['filters_all'].'</a></li>' : null;
			if ( is_array( $filters ) ) {
				foreach ( $filters as $key => $value) {
					$html .= '<li><a href="#" data-filter=".'.trim($value).'">'.ucwords($value).'</a></li>';
				}
			}
			$html .= '</ul><br>';
			$html .= '<div id="isotope" data-isotope-options="{ "layoutMode": "horizontal", "itemSelector": ".item" }">';
			$html .= do_shortcode( $content );
			$html .= '</div>';		
			
			$html .= "<script type='text/javascript'>( function( $ ) { $( document ).ready(function() {
				$('#isotope').isotope();
				$('#isotope-filter a').on('click', function (e) {
					e.preventDefault();
					var filterValue = $(this).attr('data-filter');
					$('#isotope').isotope({ layoutMode: 'fitRows', filter: filterValue });
					$(this).parent().siblings().removeClass('selected');
					$(this).parent().addClass('selected');
					if ( ! $('#footer').hasClass( 'animated_off' ) ) {
						$('aside', '#footer').delay(150).velocity('transition.slideUpIn', { drag: true, stagger: 50 });
						$('#footer').addClass( 'animated_off' );
					}
				});
			}); } )( jQuery );</script>";
			
			return $html;
			
		}
		
		/** Isotope Shortcode Item */
		public function isotope_item( $atts, $content = null ){
		
			$filters = ( isset( $atts['filters'] ) ) ? explode(',', $atts['filters'] ) : null;
			$title = isset( $atts['title'] ) ? $atts['title'] : null;
			
			$html  = '<div class="item '.( is_array( $filters ) ? implode(' ', $filters) : null ).'">';
			$html .= '<a href="'.( isset( $atts['link'] ) ? $atts['link'] : '#' ).'" class="link-image">'.( isset( $atts['image'] ) ? wp_get_attachment_image( $atts['image'] , 'medium') : '<img src="'.vc_asset_url( 'vc/no_image.png' ).'" alt="'.$title.'">' ).'</a>';
			$html .= '<div class="item-content">';
			$html .= $title ? '<h4><a href="'.( isset( $atts['link'] ) ? $atts['link'] : '#' ).'">'.$title.'</a></h4>' : null;
			$html .= '<p>'.( isset( $atts['description'] ) ? $atts['description'] : null ).'</p>';
			$html .= '</div>';
			$html .= '</div>';
	
			
			return $html;
			
		}
		
		/** Visual Composer Isotope */
		public function isotope_vc() {
		
			/** Isotope Container */
			vc_map( array(
			   "name" => __("Isotope Grid", "CURLYTHEME"),
			   "base" => "curly_isotope",
			   "as_parent" => array('only' => 'curly_isotope_item'),
			   "content_element" => true,
			   'is_container' => true,
			   "show_settings_on_create" => false,
			   "admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			   "icon" => "curly_icon",
			   "class" => "",
			   "category" => __('Curly Themes Extension', "CURLYTHEME"),
			   "params" => array(
			      array(
			         "type" => "textfield",
			         "heading" => __("Filters Text", "CURLYTHEME"),
			         "param_name" => "filters_before",
			         "value" => 'Filter Services',
			         "description" => __("Enter the text before the filters", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("All Items Text", "CURLYTHEME"),
			         "param_name" => "filters_all",
			         "value" => 'All',
			         "description" => __("Enter the text for all items", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Filter Tags", "CURLYTHEME"),
			         "param_name" => "filters",
			         "description" => __("Enter a comma separated list for filters (ie: sky, water sports, nightlife)", "CURLYTHEME")
			      )
			   ),
			   "js_view" => 'VcColumnView'
			) );
			
			/** Isotope Item */
			vc_map( array(
			    "name" => __("Isotope Grid Item", "CURLYTHEME"),
			    "base" => "curly_isotope_item",
			    "content_element" => true,
			    "icon" => "curly_icon",
			    "as_child" => array('only' => 'curly_isotope'), 			    
			    "params" => array(
			        array(
			            "type" => "textfield",
			            "heading" => __("Title", "CURLYTHEME"),
			            "holder" => "div",
			            "value" => "Some title here",
			            "param_name" => "title"
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Description", "CURLYTHEME"),
			            "value" => "Nihil hic munitissimus habendi senatus locus, nihil horum?",
			            "param_name" => "description"
			        ),
			        array(
			            "type" => "attach_image",
			            "heading" => __("Image", "CURLYTHEME"),
			            "param_name" => "image"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Link", "CURLYTHEME"),
			            "value" => "#",
			            "param_name" => "link"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Filter Tags", "CURLYTHEME"),
			            "param_name" => "filters",
			            "description" => __("Enter a comma separated list for filters (ie: sky, water sports, nightlife)", "CURLYTHEME")
			        )
			    )
			) );
		}
		
		/** Testimonials Services Shortcode */
		public function services_carousel( $atts, $content = null ){
			$_SESSION['curly_services'] = ( isset( $_SESSION['curly_services'] ) ) ? + 1 : 0;
			
			$html = null;
			
			if ( isset( $atts['title'] ) ) {
				$html .= '<h2 class="text-center">';
				$html .= isset( $atts['subtitle'] ) ? '<small>'.$atts['subtitle'].'</small>' : null;
				$html .= $atts['title'];
				$html .= '</h2>';
			}
			
			$html .= '<div class="services-carousel" id="services_carousel_'.$_SESSION['curly_services'].'">'.do_shortcode($content).'</div>';
			
			$items 			= ( isset( $atts['items'] ) ) ? $atts['items'] : 3;
			$items_tablet 	= ( isset( $atts['items_table'] ) ) ? $atts['items_tablet'] : 2;
			$items_mobile	= ( isset( $atts['items_mobile'] ) ) ? $atts['items_mobile'] : 1;
			$dots			= ( isset( $atts['dots'] ) ) ? 'true' : 'false';
			$hover			= ( isset( $atts['hover'] ) ) ? 'true' : 'false';
			$loop			= ( isset( $atts['loop'] ) ) ? 'true' : 'false';
			if ( isset( $atts['next'] ) && isset( $atts['prev'] ) ) {
				$nav = 'true';
				$nav_text = '["'.$atts['next'] .'","'.$atts['prev'].'"]';
			} else {
				$nav = 'false';
				$nav_text = '[]';
			}
			if ( isset( $atts['autoplay_speed'] ) ) {
				$autoplay = 'true';
				$autoplay_speed = $atts['autoplay_speed'];
			} else {
				$autoplay = 'false';
				$autoplay_speed = 0;
			}
			
			$html .= "<script type='text/javascript'>( function( $ ) {
						
				$( document ).ready(function() {
				    $('#services_carousel_{$_SESSION['curly_services']}').owlCarousel({
				    	items				: {$items},
				    	margin				: 20,
				    	nav					: {$nav},
				    	navtext				: {$nav_text},
				    	loop 				: {$loop},
				    	autoplay 			: {$autoplay},
				    	autoplayTimeout		: {$autoplay_speed},
				    	autoplayHoverPause	: {$hover},
				    	responsive			: {
				    		0 : {
				    			items 	: {$items_mobile},
				    			dots	: {$dots},
				    			nav		: {$nav}
				    		},
				    		767 : {
				    			items 	: {$items_tablet},
				    			dots	: {$dots}
				    		},
				    		992 : {
				    			items 	: {$items},
				    			dots	: {$dots}
				    		}
				    	}
				    });
				});
						
			} )( jQuery );</script>";
			
			return $html;
			
		}
		
		/** Service Shortcode */
		public function service( $atts, $content = null ){
			$title = isset( $atts['title'] ) ? $atts['title'] : null;
			$html  = "<div class='item'>";
			$html .= '<a href="'.( isset( $atts['link'] ) ? $atts['link'] : '#' ).'" class="link-image">'.( isset( $atts['image'] ) ? wp_get_attachment_image( $atts['image'] , 'large') : '<img src="'.vc_asset_url( 'vc/no_image.png' ).'" alt="'.$title.'">' ).'</a>';
			$html .= '<div class="item-content">';
			$html .= $title ? '<h4><a href="'.( isset( $atts['link'] ) ? $atts['link'] : '#' ).'">'.$title.'</a></h4>' : null;
			$html .= '<p>'.( isset( $atts['description'] ) ? $atts['description'] : null ).'</p>';
			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}
		
		/** Visual Composer Services Carousel */
		public function services_carousel_vc() {
		
			/** Carousel Container */
			vc_map( array(
			   "name" => __("Services Carousel", "CURLYTHEME"),
			   "base" => "curly_services_carousel",
			   "as_parent" => array('only' => 'curly_service'),
			   "content_element" => true,
			   'is_container' => true,
			   "show_settings_on_create" => false,
			   "admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			   "icon" => "curly_icon",
			   "class" => "",
			   "category" => __('Curly Themes Extension', "CURLYTHEME"),
			   "params" => array(
			   	  array(
			   	     "type" => "textfield",
			   	     "heading" => __("Widget Title", "CURLYTHEME"),
			   	     'edit_field_class' => 'vc_col-sm-6',
			   	     "param_name" => "title",
			   	     "value" => null,
			   	     "description" => __("Enter widget title", "CURLYTHEME")
			   	  ),
			   	  array(
			   	     "type" => "textfield",
			   	     "heading" => __("Widget Subtitle", "CURLYTHEME"),
			   	     'edit_field_class' => 'vc_col-sm-6 vc_column',
			   	     "param_name" => "subtitle",
			   	     "value" => null,
			   	     "description" => __("Enter widget subtitle", "CURLYTHEME")
			   	  ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Desktop Services", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4',
			         "param_name" => "items",
			         "value" => 3,
			         "description" => __("Services on a computer", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Tablet Services", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4',
			         "param_name" => "items_tablet",
			         "value" => 2,
			         "description" => __("Services on a tablet", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Mobile Services", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4 vc_column',
			         "param_name" => "items_mobile",
			         "value" => 1,
			         "description" => __("Services on a mobile", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Autoplay Speed", "CURLYTHEME"),
			         "param_name" => "autoplay_speed",
			         "value" => 2000,
			         "description" => __("Choose the carousel autoplay speed in milliseconds. Leave blank to disable the autoplay", "CURLYTHEME")
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Pause on hover", "CURLYTHEME"),
			         "param_name" => "hover",
			         'value' => array( __( 'Yes, pause carousel on hover', 'CURLYTHEMES' ) => 'yes' )
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Loop", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "loop",
			         'value' => array( __( 'Yes, play the carousel in a loop', 'CURLYTHEMES' ) => 'yes' )
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Navigation", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "dots",
			         'value' => array( __( 'Yes, enable dots navigation', 'CURLYTHEMES' ) => 'yes' )
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Next Button Text", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "next",
			         "value" => 'Next',
			         "description" => __("Leave blank to disable links", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Previous Button Text", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "prev",
			         "value" => 'Prev',
			         "description" => __("Leave blank to disable links", "CURLYTHEME")
			      )
			   ),
			   "js_view" => 'VcColumnView'
			) );
			
			/** Carousel Item */
			vc_map( array(
			    "name" => __("Carousel Service", "CURLYTHEME"),
			    "base" => "curly_service",
			    "content_element" => true,
			    "icon" => "curly_icon",
			    "as_child" => array('only' => 'curly_services_carousel'), 			    
			    "params" => array(
			        array(
			            "type" => "textfield",
			            "heading" => __("Title", "CURLYTHEME"),
			            "holder" => "div",
			            "value" => "Some title here",
			            "param_name" => "title"
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Description", "CURLYTHEME"),
			            "value" => "Nihil hic munitissimus habendi senatus locus, nihil horum?",
			            "param_name" => "description"
			        ),
			        array(
			            "type" => "attach_image",
			            "heading" => __("Image", "CURLYTHEME"),
			            "param_name" => "image"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Link", "CURLYTHEME"),
			            "value" => "#",
			            "param_name" => "link"
			        )
			    )
			) );
		}
		
		/** Testimonials Carousel Shortcode */
		public function testimonials_carousel( $atts, $content = null ) {
			
			$html = null;
			
			$_SESSION['curly_testimonials'] = ( isset( $_SESSION['curly_testimonials'] ) ) ? + 1 : 0;
			
			if ( isset( $atts['title'] ) ) {
				$html .= '<h2 class="text-center">';
				$html .= isset( $atts['subtitle'] ) ? '<small>'.$atts['subtitle'].'</small>' : null;
				$html .= $atts['title'];
				$html .= '</h2>';
			}
			
			$html .= '<div class="testimonials-carousel" id="testimonials_carousel_'.$_SESSION['curly_testimonials'].'">'.do_shortcode($content).'</div>';
			
			$items 			= ( isset( $atts['items'] ) ) ? $atts['items'] : 3;
			$items_tablet 	= ( isset( $atts['items_table'] ) ) ? $atts['items_tablet'] : 2;
			$items_mobile	= ( isset( $atts['items_mobile'] ) ) ? $atts['items_mobile'] : 1;
			$dots			= ( isset( $atts['dots'] ) ) ? 'true' : 'false';
			$hover			= ( isset( $atts['hover'] ) ) ? 'true' : 'false';
			$loop			= ( isset( $atts['loop'] ) ) ? 'true' : 'false';
			if ( isset( $atts['next'] ) && isset( $atts['prev'] ) ) {
				$nav = 'true';
				$nav_text = '["'.$atts['next'] .'","'.$atts['prev'].'"]';
			} else {
				$nav = 'false';
				$nav_text = '[]';
			}
			if ( isset( $atts['autoplay_speed'] ) ) {
				$autoplay = 'true';
				$autoplay_speed = $atts['autoplay_speed'];
			} else {
				$autoplay = 'false';
				$autoplay_speed = 0;
			}
			
			$html .= "<script type='text/javascript'>( function( $ ) {
						
				$( document ).ready(function() {
				    $('#testimonials_carousel_{$_SESSION['curly_testimonials']}').owlCarousel({
				    	items				: {$items},
				    	margin				: 20,
				    	nav					: {$nav},
				    	navtext				: {$nav_text},
				    	loop 				: {$loop},
				    	autoplay 			: {$autoplay},
				    	autoplayTimeout		: {$autoplay_speed},
				    	autoplayHoverPause	: {$hover},
				    	responsive			: {
				    		0 : {
				    			items 	: {$items_mobile},
				    			dots	: {$dots},
				    			nav		: {$nav}
				    		},
				    		767 : {
				    			items 	: {$items_tablet},
				    			dots	: {$dots}
				    		},
				    		992 : {
				    			items 	: {$items},
				    			dots	: {$dots}
				    		}
				    	}
				    });
				});
						
			} )( jQuery );</script>";
			
			return $html;
		}
		
		/** Testimonial Shortcode */
		public function testimonial( $atts, $content = null ) {
			$html = "<div class='testimonial'>";
			$html .= ( isset( $atts['name'] ) ) ? "<h4 class='testimonial-title'>".$atts['name'] : null;
			$html .= ( isset( $atts['date'] ) ) ? "<small>".$atts['date']."</small>" : null;
			$html .= ( isset( $atts['name'] ) ) ? "</h4>" : null;
			$html .= "<p>".$atts['testimonial']."</p>";
			$html .= ( isset( $atts['link'] ) && isset( $atts['text_link'] ) ) ? "<a href='{$atts['link']}' class='btn-inline btn'>{$atts['text_link']}</a>" : null;
			$html .= '</div>';
			
			return $html;
		}
		
		/** Visual Composer Testimonials Carousel */
		public function testimonials_carousel_vc() {
		
			/** Carousel Container */
			vc_map( array(
			   "name" => __("Testimonials Carousel", "CURLYTHEME"),
			   "base" => "curly_testimonials_carousel",
			   "as_parent" => array('only' => 'curly_testimonial'),
			   "content_element" => true,
			   'is_container' => true,
			   "show_settings_on_create" => false,
			   "admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			   "icon" => "curly_icon",
			   "class" => "",
			   "category" => __('Curly Themes Extension', "CURLYTHEME"),
			   "params" => array(
			   	  array(
			   	     "type" => "textfield",
			   	     "heading" => __("Widget Title", "CURLYTHEME"),
			   	     'edit_field_class' => 'vc_col-sm-6',
			   	     "param_name" => "title",
			   	     "value" => null,
			   	     "description" => __("Enter widget title", "CURLYTHEME")
			   	  ),
			   	  array(
			   	     "type" => "textfield",
			   	     "heading" => __("Widget Subtitle", "CURLYTHEME"),
			   	     'edit_field_class' => 'vc_col-sm-6 vc_column',
			   	     "param_name" => "subtitle",
			   	     "value" => null,
			   	     "description" => __("Enter widget subtitle", "CURLYTHEME")
			   	  ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Desktop Testimonials", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4 vc_column',
			         "param_name" => "items",
			         "value" => 3,
			         "description" => __("Testimonials on a computer", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Tablet Testimonials", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4 vc_column',
			         "param_name" => "items_tablet",
			         "value" => 2,
			         "description" => __("Testimonials on a tablet", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Mobile Testimonials", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-4 vc_column',
			         "param_name" => "items_mobile",
			         "value" => 1,
			         "description" => __("Testimonials on a mobile", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Autoplay Speed", "CURLYTHEME"),
			         "param_name" => "autoplay_speed",
			         "value" => 2000,
			         "description" => __("Choose the carousel autoplay speed in milliseconds. Leave blank to disable the autoplay", "CURLYTHEME")
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Pause on hover", "CURLYTHEME"),
			         "param_name" => "hover",
			         'value' => array( __( 'Yes, pause carousel on hover', 'CURLYTHEMES' ) => 'yes' )
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Loop", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "loop",
			         'value' => array( __( 'Yes, play the carousel in a loop', 'CURLYTHEMES' ) => 'yes' )
			      ),
			      array(
			         "type" => "checkbox",
			         "heading" => __("Navigation", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "dots",
			         'value' => array( __( 'Yes, enable dots navigation', 'CURLYTHEMES' ) => 'yes' )
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Next Button Text", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "next",
			         "value" => 'Next',
			         "description" => __("Leave blank to disable links", "CURLYTHEME")
			      ),
			      array(
			         "type" => "textfield",
			         "heading" => __("Previous Button Text", "CURLYTHEME"),
			         'edit_field_class' => 'vc_col-sm-6 vc_column',
			         "param_name" => "prev",
			         "value" => 'Prev',
			         "description" => __("Leave blank to disable links", "CURLYTHEME")
			      )
			   ),
			   "js_view" => 'VcColumnView'
			) );
			
			/** Carousel Item */
			vc_map( array(
			    "name" => __("Testimonial" , "CURLYTHEME"),
			    "base" => "curly_testimonial",
			    "content_element" => true,
			    "icon" => "curly_icon",
			    "as_child" => array('only' => 'curly_testimonials_carousel'), 			    
			    "params" => array(
			        array(
			            "type" => "textfield",
			            "heading" => __("Person Name", "CURLYTHEME"),
			            "holder" => "div",
			            "value" => "Curly Green",
			            "param_name" => "name"
			        ),
			        array(
			            "type" => "textarea",
			            "heading" => __("Testimonial", "CURLYTHEME"),
			            "value" => "Nihil hic munitissimus habendi senatus locus, nihil horum?",
			            "param_name" => "testimonial"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Date", "CURLYTHEME"),
			            "value" => "Jan 14, 2014",
			            "param_name" => "date"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Text Link", "CURLYTHEME"),
			            'edit_field_class' => 'vc_col-sm-4 vc_column',
			            "value" => "View Story",
			            "param_name" => "text_link"
			        ),
			        array(
			            "type" => "textfield",
			            "heading" => __("Link", "CURLYTHEME"),
			            "value" => "#",
			            'edit_field_class' => 'vc_col-sm-8 vc_column',
			            "param_name" => "link"
			        )
			    )
			) );
		}
		
		/** Video File Param Type */
		public function curly_video_file( $settings, $value ) {
		   $dependency = vc_generate_dependencies_attributes($settings);
		   return '<div class="button_param">'
		   			 .'<input readonly name="'.$settings['param_name']
		             .'" class="wpb_vc_param_value wpb-textinput '
		             .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
		             .$value.'" ' . $dependency . ' style="margin-bottom: 10px" />'
		             .'<input class="vc_btn vc_upload_video vc_panel-btn-save vc_btn-primary" type="button" value="'
		             .__('Choose Video', 'CURLYTHEME').'" style="width: auto" />'
		             .'<input class="vc_btn vc_clear_video vc_panel-btn-save vc_btn-danger" type="button" value="'
		             .__('Clear Video', 'CURLYTHEME').'" style="width: auto; margin-left: 10px;" />'
		         .'</div>';
		}
		
		/** Extend VC Row */
		public function construct_row() {
			
			/** Background Image Position */
			$attributes = array(
				'type' => 'dropdown',
				'heading' => __("Background Image Position", 'CURLYTHEME'),
				'param_name' => 'position',
				'value' => array( 
					__('Theme Defaults', 'CURLYTHEME') => null,
					__('Top Left', 'CURLYTHEME') 		=> 'top left',
					__('Top Center', 'CURLYTHEME') 		=> 'top center',
					__('Top Right', 'CURLYTHEME') 		=> 'top right',
					__('Middle Left', 'CURLYTHEME') 	=> 'center left',
					__('Middle Center', 'CURLYTHEME')	=> 'center center',
					__('Middle Right', 'CURLYTHEME') 	=> 'center right',
					__('Bottom Left', 'CURLYTHEME') 	=> 'bottom left',
					__('Bottom Center', 'CURLYTHEME') 	=> 'bottom center',
					__('Bottom Right', 'CURLYTHEME') 	=> 'bottom right',
				),
				'group' => __( 'Design options', 'CURLYTHEME' )
			);
			vc_add_param('vc_row', $attributes);
			
			/** Minimum Height */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Minimum Height (Optional)", "CURLYTHEME"),
				'param_name' => 'min_height',
				"description" => __("Enter the minimum height value in pixels for this row", "CURLYTHEME"),
				'group' => __( 'Design options', 'CURLYTHEME' )
				
			);
			vc_add_param('vc_row', $attributes);
			
			/** Enable Parallax */
			$attributes = array(
				'type' => 'checkbox',
				'heading' => __("Enable Background Image Parallax", "CURLYTHEME"),
				'param_name' => 'parallax',
				'value' => array( __( 'Yes, give this row a parallax effect', 'CURLYTHEMES' ) => 'yes' ),
				'group' => __( 'Parallax', 'CURLYTHEMES' )
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Speed */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Parallax Ratio", "CURLYTHEME"),
				'param_name' => 'parallax_ratio',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'parallax',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Enable Parallax Layers */
			$attributes = array(
				'type' => 'checkbox',
				'heading' => __("Enable Parallax Layers", "CURLYTHEME"),
				'param_name' => 'parallax_layers',
				'value' => array( __( 'Yes, enable parallax layers for this container', 'CURLYTHEMES' ) => 'yes' ),
				'group' => __( 'Parallax', 'CURLYTHEMES' )
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Offset Parrent */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Offset Parallax Layers", "CURLYTHEME"),
				'param_name' => 'parallax_offset',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Yes, apply style to images", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Style */
			$attributes = array(
				'type' => 'checkbox',
				'heading' => __("Style Parallax Images", "CURLYTHEME"),
				'param_name' => 'style_images',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				'value' => array( __( 'Yes, style the parallax images', 'CURLYTHEMES' ) => 'yes' ),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Image */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Parallax Layer 1", "CURLYTHEME"),
				'param_name' => 'layer_1',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Choose an image as parallax layer", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Vertical Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Vertical", "CURLYTHEME"),
				'param_name' => 'layer_1_vertical',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Parallax layer 1 vertical position (ie: top: 50px)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Horizontal Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Horizontal", "CURLYTHEME"),
				'param_name' => 'layer_1_horizontal',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Parallax layer 1 horizontal position (ie: left: 25%)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Parallax Ratio", "CURLYTHEME"),
				'param_name' => 'layer_1_ratio',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Width", "CURLYTHEME"),
				'param_name' => 'layer_1_width',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 Height", "CURLYTHEME"),
				'param_name' => 'layer_1_height',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 1 z-index", "CURLYTHEME"),
				'param_name' => 'layer_1_z',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_1',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #2 Image */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Parallax Layer 2", "CURLYTHEME"),
				'param_name' => 'layer_2',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Choose an image as parallax layer", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #2 Vertical Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Vertical", "CURLYTHEME"),
				'param_name' => 'layer_2_vertical',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Parallax layer 2 vertical position (ie: top: 50px)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #2 Horizontal Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Horizontal", "CURLYTHEME"),
				'param_name' => 'layer_2_horizontal',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Parallax layer 2 horizontal position (ie: left: 25%)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #2 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Parallax Ratio", "CURLYTHEME"),
				'param_name' => 'layer_2_ratio',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Width", "CURLYTHEME"),
				'param_name' => 'layer_2_width',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 Height", "CURLYTHEME"),
				'param_name' => 'layer_2_height',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 2 z-index", "CURLYTHEME"),
				'param_name' => 'layer_2_z',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_2',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #3 Image */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Parallax Layer 3", "CURLYTHEME"),
				'param_name' => 'layer_3',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Choose an image as parallax layer", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'parallax_layers',
					'value' => array( 'yes', 'true' )
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #3 Vertical Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Vertical", "CURLYTHEME"),
				'param_name' => 'layer_3_vertical',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Parallax layer 3 vertical position (ie: top: 50px)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #3 Horizontal Value */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Horizontal", "CURLYTHEME"),
				'param_name' => 'layer_3_horizontal',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Parallax layer 3 horizontal position (ie: left: 25%)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #3 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Parallax Ratio", "CURLYTHEME"),
				'param_name' => 'layer_3_ratio',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Enter the parallax ratio (ie. 0.5)", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Width", "CURLYTHEME"),
				'param_name' => 'layer_3_width',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 Height", "CURLYTHEME"),
				'param_name' => 'layer_3_height',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Parallax Layer #1 Radio */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Layer 3 z-index", "CURLYTHEME"),
				'param_name' => 'layer_3_z',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'group' => __( 'Parallax', 'CURLYTHEMES' ),
				"description" => __("Leave empty for default", "CURLYTHEME"),
				'dependency' => array(
					'element' => 'layer_3',
					'not_empty'=> true
				)
			);
			vc_add_param('vc_row', $attributes);
			
			/** Video Cover */
			$attributes = array(
				'type' => 'attach_image',
				'heading' => __("Video Background Cover", "CURLYTHEME"),
				'param_name' => 'video_cover',
				'group' => __( 'Video Background', 'CURLYTHEMES' ),
				"description" => __("Choose an image as your video cover", "CURLYTHEME")
			);
			vc_add_param('vc_row', $attributes);
			
			/** External Video */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("External Video", "CURLYTHEME"),
				'param_name' => 'video',
				'group' => __( 'Video Background', 'CURLYTHEMES' ),
				"description" => __("Enter the URL of your external YouTube or Vimeo video", "CURLYTHEME")
			);
			vc_add_param('vc_row', $attributes);
			
			/** MP4 Video File */
			$attributes = array(
				'type' => 'curly_video_file',
				'heading' => __("MP4 File", "CURLYTHEME"),
				'param_name' => 'video_mp4',
				'group' => __( 'Video Background', 'CURLYTHEMES' )
			);
			vc_add_param('vc_row', $attributes);
			
			/** OGG Video File */
			$attributes = array(
				'type' => 'curly_video_file',
				'heading' => __("OGV File", "CURLYTHEME"),
				'param_name' => 'video_ogg',
				'group' => __( 'Video Background', 'CURLYTHEMES' )
			);
			vc_add_param('vc_row', $attributes);
			
			/** WEBM Video File */
			$attributes = array(
				'type' => 'curly_video_file',
				'heading' => __("WEBM File", "CURLYTHEME"),
				'param_name' => 'video_webm',
				'group' => __( 'Video Background', 'CURLYTHEMES' )
			);
			vc_add_param('vc_row', $attributes);
		}
		
		/** Extend VC Images Carousel */
		public function construct_images_carousel() {
			
			/** Previous Link */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Previous Link Text", "CURLYTHEME"),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'param_name' => 'prev',
				"description" => __("Enter the previous link text", "CURLYTHEME")
			);
			vc_add_param('vc_images_carousel', $attributes);
			
			/** Next Link */
			$attributes = array(
				'type' => 'textfield',
				'heading' => __("Next Link Text", "CURLYTHEME"),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'param_name' => 'next',
				"description" => __("Enter the previous link text", "CURLYTHEME")
			);
			vc_add_param('vc_images_carousel', $attributes);
		}
		
		/** Extend VC Tabs */
		public function construct_tabs() {
			
			/** Tabs Style */
			$attributes = array(
				'type' => 'dropdown',
				'heading' => __("Tabs Style", 'CURLYTHEME'),
				'param_name' => 'style',
				'value' => array( 
					__('Default', 'CURLYTHEME') => null,
					__('Style 1', 'CURLYTHEME') => 1
				)
			);
			vc_add_param('vc_tabs', $attributes);
		}
		
		/** Extend VC Gallery */
		public function construct_gallery() {
			
			/** Columns */
			$attributes = array(
				'type' => 'dropdown',
				'heading' => __("Gallery Columns", 'CURLYTHEME'),
				'param_name' => 'columns',
				'value' => array( 
					__('Five Columns', 'CURLYTHEME') => 5,
					__('Four Columns', 'CURLYTHEME') => 4,
					__('Three Columns', 'CURLYTHEME') => 3,
					__('Two Columns', 'CURLYTHEME') => 2,
					__('One Column', 'CURLYTHEME') => 1,
				)
			);
			vc_add_param('vc_gallery', $attributes);
		}
		
		/** Set as Theme */
		function set_as_theme() {
			vc_set_as_theme();
		}
	}
	
	/** Initialize the Class */
	new CurlyLeisureVisualComposer();
	
	/** Check if Visual Composer is Activated */
	if ( defined( 'WPB_VC_VERSION' ) ) {
		
		/** Extend Classes */
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_Curly_Testimonials_Carousel extends WPBakeryShortCodesContainer {}
		    class WPBakeryShortCode_Curly_Services_Carousel extends WPBakeryShortCodesContainer {}
		    class WPBakeryShortCode_Curly_Isotope extends WPBakeryShortCodesContainer {}
		    class WPBakeryShortCode_Curly_Services_List extends WPBakeryShortCodesContainer {}
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
		    class WPBakeryShortCode_Curly_Testimonial extends WPBakeryShortCode {}
		    class WPBakeryShortCode_Curly_Service extends WPBakeryShortCode {}
		    class WPBakeryShortCode_Curly_Isotope_Item extends WPBakeryShortCode {}
		    class WPBakeryShortCode_Curly_Services_List_Item extends WPBakeryShortCode {}
		}
	
	}
	
?>