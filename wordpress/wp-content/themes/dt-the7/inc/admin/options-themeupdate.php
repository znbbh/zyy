<?php
/**
 * Theme update page.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Theme update", 'theme-options', 'presscore' ),
		"menu_title"	=> _x( "Theme update", 'theme-options', 'presscore' ),
		"menu_slug"		=> "of-themeupdate-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Theme update', 'theme-options', 'presscore'), "type" => "heading" );

/**
 * User credentials.
 */
$options[] = array(	"name" => _x('User credentials', 'theme-options', 'presscore'), "type" => "block_begin" );

	// input
	$options[] = array(
		"desc"		=> _x( 'Themeforest user name', 'theme-options', 'presscore' ),
		"id"		=> 'theme_update-user_name',
		"std"		=> '',
		"type"		=> 'text',
	//	"sanitize"	=> 'textarea'
	);

	// input
	$options[] = array(
		"desc"		=> _x( 'Secret API key', 'theme-options', 'presscore' ),
		"id"		=> 'theme_update-api_key',
		"std"		=> '',
		"type"		=> 'password',
	//	"sanitize"	=> 'textarea'
	);

$options[] = array(	"type" => "block_end");
