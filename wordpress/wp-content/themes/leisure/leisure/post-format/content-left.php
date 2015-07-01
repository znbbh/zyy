<article id="post-<?php the_ID(); ?>" <?php post_class('left-entry entry animated'); ?>>
	<div class="row">
		<div class="col-lg-12">
			<?php get_template_part( 'template-parts/featured', 'image' ); ?>
			<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
			<?php get_template_part( 'template-parts/meta' ); ?>
			<?php the_excerpt() ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>" class="btn btn-link">
				<?php echo _e('Read More', 'CURLYTHEME') ?>
			</a>
			<?php wp_link_pages(); ?>
		</div>
	</div>
</article>