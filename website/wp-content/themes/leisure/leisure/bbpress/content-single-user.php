<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8">
		<div id="bbpress-forums">
		
			<?php do_action( 'bbp_template_notices' ); ?>
		
			<div id="bbp-user-wrapper">
				<?php bbp_get_template_part( 'user', 'details' ); ?>
		
				<div>
					<?php if ( bbp_is_favorites()                 ) bbp_get_template_part( 'user', 'favorites'       ); ?>
					<?php if ( bbp_is_subscriptions()             ) bbp_get_template_part( 'user', 'subscriptions'   ); ?>
					<?php if ( bbp_is_single_user_topics()        ) bbp_get_template_part( 'user', 'topics-created'  ); ?>
					<?php if ( bbp_is_single_user_replies()       ) bbp_get_template_part( 'user', 'replies-created' ); ?>
					<?php if ( bbp_is_single_user_edit()          ) bbp_get_template_part( 'form', 'user-edit'       ); ?>
					<?php if ( bbp_is_single_user_profile()       ) bbp_get_template_part( 'user', 'profile'         ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-lg-3 col-lg-offset-1" id="side"><?php dynamic_sidebar( 'sidebar_forum' ) ?></div>
</div>
