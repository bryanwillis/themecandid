<?php
/**
 * Shortcode Title: Intro
 * Shortcode: intro
 * Usage: [intro]Your text here..[/intro]
 */
add_shortcode('intro', 'ts_intro_func');

function ts_intro_func( $atts, $content = null ) {

	return '<h2 class="sc-intro">'.do_shortcode($content).'</h2>';
}