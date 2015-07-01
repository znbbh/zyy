<?php
/* 
* rt-theme product taxomony categories
*/
global $rt_sidebar_location, $rt_title;


$term = get_queried_object();
$rt_taxonomy  = $term->taxonomy;
$term_id =  $term->term_id;
$rt_title = $term->name; 
$products_item_width = get_option(RT_THEMESLUG."_product_layout");
$products_list_orderby =  get_option(RT_THEMESLUG.'_product_list_orderby');
$products_list_order =  get_option(RT_THEMESLUG.'_product_list_order');
$products_item_per_page =  get_option(RT_THEMESLUG.'_product_list_pager');

get_header();	
?>
<section class="content_block_background">
	<section id="category-<?php echo $term_id; ?>" class="content_block clearfix">
		<section class="content <?php echo $rt_sidebar_location[0];?>">
		<div class="row">

			<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_product_taxonomies', array( "called_for" => "inside_content" ) ) ); ?>

			<?php if($term->description):?>
			<!-- Category Description -->
				<div class="row margin-b30 clearfix"> 
					<?php  echo apply_filters('the_content',($term->description));?> 
				</div> 
			<?php endif;?>		


			<?php if ( have_posts() ) : 

			$create_shortcode = sprintf( 
				'[product_box id="%s" item_width="%s" pagination="%s" list_orderby="%s" list_order="%s" item_per_page="%s" categories="%s" with_borders="true"]', 
				$term->slug, $products_item_width, "on", $products_list_orderby, $products_list_order, $products_item_per_page, $term_id
			);

			echo do_shortcode( $create_shortcode );

				
			else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
		</section><!-- / end section .content -->  
	<?php get_sidebar(); ?>
	</section><!-- / end section .content_block -->  
</section>
<?php get_footer(); ?>