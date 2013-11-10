<?php
/**
 * Shortcode Title: Text
 * Shortcode: text
 * Usage: [text][/text]
 */
add_shortcode('text', 'ts_text_func');

function ts_text_func( $atts, $content = null ) {
	
	return do_shortcode(nl2br($content));
}