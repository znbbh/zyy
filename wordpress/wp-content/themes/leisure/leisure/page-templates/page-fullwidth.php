<?php // Template Name: FullWidth Page ?>
<?php $curly_core->header(); ?>
<div id="content">
	<div <?php post_class(); ?>>
					
		<!-- The Content -->
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content() ?>			
		<?php endwhile; ?>
				
	</div>
</div><!-- #content -->
<?php $curly_core->footer(); ?>
