<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if ( ! function_exists( 'thb_builder' ) ) {
	/**
	 * Display the builder sections.
	 */
	function thb_builder() {
		$page_id = thb_get_page_ID();
		$sections = thb_duplicable_get( 'section', $page_id );

		if ( empty( $sections ) ) {
			return;
		}

		wp_reset_query();

		foreach ( $sections as $index => $section ) {
			$value = $section['value'];
			$decoded_section = html_entity_decode( $value );
			parse_str( $decoded_section, $sect );

			$sect = stripslashes_deep( $sect );

			if ( empty( $sect['rows'] ) ) {
				continue;
			}

			$section_classes = array(
				isset( $sect['appearance']['width'] ) ? $sect['appearance']['width'] : '',
				isset( $sect['appearance']['class'] ) ? $sect['appearance']['class'] : ''
			);

			$section_classes = apply_filters( 'thb_section_classes', $section_classes, $sect );
			$section_attrs   = apply_filters( 'thb_section_attrs', array(), $sect );

			thb_get_module_template_part( 'backpack/builder', 'section', array(
				'section'             => $sect,
				'section_index'       => $index,
				'class'               => implode( ' ', $section_classes ),
				'section_attrs'       => thb_get_attributes( $section_attrs ),
			) );
		}
	}
}