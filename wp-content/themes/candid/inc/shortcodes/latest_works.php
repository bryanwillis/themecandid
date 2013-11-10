<?php
/**
 * Shortcode Title: Latest works
 * Shortcode: latest_works
 * Usage: [latest_works header="Latest Works" description="..." limit=10]
 */
add_shortcode('latest_works', 'ts_latest_works_func');

function ts_latest_works_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"header" => __('Latest Works','framework'),
		"description" => '',
		"limit" => 10
		),
	$atts));
	$rand = rand(1,1000);
	global $query_string, $post;
	$args = array(
		'numberposts'     => "",
		'posts_per_page'  => $limit,
		'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
		'offset'          => 0,
		'cat'        =>  '',
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'portfolio',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() )
	{
		$list = '';
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();
			if (has_post_thumbnail($post->ID))
			{
				$image = ts_get_resized_post_thumbnail($post->ID,'latest-works',get_the_title());
				$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

				if (!isset($image_src[0]))
				{
					$image_src = array();
					$image_src[0] = '#';
				}
			}
			else
			{
				continue;
			}

			$terms = strip_tags(get_the_term_list( $post->ID, 'portfolio-categories', '', ' ', '' ));

			$gallery_html = '';
			$title = get_the_title();
			switch (get_post_format())
			{
				case 'gallery':
					$gallery = get_post_meta($post->ID, 'gallery_images',true);
					if (is_array($gallery) && count($gallery) > 0)
					{
						foreach ($gallery as $key => $val)
						{
							if ($key == 0)
							{
								$title = $val['title'];
								$prettyPhotoContent = $val['image'];
							}
							else
							{
								$gallery_html .= '<a rel="prettyPhoto[gallery-'.$post->ID.']" href="'.$val['image'].'" title="'.  esc_attr($val['title']).'"></a>';
							}
						}
					}
					$icon = 'format-gallery';
					$rel = 'prettyPhoto[gallery-'.$post->ID.']';
					break;

				case 'video':
					$prettyPhotoContent = get_post_meta($post -> ID, 'video_url', true);
					$icon = 'video';
					$rel = 'prettyPhoto';
					break;

				default:
					$prettyPhotoContent = $image_src[0];
					$icon = 'zoom';
					$rel = 'prettyPhoto';
			}

			$list .= "
				<li>
					<article class='item-con-t1'>
						<div class='container-t1'>
							<div class='container-t1-margin'>
								<header>
									<div class='bg-black-045'></div>
									<h2>".get_the_title()."</h2>
									<h3>".$terms."</h3>
								</header>
								".$image."
								<div class='facilities visible-on-hover'>
									<div class='bg-black-045'></div>
									<div class='image-links'>
										<a rel='".$rel."' title='".esc_attr($title)."' href='".$prettyPhotoContent."'><span class='".$icon."'></span></a>
										<a title='".esc_attr(get_the_title())."' href='".get_permalink()."'><span class='link'></span></a>
									</div>
								</div>
								".$gallery_html."
							</div>
						</div>
						<div class='blue-line visible-on-hover tran03slinear'></div>
					</article>
				</li>";
		}
		if (!empty($list))
		{
			$content = "
				<section class='widget widget_recent_works'>
					<div class='grid_3'>
						<h2>".$header."</h2>
						<p>".$description."</p>
						<span id='flexslider-latest-works-prev-".$rand."' class='prev-t1'></span>
						<span id='flexslider-latest-works-next-".$rand."' class='next-t1'></span>
					</div>
					<div class='grid_9'>
						<div class='flexslider widget_recent_works-container clearfix' id='flexslider-latest-works-".$rand."'>
							<ul class='slides'>".$list."</ul>
						</div>
					</div>
				</section>";

			$content .= '
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#flexslider-latest-works-'.$rand.'").flexslider({
						animation: "slide",
						animationLoop: true,
						itemWidth: 250,
						itemMargin: 0,
						slideshow: false,
						controlNav: false,
						directionNav: false,
						minItems: 1,
						maxItems:3,
						move: 1
					});

					jQuery("#flexslider-latest-works-prev-'.$rand.'").click(function(){
						jQuery("#flexslider-latest-works-'.$rand.'").flexslider("prev");
					});

					jQuery("#flexslider-latest-works-next-'.$rand.'").click(function(){
						jQuery("#flexslider-latest-works-'.$rand.'").flexslider("next");
					});
				});
			</script>
			';

		}
		// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();
	}
	return $content;
}