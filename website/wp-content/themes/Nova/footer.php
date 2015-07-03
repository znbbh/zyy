		<?php if ( !is_home() ) { ?>
			<div id="footer-widgets">
				<div class="container">
					<div id="widgets-wrapper" class="clearfix">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
						<?php endif; ?>
					</div> <!-- end #widgets-wrapper -->
				</div> <!-- end .container -->
			</div> <!-- end #footer-widgets -->
		<?php } ?>

		<div id="footer">
			<div class="container clearfix">
				<p id="copyright"><?php esc_html_e('设计 ','Nova'); ?> <a href="http://www.htmlmall.com" title="LCJ">林传杰</a> | <?php esc_html_e('©2013 - ','Nova'); ?> <a href="http://www.htmlmall.com">华域网络技术有限公司版权所有。</a></p>
			</div> <!-- end .container -->
		</div> <!-- end #footer -->
	</div> <!-- end #center-highlight-->

	<?php get_template_part('includes/scripts'); ?>

	<?php wp_footer(); ?>

</body>
</html>