<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated'); ?>>
	<header>
		<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
		<?php get_template_part( 'template-parts/meta' ); ?>
		<?php get_template_part( 'template-parts/featured', 'image' ); ?>
	</header>

	<?php the_excerpt() ?>
	
	<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>" class="btn btn-link">
		<?php echo _e('Read More', 'CURLYTHEME') ?>
	</a>
	<?php wp_link_pages(); ?>

</article>