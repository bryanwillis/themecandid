<?php
/**
 * Shortcode Title: Image
 * Shortcode: image
 * Usage: [image link="http://url.com"]image.jpg[/image]
 */
add_shortcode('image', 'image_func');

function image_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		'animation' => '',
		'size' => '',
		'align' => ''
		), 
	$atts));
	
	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$content = str_replace('&#215;','x',$content);
		
	$class = 'wp-post-image animated '.$align.' '.$animation.' '.$size;
	switch ($size) {
		case 'full':
			return ts_get_resized_image_sidebar($content,array('full','one-sidebar','two-sidebars'), '', $class);
			break;
		
		case 'half':
			return ts_get_resized_image_sidebar($content,array('half-full','half-one-sidebar','half-two-sidebars'), '', $class);
			break;
		
		case 'one_third':
			return ts_get_resized_image_sidebar($content,array('third-full','third-one-sidebar','third-two-sidebars'), '', $class);
			break;
		
		case 'one_fourth':
			return ts_get_resized_image_sidebar($content,array('fourth-full','fourth-one-sidebar','fourth-two-sidebars'), '', $class);
			break;
		
		default:
			return '<img src="'.$content.'" class="'.$class.'" alt="">';
			break;
	}
	
	
}