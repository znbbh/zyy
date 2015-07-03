<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8">
		<div id="bbpress-forums">
			<?php bbp_breadcrumb(); ?>
			<?php do_action( 'bbp_template_before_single_forum' ); ?>
		
			<?php if ( post_password_required() ) : ?>
		
				<?php bbp_get_template_part( 'form', 'protected' ); ?>
		
			<?php else : ?>
		
				
		
				<?php if ( bbp_has_forums() ) : ?>
		
					<?php bbp_get_template_part( 'loop', 'forums' ); ?>
		
				<?php endif; ?>
		
				<?php if ( !bbp_is_forum_category() && bbp_has_topics() ) : ?>
		
					<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
		
					<?php bbp_get_template_part( 'loop',       'topics'    ); ?>
		
					<?php bbp_get_template_part( 'pagination', 'topics'    ); ?>
		
					<?php bbp_get_template_part( 'form',       'topic'     ); ?>
		
				<?php elseif ( !bbp_is_forum_category() ) : ?>
		
					<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>
		
					<?php bbp_get_template_part( 'form',       'topic'     ); ?>
		
				<?php endif; ?>
		
			<?php endif; ?>
		
			<?php do_action( 'bbp_template_after_single_forum' ); ?>
		
		</div>
	</div>
	<div class="col-sm-4 col-lg-3 col-lg-offset-1" id="side"><?php get_template_part('template-parts/sidebar', 'forum'); ?></div>
</div>

