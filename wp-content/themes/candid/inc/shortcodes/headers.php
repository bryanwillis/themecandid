<?php
// Shortcode Title: Heading
// Shortcode: heading
// Usage: [heading type="1"]text...[/header]
function ts_heading_func($atts, $content = null )
{
	extract(shortcode_atts(array(
	    'type' => 1,
    ), $atts));
	
	if (intval($type) < 1 || intval($type) > 6)
	{
		$type = 1;
	}
	return '<h'.$type.'>'.do_shortcode($content).'</h'.$type.'>';
}
add_shortcode('heading', 'ts_heading_func');

// Shortcode Title: H1
// Shortcode: H1
// Usage: [H1]text...[/H1]
function ts_h1_func($atts, $content = null )
{
	$content = do_shortcode($content);
	return '<h1>'.$content.'</h1>';
}
add_shortcode('H1', 'ts_h1_func');
add_shortcode('h1', 'ts_h1_func');

// Shortcode Title: H2
// Shortcode: H2
// Usage: [H2]text...[/H2]
function ts_h2_func($atts, $content = null )
{
	$content = do_shortcode($content);
	return '<h2>'.$content.'</h2>';
}
add_shortcode('H2', 'ts_h2_func');
add_shortcode('h2', 'ts_h2_func');

// Shortcode Title: H3
// Shortcode: H3
// Usage: [H3]text...[/H3]
function ts_h3_func($atts, $content = null )
{
	$content = do_shortcode($content);
	return '<h3>'.$content.'</h3>';
}
add_shortcode('H3', 'ts_h3_func');
add_shortcode('h3', 'ts_h3_func');

// Shortcode Title: H4
// Shortcode: H4
// Usage: [H4]text...[/H4]
function ts_h4_func($atts, $content = null )
{
	$content = do_shortcode($content);
	return '<h4>'.$content.'</h4>';
}
add_shortcode('H4', 'ts_h4_func');
add_shortcode('h4', 'ts_h4_func');

// Shortcode Title: H5
// Shortcode: H5
// Usage: [H5]text...[/H5]
function ts_h5_func($atts, $content = null )
{
	$content = do_shortcode($content);
	return '<h5>'.$content.'</h5>';
}
add_shortcode('H5', 'ts_h5_func');
add_shortcode('h5', 'ts_h5_func');