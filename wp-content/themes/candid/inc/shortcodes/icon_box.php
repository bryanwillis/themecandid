<?php
/**
 * Shortcode Title: Icon Box
 * Shortcode: icon_box
 * Usage: [icon type="icon-bullhorn" size="icon-large" color="" title=""]Your content here...[/icon]

 */
add_shortcode('icon_box', 'ts_icon_box_func');

function ts_icon_box_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'icon' => '',
		'title' => '',
		'url' => '',
		'target' => '_self'
	),
	$atts));

	$html = '
		<article class="service service-style2">
           <div class="service-icon ">
              <a '.(empty($url) ? 'href="#"' : 'href="'.$url.'" target="'.$target.'"').'><span class="'.$icon.'"></span></a>
              <div></div>
            </div>
			<h2 class="tran03slinear">'.$title.'</h2>
            '.$content.'
            <a class="read-more" '.(empty($url) ? 'href="#"' : 'href="'.$url.'" target="'.$target.'"').'>More info</a>
        </article>';
	return $html;

}