<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated'); ?>>
	<header>
		<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
		<?php get_template_part( 'template-parts/meta' ); ?>
	</header>

	<?php the_content( __('Read More', 'CURLYTHEME') ) ?>

</article>