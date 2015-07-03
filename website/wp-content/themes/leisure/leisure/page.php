<?php $curly_core->header(); ?>
<div id="content">
	<div <?php post_class(); ?>>
		<div class="container content-padding-lg">
			<article class="row animated">
				<div class="col-sm-12">	
				
					<!-- The Content -->
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content() ?>			
					<?php endwhile; ?>
					
					<!-- Sharing -->
					<?php get_template_part( 'template-parts/sharing' ); ?>
					
				</div><!-- .col-sm-12 -->
			</article>
			<div class="row">
				<div class="col-sm-12">
					<!-- Comments -->
					<?php get_template_part( 'template-parts/comments' ); ?>
				</div>
			</div>
		</div><!-- .container -->
	</div>
</div><!-- #content -->
<?php $curly_core->footer(); ?>
