<?php

/*	Definitions
	================================================= */
	
	/** Theme Name */
	if ( ! defined('THEMENAME') ) {
		define( 'THEMENAME', 'Leisure' );
	}
	
	/** Theme Prefix */
	if ( ! defined('THEMEPREFIX') ) {
		define('THEMEPREFIX', 'leisure');
	}
	
	/** Admin Name */
	if ( ! defined('ADMINNAME') ) {
		define( 'ADMINNAME',  __( 'Theme Options', 'CURYLTHEME' ) );
	}
	
	/** Theme Options Array */
	$curly_theme_options = unserialize( get_option( THEMEPREFIX.'_theme_options' ) );

/*	Theme Update
	================================================= */	
	$curly_tf_user = $curly_theme_options['theme_options_username'];
	$curly_tf_api  = $curly_theme_options['theme_options_api'];
	
	if ( isset( $tf_user ) && isset( $tf_api ) ) {
		load_template( trailingslashit( get_template_directory() ) . 'framework/theme-update/envato-wp-theme-updater.php' );
		Envato_WP_Theme_Updater::init( $curly_tf_user, $curly_tf_api, 'Curly Themes' );	
	}

/*	Theme Navigation
	================================================= */	
	register_nav_menus( array(
		'menuMainMenu' => 'Main Menu',
		'menuSecondaryMenu' => 'Secondary Menu'
	));

/*	Sidebars
	================================================= */	
	if ( function_exists('register_sidebar'))
		register_sidebar(array(
		'name'			 => __('Sidebar - Blog', 'CURLYTHEME'),
		'id'			 => 'sidebar_blog',
		'before_widget'	 => '<aside id="%1$s" class="sidebar-widget %2$s animated">',
		'after_widget' 	 => '</aside>',
		'before_title'	 => '<h4 class="widget-title">',
		'after_title'	 => '</h4>',
	));
	
	if ( function_exists('register_sidebar'))
		register_sidebar(array(
		'name'			 => __('Sidebar - Page' , 'CURLYTHEME'),
		'id'			 => 'sidebar_page',
		'before_widget'	 => '<aside id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' 	 => '</aside>',
		'before_title'	 => '<h4 class="widget-title">',
		'after_title'	 => '</h4>',
	));
	
	switch ( get_theme_mod( 'footer_columns', 6 ) ) {
		case 1 : $sidebar_columns = 'col-xs-12'; break;
		case 2 : $sidebar_columns = 'col-sm-6'; break;
		case 3 : $sidebar_columns = 'col-sm-4'; break;
		case 4 : $sidebar_columns = 'col-md-3 col-sm-4'; break;
		case 6 : $sidebar_columns = 'col-lg-2 col-md-3 col-sm-4'; break;
		default: $sidebar_columns = 'col-lg-2 col-md-3 col-sm-4'; 
	}
	
	if ( function_exists('register_sidebar'))
		register_sidebar(array(
		'name'			 => __('Footer Widget Area' , 'CURLYTHEME'),
		'id'			 => 'footer_widget_area',
		'before_widget'	 => '<aside id="%1$s" class="'.$sidebar_columns.' sidebar-widget %2$s">',
		'after_widget' 	 => '</aside>',
		'before_title'	 => '<h5 class="widget-title">',
		'after_title'		 => '</h5>',
	));	
	
/*	Content Width
	================================================= */	
	if ( ! isset( $content_width ) ) { 
		$content_width = 750; 
	}

/*	Add Theme Support
	================================================= */	
	add_theme_support('post-thumbnails', array('post'));	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'chat', 'link', 'image', 'quote', 'status', 'video', 'audio') );
	$curly_defaults_header = array(
		'random-default'         => true,
		'width'                  => 0,
		'height'                 => 400,
		'flex-height'            => true,
		'flex-width'             => true,
		'header-text'            => true,
		'uploads'                => true
	);
	add_theme_support( 'custom-header', $curly_defaults_header );
	function theme_slug_setup() {
	   add_theme_support( 'title-tag' );
	}
	add_action( 'after_setup_theme', 'theme_slug_setup' );
	
/*	Load Scripts & Styles
	================================================= */
	function curly_load_theme_scripts(){
	
		global $curly_theme_options;
		
		/** Register Styles */
		wp_register_script('curly-google-maps', '//maps.google.com/maps/api/js?sensor=false&amp;language=en', null, null, true);
		wp_register_script('curly-gmap3', get_template_directory_uri() .'/js/gmap3.min.js', array('curly-google-maps'), null, true);
		wp_register_script('curly-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery', 'curly-imagesLoaded'), null, true);
		wp_register_script('curly-imagesLoaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), null, true);
		wp_register_script('curly-sticky-kit', get_template_directory_uri() . '/js/jquery.sticky-kit.min.js', array('jquery'), null, true);
		wp_register_script('curly-match-height', get_template_directory_uri() . '/js/jquery.matchHeight-min.js', array('jquery'), null, true);

		/** Enqueue Scripts */
		wp_enqueue_script('curly-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-dropdown', get_template_directory_uri() . '/js/dropdown-menu.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-waypoints-sticky', get_template_directory_uri() . '/js/waypoints-sticky.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-doubletap', get_template_directory_uri() . '/js/doubletaptogo.js', array('jquery'), null, true);
		wp_enqueue_script('curly-velocity', get_template_directory_uri() . '/js/jquery.velocity.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-velocity-ui', get_template_directory_uri() . '/js/jquery.velocity.ui.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-wallpaper', get_template_directory_uri() . '/js/jquery.fs.wallpaper.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-boxer', get_template_directory_uri() . '/js/jquery.fs.boxer.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), null, true);
		wp_enqueue_script('curly-main', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
		
		/** JS Data */
		wp_localize_script( 'curly-main', 'data', array(
			'animations'	=> $curly_theme_options['general_animations'],
			'sticky_menu'	=> get_theme_mod( 'sticky_menu', true )
		) );
		
		/** Enqueue Styles */
		wp_enqueue_style( 'curly-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', null, null, 'all'); 
		wp_enqueue_style( 'curly-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', null, null, 'all');
		wp_enqueue_style( 'curly-boxer', get_template_directory_uri() . '/css/jquery.fs.boxer.css', null, null, 'all'); 
		wp_enqueue_style( 'curly-wallpaper', get_template_directory_uri() . '/css/jquery.fs.wallpaper.css', null, null, 'all');
		wp_enqueue_style( 'curly-owlcarousel', get_template_directory_uri() . '/css/owl.carousel.min.css', null, null, 'all'); 
		wp_enqueue_style( 'curly-patterns', get_template_directory_uri() . '/css/patternbolt.css', null, null, 'all'); 
		wp_enqueue_style( 'curly-style', get_stylesheet_uri(), null, '1', 'all');
		
		
		/** Advanced Coloring **/
		$color_text				= new CurlyThemesColor( get_theme_mod('text_color', '#667279') );
		$color_link 			= new CurlyThemesColor( get_theme_mod('link_color', '#363D40') );
		$color_primary 			= new CurlyThemesColor( get_theme_mod('primary_color', '#C0392B' ) );
		$color_bg 				= new CurlyThemesColor( get_theme_mod('background_color', '#ffffff') );
		$color_h1 				= new CurlyThemesColor( $curly_theme_options['color_h1'], '#363d40' );
		$color_h2 				= new CurlyThemesColor( $curly_theme_options['color_h2'], '#363D40' );
		$color_h3 				= new CurlyThemesColor( $curly_theme_options['color_h3'], '#363D40' );
		$color_h4 				= new CurlyThemesColor( $curly_theme_options['color_h4'], '#363D40' );
		$color_h5 				= new CurlyThemesColor( $curly_theme_options['color_h5'], '#C0392B' );
		$color_h6 				= new CurlyThemesColor( $curly_theme_options['color_h6'], '#363D40' );
		$color_footer 			= new CurlyThemesColor( $curly_theme_options['footer_text_color'], '#667279' );
		$color_footer_links 	= new CurlyThemesColor( $curly_theme_options['footer_link_color'], '#667279' );
		$color_footer_titles 	= new CurlyThemesColor( $curly_theme_options['footer_title_color'], '#363D40' );
		$color_footer_bg 		= new CurlyThemesColor( $curly_theme_options['footer_color_bg'], '#F0F1F2' );
		$color_header			= new CurlyThemesColor( $curly_theme_options['header_text_color'], '#ffffff' );
		$color_header_bg		= new CurlyThemesColor( $curly_theme_options['header_shading_color'], '#000000' );
		$header_opac			= $curly_theme_options['header_shading_opacity'];
		$header_height			= $curly_theme_options['header_height'];
		$header_align			= $curly_theme_options['header_align'];
		
		/** Absolute Header */
		$css = "
			.header-row{
				background-color: ".$color_header_bg->opacity( $header_opac / 100 ).";
				color: ".$color_header->opacity(0.75).";
			}
		";
		
		switch ( $curly_theme_options['header_align'] ) {
			case 0 	: $header_align = 'left'; $header_margin = '2.8rem'; break;
			case 2 	: $header_align = 'right'; $header_margin = '0'; break;
			default	: $header_align = 'right'; $header_margin = '0';
		}
		
		/** Header Height */
		$css .= "
			#main-nav ul.menu > .menu-item > a,
			#main-nav div.menu > ul > .page_item > a,
			#logo{
				height: {$header_height}px;
				line-height: {$header_height}px;
			}
			#main-nav ul.menu > .current-menu-item > a,
			#main-nav ul.menu > .current-menu-ancestor > a,
			#main-nav ul.menu > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_item > a,
			#main-nav div.menu > ul > .current_page_parent > a,
			#main-nav div.menu > ul > .current_page_ancestor > a{
				height: {$header_height}px;
				line-height: ".($header_height - 6)."px;
			}
			.sticky-wrapper #main-nav.stuck ul.menu > .menu-item > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .page_item > a{
				height: ".( floor( $header_height / 1.333333333 ) )."px;
				line-height: ".( floor( $header_height / 1.333333333 ) )."px;
			}
			.sticky-wrapper #main-nav.stuck ul.menu > .current-menu-item > a,
			.sticky-wrapper #main-nav.stuck ul.menu > .current-menu-ancestor > a,
			.sticky-wrapper #main-nav.stuck ul.menu > .current_page_parent > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .current_page_item > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .current_page_parent > a,
			.sticky-wrapper #main-nav.stuck div.menu > ul > .current_page_ancestor > a{
				height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
				line-height: ".( floor( ( $header_height / 1.333333333 ) - 6) )."px;
			}
			#search-form .search-field{
				height: ".($header_height)."px;
			}
			#search-form .close-search{
				line-height: ".($header_height)."px;
			}
			.sticky-wrapper #main-nav.stuck #search-form .search-field{
				height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
			}
			.stuck #search-form .close-search{
				line-height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
			}
			.stuck #logo{
				height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
				line-height: ".( floor( ( $header_height / 1.333333333 ) ) )."px;
			}
			#main-nav ul.menu,
			#main-nav div.menu > ul{
				float: $header_align;
				margin-left: $header_margin;
			}
			.sticky-wrapper{
				min-height: {$header_height}px !important;
			}
		";	
		
		/** Headings Coloring */
		$css .= "
			h1{
				color: $color_h1
			}
			h2{
				color: $color_h2
			}
			h3{
				color: $color_h3
			}
			h4{
				color: $color_h4
			}
			h5{
				color: $color_h5
			}
			h6{
				color: $color_h6
			}
		";
		
		/** Secondary Menu */
		$css .= "
			#secondary-nav .menu > .menu-item > a,
			#secondary-nav .sub-menu{
				color: $color_header;
				border-color: $color_header;
			}
			#secondary-nav .menu > .menu-item:hover > a{
				color: ".$color_header->opacity(0.65).";
			}
			@media (max-width:767px) {
				#secondary-nav .menu{
					background: $color_bg;
				}
				#secondary-nav .menu > .menu-item{
					border-color: ".$color_text->opacity(0.25).";
				}
				#secondary-nav .menu > .menu-item > a,
				#secondary-nav .menu > .menu-item > a em{
					color: $color_link !important
				}
			}
		";
		
		/** Footer Coloring */
		$css .= "
			html, body, #footer{
				background-color: $color_footer_bg;
				color: $color_footer;
			}
			#footer a{
				color: $color_footer_links;
			}
			#footer a:hover{
				color: ".$color_footer_links->opacity(0.5).";
			}
			#footer .widget-title{
				color: $color_footer_titles
			}
			#footer abbr{
				border-bottom-color: ".$color_footer->opacity(0.25)."
			}
			#main-footer + #absolute-footer .widget{
				border-top: 1px solid ".$color_footer_titles->opacity(0.1)."
			}
		";
		
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
		
		/** Individual Page Settings */
		global $curly_core; $css .= $curly_core->individual_page_settings();
		
		/** Custom CSS */
		$css .= $curly_theme_options["custom_css"];
		
		/** Add Inline CSS */
		wp_add_inline_style( 'curly-style', CurlyThemes::minify_css( htmlspecialchars_decode( $css ) ) ); 

	}
	add_action('wp_enqueue_scripts', 'curly_load_theme_scripts');

/*	Enqueue Admin Scripts
    ================================================= */    	
	function curly_admin_enqueue( $hook ) {	
		wp_enqueue_script('thickbox');
	 	wp_enqueue_style('thickbox');
	 	wp_enqueue_style('curly-customizer', get_template_directory_uri() . '/framework/css/customizer.css', null, null, 'all');
	 	if ( in_array( get_current_screen()->id, get_post_types()) ) {
	 		wp_enqueue_style('curly-meta-boxes-css', get_template_directory_uri() . '/framework/css/meta-boxes.css', null, null, 'all');
	 		wp_enqueue_style( 'wp-color-picker' );	
	 		wp_enqueue_media();
	 		wp_enqueue_script('curly-hash', get_template_directory_uri() . '/framework/js/hashTabber.js');
	 		wp_enqueue_script('wp-color-picker');
	 		
	 		// Get Current Color Scheme
	 		global $_wp_admin_css_colors; 
	 		$admin_colors = $_wp_admin_css_colors;
	 		$color_scheme = $admin_colors[get_user_option('admin_color')]->colors;
	 		
	 		$color_scheme = '
	 			#individual-page-settings .form-control .slider.ui-slider .ui-slider-handle{
	 				background: '.$color_scheme[3].';
	 			}
	 			#individual-page-settings-wrapper > ul > li.ui-state-active > a{
	 				border-left: 5px solid '.$color_scheme[3].';
	 				border-top-color: '.$color_scheme[3].';
	 				padding-left: 15px;
	 			}';
	 		
	 		wp_add_inline_style('curly-meta-boxes-css', $color_scheme);
	 	}
	}
	add_action( 'admin_enqueue_scripts', 'curly_admin_enqueue' );

/*	Editor Style
	================================================= */
	function curly_mce_styles() {
		add_editor_style( 'editor-style.php' );
	}		
	add_action( 'after_setup_theme', 'curly_mce_styles' );		
	
/*	Equestrian Menu Walker & Filter
	================================================= */		
	function curly_add_menu_parent_class( $items ) {
		
		$parents = array();
		foreach ( $items as $item ) {
			if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
				$parents[] = $item->menu_item_parent;
			}
		}
		
		foreach ( $items as $item ) {
			if ( in_array( $item->ID, $parents ) ) {
				$item->classes[] = 'menu-parent-item'; 
			}
		}
		
		return $items;    
	}
	add_filter( 'wp_nav_menu_objects', 'curly_add_menu_parent_class' );
	add_filter('wp_nav_menu_items', 'do_shortcode');
	
	class Curly_Extended_Menu extends Walker_Nav_Menu {
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
		    {
		        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;
		
		        $class_names = join( ' ' , apply_filters( 'nav_menu_css_class' , array_filter( $classes ), $item ) );
		
		        ! empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
				
				$data_background = ( get_post_meta( $item->ID, '_menu_item_background', true ) ) ? 'data-background='.esc_attr( get_post_meta( $item->ID, '_menu_item_background', true ) ) : null;
				
		        $output .= "<li id='menu-item-$item->ID' $class_names $data_background>";
		
		        $attributes  = '';
		
		        ! empty( $item->attr_title ) and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
		        ! empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
		        ! empty( $item->xfn ) and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
		        ! empty( $item->url ) and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
		
		        // insert description for top level elements only
		        // you may change this
		        $description = ( ! empty ( $item->description ) and 0 == $depth )
		            ? '<small class="nav_desc">' . esc_attr( $item->description ) . '</small>' : '';
		
		        $title = apply_filters( 'the_title', $item->title, $item->ID );
					
		        $item_output = $args->before
		            . "<a $attributes>"
		            . $args->link_before
		            . $title
		            . $description
		            . '</a> '
		            . $args->link_after
		            . $args->after;
		
		        // Since $output is called by reference we don't need to return anything.
		        $output .= apply_filters(
		            'walker_nav_menu_start_el'
		        ,   $item_output
		        ,   $item
		        ,   $depth
		        ,   $args
		        );
		    }
	}
	
/*  Search Button
	================================================ */
	add_filter( 'wp_nav_menu_items', 'curly_search_icon', 10, 2 );
	function curly_search_icon ( $items, $args ) {
	    if ( $args->theme_location == 'menuMainMenu' ) {
	    	if ( get_theme_mod('search_menu', true) == 'true' ) {
	        $items .= '<li class="menu-item"><a href="#" class="search-button hidden-xs"><i class="fa fa-search"></i></a><form id="search-form-inline" action="'.esc_url( home_url( '/' ) ).'" class="visible-xs-block" role="search"><input type="text" class="search-field" name="s" placeholder="'.__( "Type something to search  ...", "CURLYTHEME" ).'"></form></li>';
	        }
	    }
	    return $items;
	}

/*	Function curly_is_blog()
	================================================= */	
	function curly_is_blog() { 
		global  $post; $posttype = get_post_type($post);
		if ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post') ) { 
			return true;
		} else { 
			return false; 
		} 
	}
	
/*	Individual Page Settings
	================================================= */
	load_template( trailingslashit( get_template_directory() ) . 'framework/meta-boxes/framework.individual-page-settings.php' );

/*	Load Plugins
	================================================= */
	load_template( trailingslashit( get_template_directory() ) . 'framework/framework.plugins.php' );

/*	Get Comments
	================================================= */
	load_template( trailingslashit( get_template_directory() ) . 'framework/framework.comments.php' );	
	
/*	Load Equestrian Options Panel
	================================================= */
	/** Include the Whitelabel plugin */
	include( get_template_directory() . '/admin/admin-page.php' );
		
	/** Include the $options array */
	include( get_template_directory() .'/admin/options.php' );
	
	/** Create the Options Page */
	$curly_options_page = new WhitelabelOptions( ADMINNAME, 'theme-options', THEMEPREFIX, 'themes.php', null, 'read', null, true, false, true, $curly_options, array( THEMEPREFIX.'_custom_css', THEMEPREFIX.'_custom_head', THEMEPREFIX.'_custom_body' ) );

/*	Curly Themes Core Class
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.core.php' );

/*	Color Manipulation Class
	================================================= */	
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.color.php' );
	
/*	Contact Class
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.contact.php' );

/*	Fonts Class
	================================================= */	
	include( trailingslashit( get_template_directory() ) . 'framework/classes/framework.class.fonts.php' );

/*	Custom Menu
	================================================= */		
	include( trailingslashit( get_template_directory() ) . 'framework/navigation/framework.classs.menu-item-custom-fields.php' );
	include( trailingslashit( get_template_directory() ) . 'framework/navigation/menu-item-custom-fields-example.php' );

/*	Leisure Customizer
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.customizer.php' );
	
/*	Visual Composer Extensions
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.vc.php' );	

/*	Welcome Page
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.welcome.php' );		

/*	Welcome Page
	================================================= */
	include( trailingslashit( get_template_directory() ) . 'framework/framework.shortcodes.php' );			

	include( trailingslashit( get_template_directory() ) . 'framework/latest.php' );			
	
/*	3rd Party Integration
	================================================= */

/*	WPML  */
	load_template( trailingslashit( get_template_directory() ) . 'framework/framework.wpml.php' );

/*	WooCommerce  */
	load_template( trailingslashit( get_template_directory() ) . 'framework/framework.woocommerce.php' );

/*	BBPress  */
	load_template( trailingslashit( get_template_directory() ) . 'framework/framework.bbpress.php' );	

/*	Ninja Forms  */
	load_template( trailingslashit( get_template_directory() ) . 'framework/framework.ninja.php' );	
	
	add_filter( 'mce_buttons_2', 'fb_mce_editor_buttons' );
	function fb_mce_editor_buttons( $buttons ) {
	
	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;
	}
	
	add_filter( 'tiny_mce_before_init', 'fb_mce_before_init' );
	
	function fb_mce_before_init( $settings ) {
	
	    $style_formats = array(
	        array(
	            'title' => 'Button (inline)',
	            'selector' => 'a',
	            'classes' => 'btn btn-inline'
	            ),
	        array(
	            'title' => 'Button (default)',
	            'selector' => 'a',
	            'classes' => 'btn btn-default'
	            ),
	        array(
	            'title' => 'Button (link)',
	            'selector' => 'a',
	            'classes' => 'btn btn-link'
	            ),        
	        array(
	            'title' => 'Lead Paragraph',
	            'selector' => 'p',
	            'classes' => 'lead',
	        )
	    );
	
	    $settings['style_formats'] = json_encode( $style_formats );
	
	    return $settings;
	
	}
	
?>