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
	
		$months = array();
		while ($bunyad_loop->have_posts()) {
			
			$bunyad_loop->the_post();
			
			$month = get_the_date('F, Y');
			$months[$month][] = $post;
			
		}

	
	?>
	
	<div class="posts-list list-timeline">
	
	<?php foreach ($months as $month => $posts): ?>
	
		<div class="month">
			<span class="heading"><?php echo esc_html($month); ?></span>
			
			<div class="posts">
		
			<?php foreach ($posts as $post): setup_postdata($post);	?>
			
				<article>
				
					<time datetime="<?php echo get_the_date('Y-m-d\TH:i:sP'); ?>"><?php echo get_the_date('M d'); ?> </time>
					
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>			
				
				</article>
				
			<?php endforeach; wp_reset_postdata(); ?>
			
			</div> <!-- .posts -->
			
		</div>
	
	<?php endforeach; ?>
				
	</div>

	<?php if (!Bunyad::options()->blog_no_pagination): // pagination can be disabled ?>
	
	<div class="main-pagination">
		<?php echo Bunyad::posts()->paginate(array(), $bunyad_loop); ?>
	</div>
	
	<?php endif; ?>
		

	<?php else: ?>

		<article id="post-0" class="post no-results not-found">
			<header class="post-header">
				<h1 class="post-title"><?php _e( 'Nothing Found', 'bunyad' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="post-content">
				<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'bunyad'); ?></p>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->
	
	<?php endif; ?>