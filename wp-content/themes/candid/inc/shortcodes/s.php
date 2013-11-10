<?php
/**
 * Shortcode Title: S
 * Shortcode: s
 * Usage: [s]Your text here..[/s]
 */
add_shortcode('s', 'ts_s_func');

function ts_s_func( $atts, $content = null ) {
	
	return '<span class="sc-span">'.do_shortcode($content).'</span>';
}