<?php
// Shortcode: Price List
// Shortcode Title: 
// Shortcode: price_list
// Usage: [price_list price="$10.00"]your content goes here..[/price_list]
// Options: position=left, center, right 
add_shortcode('price_list', 'ts_price_list_func');
function ts_price_list_func( $atts, $content = null ) {
	extract(shortcode_atts(array(
		// 'price' => '', // left, center, right
    ), $atts));
	$html = '<div class="price-list">'.do_shortcode($content).'</div>';
	return apply_filters('uds_shortcode_out_filter', $html);
}

// Shortcode Title: Price List Title
// Shortcode: price_title
// Usage: [price_title]your content goes here...[/price_title]
add_shortcode('price_title', 'ts_price_title_func');

function ts_price_title_func( $atts, $contents = null ) {
	$html = '<div class="left">'.do_shortcode($contents).'</div>';
	return $html;
}

// Shortcode Title: Price List Value
// Shortcode: price_value
// Usage: [price_value]your content goes here...[/price_value]
add_shortcode('price_value', 'ts_price_value_func');

function ts_price_value_func( $atts, $contents = null ) {
$html = '<div class="right">'.do_shortcode($contents).'</div>';
   return $html;
}