<?php 

	if(class_exists('CurlySidebars')) { 
		CurlySidebars::sidebar('sidebar_page');
	} else { 
		dynamic_sidebar('sidebar_page');
	}
	
?>