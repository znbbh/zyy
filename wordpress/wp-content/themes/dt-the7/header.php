<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="wf-container wf-clearfix">
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ancient-ie old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ancient-ie old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="old-ie9 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php if ( dt_retina_on() ) { dt_core_detect_retina_script(); } ?>
	<title><?php echo presscore_blog_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style type="text/css" id="static-stylesheet"></style>
	<?php
	echo dt_get_favicon( of_get_option('general-favicon', '') );

	// tracking code
	if ( ! is_preview() ) {
		echo of_get_option('general-tracking_code', '');
	}
	?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'presscore_body_top' ); ?>

<div id="page"<?php if ( 'boxed' == of_get_option('general-layout', 'wide') ) echo ' class="boxed"'; ?>>

<?php /* Top Bar */ ?>
<?php if ( of_get_option('top_bar-show', 1) ) : ?>

	<!-- !Top-bar -->
	<div id="top-bar" role="complementary">
		<div class="wf-wrap">
			<div class="wf-table wf-mobile-collapsed">

				<div class="wf-td">

					<?php if ( of_get_option('top_bar-contact_show', 1) ) : ?>
						<div class="mini-contacts wf-float-left">
							<ul>
								<?php presscore_top_bar_contacts_list(); ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php presscore_nav_menu_list('top', 'left'); ?>

					<?php $top_text = of_get_option('top_bar-text', '');
					if ( $top_text ) :
					?>

						<div class="wf-float-left">
							<?php echo wpautop($top_text); ?>
						</div>

					<?php endif; ?>

				</div>

				<?php if ( defined('ICL_SITEPRESS_VERSION') ): ?>
					<div class="wf-td">

						<?php presscore_language_selector_flags(); ?>

					</div>
				<?php endif; ?>

				<div class="wf-td right-block">
					

					<?php
					$topbar_soc_icons = presscore_get_topbar_social_icons();

					if ( $topbar_soc_icons ) :
					?>

					<?php echo $topbar_soc_icons; ?>

					<?php endif; ?>

					<?php
					// Woocommerce cart here
					if ( class_exists( 'Woocommerce' ) && of_get_option( 'general-woocommerce_show_mini_cart_in_top_bar', true ) ) :

						get_template_part('inc/mod-woocommerce/mod-woocommerce', 'mini-cart');
					endif; ?>
				</div>

			</div><!-- .wf-table -->
		</div><!-- .wf-wrap -->
	</div><!-- #top-bar -->

<?php endif; ?>

<?php
if ( apply_filters( 'presscore_show_header', true ) ) :

$config = Presscore_Config::get_instance();
$logo_align = of_get_option( 'header-layout', 'left' );
$header_classes = apply_filters( 'presscore_header_classes', array( 'logo-' . $logo_align ) );
?><!-- left, center, classical, classic-centered -->
	<!-- !Header -->
	<header id="header" class="<?php echo esc_attr(implode(' ', $header_classes )); ?>" role="banner"><!-- class="overlap"; class="logo-left", class="logo-center", class="logo-classic" -->
		<div class="wf-wrap">
			<div class="wf-table">

<?php if ( 'center' == $logo_align ) : ?>
				<div class="wf-td">
<?php endif; ?>

				<!-- !- Branding -->
				<div id="branding"<?php if ( 'center' != $logo_align ) echo ' class="wf-td"'; ?>>
					<?php
					$logo = presscore_get_logo_image( presscore_get_header_logos_meta() );

					if ( $logo ) :

						if ( 'microsite' == $config->get('template') ) {
							$logo_target_link = get_post_meta( $post->ID, '_dt_microsite_logo_link', true );

							if ( $logo_target_link ) {
								echo sprintf('<a href="%s">%s</a>', esc_url( $logo_target_link ), $logo);
							} else {
								echo $logo;
							}

						} else {
							echo sprintf('<a href="%s">%s</a>', esc_url( home_url( '/' ) ), $logo);

						}

					endif;
					?>

					<div id="site-title" class="assistive-text"><?php bloginfo( 'name' ); ?></div>
					<div id="site-description" class="assistive-text"><?php bloginfo( 'description' ); ?></div>
				</div>

<?php if ( 'classic' == $logo_align ) : ?>
			<?php $info = of_get_option('header-contentarea', false);
			if ( $info ) : ?>
				<div class="wf-td assistive-info" role="complementary"><?php echo $info; ?></div>
			<?php endif; ?>
			</div>
		</div>
		<div class="navigation-holder">
			<div>
<?php elseif ( in_array($logo_align, array('classic-centered', 'center')) ) : ?>
			</div>
		</div>
		<div class="navigation-holder">
			<div>
<?php endif; ?>

				<?php do_action( 'presscore_primary_navigation' ); ?>

<?php if ( 'center' == $logo_align ) : ?>
			</div>
<?php endif; ?>

			</div><!-- .wf-table -->
		</div><!-- .wf-wrap -->
	</header><!-- #masthead -->

<?php endif; // presscore_show_header ?>

	<?php do_action( 'presscore_before_main_container' ); ?>

	<div id="main" <?php presscore_main_container_classes(); ?>><!-- class="sidebar-none", class="sidebar-left", class="sidebar-right" -->

<?php if ( presscore_is_content_visible() ): ?>

		<div class="main-gradient"></div>

		<div class="wf-wrap">
			<div class="wf-container-main">

				<?php do_action( 'presscore_before_content' ); ?>

<?php endif; ?>