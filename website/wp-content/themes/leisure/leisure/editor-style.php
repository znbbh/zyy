<?php header("Content-type: text/css"); $curly_parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); require_once( $curly_parse_uri[0].'wp-load.php' ); global $curly_theme_options; ?>
<?php do_action('editor_fonts'); ?>
<?php 

/** Custom Typography */
$curly_font_body = new CurlyThemesFont(
	$curly_theme_options['fonts_body'], 
	$curly_theme_options['fonts_body_size'], 
	$curly_theme_options['fonts_body_style'], 
	$curly_theme_options['fonts_body_variant']
);
$curly_font_h1 = new CurlyThemesFont(
	$curly_theme_options['fonts_h1'], 
	$curly_theme_options['fonts_h1_size'], 
	$curly_theme_options['fonts_h1_style'], 
	$curly_theme_options['fonts_h1_variant']
);
$curly_font_h2 = new CurlyThemesFont(
	$curly_theme_options['fonts_h2'], 
	$curly_theme_options['fonts_h2_size'], 
	$curly_theme_options['fonts_h2_style'], 
	$curly_theme_options['fonts_h2_variant']
);
$curly_font_h3 = new CurlyThemesFont(
	$curly_theme_options['fonts_h3'], 
	$curly_theme_options['fonts_h3_size'], 
	$curly_theme_options['fonts_h3_style'],
	$curly_theme_options['fonts_h3_variant']
);
$curly_font_h4 = new CurlyThemesFont(
	$curly_theme_options['fonts_h4'],
	$curly_theme_options['fonts_h4_size'], 
	$curly_theme_options['fonts_h4_style'], 
	$curly_theme_options['fonts_h4_variant']
);
$curly_font_h5 = new CurlyThemesFont(
	$curly_theme_options['fonts_h5'],
	$curly_theme_options['fonts_h5_size'],
	$curly_theme_options['fonts_h5_style'],
	$curly_theme_options['fonts_h5_variant']
);
$curly_font_h6 = new CurlyThemesFont(
	$curly_theme_options['fonts_h6'], 
	$curly_theme_options['fonts_h6_size'], 
	$curly_theme_options['fonts_h6_style'],
	$curly_theme_options['fonts_h6_variant']
);
$curly_font_quote = new CurlyThemesFont(
	$curly_theme_options['fonts_blockquote'], 
	$curly_theme_options['fonts_blockquote_size'],
	$curly_theme_options['fonts_blockquote_style'],
	$curly_theme_options['fonts_blockquote_variant']
);
$curly_color_text				= new CurlyThemesColor( get_theme_mod('text_color', '#667279') );
$curly_color_link 			= new CurlyThemesColor( get_theme_mod('link_color', '#363D40') );
$curly_color_primary 			= new CurlyThemesColor( get_theme_mod('primary_color', '#C0392B' ) );
$curly_color_bg 				= new CurlyThemesColor( get_theme_mod('background_color', '#ffffff') );
$curly_color_h1 				= new CurlyThemesColor( $curly_theme_options['color_h1'], '#363d40' );
$curly_color_h2 				= new CurlyThemesColor( $curly_theme_options['color_h2'], '#363D40' );
$curly_color_h3 				= new CurlyThemesColor( $curly_theme_options['color_h3'], '#363D40' );
$curly_color_h4 				= new CurlyThemesColor( $curly_theme_options['color_h4'], '#363D40' );
$curly_color_h5 				= new CurlyThemesColor( $curly_theme_options['color_h5'], '#C0392B' );
$curly_color_h6 				= new CurlyThemesColor( $curly_theme_options['color_h6'], '#363D40' );
	
?>
html{
	font-size: 62.5%;
	font-weight: 300;
}
body{
	<?php echo $curly_font_body->_family.$curly_font_body->_style.$curly_font_body->_variant.$curly_font_body->_rem; ?>
	background-color: <?php echo $curly_color_bg ?>;
	color: <?php echo $curly_color_text ?>
}
.lead{
	font-size: 125%;
	margin: 2.8rem 0;
}
h1{
	line-height: 1.2;
	<?php echo $curly_font_h1->_family.$curly_font_h1->_style.$curly_font_h1->_variant.$curly_font_h1->_rem; ?>
	color: <?php echo $curly_color_h1 ?>
}
h2{
	line-height: 1.2;
	<?php echo $curly_font_h2->_family.$curly_font_h2->_style.$curly_font_h2->_variant.$curly_font_h2->_rem; ?>
	color: <?php echo $curly_color_h2 ?>
}
h3{
	line-height: 1.2;
	<?php echo $curly_font_h3->_family.$curly_font_h3->_style.$curly_font_h3->_variant.$curly_font_h3->_rem; ?>
	color: <?php echo $curly_color_h3 ?>
}
h4{
	line-height: 1.2;
	<?php echo $curly_font_h4->_family.$curly_font_h4->_style.$curly_font_h4->_variant.$curly_font_h4->_rem; ?>
	color: <?php echo $curly_color_h4 ?>
}
h5{
	line-height: 1.2;
	<?php echo $curly_font_h5->_family.$curly_font_h5->_style.$curly_font_h5->_variant.$curly_font_h5->_rem; ?>
	color: <?php echo $curly_color_h5 ?>
}
h6{
	line-height: 1.2;
	<?php echo $curly_font_h6->_family.$curly_font_h6->_style.$curly_font_h6->_variant.$curly_font_h6->_rem; ?>
	color: <?php echo $curly_color_h6 ?>
}
a{
	color: <?php echo $curly_color_link ?>
}
p, h1, h2, h3, h4, h5, h6, blockquote, ul{
	margin: 2.8rem 0 1.4rem;
}
ul.list-unstyled li{
	margin-bottom: 1.4rem;
}
dl dt{
	margin-top: 1.4rem;
}
dl dt:first-of-type{
	margin-top: 0;
}
h1 small, 
h2 small,
h3 small{
	font-size: 50%;
	font-weight: normal;
}
h4 small{
	font-size: 65%;
}
h5 small,
h6 small{
	font-size: 75%;
}
h1,
h2,
h3,
h4,
h5,
h6{
	position: relative;
}
#content h1[style*='center'],
#content h2[style*='center'],
#content h3[style*='center'],
#content h4[style*='center'],
#content h5[style*='center'],
#content h6[style*='center'],
#content h1.text-center,
#content h2.text-center,
#content h3.text-center,
#content h4.text-center,
#content h5.text-center,
#content h6.text-center{
	margin-bottom: 6.2rem;
}
#content h1[style*='center']::after,
#content h2[style*='center']::after,
#content h3[style*='center']::after,
#content h4[style*='center']::after,
#content h5[style*='center']::after,
#content h6[style*='center']::after,
#content h1.text-center::after,
#content h2.text-center::after,
#content h3.text-center::after,
#content h4.text-center::after,
#content h5.text-center::after,
#content h6.text-center::after{
	content: '';
	display: block;
	position: absolute;
	width: 6rem;
	border-bottom: .3rem solid;
	margin-top: 1.2rem;
	margin-left: -3rem;
	left: 50%;
}
h1 small,
h2 small,
h3 small,
h4 small,
h5 small,
h6 small{
	display: block;
	opacity: 0.8;
	line-height: 1.2;
}
h1 .center-block,
h2 .center-block,
h3 .center-block,
h4 .center-block,
h5 .center-block,
h6 .center-block{
	display: block;
	margin: 0 auto;
	line-height: 1.4;
}
blockquote,
blockquote p{
	margin-top: 0;
	<?php echo $curly_font_h1->_quote.$curly_font_quote->_style.$curly_font_quote->_variant.$curly_font_quote->_rem; ?>
}
blockquote{
	padding-left: 7rem;
	position: relative;
	border-left: none;
}
blockquote::before{
	font-family: 'FontAwesome';
	content: '\F10D';
	position: absolute;
	top: 0;
	left: 0;
	font-size: 42px;
}
blockquote cite{
	opacity: 0.5;
	display: block;
	margin-top: 1rem;
}
blockquote cite::before{
	content: '\2014 \00A0';
}
body#tinymce.wp-editor{
	margin: 10px;
}
.wp-post-image,
img[class*=wp-image]{
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	margin-bottom: 1.4rem;
	-webkit-transition: all 200ms ease-in;
	-moz-transition: all 200ms ease-in;
	-ms-transition: all 200ms ease-in;
	-o-transition: all 200ms ease-in;
	transition: all 200ms ease-in;
	box-sizing: border-box;
	max-width: 100%;
	height: auto;
}
a .wp-post-image:hover,
a img[class*=wp-image]:hover{
	opacity: .8;
	filter:alpha(opacity=80);
}
.wp-caption{
	max-width: 100%;
}
.wp-caption img{
	margin-bottom: 0;
}
.wp-caption-text{
	font-size: 85%;
	padding: 0.7rem 1.4rem;
	margin: 0;
	-webkit-border-bottom-right-radius: 2px;
	-webkit-border-bottom-left-radius: 2px;
	-moz-border-radius-bottomright: 2px;
	-moz-border-radius-bottomleft: 2px;
	border-bottom-right-radius: 2px;
	border-bottom-left-radius: 2px;
}
.aligncenter{
	margin: 0 auto 2.8rem;
	float: none;
}
.alignright{
	float: right;
	margin: 0 0 1.4rem 2.8rem;
}
.alignleft{
	float: left;
	margin: 0 2.8rem 1.4rem 0;
}
.alignnone{
	float: none;
}
address{
	font-style: normal;
}
.btn{
	font-weight: 500;
	height: auto;
	padding: 1rem 2.8rem;
	-webkit-transition: all 200ms ease-in;
	-moz-transition: all 200ms ease-in;
	-ms-transition: all 200ms ease-in;
	-o-transition: all 200ms ease-in;
	transition: all 200ms ease-in;
	border-radius: 2px;
	border-width: 1px;
	border-style: solid;
	outline: none !important;
}
.btn.btn-inline{
	padding: 1rem 0;
	display: inline-block;
	white-space: normal;
	font-weight: 500;
}
.btn.btn-link,
.comment-reply-link,
.comment-edit-link{
	padding-left: 0;
	padding-right: 0;
	text-decoration: none !important;
	font-weight: normal;
	background: none;
	border: none;
	display: inline-block;
}
.btn.btn-link::before,
.comment-reply-link::before{
	content: '\f178';
	font-family: 'FontAwesome';
	font-size: 14px;
	display: inline-block;
	margin-right: 10px;
	line-height: 20px;
}