<?php 

class CurlyBBPress {
	
	function __construct() {
		
		/** Register BBPress Sidebar */
		if ( function_exists('register_sidebar'))
			register_sidebar(array(
			'name'			 => __('Sidebar - Forum' , 'CURLYTHEME'),
			'id'			 => 'sidebar_forum',
			'before_widget'	 => '<aside id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' 	 => '</aside>',
			'before_title'	 => '<h4 class="widget-title">',
			'after_title'	 => '</h4>',
		));
		
		/** Add Styles */
		add_action( 'wp_enqueue_scripts', array ($this, 'load_scripts' ), 100 );
		
	}
		
	/** Load Scripts */
	function load_scripts() {
		if ( is_bbpress() ) {
			
			//wp_deregister_style( 'bbp-default' );
			
			wp_enqueue_style( 'curly-bbpress', get_template_directory_uri() . '/css/bbpress-theme.css', null, null, 'all'); 
			
			global $theme_options;
			
			$color_text				= new CurlyThemesColor( get_theme_mod('text_color', '#667279') );
			$color_link 			= new CurlyThemesColor( get_theme_mod('link_color', '#363D40') );
			$color_primary 			= new CurlyThemesColor( get_theme_mod('primary_color', '#C0392B' ) );
			$color_bg 				= new CurlyThemesColor( get_theme_mod('background_color', '#ffffff') );
			
			$css = "
				#bbpress-forums li.bbp-header,
				.bbp-pagination-links a:hover{
					background-color: {$color_text->opacity(0.1)};
					border: 1px solid {$color_text->opacity(0.25)};
				}
				#bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic,
				#bbpress-forums li.bbp-body,
				#bbpress-forums .bbp-the-content-wrapper,
				#bbpress-forums #bbp-single-user-details,
				#bbpress-forums .bbp-reply-content{
					border-color: {$color_text->opacity(0.25)}
				}
				.bbpress .bbp_widget_login .button.submit,
				.bbp-pagination-links span.current,
				#bbp-your-profile .button{
					background-color: $color_primary;
					color: {$color_primary->contrast("#ffffff", "#000000")};
					border-color: $color_primary;
				}
				.bbpress .bbp_widget_login .button.submit:hover,
				#bbp-your-profile .button:hover{
					background-color: {$color_primary->darken(20)};
					border-color: {$color_primary->darken(20)};
				}
				#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a{
					color: $color_primary
				}
				.bbp-pagination-links a{
					border: 1px solid {$color_text->opacity(0.25)};
				}
				#bbpress-forums .bbp-admin-links{
					color: $color_link;
				}
				#bbpress-forums .bbp-reply-permalink{
					color: $color_primary
				}
			";
			
			wp_add_inline_style( 'curly-bbpress', CurlyThemes::minify_css( htmlspecialchars_decode( $css ) ) );
		}
	}
	
}

/** Check if BBPress is active before initialization */
if ( class_exists('bbPress') ) {
	new CurlyBBPress();
}

?>