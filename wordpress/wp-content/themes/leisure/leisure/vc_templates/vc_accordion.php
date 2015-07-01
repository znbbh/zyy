<?php
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1'
), $atts));

$el_class = $this->getExtraClass( $el_class );

$_SESSION['curly_accordion'] = ( isset( $_SESSION['curly_accordion'] ) ) ? $_SESSION['curly_accordion'] + 1 : 0;

$output .= '<div class="panel-group '.$el_class.'" id="accordion-'.$_SESSION['curly_accordion'].'">';
$output .= do_shortcode( $content );
$output .= '</div>';
$output .= "<script type='text/javascript'>( function( $ ) { $( document ).ready(function() {
	   			
	   			var active = {$active_tab}-1;
	   			$('.panel', '#accordion-{$_SESSION['curly_accordion']}').each(function (index){
	   				if( index == active ){
	   					$('.panel-collapse', this).addClass('in');
	   					$('.accordion-toggle', this).removeClass('collapsed');
	   				}
	   			});
	   			
			}); } )( jQuery );</script>";

echo $output;