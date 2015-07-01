<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( ! class_exists( 'THB_TextBoxBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder text box block.
	 */
	class THB_TextBoxBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_text_box',
				__( 'Text box', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_text_box' )
			);

			$this->setDescription( __( 'A simple text block, with options concerning alignment, icon shown, and the ability to add a call to action button.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( __( 'Icon', 'thb_text_domain' ), $this->getSlug() . '_icon_container' );

					$thb_field = new THB_SelectField( 'icon_styles' );
					$thb_field->setLabel( __( 'Styles', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_config('backpack/general', 'builder_text_box_icon_styles') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_IconPickerField( 'icon' );
					$thb_field->setLabel( __( 'Icon', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_ColorField( 'icon_color' );
					$thb_field->setLabel( __( 'Color', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'icon_size' );
						$thb_field->setLabel( __( 'Icon size', 'thb_text_domain' ) );
						$thb_field->setOptions(array(
							'icon-small'  => __('Small', 'thb_text_domain'),
							'icon-normal' => __('Normal', 'thb_text_domain'),
							'icon-medium' => __('Medium', 'thb_text_domain'),
							'icon-big'    => __('Big', 'thb_text_domain')
						));
					$thb_modal_container->addField($thb_field);

				$thb_modal_container = $thb_modal->createContainer( __( 'Image', 'thb_text_domain' ), $this->getSlug() . '_icon_container' );
					$thb_field = new THB_UploadField( 'icon_image' );
					$thb_field->setLabel( __( 'Image', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_GraphicRadioField( 'box_layout' );
						$thb_field->setLabel( __( 'Layout', 'thb_text_domain' ) );
						$thb_field->setOptions(array(
							'layout-centered'  => thb_get_module_url('backpack/general') . '/i/layout-centered.png',
							'layout-left'      => thb_get_module_url('backpack/general') . '/i/layout-left.png',
							'layout-left-alt'  => thb_get_module_url('backpack/general') . '/i/layout-left-alt.png',
							'layout-right'     => thb_get_module_url('backpack/general') . '/i/layout-right.png',
							'layout-right-alt' => thb_get_module_url('backpack/general') . '/i/layout-right-alt.png',
							'layout-inline'    => thb_get_module_url('backpack/general') . '/i/layout-inline.png'
						));
					$thb_modal_container->addField($thb_field);

					$thb_field = new THB_SelectField( 'layout_styles' );
					$thb_field->setLabel( __( 'Style', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_config('backpack/general', 'builder_text_box_layout_styles') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'subtitle' );
					$thb_field->setLabel( __( 'Subtitle', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'content' );
					$thb_field->setLabel( __( 'Content', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'subtitle_position' );
						$thb_field->setLabel( __( 'Subtitle position', 'thb_text_domain' ) );
						$thb_field->setHelp( __( 'Position relative to the block\'s title.', 'thb_text_domain' ) );
						$thb_field->setOptions(array(
							'subtitle-bottom' => __('Bottom', 'thb_text_domain'),
							'subtitle-top'    => __('Top', 'thb_text_domain'),
						));
					$thb_modal_container->addField($thb_field);

				$thb_modal_container = $thb_modal->createContainer( __( 'Call to action', 'thb_text_domain' ), $this->getSlug() . '_action_container' );

					$thb_field = new THB_TextField( 'call_to_label_primary' );
					$thb_field->setLabel( __( 'Primary Call to action label', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button label.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'call_to_url_primary' );
					$thb_field->setLabel( __( 'Primary Call to action URL', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button URL. You can use a manual URL http:// or a post or page ID.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'call_to_url_primary_target_blank' );
					$thb_field->setLabel( __( 'Primary action opens in a new tab/window', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'call_to_label_secondary' );
					$thb_field->setLabel( __( 'Secondary Call to action label', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button label.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'call_to_url_secondary' );
					$thb_field->setLabel( __( 'Secondary Call to action URL', 'thb_text_domain' ) );
					$thb_field->setHelp( __('The call to action button URL. You can use a manual URL http:// or a post or page ID.', 'thb_text_domain'));
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'call_to_url_secondary_target_blank' );
					$thb_field->setLabel( __( 'Secondary action opens in a new tab/window', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array(
				$block_data['icon_size'],
				$block_data['box_layout'],
				$block_data['icon_styles'],
				$block_data['layout_styles']
			);

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_TextBoxBlock() );
}

if( ! class_exists( 'THB_PageBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_PageBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_page',
				__( 'Page/post', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_page' )
			);

			$this->setDescription( __( 'Load content (title, excerpt, featured image) from a page or post.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'page_id' );
					$thb_field->setLabel( __( 'ID', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter a the page ID.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter a new title that will override the original page title.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'show_excerpt' );
					$thb_field->setLabel( __( 'Show excerpt', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to show excerpt instead of the content.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'title_link' );
					$thb_field->setLabel( __( 'Link in title', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to enable the permalink to the page selected in the block title.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'thumbnail_link' );
					$thb_field->setLabel( __('Page/post thumbnail opens permalink', 'thb_text_domain') );
					$thb_field->setHelp( __('If checked, post/page featured images link directly to the post/page permalink.', 'thb_text_domain') );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'show_featured_image' );
					$thb_field->setLabel( __( 'Show Featured image', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to show the featured image.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_PageBlock() );
}

if( ! class_exists( 'THB_ProgressBarBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder progress bar block.
	 */
	class THB_ProgressBarBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_progress_bar',
				__( 'Progress Bar', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_progress_bar' )
			);

			$this->setDescription( __( 'Display numeric values in multiple progress bars.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'progress_data' );
					$thb_field->setLabel( __( 'Data', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Enter the progress data, one per line, pipe separated. E.g. <code>90|Design</code>', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'progress_value' );
					$thb_field->setLabel( __( 'Show value', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to show the progress numeric value.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'progress_animate' );
					$thb_field->setLabel( __( 'Animated', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Check if you want to enable the progress bar animation when the block is loaded.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_SelectField( 'progress_styles' );
					$thb_field->setLabel( __( 'Styles', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_config('backpack/general', 'builder_progress_bar_styles') );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array(
				$block_data['progress_styles']
			);

			if ( $block_data['progress_animate'] == 1 ) {
				$block_classes[] = 'animate';
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ProgressBarBlock() );
}

if( ! class_exists( 'THB_TabsBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_TabsBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_tabs',
				__( 'Tabs', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_tabs' )
			);

			$this->setDescription( __( 'Display a set of tabs.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createDuplicableContainer( '', $this->getSlug() . '_duplicable_container' );
				$thb_modal_container->setSortable();

				$thb_modal_container->addControl( __( 'Add a tab', 'thb_text_domain' ) );

				$thb_field = new THB_TabField( 'tabs' );
				$thb_field->addClass( 'full' );
				$thb_modal_container->setField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

				$thb_field = new THB_SelectField( 'tab_styles' );
				$thb_field->setLabel( __( 'Style', 'thb_text_domain' ) );
				$thb_field->setDefault( 'thb-tab-horizontal' );
				$thb_field->setOptions(array(
					'thb-tab-horizontal' => __('Horizontal', 'thb_text_domain'),
					'thb-tab-vertical'   => __('Vertical', 'thb_text_domain')
				));
				$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array(
				$block_data['tab_styles']
			);

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_TabsBlock() );
}

if( ! class_exists( 'THB_AccordionBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_AccordionBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_accordion',
				__( 'Accordion', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_accordion' )
			);

			$this->setDescription( __( 'Display a set of toggles arranged in an accordion.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createDuplicableContainer( '', $this->getSlug() . '_duplicable_container' );
				$thb_modal_container->setSortable();

				$thb_modal_container->addControl( __( 'Add an accordion item', 'thb_text_domain' ) );

				$thb_field = new THB_TabField( 'accordion_items' );
				$thb_field->addClass( 'full' );
				$thb_modal_container->setField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_AccordionBlock() );
}

if( ! class_exists( 'THB_ImageBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder Image block.
	 */
	class THB_ImageBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_image',
				__( 'Image', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_image' )
			);

			$this->setDescription( __( 'Display a column-wide image. You can put text beneath it, optionally load it in a popup.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_UploadField( 'image' );
					$thb_field->setLabel( __( 'Image', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'open_lightbox' );
					$thb_field->setLabel( __( 'Open in lightbox', 'thb_text_domain' ) );

					if ( function_exists( 'thb_is_lightbox_enabled' ) && ! thb_is_lightbox_enabled() ) {
						$h = 'Remember to activate the lightbox functionality from the <a href="%s" target="_blank">theme options</a> panel.';
						$lightbox_panel = thb_system_admin_url( 'thb-theme-options', array( 'tab' => 'lightbox' ) );
						$thb_field->setHelp( __( sprintf( $h, $lightbox_panel ), 'thb_text_domain' ) );
					}

					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'content' );
					$thb_field->setLabel( __( 'Content', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ImageBlock() );
}

if( ! class_exists( 'THB_VideoBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder Video block.
	 */
	class THB_VideoBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_video',
				__( 'Video', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_video' )
			);

			$this->setDescription( __( 'Display a video. You can put text beneath it, optionally making it autoplay and loop.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'id' );
					$thb_field->setLabel( __( 'Video URL', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'autoplay' );
					$thb_field->setLabel( __( 'Autoplay', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_CheckboxField( 'loop' );
					$thb_field->setLabel( __( 'Loop', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextField( 'title' );
					$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

					$thb_field = new THB_TextareaField( 'content' );
					$thb_field->setLabel( __( 'Content', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_VideoBlock() );
}

if( ! class_exists( 'THB_ShortcodeBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder shortcode block.
	 */
	class THB_ShortcodeBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_shortcode',
				__( 'Shortcode', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_shortcode' )
			);

			$this->setDescription( __( 'Display a shortcode.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_TextField( 'shortcode' );
					$thb_field->setLabel( __( 'The shortcode', 'thb_text_domain' ) );
					$thb_field->setHelp( __( 'Paste here your shortcode code.', 'thb_text_domain' ) );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ShortcodeBlock() );
}

if( ! class_exists( 'THB_WidgetAreaBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder shortcode block.
	 */
	class THB_WidgetAreaBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_widget_area',
				__( 'Widget area', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_widget_area' )
			);

			$this->setDescription( __( 'Display a widget area.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

					$thb_field = new THB_SelectField( 'id' );
					$thb_field->setLabel( __( 'Widget area', 'thb_text_domain' ) );
					$thb_field->setOptions( thb_get_sidebars_for_select() );
					$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_WidgetAreaBlock() );
}

if( ! class_exists( 'THB_ListBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_ListBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_list',
				__( 'List', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_list' )
			);

			$this->setDescription( __( 'Display a list.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

				$thb_field = new THB_TextField( 'title' );
				$thb_field->setLabel( __( 'Title', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_TextareaField( 'list' );
				$thb_field->setLabel( __( 'Items', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_IconPickerField( 'icon' );
				$thb_field->setLabel( __( 'Icon', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_ColorField( 'icon_color' );
				$thb_field->setLabel( __( 'Color', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_ListBlock() );
}

if( ! class_exists( 'THB_DividerBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder divider block.
	 */
	class THB_DividerBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_divider',
				__( 'Divider', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_divider' )
			);

			$this->setDescription( __( 'A simple content divider.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

				$thb_field = new THB_NumberField( 'margin_top' );
				$thb_field->setLabel( __( 'Margin top', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_NumberField( 'margin_bottom' );
				$thb_field->setLabel( __( 'Margin bottom', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_CheckboxField( 'show_go_top' );
				$thb_field->setLabel( __( 'Show Go top', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Check if you want to show the go top text.', 'thb_text_domain' ) );
				$thb_modal_container->addField( $thb_field );

				$thb_field = new THB_SelectField( 'divider_styles' );
				$thb_field->setLabel( __( 'Styles', 'thb_text_domain' ) );
				$thb_field->setOptions( thb_config('backpack/general', 'builder_divider_styles') );
				$thb_modal_container->addField( $thb_field );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array(
				$block_data['divider_styles']
			);

			if ( $block_data['show_go_top'] == 1 ) {
				$block_classes[] = 'go-top-active';
			}

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_DividerBlock() );
}

if( ! class_exists( 'THB_PricingTableBlock' ) && function_exists( 'thb_builder' ) ) {
	/**
	 * Builder page block.
	 */
	class THB_PricingTableBlock extends THB_BuilderBlock {

		/**
		 * Constructor
		 *
		 * @param string $title The block title.
		 **/
		public function __construct()
		{
			parent::__construct(
				'thb_pricingtable',
				__( 'Pricing table', 'thb_text_domain' ),
				thb_get_module_template_path( 'backpack/general', 'block_thb_pricingtable' )
			);

			$this->setDescription( __( 'Create your pricing table.', 'thb_text_domain' ) );

			$this->buildModals();
		}

		/**
		 * Build the block modals.
		 */
		private function buildModals()
		{
			$thb_modal = new THB_Modal( $this->getTitle(), $this->getSlug() );
				$thb_modal_container = $thb_modal->createDuplicableContainer( '', $this->getSlug() . '_duplicable_container' );
				$thb_modal_container->setSortable();

				$thb_modal_container->addControl( __( 'Add a price item', 'thb_text_domain' ) );

				$thb_field = new THB_PricingTableField( 'pricingtable_items' );
				$thb_field->addClass( 'full' );
				$thb_modal_container->setField( $thb_field );

				$thb_modal_container = $thb_modal->createContainer( '', $this->getSlug() . '_container' );

			$this->addModal( $thb_modal );
		}

		/**
		 * The classes to be added to the block element on frontend.
		 *
		 * @param array $block_data
		 * @return array
		 */
		public function blockClasses( $block_data ) {
			$block_classes = array();

			return array_merge( $block_classes, parent::blockClasses( $block_data ) );
		}

	}

	thb_builder_instance()->addBlock( new THB_PricingTableBlock() );
}