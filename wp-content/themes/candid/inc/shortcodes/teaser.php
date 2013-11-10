<?php
/**
 * Shortcode Title: Teaser
 * Shortcode: teaser
 * Usage: [teaser image="image.png"]Your text here...[/quotes]
 */
add_shortcode('teaser', 'ts_teaser_func');

function ts_teaser_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		"style" => '1',
		"image" => '',
		"icon" => '',
		"title" => '',
		"subtitle" => '',
		"url" => '',
		"target" => '_self',
		),
	$atts));

	$url_1 = '';
	$url_2 = '';
	if (!empty($url))
	{
		$url_1 = '<a href="'.$url.'" target="'.$target.'">';
		$url_2 = '</a>';
	}

	switch ($style)
	{
		case '1':
			return '
				<article class="teaser style1">
					<div>
						'.  ts_get_resized_image_by_size($image, 'teaser').'
						'.$url_1.'
							<header class="teaser-hover blue-grad">
								<h2>'.$title.'</h2>
								<h3>'.$subtitle.'</h3>
							</header>
						'.$url_2.'
					</div>
				</article>
			';
			break;

		case '2':
			return '
				<article class="teaser style2">
					<div>
						'.  ts_get_resized_image_by_size($image, 'teaser').'
						<header class="teaser-hover">
							<h2>'.$title.'</h2>
							<h3>'.$subtitle.'</h3>
							<div>'.$url_1.'<span>+</span>'.$url_2.'</div>
						</header>
					</div>
				</article>';
			break;

		case '3':
			return '
				<article class="teaser style3 small">
					'.$url_1.'
						<div>
							'.  ts_get_resized_image_by_size($image, 'teaser-small').'
							<div class="bg-black-045"></div>
							<div class="teaser-bg teaser-hover blue-grad"></div>
						</div>
						<header>
							'.(!empty($icon) ? '<img src="'.get_template_directory_uri().'/img/'.$icon.'">' : '').'
							<h2>'.$title.'</h2>
						</header>
					'.$url_2.'
				</article>';
			break;

		case '4':
			return '
				<article class="teaser style4 small">
					<div>
						'.  ts_get_resized_image_by_size($image, 'teaser-small').'
						<a class="teaser-icon" href="'.$url.'" target="'.$target.'">
							<div class="advantages-img img-1">
								<span></span>
								<span class="tran03slinear"></span>
								'.(!empty($icon) ? '<img src="'.get_template_directory_uri().'/img/'.$icon.'">' : '').'
							</div>
						</a>
						</div>
						<header>
							<h2>'.$title.'</h2>
						</header>
				</article>';

		case '5':

			return '
				<div class="widget_out_stuff-container clearfix">
					<article class="item-con-t1 tran03slinear">
						'.$url_1.'
							<div class="container-t1">
									<header class="tran03slinear">
										<img src="'.get_template_directory_uri().'/img/member-bg.png" alt="">
										<h2>'.$title.'</h2>
										<h3>'.$subtitle.'</h3>
									</header>
									'.  ts_get_resized_image_by_size($image, 'teaser-small').'
							</div>
						'.$url_2.'
						<span class="corner tran03slinear"></span>
					</article>
				</div>';

			break;
	}


}