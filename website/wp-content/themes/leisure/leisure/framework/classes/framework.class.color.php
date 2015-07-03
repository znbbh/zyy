<?php

class CurlyThemesColor {
	
	public $_color;
	public $_bk_color;

	public function __construct( $color = null, $bk_color = null ) {
		$this->_color = $color;
		$this->_bk_color = $bk_color;
	}
	
	public function __toString() {
		return $this->color();
	}
	
	public function color() {
		if ( $this->_color ) {
			return 'rgba('.$this->hex2rgb( $this->_color ).', 1)';
		} elseif ( $this->_bk_color ) {
			return 'rgba('.$this->hex2rgb( $this->_bk_color ).', 1)';
		} else {
			return '';
		}
	}
	
	public function opacity( $opacity = 1 ) {
		return ( $this->_color ) ? 'rgba('.$this->hex2rgb( $this->_color ).', '.$opacity.')' : 'rgba('.$this->hex2rgb( $this->_bk_color ).', '.$opacity.')';
	}
	
	public function hex2rgb( $hex ) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb);
	}
	
	public function brightness( $hexStr ) {
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); 
		$rgbArray = array();
		if (strlen($hexStr) == 6) { 
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3) {
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false;
		}
		return (($rgbArray['red']*299) + ($rgbArray['green']*587) + ($rgbArray['blue']*114))/1000;
	}
	
	public function contrast( $test1, $test2, $opacity = 1 ) {
		return (abs($this->brightness($test1) - $this->brightness($this->darken($this->_color))) > abs($this->brightness($test2) - $this->brightness($this->darken($this->_color)))) ? 'rgba('.$this->hex2rgb($test1).', '.$opacity.')' : 'rgba('.$this->hex2rgb($test2).', '.$opacity.')';
	}
	
	public function darken( $dif=20 ){
		$color = $this->_color;
	    $color = str_replace('#', '', $color);
	    if (strlen($color) != 6){ return '000000'; }
	    $rgb = '';
	    for ($x=0;$x<3;$x++){
	        $c = hexdec(substr($color,(2*$x),2)) - $dif;
	        $c = ($c < 0) ? 0 : dechex($c);
	        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
	    }
	    return 'rgb('.$this->hex2rgb('#'.$rgb).')';
	}
	
}

?>