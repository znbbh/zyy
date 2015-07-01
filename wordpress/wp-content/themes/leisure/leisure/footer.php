		<footer id="footer" role="contentinfo">
			<div class="container">
				<?php if ( is_active_sidebar('footer_widget_area') ) : ?>
				<div class="row" id="main-footer">
					<?php dynamic_sidebar( 'footer_widget_area' ) ?>
				</div><!-- end .row -->
				<?php endif; ?>
				<?php $curly_absolute_footer = get_theme_mod( 'footer_copyright', 'Leisure - HTML Template. Designed with special care by <a href="http://'.'demo.curlythemes'.'.com" target="_blank"><abbr title="Premium WordPress Themes & Plugins">Curly Themes</abbr></a>. All Rights Reserved. <span class="pull-right">[icon icon=rss boxed=yes] [icon icon=pinterest boxed=yes] [icon icon=facebook boxed=yes] [icon icon=twitter boxed=yes]</span>' ); if ( $curly_absolute_footer ) : ?>
				<div class="row" id="absolute-footer">
					<div class="col-sm-12">
						<aside class="widget sidebar-widget">
							<p><?php echo do_shortcode( $curly_absolute_footer ); ?></p>
						</aside><!-- .widget -->
					</div><!-- .col-sm-12 -->
				</div><!-- #absolute-footer -->
				<?php endif; ?>
			</div><!-- .container -->
		</footer><!-- #footer -->	
	</div><!-- #site -->

	<?php wp_footer(); ?>
	</body>
</html>