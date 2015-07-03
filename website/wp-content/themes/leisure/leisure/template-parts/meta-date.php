<div class="entry-meta">
	<i class="fa fa-calendar"></i> <?php the_date(); ?>&nbsp;&nbsp;&nbsp;
	<i class="fa fa-bookmark"></i> <?php echo get_the_category_list( __( ', ', 'CURLYTHEME' ) ); ?>&nbsp;&nbsp;&nbsp;
	<?php echo get_the_tag_list(__('<i class="fa fa-tags"></i> ', 'CURLYTHEME'),', ', ''); ?>
</div>