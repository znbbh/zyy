<?php 

/*	Comments
	================================================= */
	function comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'CURLYTHEME' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'CURLYTHEME') ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header class="comment-meta comment-author vcard">
					<h6>
					<?php
						
						printf( '<cite class="fn">%1$s </cite>',
								get_comment_author_link()
						);
						printf( '<time datetime="%1$s">@ %2$s</time>',
								get_comment_time( 'c' ),
								sprintf( __( '%1$s at %2$s', 'CURLYTHEME' ), get_comment_date(), get_comment_time() )
						);
					?>
					</h6>
				</header><!-- .comment-meta -->
	
				<section class="comment-content comment">
					<?php 
						
						/** Show Avatar */
						echo get_avatar( $comment, 60 ); 
						
						/** Comment */
						comment_text(); 
					 	
					 	/** Reply Link */
						comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'CURLYTHEME' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
						
						/** Edit Link */
						edit_comment_link( __( 'Edit Comment', 'CURLYTHEME' ) ); 
					?>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<span class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'CURLYTHEME' ); ?></span>
					<?php endif; ?>
				</section>
			</article>
		<?php
			break;
		endswitch; 
	}

/*	Threaded Comments
	================================================= */
	function curly_xtreme_enqueue_comments_reply() {
	    if( get_option( 'thread_comments' ) )  {
	        wp_enqueue_script( 'comment-reply' );
	    }
	}
	add_action( 'comment_form_before', 'curly_xtreme_enqueue_comments_reply' );

/*	Hide Comments
	================================================= */
	global $curly_theme_options;
	if ( $curly_theme_options['general_comments_pages'] == "true" ) {
		add_filter( 'comments_open', 'curly_comments_open', 10, 2 );
		
		function curly_comments_open( $open, $post_id ) {
			$post = get_post( $post_id );
			
				if ( 'page' == $post->post_type )
					$open = false;
			
				return $open;
		}	
	}

?>