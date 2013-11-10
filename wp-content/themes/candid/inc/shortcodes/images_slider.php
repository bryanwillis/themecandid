<?php
/**
 * Shortcode Title: Images slider
 * Shortcode: images_slider
 * Usage: [images_slider][image_item url="http://test.com" target="_blank"]image.png[/image_item][/images_slider]
 * Options: action="url/open"
 */
add_shortcode('images_slider', 'ts_images_slider_func');

function ts_images_slider_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'action' => '',
    ), $atts));
	$rand = rand(15000,50000);
	return "
		<div class='flexslider images-slider' id='flexslider-".$rand."'>
			<ul class='slides'>".do_shortcode(shortcode_unautop($content))."</ul>
		</div>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
			  jQuery('#flexslider-".$rand."').flexslider({
				slideshow: true,              
				slideshowSpeed: 7000,
				animation: 'slide',
				controlNav: false,
				prevText: \"".ts_get_prev_slider_text()."\",
				nextText: \"".ts_get_next_slider_text()."\"
			  });
			});
		</script>";
}

/**
 * Shortcode Title: Image item - can be used only with images_slider shortcode
 * Shortcode: image_item
 * Usage: [image_slider action="url"][image_item url="http://test.com"]image.png[/image_item][/images_slider]
 * Options: action="url/open"
 */
add_shortcode('image_item', 'image_item_func');
function image_item_func( $atts, $content = null )
{
	 extract(shortcode_atts(array(
	    'url' => '',
	    'target' => '',
    ), $atts));

	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$content = str_replace('&#215;','x',$content);

	$item = '<li>';
	$image = $content;
	$image = ts_get_resized_image_sidebar($image, array('full', 'one-sidebar', 'two-sidebars'));
	if (!empty($url))
	{
		$item .= '<a href="'.$url.'" '.(!empty($target) ? 'target="'.$target.'"':'').'>'.$image.'</a>';
	}
	else
	{
		$item .= $image;
	}

	$item .= '</li>';

	return $item;
}