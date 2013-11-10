<?php
/**
 * Shortcode Title: Space
 * Shortcode: space
 * Usage: [space]
 */
add_shortcode('space', 'ts_space_func');

function ts_space_func( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		"height" => '20'
		), 
	$atts));
	
	return '<div class="clear" style="height: '.(int)$height.'px"></div>';
}