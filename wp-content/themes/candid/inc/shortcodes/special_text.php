<?php
/**
 * Shortcode Title: Special text
 * Shortcode: special_text
 * Usage: [special_text]Your text here...[/special_text]
 */
add_shortcode('special_text', 'special_text_func');

function special_text_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		"tagname" => 'h1',
		"pattern" => 'no',
		"color" => '',
		"font_size" => '',
		"font_weight" => '',
		"font" => '',
		"margin_top" => '',
		"margin_bottom" => '',
		"align" => 'left'
		), 
	$atts));
	
	$classes = array();
	$classes[] = 'special-text';
	$styles = array();
	
	if (empty($tagname)) {
		$tagname = 'span';
	}
	
	if ($pattern == 'yes') {
		$classes[] = 'special-text-pattern';
	}
	
	if (!empty($color)) {
		$styles[] = "color: ".$color;
	}
	
	if (intval($font_size)) {
		$styles[] = "font-size: ".intval($font_size)."px";
	}
	
	if (!empty($font_weight) && $font_weight != 'default') {
		$styles[]= "font-weight: ".$font_weight;
	}
	
	if (!empty($font)) {
		$font = str_replace('google_web_font_','',$font);
		
		if ($font != 'default') {
			$styles[]= "font-family: ".$font;
		}
	}
	
	if (intval($margin_top)) {
		$styles[] = "margin-top: ".intval($margin_top)."px";
	}
	
	if (intval($margin_bottom)) {
		$styles[] = "margin-bottom: ".intval($margin_bottom)."px";
	}
	
	if (!empty($align)) {
		$styles[]= "text-align: ".$align;
	}
	
	$classes_html = '';
	if (count($classes) > 0){
		$classes_html = 'class="'.implode(' ',$classes).'"';
	}
	
	$styles_html = '';
	if (count($styles) > 0) {
		$styles_html = 'style="'.implode(';',$styles).'"';
	}
	
	return '<'.$tagname.' '.$classes_html.' '.$styles_html.'><span>'.$content.'</span></'.$tagname.'>';
}