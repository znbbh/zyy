<?php
$output = $title = $interval = $el_class = '';
extract( shortcode_atts( array(
	'title' => null,
	'interval' => 0,
	'el_class' => null
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$_SESSION['curly_tabs'] = isset( $_SESSION['curly_tabs'] ) ? $_SESSION['curly_tabs'] + 1 : 0;

preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
if ( ! isset( $atts['style'] ) ) {
	$output .= '<div class="bs-example bs-example-tabs '.$el_class.'">';
	$output .= '<ul id="tabs-'.$_SESSION['curly_tabs'].'" class="nav nav-tabs">';
	foreach ( $tab_titles as $tab ) {
		$tab_atts = shortcode_parse_atts($tab[0]);
		if(isset($tab_atts['title'])) {
			$output .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" data-toggle="tab">' . $tab_atts['title'] . '</a></li>';
		}
	}
	$output .= '</ul>';
	$output .= '<div id="tabs-content-'.$_SESSION['curly_tabs'].'" class="tab-content">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	$output .= '</div>';
	$output .= "<script type='text/javascript'>( function( $ ) { $( document ).ready(function() {
	
		   			$('li:first-of-type', '#tabs-{$_SESSION['curly_tabs']}').addClass('active');
		   			$('.tab-pane:first-of-type', '#tabs-content-{$_SESSION['curly_tabs']}').addClass('active in');
		   			
				}); } )( jQuery );</script>";
} else {
	$output .= '<div class="'.$el_class.'">';
	$output .= '<ul class="list-inline list-underline list-nav text-center">';
	foreach ( $tab_titles as $tab ) {
		$tab_atts = shortcode_parse_atts($tab[0]);
		if(isset($tab_atts['title'])) {
			$output .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '"  class="btn btn-inline">' . $tab_atts['title'] . '</a></li>';
		}
	}
	$output .= '</ul>';
	$output .= '<div class="content-carousel text-center">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	$output .= '</div>';
	$output .= "<script type='text/javascript'>( function( $ ) { $( document ).ready(function() {
	
		   			$('.content-carousel .tab-pane').each(function(){
		   				$(this).removeAttr('id').removeAttr('class');
		   			});
		   			$('.list-nav .btn').click(function(){
		   				if( ! $(this).hasClass('active') ){
		   					$(this).parents('.list-nav').find('.active').removeClass('active');
		   					$(this).addClass('active');
		   				}
		   			});
		   			$('.list-nav li:first-of-type .btn').addClass('active');
		   			
				}); } )( jQuery );</script>";
}

echo $output;