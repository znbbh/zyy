<?php global $curly_theme_options; 
	if( ( is_page() && $curly_theme_options['general_sharing_box_pages'] !== "true") || ( is_single() && $curly_theme_options['general_sharing_box'] !== 'true' ) ) : 
	$curly_fb = add_query_arg( array( 'u' => get_permalink(), 't' => get_the_title() ), 'http://www.facebook.com/sharer.php' );
	$curly_tw = add_query_arg( array( 'status' => get_the_title(), ' ' => get_permalink() ), 'http://twitter.com/home' );
	$curly_li = add_query_arg( array( 'mini' => 'true', 'title' => get_the_title(), 'url' => get_permalink() ), 'http://linkedin.com/shareArticle' );
	$curly_gp = add_query_arg( array( 'op' => 'edit', 'title' => get_the_title(), 'bkmk' => get_permalink() ), 'http://google.com/bookmarks/mark' );
?>
<div class="social-box">
	<h5><?php echo $curly_theme_options['general_sharing']; ?></h5>
	<a rel="nofollow" href="<?php echo esc_url_raw($curly_fb); ?>" title="Facebook">
		<i class="fa fa-boxed fa-facebook"></i>
	</a>
	
	<a rel="nofollow" href="<?php echo esc_url_raw($curly_tw); ?>" title="Twitter">
		<i class="fa fa-boxed fa-twitter"></i>
	</a>
	
	<a rel="nofollow" href="<?php echo esc_url_raw($curly_li); ?>" title="Linkedin">
		<i class="fa fa-boxed fa-linkedin"></i>
	</a>
	
	<a rel="nofollow" href="<?php echo esc_url_raw($curly_gp); ?>" title="Google">
		<i class="fa fa-boxed fa-google-plus"></i>
	</a>
	
	<a rel="nofollow" href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&amp;body=<?php echo urlencode(get_permalink()); ?>" title="Email">
		<i class="fa fa-boxed fa-envelope"></i>
	</a>
</div>
<?php endif; ?>
