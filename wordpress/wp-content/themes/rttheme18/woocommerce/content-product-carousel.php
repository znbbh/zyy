<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $woocommerce_loop, $post_count, $products; 
 

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ){

	$woo_product_layout = get_option(RT_THEMESLUG."_woo_product_layout");
	$woo_product_layout = $woo_product_layout ? $woo_product_layout : 3; //default 3 	

	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $woo_product_layout );
}

$woo_layout_names = array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");
$woo_column_class_name = "box ". $woo_layout_names[$woocommerce_loop['columns']];

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++; 
?>
 
 
<?php echo '<div class="product_item_holder item">';?>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<div class="product_info">
			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>

		</div> 
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		
</div>
