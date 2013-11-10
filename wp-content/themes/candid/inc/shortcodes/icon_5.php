<?php
/**
 * Shortcode Title: Icon 5
 * Shortcode: icon_5
 * Usage: [icon_5 icon="icon_search" icon_color="#FF0000" text_color="#000000" title="Your title"]Your content here...[/icon_5]

 */
add_shortcode('icon_5', 'ts_icon_5_func');

function ts_icon_5_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'icon' => '',
		'icon_color' => '',
		'text_color' => '',
		'title' => '',
	),
	$atts));
	
	if (!empty($text_color)) {
		$style_text_color = 'style="color: '.$text_color.'"';
	}
	
	$html = '
	  <div class="sc-icon sc-icon-style3" '.$style_text_color.'>
		<span class="'.$icon.'" style="background-color: '.$icon_color.';"></span>
		<h2>'.$title.'</h2>
		'.$content.'
	  </div>';
	return $html;

}