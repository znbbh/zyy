<?php
/**
 * Theme Settings - All the relevant options!
 * 
 * @uses Bunyad_Admin_Options::render_options()
 */

return array(
	array(
		'title' => __('General Settings', 'bunyad'),
		'id'    => 'options-tab-global',
		'sections' => array(
			array(
				'fields' => array(
			
					array(
						'name'   => 'layout_style',
						'value' => 'full',
						'label' => __('Layout Style', 'bunyad'),
						'desc'  => __('Select whether you want a boxed or a full-width layout. It affects every page and the whole layout.', 'bunyad'),
						'type'  => 'select',
						'options' => array(
							'full' => 'Full Width',
							'boxed' => 'Boxed'
						),
					),

					array(
						'name' => 'default_sidebar',
						'label'   => __('Default Sidebar', 'bunyad'),
						'value'   => 'right',
						'desc'    => __('Specify the sidebar to use by default. This can be overriden per-page or per-post basis when creating a page or post.', 'bunyad'),
						'type'    => 'radio',
						'options' =>  array('none' => __('No Sidebar', 'bunyad'), 'right' => __('Right Sidebar', 'bunyad'))
					),
					
					array(
						'name' => 'default_cat_template',
						'label'   => __('Default Category Style', 'bunyad'),
						'value'   => 'modern',
						'desc'    => __('The style to use for listing while browsing categories. This can be overriden while creating or editing a category.', 'bunyad'),
						'type'    => 'select',
						'options' =>  array(
							'modern' => __('Modern Style - 2 Column', 'bunyad'),
							'alt' => __('Blog Style', 'bunyad'), 
							'timeline' => __('Timeline Style', 'bunyad'),
						)
					),
					
					array(
						'name'   => 'no_responsive',
						'value' => 0,
						'label' => __('Disable Responsive Layout', 'bunyad'),
						'desc'  => __('Disabling responsive layout means mobile phones and tablets will no longer see a better optimized design. Do not disable this unless really necessary.', 'bunyad'),
						'type'  => 'checkbox'
					),
					
					
					array(
						'name' => 'archive_loop_template',
						'label'   => __('Archive Listing Style', 'bunyad'),
						'value'   => 'modern',
						'desc'    => __('This style is used while browsing author page, searching, default blog format, date archives etc.', 'bunyad'),
						'type'    => 'select',
						'options' =>  array(
							'modern' => __('Modern Style - 2 Column', 'bunyad'),
							'alt' => __('Blog Style', 'bunyad')
						)
					),
					
				),
			), // end section
			
			array(
				'title'  => __('Header', 'bunyad'),
				'fields' => array(
			
					array(
						'name'    => 'text_logo',
						'label'   => __('Logo Text', 'bunyad'),
						'desc'    => __('It will be used if logo images are not provided below.', 'bunyad'),
						'value'   => get_bloginfo('name'),
						'type'    => 'text',
					),
			
					array(
						'name'    => 'image_logo',
						'label'   => __('Logo Image', 'bunyad'),
						'desc'    => __('By default, a text-based logo is created using your site title. But you can upload an image-based logo here.', 'bunyad'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'insert_label' => __('Use As Logo', 'bunyad')
						),
					),
					
					array(
						'name'    => 'image_logo_retina',
						'label'   => __('Logo Image Retina (2x)', 'bunyad'),
						'desc'    => __('The retina version is 2x version of the same logo above. This will be used for higher resolution devices like iPhone. Requires WP Retina 2x plugin.', 'bunyad'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'insert_label' => __('Use As Logo', 'bunyad')
						),
					),
					
					
					array(
						'name'  => 'disable_topbar',
						'value' => 0,
						'label' => __('Disable Top Bar', 'bunyad'),
						'desc'  => __('Setting this to yes will disable the top bar element that appears above the logo area.', 'bunyad'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'disable_topbar_ticker',
						'value' => 0,
						'label' => __('Disable Top News Ticker', 'bunyad'),
						'desc'  => __('Setting this to yes will disable the top bar news ticker', 'bunyad'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'topbar_ticker_text',
						'value' => __('Trending', 'bunyad'),
						'label' => __('Topbar Ticker Text', 'bunyad'),
						'desc'  => __('Enter the text you wish to display before the headlines in the ticker.', 'bunyad'),
						'type'  => 'text'
					),
					
					array(
						'name' => 'sticky_nav',
						'value' => 0,
						'label' => __('Sticky Navigation', 'bunyad'),
						'desc'  => __('This makes navigation float at the top when the user scrolls below the fold - essentially making navigation menu always visible.', 'bunyad'),
						'type'  => 'checkbox',
					),
					
					array(
						'name' => 'disable_breadcrumbs',
						'value' => 0,
						'label' => __('Disable Breadcrumbs', 'bunyad'),
						'desc'  => __('Breadcrumbs are a hierarchy of links displayed below the main navigation. They are displayed on all pages but the home-page.', 'bunyad'),
						'type'  => 'checkbox',
					),
					
					array(
						'name'   => 'header_custom_code',
						'value' => '',
						'label' => __('Header Code', 'bunyad'),
						'desc'  => esc_html(__('This code will be placed before </head> tag in html. Useful if you have an external script that requires it.', 'bunyad')),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 10),
						'strip' => 'none',
					),
					
				),
			), // end section 
			
			
			array(
				'title'  => 'Footer',
				'fields' => array(
					
					array(
						'name'  => 'disable_footer',
						'label' => __('Disable Large Footer', 'bunyad'),
						'desc'  => __('Setting this to yes will disable the large footer that appears above the lowest footer. Used to contain large widgets.', 'bunyad'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'disable_lower_footer',
						'label' => __('Disable Lower Footer', 'bunyad'),
						'desc'  => __('Setting this to yes will disable the smaller footer at bottom.', 'bunyad'),
						'type'  => 'checkbox' 
					),
					
					array(
						'name'   => 'footer_custom_code',
						'value' => '',
						'label' => __('Footer Code', 'bunyad'),
						'desc'  => esc_html(__('This code will be placed before </body> tag in html. Use for Google Analytics or similar external scripts.', 'bunyad')),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 10),
						'strip' => 'none',
					),
				),
			
			), // end section
			
			array(
				'title'  => 'Favicons (optional)',
				'fields' => array(
					array(
						'name'  => 'favicon',
						'label' => __('Favicon', 'bunyad'),
						'desc'  => __('32x32px recommended. IMPORTANT: .ico file only!', 'bunyad'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload Favicon (.ico file)', 'bunyad'), 
							'insert_label' => __('Use As Favicon', 'bunyad')
						),
					),
					
					array(
						'name'  => 'apple_icon',
						'label' => __('Mobile Icon', 'bunyad'),
						'desc'  => __('144x144 recommended in PNG format. This icon will be used when users add your '
								. 'website as a shortcut on mobile devices like iPhone, iPad, Android etc.', 'bunyad'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload Mobile Icon', 'bunyad'), 
							'insert_label' => __('Use As Mobile Icon',  'bunyad')
						),
					),
				)
			), // end section
						
		), // end sections
	),
	
	array(
		'title' => __('Page/Post Settings', 'bunyad'),
		'id'    => 'options-specific-pages',
		'sections' => array(
	
			array(
				'title'  => __('Single Post / Article Page', 'bunyad'),
				'fields' => array(

					array(
						'name'   => 'show_featured',
						'value'  => 1,
						'label'  => __('Show Featured', 'bunyad'),
						'desc'   => __('Disabling featured area will mean the featured image or video will no longer show at top of the article.', 'bunyad'),
						'type'   => 'checkbox'
					),
			
					array(
						'name'   => 'show_tags',
						'value'  => 0,
						'label'  => __('Show Tags', 'bunyad'),
						'desc'   => __('Show tags below posts? We recommend using categories instead of tags.', 'bunyad'),
						'type'   => 'checkbox'
					),
					
					array(
						'name'  => 'social_share',
						'value' => 1,
						'label' => __('Show Social Sharing', 'bunyad'),
						'desc'  => __('Show twitter, facebook, etc. share images beneath posts?', 'bunyad'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'author_box',
						'value' => 1,
						'label' => __('Show Author Box', 'bunyad'),
						'desc'  => __('Setting to No will disable author box displayed below posts on post page.', 'bunyad'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'related_posts',
						'value' => 1,
						'label' => __('Show Related Posts', 'bunyad'),
						'desc'  => __('Setting to No will disable the related posts that appear on the single post page.', 'bunyad'),
						'type'  => 'checkbox'
					),
					
				)
			), // end section
	
			array(
				'title'  => __('Post Listings', 'bunyad'),
				'description' => __('This applies to all kinda of listing such as in archives, search, categories, tags archives, etc.', 'bunyad'),
				'fields' => array(

					array(
						'name' => 'author_loop_template',
						'label'   => __('Author Listing Style', 'bunyad'),
						'value'   => 'loop',
						'desc'    => __('This style is used while browsing author page.', 'bunyad'),
						'type'    => 'select',
						'options' =>  array(
							'loop' => __('Modern Style - 2 Column', 'bunyad'),
							'loop-alt' => __('Blog Style', 'bunyad')
						)
					),
					
					array(
						'name'   => 'read_more',
						'value'  => 1,
						'label'  => __('Show "Read More"', 'bunyad'),
						'desc'   => __('Show read "More" links in category/other listing? Note: Only affects blog listing style.', 'bunyad'),
						'type'   => 'checkbox'
					),
					
				)
			), // end section
			
			array(
				'title'  => __('Review Posts', 'bunyad'),
				'fields' => array(					
					
					array(
						'name'  => 'review_show',
						'value' => 1,
						'label' => __('Show Rating In Listings', 'bunyad'),
						'desc'  => __('On posts with reviews, show the verdict rating points in category/home-page listing?', 'bunyad'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'review_show_widgets',
						'value' => 1,
						'label' => __('Show Rating In Widgets/Sidebar', 'bunyad'),
						'desc'  => __('On posts with reviews, show the verdict rating points in sidebar widgets?', 'bunyad'),
						'type'  => 'checkbox'
					),
			
				)
			) // end section
						
		), // end sections
	),
	
	array(
		'title' => __('Typography', 'bunyad'),
		'id'    => 'options-typography',
		'sections' => array(
	
			array(
				'title'  => __('General', 'bunyad'),
				'desc'   => sprintf(__('Selecting a font will show a basic preview. Go to %s for more details. '
								. 'It is highly recommended that you choose fonts that have similar heights to '
								. 'the default fonts to maintain pleasing aesthetics.', 
								'bunyad'), '<a href="http://www.google.com/webfonts" target="_blank">google fonts directory</a>'),
								
				'fields' => array(
					array(
						'name'   => 'css_main_font',
						'value' => 'Open Sans',
						'label' => __('Main Font Family', 'bunyad'),
						'desc'  => __('This effects almost every element on the theme. Please use a family that has regular, semi-bold and bold style. You may '
									. 'want to set the same for "Blog Post & Pages Body" too.', 'bunyad'),
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'body, .main .sidebar .widgettitle, .tabbed .tabs-list, h3.gallery-title, .comment-respond small, .main-heading, ' 
											. '.gallery-title, .section-head, .main-footer .widgettitle'
						),
						'families' => true,
						'suggested' => array(
							'Open Sans' => 'Open Sans',
							'PT Sans' => 'PT Sans',
							'Lato' => 'Lato',
							'Roboto' => 'Roboto',
							'Merriweather Sans' => 'Merriweather Sans',
							'Ubuntu' => 'Ubuntu'							
						),
					),
					
					array(
						'name'   => 'css_heading_font',
						'value' => 'Roboto Slab',
						'label' => __('Contrast Font Family', 'bunyad'),
						'desc'  => __('This font will apply to mainly post headlines in post pages, slider, homepage, etc.', 'bunyad'),
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h1, h2, h3, h4, h5, h6, .gallery-block .carousel .title a, .list-timeline .posts article, .posts-list .content > a, .block.posts a, 
								#bbpress-forums .bbp-topic-title, #bbpress-forums .bbp-forum-title, .bbpress.single-topic .main-heading'
						),
						'families' => true,
						'fallback_stack' => 'Georgia, serif',
					),
					
					array(
						'name'   => 'css_post_body_font',
						'value' => 'Open Sans:regular',
						'label' => __('Blog Post & Pages Body', 'bunyad'),
						'desc'  => __('Pages and blog posts body can also use a font of your choice. Readability is cruicial. Choose wisely.', 'bunyad'),
						'type'  => 'typography',
						'css'   => array('selectors' => '.post-content'),
						'size'  => array('value' => 13)
					),
					
					array(
						'name'   => 'css_listing_body_font',
						'value' => 'Open Sans:regular',
						'label' => __('Blocks & Listing Excerpts', 'bunyad'),
						'desc'  => __('Affects the agebuilder blocks, and category listings\' excerpt that is displayed below the heading.', 'bunyad'),
						'type'  => 'typography',
						'css'   => array('selectors' => '.highlights .excerpt, .listing-alt .content .excerpt'),
						'size'  => array('value' => 13)
					),
					
					array(
						'name'   => 'css_post_title_font',
						'value' => 'Open Sans:regular',
						'label' => __('Pages Heading', 'bunyad'),
						'desc'  => __('Changing this will affect the font used for pages heading.', 'bunyad'),
						'type'  => 'typography',
						'css'   => array('selectors' => '.page .post-header h1, .page  .post-content h1, .page .post-content h2, 
									.page .post-content h3, .page  .post-content h4, .page  .post-content h5, .page  .post-content h6')
					),
					
				),
			), // end section
			
			array(
				'title' => __('Advanced', 'bunyad'),
				'fields' => array(
					array(
						'name' => 'font_charset',
						'label'   => __('Font Character Set', 'bunyad'),
						'value'   => '',
						'desc'    => __('For some languages, you will need an extended character set. Please note, not all fonts will have the subset. Check the google font to make sure.', 'bunyad'),
						'type'    => 'checkbox',
						'multiple' => array(
							'latin' => __('Latin', 'bunyad'),
							'latin-ext' => __('Latin Extended', 'bunyad'),
							'cyrillic'  => __('Cyrillic', 'bunyad'),
							'cyrillic-ext'  => __('Cyrillic Extended', 'bunyad'),
							'greek'  => __('Greek', 'bunyad'),
							'greek-ext' => __('Greek Extended', 'bunyad'),
							'vietnamese' => __('Vietnamese', 'bunyad'),
						),
					),
					
					array(
						'name'  => 'font_awesome_cdn',
						'value' => 0,
						'label' => __('Use FontAwesome CDN', 'bunyad'),
						'desc'  => __('FontAwesome is loaded locally by default. Using the CDN will save a the font and CSS download if the user has already visited a site that used FontAwesome.', 'bunyad'),
						'type'  => 'checkbox'
					),
				),
			),
						
		), // end sections
	),
	
	array(
		'title' => __('Style & Color', 'bunyad'),
		'id'    => 'options-style-color',
		'sections' => array(
	
			array(
				//'title'  => __('Defaults', 'bunyad'),
				'id' => 'defaults',
				'fields' => array(
					array(
						'name'   => 'predefined_style',
						'value' => '',
						'label' => __('Pre-defined Skin', 'bunyad'),
						'desc'  => __('Select a predefined skin or create your own customized one below.', 'bunyad'),
						'type'  => 'select',
						'options' => array(
							'' => 'Default',
							'light' => 'Light Scheme (Light Nav, Sidebar, Footer)'
						),
					),
					
					array(
						'label' => __('Reset Colors', 'bunyad'),
						'desc'  => __('Clicking this button will reset all the color settings below to the default color settings.', 'bunyad'),
						'type'  => 'html',
						'html' => "<input type='submit' class='button' id='reset-colors' name='reset-colors' data-confirm='" 
								. __('Do you really wish to reset colors to defaults?', 'bunyad') . "' value='". __('Reset Colors', 'bunyad') ."' />",
					),
				)
			), // end section
			
			array(
				'title' => __('General', 'bunyad'),
				'fields' => array(		
					array(
						'name'  => 'css_main_color',
						'value' => '#e54e53',
						'label' => __('Theme Color', 'bunyad'),
						'desc'  => __('It is the contrast color for the theme. It will be used for all links, menu, category overlays, main page and '
									. 'many contrasting elements.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
									'::selection' => 'background: %s',
									':-moz-selection' => 'background: %s',
									
									'.top-bar' => 'border-top-color: %s',

									'.trending-ticker .heading, .breadcrumbs .location, .news-focus .heading, .gallery-title, .related-posts .section-head, 
									.news-focus .heading .subcats a.active, .post-content a, .comments-list .bypostauthor .comment-author a, .error-page 
									.text-404, .main-color, .section-head.prominent, .block.posts .fa-angle-right, a.bbp-author-name' 
										=> 'color: %s',

									'.navigation .menu > li:hover > a, .navigation .menu >.current-menu-item > a, .navigation .menu > .current-menu-parent > a,
									.navigation .menu > .current-menu-ancestor > a, .tabbed .tabs-list .active a,  
									.comment-content .reply, .sc-tabs .active a, .navigation .mega-menu' 
										=> 'border-bottom-color: %s',
										
									'.main-featured .cat, .main-featured .pages .flex-active, .rate-number .progress, .highlights .rate-number .progress, 
									.main-pagination .current, .main-pagination a:hover, .cat-title, .sc-button-default:hover, .drop-caps, .review-box .bar,
									.review-box .overall, .listing-alt .content .read-more a, .button, .post-pagination > span' 
										=> 'background: %s',
									
									'.post-content .wpcf7-not-valid-tip, .main-heading, .review-box .heading, .post-header .post-title:before, 
									.highlights h2:before, div.bbp-template-notice, div.indicator-hint, div.bbp-template-notice.info, .modal-header .modal-title' 
										=> 'border-left-color: %s',

									'@media only screen and (max-width: 799px) { .navigation .mobile .fa' 
										=> 'background: %s',
							),
						)
					),
					
					
					array(
						'name'  => 'css_body_bg_color',
						'value' => '#eeeeee',
						'label' => __('Body Background Color', 'bunyad'),
						'desc'  => __('Use light colors only in non-boxed layout. Setting a body background image below will override it.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'body, body.boxed' => 'background-color: %s;',
							),
						)
					),
					
					array(
						'name'  => 'css_body_bg',
						'value' => '',
						'label' => __('Body Background', 'bunyad'),
						'desc'  => __('Use light patterns in non-boxed layout. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'bunyad'),
						'css' => array(
							'selectors' => array(
								'body' => 'background-image: url(%s);',
								'body.boxed' => 'background-image: url(%s);',
							),
						),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'button_label' => __('Upload Image',  'bunyad'),
							'insert_label' => __('Use as Background',  'bunyad')
						),
						'bg_type' => array('value' => 'cover'),
					),
					
					array(
						'name'  => 'css_post_text_color',
						'value' => '#606569',
						'label' => __('Posts Main Text Color', 'bunyad'),
						'desc'  => __('Text color applies to body text of posts and pages.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.post-content' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_listing_text_color',
						'value' => '#949697',
						'label' => __('Blocks & Listings Excerpt Color', 'bunyad'),
						'desc'  => __('Text color applies to excerpt text displayed on homepage blocks and category listings.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.highlights .excerpt, .listing-alt .content .excerpt' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_headings_text_color',
						'value' => '#000000',
						'label' => __('Main Headings Color', 'bunyad'),
						'desc'  => __('Applies to headings such as main post/page heading and all the in-post headings.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'h1, h2, h3, h4, h5, h6' => 'color: %s',
								'.post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_links_color',
						'value' => '#e54e53',
						'label' => __('Posts Link Color', 'bunyad'),
						'desc'  => __('Changes all the links color within posts and pages.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.post-content a' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_links_hover_color',
						'value' => '#19232d',
						'label' => __('Posts Link Hover Color', 'bunyad'),
						'desc'  => __('This color is applied when you mouse-over a certain link.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.post-content a:hover' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_slider_bg_color',
						'value' => '#f2f2f2',
						'label' => __('Featured Slider Background Color', 'bunyad'),
						'desc'  => __('Setting a body background pattern below will override it.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-featured' => 'background-color: %s; background-image: none;',
							),
						)
					),
					
					array(
						'name'  => 'css_slider_bg_pattern',
						'value' => '',
						'label' => __('Featured Slider Background Pattern', 'bunyad'),
						'desc'  => __('Please use a background pattern that can be repeated. Note that it will override the background color option.', 'bunyad'),
						'css' => array(
							'selectors' => array(
								'.main-featured' => 'background-image: url(%s)',
							),
						),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'button_label' => __('Upload Pattern',  'bunyad'),
							'insert_label' => __('Use as Background Pattern',  'bunyad')
						),
					),
				),
			), // end section
			
			array(
				'title' => __('Header', 'bunyad'),
				'fields' => array(
			
					array(
						'name'  => 'css_header_bg_color',
						'value' => '#ffffff',
						'label' => __('Header Background Color', 'bunyad'),
						'desc'  => __('Setting a header background pattern below will override it.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-head' => 'background-color: %s; background-image: none;',
							),
						)
					),

					array(
						'name'  => 'css_header_bg_pattern',
						'value' => '',
						'label' => __('Header Background Pattern', 'bunyad'),
						'desc'  => __('Please use a background pattern that can be repeated. Note that it will override the background color option.', 'bunyad'),
						'css' => array(
							'selectors' => array(
								'.main-head' => 'background-image: url(%s);',
							),
						),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'button_label' => __('Upload Pattern',  'bunyad'),
							'insert_label' => __('Use as Background Pattern',  'bunyad')
						),
					),
				),
			), // end section
			
			array(
				'title' => __('Navigation Menu', 'bunyad'),
				'fields' => array(
			
					array(
						'name'  => 'css_menu_bg_color',
						'value' => '#19232d',
						'label' => __('Main Menu Background Color', 'bunyad'),
						'desc'  => __('Menu background affects the top-level background only.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation' => 'background-color: %s;',
					
								'@media only screen and (max-width: 799px) { .navigation .menu > li:hover > a, .navigation .menu > .current-menu-item > a, 
								.navigation .menu > .current-menu-parent > a' 
									=> 'background-color: %s;',
								
								'.navigation.sticky' => 'background: rgba(%s, 0.9);',
							),
						)
					),
					
					array(
						'name'  => 'css_menu_drop_bg',
						'value' => '#19232d',
						'label' => __('Menu Dropdowns Background Color', 'bunyad'),
						'desc'  => __('Menu background color is only used when a background pattern is not specified below.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation .mega-menu, .navigation .menu ul' => 'background-color: %s;',
					
								'@media only screen and (max-width: 799px) { .navigation .mega-menu.links > li:hover' 
									=> 'background-color: %s;',
							),
						)
					),
					
					array(
						'name'  => 'css_menu_hover_bg_color',
						'value' => '#1e2935',
						'label' => __('Menu Hover/Current Background Color', 'bunyad'),
						'desc'  => __('This is the background color used when you hover a menu item. Also used for active items.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation .menu > li:hover, .navigation .menu li li:hover, .navigation .menu li li.current-menu-item' 
										=> 'background-color: %s;',
										
								'@media only screen and (max-width: 799px) { .navigation .menu > li:hover > a, .navigation .menu > .current-menu-item > a, 
									.navigation .menu > .current-menu-parent > a, .navigation .mega-menu.links > li:hover,
									.navigation .menu > .current-menu-ancestor > a, .navigation .menu li.active' 
										=> 'background-color: %s;',
							),
						)
					),
					
					array(
						'name'  => 'css_menu_big_border_color',
						'value' => '#2f4154',
						'label' => __('Menu Border Below', 'bunyad'),
						'desc'  => __('Navigation menu has a 3 pixel border below it. Changing this color will only affect that border.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation' => 'border-color: %s;', 
							),
						)
					),
										
					
					array(
						'name'  => 'css_menu_borders_color',
						'value' => '#1f2c38',
						'label' => __('Menu Items Border Color', 'bunyad'),
						'desc'  => __('Menu items on drop down are separated by a border.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation .menu > li li a, .navigation .mega-menu.links > li > a, .navigation .mega-menu.links > li li a,
								.mega-menu .posts-list .content, .navigation .mega-menu .sub-nav li a' 
										=> 'border-color: %s;', 
										
								'@media only screen and (max-width: 799px) { .navigation .menu li a' => 'border-color: %s;',  
							),
						)
					),
					
					
					array(
						'name'  => 'css_mega_menu_borders',
						'value' => '#2f4154',
						'label' => __('Mega Menu Headings Border Color', 'bunyad'),
						'desc'  => __('Mega Menu items have a distinct color on border.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.mega-menu .heading, .navigation .mega-menu.links > li > a' 
										=> 'border-color: %s;', 
							),
						)
					),
					
					array(
						'name'  => 'css_mega_menu_subnav',
						'value' => '#1e2935',
						'label' => __('Mega Menu Left Sub-Categories Background', 'bunyad'),
						'desc'  => __('Mega Menu has a distinct background for its sub-navigation at the left side..', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.mega-menu .sub-nav' 
										=> 'background: %s;', 
							),
						)
					),
					
					array(
						'name'  => 'css_menu_text_color',
						'value' => '#efefef',
						'label' => __('Menu Text Color', 'bunyad'),
						'desc'  => __('Applies to top menu items. Does not apply to drop down.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation a, .mega-menu .heading, .mega-menu .featured h2 a' => 'color: %s;',
							),
						)
					),
					
				),
			), // end section
			
			array(
				'title' => __('Main Sidebar', 'bunyad'),
				'fields' => array(
			
					array(
						'name'  => 'css_sidebar_heading_bg_color',
						'value' => '#19232d',
						'label' => __('Sidebar Heading Background', 'bunyad'),
						'desc'  => __('Sidebar heading background color affects all the headings in the main sidebar.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main .sidebar .widgettitle, .tabbed .tabs-list' => 'background-color: %s;',
							),
						)
					),

					array(
						'name'  => 'css_sidebar_heading_color',
						'value' => '#efefef',
						'label' => __('Sidebar Heading Color', 'bunyad'),
						'desc'  => __('Change color of headings/widget titles in the main sidebar.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main .sidebar .widgettitle, .tabbed .tabs-list' => 'color: %s',
							),
						)
					),					
				),
			), // end section
			
			array(
				'title' => __('Footer', 'bunyad'),
				'fields' => array(
			
					array(
						'name'  => 'css_footer_bg_color',
						'value' => '#19232d',
						'label' => __('Footer Background Color', 'bunyad'),
						'desc'  => __('Footer background color is only used when a background pattern is not specified below.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer' => 'background-color: %s; background-image: none;',
							),
						)
					),

					array(
						'name'  => 'css_footer_bg_pattern',
						'value' => '',
						'label' => __('Footer Background Pattern', 'bunyad'),
						'desc'  => __('Please use a background pattern that can be repeated. Note that it will override the background color option.', 'bunyad'),
						'css' => array(
							'selectors' => array(
								'.main-footer' => 'background-image: url(%s)',
							),
						),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'button_label' => __('Upload Pattern', 'bunyad'),
							'insert_label' => __('Use as Background Pattern', 'bunyad')
						),
					),

					array(
						'name'  => 'css_footer_headings_color',
						'value' => '#c5c7cb',
						'label' => __('Footer Headings Color', 'bunyad'),
						'desc'  => __('Change color of headings in the footer.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer .widgettitle' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_text_color',
						'value' => '#d7dade',
						'label' => __('Footer Text Color', 'bunyad'),
						'desc'  => __('Affects color of text in the footer.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer, .main-footer .widget' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_links_color',
						'value' => '#d7dade',
						'label' => __('Footer Links Color', 'bunyad'),
						'desc'  => __('Affects color of links in the footer.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer .widget a' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_lower_bg',
						'value' => '#121a21',
						'label' => __('Lower Footer Background Color', 'bunyad'),
						'desc'  => __('Second footer uses this color in the background.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.lower-foot' => 'background-color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_lower_text',
						'value' => '#8d8e92',
						'label' => __('Lower Footer Text Color', 'bunyad'),
						'desc'  => __('Second footer uses this color for text.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.lower-foot' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_lower_links',
						'value' => '#b6b7b9',
						'label' => __('Lower Footer Links Color', 'bunyad'),
						'desc'  => __('Affects color of links in the footer.', 'bunyad'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.lower-foot a' => 'color: %s',
							),
						)
					),
					
				),
			), // end section
						
		), // end sections
	),
	
	array(
		'title' => __('Slider & Featured', 'bunyad'),
		'id'    => 'options-slider',
		'sections' => array(
	
			array(
				//'title'  => __('General', 'bunyad'),
								
				'fields' => array(
					
					array(
						'name' => 'slider_animation',
						'label'   => __('Animation Type', 'bunyad'),
						'value'   => 'fade',
						'desc'    => __('Set the type of animation to use for the slider. Does not apply to default slider.', 'bunyad'),
						'type'    => 'select',
						'options' => array('fade' => __('Fade Animation', 'bunyad'), 'slide' => __('Slide Animation', 'slide')),
					),
					
					array(
						'name' => 'slider_slide_delay',
						'label'   => __('Slide Delay/Speed', 'bunyad'),
						'value'   => 5000,
						'desc'    => __('Set the time a slide will be displayed for (in ms) before animating to the next one.', 'bunyad'),
						'type'    => 'text',
					),
					
					array(
						'name' => 'slider_animation_speed',
						'label'   => __('Animation Speed', 'bunyad'),
						'value'   => 600,
						'desc'    => __('Set the speed of animations in miliseconds. A valid number is required.', 'bunyad'),
						'type'    => 'text',
					),
				)
					
			), // end section
			
			array(
				'title'  => __('Right Side Posts Grid', 'bunyad'),
				'desc' => __('The right side posts grid consists of 3 blocks and shows the last 3 of the 8 posts marked ' 
							.'as featured. It is optional setting and does not apply to category sliders. It only applies ' 
							.'to homepage slider.', 'bunyad'),
								
				'fields' => array(
					
					array(
						'name' => 'featured_right_cat',
						'label'   => __('Show from a Category?', 'bunyad'),
						'value'   => '',
						'desc'    => __('<strong>WARNING:</strong> If you limit by category, posts marked as featured will no longer be used for this area. Latest posts from this category will be displayed.', 'bunyad'),
						'type'    => 'html',
						'html'    => wp_dropdown_categories(array(
							'show_option_all' => __('Not Limited', 'bunyad'), 
							'hierarchical' => 1, 'order_by' => 'name', 'class' => 'widefat', 
							'name' => 'featured_right_cat', 'echo' => false,
							'selected' => Bunyad::options()->featured_right_cat
						))
					),
					
					array(
						'name' => 'featured_right_tag',
						'label'   => __('Show Posts by a Tag?', 'bunyad'),
						'value'   => '',
						'desc'    => __('<strong>WARNING:</strong> If you limit by tag, posts marked as featured will no longer be used for this area. Only used it show by category is set to None.', 'bunyad'),
						'type'    => 'text',
					),
				)
					
			), // end section
			
		), // end sections
	),
	
	array(
		'title' => __('Custom CSS', 'bunyad'),
		'id'    => 'options-custom-css',
		'sections' => array(
	
			array(
				//'title'  => __('General', 'bunyad'),
								
				'fields' => array(
					array(
						'name'   => 'css_custom',
						'value' => '',
						'label' => __('Custom CSS', 'bunyad'),
						'desc'  => __('Custom CSS will be added at end of all other customizations and thus can be used to overwrite rules. Less chances of specificity wars.', 'bunyad'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 15)
					),
				)
					
			), // end section
						
		), // end sections
	),
	
	array(
		'title' => __('Backup & Restore', 'bunyad'),
		'id'    => 'options-backup-restore',
		'sections' => array(

			array(
				'fields' => array(
			
					array(
						'label'  => __('Backup / Export', 'bunyad'),
						'desc'   => __('This allows you to create a backup of your options and settings. Please note, it will not backup anything else.', 'bunyad'),
						'type'   => 'html',
						'html'   => "<input type='button' class='button' id='options-backup' value='". __('Download Backup', 'bunyad') ."' />",
					),
					
					array(
						'label'  => __('Restore / Import', 'bunyad'),
						'desc'   => __('<strong>It will override your current settings!</strong> Please make sure to select a valid backup file.', 'bunyad'),
						'type'   => 'html',
						'html'   => "<input type='file' name='import_backup' id='options-restore' />",
					)
					
				),
			
			),
	
		),
	),
	
	/*array(
		'title' => 'Samples',
		'id' => 'samples',
		'sections' => array(
			array(
				'fields' => array(
				
					array(
						'name'  => 'css_heading_font',
						'value' => 'PT Sans:regular',
						'label' => __('Heading Font', 'bunyad'),
						'desc'  => __('Please go to <a href="http://www.google.com/webfonts" target="_blank">google fonts directory</a> to find fonts, then make a selection.', 'bunyad'),
						'type'  => 'typography',
						'css'   => array('selectors' => 'h1, h2, h3, h4, h5, h6'),
						'size'  => array('value' => '14'),
						'color' => array('value' => '#000'),
					),

					array(
						'name'  => 'css_heading_font_2',
						'value' => 'PT Sans:regular',
						'label' => __('Heading Font', 'bunyad'),
						'desc'  => __('Please go to <a href="http://www.google.com/webfonts" target="_blank">google fonts directory</a> to find fonts, then make a selection.', 'bunyad'),
						'type'  => 'typography'
					),
				
					// change to 'controls' to support multiple controls for an element
					array(
						'name'   => 'mega_menus',
						'label'  => __('Mega menus?', 'bunyad'),
						'desc'   => __('Show mega menus with latest posts for categories present in the menu.', 'bunyad'),
						'type'   => 'checkbox'
					),
					

					array(
						'name'    => 'mega_menus_radio',
						'label'   => __('Mega Menus?', 'bunyad'),
						'desc'    => __('Show mega menus with latest posts for categories in the custom menu.', 'bunyad'),
						'type'    => 'radio',
						'options' =>  array(0 => 'Bitch please this is unacceptable', 1 => 'Totally acceptable')
					),
					
					array(
						'name'    => 'nice_pic',
						'label'   => __('Need A Picture Here?', 'bunyad'),
						'desc'    => __('This adds a header.', 'bunyad'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'insert_label' => __('Use As Header', 'bunyad')
						),
					),
					
					array(
						'name'    => 'bg_color',
						'label'   => __('Background Color', 'bunyad'),
						'desc'    => __('Change the background color of header.', 'bunyad'),
						'type'    => 'color',
						'value'   => '#000'
					),
					
					array(
						'name'    => 'image_logo',
						'label'   => __('Upload A Logo Image (optional)', 'bunyad'),
						'desc'    => __('By default, a text-based logo is created using your site title. But you can upload an image-based logo here.', 'bunyad'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'bunyad'), 
							'insert_label' => __('Use As Logo',  'bunyad')
						),
					),
				)
			)
		),
	)*/
);