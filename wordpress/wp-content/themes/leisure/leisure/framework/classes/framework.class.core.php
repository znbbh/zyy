<?php 

class CurlyThemes {
	
	public function __construct() {
	
		// Google Analytics
		add_action('wp_footer', array($this, 'google_analytics'), 1);
		
		// Custom Footer Code
		add_action('wp_footer', array($this, 'custom_footer_code'), 9999999);
		
		// Category Sanitization
		add_filter( 'wp_list_categories', array($this, 'remove_category_list_rel') );
		add_filter( 'the_category', array($this, 'remove_category_list_rel') );	
		
		// Limit Excerpt
		add_filter( 'excerpt_length', array($this, 'excerpt_length'), 999 );
		
		// HTML5 Shim
		add_action('wp_head', array($this, 'add_ie_html5_shim'));
		
		// Fix XUA
		add_action('send_headers', array($this, 'fix_xua'));
		
		// Responsive
		add_action('wp_head', array($this, 'responsive'), 1);
		
		// Add File Types
		add_filter('upload_mimes', array($this, 'custom_mime_types'));
		
		// Google Verification
		add_action('wp_head', array($this, 'google_verification'), 2);
		
		// Favicons
		add_action('wp_head', array($this, 'favicons'), 5);
		
		// Open Graph
		add_action('wp_head', array($this, 'open_graph'), 5);
		
		// Generator
		add_action('wp_head', array($this, 'meta_generator'), 6);
		
		// Remove Background Page
		add_action('admin_head', array($this, 'remove_background'), 6);
		
		// Custom Head Code
		add_action('wp_head', array($this, 'custom_head_code'), 999999);
		
		// Add General Filters
		add_filter('widget_text', 'do_shortcode');
		
		// Theme Localization
		add_action('after_setup_theme', array( $this, 'theme_localization' ) );
		
		// Filter Gallery
		add_filter( 'post_gallery', array( $this, 'gallery_shortcode' ), 10, 4 );
		
		// Add Browser Class
		add_filter('body_class', array( $this, 'browser_body_class' ) );
		
	}

/*	Remove Background Page
	================================================= */	
	function remove_background() {
		remove_submenu_page( 'themes.php', 'custom-background' );
		remove_submenu_page( 'themes.php', 'custom-header' );
	}

/*	Theme Localization
	================================================= */
	function theme_localization() {
	    load_theme_textdomain('CURLYTHEME', get_template_directory() . '/languages');
	}	
	
/*	Google Analytics
	================================================= */
	function google_analytics() {
		global $curly_theme_options;
		if( $curly_theme_options['seo_analytics'] ) {
			echo "<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', '".$curly_theme_options['seo_analytics']."', 'auto');
			  ga('send', 'pageview');
			
			</script>"; 
		}
	}
	
/*	Filter Gallery
	================================================= */	
	function gallery_shortcode( $output = '', $atts, $content = false, $tag = false ) {
		wp_enqueue_script('curly-isotope');
	}

/*	Custom Footer Code
	================================================= */
	function custom_footer_code() {
		global $curly_theme_options;
		echo htmlspecialchars_decode( $curly_theme_options['custom_body'] );
	}

/*	Remove rel Attribute
	================================================= */	
	function remove_category_list_rel( $output ) {
	    return str_replace( ' rel="category tag"', '', $output );
	}

/*	Limit Excerpt
	================================================= */	
	function excerpt_length() {
		global $curly_theme_options;
		$length	= $curly_theme_options['blog_listing_excerpt'];
		if ( !$length ) $length = 60;
		return $length;
	}

/*	HTML5 Shim
	================================================= */	
	function add_ie_html5_shim () {
	    echo '<!--[if lt IE 9]>';
	    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	    echo '<![endif]-->';
	}

/*	Fix XUA
	================================================= */		
	function fix_xua(){
		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) header('X-UA-Compatible: IE=edge,chrome=1');
	}
	
/*	Responsive
	================================================= */
	function responsive() {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">';
	}
	function body_class() {
		global $curly_theme_options;
		$out = $curly_theme_options['general_animations'] == 'true' ? ' no-animations' : ' animations';
		
		return $out;
	}
	
/*	Google Verification
	================================================= */	
	function google_verification() {
		global $curly_theme_options;
		$verification = $curly_theme_options['seo_webmaster']; 
		if( $verification ) {
			echo '<meta name="google-site-verification" content="'.$verification.'">';
		}
	}

/*	Meta Generator
	================================================= */	
	function meta_generator() {
		echo '<meta name="generator" content="'.wp_get_theme()->get( 'Name' ) . " " . wp_get_theme()->get( 'Version' ).'">';
	}

/*	Open Graph
	================================================= */
	function open_graph() {
		echo '<meta property="og:title" content="'.wp_title( ' - ', false, 'right' ).get_bloginfo('name').'" />';
		if ( is_single() ) {
			switch ( get_post_format() ) {
				case 'video' : $type = 'video'; break;
				case 'audio' : $type = 'audio'; break;
				case 'image' : $type = 'image'; break;
				default : $type = 'article';
			}
			echo '<meta property="og:type" content="'.$type.'" />';
			
		} else{
			echo '<meta property="og:type" content="article" />';
		}
		$image = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( ), 'single-post-thumbnail' ) : get_theme_mod( 'logo' );
		echo '<meta property="og:image" content="'.( is_array($image) ? $image[0] : $image ).'" />';
		echo '<meta property="og:url" content="'.get_permalink().'" />';
	}

/*	Get Menu Name
	================================================= */	
	public function menu_name( $location ) {
	    if( empty($location) ) return false;
	
	    $locations = get_nav_menu_locations();
	    if( ! isset( $locations[$location] ) ) return false;
	
	    $menu_obj = get_term( $locations[$location], 'nav_menu' );
	
	    return $menu_obj;
	}

/*	Favicon
	================================================= */	
	function favicons() {
		global $curly_theme_options;
		
		// General Favicon
		$favicon = $curly_theme_options['general_favicon']; 
		if( $favicon ){
			echo '<link rel="icon" type="image/png" href="'.$favicon.'">';
		}
		
		// iPhone Icon
		$iphone_favicon = $curly_theme_options['general_iphone_favicon']; 
		if( $iphone_favicon ){
			echo '<link rel="apple-touch-icon" href="'.$iphone_favicon.'">';
		}
		
		// Retina iPhone Icon
		$iphone_favicon_retina = $curly_theme_options['general_iphone_favicon_retina']; 
		if($iphone_favicon_retina) {
			echo '<link rel="apple-touch-icon" sizes="114x114" href="'.$iphone_favicon_retina.'">';
		}
		
		// iPad Icon
		$ipad_favicon = $curly_theme_options['general_ipad_favicon']; 
		if($ipad_favicon) {
			echo '<link rel="apple-touch-icon" sizes="72x72" href="'.$ipad_favicon.'">';
		}
		
		// Retina iPad Icon
		$ipad_favicon_retina = $curly_theme_options['general_ipad_favicon_retina']; 
		if($ipad_favicon_retina) {
			echo '<link rel="apple-touch-icon" sizes="144x144" href="'.$ipad_favicon_retina.'">';
		}
	}

/*	Custom Head Code
	================================================= */		
	function custom_head_code() {
		global $curly_theme_options;
		echo htmlspecialchars_decode( $curly_theme_options['custom_head'] );
	}

/*	Add File Types
	================================================= */	
	function custom_mime_types($mimes)
	{
		$mimes['mp4'] = 'video/mp4';
		$mimes['webm'] = 'video/webm';
		$mimes['ogg'] = 'video/ogg';
		$mimes['ogv'] = 'video/ogv';
		$mimes['svg'] = 'image/svg+xml';
	
		return $mimes;
	}

/*	Minify CSS
	================================================= */	
	public static function minify_css( $string ) {
		$string = preg_replace('!/\*.*?\*/!s','', $string);
		$string = preg_replace('/\n\s*\n/',"\n", $string);
		
		// space
		$string = preg_replace('/[\n\r \t]/',' ', $string);
		$string = preg_replace('/ +/',' ', $string);
		$string = preg_replace('/ ?([,:;{}]) ?/','$1',$string);
		
		// trailing;
		$string = preg_replace('/;}/','}',$string);
		
		return $string;
	}

/*	Get Attachment ID
	================================================= */	
    public static function get_attachment_id( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
	    return $attachment[0]; 
    }

/*	Generate Logo / Title
	================================================= */	
	public function get_logo(){
	
		$title 			= 	get_bloginfo('name');
		$logo 			= 	get_theme_mod('logo');
		$logo_retina 	= 	get_theme_mod('logo_retina');

		if( $logo ) { 	
			$output = '<img src="'.$logo.'" alt="'.$title.'">'; 
		} 
		
		if ( $logo && $logo_retina ) {
			$logo_id 		= 	$this->get_attachment_id( $logo_retina );
			$logo_data		= 	wp_get_attachment_image_src( $logo_id, 'full' );
			$output  = '<img src="'.$logo.'" alt="'.$title.'" class="logo-nonretina">'; 
			$output .= '<img src="'.$logo_retina.'" width="'.( $logo_data[1] / 2 ).'" height="'.( $logo_data[2] / 2 ).'" alt="'.$title.'" class="logo-retina">';
		}
		
		if ( ! $logo ) { 
			$output = $title; 
		}
		
		return $output;
	}

/*	Page Heading
	================================================= */
	public function check_heading() {
		$heading = 'true';
		
		if ( is_page() || is_single() ) {
			global $post;
			
			$heading_temp = get_post_meta($post->ID, THEMEPREFIX.'_heading', true);
			if ( empty( $heading_temp ) ) {
				$heading_temp = get_post_meta($post->ID, THEMEPREFIX.'page_heading', true);
			}
			
			if ( isset( $heading_temp ) ) {
				switch ( $heading_temp ) {
					case 'on' : $heading = 'false'; break;
					case 'true' : $heading = 'false'; break;
					case 'off' : $heading = 'true'; break;
				}
			}
		}
		
		return $heading;
	}
	
	public function get_page_heading($before, $after){
		
		global $post;
		
		$forum = ( class_exists('bbPress') ) ? true : false;
		
		if ( is_page() || is_single() || is_attachment() ) 
			if( get_post_type() == "post" )
				$html = get_the_title( get_option( 'page_for_posts' ) );
			else
			$html = get_the_title();
		elseif	( is_home() )
			$html = get_the_title(get_option('page_for_posts', true) );
		elseif ( is_category() || is_tax() )
			$html = single_cat_title('' , false);
		elseif ( is_archive() && ! $forum ){
			if ( is_day() ) :
				$html = sprintf( __( 'Daily Archives: %s', 'CURLYTHEME' ), '<span>' . get_the_date() . '</span>' );
			elseif ( is_month() ) :
				$html = sprintf( __( 'Monthly Archives: %s', 'CURLYTHEME' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'CURLYTHEME' ) ) . '</span>' );
			elseif ( is_year() ) :
				$html = sprintf( __( 'Yearly Archives: %s', 'CURLYTHEME' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'CURLYTHEME' ) ) . '</span>' );
			else :
				$html = __( 'Archives', 'CURLYTHEME' );
			endif;
		}
		elseif ( is_search() )
			$html = __('Search Results' , 'CURLYTHEME');
		elseif ( is_404() )
			$html = __('Page could not be found. 404 Error' , 'CURLYTHEME');	
		else
			$html = get_the_title();
		
		if ( function_exists('is_woocommerce') ) {
			if ( is_woocommerce() ) {
				if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
					$html = woocommerce_page_title(false);
				}
			}
		}
		
		if ( ! $before ) {
			$before = '<h1>';
		}
		if ( ! $after ) {
			$after = '</h1>';
		}
		
		$subtitle = ( isset( $post ) ) ? get_post_meta( $post->ID, THEMEPREFIX.'_header_subtitle', true ) : null;
		$subtitle = ( $subtitle ) ? '<small>'.$subtitle.'</small>' : null;
			
		return $before.$html.$subtitle.$after;		
	}

/*	Pagination
	================================================= */	
	public static function get_pagination( $pages = null ){
	
		global $wp_query;
		global $paged;
		
		if($pages ==  null) $pages = $wp_query->max_num_pages;
		
		if($paged == 0) $paged++;
		if($pages > 1)
		{
		   $html = '<ul class="pagination animated">';
		   if($paged > 1) $html .= '<li><a class="pagination-prev" href="'.get_pagenum_link($paged - 1).'"><span>'.__('&laquo;', 'CURLYTHEME').'</span></a></li>';
		   for ($i=1; $i <= $pages; $i++){
			  $html .= ($paged == $i) ? '<li class="active"><span>'.$i.'</span></li>' : '<li><a href="'.get_pagenum_link($i).'" class="inactive">'.$i.'</a></li>';
		   }
		   if ($paged < $pages) $html .= '<li><a class="pagination-next" href="'.get_pagenum_link($paged + 1).'">'.__('&raquo;', 'CURLYTHEME').'</a></li>';  
		   $html .= '</ul>';
		   return $html;
	     }
		 else return null;
	}
	
/*	Curly Header
	================================================= */
	public function header() {
		get_header();
	}

/*	Browser Class
	================================================= */	
	function browser_body_class($classes) {
	    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	    if($is_lynx) $classes[] = 'lynx';
	    elseif($is_gecko) $classes[] = 'gecko';
	    elseif($is_opera) $classes[] = 'opera';
	    elseif($is_NS4) $classes[] = 'ns4';
	    elseif($is_safari) $classes[] = 'safari';
	    elseif($is_chrome) $classes[] = 'chrome';
	    elseif($is_IE) $classes[] = 'ie';
	    else $classes[] = 'unknown';
	    if($is_iphone) $classes[] = 'iphone';
	    return $classes;
	}	

/*	Curly Footer
	================================================= */		
	public function footer() {
		get_footer();
	}

/*	Slider
	================================================= */
	public function slider() {
		
		/** Individual Slider */
		global $post; $id = ( isset( $post ) ) ? $post->ID : null;
		$header_slider = get_post_meta( $id, THEMEPREFIX.'_header_slider', true );
		$header_slider = ( $header_slider ) ? "[rev_slider $header_slider]" : null;
		
		/** Individual Header */
		$header_image = get_post_meta( $id, THEMEPREFIX.'_header_image', true );
		
		/** Global Slider */
		$global_slider = get_theme_mod( 'header_slider' );
		$global_slider = ( $global_slider != '0' ) ? "[rev_slider $global_slider]" : null;
		
		$slider = ( $header_slider ) ? $header_slider : $global_slider;
		
		if ( ! $header_image ) {
			echo ( $slider ) ? '<div id="slider_container">'.do_shortcode( $slider ).'</div>' : null;
		} elseif ( $header_slider ) {
			echo ( $slider ) ? '<div id="slider_container">'.do_shortcode( $slider ).'</div>' : null;
		}
		
		
	}

/*	Individual Page Settings
	================================================= */	
	public function individual_page_settings( $css = null ) {
		global $post; $id = ( isset($post) ) ?  $post->ID : null;
		global $curly_theme_options;
		
		$header_img		= get_post_meta( $id, THEMEPREFIX.'_header_image_id', true );
		$header_size	= get_post_meta( $id, THEMEPREFIX.'_header_height', true );
		$header_height	= get_post_meta( $id, THEMEPREFIX.'_header_height_value', true );
		$header_slider	= get_post_meta( $id, THEMEPREFIX.'_header_slider', true );
		$header_align	= get_post_meta( $id, THEMEPREFIX.'_header_align', true );
		$header_color	= new CurlyThemesColor( get_post_meta( $id, THEMEPREFIX.'_header_text', true ) );
		$header_bg		= new CurlyThemesColor( get_post_meta( $id, THEMEPREFIX.'_header_bg_color', true ) );
		$header_opac	= get_post_meta( $id, THEMEPREFIX.'_header_opacity', true );
		$bg_color		= new CurlyThemesColor( get_post_meta( $id, THEMEPREFIX.'_bg_color', true ) );
		$bg_image		= get_post_meta( $id, THEMEPREFIX.'_bg_image', true );
		$bg_position	= get_post_meta( $id, THEMEPREFIX.'_bg_position', true );
		$bg_repeat		= get_post_meta( $id, THEMEPREFIX.'_bg_repeat', true );
		$bg_size		= get_post_meta( $id, THEMEPREFIX.'_bg_size', true );
		$bg_att			= get_post_meta( $id, THEMEPREFIX.'_bg_attachment', true );
		
		/** Header Image */
		if ( $header_img ) {
			$css .= "
				#header#header{
					background-image: url( ".wp_get_attachment_url( $header_img )." );
				}	
			";
		}
		
		/** Header Size */
		if ( $header_size == 1 && $header_img ) {
			$details = wp_get_attachment_image_src( $header_img , 'full' );
			$height = $details[2];
		}
		if ( $header_size == 2 && $header_slider ) {
			global $wpdb;
			$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
			foreach ( $sliders as $key => $value) {
				if ( $value->alias == $header_slider ) {
					$params = json_decode( $value->params, true );
				}
			}
			$height = $params['height'];
		}
		if ( $header_size == 3 ) {
			$height = $header_height;
		}
		if ( isset( $height ) ) {
			$css .= "
				#header{
					min-height: ".$height."px !important;
				}
				#slider_container{
					height: ".$height."px;
				}
			";
		}
		
		/** Title Color */
		if ( $header_color->_color ) {
			$css .= "
				#page-heading .page-title{
					color: $header_color;
					text-shadow: none;
				}
			";	
		}
		
		/** Header Color */
		if ( $header_bg->_color ) {
			$header_opac = ( $header_opac ) ? $header_opac / 100 : $curly_theme_options['header_shading_opacity'] / 100;
			$css .= "
				.header-row{
					background-color: {$header_bg->opacity($header_opac)}
				}
			";
		}
		
		/** Header Opacity */
		if ( $header_opac && ! $header_bg->_color ) {
			$header_bg	= new CurlyThemesColor( $curly_theme_options['header_shading_color'] );
			$css .= "
				.header-row{
					background-color: {$header_bg->opacity($header_opac / 100)}
				}
			";
		}
		
		/** Background Color */
		if ( $bg_color->_color ) {
			$css .= "
				#site,
				#main-nav,
				#map-description .col-lg-4 > div,
				#main-nav .sub-menu{
					background-color: $bg_color !important;
				}
				.sticky-wrapper #main-nav.stuck{
					background-color: ".$bg_color->opacity(0.97)." !important
				}
			";
		}
		
		/** Background Image */
		if ( $bg_image ) {
			switch ( $bg_position ) {
				case 0 : $bg_position = 'left'; break;
				case 1 : $bg_position = 'center'; break;
				case 2 : $bg_position = 'right'; break;
			}
			switch ( $bg_repeat ) {
				case 0 : $bg_repeat = 'repeat'; break;
				case 1 : $bg_repeat = 'no-repeat'; break;
				case 2 : $bg_repeat = 'repeat-y'; break;
				case 3 : $bg_repeat = 'repeat-x'; break;
			}
			switch ( $bg_size ) {
				case 0 : $bg_size = 'auto'; break;
				case 1 : $bg_size = 'cover'; break;
				case 2 : $bg_size = 'contain'; break;
			}
			switch ( $bg_att ) {
				case 0 : $bg_att = 'scroll'; break;
				case 1 : $bg_att = 'fixed'; break;
				case 2 : $bg_att = 'local'; break;
			}
			$css .= "
				#site{
					background-image: url($bg_image);
					background-position: $bg_position;
					background-repeat: $bg_repeat;
					background-size: $bg_size;
					background-attachment: $bg_att;
				}
			";
		}
		
		/** Header Alignment */
		switch ( $header_align ) {
			case 0 : $header_align = 'left'; break;
			case 1 : $header_align = 'center'; break;
			case 2 : $header_align = 'right'; break;
		}
		$css .= "
			#page-heading .page-title,
			#page-heading .page-title small{
				text-align: $header_align;
			}
		";
		
		return $css;
	}
	
}
$curly_core = new CurlyThemes();

?>