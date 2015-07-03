
	<?php if (post_password_required()): ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'bunyad'); ?></p>
	<?php return; endif;?>

	<div id="comments">

	<?php if (have_comments()) : ?>
		<h3 class="section-head">
			<?php comments_number(); ?>
		</h3>

		<ol class="comments-list">
			<?php
				get_template_part('partial', 'comment');
				wp_list_comments(array('callback' => 'bunyad_smartmag_comment', 'max-depth' => 4));
			?>
		</ol>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): // are there comments to navigate through ?>
		<nav class="comment-nav">
			<div class="nav-previous"><?php previous_comments_link(__( '&larr; Older Comments', 'bunyad')); ?></div>
			<div class="nav-next"><?php next_comments_link(__( 'Newer Comments &rarr;', 'bunyad')); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php elseif (!comments_open() && ! is_page() && post_type_supports(get_post_type(), 'comments')):	?>
		<p class="nocomments"><?php _e('Comments are closed.', 'bunyad'); ?></p>
	<?php endif; ?>
	
	
	<?php 
	
	comment_form(array(
		'title_reply' => '<span class="section-head">' . __('Leave A Reply', 'bunyad') . '</span>',
		'title_reply_to' => '<span class="section-head">' . __('Reply To %s', 'bunyad') . '</span>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
	
		'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'bunyad'), 
									admin_url('profile.php'), $user_identity, wp_logout_url(get_permalink())) . '</p>',
	
		'comment_field' => '
			<p>
				<textarea name="comment" id="comment" cols="45" rows="8" aria-required="true" placeholder="'. esc_attr__('Your Comment', 'bunyad') .'"></textarea>
			</p>',
	
		'id_submit' => 'comment-submit',
		'label_submit' => __('Post Comment', 'bunyad'),
	
		'cancel_reply_link' => __('Cancel Reply', 'bunyad'),
	

		'fields' => array(
			'author' => '
				<p>
					<input name="author" id="author" type="text" value="" size="30" aria-required="true" placeholder="'. esc_attr__('Your Name') .'" />
				</p>',
	
			'email' => '
				<p>
					<input name="email" id="email" type="text" value="" size="30" aria-required="true" placeholder="'. esc_attr__('Your Email') .'" />
				</p>
			',
	
			'url' => '
				<p>
					<input name="url" id="url" type="text" value="" size="30" placeholder="'. esc_attr__('Your Website') .'" />
				</p>
			'
		),
		
	)); ?>

</div><!-- #comments -->
