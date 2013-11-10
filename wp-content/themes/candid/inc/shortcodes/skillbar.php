<?php
/**
 * Shortcode Title: Images slider
 * Shortcode: images_slider
 * Usage: [skillbar type="horizontal"][skillbar_item percentage="80" title="Cooking"][skillbar_item percentage="99" title="Sleeping"][/skillbar]
 * Options: action="url/open"
 */
add_shortcode('skillbar', 'ts_skillbar_func');
function ts_skillbar_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => '1',
		'type' => 'horizontal',
	    'height' => 100,
    ), $atts));
	
	global $shortcode_skillbar_style, $shortcode_skillbar_type, $shortcode_skillbar_height;
	
	$shortcode_skillbar_style = $style;
	$shortcode_skillbar_type = $type;
	$shortcode_skillbar_height = $height;
	if ((int)$shortcode_skillbar_height < 1)
	{
		$shortcode_skillbar_height = 100;
	}
	return do_shortcode($content).'<div class="clear"></div>';
}

/**
 * Shortcode Title: Skill Bar 
 * Shortcode: bar
 * Usage: [skillbar_item percentage="80" title="Cooking"][skillbar_item percentage="99" title="Sleeping"]
 */
add_shortcode('skillbar_item', 'ts_skillbar_item_func');
function ts_skillbar_item_func( $atts, $content = null ) {
	extract(shortcode_atts(array(
	    'percentage' => 0,
	    'title' => '',
	    'height' => 0,
		'color' => ''
    ), $atts));
	
	if ((int)$percentage > 100)
	{
		$percentage = 100;
	}
	else if ((int)$percentage < 1)
	{
		$percentage = 1;
	}
	
	global $shortcode_skillbar_style, $shortcode_skillbar_type, $shortcode_skillbar_height;
	
	if ($shortcode_skillbar_type == 'vertical')
	{
		return '
			<div class="sc-skillbar-vertical">
				<div class="sc-skillbar-bar" data-percentage="'.(int)$percentage.'" data-color="'.$color.'" style="height: '.$shortcode_skillbar_height.'px"></div>
				<div class="sc-skillbar-title">'.$title.'</div>
			</div>';
	}
	else
	{
		return '
			<div class="sc-skillbar '.($shortcode_skillbar_style == 2 ? 'sc-skillbar-style-2' : '').'">
				<div class="sc-skillbar-title">'.$title.'</div>
				<div class="sc-skillbar-bar" data-percentage="'.(int)$percentage.'" data-color="'.$color.'"></div>
			</div>';
	}
	
}