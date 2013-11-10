<?php
/**
 * Shortcode Title: Icon 3
 * Shortcode: icon_3
 * Usage: [icon_3 type="icon-bullhorn" title=""]Your content here...[/icon_3]

 */
add_shortcode('icon_3', 'ts_icon_3_func');

function ts_icon_3_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'icon' => '',
		'title' => ''
	),
	$atts));
	
	$html = '
		<div class="sc-icon sc-icon-style2">
            <span class="'.$icon.'"></span>
            <h2>'.$title.'</h2>
            '.$content.'
		</div>';
	return $html;

}