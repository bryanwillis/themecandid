<?php
/**
 * Shortcode Title: Teaser 2
 * Shortcode: teaser 2
 * Usage: [teaser_2 image="image.png" title="Your title" button="Click me" url="http://..." target="_self"]Your content..[/teaser_2]
 */
add_shortcode('teaser_2', 'ts_teaser_2_func');

function ts_teaser_2_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"button" => '',
		"url" => '',
		"target" => '_self'
		),
	$atts));

	$button_html = '';
	if (!empty($url))
	{
		$button_html = '<a href="'.$url.'" target="'.$target.'" class="sc-button grey-grad">'.$button.'</a>';
	}

	$html = '
		<div class="widget_testimonials-container clearfix">
			<article class="item">
				<header>
					<h2>'.$title.'</h2>
				</header>
				<div class="item-helper">
					<div class="avatar big">
						'.ts_get_resized_image_by_size($image, 'teaser_2').'
					</div>
				</div>
				<div class="item-body">
					'.$content.'
					'.$button_html.'
				</div>
			</article>
		</div>';

	return $html;
}