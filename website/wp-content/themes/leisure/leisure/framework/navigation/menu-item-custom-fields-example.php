<?php

class Curly_Menu_Item_Custom_Fields_Create {

	/**
	 * Initialize plugin
	 */
	public static function init() {
		add_action( 'menu_item_custom_fields', array( __CLASS__ , '_fields' ), 10, 3 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue' ) );
	}
	
	public static function admin_enqueue(){
		wp_enqueue_media();
		
		wp_localize_script( 'curly-nav', 'data_object', array( 'button' => __( 'Remove Image', 'CURLYTHEME' ) ) );
		wp_enqueue_script('curly-nav', get_template_directory_uri() . '/framework/js/nav.js');
		wp_enqueue_style('curly-nav', get_template_directory_uri() . '/framework/css/nav.css');
	}


	/**
	 * Save custom field value
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		//check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		// Sanitize
		if ( ! empty( $_POST['_menu_item_background'][ $menu_item_db_id ] ) ) {
			$value = $_POST['_menu_item_background'][ $menu_item_db_id ];
		}
		else {
			$value = '';
		}

		// Update
		if ( ! empty( $value ) ) {
			update_post_meta( $menu_item_db_id, '_menu_item_background', $value );
		}
		else {
			delete_post_meta( $menu_item_db_id, '_menu_item_background' );
		}
	}


	/**
	 * Print field
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $item, $depth, $args = array(), $id = 0 ) {
		
		$id = $item->ID;
		$image = esc_attr( get_post_meta( $item->ID, '_menu_item_background', true ) );
		
		?>
			<p class="field-custom description description-wide">
				<label for="bg-image-<?php echo esc_attr( $item->ID ) ?>">
					<?php _e( 'Background Image:', 'CURLYTHEME' ) ?>
				</label>
				<a href="#" class="btn-upload-image" style="display: <?php echo ( ! $image ? 'block' : 'none' ) ?>;"><?php _e( 'Choose Image', 'CURLYTHEME' ) ?></a>
				<?php printf( '<input type="hidden" value="%1$s" name="_menu_item_background[%2$d]" class="widefat code edit-menu-item-custom-field" id="bg-image-%2$d">', $image, $id ) ?>
				<?php echo ( $image ) ? '<img src="'.$image.'" alt="" class="image-preview">' : null;  ?>
				<a href="#" class="image-remove" style="display: <?php echo ( $image ? 'block' : 'none' ) ?>;"><?php _e( 'Remove Image', 'CURLYTHEME' ); ?></a>
			</p>
		<?php
	}


	/**
	 * Add our field to the screen options toggle
	 *
	 * To make this work, the field wrapper must have the class 'field-custom'
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns['custom'] = __( 'Background Image', 'CURLYTHEME' );

		return $columns;
	}
}
Curly_Menu_Item_Custom_Fields_Create::init();
