<?php

/**
 * bbPress User Profile Edit Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form id="bbp-your-profile" action="<?php bbp_user_profile_edit_url( bbp_get_displayed_user_id() ); ?>" method="post" enctype="multipart/form-data">

	<h2><?php _e( 'Edit Profile', 'bbpress' ) ?></h2>

	<?php do_action( 'bbp_user_edit_before' ); ?>

		<?php do_action( 'bbp_user_edit_before_name' ); ?>

		<p>
			<label for="first_name"><?php _e( 'First Name', 'bbpress' ) ?></label>
			<input type="text" name="first_name" id="first_name" value="<?php bbp_displayed_user_field( 'first_name', 'edit' ); ?>" class="form-control regular-text" tabindex="<?php bbp_tab_index(); ?>" />
		</p>

		<p>
			<label for="last_name"><?php _e( 'Last Name', 'bbpress' ) ?></label>
			<input type="text" name="last_name" id="last_name" value="<?php bbp_displayed_user_field( 'last_name', 'edit' ); ?>" class="form-control regular-text" tabindex="<?php bbp_tab_index(); ?>" />
		</p>

		<p>
			<label for="nickname"><?php _e( 'Nickname', 'bbpress' ); ?></label>
			<input type="text" name="nickname" id="nickname" value="<?php bbp_displayed_user_field( 'nickname', 'edit' ); ?>" class="form-control regular-text" tabindex="<?php bbp_tab_index(); ?>" />
		</p>

		<p>
			<label for="display_name"><?php _e( 'Display Name', 'bbpress' ) ?></label>

			<?php bbp_edit_user_display_name(); ?>

		</p>

		<?php do_action( 'bbp_user_edit_after_name' ); ?>


	<h3><?php _e( 'Contact Info', 'bbpress' ) ?></h3>

		<?php do_action( 'bbp_user_edit_before_contact' ); ?>

		<p>
			<label for="url"><?php _e( 'Website', 'bbpress' ) ?></label>
			<input type="text" name="url" id="url" value="<?php bbp_displayed_user_field( 'user_url', 'edit' ); ?>" class="form-control regular-text code" tabindex="<?php bbp_tab_index(); ?>" />
		</p>

		<?php foreach ( bbp_edit_user_contact_methods() as $name => $desc ) : ?>

			<p>
				<label for="<?php echo esc_attr( $name ); ?>"><?php echo apply_filters( 'user_' . $name . '_label', $desc ); ?></label>
				<input type="text" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php bbp_displayed_user_field( $name, 'edit' ); ?>" class="form-control regular-text" tabindex="<?php bbp_tab_index(); ?>" />
			</p>

		<?php endforeach; ?>

		<?php do_action( 'bbp_user_edit_after_contact' ); ?>


	<h3><?php bbp_is_user_home_edit() ? _e( 'About Yourself', 'bbpress' ) : _e( 'About the user', 'bbpress' ); ?></h3>

		<?php do_action( 'bbp_user_edit_before_about' ); ?>

		<p>
			<label for="description"><?php _e( 'Biographical Info', 'bbpress' ); ?></label>
			<textarea name="description" id="description" rows="5" cols="30" tabindex="<?php bbp_tab_index(); ?>" class="form-control"><?php bbp_displayed_user_field( 'description', 'edit' ); ?></textarea>
		</p>

		<?php do_action( 'bbp_user_edit_after_about' ); ?>


	<h3><?php _e( 'Account', 'bbpress' ) ?></h3>

	<?php do_action( 'bbp_user_edit_before_account' ); ?>

	<p>
		<label for="user_login"><?php _e( 'Username', 'bbpress' ); ?></label>
		<input type="text" name="user_login" id="user_login" value="<?php bbp_displayed_user_field( 'user_login', 'edit' ); ?>" disabled="disabled" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />
	</p>

	<p>
		<label for="email"><?php _e( 'Email', 'bbpress' ); ?></label>

		<input type="text" name="email" id="email" value="<?php bbp_displayed_user_field( 'user_email', 'edit' ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" />

		<?php

		// Handle address change requests
		$new_email = get_option( bbp_get_displayed_user_id() . '_new_email' );
		if ( !empty( $new_email ) && $new_email !== bbp_get_displayed_user_field( 'user_email', 'edit' ) ) : ?>

			<span class="updated inline">

				<?php printf( __( 'There is a pending email address change to <code>%1$s</code>. <a href="%2$s">Cancel</a>', 'bbpress' ), $new_email['newemail'], esc_url( self_admin_url( 'user.php?dismiss=' . bbp_get_current_user_id()  . '_new_email' ) ) ); ?>

			</span>

		<?php endif; ?>

	</p>

	<div id="password">
		<p>
		<label for="pass1"><?php _e( 'New Password', 'bbpress' ); ?></label>
		<input type="password" class="form-control" name="pass1" id="pass1" size="16" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" />
		<span class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'bbpress' ); ?></span></p>
		
		<p>
		<input type="password" class="form-control" name="pass2" id="pass2" size="16" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" />
		<span class="description"><?php _e( 'Type your new password again.', 'bbpress' ); ?></span><br />

		<div id="pass-strength-result"></div>
		<p class="alert alert-warning"><?php _e( 'Your password should be at least ten characters long. Use upper and lower case letters, numbers, and symbols to make it even stronger.', 'bbpress' ); ?></p>
		</p>
	</div>

	<?php do_action( 'bbp_user_edit_after_account' ); ?>

	<?php if ( current_user_can( 'edit_users' ) && ! bbp_is_user_home_edit() ) : ?>

		<h2 class="entry-title"><?php _e( 'User Role', 'bbpress' ) ?></h2>

		<fieldset class="bbp-form">
			<legend><?php _e( 'User Role', 'bbpress' ); ?></legend>

			<?php do_action( 'bbp_user_edit_before_role' ); ?>

			<?php if ( is_multisite() && is_super_admin() && current_user_can( 'manage_network_options' ) ) : ?>

				<div>
					<label for="super_admin"><?php _e( 'Network Role', 'bbpress' ); ?></label>
					<label>
						<input class="checkbox" type="checkbox" id="super_admin" name="super_admin"<?php checked( is_super_admin( bbp_get_displayed_user_id() ) ); ?> tabindex="<?php bbp_tab_index(); ?>" />
						<?php _e( 'Grant this user super admin privileges for the Network.', 'bbpress' ); ?>
					</label>
				</div>

			<?php endif; ?>

			<?php bbp_get_template_part( 'form', 'user-roles' ); ?>

			<?php do_action( 'bbp_user_edit_after_role' ); ?>

		</fieldset>

	<?php endif; ?>

	<?php do_action( 'bbp_user_edit_after' ); ?>

	<fieldset class="submit">
		<legend><?php _e( 'Save Changes', 'bbpress' ); ?></legend>
		<div>

			<?php bbp_edit_user_form_fields(); ?>

			<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_user_edit_submit" name="bbp_user_edit_submit" class="button submit user-submit"><?php bbp_is_user_home_edit() ? _e( 'Update Profile', 'bbpress' ) : _e( 'Update User', 'bbpress' ); ?></button>
		</div>
	</fieldset>

</form>