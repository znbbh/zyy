<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8">
		<div id="bbpress-forums">
		<?php bbp_breadcrumb(); ?>
		<?php do_action( 'bbp_template_before_single_topic' ); ?>
	
		<?php if ( post_password_required() ) : ?>
	
			<?php bbp_get_template_part( 'form', 'protected' ); ?>
	
		<?php else : ?>
	
			<?php if ( bbp_show_lead_topic() ) : ?>
	
				<?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>
	
			<?php endif; ?>
	
			<?php if ( bbp_has_replies() ) : ?>
	
				<?php bbp_get_template_part( 'pagination', 'replies' ); ?>
	
				<?php bbp_get_template_part( 'loop',       'replies' ); ?>
	
				<?php bbp_get_template_part( 'pagination', 'replies' ); ?>
	
			<?php endif; ?>
	
			<?php bbp_get_template_part( 'form', 'reply' ); ?>
	
		<?php endif; ?>
	
		<?php do_action( 'bbp_template_after_single_topic' ); ?>

		</div>
	</div>
	<div class="col-sm-4 col-lg-3 col-lg-offset-1" id="side"><?php dynamic_sidebar( 'sidebar_forum' ) ?></div>
</div>

