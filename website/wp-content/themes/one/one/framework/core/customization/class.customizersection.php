<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme customizer section class.
 *
 * This class is entitled to manage the theme customizer sections.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_CustomizerSection') ) {
	class THB_CustomizerSection {

		/**
		 * The customizer object.
		 *
		 * @var THB_Customizer
		 */
		private $customizer = null;

		/**
		 * The section key.
		 *
		 * @var string
		 */
		private $key = '';

		/**
		 * The section title.
		 *
		 * @var string
		 */
		private $title = '';

		/**
		 * The section priority index.
		 *
		 * @var integer
		 */
		private $index = 0;

		/**
		 * The section settings.
		 *
		 * @var array
		 */
		private $settings = array();

		/**
		 * Constructor.
		 *
		 * @param string $key The section key.
		 * @param string $title The section title.
		 * @param int $index The section priority index.
		 * @param THB_Customizer $customizer Reference to the theme customizer.
		 * @return THB_CustomizerSection
		 */
		public function __construct( $key, $title, $customizer = null, $index = 0 )
		{
			$this->key = $key;
			$this->title = $title;
			$this->index = $index;
			$this->customizer = $customizer;

			return $this;
		}

		/**
		 * Add a divider to the section.
		 *
		 * @param string $label The divider label.
		 * @return THB_CustomizerDividerSetting
		 */
		public function addDivider( $label )
		{
			$index = $this->customizer->settings_counter;

			return $this->addSetting( new THB_CustomizerDividerSetting( 'divider_' . $index, $label ) );
		}

		/**
		 * Add a setting to the section.
		 *
		 * @param THB_CustomizerSetting $setting The setting object.
		 * @return THB_CustomizerSetting
		 */
		public function addSetting( THB_CustomizerSetting $setting )
		{
			$setting->setSection( $this->key );
			$setting->setIndex( $this->customizer->settings_counter );
			$this->settings[] = $setting;
			$this->customizer->settings_counter = $this->customizer->settings_counter + 1;

			return $setting;
		}

		/**
		 * Get the theme customizer settings.
		 *
		 * @return array
		 */
		public function getSettings()
		{
			return $this->settings;
		}

		/**
		 * Register the section.
		 */
		public function register()
		{
			global $wp_customize;

			$wp_customize->add_section( $this->key, array(
				'title' => $this->title,
				'priority' => $this->index
			) );

			foreach ( $this->settings as $setting ) {
				$setting->register();
			}
		}

	}
}