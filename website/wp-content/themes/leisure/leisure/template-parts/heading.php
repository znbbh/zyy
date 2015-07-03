<?php global $curly_core; if( $curly_core->check_heading() != "false" ) : ?>
<div id="page-heading">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php echo $curly_core->get_page_heading('<h1 class="page-title">', '</h1>'); ?>
			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #page-heading -->
<?php endif; ?>
