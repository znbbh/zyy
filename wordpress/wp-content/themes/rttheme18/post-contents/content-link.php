<?php
# 
# rt-theme
# post content for standart post types in listing pages
# 
global $rt_list_style, $more, $rt_global_post_values;


//extract global values 
extract( $rt_global_post_values );

// Create thumbnail image
$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $featured_image_width, "h" => $featured_image_height, "crop" => $crop ) ) : ""; 
?> 
	
<!-- blog box-->
<article class="blog_list loop" id="post-<?php the_ID(); ?>">

	<?php if( $rt_list_style == "style1" ):?>
	<section class="first_section">     
		<div class="date_box"><span class="day"><?php the_time("d") ?></span><span class="year"><?php the_time("M") ?> <?php the_time("Y") ?></span></div>
	</section> 
	<?php endif;?>


	<section class="article_section <?php if( $rt_list_style != "style1" ):?>with_icon<?php endif;?>">
		
		<div class="blog-head-line clearfix">    

			<div class="post-title-holder">

				<!-- blog headline-->
				<?php if( $rt_list_style == "style2" ):?><h2 class="icon-link"><?php else:?><h2><?php endif;?><a href="<?php echo $permalink ?>" rel="bookmark"><?php the_title('',': '); ?></a><?php echo '<a href="'.$post_format_link.'"  target="_blank" title="'. __( 'Go to:', 'rt_theme' ) ."". $post_format_link.'">'.$post_format_link.'</a>'?></h2> 


				<!-- / blog headline--> 
 
				<?php do_action( "post_meta_bar" )?> 

			</div><!-- / end div  .post-title-holder -->
			
		</div><!-- / end div  .blog-head-line -->  


		<?php if( ! empty( $thumbnail_image_output )  ):?>
			<div class="imgeffect align<?php echo $featured_image_position;?>"> 
					
					<a href="<?php echo $post_format_link;?>" target="_blank" class="icon-forward" title="<?php echo __( 'Go to: ', 'rt_theme' ) ."". $post_format_link; ?>"></a>	

					<a href="<?php echo $permalink;?>" class="icon-link" title="<?php echo __( 'Read more: ', 'rt_theme' ) ."". $title; ?>" rel="bookmark" ></a>	

					<?php echo $thumbnail_image_output; ?>
			</div>
		<?php endif;?>


		<?php 
			if( get_option(RT_THEMESLUG."_use_excerpts") ){
				the_excerpt();
			}else{
				the_content( __( 'Continue reading', 'rt_theme' ) );
				wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
			}
		?>

	</section> 

</article> 
<!-- / blog box-->