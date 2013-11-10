<?php
/**
 * Shortcode Title: Button
 * Shortcode: button
 * Usage: [button color="#555555" background="#AFAFAF" size="small" url="http://yourdomain.com" target="_blank" ]Your content here...[/button]
 */
add_shortcode('button', 'ts_button_func');

function ts_button_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"style" => '',
		"color" => '',
		"url" => '',
		'size' => 'regular',
		'icon' => '',
		'target' => '_self'
		),
	$atts));

	if (empty($url))
	{
		$url = '#';
	}

	switch ($size)
	{
		case 'small':
			break;
		case 'large':
			$size = 'big';
			break;
		case 'regular':
		default:
			$size = 'mid';
			break;
	}
	$button_class = 'btn';
	if ($style == 2) {
		$button_class = 'btn-style2';
		
		if (!empty($icon) && $icon != 'no') {
			$button_class .= ' '.$icon;
		}
	}
	else if ($style == 3) {
		$button_class = 'btn-style3';
		
		if (!empty($icon) && $icon != 'no') {
			$button_class .= ' '.$icon;
		}
	}

	return '<a class="'.$button_class.' '.$size.' " href="'.$url.'" target="'.$target.'" style="'.(!empty($color) ? 'color:'.$color.';': '').'">'.$content.'</a>';
}