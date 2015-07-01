<?php 

	global $curly_core; 
	
	if(class_exists('CurlyThemes')) { 
		echo $curly_core->get_pagination(); 
	} else { 
		previous_posts_link(); 
		next_posts_link(); 
	} 

?>