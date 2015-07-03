<?php
class Curly_Menu_Item_Custom_Fields {

	public static function load() {
		add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, '_filter_walker' ), 99 );
	}

	/**
	* Replace default menu editor walker with ours
	*
	* We don't actually replace the default walker. We're still using it and
	* only injecting some HTMLs.
	*
	* @since   0.1.0
	* @access  private
	* @wp_hook filter wp_edit_nav_menu_walker
	* @param   string $walker Walker class name
	* @return  string Walker class name
	*/
	public static function _filter_walker( $walker ) {
	
		$walker = 'Curly_Menu_Item_Custom_Fields_Walker';
		
		include( trailingslashit( get_template_directory() ) . 'framework/navigation/framework.class.walker.edit.php' );
		
		return $walker;
	}
}
add_action( 'wp_loaded', array( 'Curly_Menu_Item_Custom_Fields', 'load' ), 9 );
