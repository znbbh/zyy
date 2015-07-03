<?php 
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; if(is_active_sidebar('sidebar_shop')) : ?>
		</div><!-- .col-sm-8 -->
		<div class="col-sm-4 col-lg-3 col-lg-offset-1" id="side">
		<?php dynamic_sidebar('sidebar_shop') ?>
		</div><!-- .col-sm-4 -->
	</div><!-- .row -->
</div><!-- .container -->
<?php else : ?>
		</div><!-- .col-sm-12 -->
	</div><!-- .row -->
</div><!-- .container -->
<?php endif; ?>
</div><!-- #content -->