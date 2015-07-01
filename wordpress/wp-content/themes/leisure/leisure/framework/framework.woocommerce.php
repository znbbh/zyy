<?php 

class CurlyWooCommerce {
	
	function __construct() {
		
		/** Add WooCommerce Theme Support */
		add_theme_support( 'woocommerce' );
		
		/** Remove WooCommerce Styles */
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		
		/** Register WooCommerce Sidebar */
		if ( function_exists('register_sidebar'))
			register_sidebar(array(
			'name'			 => 'Sidebar - Shop',
			'id'			 => 'sidebar_shop',
			'before_widget'	 => '<aside id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' 	 => '</aside>',
			'before_title'	 => '<h4 class="widget-title">',
			'after_title'	 => '</h4>',
		));
		
		/** Remove Breadcrumbs  */
		remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
		
		/** Add WooCommerce Breadcrubms */
		add_filter( 'woocommerce_breadcrumb_defaults', array($this, 'woocommerce_breadcrumbs') );
		
		/** Add Styles */
		add_action( 'wp_enqueue_scripts', array ($this, 'load_scripts' ), 100 );
		
		/** Remove Loop Rating */
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		
		/** Limit Products Listing */
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
		
	}
	
	/** Load Scripts */
	function load_scripts() {
		if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
			wp_enqueue_script('curly-isotope');
			wp_enqueue_script( 'curly-woocommerce-script', get_template_directory_uri() . '/js/min/woocommerce-min.js', array('jquery', 'curly-main'), null, true); 
			
			wp_enqueue_style( 'curly-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', null, null, 'all'); 
			
			/** Checkout Page */
			if ( !is_admin() && is_checkout() ) {
				wp_enqueue_script('curly-sticky-kit');
				wp_enqueue_script('curly-match-height');
				wp_dequeue_style('woocommerce_chosen_styles');
			}
			
			wp_dequeue_style('woocommerce_prettyPhoto_css');
			wp_dequeue_script('prettyPhoto');
			wp_dequeue_script('prettyPhoto-init');
			
			global $theme_options;
			
			$color_text				= new CurlyThemesColor( get_theme_mod('text_color', '#667279') );
			$color_link 			= new CurlyThemesColor( get_theme_mod('link_color', '#363D40') );
			$color_primary 			= new CurlyThemesColor( get_theme_mod('primary_color', '#C0392B' ) );
			$color_bg 				= new CurlyThemesColor( get_theme_mod('background_color', '#ffffff') );
			
			$css = "
				.onsale{
					background-color: $color_primary;
					color: {$color_primary->contrast("#ffffff", "#000000")}
				}
				.products .product .price .amount,
				.products .product .price,
				.added_to_cart.wc-forward::before,
				.star-rating,
				.summary .price,
				#ship-to-different-address input:checked + label > i:before,
				#createaccount:checked + label > i::before,
				#review_form .comment-form-rating .stars a.active {
					color: $color_primary;
				}
				.woocommerce-pagination .page-numbers li a,
				.woocommerce-pagination .page-numbers li span,
				.woocommerce-pagination .page-numbers li:last-of-type a,
				.woocommerce-pagination .page-numbers li:last-of-type span{
					border-color: {$color_text->opacity(0.25)};
					color: $color_primary;
				}
				.woocommerce-pagination .page-numbers li:hover a,
				.woocommerce-pagination .page-numbers li:hover span{
					background-color: {$color_text->opacity(0.1)};
					color: $color_text
				}
				.woocommerce-pagination .page-numbers span.current{
					background-color: $color_primary !important;
					color: {$color_primary->contrast("#ffffff", "#000000")} !important;
					border-color: $color_primary !important;
				}
				.commentlist .comment-meta,
				.summary .title{
					border-bottom: 1px solid {$color_text->opacity(0.1)};
				}
				.quantity .minus,
				.quantity .plus{
					background-color: {$color_text->opacity(0.25)};
					color: $color_link
				}
				.quantity .minus:hover,
				.quantity .plus:hover{
					background-color: {$color_text->opacity(0.45)};
				}
				#product-gallery .owl-prev::before,
				#product-gallery .owl-next::after,
				.shop_table>tbody>tr:hover>td,
				.shop_table>tfoot>tr>td,
				.shop_table>tfoot>tr>th,
				.shop_table .actions,
				#payment-details{
					background-color: {$color_text->opacity(0.1)};
					color: $color_link;
				}
				.widget_shopping_cart_content .product_list_widget{
					border-color: $color_primary
				}
				.product_list_widget li,
				.widget_layered_nav ul li,
				.shop_table> tbody > tr > td,
				.woocommerce-checkout .order_details,
				.woocommerce-checkout .order_details li{
					border-color: {$color_text->opacity(0.1)};
				}
				.widget_shopping_cart_content .button,
				.woocommerce-checkout .login input[type=submit]{
					background-color: $color_primary;
					color: {$color_primary->contrast("#ffffff", "#000000")};
					border-color: $color_primary;
				}
				.widget_shopping_cart_content .button:hover,
				.woocommerce-checkout .login input[type=submit]:hover{
					background-color: {$color_primary->darken(20)};
					border-color: {$color_primary->darken(20)};
				}
				.widget_price_filter .ui-slider-horizontal{
					background-color: {$color_text->opacity(0.25)};
				}
				.widget_price_filter .ui-slider-horizontal .ui-slider-range{
					background-color: $color_primary;
				}
				.widget_price_filter .ui-slider-horizontal .ui-slider-handle{
					border-color: $color_primary;
					background-color: $color_bg;
				}
				.widget_price_filter .button{
					color: $color_link;
				}
				.shop_table>thead>tr>th{
					border-color: $color_primary;
				}
				.checkout .chosen-single,
				.checkout .chosen-drop,
				#review_form .comment-form-rating .stars a{
					border-color: {$color_text->opacity(0.25)};
				}
				.checkout .chosen-drop{
					background-color: $color_bg;
				}
				.checkout .highlighted,
				.demo_store{
					background-color: $color_primary;
					color: {$color_primary->contrast("#ffffff", "#000000")};
				}
			";
			
			wp_add_inline_style( 'curly-woocommerce', CurlyThemes::minify_css( htmlspecialchars_decode( $css ) ) );
		}
	}
	
}

/** Check if WooCommerce is active before initialization */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	new CurlyWooCommerce();
}

?>