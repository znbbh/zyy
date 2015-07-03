<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 */
?>
<?php get_header(); ?>

<?php thb_page_before(); ?>

<section id="page-content">

	<?php thb_page_start(); ?>

	<?php get_template_part('partials/partial-pageheader' ); ?>

	<?php thb_page_content_start(); ?>

	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<?php
		$page_sidebar = thb_get_page_sidebar( thb_get_page_ID() );
	?>

		<?php if ( get_the_content() != '' || ! empty( $page_sidebar ) || thb_show_comments() ) : ?>

			<div class="thb-section-container <?php echo thb_pagecontent_skin(); ?>">

				<div id="main-content">
					
					<?php if ( get_the_content() != '' ) : ?>
						<div class="thb-text">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>

					<?php if( thb_show_comments() ) : ?>
						<section class="secondary">
							<?php thb_comments( array('title_reply' => '<span>' . __('Leave a reply', 'thb_text_domain') . '</span>' )); ?>
						</section>
					<?php endif; ?>

				</div>
				
				<?php thb_page_sidebar(); ?>

			</div>

		<?php endif; ?>
		
	<?php endwhile; endif; ?>
	
	<?php thb_page_end(); ?>

</section>

<?php thb_page_after(); ?>

<?php get_footer(); ?>