<?php

/*
To add custom modules to the theme, create a new 'custom-modules.php' file in the theme folder.
They will be added to the theme automatically.
*/

/* 	Custom Modules
/***************************************************************************/

	///////////////////////////////////////////
	// Header Slider Function
	///////////////////////////////////////////
	function themify_header_slider($data=array()){
		$data = themify_get_data();
		
		/** Slider values @var array */
		$slider_ops = array( __('On', 'themify') => 'on', __('Off', 'themify') => 'off' );
		/** Slider status */
		$enabled_display = '';
		$display_posts = '';
		$display_images = '';
		$display_posts_display = '';
		$display_images_display = '';
		if ( '' == themify_get( 'setting-header_slider_enabled' ) || 'on' == themify_get( 'setting-header_slider_enabled' ) ) {
			$enabled_checked = "selected='selected'";
		} else {
			$enabled_display = "style='display:none;'";	
		}
		if ( ! isset( $data['setting-header_slider_visible'] ) || '' == $data['setting-header_slider_visible'] ) {
			$data['setting-header_slider_visible'] = "4";	
		}
		
		if ( 'images' == themify_get( 'setting-header_slider_display' ) ) {
			$display_images = "checked='checked'";
			$display_posts_display = "style='display:none;'";
		} else {
			$display_posts = "checked='checked'";	
			$display_images_display = "style='display:none;'";
		}
		$title_options = array('' => '',__('Yes', 'themify') => 'yes', __('No', 'themify') => 'no');
		$auto_options = array(0,1,2,3,4,5,6,7);
		$scroll_options = array(1,2,3,4,5,6,7);
		$display_options = array('none','excerpt','content');
		$speed_options = array(__('Fast', 'themify') => 300, __('Normal', 'themify') => 1000, __('Slow', 'themify') => 2000);
		$wrap_options = array("no","yes");
		$image_options = array("one","two","three","four","five","six","seven","eight","nine","ten");
		
		/**
		 * HTML for settings panel
		 * @var string
		 */
		$output = '<p><span class="label">' . __('Enable Slider', 'themify') . '</span> <select name="setting-header_slider_enabled" class="feature_box_enabled_check">';
		/** Iterate through slider options */
		foreach ( $slider_ops as $key => $val ) {
			$output .= '<option value="'.$val.'" ' . selected( themify_get( 'setting-header_slider_enabled' ), $val, false ) . '>' . $key . '</option>';
		}
		$output .= '</select>' . '</p>
		
					<div class="feature_box_enabled_display" '.$enabled_display.'>
					
					<p><span class="label">' . __('Display', 'themify') . '</span> <input type="radio" class="feature-box-display" name="setting-header_slider_display" value="posts" '.$display_posts.' /> ' . __('Posts', 'themify') . ' <input type="radio" class="feature-box-display" name="setting-header_slider_display" value="images" '.$display_images.' /> ' . __('Images', 'themify') . '</p>
					
					<p class="pushlabel feature_box_posts" '.$display_posts_display.'>';
							$output .= wp_dropdown_categories(array("show_option_all"=>__('All Categories', 'themify'),"hide_empty"=>0,"echo"=>0,"name"=>"setting-header_slider_posts_category","selected"=> themify_get( 'setting-header_slider_posts_category' )));
		$output .=	'	<input type="text" name="setting-header_slider_posts_slides" value="' . themify_get( 'setting-header_slider_posts_slides' ) . '" class="width2" /> ' . __('number of posts to be queried', 'themify') . ' 
					</p>
					
					<p class="feature_box_posts" '.$display_posts_display.'>
						<span class="label">' . __('Content Display', 'themify') . ' </span>
								<select name="setting-header_slider_default_display">
								';
								
								foreach($display_options as $option){
									if( $option == themify_get( 'setting-header_slider_default_display' ) ) {
										$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
									} else {
										$output .= '<option value="'.$option.'">'.$option.'</option>';
									}
								}
								
			$output .= '
						</select>
					</p>';
					
		$output .= '<p class="feature_box_posts" '.$display_posts_display.'>
						<span class="label">' . __('Hide Title', 'themify') . '</span>
						<select name="setting-header_slider_hide_title">
						';
						foreach($title_options as $name => $option){
							if ( isset( $data['setting-slider_hide_title'] ) && ( $option == $data['setting-slider_hide_title'] ) ) {
								$output .= '<option value="'.$option.'" selected="selected">'.$name.'</option>';
							} else {
								$output .= '<option value="'.$option.'">'.$name.'</option>';
							}
						}		
		$output .= '	</select>
					</p>';
					
		$output .= '<div class="feature_box_images" '.$display_images_display.'>';
				
				$x = 0;
				foreach ( $image_options as $option ) {
					$x++;
					$output .= '
					<div class="uploader-fields">
						<span class="label">' . __('Title', 'themify') . ' '.$x.'</span>
						<input type="text" class="width10" name="setting-header_slider_images_'.$option.'_title" value="' . themify_get( 'setting-header_slider_images_'.$option.'_title' ) . '" />
						<span class="label">' . __('Link', 'themify') . ' '.$x.'</span>
						<input type="text" class="width10" name="setting-header_slider_images_'.$option.'_link" value="' . themify_get( 'setting-header_slider_images_'.$option.'_link' ) . '" />
						<span class="label">' . __('Image', 'themify') . ' '.$x.'</span>
						<input type="text" class="width10 feature_box_img" id="setting-header_slider_images_'.$option.'_image" name="setting-header_slider_images_'.$option.'_image" value="' . themify_get( 'setting-header_slider_images_'.$option.'_image' ) . '" /> 
						<div class="pushlabel" style="display:block;">' . themify_get_uploader('setting-header_slider_images_'.$option.'_image', array('tomedia' => true)) . '</div>
					</div>';
				}
		
		$output .= '</div>
					<hr />
					<p>
						<span class="label">' . __('Visible', 'themify') . '</span> 
						<select name="setting-header_slider_visible">';
						for($x=1;$x<=7;$x++){
							if($data['setting-header_slider_visible'] == $x){
								$output .= '<option value="'.$x.'" selected="selected">'.$x.'</option>';	
							} else {
								$output .= '<option value="'.$x.'">'.$x.'</option>';	
							}
						}
			$output .=	'</select> <small>' . __('(# of slides visible at the same time)', 'themify') . '</small>
					</p>
					<p>
					<span class="label">' . __('Auto Play', 'themify') . '</span>
								<select name="setting-header_slider_auto">
								';
							foreach($auto_options as $option){
								if ( isset( $data['setting-header_slider_auto'] ) && ( $option == $data['setting-header_slider_auto'] ) ) {
									$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
								} else {
									$output .= '<option value="'.$option.'">'.$option.'</option>';
								}
							}		
			$output .= '
						</select> <small>' . __('(auto advance slider, 0 = off)', 'themify') . '</small>
					</p>
					<p>
					<span class="label">' . __('Scroll', 'themify') . '</span>
								<select name="setting-header_slider_scroll">
								';
							foreach($scroll_options as $option){
								if ( isset( $data['setting-header_slider_scroll'] ) && ( $option == $data['setting-header_slider_scroll'] ) ) {
									$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
								} else {
									$output .= '<option value="'.$option.'">'.$option.'</option>';
								}
							}		
			$output .= '
						</select>
					</p>
					<p>
						<span class="label">' . __('Speed', 'themify') . '</span> 
						<select name="setting-header_slider_speed">';
						foreach($speed_options as $name => $val){
							if ( isset( $data['setting-header_slider_speed'] ) && ( $data['setting-header_slider_speed'] == $val ) ) {
								$output .= '<option value="'.$val.'" selected="selected">'.$name.'</option>';	
							} else {
								$output .= '<option value="'.$val.'">'.$name.'</option>';	
							}	
						}
			$output .= '</select>
					</p>
					<p>
						<span class="label">' . __('Wrap Slides', 'themify') . '</span> 
						<select name="setting-header_slider_wrap">';
						foreach($wrap_options as $name){
							if ( isset( $data['setting-header_slider_wrap'] ) && ( $data['setting-header_slider_wrap'] == $name ) ) {
								$output .= '<option value="'.$name.'" selected="selected">'.$name.'</option>';	
							} else {
								$output .= '<option value="'.$name.'">'.$name.'</option>';	
							}
						}
			$output .=	'</select>
					</p>
					<hr />
					<p>
						<span class="label">' . __('Feature Image Size', 'themify') . '</span>
						<input type="text" name="setting-header_slider_width" class="width2" value="' . themify_get( 'setting-header_slider_width' ) . '" /> ' . __('width', 'themify') . ' <small>(in px)</small>
						<input type="text" name="setting-header_slider_height" class="width2" value="' . themify_get( 'setting-header_slider_height' ) . '" /> ' . __('height', 'themify') . ' <small>(in px)</small>
					</p>
					</div>';		
		return $output;
	}
	
	///////////////////////////////////////////
	// Header Slider Function - Action
	///////////////////////////////////////////
	function themify_header_slider_action($data=array()){
		$wrap = 'false';
		if ( themify_get( 'setting-header_slider_wrap' ) == 'yes' ) {
			$wrap = 'true';
		}
		if ( '' == themify_get( 'setting-header_slider_visible' ) ) {
			$visible = '4';
		} else {
			$visible = themify_get( 'setting-header_slider_visible' );
		}
		if ( '' == themify_get( 'setting-header_slider_speed' ) ) {
			$speed = '2500';
		} else {
			$speed = themify_get( 'setting-header_slider_speed' );
		}
		if ( themify_get( 'setting-header_slider_scroll' ) == '' ) {
			$scroll = 1;
		} else {
			$scroll = themify_get( 'setting-header_slider_scroll' );
		}
		if ( themify_get( 'setting-header_slider_auto' ) == '' ) {
			$auto = 0;
		} else {
			$auto = themify_get( 'setting-header_slider_auto' );
		}
		if( '0' == $auto )
			$play = 'false';
		else
			$play = 'true';
		
		?>
		<script type='text/javascript'>
		/////////////////////////////////////////////
		// Slider	 							
		/////////////////////////////////////////////
		jQuery(window).load(function(){
			var $hSlider = jQuery('#header-slider');
			if($hSlider.length > 0){
				$hSlider.find('.slides').carouFredSel({
					responsive: true,
					prev: '#header-slider .carousel-prev',
					next: '#header-slider .carousel-next',
					width: '100%',
					circular: <?php echo $wrap; ?>,
					infinite: <?php echo $wrap; ?>,
					auto: {
						play : <?php echo $play; ?>,
						pauseDuration: <?php echo $auto*1000; ?>,
						duration: <?php echo $speed; ?>
					},
					scroll: {
						items: <?php echo $scroll; ?>,
						duration: <?php echo $speed; ?>,
						wipe: true
					},
					items: {
						visible: {
							min: 1,
							max: <?php echo $visible; ?>
						},
						width: 150
					},
					onCreate : function (){
						$hSlider.css( {
							'height': 'auto',
							'visibility' : 'visible'
						});
					}
				});
			}
			
		});
		</script>
        <?php
	}
	/** Output slider js on the footer if it's enabled */
	if('' == themify_get('setting-header_slider_enabled') || 'on' == themify_get('setting-header_slider_enabled'))
		add_action('wp_footer', 'themify_header_slider_action');
	
	///////////////////////////////////////////
	// Default Page Layout Module
	///////////////////////////////////////////
	function themify_default_page_layout($data=array()){
		$data = themify_get_data();
		
		$options = array(
			array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify'), "selected" => true),
			array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
			array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar', 'themify'))
		);
		
		$default_options = array(
			array('name'=>'','value'=>''),
			array('name'=>__('Yes', 'themify'),'value'=>'yes'),
			array('name'=>__('No', 'themify'),'value'=>'no')
		);
							 
		$val = isset( $data['setting-default_page_layout'] ) ? $data['setting-default_page_layout'] : '';
		
		/**
		 * HTML for settings panel
		 * @var string
		 */
		$output = '<p>
						<span class="label">' . __('Page Sidebar Option', 'themify') . '</span>';
		foreach ( $options as $option ) {
			if ( ( '' == $val || ! $val || ! isset( $val ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) { 
				$val = $option['value'];
			}
			if ( $val == $option['value'] ) { 
				$class = "selected";
			} else {
				$class = '';
			}
			$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		$output .= '<input type="hidden" name="setting-default_page_layout" class="val" value="'.$val.'" /></p>';
		$output .= '<p>
						<span class="label">' . __('Hide Title in All Pages', 'themify') . '</span>
						
						<select name="setting-hide_page_title">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-hide_page_title'] ) && ( $title_option['value'] == $data['setting-hide_page_title'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>';

		$output .= '<p><span class="label">' . __('Page Comments', 'themify') . '</span><label for="setting-comments_pages"><input type="checkbox" id="setting-comments_pages" name="setting-comments_pages" '.checked( themify_get( 'setting-comments_pages' ), 'on', false ).' /> ' . __('Disable comments in all Pages', 'themify') . '</label></p>';	
		
		return $output;													 
	}
	
	///////////////////////////////////////////
	// Default Index Layout Module
	///////////////////////////////////////////
	function themify_default_layout($data=array()){
		$data = themify_get_data();
		
		if ( ! isset( $data['setting-default_more_text'] ) || '' == $data['setting-default_more_text'] ) {
			$more_text = __('More', 'themify');
		} else {
			$more_text = $data['setting-default_more_text'];
		}
		
		$default_options = array(
								array('name'=>'','value'=>''),
								array('name'=>__('Yes', 'themify'),'value'=>'yes'),
								array('name'=>__('No', 'themify'),'value'=>'no')
								);
		$default_layout_options = array(
								array('name' => __('Full Content', 'themify'),'value'=>'content'),
								array('name' => __('Excerpt', 'themify'),'value'=>'excerpt'),
								array('name' => __('None', 'themify'),'value'=>'none')
								);	
		$default_post_layout_options = array(
			array('value' => 'list-post', 'img' => 'images/layout-icons/list-post.png', 'title' => __('List Post', 'themify'), "selected" => true),
			array('value' => 'grid4', 'img' => 'images/layout-icons/grid4.png', 'title' => __('Grid 4', 'themify')),
			array('value' => 'grid3', 'img' => 'images/layout-icons/grid3.png', 'title' => __('Grid 3', 'themify')),
			array('value' => 'grid2', 'img' => 'images/layout-icons/grid2.png', 'title' => __('Grid 2', 'themify')),
			array('value' => 'list-large-image', 'img' => 'images/layout-icons/list-large-image.png', 'title' => __('List Large Image', 'themify')),
			array('value' => 'list-thumb-image', 'img' => 'images/layout-icons/list-thumb-image.png', 'title' => __('List Thumb Image', 'themify')),
			array('value' => 'grid2-thumb', 'img' => 'images/layout-icons/grid2-thumb.png', 'title' => __('Grid 2 Thumb', 'themify')),
		);
																 	 
		$options = array(
			array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify'), "selected" => true),
			array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
			array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar', 'themify'))
		);
						 
		$val = isset( $data['setting-default_layout'] ) ? $data['setting-default_layout'] : '';
		
		/**
		 * HTML for settings panel
		 * @var string
		 */
		$output = '<div class="themify-info-link">' . __( 'Here you can set the <a href="http://themify.me/docs/default-layouts">Default Layouts</a> for WordPress archive post layout (category, search, archive, tag pages, etc.), single post layout (single post page), and the static Page layout. The default single post and page layout can be override individually on the post/page > edit > Themify Custom Panel.', 'themify' ) . '</div>';

		$output .= '<p>
						<span class="label">' . __('Index Sidebar Option', 'themify') . '</span>';
		foreach ( $options as $option ) {
			if ( ( '' == $val || ! $val || ! isset( $val ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) { 
				$val = $option['value'];
			}
			if ( $val == $option['value'] ) { 
				$class = "selected";
			} else {
				$class = '';
			}
			$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		
		$output .= '<input type="hidden" name="setting-default_layout" class="val" value="'.$val.'" />';
		$output .= '</p>';
		$output .= '<p><span class="label">' . __('Post Layout', 'themify') . '</span>';
						
		$val = isset( $data['setting-default_post_layout'] ) ? $data['setting-default_post_layout'] : '';
		
		foreach ( $default_post_layout_options as $option ) {
			if ( ( '' == $val || ! $val || ! isset( $val ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) { 
				$val = $option['value'];
			}
			if ( $val == $option['value'] ) { 
				$class = "selected";
			} else {
				$class = '';
			}
			$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		
		$output .= '<input type="hidden" name="setting-default_post_layout" class="val" value="'.$val.'" />
					</p>
					<p>
						<span class="label">' . __('Display Content', 'themify') . '</span> 
						<select name="setting-default_layout_display">';
						foreach ( $default_layout_options as $layout_option ) {
							if ( isset( $data['setting-default_layout_display'] ) && ( $layout_option['value'] == $data['setting-default_layout_display'] ) ) {
								$output .= '<option selected="selected" value="'.$layout_option['value'].'">'.$layout_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$layout_option['value'].'">'.$layout_option['name'].'</option>';
							}
						}
		$output .=	'	</select>
					</p>
					
					<p>
						<span class="label">' . __('More Text', 'themify') . '</span>
						<input type="text" name="setting-default_more_text" value="'.$more_text.'">
<span class="pushlabel vertical-grouped"><label for="setting-excerpt_more"><input type="checkbox" value="1" id="setting-excerpt_more" name="setting-excerpt_more" '.checked( themify_get( 'setting-excerpt_more' ), 1, false ).'/> ' . __('Display more link button in excerpt mode as well.', 'themify') . '</label></span>
					</p>';
					
		/**
		 * Order & OrderBy Options
		 */
		if( function_exists( 'themify_post_sorting_options' ) ) 
			$output .= themify_post_sorting_options('setting-index_order', $data);
		
		/**
		 * Hide Post Title
		 */
		$output .=	'<p>
						<span class="label">' . __('Hide Post Title', 'themify') . '</span>
						
						<select name="setting-default_post_title">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_post_title'] ) && ( $title_option['value'] == $data['setting-default_post_title'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Unlink Post Title', 'themify') . '</span>
						
						<select name="setting-default_unlink_post_title">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_unlink_post_title'] ) && ( $title_option['value'] == $data['setting-default_unlink_post_title'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Hide Post Meta', 'themify') . '</span>
						
						<select name="setting-default_post_meta">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_post_meta'] ) && ( $title_option['value'] == $data['setting-default_post_meta'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Hide Post Date', 'themify') . '</span>
						
						<select name="setting-default_post_date">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_post_date'] ) && ( $title_option['value'] == $data['setting-default_post_date'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Auto Featured Image', 'themify') . '</span>

						<label for="setting-auto_featured_image"><input type="checkbox" value="1" id="setting-auto_featured_image" name="setting-auto_featured_image" '.checked( themify_get( 'setting-auto_featured_image' ), 1, false ).'/> ' . __('If no featured image is specified, display first image in content.', 'themify') . '</label>
					</p>

					<p>
						<span class="label">' . __('Hide Featured Image', 'themify') . '</span>

						<select name="setting-default_post_image">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_post_image'] ) && ( $title_option['value'] == $data['setting-default_post_image'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Unlink Featured Image', 'themify') . '</span>
						
						<select name="setting-default_unlink_post_image">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_unlink_post_image'] ) && ( $title_option['value'] == $data['setting-default_unlink_post_image'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>';
		
		$output .= themify_feature_image_sizes_select('image_post_feature_size');
		$data = themify_get_data();
		$options = array( 'left', 'right' );

		$output .= '<p>
						<span class="label">' . __('Image Size', 'themify') . '</span>  
						<input type="text" class="width2" name="setting-image_post_width" value="' . themify_get( 'setting-image_post_width' ) . '" /> ' . __('width', 'themify') . ' <small>(px)</small>  
						<input type="text" class="width2" name="setting-image_post_height" value="' . themify_get( 'setting-image_post_height' ) . '" /> ' . __('height', 'themify') . ' <small>(px)</small>
						<br /><span class="pushlabel"><small>' . __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify') . '</small></span>
					</p>
					<p>
						<span class="label">' . __('Featured Image Alignment', 'themify') . '</span>
						<select name="setting-image_post_align">
							<option></option>';
		foreach ( $options as $option ) {
			if ( isset( $data['setting-image_post_align'] ) && ( $option == $data['setting-image_post_align'] ) ) {
				$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
			} else {
				$output .= '<option value="'.$option.'">'.$option.'</option>';
			}
		}
		$output .=	'</select>
					</p>
					';
		return $output;
	}
	
	///////////////////////////////////////////
	// Default Single ' . __('Post Layout', 'themify') . ' Module
	///////////////////////////////////////////
	function themify_default_post_layout($data=array()){
		
		$data = themify_get_data();
		
		$default_options = array(
								array('name'=>'','value'=>''),
								array('name'=>__('Yes', 'themify'),'value'=>'yes'),
								array('name'=>__('No', 'themify'),'value'=>'no')
							);
		
		$val = isset( $data['setting-default_page_post_layout'] ) ? $data['setting-default_page_post_layout'] : '';

		/**
		 * HTML for settings panel
		 * @var string
		 */
		$output = '<p>
						<span class="label">' . __('Post Sidebar Option', 'themify') . '</span>';
						
		$options = array(
			array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'selected' => true, 'title' => __('Sidebar Right', 'themify')),
			array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
			array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar', 'themify'))
		);
										
		foreach ( $options as $option ) {
			if ( ( '' == $val || ! $val || ! isset( $val ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) { 
				$val = $option['value'];
			}
			if ( $val == $option['value'] ) { 
				$class = "selected";
			} else {
				$class = '';
			}
			$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';	
		}
		
		$output .= '<input type="hidden" name="setting-default_page_post_layout" class="val" value="'.$val.'" />';
		$output .= '</p>
					<p>
						<span class="label">' . __('Hide Post Title', 'themify') . '</span>
						
						<select name="setting-default_page_post_title">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_page_post_title'] ) && ( $title_option['value'] == $data['setting-default_page_post_title'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Unlink Post Title', 'themify') . '</span>
						
						<select name="setting-default_page_unlink_post_title">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_page_unlink_post_title'] ) && ( $title_option['value'] == $data['setting-default_page_unlink_post_title'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Hide Post Meta', 'themify') . '</span>
						
						<select name="setting-default_page_post_meta">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_page_post_meta'] ) && ( $title_option['value'] == $data['setting-default_page_post_meta'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Hide Post Date', 'themify') . '</span>
						
						<select name="setting-default_page_post_date">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_page_post_date'] ) && ( $title_option['value'] == $data['setting-default_page_post_date'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p>
					<p>
						<span class="label">' . __('Hide Featured Image', 'themify') . '</span>
						
						<select name="setting-default_page_post_image">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_page_post_image'] ) && ( $title_option['value'] == $data['setting-default_page_post_image'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .=	'</select>
					</p><p>
						<span class="label">' . __('Unlink Featured Image', 'themify') . '</span>
						
						<select name="setting-default_page_unlink_post_image">';
						foreach ( $default_options as $title_option ) {
							if ( isset( $data['setting-default_page_unlink_post_image'] ) && ( $title_option['value'] == $data['setting-default_page_unlink_post_image'] ) ) {
								$output .= '<option selected="selected" value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							} else {
								$output .= '<option value="'.$title_option['value'].'">'.$title_option['name'].'</option>';
							}
						}
		$output .= '</select></p>';
		$output .= themify_feature_image_sizes_select('image_post_single_feature_size');
		$output .= '<p>
				<span class="label">' . __('Image Size', 'themify') . '</span>
						<input type="text" class="width2" name="setting-image_post_single_width" value="' . themify_get( 'setting-image_post_single_width' ) . '" /> ' . __('width', 'themify') . ' <small>(px)</small>  
						<input type="text" class="width2" name="setting-image_post_single_height" value="' . themify_get( 'setting-image_post_single_height' ) . '" /> ' . __('height', 'themify') . ' <small>(px)</small>
						<br /><span class="pushlabel"><small>' . __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify') . '</small></span>
					</p>
					<p>
						<span class="label">' . __('Featured Image Alignment', 'themify') . '</span>
						<select name="setting-image_post_single_align">
							<option></option>';
		$options = array( 'left', 'right' );
		foreach ( $options as $option ) {
			if ( isset( $data['setting-image_post_single_align'] ) && ( $option == $data['setting-image_post_single_align'] ) ) {
				$output .= '<option value="'.$option.'" selected="selected">'.$option.'</option>';
			} else {
				$output .= '<option value="'.$option.'">'.$option.'</option>';
			}
		}
		$output .=	'</select>
					</p>';

		$output .= '<p><span class="label">' . __('Post Comments', 'themify') . '</span><label for="setting-comments_posts"><input type="checkbox" id="setting-comments_posts" name="setting-comments_posts" '.checked( themify_get( 'setting-comments_posts' ), 'on', false ).' /> ' . __('Disable comments in all Posts', 'themify') . '</label></p>';	

		$output .= '<p><span class="label">' . __('Show Author Box', 'themify') . '</span><label for="setting-post_author_box"><input type="checkbox" id="setting-post_author_box" name="setting-post_author_box" '.checked( themify_get( 'setting-post_author_box' ), 'on', false ).' /> ' . __('Show author box in all Posts', 'themify') . '</label></p>';

		// Post Navigation
		$pre = 'setting-post_nav_';
		$output .= '
		<p>
			<span class="label">' . __('Post Navigation', 'themify') . '</span>
			<label for="'.$pre.'disable">
				<input type="checkbox" id="'.$pre.'disable" name="'.$pre.'disable" '. checked( themify_get( $pre.'disable' ), 'on', false ) .'/> ' . __('Remove Post Navigation', 'themify') . '
				</label>
		<span class="pushlabel vertical-grouped">
				<label for="'.$pre.'same_cat">
					<input type="checkbox" id="'.$pre.'same_cat" name="'.$pre.'same_cat" '. checked( themify_get( $pre.'same_cat' ), 'on', false ) .'/> ' . __('Show only posts in the same category', 'themify') . '
				</label>
			</span>
		</p>';	
			
		return $output;
	}

?>