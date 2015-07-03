<?php
$output = $title = $tab_id = '';
extract(shortcode_atts($this->predefined_atts, $atts));

$output .= '<div class="tab-pane fade" id="tab-'.$atts['tab_id'].'" data-hash="tab-'.$atts['tab_id'].'">';
$output .= do_shortcode($content);
$output .= '</div>';

echo $output;