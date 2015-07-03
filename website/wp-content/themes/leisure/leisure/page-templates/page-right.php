<?php // Template Name: Right Sidebar Page ?>
<?php $curly_core->header(); ?>
<div id="content">
	<article <?php post_class(); ?>>
		<div class="container content-padding-lg">
			<div class="row animated">
				
				<div class="col-sm-8">
				
					<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content() ?>		
					<?php endwhile; ?>	
					
					<!-- Sharing -->
					<?php get_template_part( 'template-parts/sharing' ); ?>
					
					<!-- Comments -->
					<?php get_template_part( 'template-parts/comments' ); ?>
					
				</div>
				<div class="col-sm-4 col-lg-3 col-lg-offset-1" id="side">
					<?php get_template_part( 'template-parts/sidebar', 'page' ); ?>
				</div>
				
			</div>
		</div>
	</article>
</div><!-- #content -->
<?php $curly_core->footer(); ?>
