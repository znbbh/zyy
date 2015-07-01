<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! function_exists( 'thb_author_block_enabled' ) ) {
	/**
	 * Check if the blog post author block should be displayed.
	 *
	 * @return boolean
	 */
	function thb_author_block_enabled( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'enable_author_block' ) == '1';
	}
}

if( ! function_exists( 'thb_navigation_block_enabled' ) ) {
	/**
	 * Check if the navigation between posts block should be displayed.
	 *
	 * @return boolean
	 */
	function thb_navigation_block_enabled() {
		return thb_get_post_meta( thb_get_page_ID(), 'disable_navigation_block' ) != '1';
	}
}

if( ! function_exists('thb_get_post_subtitle') ) {
	/**
	 * Get the post subtitle.
	 *
	 * @param int $id The page ID.
	 * @return string
	 */
	function thb_get_post_subtitle( $id = null ) {
		if ( ! $id ) {
			global $post;
			$id = thb_get_page_ID();
		}

		return thb_get_post_meta( $id, 'post_subtitle' );
	}
}

if( ! function_exists('thb_post_subtitle') ) {
	/**
	 * Get the post subtitle.
	 *
	 * @param int $id The page ID.
	 */
	function thb_post_subtitle( $id = null ) {
		echo thb_get_post_subtitle( $id );
	}
}