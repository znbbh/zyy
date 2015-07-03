<?php 

/*	Definitions
	================================================= */
	define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
	define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
	define('ICL_DONT_LOAD_LANGUAGES_JS', true);

/*	Language Switcher
	================================================= */
	function curly_language_selector_flags(){
	
		if( function_exists('icl_get_languages') ){
		
			$html = '<div class="curly-lang-switcher"><i class="fa fa-globe"></i>  '.get_option(THEMEPREFIX.'_header_2nd_text_line' , __('Choose Language' , 'CURLYTHEME')).'<ul>';
			
		    $languages = icl_get_languages('skip_missing=0&orderby=code');
		    
		    if( !empty($languages) ){
		        foreach($languages as $l){
		        	$html .= '<li>';
		            if(!$l['active']) $html .= '<a href="'.$l['url'].'">';
		            $html .= '<i class="fa fa-angle-right"></i> '.$l['native_name'];
		            if(!$l['active']) $html .= '</a>';
		            $html .= '</li>';
		        }
		    }
		    $html .= '</ul></div>';
	    }
	    
	   return ( isset($html) ) ? $html : null;
	}

?>