<?php
/**
 * Shortcode Title: List
 * Shortcode: list
 * Usage: [list type="check"][list_item]Test[/list_item][/list]
 */
add_shortcode('list', 'ts_list_func');

function ts_list_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'type' => '',
    ), $atts));

	global $shortcode_list_class;

	switch ($type)
	{
		case 'icon-arrow':
			$shortcode_list_class = 'sc-list-icon-arrow';
			break;
		case 'icon-circle':
			$shortcode_list_class = 'sc-list-icon-circle';
			break;
		case 'icon-check':
			$shortcode_list_class = 'sc-list-icon-check';
			break;
		case 'icon-star':
			$shortcode_list_class = 'sc-list-icon-star';
			break;
		case 'icon-plus':
			$shortcode_list_class = 'sc-list-icon-plus';
			break;
		case 'icon-dash':
			$shortcode_list_class = 'sc-list-icon-dash';
			break;
		default:
			$shortcode_list_class = 'sc-list-icon-check';

	}
	return '
		<div class="sc-list '.$shortcode_list_class.'">
			'.do_shortcode($content).'
		</div>';
}