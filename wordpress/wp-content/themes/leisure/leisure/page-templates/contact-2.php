<?php 

// Template Name: Contact Page 2

$curly_core->header();

$curly_latitude 	= get_post_meta( $post->ID, THEMEPREFIX . '_latitude', true );
$curly_longitude 	= get_post_meta( $post->ID, THEMEPREFIX . '_longitude', true );
$curly_height 	= get_post_meta( $post->ID, THEMEPREFIX . '_map_height', true );
$curly_zoom 	= get_post_meta( $post->ID, THEMEPREFIX . '_map_zoom', true );
$curly_map_type 	= get_post_meta( $post->ID, THEMEPREFIX . '_map_type', true );
$curly_side 	= get_post_meta( $post->ID, THEMEPREFIX . '_contact_side', true );

?>
<div id="content">
	<article <?php post_class(); ?>>
		<section class="container content-padding-lg">
			<div class="row visible-xs">
				<div class="col-xs-12">
					<?php $curly_contact->side( $curly_side ); ?>
				</div>
			</div><!-- .row -->
			<div class="row animated">
				<div class="col-sm-12">
					<?php while ( have_posts() ) : the_post(); ?>
					
					<?php the_content(); ?>
								
					<?php endwhile; ?>
				</div>
			</div><!-- .row -->
		</section><!-- .container -->
		<section id="map-holder" <?php echo ( $curly_height ) ? 'style="min-height: '.$curly_height.'px"' : null ?>>
			<?php if ( $curly_side ) : ?>
			<div id="map-description" class="hidden-xs">
				<div class="container">
					<div class="row animated">
						<div class="col-lg-4 col-lg-offset-8 col-sm-5 col-sm-offset-7">
							<div>
								<?php $curly_contact->side( $curly_side ); ?>
							</div>
						</div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- #map-description -->
			<?php endif; ?>
			<?php $curly_contact->map( $curly_latitude, $curly_longitude, $curly_height, $curly_map_type, $curly_zoom ); ?>
		</section><!-- #map-holder -->
	</article>
</div><!-- #content -->
<?php $curly_core->footer(); ?>