<?php

/**
 * Determine the listing style to use
 */
if (empty($type)) {
	$type = Bunyad::options()->default_cat_template;
}

switch ($type) {
	case 'modern':
		$template = 'loop';
		break;
	
	case 'alt':
		$template = 'loop-alt';
		break;
		
	case 'timeline':
		$template = 'loop-timeline';
		break;
		
	default:
		return;
}

// save current options so that can they can be restored later
$options = Bunyad::options()->get_all();

Bunyad::options()
	->set('blog_no_pagination', ($pagination == 0 ? 1 : 0)); // inverse the original pagination option; different meaning

if ($heading && $heading_type != 'block'):

?>
	<h1 class="main-heading prominent"><?php echo $heading; ?></h1>
<?php
elseif ($heading):
?>
	<h3 class="section-head prominent"><?php echo $heading; ?></h3>
<?php
endif;

/**
 * Setup the loop query
 */
global $bunyad_loop;

$page = (is_front_page() ? get_query_var('page') : get_query_var('paged'));
$vars = array('paged' => $page, 'posts_per_page' => intval($posts), 'order' => ($sort_order == 'asc' ? 'asc' : 'desc'));

// taxonomy
if (!empty($cats)) {
	$vars['cat'] = $cats;
}

if (!empty($tags)) {
	$vars['tag'] = $tags;	
}

// sorting
if ($sort_by == 'modified') {
	$vars['orderby'] = 'modified';
}
else if ($sort_by == 'random') {
	$vars['orderby'] = 'rand';
}

// main loop
$bunyad_loop = new WP_Query($vars);

// get our loop template
get_template_part($template);

// restore all options
Bunyad::options()->set_all($options);
wp_reset_query();