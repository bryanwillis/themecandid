<?php
/**
 * Shortcode Title: Icon
 * Shortcode: icon
 * Usage: [icon_4 type="icon-bullhorn" size="icon-large" color=""]

 */
add_shortcode('icon_4', 'ts_icon_4_func');

function ts_icon_4_func( $atts) {

	extract(shortcode_atts(array(
		'icon' => '',
		'size' => '',
		'color' => ''
	),
	$atts));

	$styles = array();
	if (intval($size) > 0) {
		$styles[] = 'font-size: '.intval($size).'px';
	}
	
	if (!empty($color)) {
		$styles[] = 'color: '.$color;
	}
	
	$style_html = '';
	if (count($styles) > 0) {
		$style_html = 'style="'.implode(';',$styles).'"';
	}
	
	$html = '<span class="'.$icon.'" '.$style_html.'></span>';
	return $html;

}