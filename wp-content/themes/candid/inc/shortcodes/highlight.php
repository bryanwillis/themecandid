<?php
/**
 * Shortcode Title: Highlight
 * Shortcode: highlight
 * Usage: [highlight color="#ebebeb" fullwidth="yes"]Your text here...[/highlight]
 */
add_shortcode('highlight', 'highlight_func');

function highlight_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		'fullwidth' => 'yes',
		'color' => '',
		'border_color' => '',
		'background_image' => '',
		'background_attachment' => '',
		'background_position' => '',
		'background_stretch' => '',
		'min_height' => '',
		'first_page' => '',
		'last_page' => '',
		'padding_top' => '',
		'padding_bottom' => '',
		'margin_bottom' => ''
		), 
	$atts));
	
	$classes = array();
	$styles = array();
	
	if ($fullwidth == 'yes')
	{
		$classes[] = 'sc-highlight-full-width';
	}
	else
	{
		$classes[] = 'sc-highlight-standard';
	}
	
	if (!empty($color)) {
		$styles[] = 'background-color: '.$color.';'; 
	}
	
	if (!empty($border_color)) {
		$styles[] = 'border: 1px solid '.$border_color.';'; 
	}
	
	if (!empty($background_image)) {
		$styles[] = 'background-image: url('.$background_image.');';
	}
	
	if (!empty($background_attachment)) {
		$styles[] = 'background-attachment: '.$background_attachment.';';
	}
	
	if (intval($min_height)) {
		$styles[] = 'min-height: '.intval($min_height).'px;';
	}
	
	if (!empty($background_position)) {
		$styles[] = 'background-position: '.$background_position.';';
	}
	/*
	if (!empty($background_stretch)) {
		if($background_stretch == 'yes') { 
			$background_size = '100%';
		}
		$styles[] = 'background-size: 100% '.$background_size. ';';
	}*/
	
	if ($background_stretch == 'yes') {
		$styles[] = 'background-size: 100% 100%;';
	}
	
	if ($first_page == 'yes') {
		$styles[] = 'margin-top: -30px;';
	}
	
	if (intval($padding_top)) {
		$styles[] = 'padding-top: '.intval($padding_top).'px;';
	}
	
	if (intval($padding_bottom)) {
		$styles[] = 'padding-bottom: '.intval($padding_bottom).'px;';
	}
	
	if (intval($margin_bottom)) {
		$styles[] = 'margin-bottom: '.intval($margin_bottom).'px;';
	}
	else if ($last_page == 'yes') {
		$styles[] = 'margin-bottom: -30px;';
	}
	
	return '
		<div class="'.implode(' ',$classes).'" style="'.implode(' ',$styles).'">
			<div class="sc-highlight">'.do_shortcode($content).'</div>
		</div>
	';
}