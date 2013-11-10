<?php
/**
 * Shortcode Title: Icons list
 * Shortcode: icons_list
 * Usage: [icons_list][icons_list_item type="icon-music" url="http://..." title="Your title..."]Your content...[/icons_list_item][/icons_list]
 */
add_shortcode('icons_list', 'ts_icons_list_func');

function ts_icons_list_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => ''
	),
	$atts));

	global $shortcode_icons;

	$animation_class = '';
	switch ($animation) {
		case 'showup':
			$animation_class = 'animated';
			break;
	}

	$shortcode_icons = array(); // clear the array
    do_shortcode($content); // execute the '[icon]' shortcode first to get the title and content

	$icons_nav = '';
	$icons_content = '';
	foreach ($shortcode_icons as $icon) {
		
		$icons_content .= '
			<div class="sc-icon">
				<span class="'.$icon['type'].' '.$animation_class.' slow"></span>
				<h2>'.$icon['title'].'</h2>
				'.$icon['content'].'
			</div>';
	}
    $shortcode_icons = array();

	$content = "
		<div class='advantages'>
			".$icons_content."
		</div>";

	return $content;
}

/**
 * Shortcode Title: Icons List Item - can be used only with icons_list shortcode
 * Shortcode: icon_list_item
 */
add_shortcode('icons_list_item', 'ts_icons_list_item_func');
function ts_icons_list_item_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'type' => '',
	    'title' => ''
    ), $atts));
	
    global $shortcode_icons;

	$shortcode_icons[] = array(
		'type' => $type,
		'title' => $title,
		'content' => trim(do_shortcode($content))
	);
    return $shortcode_icons;
}