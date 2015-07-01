<?php 

class CurlyWelcome {
	
	function __construct() {
		
		/** Welcome Page Redirect */
		add_action( 'admin_init', array( $this, 'welcome' ) );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_menu', array( $this, 'welcome_page_menu' ) );
	}
	
	function admin_head() {
		remove_submenu_page( 'index.php', strtolower(wp_get_theme()->get( 'Name' )).'-welcome' );
		remove_submenu_page( 'index.php', strtolower(wp_get_theme()->get( 'Name' )).'-changelog' );
	}
	
	/** Add Welcome Page to Menu */
	function welcome_page_menu() {	
		if ( empty( $_GET['page'] ) ) {
			return;
		}
		
		$name = strtolower( wp_get_theme()->get( 'Name' ) );
		
		if ( $_GET['page'] == $name.'-welcome' ) {
			$page = add_dashboard_page( ucwords($name).__( ' Welcome Page', 'CURLYTHEME' ), ucwords($name).' Theme', 'manage_options', $name.'-welcome', array( $this, 'welcome_page' ) );
			add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
		}
		
		if ( $_GET['page'] == $name.'-changelog' ){
			$page = add_dashboard_page( ucwords($name).__( ' Changelog Page', 'CURLYTHEME' ), ucwords($name).' Theme', 'manage_options', $name.'-changelog', array( $this, 'changelog_page' ) );
			add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
		}
	}
	
	function admin_css() { ?>
		<style media="all" type="text/css">
			.curly-badge{
				width: 180px;
				padding-top: 150px;
				padding-bottom: 10px;
				position: absolute;
				top: 0;
				right: 0;
				text-align: center;
				background: #fff url(<?php echo get_template_directory_uri().'/icon.png'; ?>);
				background-size: 140px 140px;
				background-repeat: no-repeat;
				background-position: center 7px;
				border-radius: 2px;
			}
			.wrap.leisure-wrap{
				margin: 45px 40px 0 20px;
				max-width: 1050px;
				position: relative;
			}
			.wrap.leisure-wrap h1{
				margin: .2em 200px 0 0;
				line-height: 1.2em;
				font-size: 2.8em;
				font-weight: 400;
			}
			.wrap.leisure-wrap h2{
				font-size: 2rem;
				margin: 30px 0;
			}
			.wrap.leisure-wrap .leisure-about{
				margin: 1em 200px 1em 0;
				min-height: 60px;
				opacity: 0.75;
				font-size: 19px;
				line-height: 1.45;
			}
			.wrap.leisure-wrap .return-to-dashboard{
				font-weight: bold;
				margin-top: 20px;
				font-size: 15px;
			}
			.wrap.leisure-wrap .return-to-dashboard a{
				text-decoration: none;
			}
			.wrap.leisure-wrap .nav-tab-wrapper{
				margin-top: 40px;
			}
			.wrap.leisure-wrap .cols-2{
				display: block;
			}
			.wrap.leisure-wrap .cols-2:after,
			.wrap.leisure-wrap .cols-2 .col-2::after,
			.wrap.leisure-wrap .cols-2 .col-1::before{
				content: ' ';
				display: block;
				clear: both;
			}
			.wrap.leisure-wrap .cols-2 .col-1{
				float: left;
				width: 48%;
				margin-right: 2%;
				margin-bottom: 30px;
			}
			.wrap.leisure-wrap .cols-2 .col-2{
				float: right;
				width: 48%;
				margin-left: 2%;
				margin-bottom: 30px;
			}
			.wrap.leisure-wrap .changelog dt{
				font-weight: bold;
				font-size: 16px;
			}
			.wrap.leisure-wrap .changelog dd{
				padding: 3px 0;
			}
			.wrap.leisure-wrap .changelog dd::before{
				content: '- ';
			}
			@media (max-width:767px){
				.curly-badge{
					display: none;
				}
				.wrap.leisure-wrap h1,
				.wrap.leisure-wrap .leisure-about{
					margin-right: 0;
				}
				.wrap.leisure-wrap .cols-2 .col-1,
				.wrap.leisure-wrap .cols-2 .col-2{
					width: 100%;
					float: none;
					margin-right: 0;
					margin-left: 0;
				}
			}
		</style>
	<?php }
	
	/** Welcome Page */
	function welcome_page() {
		$this->page_header(); ?>
		
		<div class="cols-2">
			<div class="col-1">
				<h3><?php _e('Welcome to Leisure WordPress Theme', 'CURLYTHEME'); ?></h3>
				<p><?php _e('Thank you for being our customer and congratulations on your purchase. Leisure is our high quality HTML template, designed to make your website building experience both easy and enjoyable. Still, if you happen to run into any kind of problems, please contact our helpful customer support team.', 'CURLYTHEME') ?></p>
			</div>
			<div class="col-2">
				<h3><?php _e('Customer Support', 'CURLYTHEME'); ?></h3>
				<p><?php _e('Welcome to Leisure HTML template. If you have any questions regarding Leisure, our helpful customer support team will be happy to help you. Before sending a ticket, please consult the Leisure Premium Documentation, a great source of information for our template. Thank you.', 'CURLYTHEME'); ?></p>
			</div>
			<div class="col-1">
				<h3><?php _e('Extensive Documentation', 'CURLYTHEME'); ?></h3>
				<p><?php _e( 'With our Premium Documentation, we tried to cover everything you need to know about the Leisure HTML template. Still, if you don\'t find the answer to your question here, please contact our helpful customer support team. Thank you.', 'CURLYTHEME'); ?></p>
			</div>
			<div class="col-2">
				<h3><?php _e('Required Plugins', 'CURLYTHEME'); ?></h3>
				<p><?php _e('For an optimal experience, the Leisure HTML template requires several standard plugins. You can find the complete list here.', 'CURLYTHEME'); ?></p>
			</div>
		</div>
		<hr>
		
		<?php $this->page_footer();
		
	}
	
	/** Changelog Page */
	function changelog_page() {
		$this->page_header(); ?>
		
		<h2>Full Changelog</h2>
		<dl class="changelog">
			<dt>Initial Release</dt>
		</dl>
		
		<?php $this->page_footer();
	}
	
	/** Page Footer */
	function page_footer() { ?>
			<div class="return-to-dashboard">
				<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'theme-options' ), 'themes.php' ) ) ); ?>"><?php _e( 'Return to Leisure Theme Options', 'CURLYTHEME' ); ?></a> -
				<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => $name.'-changelog' ), 'index.php' ) ) ); ?>"><?php _e( 'View the Full Changelog', 'CURLYTHEME' ); ?></a>
			</div>
		</div><!-- .wrap -->
	<?php }
	
	/** Page Header */
	function page_header() { 
		$name 		= strtolower(wp_get_theme()->get( 'Name' ));
		$version	= strtolower(wp_get_theme()->get( 'Version' )); 
	?>
		<div class="wrap leisure-wrap">
			<h1><?php printf( __( 'Welcome to %s WordPress Theme %s', 'CURLYTHEME' ), ucwords($name), $version ); ?></h1>
			<div class="leisure-about">
				<?php
					printf( __( 'Thank you for choosing %s WordPress Theme! %s is very powerful, stable, and secure theme, bundled with a lot of great functionality that you will love. We hope you enjoy it.', 'CURLYTHEME' ), ucwords($name), ucwords($name) );
				?>
				<p><?php _e('The Leisure WordPress Theme is a high quality HTML template from Curly Themes, the product of an experienced team\'s extensive work. It is the perfect choice for any website dedicated to leisure and recreation business, like golf clubs, soccer and tennis centre, leisure pools and spas, holiday resorts and other similar activities. Designed for websites with large, beautiful images, multi-level menus and generous footers, the Leisure WP Theme is uniquely suited for eye-catching displays.', 'CURLYTHEME') ?></p>
			</div>
			<div class="curly-badge"><?php printf( __( 'Version %s', 'woocommerce' ), $version ); ?></div>
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( $_GET['page'] == $name.'-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => $name.'-welcome' ), 'index.php' ) ) ); ?>">
					<?php _e( 'What\'s New', 'CURLYTHEME' ) ?></a>
				<a class="nav-tab <?php if ( $_GET['page'] == $name.'-changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => $name.'-changelog' ), 'index.php' ) ) ); ?>"><?php _e( 'Changelog', 'CURLYTHEME' ) ?></a>
			</h2>
		
<?php }
	
	/** Sends user to the welcome page on first activation */
	public function welcome() {
		global $pagenow;
		if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == "themes.php" ) {
			wp_redirect( admin_url( 'index.php?page='.strtolower(wp_get_theme()->get( 'Name' )).'-welcome' ) );
		}
	}
}

new CurlyWelcome();

?>