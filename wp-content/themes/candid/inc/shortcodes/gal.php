<?php
/**
 * Shortcode Title: Gallery
 * Shortcode: gal
 * Usage: [gal][gal_item url="http://test.com" target="_blank"]image.png[/gal_item][/gal]
 */
add_shortcode('gal', 'ts_gal_func');

function ts_gal_func( $atts, $content = null ) {

	global $gal_id, $gal_zoom, $gal_items, $gal_thumb_items;

	extract(shortcode_atts(array(
	    'zoom' => '',
    ), $atts));

	$gal_zoom = false;
	if ($zoom == 'enabled') {
		$gal_zoom = true;
	}

	$gal_items = array();
	$gal_thumb_items = array();

	do_shortcode(shortcode_unautop($content));

	if (count($gal_items) == 0 || count($gal_thumb_items) == 0) {
		return '';
	}

	$rand1 = rand(1,1000).'1';
	$rand2 = rand(1,1000).'2';

	$gal_id = $rand1;

	return '
		<div class="flexslider gallery-slider" id="flexslider-'.$rand1.'">
          <ul class="slides">
			'.implode("\n",$gal_items).'
          </ul>
        </div>
        <div class="flexslider thumbnail-slider" id="flexslider-'.$rand2.'">
          <ul class="slides">
            '.implode("\n",$gal_thumb_items).'
          </ul>
        </div>
		<script type="text/javascript">
          jQuery(document).ready(function() {
            jQuery("#flexslider-'.$rand2.'").flexslider({
            slideshow: false,
            slideshowSpeed: 7000,
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            itemWidth: 50,
            itemMargin: 15,
            asNavFor: "#flexslider-'.$rand1.'"
            });
          });
        </script>
        <script type="text/javascript">
          jQuery(document).ready(function() {
            jQuery("#flexslider-'.$rand1.'").flexslider({
            slideshow: false,
            slideshowSpeed: 7000,
            animationLoop: false,
            directionNav: false,
            animationSpeed: 100,
            animation: "fade",
            controlNav: false,
            sync: "#flexslider-'.$rand2.'"
            });
          });
        </script>';
}

/**
 * Shortcode Title: Gallery item - can be used only with gal shortcode
 * Shortcode: gal_item
 * Usage: [gal zoom="enabled"][gal_item tooltip="Your text here..."]image.png[/gal_item][/gal]
 */
add_shortcode('gal_item', 'gal_item_func');
function gal_item_func( $atts, $content = null )
{
	global $gal_id, $gal_zoom, $gal_items, $gal_thumb_items;

	extract(shortcode_atts(array(
	    'tooltip' => '',
    ), $atts));

	$item_a1 = '';
	$item_a2 = '';
	if (isset($gal_zoom) && $gal_zoom === true) {
		$item_a1 = '<a class="gallery-image" href="'.$content.'" rel="prettyPhoto[gallery-'.$gal_id.']" title="'.$tooltip.'">';
		$item_a2 = '<span></span></a>';
	}
	$thumb_item_a1 = $thumb_item_a1 = '<a class="gallery-thumb"><div>';
	$thumb_item_a2 = '</div></a>';
	if (!empty($tooltip)) {
		$thumb_item_a1 = '<a class="gallery-thumb tooltip" title="'.$tooltip.'"><div>';
		$thumb_item_a2 = '</div></a>';
	}

	$gal_items[] = '<li>'.$item_a1.ts_get_resized_image_sidebar($content, array('full', 'one-sidebar', 'two-sidebars')).$item_a2.'</li>';
	$gal_thumb_items[] = '<li>'.$thumb_item_a1.ts_get_resized_image_sidebar($content, array('full-gal-thumb', 'one-sidebar-gal-thumb', 'two-sidebars-gal-thumb'),'','animated bottom-to-top-full').$thumb_item_a2.'</li>';
}