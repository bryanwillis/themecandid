<?php
/**
 * Shortcode Title: Divider
 * Shortcode: divider
 * Usage: [divider scrolltext="Go To Top"]
 */
add_shortcode('divider', 'ts_divider_func');

function ts_divider_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		"align" => 'left',
		"text" => '',
		"size" => "normal",
		"variant" => "normal",
		"dimension" => "3px",
		"color" => "",
		"scrolltext" => "",
		"style" => 1
		), 
	$atts));
	$scroll = '';
	$styles = array();
	
	if ($style == 1) {
		if (!empty($dimension) && $dimension != '3px') {
			$styles[] = 'border-bottom-width: '.$dimension;
		}
		
		if (!empty($color)) {
			$styles[] = 'border-bottom-color: '.$color;
		}
		
		if (!empty($variant) && $variant == 'dotted') {
			$styles[] = 'border-bottom-style: dotted';
		}
	}
	
	if (!empty($scrolltext)) {
		$scroll = '<div class="sc-divider-scroll">'.$scrolltext.'</div>';
	}
	
	$style_html = '';
	if (count($styles) > 0) {
		$style_html = 'style="'.implode(';',$styles).'"';
	}
	
	if (empty($content)) {
		return "<div ".$style_html." class='sc-divider'>".$scroll."</div>";
	}
	
	return "<div ".$style_html." class='sc-divider sc-divider-style-".$style." sc-divider-".$align." sc-divider-".$size."'><div class='sc-divider-text'>".$content."</div>".$scroll."</div>";
}