<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<?php if ( !bbp_show_lead_topic() ) : ?>
	
	<div class="bbp-subscription-favorites">

	<?php bbp_topic_subscription_link(); ?>

	<?php bbp_user_favorites_link(); ?>
	
	</div>

<?php endif; ?>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">

	<li class="bbp-body">

		<?php if ( bbp_thread_replies() ) : ?>

			<?php bbp_list_replies(); ?>

		<?php else : ?>

			<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

				<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</li><!-- .bbp-body -->

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
