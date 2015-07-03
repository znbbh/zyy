<?php 

/*	Theme Customizer
	================================================= */	
	
	function curly_leisure_customizer( $wp_customize ) {
		
		/** 
		* Textarea Control
		* 
		* @since 1.0
		*/
		class Curly_Customize_Textarea_Control extends WP_Customize_Control {
		    public $type = 'textarea';
		 
		    public function render_content() {
		        ?>
		            <label>
		                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		            </label>
		        <?php
		    }
		}

		// Remove Sections & Controls
		$wp_customize->remove_control( 'display_header_text' );
		$wp_customize->remove_control( 'header_textcolor' );
		
		// Live Preview
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->default = '#ffffff';
		
		// Add Sections & Controls
		$wp_customize->add_setting( THEMEPREFIX.'_tagline',
			array(
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( THEMEPREFIX.'_tagline',
			array(
				'type' => 'text',
				'label' => __( 'Right Tagline', 'CURLYTHEME' ),
				'section' => 'title_tagline',
				'settings' => THEMEPREFIX.'_tagline'
			)
		);
		
		// Text Color
		$wp_customize->add_setting( 'text_color',
			array(
				'default' 	=> '#667279',
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
				'label'      => __( 'Text Color', 'CURLYTHEME' ),
				'section'    => 'colors',
				'settings'   => 'text_color'
			) )
		);
		
		// Link Color
		$wp_customize->add_setting( 'link_color',
			array(
				'default' => '#363D40',
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( $wp_customize, 'link_color_tc', array(
				'label'      => __( 'Link Color', 'CURLYTHEME' ),
				'section'    => 'colors',
				'settings'   => 'link_color',
			) )
		);
		
		// Primary Color
		$wp_customize->add_setting( 'primary_color',
			array(
				'default' => '#C0392B',
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( $wp_customize, 'primary_color_tc', array(
				'label'      => __( 'Primary Color', 'CURLYTHEME' ),
				'section'    => 'colors',
				'settings'   => 'primary_color',
			) )
		);
		
		// Sticky Menu
		$wp_customize->add_setting( 'sticky_menu',
			array(
				'default' => true,
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 
			new WP_Customize_Control( $wp_customize, 'sticky_menu', array(
				'label'      => __( 'Enable Main Menu Sticky', 'CURLYTHEME' ),
				'type'		 => 'checkbox',
				'priority'	 => 10,
				'section'    => 'nav',
				'settings'   => 'sticky_menu',
			) )
		);
		
		// Search in Menu
		$wp_customize->add_setting( 'search_menu',
			array(
				'default' => true,
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 
			new WP_Customize_Control( $wp_customize, 'search_menu', array(
				'label'      => __( 'Enable Search in Main Menu', 'CURLYTHEME' ),
				'type'		 => 'checkbox',
				'priority'	 => 10,
				'section'    => 'nav',
				'settings'   => 'search_menu',
			) )
		);
		
		// Footer Section
		$wp_customize->add_section( 'footer' , array(
		    'title'      => __('Footer','CURLYTHEME'),
		    'priority'   => 70
		) );
		
		// Footer Columns
		$wp_customize->add_setting( 'footer_columns',
			array(
				'default' => 6,
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 
			new WP_Customize_Control( $wp_customize, 'footer_columns', array(
				'label'      => __( 'Footer Columns', 'CURLYTHEME' ),
				'type'		 => 'select',
				'section'    => 'footer',
				'settings'   => 'footer_columns',
				'choices'  	 => array(
					1 => __( 'One Column', 'CURLYTHEME' ),
					2 => __( 'Two Columns', 'CURLYTHEME' ),
					3 => __( 'Three Columns', 'CURLYTHEME' ),
					4 => __( 'Four Columns', 'CURLYTHEME' ),
					6 => __( 'Six Columns', 'CURLYTHEME' ),
				)
			) )
		);
		
		// Copyright
		$wp_customize->add_setting( 'footer_copyright',
			array(
				'default' => 'Leisure - HTML Template. Designed with special care by <a href="http://'.'demo.curlythemes'.'.com" target="_blank"><abbr title="Premium WordPress Themes & Plugins">Curly Themes</abbr></a>. All Rights Reserved.<span class="pull-right">[icon icon=rss boxed=yes] [icon icon=pinterest boxed=yes] [icon icon=facebook boxed=yes] [icon icon=twitter boxed=yes]</span>',
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 
			new Curly_Customize_Textarea_Control( $wp_customize, 'footer_copyright', array(
				'label'      => __( 'Copyright Text', 'CURLYTHEME' ),
				'type'		 => 'textarea',
				'section'    => 'footer',
				'settings'   => 'footer_copyright',
			) )
		);
		
		// Site Logo
		$wp_customize->add_section( 'logo' , array(
		    'title'      => __('Site Logo','CURLYTHEME'),
		    'priority'   => 30
		) );
		
		// Logo
		$wp_customize->add_setting( 'logo', array(
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( $wp_customize, 'logo', array(
				'label'      => __( 'Logo', 'CURLYTHEME' ),
				'section'    => 'logo',
				'settings'   => 'logo',
			) )
		);
		
		// Retina Logo
		$wp_customize->add_setting( 'logo_retina', array(
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( $wp_customize, 'logo_retina', array(
				'label'      => __( 'Retina Logo (@2x)', 'CURLYTHEME' ),
				'section'    => 'logo',
				'settings'   => 'logo_retina',
			) )
		);
		
		// Header Slider Section
		$wp_customize->add_section( 'header_slider' , array(
		    'title'      => __('Header Slider','CURLYTHEME'),
		    'priority'   => 70,
		    'description'=> __( 'When adding a header slider, you have to bear in mind that the header height will increase to match the height of the slider. Minimum slider height should be 370px.', 'CURLYTHEMES' )
		) );
		$wp_customize->add_setting( 'header_slider',
			array(
				'default' => 0,
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		global $wpdb;
		$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
		$revsliders[0] = __( '- Select Revolution Slider -', 'CURLYTHEME' );
		if( $sliders ) {
			foreach( $sliders as $value ) {
				$revsliders[$value->alias] = $value->title;
			}
		}
		
		$wp_customize->add_control( 
			new WP_Customize_Control( $wp_customize, 'header_slider', array(
				'label'      => __( 'Header Slider', 'CURLYTHEME' ),
				'type'		 => 'select',
				'section'    => 'header_slider',
				'settings'   => 'header_slider',
				'choices'  	 => $revsliders
			) )
		);
		
	}
	add_action( 'customize_register', 'curly_leisure_customizer' );
	
	function curly_leisure_customizer_live_preview(){
		wp_enqueue_script( 
			  'curly-live-customizer', 
			  get_template_directory_uri().'/framework/js/live-customizer.js',
			  array( 'jquery','customize-preview' ),
			  '16',						
			  true					
		);
	}
	add_action( 'customize_preview_init', 'curly_leisure_customizer_live_preview' );
	
/*	Enqueue Customizations
	================================================= */
	function curly_leisure_enqueue_customizations() {
		
		global $curly_theme_options;
		
		$color_text				= new CurlyThemesColor( get_theme_mod('text_color', '#667279') );
		$color_link 			= new CurlyThemesColor( get_theme_mod('link_color', '#363D40') );
		$color_primary 			= new CurlyThemesColor( get_theme_mod('primary_color', '#C0392B' ) );
		$color_bg 				= new CurlyThemesColor( get_theme_mod('background_color', '#ffffff') );
		$global_slider 			= get_theme_mod( 'header_slider' );

		
		/** Header */
		$css = "
			#header{
				background-image: url(".get_header_image().");
				background-color: $color_link;
			}
		";
		if ( $global_slider != '0' ) {
			global $wpdb;
			$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
			foreach ( $sliders as $key => $value) {
				if ( $value->alias == $global_slider ) {
					$params = json_decode( $value->params, true );
				}
			}
			$height = $params['height'];
			
			if ( $height > 370 ) {
				$css .= "
					#header#header{
						min-height: {$height}px
					}
					#slider_container{
						height: {$height}px;
					}
				";
			}
		}
	
		/** Background */
		$bg = get_theme_mod('background_image');
		if ( $bg ) {
			$css .= "
				#site{
					background-image: url($bg);
					background-repeat: ".get_theme_mod('background_repeat').";
					background-position: ".get_theme_mod('background_position_x').";
					background-attachment: ".get_theme_mod('background_attachment').";
				}
			";
		}
		
		$svg_dropdown = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
					<svg width="40px" height="15px" viewBox="0 0 40 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
					    <defs></defs>
					    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
					        <path d="M20,15 L0,15 L10,0 L20,15 Z" id="Triangle-1" fill="'.$color_text.'" sketch:type="MSShapeGroup" transform="translate(10.000000, 7.500000) rotate(-180.000000) translate(-10.000000, -7.500000) "></path>
					    </g>
					</svg>';
		
		$svg_search = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
						<svg width="40px" height="23px" viewBox="0 0 40 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
						    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
						        <path d="M20,19.6703297 C20,20.1078319 19.8477579,20.4864338 19.5432692,20.806147 C19.2387805,21.1258601 18.8782072,21.2857143 18.4615385,21.2857143 C18.028844,21.2857143 17.6682707,21.1258601 17.3798077,20.806147 L13.2572115,16.4900412 C11.8229095,17.5333157 10.2243678,18.0549451 8.46153846,18.0549451 C7.3156994,18.0549451 6.21995715,17.8214738 5.17427885,17.3545244 C4.12860054,16.8875749 3.22716725,16.2565716 2.46995192,15.4614955 C1.7127366,14.6664194 1.11178107,13.7199145 0.667067308,12.6219523 C0.222353546,11.52399 0,10.3734607 0,9.17032967 C0,7.96719865 0.222353546,6.81666929 0.667067308,5.71870707 C1.11178107,4.62074485 1.7127366,3.6742399 2.46995192,2.8791638 C3.22716725,2.08408771 4.12860054,1.45308441 5.17427885,0.986134959 C6.21995715,0.519185509 7.3156994,0.285714286 8.46153846,0.285714286 C9.60737752,0.285714286 10.7031198,0.519185509 11.7487981,0.986134959 C12.7944764,1.45308441 13.6959097,2.08408771 14.453125,2.8791638 C15.2103403,3.6742399 15.8112959,4.62074485 16.2560096,5.71870707 C16.7007234,6.81666929 16.9230769,7.96719865 16.9230769,9.17032967 C16.9230769,11.0213005 16.426287,12.6997693 15.4326923,14.2057864 L19.5552885,18.5345124 C19.8517643,18.845812 20,19.224414 20,19.6703297 Z M13.8461538,9.17032967 C13.8461538,7.6138315 13.3193162,6.28241453 12.265625,5.1760388 C11.2119338,4.06966308 9.94391767,3.51648352 8.46153846,3.51648352 C6.97915925,3.51648352 5.71114309,4.06966308 4.65745192,5.1760388 C3.60376076,6.28241453 3.07692308,7.6138315 3.07692308,9.17032967 C3.07692308,10.7268278 3.60376076,12.0582448 4.65745192,13.1646205 C5.71114309,14.2709963 6.97915925,14.8241758 8.46153846,14.8241758 C9.94391767,14.8241758 11.2119338,14.2709963 12.265625,13.1646205 C13.3193162,12.0582448 13.8461538,10.7268278 13.8461538,9.17032967 Z" id="Type-something" fill="'.$color_text.'" sketch:type="MSShapeGroup"></path>
						    </g>
						</svg>';
		$svg_content_before = '<svg width="1501px" height="351px" viewBox="0 0 1501 351" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"  preserveAspectRatio="none">
		    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
		        <g id="Path-5-+-Path-6-+-Path-4" sketch:type="MSLayerGroup" transform="translate(1.000000, 0.000000)" fill="'.$color_bg.'">
		            <path d="M-0.00828195148,181.294964 C-0.00828195148,181.294964 237.500034,270.628367 730.000034,268.173238 C1222.50003,265.71811 1500,166.18705 1500,166.18705 L1500.00007,350 L-0.00821377435,350 L-0.00828195148,181.294964 Z" id="Path-5" fill-opacity="0.2" sketch:type="MSShapeGroup"></path>
		            <path d="M-0.240827905,246.76259 C-0.240827905,246.76259 341.930129,294.604317 773.710495,226.618705 C1205.49086,158.633094 1500,0 1500,0 L1500.00001,350.579203 L-0.240827905,350.579201 L-0.240827905,246.76259 Z" id="Path-6" fill-opacity="0.2" sketch:type="MSShapeGroup"></path>
		            <path d="M-1.09384359e-07,282.014388 C-1.09384359e-07,282.014388 242.5,355.035971 710,332.374101 C1177.5,309.71223 1500,176.258993 1500,176.258993 L1500,350.018245 L-1.09384359e-07,350.018245 L-1.09384359e-07,282.014388 Z" id="Path-4" sketch:type="MSShapeGroup"></path>
		        </g>
		    </g>
		</svg>';							
		
		/** Coloring */
		$css .= "
			html,
			body,
			a:hover,
			h1 small, h2 small, h3 small, h4 small, h5 small, h6 small,
			.btn.btn-link:hover{
				color: $color_text;
			}
			#site,
			#main-nav,
			#map-description .col-lg-4 > div,
			#search-form{
				background-color: $color_bg;
				color: $color_text
			}
			#main-nav .sub-menu,
			#main-nav .children{
				background-color: $color_bg;
				color: $color_primary;
				border-color: $color_primary;
			}
			.entry-meta,
			.entry-meta a,
			.owl-theme .owl-controls .owl-nav [class*=owl-]:hover{
				color: $color_primary;
			}
			#main-nav .menu > .menu-item:not(.current-menu-item, .current-menu-ancestor, .current_page_parent, .current_page_item):hover > a{
				color: ".$color_link->opacity(0.5).";
			}
			.btn.btn-link:hover::before{
				color: ".$color_primary->darken(20).";
			}
			::selection {
			  background: {$color_primary->opacity(0.9)};
			  color: {$color_primary->contrast('#ffffff', '#000000')};
			  border-radius: 2px;
			}
			::-moz-selection {
			  background: {$color_primary->opacity(0.9)};
			  color: {$color_primary->contrast('#ffffff', '#000000')};
			   border-radius: 2px;
			}
			#secondary-nav .sub-menu{
				background-color: $color_text;
			}
			a,
			blockquote p,
			.pullquote,
			#search-form .search-field,
			#search-form .close-search,
			.owl-theme .owl-controls .owl-nav [class*=owl-],
			#search-form-inline .search-field,
			.sidebar-widget h5,
			#custom-search-form,
			#main-nav .menu > .menu-item > a,
			#main-nav .sub-menu .menu-item > a,
			#main-nav .menu > .page_item > a,
			#main-nav .children .page_item > a,
			.btn.btn-link{
				color: $color_link
			}
			.btn.btn-default{
				color: $color_link;
				border-color: ".$color_link->opacity(0.1).";
				background-color: ".$color_link->opacity(0.1).";
			}
			.btn.btn-default:hover{
				color: $color_link;
				border-color: ".$color_link->opacity(0.25).";
				background-color: ".$color_link->opacity(0.15).";
			}
			.panel.panel-default,
			.entry,
			.widget_archive li,
			.widget_pages li,
			.widget_categories li,
			.list-underline,
			.nav-tabs > li.active > a, 
			.nav-tabs > li.active > a:hover, 
			.nav-tabs > li.active > a:focus,
			.sidebar-widget li{
				border-color: ".$color_text->opacity(0.25)."
			}
			#wp-calendar thead th,
			#wp-calendar tbody td{
				border-color: {$color_text->opacity(0.1)}
			}
			#content h4.wpb_toggle.wpb_toggle{
				background-color: ".$color_text->opacity(0.1).";
				color: $color_link;
			}
			#content h4.wpb_toggle.wpb_toggle.wpb_toggle_title_active,
			.dropcap{
				color: $color_primary;
			}
			.services-carousel .item:hover .item-content,
			.pricing-table .content-column,
			.wpb_toggle_content,
			.panel-default > .panel-heading .accordion-toggle.collapsed{
				background-color: ".$color_text->opacity(0.1).";
			}
			#goog-wm-qt{
				border-color: ".$color_text->opacity(0.25).";
				color: $color_text
			}
			.fa-boxed{
				background-color: {$color_link->opacity(0.85)};
				color: {$color_link->contrast('#ffffff', '#000000')}
			}
			#main-nav .sub-menu .menu-item:hover > a,
			#main-nav .children .page_item:hover > a,
			.entry.sticky,
			.wp-caption-text{
				color: $color_text;
				background: ".$color_text->opacity(0.1).";
			}
			.sticky-wrapper #main-nav.stuck{
				background: ".$color_bg->opacity(0.97)."
			}
			#main-nav .menu > .current-menu-item > a,
			#main-nav .menu > .current-menu-ancestor > a,
			#main-nav .menu > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_item > a,
			#main-nav div.menu > ul > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_ancestor > a,
			#main-nav .sub-menu,
			h5:not(.widget-title),
			blockquote,
			.list-bullet li::before, .list-square li::before, .list-center li::before, .list-center li::after,
			.btn.btn-link::before,
			.comment-reply-link::before,
			.panel-default > .panel-heading .accordion-toggle,
			.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus,
			.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span,
			.owl-theme .owl-controls .owl-nav .owl-next:after, .owl-theme .owl-controls .owl-nav .owl-prev:before,
			.form-group[data-required]::before, div[data-required]::before,
			.entry h1 > small, .entry h2 > small, .entry h3 > small, .entry.quote blockquote > small,
			.meta .fa,
			.list-center li::before, .list-center li::after{
				color: $color_primary
			}
			#main-nav .menu > .current-menu-item > a,
			#main-nav .menu > .current-menu-ancestor > a,
			#main-nav .menu > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_item > a,
			#main-nav div.menu > ul > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_ancestor > a,
			#main-nav .sub-menu,
			.owl-theme .owl-dots.active .owl-dot span{
				border-color: $color_primary
			}
			.list-pointer li::before{
				border-color: transparent transparent transparent $color_primary
			}
			.btn.btn-primary, 
			input[type=submit],
			#goog-wm-sb{
				background-color: $color_primary;
				border-color: $color_primary;
				color: {$color_primary->contrast('#ffffff', '#000000')};
			}
			.btn.btn-primary:hover,
			input[type=submit]:hover{
				background-color: ".$color_primary->darken(20).";
				border-color: ".$color_primary->darken(20).";
				color: {$color_primary->contrast('#ffffff', '#000000')};
			}
			.comments .bypostauthor h6{
				border-bottom-color: $color_primary;
			}
			.pullquote.pull-left{
				border-right: 3px solid ".$color_text->opacity(0.25).";
			}
			.pullquote.pull-right{
				border-left: 3px solid ".$color_text->opacity(0.25).";
			}
			.owl-theme .owl-dots .owl-dot.active span, 
			.owl-theme .owl-dots .owl-dot:hover span{
				background: $color_primary;
				border-color: $color_primary;
			}
			#search-form-inline{
				border-top: 1px solid ".$color_text->opacity(0.1).";
			}
			.comments > ul > li ul.children{
				border-left: 1px solid ".$color_text->opacity(0.25).";
			}
			.comments h6{
				border-bottom: 1px solid ".$color_text->opacity(0.25).";
			}
			.nav-tabs > li > a,
			.nav-tabs > li > a:hover,
			.tab-pane,
			.nav-tabs,
			.list-services li,
			.owl-theme .owl-dots .owl-dot span{
				border-color: ".$color_text->opacity(0.25).";
			}
			#isotope .item-content,
			.services-carousel .item-content{
				border-color: ".$color_text->opacity(0.1).";
			}
			#isotope .item:hover .item-content,
			.nav-tabs > li > a,
			.nav-tabs > li > a:hover,
			#wp-calendar thead th,
			.about-author,
			.list-services a:hover{
				background-color: ".$color_text->opacity(0.05).";
			}
			#content h1[style*='center']::after,
			#content h2[style*='center']::after,
			#content h3[style*='center']::after,
			#content h4[style*='center']::after,
			#content h5[style*='center']::after,
			#content h6[style*='center']::after,
			#content h1.text-center::after,
			#content h2.text-center::after,
			#content h3.text-center::after,
			#content h4.text-center::after,
			#content h5.text-center::after,
			#content h6.text-center::after{
				border-bottom-color: $color_primary;
			}
			.form-control{
				border-color: ".$color_text->opacity(0.25).";
				color: $color_text
			}
			.form-control:focus{
				border-color: {$color_text->opacity(0.65)};
			}
			.entry.format-quote{
				background-color: $color_text;
				color: $color_bg
			}
			.pagination>li>a, .pagination>li>span{
				background-color: $color_bg;
				color: $color_primary;
				border-color: {$color_text->opacity(0.25)};
			}
			.pagination>li:hover>a, .pagination>li:hover>span{
				background-color: {$color_text->opacity(0.1)};
				color: $color_text
			}
			.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, #wp-calendar caption{
				background-color: $color_primary;
				border-color: $color_primary;
				color: $color_bg
			}
			input[type=text], input[type=search], select, textarea, input[type=password],
			input[type=email], input[type=number], input[type=url], input[type=date], input[type=tel]{
				border-color: ".$color_text->opacity(0.25).";
			}
			input[type=text]:focus, input[type=search]:focus, select:focus, textarea:focus, input[type=password]:focus,
			input[type=email]:focus, input[type=number]:focus, input[type=url]:focus, input[type=date]:focus, input[type=tel]:focus{
				border-color: {$color_text->opacity(0.65)};
			}
			select,
			.chosen-single{
				background-image: url(data:image/svg+xml;base64,".base64_encode($svg_dropdown).") !important;
			}
			code{
				color: $color_primary;
				background-color: {$color_primary->opacity(0.1)}
			}
			kbd{
				background-color: $color_text;
				color: {$color_text->contrast('#ffffff', '#000000')}
			}
			pre{
				color: $color_text;
				background-color: {$color_text->opacity(0.1)};
				border-color: {$color_text->opacity(0.25)}
			}
			.widget_search .search-field,
			input[type=text]#s,
			.chosen-search > input[type=text],
			#bbp_search{
				background-image: url(data:image/svg+xml;base64,".base64_encode($svg_search).");
			}
			/*#content::before{
				content: url(data:image/svg+xml;base64,".base64_encode($svg_content_before).");
			}*/
			.modal{
				background: {$color_bg->opacity(0.975)}
			}
			.modal .close{
				color: $color_link
			}
			.modal .close:hover{
				color: $color_primary
			}
		";
		
		/** Media Query */
		$css .= "
			@media (max-width:767px) {
				#main-nav ul.menu,
				#main-nav div.menu > ul{
					background-color: $color_bg;
				}
				#main-nav ul.menu > .menu-item > a,
				#main-nav .sub-menu .menu-item > a,
				#main-nav .sub-menu > .menu-item > a::before,
				#main-nav .sub-menu .sub-menu > .menu-item > a::before,
				#main-nav div.menu > ul > .page_item > a{
					border-color: {$color_text->opacity(0.1)}
				}
		";
		
		wp_add_inline_style( 'curly-style', CurlyThemes::minify_css( htmlspecialchars_decode( $css ) ) ); 
	}
	add_action( 'wp_enqueue_scripts', 'curly_leisure_enqueue_customizations' );
		
?>