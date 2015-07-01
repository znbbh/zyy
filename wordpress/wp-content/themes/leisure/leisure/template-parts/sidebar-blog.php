<?php 

	if(class_exists('CurlySidebars')) { 
		CurlySidebars::sidebar('sidebar_blog');
	} else { 
		dynamic_sidebar('sidebar_blog');
	}

?>