<article id="post-<?php the_ID(); ?>" <?php post_class('entry animated'); ?>>
	<header>
		<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
		<?php get_template_part( 'template-parts/meta' ); ?>
	</header>

	<?php 
		$curly_args = array(
		   'post_type' => 'attachment',
		   'numberposts' => -1,
		   'post_status' => null,
		   'post_parent' => $post->ID
		  );
		  
		$curly_attachments = get_posts( $curly_args );
		if ( $curly_attachments ) {
			$curly_html = '<div class="gallery-carousel">';
			foreach ( $curly_attachments as $curly_attachment ) {
				$curly_html .= '<div class="item"><a href="'.get_the_permalink().'">'.wp_get_attachment_image( $curly_attachment->ID, 'large', null, array( 'class' => 'wp-post-image' ) ).'</a></div>';
			}
			$curly_html .= '</div>';
		}
		
		echo ( isset( $curly_html ) ) ? $curly_html : null;
	?>

</article>