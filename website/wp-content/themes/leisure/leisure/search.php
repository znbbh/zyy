<?php $curly_core->header(); ?>
<div id="content">
	<div class="container content-padding-lg">
		<div class="row">
			<div class="col-sm-8" id="posts">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				     <?php get_template_part( 'post-format/content' , 'search'); ?>
				     <?php endwhile; ?>
				 <?php else : get_template_part('post-format/content' , 'missing'); endif; ?>
				 
				 <?php get_template_part( 'template-parts/pagination' ); ?>
	
			</div><!-- .col-sm-8 -->
			<aside class="col-sm-3 col-sm-offset-1" id="side">
				<?php get_template_part( 'template-parts/sidebar', 'blog' ); ?>
			</aside><!-- .col-sm-3  -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #content -->
<?php $curly_core->footer(); ?>