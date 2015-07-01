<?php 

	if(class_exists('CurlySidebars')) { 
		CurlySidebars::sidebar('sidebar_forum');
	} else { 
		dynamic_sidebar('sidebar_forum');
	}

?>