<?php
/**
 * Shortcode Title: Testimonials
 * Shortcode: testimonials
 * Usage: [testimonials type="static" category="3" limit="3"]
 */
add_shortcode('testimonials', 'ts_testimonials_func');

function ts_testimonials_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"type" => 'slider',
		"category" => '',
		"limit" => "2",
		"title" => ""
		),
	$atts));

	global $query_string, $post;
	$args = array(
		'posts_per_page'  => $limit,
		'offset'          => 0,
		'cat'        =>  $category,
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'testimonials-widget',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );

	$content = '';

	if ( $the_query->have_posts() )
	{
		global $post;

		while ( $the_query->have_posts() )
		{
			$the_query->the_post();

			$widget_title = get_post_meta($post->ID, 'testimonials-widget-title', true);
			$email = get_post_meta($post->ID, 'testimonials-widget-email', true);
			$company = get_post_meta($post->ID, 'testimonials-widget-company', true);
			$url = get_post_meta($post->ID, 'testimonials-widget-url', true);
			$author = get_the_title($post -> ID);

			if (!empty($email))
			{
				$author = '<a class="author" href="mailto:'.$email.'">'.$author.'</a>';
			}
			else
			{
				$author = '<div class="author">'.$author.'</div>';
			}

			if (!empty($company))
			{
				if (!empty($url))
				{
					$company = '<a href="'.$url.'" target="_blank">'.(!empty($widget_title) ? ', ' : '').$company.'</a>';
				}
			}

			$post_content = stripslashes($post -> post_content);

			if ($type == 'slider2')
			{
				$item = '
					<article class="item">
						<div class="item-helper">
							<div class="avatar">
								'.ts_get_resized_post_thumbnail($post->ID,'author', get_the_title($post->ID)).'
							</div>
							'.$author.'
							<span class="info">'.$widget_title.$company.'</span>
						</div>
						<div class="item-body">
							<div class="quote">
								<span class="helper"></span>
								'.$post_content.'
							</div>
						</div>
					</article>';
			}
			else
			{
				$author .= '<span>'.$widget_title.' '.$company.'</span>';

				$item = '
					<article>
						<div class="container-t1">
							<div class="quote">
								<p>'.$post_content.'</p>
								<div class="helper"></div>
							</div>
						</div>
						<header>
							'.$author.'
						</header>
					</article>';
			}
			if ($type == 'static')
			{
				$content .= $item;
			}
			else
			{
				$content .= '<li>'.$item.'</li>';
			}
		}

	}
	// Restor original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();
	if ($type == 'static')
	{
		return '
			<section class="widget_testimonials_2">
				'.$content.'
			</section>';
	}
	if ($type == 'slider2')
	{
		$rand = rand(1,5000);
		return '
			<div class="widget_testimonials-container sss clearfix flexslider" id="flexslider-testimonials-'.$rand.'">
				<header>
					<h2>'.$title.'</h2>
				</header>
				<ul class="slides">
					'.$content.'
				</ul>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#flexslider-testimonials-'.$rand.'").flexslider({
						animation: "slide",
						controlNav: false
					});

				});
			</script>';
	}
	else
	{
		$rand = rand(1,5000);
		return '
			<div class="flexslider-testimonials ss widget_testimonials_2"> 
				<div class="flexslider testimonials-slider" id="flexslider-testimonials-'.$rand.'">
					<ul class="slides">
						'.$content.'
					</ul>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#flexslider-testimonials-'.$rand.'").flexslider({
						     animation: "slide",
                            controlNav: false,
                            directionNav: true,
                            itemWidth: 200,
                            itemMargin: 0,
                            minItems: 1,
                            maxItems: 1,
                            move:1
					});

				});
			</script>';
	}
}