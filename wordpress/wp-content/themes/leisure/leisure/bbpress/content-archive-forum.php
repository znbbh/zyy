<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8">
		<div id="bbpress-forums">
			<?php bbp_breadcrumb(); ?>
			<?php bbp_forum_subscription_link(); ?>
		
			<?php do_action( 'bbp_template_before_forums_index' ); ?>
		
			<?php if ( bbp_has_forums() ) : ?>
		
				<?php bbp_get_template_part( 'loop',     'forums'    ); ?>
		
			<?php else : ?>
		
				<?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>
		
			<?php endif; ?>
		
			<?php do_action( 'bbp_template_after_forums_index' ); ?>
		
		</div>
	</div>
	<div class="col-sm-4 col-lg-3 col-lg-offset-1" id="side"><?php get_template_part('template-parts/sidebar', 'forum'); ?></div>
</div>
