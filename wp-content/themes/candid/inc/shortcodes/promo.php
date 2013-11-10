<?php
/**
 * Shortcode Title: Promo
 * Shortcode: promo
 * Usage: [promo header="Header" content="Content" url="http://..." target="_self" image="sample.png"]
 */
add_shortcode('promo', 'ts_promo_func');

function ts_promo_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"header" => '',
		'content' => '',
		'url' => '',
		'target' => '',
		'image' => ''
		),
	$atts));

	$image_tag = '';
	if (!empty($image)) {
		$image_tag = ts_get_resized_image_by_size($image, 'promo',$header,'img_grayscale');
	}
	$content = "
		<div class='widget_out_stuff2 clearfix'>
			<article class='item-con-t1 blue-on-hover'>
				<div class='container-t1'>
					<div class='container-t1-margin'>
						<header>
						<div class='overlay tran03slinear'></div>
							<div class='bg-black-045 tran03slinear'></div>
							<h2>".$header."</h2>
							<p>".$content."</p>
						</header>
						".$image_tag."
						<div class='facilities'>
							<div class='image-links'>
								<a rel='' title='". $header ."' href='".$url."' target='".$target."'><span class='add'></span></a>
							</div>
						</div>
					</div>
				</div>
				<div class='blue-line visible-on-hover tran03slinear'></div>
			</article>
		</div>";

	return $content;
}