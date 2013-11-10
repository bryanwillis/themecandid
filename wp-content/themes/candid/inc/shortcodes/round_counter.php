<?php
/**
 * Shortcode Title: Icon
 * Shortcode: round_counter
 * Usage: [round_counter title="Your title" counter="123"]

 */
add_shortcode('round_counter', 'ts_round_counter_func');

function ts_round_counter_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'title' => '',
		'counter' => '0'
	),
	$atts));

	$html = '
		<div class="sc-counter">
			<p><img alt="" src="'.  get_template_directory_uri() .'/img/1x1.png" width="1px" height="1px" /><span class="sc-quantity" data-quantity="'.$counter.'">0</span><span>'.$title.'</span></p>
			<div class="clear"></div>
		</div>';
	return $html;

}