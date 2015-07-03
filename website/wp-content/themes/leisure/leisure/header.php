<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php wp_title();?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<?php global $curly_core; ?>

<body <?php body_class( $curly_core->body_class() ); ?>>
	<div id="site">
		<header id="header" class="header-content" role="banner">
			<?php $curly_core->slider(); ?>
			<div class="header-row clearfix">
				<?php 
					$curly_tagline_1 = get_bloginfo('description');
					$curly_tagline_2 = get_option( THEMEPREFIX.'_tagline', 'ST. ANDREWS, SCOTLAND' );
					if ( $curly_tagline_1 || $curly_tagline_2 ) :
				?>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 absolute-header text-uppercase">
							<div class="pull-left"><?php echo do_shortcode( $curly_tagline_1 );  ?></div>
							<div class="pull-right"><?php echo do_shortcode( $curly_tagline_2 ); ?></div>
						</div><!-- .absolute-header -->
					</div><!-- .row -->
				</div><!-- .container -->
				<?php endif; ?>
				
				<nav role="navigation" id="main-nav">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<a href="<?php echo home_url(); ?>" id="logo"><?php echo $curly_core->get_logo(); ?></a>
								<input type="checkbox" id="toggle-main-nav" class="toggle-nav-input">
								<?php wp_nav_menu(array( 'theme_location' => 'menuMainMenu', 'container_class' => 'menu-container' )); ?>
							</div><!-- .col-xs-12 -->
						</div><!-- .row -->
					</div><!-- .container -->
					<?php if ( get_theme_mod('search_menu', true) == 'true' ) : ?>
					<form id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>"  class="hidden-xs">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 text-center">
									<input type="text" class="search-field" name="s" placeholder="<?php _e( "Type something to search  ...", "CURLYTHEME" ) ?>">
									<a href="#" class="close-search fa fa-search"></a>	
								</div>
							</div>
						</div>
					</form><!-- #search-form -->
					<?php endif; ?>
				</nav><!-- #main-nav -->
				<nav role="navigation" id="secondary-nav">
					<div class="container">
						<input type="checkbox" class="toggle-nav-input" id="toggle-secondary-nav">
						<?php wp_nav_menu(array('theme_location' => 'menuSecondaryMenu', 'container' => null, 'fallback_cb' => false, 'depth' => 2, 'walker' => new Curly_Extended_Menu )); ?>
					</div>
				</nav><!-- #secondary-nav -->
				<div id="menu-togglers">
					<?php if ( has_nav_menu( 'menuSecondaryMenu' ) ) : $name = $curly_core->menu_name('menuSecondaryMenu'); ?>
					<label class="toggle-nav-label" for="toggle-secondary-nav">
						<i class="fa fa-star"></i> <?php echo esc_html($name->name); ?>
					</label>
					<?php endif; ?>
					<?php $name = $curly_core->menu_name('menuMainMenu');  ?>
					<label class="toggle-nav-label" for="toggle-main-nav">
						<i class="fa fa-bars"></i> <?php echo has_nav_menu( 'menuMainMenu' ) ? esc_html($name->name) : __('Main Menu', 'CURLYTHEMES'); ?>
					</label>
				</div>
			</div><!-- .header-row -->
			<?php get_template_part( 'template-parts/heading' ); ?>
		</header><!-- #header -->
		