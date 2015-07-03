<article id="post-<?php the_ID(); ?>" <?php post_class('entry single'); ?>>
	<header>
		<h1 class="post-title"><?php the_title() ?></h1>
		<?php get_template_part( 'template-parts/meta', 'date' ); ?>
		<?php get_template_part( 'template-parts/featured', 'image' ); ?>
	</header>
	
	<div class="entry-content">
	
		<!-- Content -->
		<?php the_content() ?>
		
		<!-- Link Pages -->
		<?php wp_link_pages(); ?>	
		
	</div>
	
	<!-- Sharing -->
	<?php get_template_part( 'template-parts/sharing' ); ?>
	
	<!-- Author -->
	<?php get_template_part( 'template-parts/author' ); ?>
	
	<!-- Comments -->
	<?php get_template_part( 'template-parts/comments' ); ?>
	
</article>