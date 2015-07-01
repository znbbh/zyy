<?php
/**
 * Teaser shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode teaser class.
 *
 */
class DT_Shortcode_Teaser extends DT_Shortcode {

	static protected $instance;

	protected $shortcode_name = 'dt_teaser';
	protected $plugin_name = 'dt_mce_plugin_shortcode_teaser';

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new DT_Shortcode_Teaser();
		}
		return self::$instance;
	}

	protected function __construct() {

		add_shortcode( $this->shortcode_name, array($this, 'shortcode') );

		// add shortcode button
		$tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false, 4 );
	}

	public function shortcode( $atts, $content = null ) {
		$default_atts = array(
			'type' => '',
			'style' => '1',
			'image' => '',
			'image_alt' => '',
			'misc_link' => '',
			'target' => 'blank',
			'media' => '',
			'background' => 'plain',
			'lightbox' => '0',
			'content_size' => 'normal',
			'text_align' => 'left',
			'animation' => 'none',
		);

		$attributes = shortcode_atts( $default_atts, $atts );

		$attributes['type'] = in_array( $attributes['type'], array('image', 'video') ) ?  $attributes['type'] : $default_atts['type'];
		$attributes['animation'] = in_array( $attributes['animation'], array('none', 'scale', 'fade', 'left', 'right', 'bottom', 'top') ) ?  $attributes['animation'] : $default_atts['animation'];
		$attributes['style'] = in_array($attributes['style'], array('1', '2') ) ? $attributes['style'] : $default_atts['style'];
		$attributes['background'] = in_array($attributes['background'], array('no', 'plain', 'fancy') ) ? $attributes['background'] : $default_atts['background'];
		$attributes['target'] = in_array($attributes['target'], array('blank', 'self') ) ? $attributes['target'] : $default_atts['target'];
		$attributes['image_alt'] = esc_attr($attributes['image_alt']);
		$attributes['misc_link'] = esc_url($attributes['misc_link']);
		$attributes['media'] = esc_url($attributes['media']);
		$attributes['content_size'] = in_array($attributes['content_size'], array('normal', 'small', 'big')) ? $attributes['content_size'] : $default_atts['content_size'];
		$attributes['text_align'] = in_array($attributes['text_align'], array('left', 'center', 'centre')) ? $attributes['text_align'] : $default_atts['text_align'];
		$attributes['lightbox'] = apply_filters('dt_sanitize_flag', $attributes['lightbox']);

		$container_classes = array( 'shortcode-teaser' );
		$content_classes = array( 'shortcode-teaser-content' );
		$media = '';

		// container classes
		if ( '1' == $attributes['style'] ) {
			$container_classes[] = 'img-full';
		}

		switch ( $attributes['background'] ) {
			case 'fancy': $container_classes[] = 'frame-fancy';
			case 'plain': $container_classes[] = 'frame-on';
		}

		if ( in_array( $attributes['text_align'], array('center', 'centre') ) ) {
			$container_classes[] = 'text-centered';
		}

		// content classes
		switch ( $attributes['content_size'] ) {
			case 'small': $content_classes[] = 'text-small'; break;
			case 'big': $content_classes[] = 'text-big';
		}

		if ( 'none' != $attributes['animation'] ) {

			switch ( $attributes['animation'] ) {
				case 'scale' : $container_classes[] = 'scale-up'; break;
				case 'fade' : $container_classes[] = 'fade-in'; break;
				case 'left' : $container_classes[] = 'right-to-left'; break;
				case 'right' : $container_classes[] = 'left-to-right'; break;
				case 'bottom' : $container_classes[] = 'top-to-bottom'; break;
				case 'top' : $container_classes[] = 'bottom-to-top'; break;
			}

			$container_classes[] = 'animate-element';
		}

		if ( 'image' == $attributes['type'] ) {
			$attributes['media'] = '';
		} elseif ( 'video' == $attributes['type'] ) {
			$attributes['image'] = '';
		}

		// if media url is set - do some stuff
		if ( $attributes['media'] ) {
			$container_classes[] = 'shortcode-single-video';

			$media = sprintf( '<div class="shortcode-teaser-img"><div class="shortcode-teaser-video">%s</div></div>', dt_get_embed($attributes['media']) );

		// if image is set
		} elseif ( $attributes['image'] ) {

			if ( is_numeric($attributes['image']) ) {

				$image_id = absint($attributes['image']);
				$image_info = wp_get_attachment_image_src( $image_id, 'full' );

				if ( !$image_info ) {

					$image_info = presscore_get_default_image();
				}

				$image_src = $image_info[0];

				if ( empty($attributes['image_alt']) ) {

					$attributes['image_alt'] = esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
				}

			} else {

				$image_src = esc_url($attributes['image']);
			}

			$media = sprintf( '<img src="%s" alt="%s" />', $image_src, $attributes['image_alt'] );

			if ( $attributes['lightbox'] ) {
				$media = sprintf(
					'<a class="rollover rollover-zoom dt-single-mfp-popup dt-mfp-item mfp-image" href="%s" title="%s" data-dt-img-description="%s">%s</a>',
					$image_src,
					esc_attr( $attributes['image_alt'] ),
					'',
					$media
				);
			} else if ( $attributes['misc_link'] ) {
				$media = sprintf(
					'<a class="rollover rollover-zoom" href="%s"%s>%s</a>',
					$attributes['misc_link'],
					('blank' == $attributes['target']) ? ' target="_blank"' : '',
					$media
				);
			}

			$media = sprintf( '<div class="shortcode-teaser-img">%s</div>', $media );
		}

		$output = sprintf('<section class="%s">%s<div class="%s">%s</div></section>',
			esc_attr(implode(' ', $container_classes)),
			$media,
			esc_attr(implode(' ', $content_classes)),
			do_shortcode($content)
		);

		return $output; 
	}

}

// create shortcode
DT_Shortcode_Teaser::get_instance();