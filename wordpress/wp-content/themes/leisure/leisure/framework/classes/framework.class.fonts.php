<?php 

class CurlyThemesFont {

	public $_family;
	public $_size;
	public $_rem;
	public $_style;
	public $_variant;
	
	public function __construct( $family = null, $size = null, $style = null, $variant = null ) {
		$this->_family 	= $this->get_font_family( $family );
		$this->_size 	= $size;
		$this->_rem 	= 'font-size:'.($size / 10).'rem;';
		$this->_style 	= $this->get_font_style( $style );
		$this->_variant = $this->get_font_variant( $variant );
	}
	
	private function get_font_family( $family ) {
		return "font-family: '$family';";
	}
	
	private function get_font_style( $style ){
		switch ( $style ) {
			case 0 : return 'font-weight: 300;';break;
			case 1 : return 'font-weight: 300;font-style: italic;';break;
			case 2 : return 'font-weight: normal;font-style: normal;';break;
			case 3 : return 'font-weight: 700;'; break;
			case 4 : return 'font-style: italic;';break;
			case 5 : return 'font-style: italic; font-weight: bold;';break;
		}
	}

	private function get_font_variant( $variant ){
		switch ( $variant ) {
			case 0 : return 'text-transform: none;';break;
			case 1 : return 'text-transform: capitalize;';break;
			case 2 : return 'text-transform: uppercase;';break;
			case 3 : return 'font-variant: small-caps;';break;
		}
	}
	
}

class CurlyThemesLoadFonts {
	
	public function __construct() {
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_fonts' ) );
		add_action( 'editor_fonts', array( $this, 'mce_fonts' ) );
		
	}
	
	function enqueue_fonts() {
		global $curly_theme_options;
		wp_enqueue_style('curly-google-fonts', $this->fonts() );
		
		/** Custom Typography */
		$font_body = new CurlyThemesFont(
			$curly_theme_options['fonts_body'], 
			$curly_theme_options['fonts_body_size'], 
			$curly_theme_options['fonts_body_style'], 
			$curly_theme_options['fonts_body_variant']
		);
		$font_h1 = new CurlyThemesFont(
			$curly_theme_options['fonts_h1'], 
			$curly_theme_options['fonts_h1_size'], 
			$curly_theme_options['fonts_h1_style'], 
			$curly_theme_options['fonts_h1_variant']
		);
		$font_h2 = new CurlyThemesFont(
			$curly_theme_options['fonts_h2'], 
			$curly_theme_options['fonts_h2_size'], 
			$curly_theme_options['fonts_h2_style'], 
			$curly_theme_options['fonts_h2_variant']
		);
		$font_h3 = new CurlyThemesFont(
			$curly_theme_options['fonts_h3'], 
			$curly_theme_options['fonts_h3_size'], 
			$curly_theme_options['fonts_h3_style'],
			$curly_theme_options['fonts_h3_variant']
		);
		$font_h4 = new CurlyThemesFont(
			$curly_theme_options['fonts_h4'],
			$curly_theme_options['fonts_h4_size'], 
			$curly_theme_options['fonts_h4_style'], 
			$curly_theme_options['fonts_h4_variant']
		);
		$font_h5 = new CurlyThemesFont(
			$curly_theme_options['fonts_h5'],
			$curly_theme_options['fonts_h5_size'],
			$curly_theme_options['fonts_h5_style'],
			$curly_theme_options['fonts_h5_variant']
		);
		$font_h6 = new CurlyThemesFont(
			$curly_theme_options['fonts_h6'], 
			$curly_theme_options['fonts_h6_size'], 
			$curly_theme_options['fonts_h6_style'],
			$curly_theme_options['fonts_h6_variant']
		);
		$font_quote = new CurlyThemesFont(
			$curly_theme_options['fonts_blockquote'], 
			$curly_theme_options['fonts_blockquote_size'],
			$curly_theme_options['fonts_blockquote_style'],
			$curly_theme_options['fonts_blockquote_variant']
		);
		$font_menu = new CurlyThemesFont(
			$curly_theme_options['fonts_menu'], 
			$curly_theme_options['fonts_menu_size'], 
			$curly_theme_options['fonts_menu_style'], 
			$curly_theme_options['fonts_menu_variant']
		);
		$font_sec_menu = new CurlyThemesFont(
			$curly_theme_options['fonts_secondary_menu'],
			$curly_theme_options['fonts_secondary_menu_size'],
			$curly_theme_options['fonts_secondary_menu_style'],
			$curly_theme_options['fonts_secondary_menu_variant']
		);
		
		$css = "
			body, p, li, span, #footer{ 
				$font_body->_family 
				$font_body->_style 
				$font_body->_variant 
				$font_body->_rem 
			}
			h1,
			.page-title,
			.pricing-row h3{ 
				$font_h1->_family 
				$font_h1->_style 
				$font_h1->_variant 
				$font_h1->_rem 
			}
			h2,
			#logo{ 
				$font_h2->_family 
				$font_h2->_style 
				$font_h2->_variant 
				$font_h2->_rem 
			}
			h3{ 
				$font_h3->_family 
				$font_h3->_style 
				$font_h3->_variant 
				$font_h3->_rem 
			}
			h4{ 
				$font_h4->_family 
				$font_h4->_style 
				$font_h4->_variant 
				$font_h4->_rem 
			}
			h5,
			.nav-tabs > li > a{ 
				$font_h5->_family 
				$font_h5->_style 
				$font_h5->_variant 
				$font_h5->_rem 
			}
			h6{ 
				$font_h6->_family 
				$font_h6->_style 
				$font_h6->_variant 
				$font_h6->_rem 
			}
			blockquote, 
			blockquote p,
			.pullquote{ 
				$font_quote->_family 
				$font_quote->_style 
				$font_quote->_variant 
				$font_quote->_rem 
			}
			blockquote cite{
				$font_body->_rem
			}
			#main-nav ul.menu > .menu-item > a,
			#main-nav div.menu > ul > li[class*=page-item] > a{ 
				$font_menu->_family 
				$font_menu->_style 
				$font_menu->_variant 
				$font_menu->_rem 
			}
			#secondary-nav .menu-item > a,
			#secondary-nav .menu-item .nav_desc{ 
				$font_sec_menu->_family 
				$font_sec_menu->_style 
				$font_sec_menu->_variant 
				$font_sec_menu->_rem 
			}
			#footer .widget-title,
			.services-carousel p,
			.meta,
			#isotope p{
				$font_body->_rem 
			}
			.entry h1 + .entry-meta,
			.entry h2 + .entry-meta,
			.entry h3 + .entry-meta,
			.entry.quote blockquote + .entry-meta{
				$font_h1->_family
				$font_body->_rem 
			}
			.absolute-header,
			.absolute-header span,
			.absolute-header em{
				font-size: ".(round($font_body->_size/1.15/10 , 1))."rem;
			}
			.dropcap{
				$font_quote->_family
			}
			#footer,
			#footer p,
			#footer li{
				font-size: ".(($font_body->_size - 2) / 10 )."rem
			}
		";
		
		wp_add_inline_style( 'curly-style', CurlyThemes::minify_css( htmlspecialchars_decode( $css ) ) ); 
	}
	
	function mce_fonts() {
		$url = $this->fonts();
		echo "@import url('$url');";
	}
	
	function fonts() {
		global $curly_theme_options;
	
		$fonts = array();
		
		/** Body Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_body'], 
			$this->font_weight( $curly_theme_options['fonts_body_style'] ) 
		);
		
		/** H1 Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_h1'], 
			$this->font_weight( $curly_theme_options['fonts_h1_style'] ) 
		);
		
		/** H2 Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_h2'], 
			$this->font_weight( $curly_theme_options['fonts_h2_style'] ) 
		);
		
		/** H3 Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_h3'], 
			$this->font_weight( $curly_theme_options['fonts_h3_style'] ) 
		);
		
		/** H4 Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_h4'], 
			$this->font_weight( $curly_theme_options['fonts_h4_style'] ) 
		);
		
		/** H5 Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_h5'], 
			$this->font_weight( $curly_theme_options['fonts_h5_style'] ) 
		);
		
		/** H6 Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_h6'], 
			$this->font_weight( $curly_theme_options['fonts_h6_style'] ) 
		);
		
		/** Blockquote Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_blockquote'], 
			$this->font_weight( $curly_theme_options['fonts_blockquote_style'] ) 
		);
		
		/** Menu Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_menu'], 
			$this->font_weight( $curly_theme_options['fonts_menu_style'] ) 
		);
		
		/** Secondary Menu Font */
		$fonts = $this->fonts_array( 
			$fonts, 
			$curly_theme_options['fonts_secondary_menu'], 
			$this->font_weight( $curly_theme_options['fonts_secondary_menu_style'] ) 
		);
		
		foreach ( $fonts as $key => $value) {
			asort( $value );
			$fonts[$key] = str_replace(' ', '+', $key).':'.implode(',', $value );
		}

		$args = array(
			'family' => implode('|', $fonts),
			'subset' => $this->get_font_subset()
		);
		
		$url = '//fonts.googleapis.com/css';
		$url = add_query_arg( $args, $url );

		return esc_url_raw( $url );
		
	}
	
	public function fonts_array( $array, $font, $weight ) {
	
		if ( ! array_key_exists( $font, $array ) ) {
			$array[$font] = array($weight);
		} else {
			if ( ! in_array( $weight , $array[$font] ) ) {
				array_push( $array[$font], $weight );
			}
		}
		
		return $array;
		
	}
	
	private function font_weight( $style ) {
		switch ( $style ) {
			case 0 : return 300; break;
			case 1 : return 300; break;
			case 2 : return 400; break;
			case 3 : return 700; break;
			case 4 : return 400; break;
			case 5 : return 700; break;
		}
	}
	
	private function get_font_subset() {
		global $curly_theme_options;
		switch ( $curly_theme_options['fonts_subset'] ){
			case 0 	: return 'latin'; break;
			case 1 	: return 'latin,cyrillic-ext,cyrillic'; break;
			case 2 	: return 'latin,greek-ext,greek'; break;
			case 3 	: return 'latin,greek'; break;
			case 4 	: return 'latin,vietnamese'; break;
			case 5 	: return 'latin,latin-ext'; break;
			case 5 	: return 'latin,cyrillic'; break;
		}
	}

}

new CurlyThemesLoadFonts();

?>