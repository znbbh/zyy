<?php
/**
 * Header.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title"	=> _x( "Header", 'theme-options', LANGUAGE_ZONE ),
	"menu_title"	=> _x( "Header", 'theme-options', LANGUAGE_ZONE ),
	"menu_slug"		=> "of-header-menu",
	"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Header', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Background.
 */
$options[] = array(	"name" => _x('Header background', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "header-bg_color",
		"std"	=> "#40FF40",
		"type"	=> "color"
	);

	// background_img
	$options[] = array(
		'type' 			=> 'background_img',
		'id' 			=> 'header-bg_image',
		'desc' 			=> _x( 'Choose / upload background image', 'theme-options', LANGUAGE_ZONE ),
		'preset_images' => $backgrounds_header_bg_image,
		'std' 			=> array(
			'image'			=> '',
			'repeat'		=> 'repeat',
			'position_x'	=> 'center',
			'position_y'	=> 'center',
		),
	);

$options[] = array(	"type" => "block_end");

/**
 * Transparent header.
 */
$options[] = array(	"name" => _x('Transparent header', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "header-transparent_bg_color",
		"std"	=> "#000000",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"      => '',
		"desc"      => _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "header-transparent_bg_opacity",
		"std"       => 50,
		"type"      => "slider",
		"options"   => array( 'java_hide_if_not_max' => true )
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );
	
		// colorpicker
		$options[] = array(
			"name"  => '',
			"desc"  => _x( 'Internet Explorer color', 'theme-options', LANGUAGE_ZONE ),
			"id"    => "header-transparent_bg_ie_color",
			"std"   => "#000000",
			"type"  => "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

	// background_img
	$options[] = array(
		'type' 			=> 'background_img',
		'id' 			=> 'header-transparent_bg_image',
		'desc' 			=> _x( 'Choose / upload background image', 'theme-options', LANGUAGE_ZONE ),
		'preset_images' => $backgrounds_header_transparent_bg_image,
		'std' 			=> array(
			'image'			=> '',
			'repeat'		=> 'repeat',
			'position_x'	=> 'center',
			'position_y'	=> 'center',
		),
	);

$options[] = array(	"type" => "block_end");

/**
 * Header layout.
 */
$options[] = array(	"name" => _x('Header layout', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// input
	$options[] = array(
		"desc"		=> _x( 'Background height (px)', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> 'header-bg_height',
		"std"		=> 90,
		"type"		=> 'text',
		"style"		=> 'mini',
		"sanitize"	=> 'slider'// integer value
	);

	// images
	$options[] = array(
		"name"      => '',
		"desc"      => _x('Header layout', 'theme-options', LANGUAGE_ZONE),
		"id"        => "header-layout",
		"std"       => 'left',
		"type"      => "images",
		"options"   => array(
			'left'				=> '/inc/admin/assets/images/h2.png',
			'center'			=> '/inc/admin/assets/images/h3.png',
			'classic'			=> '/inc/admin/assets/images/h1.png',
			'classic-centered'	=> '/inc/admin/assets/images/h4.png',
			// /inc/admin/assets/images
		)
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-classic' );

		// textarea
		$options[] = array(
			"name"		=> '',
			"desc"		=> _x('Content area', 'theme-options', LANGUAGE_ZONE),
			"id"		=> "header-contentarea",
			"std"		=> false,
			"type"		=> 'textarea'
		);

		// colorpicker
		$options[] = array(
			"desc"	=> _x( 'Content area text color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "header-contentarea_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

	// select
	$options[] = array(
		"desc"      => _x( 'Font', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "header-font_family",
		"std"       => "Open Sans",
		"type"      => "web_fonts",
		"options"   => $merged_fonts,
	);

	// slider
	$options[] = array(
		"desc"      => _x( 'Font size', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "header-font_size",
		"std"       => 16, 
		"type"      => "slider",
		"options"   => array( 'min' => 9, 'max' => 71 ),
		"sanitize"  => 'font_size'
	);

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Uppercase ', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "header-font_uppercase",
		"type"  	=> 'checkbox',
		'std'   	=> 0
	);

	// slider
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x( 'Line height', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "header-font_line_height",
		"std"		=> 30, 
		"type"		=> "slider",
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Font color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "header-font_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-classic header-layout-classic-centered' );

		// colorpicker
		$options[] = array(
			"name"	=> '',
			"desc"	=> _x( 'Lines &amp; dividers color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "header-menu_bg_color",
			"std"	=> "#000000",
			"type"	=> "color"
		);

		// slider
		$options[] = array(
			"name"      => '',
			"desc"      => _x( 'Lines &amp; dividers opacity', 'theme-options', LANGUAGE_ZONE ),
			"id"        => "header-menu_bg_opacity",
			"std"       => 100,
			"type"      => "slider",
			"options"   => array( 'java_hide_if_not_max' => true )
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );
		
			// colorpicker
			$options[] = array(
				"name"  => '',
				"desc"  => _x( 'Internet Explorer color', 'theme-options', LANGUAGE_ZONE ),
				"id"    => "header-menu_bg_ie_color",
				"std"   => "#000000",
				"type"  => "color"
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'type' => 'js_hide_end' );

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Show color frame for menu hovers & colour background for active item', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "header-color_frame",
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Show next level indicator arrows', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "header-next_level_indicator",
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

	// square size
	$options[] = array(
		"desc"      => _x( 'Icons size', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "header-icons_size",
		"type"  	=> 'square_size',
		'std'   	=> array('width' => 20, 'height' => 20)
	);

$options[] = array(	"type" => "block_end");

/**
 * Submenu.
 */
$options[] = array(	"name" => _x('Submenu', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Make parent menu items clickable', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> 'header-submenu_parent_clickable',
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Font color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "header-submenu_color",
		"std"	=> "#3e3e3e",
		"type"	=> "color"
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Submenu background color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "header-submenu_bg_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"      => '',
		"desc"      => _x( 'Submenu background opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "header-submenu_bg_opacity",
		"std"       => 100, 
		"type"      => "slider",
		"options"   => array( 'java_hide_if_not_max' => true )
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );

		// colorpicker
		$options[] = array(
			"name"  => '',
			"desc"  => _x( 'Internet Explorer color', 'theme-options', LANGUAGE_ZONE ),
			"id"    => "header-submenu_bg_ie_color",
			"std"   => "#ffffff",
			"type"  => "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Show next level indicator arrows', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "header-submenu_next_level_indicator",
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

	// square size
	$options[] = array(
		"desc"      => _x( 'Icons size', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "header-submenu_icons_size",
		"type"  	=> 'square_size',
		'std'   	=> array('width' => 16, 'height' => 16)
	);

$options[] = array(	"type" => "block_end");

/**
 * Floating menu.
 */
$options[] = array(	"name" => _x('Floating menu', 'theme-options', 'presscore'), "type" => "block_begin" );

	// radio
	$options[] = array(
		"desc"		=> _x('Floating menu', 'theme-options', 'presscore'),
		"id"		=> 'header-show_floating_menu',
		"std"		=> '1',
		"type"		=> 'radio',
		"options"	=> array(
			'1' => 'show floating menu',
			'0' => 'hide floating menu'
		)
	);

$options[] = array(	"type" => "block_end");

/**
 * Search.
 */
$options[] = array(	"name" => _x('Search', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options[] = array(
		"desc"      => _x( 'Show search', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> 'header-search_show',
		"std"		=> '1',
		"type"		=> 'radio',
		"options"	=> $on_off_options,
	);

$options[] = array(	"type" => "block_end");