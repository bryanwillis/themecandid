<?php
/**
 * Shortcode Title: Icons
 * Shortcode: icons
 * Usage: [icons][icon type="icon-music" url="http://..." title="Your title..."]Your content...[/icon][/icons]
 */
add_shortcode('icons', 'ts_icons_func');

function ts_icons_func( $atts, $content = null ) {

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

		$item_icon = '';
		$item_fontawesome_icon = '';
		switch ($icon['type'])
		{
			case 'img-1':
			case 'img-2':
			case 'img-3':
			case 'champion':
			case 'function':
			case 'leaf':
			case 'light':
			case 'settings':
			case 'show':
			case 'time':
				$item_icon = $icon['type'];
				break;
			case 'no':
				break;
			default:
				$item_fontawesome_icon = '<i class="'.$icon['type'].'"></i>';
		}
		$icons_content .= "
			<section class='grid_4'>
				<a href='".$icon['url']."'><h2 class='tran03slinear'>".$icon['title']."</h2>";

		if (!empty($item_icon))
		{
			$icons_content .= "
					<div class='advantages-img ".$item_icon." ".$animation_class."'>
						<span></span>
						<span class='tran03slinear'></span>
						<span></span>
					</div>";
		}
		else if (!empty($item_fontawesome_icon))
		{
			$icons_content .= "
					<div class='advantages-img font-icon ".$animation_class."'>
						<span></span>
						<span class='tran03slinear'></span>
						<span></span>
						".$item_fontawesome_icon."
					</div>";
		}

		$icons_content .= "
				</a>
				<div class='icon-content'>".$icon['content']."</div>
			</section>
		";
	}
    $shortcode_icons = array();

	$content = "
		<div class='advantages'>
			".$icons_content."
		</div>";

	return $content;
}

/**
 * Shortcode Title: Icon - can be used only with icons shortcode
 * Shortcode: icon
 * Usage: [icons][icon label="New 1"]Your text here...[/icon][/icons]
 * Options: action="url/open"
 */
add_shortcode('icon_item', 'ts_icon_item_func');
function ts_icon_item_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'type' => '',
	    'url' => '',
	    'target' => '_self',
	    'title' => ''
    ), $atts));
    global $shortcode_icons;

	$shortcode_icons[] = array(
		'type' => $type,
		'url' => $url,
		'target' => $target,
		'title' => $title,
		'content' => trim(do_shortcode($content))
	);
    return $shortcode_icons;
}