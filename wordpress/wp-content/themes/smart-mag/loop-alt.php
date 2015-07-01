<?php 

/**
 * Alternate "loop" to display posts in blog style.
 */

?>

	<?php
	
	global $bunyad_loop;
	
	if (!is_object($bunyad_loop)) {
		$bunyad_loop = $wp_query;
	}
	
	if ($bunyad_loop->have_posts()):
	
	?>
		
	<div class="posts-list listing-alt">
	
		<?php while ($bunyad_loop->have_posts()): $bunyad_loop->the_post(); ?>
		
			<article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

			<?php
				// display category label when not in a category archive
				$category = current(get_the_category());
			?>		
				<span class="cat-title cat-<?php echo $category->cat_ID; ?>"><a href="<?php echo esc_url(get_category_link($category)); 
					?>"><?php echo esc_html($category->name); ?></a></span>
			
				<a href="<?php the_permalink() ?>" itemprop="url"><?php the_post_thumbnail('main-block', array('title' => strip_tags(get_the_title()), 'itemprop' => 'image')); ?>
				
				<?php echo apply_filters('bunyad_review_main_snippet', ''); ?>
				
				</a>
				
				<div class="content">
				
					<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?> </time>
				
					<span class="comments"><a href="<?php echo esc_attr(get_comments_link()); ?>"><i class="fa fa-comments-o"></i>
						<?php echo get_comments_number(); ?></a></span>
				
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" itemprop="name url">
						<?php if (get_the_title()) the_title(); else the_ID(); ?></a>
					
					<div class="excerpt"><?php echo Bunyad::posts()->excerpt(null, 20, array('force_more' => true)); ?></div>
					
				</div>
				
			
			
			</article>
		
		<?php endwhile; ?>
				
	</div>

	<?php if (!Bunyad::options()->blog_no_pagination): // pagination can be disabled ?>
	
	<div class="main-pagination">
		<?php echo Bunyad::posts()->paginate(array(), $bunyad_loop); ?>
	</div>
	
	<?php endif; ?>
		

	<?php else: ?>

		<article id="post-0" class="page no-results not-found">
			<div class="post-content">
				<h1><?php _e( 'Nothing Found!', 'bunyad' ); ?></h1>
				<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'bunyad'); ?></p>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->
	
	<?php endif; ?>
