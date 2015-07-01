<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head> 
<meta charset="<?php bloginfo( 'charset' ); ?>" />  
<?php if(get_option( RT_THEMESLUG."_close_responsive")):?><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><?php endif;?>
	
<title><?php if (is_home() || is_front_page() ): bloginfo('name'); else: wp_title('');endif; ?></title>
<?php if (get_option( RT_THEMESLUG.'_favicon_url')):?><link rel="icon" type="image/png" href="<?php echo get_option( RT_THEMESLUG.'_favicon_url');?>"><?php endif;?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php echo get_option(RT_THEMESLUG.'_space_for_head');?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action("rt_after_body"); ?>

<!-- background wrapper -->
<div id="container">   


	<!-- mobile actions -->
	<section id="mobile_bar" class="clearfix">
		<div class="mobile_menu_control icon-menu"></div>
		<?php if( ! get_option(RT_THEMESLUG.'_hide_top_bar') ):?><div class="top_bar_control icon-cog"></div><?php endif;?>    
	</section>
	<!-- / end section #mobile_bar -->    

	<?php if( ! get_option(RT_THEMESLUG.'_hide_top_bar') ):?>
	<!-- top bar -->
	<section id="top_bar" class="clearfix">
		<div class="top_bar_container">    


					<ul id="top_navigation" class="top_links">

						<!--  top links -->
						<?php if ( has_nav_menu( 'rt-theme-top-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>
							<?php  
								//call the top menu			 
								$topmenuVars = array(
									'menu_id'         => "", 
									'menu_class'      => "top_links", 
									'container'       => '', 
									'echo'            => true, 
									'depth'		 	  => 1, 
									'theme_location'  => 'rt-theme-top-navigation',
									'items_wrap'      => '%3$s', 
								); 
								
							  	wp_nav_menu($topmenuVars);
						    ?>
					    <?php else:?>
						    <?php    

						    	//call the top menu			 
								$topmenuVars = array(
									'menu'            => 'RT Theme Top Navigation Menu',  
									'menu_id'         => "top_navigation", 
									'menu_class'      => "top_links", 
									'container'       => '', 
									'echo'            => true, 
									'depth'		 	  => 1, 
									'theme_location'  => 'rt-theme-top-navigation',
									'items_wrap'      => '%3$s', 
								); 

							  	wp_nav_menu($topmenuVars);
						    ?>
				  			<!-- / end ul .top_links --> 
			  			<?php endif;?>          


						<?php if(!get_option(RT_THEMESLUG.'_hide_woo_cart') && class_exists( 'Woocommerce' )):?>
							<?php global $woocommerce; ?>
												
							<?php if ( is_user_logged_in() ) { ?>
								<li class="icon-user"><a href="<?php echo get_permalink( rt_wpml_page_id(get_option('woocommerce_myaccount_page_id')) ); ?>" title="<?php _e('My Account','rt_theme'); ?>"><?php _e('My Account','rt_theme'); ?></a></li>
								<li class="icon-logout"><a href="<?php echo wp_logout_url(home_url('/')); ?>" title="<?php _e('Logout','rt_theme'); ?>"><?php _e('Logout','rt_theme'); ?></a></li>
							<?php } else { ?>
								<li class="icon-login"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','rt_theme'); ?>"><?php _e('Login / Register','rt_theme'); ?></a></li>
							<?php } ?>						  			

							<li class="icon-basket"><span><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'rt_theme'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'rt_theme'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a></span>&nbsp;</li>					
						<?php endif;?>
	 

						<?php if( get_option( RT_THEMESLUG."_show_search_top" ) ):?>
							<li><form action="<?php echo rt_wpml_get_home_url(); ?>/" method="get" class="showtextback" id="top_search_form"><span class="icon-search"></span><span><input type="text" class="search_text showtextback" size="1" name="s" id="top_search_field" value="<?php _e('Search','rt_theme');?>" /></span></form></li>
						<?php endif;?>


						<?php if(get_option(RT_THEMESLUG.'_show_flags') && function_exists('icl_get_languages')):?>
						    <?php rt_wpml_languages_list();?>		  
						<?php endif;?>

						<?php 
							//adds additional links to the top links - format <li><a></a></li>
							do_action("add_top_menu_links");
						?>

					</ul>


					<?php 
					if( get_option(RT_THEMESLUG.'_social_media_top') ){
						echo do_shortcode("[rt_social_media_icons]");
					}   
					?>


		</div><!-- / end div .top_bar_container -->    
	</section><!-- / end section #top_bar -->    
	<?php endif;?>    

	<!-- header -->
	<header id="header"> 

		<!-- header contents -->
		<section id="header_contents" class="clearfix">
				 
				<?php 
					#
					# get logo and header widgets
					# @hooked in /rt-framework/functions/theme_functions.php
					#
					do_action( "rt_header_output" );
				?>

		</section><!-- end section #header_contents -->  	


		<!-- navigation -->   
		<div class="nav_shadow <?php echo get_option( RT_THEMESLUG."_sticky_navigation" )  ? "sticky" : ""; ?>"><div class="nav_border"> 
	  
	 		<?php	 			
	 		$add_menu_class = get_option( RT_THEMESLUG."_show_search_menu" ) ? " with_search" : "";//show search 
	 		$add_menu_class .= apply_filters( "show_subtitles", get_option( RT_THEMESLUG."_show_subtitles" ) ? " with_subs" : "" );
	 		$add_menu_class .= get_option( RT_THEMESLUG."_show_sticky_logo" ) ? " with_small_logo" : "";//small logo
	 	

	 		echo '<nav id="navigation_bar" class="navigation '.$add_menu_class.'">'; //open nav holder

				//action before the navigation
				do_action("rt_before_navigation");

	 			//call the main navigation
		 		if ( has_nav_menu( 'rt-theme-main-navigation' ) ){ // check if user created a custom menu and assinged to the rt-theme's location
 
						$menuVars = array(
							'menu_id'         => "navigation", 
							'echo'            => false,
							'container'       => '', 
							'container_class' => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container_id'    => 'navigation_bar', 
							'theme_location'  => 'rt-theme-main-navigation',
							'walker' => new RT_Menu_Class_Walker
						);
						
						$main_menu=wp_nav_menu($menuVars);
						echo ($main_menu);
				}else{
						
						$menuVars = array(
							'menu'            => 'RT Theme Main Navigation Menu',  
							'menu_id'         => "navigation", 
							'echo'            => false,
							'container'       => '',  
							'container_class' => '' ,
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container_id'    => 'navigation_bar',  
							'theme_location'  => 'rt-theme-main-navigation',
							'walker' => new RT_Menu_Class_Walker
						);
						
						$main_menu=wp_nav_menu($menuVars);
						echo ($main_menu); 				
 				}

				//action after the navigation
				do_action("rt_after_navigation");

				//show serch bar on the menu bar
				if( get_option( RT_THEMESLUG."_show_search_menu" ) ):?>

					<!-- search -->
					<div class="search-bar">
						<form action="<?php echo rt_wpml_get_home_url(); ?>" method="get" class="showtextback" id="menu_search">
							<fieldset>							
								<input type="text" class="search_text showtextback" name="s" id="menu_search_field" value="<?php _e('Search','rt_theme');?>" />		
								<div class="icon-search-1"></div>					
							</fieldset>
						</form>
					</div>
					<!-- / search-->
				<?php endif;?> 

			</nav>
		</div></div>
		<!-- / navigation  --> 

		</header><!-- end tag #header --> 


		<!-- content holder --> 
		<div class="content_holder">

		<?php 
			#
			# get info bar (breadcrumb and page title )	  
			# get templates haeder bar outputs
			# @hooked in /rt-framework/functions/theme_functions.php
			#				
			do_action( 'rt_header_bar_output');					
		?>		
			<div class="content_second_background">
				<div class="content_area clearfix"> 
		

				<?php do_action( 'rt_content_before'); ?>									