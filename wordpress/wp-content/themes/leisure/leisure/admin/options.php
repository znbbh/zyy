<?php

/*	Start Admin Options 
	================================================= */
	$curly_options = array();

/*	General
	================================================= */
	

	$curly_options[] = array( "name" => __('General Options','CURLYTHEME'),
						"type" => "section");							
	
	$curly_options[] = array( "name" => __('Disable Animations','CURLYTHEME'),
				"desc" => __("Check this if you want to disable all CSS3 animations ", 'CURLYTHEME'),
				"id" => "general_animations",
				'class' => 'medium first',
				"std" => "false",
				"type" => "switch");
	
	$curly_options[] = array( "name" => __('Hide Comments on Pages','CURLYTHEME'),
				"desc" => __("Check this if you want to hide the comments on pages.", 'CURLYTHEME'),
				"id" => "general_comments_pages",
				"class" => "medium last",
				"std" => "false",
				"type" => "switch");
	
	$curly_options[] = array("type" => "divider");										
	
	$curly_options[] = array( "name" => __('Description Excerpt Size','CURLYTHEME'),
				"desc" => "Choose the number of words you want to display",
				"id" => "blog_listing_excerpt",
				"class" => "medium first",
				"std" => 20,
				"min" => 0,
				"max" => 100,
				"suffix" => " words",
				"type" => "number");
	
	$curly_options[] = array("type" => "divider");
	
	$curly_options[] = array( "name" => __('Hide Author Box','CURLYTHEME'),
				"desc" => __("Check this if you want to hide the author box on blog pages", 'CURLYTHEME'),
				"id" => "hide_author",
				"class" => "medium first",
				"std" => "true",
				"type" => "switch");
	
	$curly_options[] = array( "name" => __('Sharing Box Title','CURLYTHEME'),
				"desc" => __("Enter your sharing box title", 'CURLYTHEME'),
				"id" => "general_sharing",
				'class' => 'medium last',
				"std" => __( 'Did you like this? Share it!', 'CURLYTHEME' ),
				"type" => "text");	
	
	$curly_options[] = array( "name" => __('Hide Sharing Box on Pages','CURLYTHEME'),
				"desc" => __("Check this if you want to hide the sharing box on pages", 'CURLYTHEME'),
				"id" => "general_sharing_box_pages",
				"class" => "medium first",
				"std" => "true",
				"type" => "switch");				
	
	$curly_options[] = array( "name" => __('Hide Sharing Box on Posts','CURLYTHEME'),
				"desc" => __("Check this to hide the sharing box", 'CURLYTHEME'),
				"id" => "general_sharing_box",
				"class" => "medium last",
				"std" => "false",
				"type" => "switch");		
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('Theme Forest Username','CURLYTHEME'),
				"desc" => __("Enter your Theme Forest username. Fill up this field to get future automatic theme updates. <strong>Note: Key Sensitive</strong>", 'CURLYTHEME'),
				"id" => "theme_options_username",
				'class' => 'medium first',
				"std" => null,
				"type" => "text");	
	
	$curly_options[] = array( "name" => __('Theme Forest API Key','CURLYTHEME'),
				"desc" => __("Enter your Theme Forest secret API key. Fill up this field to get future automatic theme updates. <strong>Note: Key Sensitive</strong>", 'CURLYTHEME'),
				"id" => "theme_options_api",
				'class' => 'medium last',
				"std" => null,
				"type" => "text");
	
	$curly_options[] = array("type" => "divider");			
				
	$curly_options[] = array( "name" => __('Google Analytics ID','CURLYTHEME'),
				"desc" => __('e.g. UA-XXXXX-Y or UA-XXXXX-YY.','CURLYTHEME'),
				"id" => "seo_analytics",
				"class" => "medium first",
				"std" => "",
				"type" => "text");	
	
	$curly_options[] = array( "name" => __('Google Webmaster Tools Site Verification','CURLYTHEME'),
				"desc" => __('Please insert verification code for Webmaster tools in here','CURLYTHEME'),
				"id" => "seo_webmaster",
				"class" => "medium last",
				"std" => "",
				"type" => "text");				
									

/*	Header
	================================================= */	

	$curly_options[] = array( "name" => __('Header Options','CURLYTHEME'),
						"type" => "section");				

	$curly_options[] = array( "name" => __('Header Height','CURLYTHEME'),
				"desc" => __("Default value: 80px", 'CURLYTHEME'),
				"id" => "header_height",
				"class" => "medium first",
				"std" => "80",
				"type" => "number",
				'prefix' => '',
				'suffix' => 'px',
				'min' => 40,
				'max' => 200);
	
	$curly_options[] = array( "name" => __('Header Alignment','CURLYTHEME'),
				"desc" => 'Choose your title alignment',
				"id" => "header_align",
				"class" => "medium last",
				"std" => 2,
				"type" => "buttons",
				"options" => array(
					0 => __('Left','CURLYTHEME'),
					2 => __('Right','CURLYTHEME')
				));			
	
	$curly_options[] = array("type" => "divider");		
	
	$curly_options[] = array( "name" => __('Text Color','CURLYTHEME'),
				"desc" => __("Header Text Color", 'CURLYTHEME'),
				"id" => "header_text_color",
				"class" => "tiny first",
				"std" => "#ffffff",
				"type" => "color");				
	
	$curly_options[] = array( "name" => __('Background Color','CURLYTHEME'),
				"desc" => __("Header Background Color", 'CURLYTHEME'),
				"id" => "header_shading_color",
				"class" => "tiny",
				"std" => "#000000",
				"type" => "color");			
	
	$curly_options[] = array( "name" => __('Header Opacity','CURLYTHEME'),
				"desc" => __("Default value: 15%", 'CURLYTHEME'),
				"id" => "header_shading_opacity",
				'class' => 'medium last',
				"std" => "15",
				"type" => "number",
				'prefix' => '',
				'suffix' => '%',
				'increment' => 0.1,
				'min' => 0,
				'max' => 100);			

/*	Typography
	================================================= */
	
	$curly_options[] = array( "name" => __('Typography','CURLYTHEME'),
						"type" => "section");
						
	$curly_options[] = array( "name" => __('General Typography (all texts)','CURLYTHEME'),
				"id" => "fonts_body",
				"std" => array( 'Roboto', 14, 0, 0 ),
				'min' => 10,
				'max' => 18,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array( "name" => __('Include Special Characters','CURLYTHEME'),
				"desc" => __('Subsets for languages with special characters.','CURLYTHEME'),
				"id" => "fonts_subset",
				"class" => "medium first",
				"std" => "0",
				"type" => "select",
				"options" => array('No Subset - Standard Latin','Cyrillic Extended (cyrillic-ext)', 'Greek Extended (greek-ext)', 'Greek (greek)', 'Vietnamese (vietnamese)' , 'Latin Extended (latin-ext)' , 'Cyrillic (cyrillic)'));			
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('H1 Typography','CURLYTHEME'),
				"id" => "fonts_h1",
				"std" => array( 'Domine', 36, 2, 0 ),
				'min' => 30,
				'max' => 68,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('H2 Typography','CURLYTHEME'),
				"id" => "fonts_h2",
				"std" => array( 'Domine', 30, 2, 0 ),
				'min' => 20,
				'max' => 58,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('H3 Typography','CURLYTHEME'),
				"id" => "fonts_h3",
				"std" => array( 'Domine', 24, 2, 0 ),
				'min' => 15,
				'max' => 48,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('H4 Typography','CURLYTHEME'),
				"id" => "fonts_h4",
				"std" => array( 'Domine', 18, 2, 0 ),
				'min' => 14,
				'max' => 30,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");													
	
	$curly_options[] = array( "name" => __('H5 Typography','CURLYTHEME'),
				"id" => "fonts_h5",
				"std" => array( 'Domine', 16, 2, 0 ),
				'min' => 14,
				'max' => 30,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('H6 Typography','CURLYTHEME'),
				"id" => "fonts_h6",
				"std" => array( 'Domine', 14, 2, 0 ),
				'min' => 14,
				'max' => 30,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('Blockquote Typography','CURLYTHEME'),
				"id" => "fonts_blockquote",
				"std" => array( 'Domine', 18, 2, 0 ),
				'min' => 10,
				'max' => 18,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('Menu Typography','CURLYTHEME'),
				"id" => "fonts_menu",
				"std" => array('Roboto', 14, 2, 2),
				'min' => 10,
				'max' => 18,
				'suffix' => 'px',
				"type" => "google_font");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('Secondary Menu Typography','CURLYTHEME'),
				"id" => "fonts_secondary_menu",
				"std" => array('Roboto', 14, 2, 2),
				'min' => 10,
				'max' => 18,
				'suffix' => 'px',
				"type" => "google_font");			


/*	Colors
	================================================= */

	$curly_options[] = array( "name" => __('Color Settings','CURLYTHEME'),
						"type" => "section");				
	
	$curly_options[] = array( "name" => __('H1 Titles','CURLYTHEME'),
				"id" => "color_h1",
				"class" => "tiny first",
				"std" => "#363d40",
				"type" => "color");
	
	$curly_options[] = array( "name" => __('H2 Titles','CURLYTHEME'),
				"id" => "color_h2",
				"class" => "tiny",
				"std" => "#363D40",
				"type" => "color");
	
	$curly_options[] = array( "name" => __('H3 Titles','CURLYTHEME'),
				"id" => "color_h3",
				"class" => "tiny",
				"std" => "#363D40",
				"type" => "color");
	
	$curly_options[] = array( "name" => __('H4 Titles','CURLYTHEME'),
				"id" => "color_h4",
				"class" => "tiny last",
				"std" => "#363D40",
				"type" => "color");
				
	$curly_options[] = array( "name" => __('H5 Titles','CURLYTHEME'),
				"id" => "color_h5",
				"class" => "tiny first",
				"std" => "#C0392B",
				"type" => "color");
	
	$curly_options[] = array( "name" => __('H6 Titles','CURLYTHEME'),
				"id" => "color_h6",
				"class" => "tiny last",
				"std" => "#363D40",
				"type" => "color");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('Footer Colors','CURLYTHEME'),
				"desc" => "",
				"id" => "inf",
				"std" => "Footer Colors",
				"type" => "title");
	
	$curly_options[] = array( "name" => __('Footer Background','CURLYTHEME'),
				"id" => "footer_color_bg",
				"class" => "tiny first",
				"std" => "#F0F1F2",
				"type" => "color");
	
	$curly_options[] = array( "name" => __('Footer Text','CURLYTHEME'),
				"id" => "footer_text_color",
				"class" => "tiny",
				"std" => "#667279",
				"type" => "color");
	
	$curly_options[] = array( "name" => __('Footer Links','CURLYTHEME'),
				"id" => "footer_link_color",
				"class" => "tiny",
				"std" => "#667279",
				"type" => "color");
	
	$curly_options[] = array( "name" => __('Footer Titles','CURLYTHEME'),
				"id" => "footer_title_color",
				"class" => "tiny last",
				"std" => "#363D40",
				"type" => "color");
			
/*	More Options
	================================================= */	

	$curly_options[] = array( "name" => __('Retina & Icons','CURLYTHEME'),
						"type" => "section");			
	
	$curly_options[] = array( "name" => __('Favicon','CURLYTHEME'),
				"desc" => __("Upload 16px * 16px favicon", 'CURLYTHEME'),
				"id" => "general_favicon",
				'class' => 'medium first',
				"std" => null,
				"type" => "upload");
	
	$curly_options[] = array("type" => "divider");			
	
	$curly_options[] = array( "name" => __('iPhone Retina Icon Upload','CURLYTHEME'),
				"desc" => __("Upload 114px * 114px icon", 'CURLYTHEME'),
				"id" => "general_iphone_favicon_retina",
				"class" => "medium first",
				"std" => null,
				"type" => "upload");						
							
	$curly_options[] = array( "name" => __('iPhone Icon Upload','CURLYTHEME'),
					"desc" => __("Upload 57px * 57px icon", 'CURLYTHEME'),
					"id" => "general_iphone_favicon",
					"class" => "medium last",
					"std" => null,
					"type" => "upload");			
	
	$curly_options[] = array("type" => "divider");
	
	$curly_options[] = array( "name" => __('iPad Retina Icon Upload','CURLYTHEME'),
				"desc" => __("Upload 144px * 144px icon.", 'CURLYTHEME'),
				"id" => "general_ipad_favicon_retina",
				"class" => "medium first",
				"std" => null,
				"type" => "upload");				
	
	$curly_options[] = array( "name" => __('iPad Icon Upload','CURLYTHEME'),
					"desc" => __("Upload 72px * 72px icon", 'CURLYTHEME'),
					"id" => "general_ipad_favicon",
					"class" => "medium last",
					"std" => null,
					"type" => "upload");
	
/*	More Options
	================================================= */	

	$curly_options[] = array( "name" => __('Custom Code','CURLYTHEME'),
						"type" => "section");
							
	$curly_options[] = array( "name" => __('Custom CSS','CURLYTHEME'),
				"desc" => __('This code will be the last CSS code applied. This will be inserted inline in <head> tag','CURLYTHEME'),
				"id" => "custom_css",
				'class' => 'full_textarea code_field',
				"std" => "",
				"type" => "code");
	
	$curly_options[] = array( "name" => __('Code before the </head> tag','CURLYTHEME'),
				"id" => "custom_head",
				"desc" => __('This code will be inserted right before closing the </head> tag','CURLYTHEME'),
				'class' => 'full_textarea code_field',
				"std" => "",
				"type" => "code");		
	
	$curly_options[] = array( "name" => __('Code before the </body> tag','CURLYTHEME'),
				"desc" => __('This code will be inserted right before closing the </body> tag','CURLYTHEME'),
				"id" => "custom_body",
				'class' => 'full_textarea code_field',
				"std" => "",
				"type" => "code");

/*	Back-up and Restore Options
	================================================= */
	
	$curly_options[] = array( "name" => __('Back-up & Restore','CURLYTHEME'),
						"type" => "section");
	
	$curly_options[] = array( "name" => __('Export Options','CURLYTHEME'),
				"desc" => __('Copy the code above and use it later for import','CURLYTHEME'),
				"id" => "export_field",
				'class' => 'medium first',
				"std" => "",
				"type" => "export");
	
	$curly_options[] = array( "name" => __('Import Options','CURLYTHEME'),
				"desc" => __('Paste the code previously saved','CURLYTHEME'),
				"id" => "import_field",
				'class' => 'medium last',
				"std" => "",
				"type" => "import");
	
	$curly_options[] = array( "name" => __('Reset Options','CURLYTHEME'),
				"desc" => __('Click the link below to revet your theme options to default. Warning: all your current options will be lost.','CURLYTHEME'),
				"id" => "reset_button",
				'class' => 'medium first',
				"std" => "",
				"type" => "reset");																		
				
?>