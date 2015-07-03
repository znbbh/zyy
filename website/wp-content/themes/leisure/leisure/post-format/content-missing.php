<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated'); ?>>
	<header>
		<h2 class="post-title"><?php _e( 'Nothing Found', 'CURLYTHEME' ); ?></h2>
	</header>
	
	<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'CURLYTHEME' ); ?></p>
	<?php get_search_form(); ?>
</article>