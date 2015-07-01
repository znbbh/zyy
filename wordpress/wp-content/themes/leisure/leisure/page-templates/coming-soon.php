<?php 

	// Template Name: Coming Soon Page 
	
	if( !wp_script_is('curly-vertical-align') ) { 
		wp_enqueue_script('curly-vertical-align');
	}
	
	function curly_coming_soon_position() {
		global $post;
		$curly_video_cover = get_post_meta( $post->ID, THEMEPREFIX.'_video_cover', true );
		$curly_video_cover = ( $curly_video_cover ) ? "poster: '$curly_video_cover'," : null;
		$curly_video_mp4 = get_post_meta( $post->ID, THEMEPREFIX.'_video_mp4', true );
		$curly_video_mp4 = ( $curly_video_cover ) ? "mp4: '$curly_video_mp4'," : null;
		$curly_video_ogg = get_post_meta( $post->ID, THEMEPREFIX.'_video_ogg', true );
		$curly_video_ogg = ( $curly_video_cover ) ? "ogg: '$curly_video_ogg'," : null;
		$curly_video_webm = get_post_meta( $post->ID, THEMEPREFIX.'_video_webm', true );
		$curly_video_webm = ( $curly_video_cover ) ? "webm: '$curly_video_webm'," : null;
		
		echo "
		<script type='text/javascript'>
			(function ($) {
			    'use strict';
			    
			    $('.page-template-page-templatescoming-soon-php').wallpaper({
			    	source: {
			    		$curly_video_cover
			    		$curly_video_mp4
			    		$curly_video_ogg
			    		$curly_video_webm
			    	}
			    });
			    
			})(jQuery);
			
		</script>";
	}
	
	add_action( 'wp_footer', 'curly_coming_soon_position', 100 );
	
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php wp_title();?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="content">
	<div id="coming-soon" <?php post_class(); ?>>
		<div class="container content-padding">
			<div class="row animated">
				<div class="col-sm-6 col-sm-offset-3">
					<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content() ?>		
					<?php endwhile; ?>	
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #coming-soon -->
</body>

<?php wp_footer(); ?>
