<?php
/**
 * Shortcode Title: Separator
 * Shortcode: separator
 * Usage: [separator]
 */
add_shortcode('separator', 'ts_separator_func');

function ts_separator_func( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		"align" => 'left',
		"text" => '',
		"size" => "normal"
		), 
	$atts));
	
	if (empty($content))
	{
		return "<div class='sc-separator'></div>";
	}
	return "<div class='sc-separator sc-separator-".$align." sc-separator-".$size."'><div>".$content."</div></div>";
}