<?php
/**
 * Team shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode Team class.
 *
 */
class DT_Shortcode_Team extends DT_Shortcode {

	static protected $instance;
	protected $atts;

	protected $shortcode_name = 'dt_team';
	protected $post_type = 'dt_team';
	protected $taxonomy = 'dt_team_category';
	protected $plugin_name = 'dt_mce_plugin_shortcode_team';

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new DT_Shortcode_Team();
		}
		return self::$instance;
	}

	protected function __construct() {

		add_shortcode( $this->shortcode_name, array($this, 'shortcode') );

		// add shortcode button
		$tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false, 4 );
	}

	public function shortcode( $atts, $content = null ) {
		global $post;

		$attributes = shortcode_atts( array(
			'type'                  => 'masonry',

			'category'              => '',
			'order'                 => '',
			'orderby'               => '',
			'number'                => '6',
			'padding'               => '5',
			'column_width'          => '370',
			'full_width'            => ''
		), $atts );
		
		// sanitize attributes
		$attributes['type'] = in_array($attributes['type'], array('masonry', 'grid') ) ? $attributes['type'] : 'masonry';

		$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
		$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
		$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

		$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);
		$attributes['padding'] = intval($attributes['padding']);
		$attributes['column_width'] = intval($attributes['column_width']);

		if ( $attributes['category']) {
			$attributes['category'] = explode(',', $attributes['category']);
			$attributes['category'] = array_map('trim', $attributes['category']);
			$attributes['select'] = 'only';
		} else {
			$attributes['select'] = 'all';
		}

		$post_backup = $post;

		$dt_query = $this->get_posts_by_terms( $attributes );

		$output = '';

		if ( $dt_query->have_posts() ) {

			$config = Presscore_Config::get_instance();

			// backup and reset config
			$config_backup = $config->get();

			$config->set('layout', $attributes['type']);
			$config->set('template', 'team');
			$config->set('columns', -1);
			$config->set('target_width', $attributes['column_width']);

			// add masonry wrap
			add_action('presscore_before_post', 'presscore_before_post_masonry', 15);
			add_action('presscore_after_post', 'presscore_after_post_masonry', 15);

			while ( $dt_query->have_posts() ) { $dt_query->the_post();
				ob_start();

				get_template_part( 'content', 'team' );

				$output .= ob_get_contents();
				ob_end_clean();
			}

			// remove masonry wrap
			remove_action('presscore_before_post', 'presscore_before_post_masonry', 15);
			remove_action('presscore_after_post', 'presscore_after_post_masonry', 15);

			// restore original $post
			$post = $post_backup;
			setup_postdata( $post );

			// restore config
			$config->reset($config_backup);

			// masonry layout classes
			$masonry_container_classes = array( 'wf-container' );
			switch ( $attributes['type'] ) {
				case 'grid':
					$masonry_container_classes[] = 'grid-masonry';
					break;
				case 'masonry':
					$masonry_container_classes[] = 'iso-container';
			}
			$masonry_container_classes = implode(' ', $masonry_container_classes);

			$masonry_container_data_attr = array(
				'data-padding="' . intval($attributes['padding']) . 'px"',
				'data-width="' . intval($attributes['column_width']) . 'px"'
			);

			// ninjaaaa!
			$masonry_container_data_attr = ' ' . implode(' ', $masonry_container_data_attr);

			// wrap output
			$output = sprintf( '<div class="%s"%s>%s</div>',
				esc_attr($masonry_container_classes),
				$masonry_container_data_attr,
				$output
			);

			if ( $attributes['full_width'] ) {
				$output = '<div class="full-width-wrap">' . $output . '</div>';
			}
		} // if have posts

		return $output;
	}

}

// create shortcode
DT_Shortcode_Team::get_instance();