<?php
/**
 * Shortcode Title: Icon
 * Shortcode: icon
 * Usage: [icon icon="img-1" icon_upload="" animation="showup" title="Your title" content="Your content here..."]

 */
add_shortcode('icon', 'ts_icon_func');

function ts_icon_func( $atts, $_content = null ) {

	extract(shortcode_atts(array(
		'icon' => 'img-1',
		'icon_upload' => '',
		'title' => '',
		'content' => '',
		'animation' => '',
		'url' => '',
		'target' => '_self'
	),
	$atts));

	$animation_class = '';
	switch ($animation) {
		case 'showup':
			$animation_class = 'animated';
			break;
	}
	
	if ($icon == 'none') {
		$icon = '';
	}
	
	$icon_upload_html = '';
	if (!empty($icon_upload)) {
		$icon_upload_html = 'style="background-image: url('.$icon_upload.'); background-repeat: no-repeat; background-position: center center"';
	}

	$html = '
		<article class="why-choose-us">
			<a '.(empty($url) ? '' : 'href="'.$url.'" target="'.$target.'"').'>
				<div class="why-choose-us-img '.$icon.' '.$animation_class.'">
					<span></span>
					<span class="tran03slinear"></span>
					<span '.$icon_upload_html.'></span>
				</div>
				<h2 class="tran03slinear">'.$title.'</h2>
			</a>
			'.$content.'
		</article>';
	return $html;

}