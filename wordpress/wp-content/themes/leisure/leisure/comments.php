<?php if ( post_password_required() ) return; ?>
<div id="comments" class="comments-area comments content-padding">
	<?php if ( have_comments() ) : ?>
    <h3 class="comments-title">
        <?php
            printf( _n( 'One comment for &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'CURLYTHEME' ),
                    number_format_i18n( get_comments_number() ), 
                    '<strong>' . get_the_title() . '</strong>' );
        ?>
    </h3>
    <ul class="comment-list">
        <?php wp_list_comments( array( 'callback' => 'comments', 'style' => 'ul' ) ); ?>
    </ul>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="navigation" role="navigation">
        <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'CURLYTHEME' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'CURLYTHEME' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'CURLYTHEME' ) ); ?></div>
    </nav>
    <?php endif; 
	
    if ( ! comments_open() && get_comments_number() ) : ?>
    <p class="nocomments"><?php _e( 'Comments are closed.' , 'CURLYTHEME' ); ?></p>
    
    <?php endif; endif; 
	
	$curly_req = get_option( 'require_name_email' );
	
	$curly_comments_args = array(
        /*:: Title*/
        'title_reply' => __('Leave Comment','CURLYTHEME'),
        /*:: After Notes*/
        'comment_notes_after'  => '',
        /*:: Before Notes*/
        'comment_notes_before' => '',
        /*:: Submit*/
        'label_submit' => __( 'Submit Comment' , 'CURLYTHEME'),
        /*:: Logged In*/
        'logged_in_as' => '<p>'. sprintf(__('You are logged in as %1$s. %2$sLog out &raquo;%3$s', 'CURLYTHEME'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log Out', 'CURLYTHEME').'">', '</a>') . '</p>',
        /*:: Comment Field*/
        'comment_field' => '<div class="form-group"><div class="comment-form-content col-lg-12"><label for="comment" class="input-textarea sr-only">' . __('<b>Comment</b> ( * )','CURLYTHEME'). '</label>
		<textarea class="required form-control" name="comment" id="comment" rows="4" placeholder="'.__( 'Comment', 'CURLYTHEME' ).'"></textarea></div></div>',
		
		'fields' => apply_filters( 'comment_form_default_fields', array(
		
		    'author' =>
		      '<div class="form-group">' .
		      '<div class="comment-form-author col-lg-6" '.( $curly_req ? "data-required" : null ).'>'.
		      '<label for="author" class="sr-only">'.__( 'Name', 'CURLYTHEME' ).'</label> ' .
		      '<input class="form-control" id="author" name="author" type="text" placeholder="'.__( 'Name', 'CURLYTHEME' ).'" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30" /></div>',
		
		    'email' =>
		      '<div class="comment-form-email col-lg-6" '.( $curly_req ? "data-required" : null ).'><label for="email" class="sr-only">'.__( 'Email', 'CURLYTHEME' ).'</label> ' .
		      '<input class="form-control" id="email" name="email" type="text" placeholder="'.__( 'Email', 'CURLYTHEME' ).'" value="'. esc_attr(  $commenter['comment_author_email'] ) .
		      '" size="30" /></div></div>',
		
		    'url' =>
		      '<div class="form-group"><div class="comment-form-url col-lg-12"><label for="url" class="sr-only"><strong>' .
		      __( 'Website', 'CURLYTHEME' ) . '</strong></label>' .
		      '<input class="form-control" id="url" name="url" type="text" placeholder="'.__( 'Website', 'CURLYTHEME' ).'"  value="' . esc_attr( $commenter['comment_author_url'] ) .
		      '" size="30" /></div></div>'
		    )
		  ),
		);
		
	comment_form( $curly_comments_args );
	
	?>	
</div>
