<?php 

class CurlyNinjaForms {
	
	function __construct() {
		
		/** Add Styles */
		add_action( 'wp_enqueue_scripts', array ($this, 'load_scripts' ), 100 );
		
		/** Add Admin Styles */
		add_action( 'admin_enqueue_scripts' , array ($this, 'load_admin_scripts' ), 100 );
		
		/** Construct Ninja Forms Extension for Visual Composer */
		if ( defined( 'WPB_VC_VERSION' ) ){ 
			add_action( 'vc_before_init', array( $this, 'ninja_vc' ) );
			add_action( 'vc_before_init', array( $this, 'ninja_default_vc' ) );
			add_action( 'vc_before_init', array( $this, 'ninja_button_vc' ) );
			add_shortcode( 'curly_ninja', array( $this, 'ninja' ) );
			add_shortcode( 'curly_ninja_modal', array( $this, 'ninja_button' ) );
		}
		
		/** Ninja Layout Tab */
		add_action('admin_init', array( $this, 'layout' ) );
		
		/** Filter Form Layout */
		add_action( 'ninja_forms_display_pre_init', array( $this, 'form_layout' ) );
		add_filter( 'ninja_forms_form_class', array( $this, 'prefix_add_custom_form_class' ), 10, 2 );
		
		/** Form Title */
		add_filter( 'ninja_forms_form_title', array( $this, 'form_title' ), 10, 2 );
	}

	
	/** Fix Form Titles */
	function form_title( $form_title, $form_id ) {
		return str_replace('h2', 'h3', $form_title);
	}
	
	/** Form Classes Prefix */
	function prefix_add_custom_form_class( $form_class, $form_id ) {
		$form_layout = get_option( 'ninja_form_layout_'.$form_id );
		if ( isset( $form_layout ) ) {
		    $form_class .= ' container-fluid row';
		  }
		  return $form_class;
	}
	
	function form_layout() {
		global $ninja_forms_loading;
		global $ninja_forms_processing;

		$object = $ninja_forms_loading ? $ninja_forms_loading : $ninja_forms_processing;
		
		$form_layout = unserialize( get_option( 'ninja_form_layout_'.$object->data['form_ID'] ) ); 
		$object_data = $object->data['field_data'];
		
		if ( $object_data ) {
			foreach ( $object_data as $key => $field ) {
				$data = $object->get_field_settings($key);
				$data['data']['class'] = 
					isset( $data['data']['layout'] ) ? 
						$data['data']['class'].' col-'.$data['data']['layout'] : 
						$data['data']['class'];
				$object->update_field_settings( $key, $data );
			}
		}
	}
	
	function load_admin_scripts() {
		$screen = get_current_screen();
		if ( $screen->id == 'toplevel_page_ninja-forms' ) {
			wp_enqueue_style( 'curly-ninja-layout', get_template_directory_uri() . '/framework/css/ninja-layout.css', null, null, 'all');
			wp_enqueue_script('curly-ninja-layout', get_template_directory_uri() . '/framework/js/ninja-layout.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-widget' ));
		}
	}
	
	/** Ninja Layout Tab */
	function layout() {
		if( isset( $_REQUEST['form_id'] ) ){
				$form_id = absint( $_REQUEST['form_id'] );
			} else {
				$form_id = '';
			}
		
			$args = array(
				'name' => __( 'Form Layout', 'CURLYTHEME' ),
				'page' => 'ninja-forms',
				'display_function' => array( $this, 'layout_form' ),
				'save_function' => array( $this, 'layout_form_save' ),
				'disable_no_form_id' => true,
				'show_save' => false,
				'tab_reload' => false,
			);
			ninja_forms_register_tab('layout_settings', $args);
	}
	
	/** Generate Layout Form */
	function layout_form() {
		if( isset( $_REQUEST['form_id'] ) ){
				$form_id = absint( $_REQUEST['form_id'] );
		} else {
			return;
		}
		
		$form_data = ninja_forms_get_fields_by_form_id( $form_id );
		
		$html = '<div id="gridly">';
		foreach ( $form_data  as $field ) {
			$field_layout = isset( $field['data']['layout'] ) ? $field['data']['layout'] : 1;

			switch ( $field_layout ) {
				case 2 : $css = 'col_1_2'; break;
				case 3 : $css = 'col_1_3'; break;
				case 4 : $css = 'col_1_4'; break;
				case 5 : $css = 'col_2_3'; break;
				case 6 : $css = 'col_2_4'; break;
				case 7 : $css = 'col_3_4'; break;
				default: $css = null;
			}
			$html .= '<div class="brick '.$css.'" id="brick-'.$field['id'].'"><div class="inner">';
			$html .= '<span class="field_name">ID: '.$field['id'].' - '.$field['data']['label'].'</span>';
			$html .= '<input type="hidden" name="'.$field['id'].'" value="'.$field_layout.'" />';
			$html .= '<select class="size">';
			$html .= '<option value="1" '.selected( $field_layout, 1 , false).'>1/1</option>';
			$html .= '<option value="2" '.selected( $field_layout, 2 , false).'>1/2</option>';
			$html .= '<option value="3" '.selected( $field_layout, 3 , false).'>1/3</option>';
			$html .= '<option value="5" '.selected( $field_layout, 5 , false).'>2/3</option>';
			$html .= '<option value="4" '.selected( $field_layout, 4 , false).'>1/4</option>';
			$html .= '<option value="6" '.selected( $field_layout, 6 , false).'>2/4</option>';
			$html .= '<option value="7" '.selected( $field_layout, 7 , false).'>3/4</option>';
			$html .= '</select>';
			$html .= '</div></div>';
		}
		$html .= '</div>';
		$html .= '<input type="submit" name="" value="'.__( 'Save Form Layout', 'CURLYTHEME' ).'" class="button-primary" />';
		
		echo $html;
		
	}
	
	/** Save Form Layout */
	function layout_form_save( $form_id, $data ) {
		if ( isset( $data ) ) { 
			global $wpdb; $count = 0;
			foreach ( $data as $field_id => $value ) {
				$field_data = ninja_forms_get_field_by_id( $field_id );
				$field_data['data']['layout'] = $value;
				$data_array = array('data' => serialize( $field_data['data'] ), 'order' => $count );
				$wpdb->update( NINJA_FORMS_FIELDS_TABLE_NAME, $data_array, array( 'id' => $field_id ));
				$count++;
			}
		}
	}
		
	/** Load Scripts */
	function load_scripts() {
		
		wp_enqueue_style( 'curly-ninja', get_template_directory_uri() . '/css/ninja.css', null, null, 'all');
		
		global $curly_theme_options;
		
		$color_text				= new CurlyThemesColor( get_theme_mod('text_color', '#667279') );
		$color_link 			= new CurlyThemesColor( get_theme_mod('link_color', '#363D40') );
		$color_primary 			= new CurlyThemesColor( get_theme_mod('primary_color', '#C0392B' ) );
		$color_bg 				= new CurlyThemesColor( get_theme_mod('background_color', '#ffffff') );
		
		$svg_date = '<svg width="36px" height="22px" viewBox="0 0 36 22" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
		    <defs></defs>
		    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
		        <path d="M18,4.71428571 L18,19 C18,19.3869067 17.8629821,19.7217248 17.5889423,20.0044643 C17.3149025,20.2872038 16.9903865,20.4285714 16.6153846,20.4285714 L1.38461538,20.4285714 C1.00961351,20.4285714 0.685097524,20.2872038 0.411057692,20.0044643 C0.137017861,19.7217248 0,19.3869067 0,19 L0,4.71428571 C0,4.32737902 0.137017861,3.99256094 0.411057692,3.70982143 C0.685097524,3.42708192 1.00961351,3.28571429 1.38461538,3.28571429 L2.76923077,3.28571429 L2.76923077,2.21428571 C2.76923077,1.72321183 2.93870023,1.30282913 3.27764423,0.953125 C3.61658823,0.603420871 4.02403608,0.428571429 4.5,0.428571429 L5.19230769,0.428571429 C5.66827161,0.428571429 6.07571946,0.603420871 6.41466346,0.953125 C6.75360746,1.30282913 6.92307692,1.72321183 6.92307692,2.21428571 L6.92307692,3.28571429 L11.0769231,3.28571429 L11.0769231,2.21428571 C11.0769231,1.72321183 11.2463925,1.30282913 11.5853365,0.953125 C11.9242805,0.603420871 12.3317284,0.428571429 12.8076923,0.428571429 L13.5,0.428571429 C13.9759639,0.428571429 14.3834118,0.603420871 14.7223558,0.953125 C15.0612998,1.30282913 15.2307692,1.72321183 15.2307692,2.21428571 L15.2307692,3.28571429 L16.6153846,3.28571429 C16.9903865,3.28571429 17.3149025,3.42708192 17.5889423,3.70982143 C17.8629821,3.99256094 18,4.32737902 18,4.71428571 Z M1.38461538,19 L4.5,19 L4.5,15.7857143 L1.38461538,15.7857143 L1.38461538,19 Z M5.19230769,19 L8.65384615,19 L8.65384615,15.7857143 L5.19230769,15.7857143 L5.19230769,19 Z M1.38461538,15.0714286 L4.5,15.0714286 L4.5,11.5 L1.38461538,11.5 L1.38461538,15.0714286 Z M5.19230769,15.0714286 L8.65384615,15.0714286 L8.65384615,11.5 L5.19230769,11.5 L5.19230769,15.0714286 Z M1.38461538,10.7857143 L4.5,10.7857143 L4.5,7.57142857 L1.38461538,7.57142857 L1.38461538,10.7857143 Z M9.34615385,19 L12.8076923,19 L12.8076923,15.7857143 L9.34615385,15.7857143 L9.34615385,19 Z M5.19230769,10.7857143 L8.65384615,10.7857143 L8.65384615,7.57142857 L5.19230769,7.57142857 L5.19230769,10.7857143 Z M13.5,19 L16.6153846,19 L16.6153846,15.7857143 L13.5,15.7857143 L13.5,19 Z M9.34615385,15.0714286 L12.8076923,15.0714286 L12.8076923,11.5 L9.34615385,11.5 L9.34615385,15.0714286 Z M5.53846154,5.42857143 L5.53846154,2.21428571 C5.53846154,2.11755904 5.50420707,2.03385452 5.43569712,1.96316964 C5.36718716,1.89248477 5.28605816,1.85714286 5.19230769,1.85714286 L4.5,1.85714286 C4.40624953,1.85714286 4.32512053,1.89248477 4.25661058,1.96316964 C4.18810062,2.03385452 4.15384615,2.11755904 4.15384615,2.21428571 L4.15384615,5.42857143 C4.15384615,5.5252981 4.18810062,5.60900262 4.25661058,5.6796875 C4.32512053,5.75037238 4.40624953,5.78571429 4.5,5.78571429 L5.19230769,5.78571429 C5.28605816,5.78571429 5.36718716,5.75037238 5.43569712,5.6796875 C5.50420707,5.60900262 5.53846154,5.5252981 5.53846154,5.42857143 Z M13.5,15.0714286 L16.6153846,15.0714286 L16.6153846,11.5 L13.5,11.5 L13.5,15.0714286 Z M9.34615385,10.7857143 L12.8076923,10.7857143 L12.8076923,7.57142857 L9.34615385,7.57142857 L9.34615385,10.7857143 Z M13.5,10.7857143 L16.6153846,10.7857143 L16.6153846,7.57142857 L13.5,7.57142857 L13.5,10.7857143 Z M13.8461538,5.42857143 L13.8461538,2.21428571 C13.8461538,2.11755904 13.8118994,2.03385452 13.7433894,1.96316964 C13.6748795,1.89248477 13.5937505,1.85714286 13.5,1.85714286 L12.8076923,1.85714286 C12.7139418,1.85714286 12.6328128,1.89248477 12.5643029,1.96316964 C12.4957929,2.03385452 12.4615385,2.11755904 12.4615385,2.21428571 L12.4615385,5.42857143 C12.4615385,5.5252981 12.4957929,5.60900262 12.5643029,5.6796875 C12.6328128,5.75037238 12.7139418,5.78571429 12.8076923,5.78571429 L13.5,5.78571429 C13.5937505,5.78571429 13.6748795,5.75037238 13.7433894,5.6796875 C13.8118994,5.60900262 13.8461538,5.5252981 13.8461538,5.42857143 Z" id="Type-something" fill="'.$color_text.'" sketch:type="MSShapeGroup"></path>
		    </g>
		</svg>';
		
		$svg_date_dark = '<svg width="36px" height="22px" viewBox="0 0 36 22" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
		    <defs></defs>
		    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
		        <path d="M18,4.71428571 L18,19 C18,19.3869067 17.8629821,19.7217248 17.5889423,20.0044643 C17.3149025,20.2872038 16.9903865,20.4285714 16.6153846,20.4285714 L1.38461538,20.4285714 C1.00961351,20.4285714 0.685097524,20.2872038 0.411057692,20.0044643 C0.137017861,19.7217248 0,19.3869067 0,19 L0,4.71428571 C0,4.32737902 0.137017861,3.99256094 0.411057692,3.70982143 C0.685097524,3.42708192 1.00961351,3.28571429 1.38461538,3.28571429 L2.76923077,3.28571429 L2.76923077,2.21428571 C2.76923077,1.72321183 2.93870023,1.30282913 3.27764423,0.953125 C3.61658823,0.603420871 4.02403608,0.428571429 4.5,0.428571429 L5.19230769,0.428571429 C5.66827161,0.428571429 6.07571946,0.603420871 6.41466346,0.953125 C6.75360746,1.30282913 6.92307692,1.72321183 6.92307692,2.21428571 L6.92307692,3.28571429 L11.0769231,3.28571429 L11.0769231,2.21428571 C11.0769231,1.72321183 11.2463925,1.30282913 11.5853365,0.953125 C11.9242805,0.603420871 12.3317284,0.428571429 12.8076923,0.428571429 L13.5,0.428571429 C13.9759639,0.428571429 14.3834118,0.603420871 14.7223558,0.953125 C15.0612998,1.30282913 15.2307692,1.72321183 15.2307692,2.21428571 L15.2307692,3.28571429 L16.6153846,3.28571429 C16.9903865,3.28571429 17.3149025,3.42708192 17.5889423,3.70982143 C17.8629821,3.99256094 18,4.32737902 18,4.71428571 Z M1.38461538,19 L4.5,19 L4.5,15.7857143 L1.38461538,15.7857143 L1.38461538,19 Z M5.19230769,19 L8.65384615,19 L8.65384615,15.7857143 L5.19230769,15.7857143 L5.19230769,19 Z M1.38461538,15.0714286 L4.5,15.0714286 L4.5,11.5 L1.38461538,11.5 L1.38461538,15.0714286 Z M5.19230769,15.0714286 L8.65384615,15.0714286 L8.65384615,11.5 L5.19230769,11.5 L5.19230769,15.0714286 Z M1.38461538,10.7857143 L4.5,10.7857143 L4.5,7.57142857 L1.38461538,7.57142857 L1.38461538,10.7857143 Z M9.34615385,19 L12.8076923,19 L12.8076923,15.7857143 L9.34615385,15.7857143 L9.34615385,19 Z M5.19230769,10.7857143 L8.65384615,10.7857143 L8.65384615,7.57142857 L5.19230769,7.57142857 L5.19230769,10.7857143 Z M13.5,19 L16.6153846,19 L16.6153846,15.7857143 L13.5,15.7857143 L13.5,19 Z M9.34615385,15.0714286 L12.8076923,15.0714286 L12.8076923,11.5 L9.34615385,11.5 L9.34615385,15.0714286 Z M5.53846154,5.42857143 L5.53846154,2.21428571 C5.53846154,2.11755904 5.50420707,2.03385452 5.43569712,1.96316964 C5.36718716,1.89248477 5.28605816,1.85714286 5.19230769,1.85714286 L4.5,1.85714286 C4.40624953,1.85714286 4.32512053,1.89248477 4.25661058,1.96316964 C4.18810062,2.03385452 4.15384615,2.11755904 4.15384615,2.21428571 L4.15384615,5.42857143 C4.15384615,5.5252981 4.18810062,5.60900262 4.25661058,5.6796875 C4.32512053,5.75037238 4.40624953,5.78571429 4.5,5.78571429 L5.19230769,5.78571429 C5.28605816,5.78571429 5.36718716,5.75037238 5.43569712,5.6796875 C5.50420707,5.60900262 5.53846154,5.5252981 5.53846154,5.42857143 Z M13.5,15.0714286 L16.6153846,15.0714286 L16.6153846,11.5 L13.5,11.5 L13.5,15.0714286 Z M9.34615385,10.7857143 L12.8076923,10.7857143 L12.8076923,7.57142857 L9.34615385,7.57142857 L9.34615385,10.7857143 Z M13.5,10.7857143 L16.6153846,10.7857143 L16.6153846,7.57142857 L13.5,7.57142857 L13.5,10.7857143 Z M13.8461538,5.42857143 L13.8461538,2.21428571 C13.8461538,2.11755904 13.8118994,2.03385452 13.7433894,1.96316964 C13.6748795,1.89248477 13.5937505,1.85714286 13.5,1.85714286 L12.8076923,1.85714286 C12.7139418,1.85714286 12.6328128,1.89248477 12.5643029,1.96316964 C12.4957929,2.03385452 12.4615385,2.11755904 12.4615385,2.21428571 L12.4615385,5.42857143 C12.4615385,5.5252981 12.4957929,5.60900262 12.5643029,5.6796875 C12.6328128,5.75037238 12.7139418,5.78571429 12.8076923,5.78571429 L13.5,5.78571429 C13.5937505,5.78571429 13.6748795,5.75037238 13.7433894,5.6796875 C13.8118994,5.60900262 13.8461538,5.5252981 13.8461538,5.42857143 Z" id="Type-something" fill="#ffffff" sketch:type="MSShapeGroup"></path>
		    </g>
		</svg>';
		
		$svg_dropdown_dark = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
					<svg width="40px" height="15px" viewBox="0 0 40 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
					    <defs></defs>
					    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
					        <path d="M20,15 L0,15 L10,0 L20,15 Z" id="Triangle-1" fill="#ffffff" sketch:type="MSShapeGroup" transform="translate(10.000000, 7.500000) rotate(-180.000000) translate(-10.000000, -7.500000) "></path>
					    </g>
					</svg>';
		
		$css = "
			#ui-datepicker-div{
				background: $color_bg !important;
			}
			#ui-datepicker-div  .ui-datepicker-current-day{
				background-color: $color_primary !important;
				color: {$color_primary->contrast('#ffffff', '#000000')}
			}
			#ui-datepicker-div .ui-datepicker-today,
			#ui-datepicker-div td:hover{
				background-color: {$color_text->opacity(0.1)}
			}
			#ui-datepicker-div .ui-datepicker-header > a{
				color: $color_primary
			}
			.form-control[data-provide=date-picker],
			.ninja-forms-datepicker{
				background-image: url(data:image/svg+xml;base64,".base64_encode($svg_date).");
			}
			.booking-form.dark .form-control[data-provide=date-picker]{
				background-image: url(data:image/svg+xml;base64,".base64_encode($svg_date_dark).");
			}
			.booking-form.dark select{
				background-image: url(data:image/svg+xml;base64,".base64_encode($svg_dropdown_dark).") !important;
			}
			.ninja-forms-response-msg.ninja-forms-error-msg,
			.ninja-forms-error{
				color: $color_primary
			}
			.ninja-forms-error input{
				border-color: $color_primary
			}
			.ninja-forms-form .ninja-forms-all-fields-wrap .field-wrap.calc-wrap input{
				color: $color_link;
			}
		";
		
		wp_add_inline_style( 'curly-ninja', CurlyThemes::minify_css( htmlspecialchars_decode( $css ) ) );
	}
	
	/** Ninja Forms Default Shortcode Extension */
	public function ninja_default_vc() {
		
		$all_forms = ninja_forms_get_all_forms();
			
		$forms[__('Choose Booking Form','CURLYTHEME')] = null;
	
		foreach ( $all_forms as $key => $form ) {
				$forms[$form['data']['form_title']] = $form['id'];
				$all_fields[$form['id']] = ninja_forms_get_fields_by_form_id( $form['id'] );
		}
		
		$fields_array = array( 
			array(
				"type" => "dropdown",
				"heading" => __("Ninja Forms", 'CURLYTHEME'),
				"param_name" => "id",
				"value" => $forms
			)
		);
		
		/** Ninja Forms */
		vc_map( array(
			"name" => __("Ninja Form", "CURLYTHEME"),
			"base" => "ninja_forms_display_form",
			"show_settings_on_create" => true,
			"admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			"icon" => "curly_icon",
			"class" => "",
			"category" => __('Curly Themes Extension', "CURLYTHEME"),
			"params" => $fields_array
		) );
	}
	
	/** Visual Composer Ninja Extension */
	public function ninja_vc() {
	
		$all_forms = ninja_forms_get_all_forms();
		$all_fields = null;
		
		$forms[__('Choose Booking Form','CURLYTHEME')] = null;
	
		foreach ( $all_forms as $key => $form ) {
				$forms[$form['data']['form_title']] = $form['id'];
				$all_fields[$form['id']] = ninja_forms_get_fields_by_form_id( $form['id'] );
		}
		
		$fields_array = array( 
			array(
				"type" => "dropdown",
				"heading" => __("Ninja Forms", 'CURLYTHEME'),
				"param_name" => "form",
				"value" => $forms,
				"description" => __( 'After selecting your booking form, please check which fields should be used in the pre-fill form', 'CURLYTHEME' )
			),
			array(
				"type" => "dropdown",
				"group" => __( 'Design options', 'js_composer' ),
				"heading" => __("Form Orientation", 'CURLYTHEME'),
				"param_name" => "form_style",
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				"value" => array(
					__( 'Vertical Form', 'CURLYTHEME' ) => 'vertical',
					__( 'Horizontal Form', 'CURLYTHEME' ) => 'horizontal',
				)
			),
			array(
				"type" => "dropdown",
				"group" => __( 'Design options', 'js_composer' ),
				"heading" => __("Form Fields Size", 'CURLYTHEME'),
				"param_name" => "fields_size",
				'edit_field_class' => 'vc_col-sm-4',
				"value" => array(
					__( 'Normal', 'CURLYTHEME' ) => null,
					__( 'Small', 'CURLYTHEME' ) => 'sm',
					__( 'Large', 'CURLYTHEME' ) => 'lg',
				)
			),
			array(
				"type" => "dropdown",
				"group" => __( 'Design options', 'js_composer' ),
				"heading" => __("Color Theme", 'CURLYTHEME'),
				"param_name" => "theme",
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				"value" => array(
					__( 'Normal', 'CURLYTHEME' ) => 'light',
					__( 'Dark', 'CURLYTHEME' ) => 'dark',
				)
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'js_composer' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'js_composer' )
			)
		);
		
		if ( $all_fields ) {
			foreach ( $all_fields as $key => $form ) {
				foreach ( $form as $field ) {
					if ( $field['type'] != '_submit' ) {
						array_push( $fields_array , array(
							"type" => "checkbox",
							'edit_field_class' => 'vc_col-sm-4 vc_column',
							"heading" => $field['data']['label'],
							"param_name" => "form_fields_".$key,
							"value" => array( __('Yes, add field', 'CURLYTHEME') => $field['id'] ),
							'dependency' => array(
								'element' => 'form',
								'value' => $field['form_id']
							)
						));
					}
				}
			}
		}
		
		/** Booking Forms */
		vc_map( array(
			"name" => __("Booking Form", "CURLYTHEME"),
			"base" => "curly_ninja",
			"show_settings_on_create" => true,
			"admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			"icon" => "curly_icon",
			"class" => "",
			"category" => __('Curly Themes Extension', "CURLYTHEME"),
			"params" => $fields_array
		) );
	}
	
	/** Visual Composer Form Button Extentions */
	public function ninja_button_vc() {
		
		$all_forms = ninja_forms_get_all_forms();
			
		$forms[__('Choose Booking Form','CURLYTHEME')] = null;
	
		foreach ( $all_forms as $key => $form ) {
				$forms[$form['data']['form_title']] = $form['id'];
				$all_fields[$form['id']] = ninja_forms_get_fields_by_form_id( $form['id'] );
		}
		
		/** Ninja Forms */
		vc_map( array(
			"name" => __("Ninja Form Modal", "CURLYTHEME"),
			"base" => "curly_ninja_modal",
			"show_settings_on_create" => true,
			"admin_enqueue_css" => array( get_template_directory_uri().'/framework/css/vc-icon.css' ),
			"icon" => "curly_icon",
			"class" => "",
			"category" => __('Curly Themes Extension', "CURLYTHEME"),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Ninja Forms", 'CURLYTHEME'),
					"param_name" => "id",
					'edit_field_class' => 'vc_col-sm-6',
					"value" => $forms
				),
				array(
					"type" => "dropdown",
					"heading" => __("Button Align", 'CURLYTHEME'),
					"param_name" => "align",
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					"value" => array(
						__('Left', 'CURLYTHEME') => 'text-left',
						__('Center', 'CURLYTHEME') => 'text-center',
						__('Right', 'CURLYTHEME') => 'text-right'
					)
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'CURLYTHEME'),
					"param_name" => "button_text"
				)
			)
		) );
	}
	
	public function ninja_button( $atts, $content = null ){
		
		global $ninja_forms_processing;
	
		$form_id 	= isset( $atts['id'] ) ? $atts['id'] : null;
		$form 		= ninja_forms_get_form_by_id( $form_id );
		$form_settings = get_option( 'ninja_forms_settings' );
		$html = $fields_js	= $display = null; 
		
		/** Check for Errors */
		if ( is_object( $ninja_forms_processing ) && $ninja_forms_processing->get_all_errors() ) {
			$modal = true;
		} else {
			$modal = null;
		}
		
		if ( ! $form['data'] ) {
			return sprintf( '<p class="text-center"><strong>'.__( 'Form #%s is not existing', 'CURLYTHEME' ).'</strong></p>', $form_id );
		}
		
		$html .= '<div class="'.$atts['align'].'"><input type="button" class="btn btn-primary" name="'.$atts['button_text'].'" value="'.$atts['button_text'].'" data-toggle="modal" data-target="#modal-'.$form_id.'"></div>';
		$html .= '<div class="modal fade" id="modal-'.$form_id.'" tabindex="-1" role="dialog"><div class="pb-pattern o-lines-light">';
			$html .= '<div class="modal-dialog">';
				$html .= '<div class="modal-content">';
		    		$html .= '<div class="modal-header">';
		    			$html .= '<button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="'.__( 'Close', 'CURLYTHEME' ).'"><span>&times;</span><span class="sr-only">'.__( 'Close', 'CURLYTHEME' ).'</span></button>';
			    		$html .= '<h2 id="'.$form['data']['form_title'].'">'.$form['data']['form_title'].'<small>'.$form_settings['req_div_label'].'</small></h2>';
		    		$html .= '</div>';
		    		$html .= '<div class="modal-body">';
		    			$html .= '[ninja_forms_display_form id="'.$atts['id'].'"]';	
		    		$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div></div>';
		$html .= "<script type='text/javascript'>( function( $ ) { $( document ).ready(function() { ";
		$html .= $modal	? ' $("#modal-'.$form_id.'").modal("show"); ' : null;
		$html .= "}); } )( jQuery );</script>";
		
		return $html;
	} 
	
	/** Ninja Shortcode */
	public function ninja( $atts, $content = null ){
	
		$form_id 	= isset( $atts['form'] ) ? $atts['form'] : null;
		$html = $fields_js	= $display = $el_class = null; 
		
		$el_class = isset( $atts['css'] ) ? $atts['css'] : null;
		if ( $el_class != '' ) {
			$el_class = " " . str_replace( ".", "", $el_class );
			$el_class = substr( $el_class , 0, strpos( $el_class, '{' ) );
		}
		
		global $ninja_forms_processing;
		
		$form_row = ninja_forms_get_form_by_id( $form_id ); 
		$form_data = $form_row['data'];
		
		if ( ! $form_row['data'] ) {
			return sprintf( '<p class="text-center"><strong>'.__( 'Form #%s is not existing', 'CURLYTHEME' ).'</strong></p>', $form_id );
		}
		
	
		/** Check for Display */
		if( is_object( $ninja_forms_processing ) ){
			$hide_complete = $ninja_forms_processing->get_form_setting( 'hide_complete' );
		}else{
			if( isset( $form_data['hide_complete'] ) ){
				$hide_complete = $form_data['hide_complete'];
			}else{
				$hide_complete = 0;
			}
		}
		if( $hide_complete == 1 AND ( is_object( $ninja_forms_processing ) AND $ninja_forms_processing->get_form_setting( 'processing_complete' ) == 1 ) AND $ninja_forms_processing->get_form_ID() == $form_id ){
			$display = 0;
		}
		
		/** Check for Success Message */
		if ( is_object( $ninja_forms_processing ) && $ninja_forms_processing->get_form_setting( 'processing_complete' ) == 1 ) {
			$messages = nf_get_notifications_by_form_id( $form_id );
			
			foreach ( $messages as $key => $message ) {
				if ( $message['type'] == "success_message" ) {
					$success = $message["success_msg"];
				} else {
					$success = __( 'Your form has been succesfully sent!', 'CURLYTHEME' );
				}
			}
			$html .= '<div class="text-center" id="prefill-success-'.$form_id.'">'.$success.'</div>';
		}
		
		/** Check for Errors */
		if ( is_object( $ninja_forms_processing ) && $ninja_forms_processing->get_all_errors() ) {
			$modal = true;
		} else {
			$modal = null;
		}
		
		/** Check for AJAX */
		if ( $form_row['data']['ajax'] == 1 ) {
			$ajax = true;
		} else {
			$ajax = false;
		}
		
		/** Look for Form ID */
		if ( isset( $form_id ) && ! isset( $display ) ) {
			$fields 	= 'form_fields_'.$form_id; 
			$fields 	=  isset( $atts[$fields] )  ? explode(',', $atts[$fields]) : null;
			$form 		= ninja_forms_get_form_by_id( $form_id );
			$form_fields = ninja_forms_get_fields_by_form_id( $form_id );
			$form_settings = get_option( 'ninja_forms_settings' );
			
			/** Check for Form Fields Size */
			if ( isset( $atts['fields_size'] ) ) {
				switch ( $atts['fields_size'] ) {
					case 'sm' : {
						$input_size 	= 'input-sm';
						$button_size 	= 'btn-sm';
					} break;
					case 'lg' : {
						$input_size 	= 'input-lg';
						$button_size 	= 'btn-lg';
					} break;
					default	: {
						$input_size = $button_size = null;
					}
				}
			} else {
				$input_size = $button_size = null;
			}
			
			/** Generate Form */
			if ( $fields ) {
				foreach ( $form_fields  as $field ) {
					if ( in_array( $field['id'], $fields ) ) {
						$active_fields[] = $field;
						$fields_js .= '$("#prefill-'.$field['form_id'].'-'.$field['id'].'").change(function() {
						  $("#ninja_forms_field_'.$field['id'].'", "#ninja_forms_form_'.$field['form_id'].'").val( $(this).val() ).trigger("change");
						});';
					}
				}
			}
			
			/** Form Theme */
			$form_class  	 = ( isset( $atts['form_style'] ) && $atts['form_style'] == 'horizontal' ) ? 'row' : null;
			$form_class 	.= ( isset( $atts['theme'] ) && $atts['theme'] == 'dark' ) ? ' dark' : ' light';
			$form_class		.= $el_class;
			$button_size 	.= ( isset( $atts['form_style'] ) && $atts['form_style'] == 'horizontal' ) ? ' btn-block' : ' btn-block';
			$html .= '<div class="text-center hidden" id="prefill-success-'.$form_id.'">'.do_shortcode($form_row['data']['success_msg']).'</div>';
			$html .= '<form role="form" class="booking-form '.$form_class.'" action="/" id="prefill-form-'.$form_id.'">';
			if ( isset( $active_fields ) ) {
				foreach ( $active_fields  as $key => $field ) {
					if ( $atts['form_style'] == 'horizontal' ) {
						$fields = count( $active_fields );
						$fields = floor( ( 10 / $fields ) );
						$remaining = 10 % count( $active_fields ); 
						$size = ( $key < $remaining ) ? 'col-md-'. ($fields + 1) : 'col-md-'. $fields;
					} else {
						$size = 'form-group';
					}
					
					if ( $field['type'] == '_text' ) {
						
						$custom = ( $field['data']['datepicker'] == '1' ) ? 'data-provide="date-picker" data-date-autoclose="true" data-date-format="mm/dd/yyyy"' : null;
						
						$html .= '<div class="'.$size.'">';
						$html .= '<label class="sr-only" for="prefill-'.$form_id.'-'.$field['id'].'">'.$field['data']['label'].'</label>';
						$html .= '<input type="text" class="form-control '.$input_size.'" '.$custom.' id="prefill-'.$form_id.'-'.$field['id'].'" placeholder="'.$field['data']['label'].'" value="">';
						$html .= '</div>';
					}
					
					if ( $field['type'] == '_list' ) {
						$html .= '<div class="'.$size.'">';
						$html .= '<label class="sr-only" for="prefill-'.$form_id.'-'.$field['id'].'">'.$field['data']['label'].'</label>';
						$html .= '<select class="form-control '.$input_size.'" id="prefill-'.$form_id.'-'.$field['id'].'">';
							foreach ( $field['data']['list']['options']  as $option ) { 
								$value = $option['value'] ? $option['value'] : $option['label'];
								$html .= '<option value="'.$value.'">'.$option['label'].'</option>';
							}
						$html .= '</select>';
						$html .= '</div>';
					}
					
				}
			}
			
			/** Define Submit Button */
			foreach ( $form_fields as $field) {
				if ( $field['type'] == '_submit' ) {
					$submit_label = $field['data']['label'];
				}
			}
			$submit_label = isset( $submit_label ) ? $submit_label : __( 'Submit', 'CURLYTHEME' );
			$submit_class = ( $atts['form_style'] == 'horizontal' ) ? 'col-md-2' : 'form-group';
			
			$html .= '<div class="'.$submit_class.'">';
			$html .= '<input type="button" class="btn btn-primary '.$button_size.'" name="'.$submit_label.'" value="'.$submit_label.'" data-toggle="modal" data-target="#prefill-modal-'.$form_id.'">';
			$html .= '</div>';
				
			$html .= '</form>';
			$html .= '<div class="modal fade" id="prefill-modal-'.$form_id.'" tabindex="-1" role="dialog">';
	    		$html .= '<div class="modal-dialog">';
		    		$html .= '<div class="modal-content">';
			    		$html .= '<div class="modal-header">';
			    			$html .= '<button type="button" class="close" data-dismiss="modal" data-toggle="tooltip" title="'.__( 'Close', 'CURLYTHEME' ).'"><span>&times;</span><span class="sr-only">'.__( 'Close', 'CURLYTHEME' ).'</span></button>';
				    		$html .= '<h2 id="'.$form_id.'">'.$form['data']['form_title'].'<small>'.$form_settings['req_div_label'].'</small></h2>';
			    		$html .= '</div>';
			    		$html .= '<div class="modal-body">';
			    			$html .= '[ninja_forms_display_form id="'.$atts['form'].'"]';	
			    		$html .= '</div>';
		    		$html .= '</div>';
	    		$html .= '</div>';
			$html .= '</div>';
			$html .= "<script type='text/javascript'>( function( $ ) { $( document ).ready(function() { ";
			$html .= $fields_js;
			$html .= "  if ( $('.form-control[data-provide=\"date-picker\"]').length > 0 ) {
							$('.form-control[data-provide=\"date-picker\"]').datepicker({
								beforeShow : function(textbox, instance){
									$('#ui-datepicker-div').css('min-width', $(this).outerWidth() );
								},
								showOtherMonths: true,
								selectOtherMonths: true,
							});
						}";
			$html .= $modal	? ' $("#prefill-modal-'.$form_id.'").modal("show"); ' : null;
			$html .= $ajax ? " $( '#ninja_forms_form_$form_id' ).on( 'submitResponse', function( e, response ) {
								    var errors = response.errors;
								    var success = response.success;
								    var redirect = response.form_settings.landing_page;
								    if ( errors == false ) {
								    	if ( redirect ) {
								    		window.location.replace(redirect);
								    	}
								    	$('#prefill-success-$form_id').html(success.success_msg).removeClass('hidden').addClass('show');
								    	$('#prefill-form-$form_id').hide();
								        $('#prefill-modal-$form_id').modal('hide');
								        $('#prefill-success-$form_id').velocity('scroll', { duration: 1000, easing: 'easeOutCubic', offset: -( $('#main-nav').outerHeight() + 30 ) });
								    }
								});" : null;
			$html .= "}); } )( jQuery );</script>";
			
		}
		
		return wpb_js_remove_wpautop($html);
	} 
	
}

/** Check if Ninja Forms is active before initialization */
if ( class_exists( 'Ninja_Forms' ) ) {
	new CurlyNinjaForms();
}

?>