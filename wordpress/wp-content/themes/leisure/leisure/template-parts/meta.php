<div class="entry-meta">
	<?php 
	
	ob_start();
	comments_number(  __( 'No Comments', 'CURLYTHEME' ), __( '1 Comment', 'CURLYTHEME' ), __( '% Comments', 'CURLYTHEME' ));
	$curly_comments = ob_get_clean();
	
	$curly_output = __( '<em><i class="fa fa-calendar"></i> %1$s &nbsp;&nbsp; </em><em><i class="fa fa-comments-o"></i> %2$s</em>', 'CURLYTHEME' );
	
	echo sprintf( $curly_output, get_the_date(), $curly_comments );
	
	 ?>
</div>