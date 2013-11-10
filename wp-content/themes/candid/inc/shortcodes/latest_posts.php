<?php
/**
 * Shortcode Title: Latest posts
 * Shortcode: latest_posts
 * Usage: [latest_posts header="Latest from the blog" description="Short description" url="http://url.."]
 */
add_shortcode('latest_posts', 'ts_latest_posts_func');

function ts_latest_posts_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"header" => '',
		"limit" => 10
		),
	$atts));

	if (!(int)$limit)
	{
		$limit = 10;
	}
	$rand = rand(1,1000);
	global $query_string, $post;
	$args = array(
		'posts_per_page'  => $limit,
		'offset'          => 0,
		'cat'        =>  '',
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'post',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );

	$content = '';

	$rand = rand(1,1000);

	if ( $the_query->have_posts() )
	{
		$embadded_video = '';
		$galleries = array();
		$list = '';
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();

			$media = '';
			$embadded_video = '';
			$show_overlay = true;
			if (get_post_format($post -> ID) == 'video')
			{
				$url = get_post_meta($post -> ID, 'video_url',true);
				if (!empty($url))
				{
					$embadded_video = ts_get_embaded_video($url);
				}
				else if (empty($url))
				{
					$embadded_video = get_post_meta($post -> ID, 'embedded_video',true);
				}
			}
			if (!empty($embadded_video))
			{
				$media = '<div class="post-img post-video">';
				$media .= '<div class="videoWrapper"><img src="'.get_bloginfo('template_directory').'/img/360x181.png" width="360" height="181" alt="">';
				$media .= $embadded_video;
				$media .= '</div>';
				$media .= '</div>';
				$media .= '<div class="clear"></div>';
				$show_overlay = false;
			}
			else if (get_post_format($post -> ID) == 'gallery')
			{
				$gallery = get_post_meta($post->ID, 'gallery_images',true);

				if (is_array($gallery) && count($gallery) > 0)
				{
					$rand2 = rand(1,1000);
					$media = '<div class="flexslider fs-inner latest-posts-gallery" id="flexslider-latest-posts-gallery-'.$post -> ID.'-'.$rand2.'">';
					$media .= '<ul class="slides-inner">';
					foreach ($gallery as $image)
					{
						$media .= '<li>'.ts_get_resized_image_by_size($image['image'], 'latest-posts', $image['title']).'</li>';
					}
					$media .= '</ul>';
					$media .= '</div>';
					$galleries[] = $post -> ID.'-'.$rand2;
					$show_overlay = false;
				}
				else
				{
					$media = ts_get_resized_post_thumbnail($post->ID,'latest-posts', get_the_title($post->ID));
				}
			}
			else if (has_post_thumbnail())
			{
				$media = ts_get_resized_post_thumbnail($post->ID,'latest-posts', get_the_title($post->ID));
			}
			$comments = get_comments_number();

			$list .= "
				<li>
					<article class='item'>";


			if (!empty($media))
			{
				$list .= "
						<div class='item-con-t1'>
							<div class='container-t1'>
								<div class='container-t1-margin'>
									".($show_overlay === true ? "
										<footer class='visible-on-hover'>
											<div class='bg-black-045'></div>
											<div class='widget_recent_posts_2-fac'>
												<div class='date'>
													<span>".get_the_time(get_option('date_format'))."</span>
												</div>
												<div class='category'>
													<span>
														".get_the_category_list( ', ', '', $post -> ID )."
													</span>
												</div>
											</div>
										</footer>
									":"")."
									".$media."
									".($show_overlay === true ? "
										<div class='facilities visible-on-hover'>
											<div class='bg-black-020'></div>
											<div class='image-links'>
												<a rel='' title='".esc_attr(get_the_title())."' href='".get_permalink()."'><span class='add'></span></a>
											</div>
										</div>
									":"")."
								</div>
							</div>
							<div class='blue-line visible-on-hover tran03slinear'></div>
						</div>";
			}
			$list .= "
						<div class='item-body'>
							<div class='item-helper'>
								<div class='avatar big'>
									".get_avatar( $post -> post_author, 71)."
								</div>
								<div class='post-comments'>
									<span>".$comments."</span>
								</div>
								<div class='post-author'>
									".__('By','circles')."
									<span>
										".get_the_author_link()."
									</span>
								</div>
							</div>
							<header>
								<a href='".get_permalink()."'><h2>".get_the_title()."</h2></a>
							</header>
						</div>
					</article>
				</li>";

		}
		$content = "
			<section class='widget widget_recent_posts_2'>
				<div class='grid_12'>
				<h2 class='title'>".$header."</h2>
				<div class='separator'>
					<div></div>
				</div>
				<div class='pagination'>
					<span id='flexslider-latest-posts-prev-".$rand."' class='prev-t1'></span>
					<span id='flexslider-latest-posts-next-".$rand."' class='next-t1'></span>
				</div>
					<div  id='flexslider-latest-posts-".$rand."' class='flexslider widget_recent_posts_2-container clearfix'>
						<ul class='slides'>".$list."</ul>
					</div>
				</div>
			</section>
			<script type='text/javascript'>
				jQuery(document).ready(function() {
					jQuery('#flexslider-latest-posts-".$rand."').flexslider({
						animation: 'slide',
						animationLoop: true,
						itemWidth: 320,
						itemMargin: 0,
						slideshow: false,
						controlNav: false,
						directionNav: false,
						minItems: 3,
						maxItems: 3,
						move: 1
					});

					jQuery('#flexslider-latest-posts-prev-".$rand."').click(function(){
						jQuery('#flexslider-latest-posts-".$rand."').flexslider('prev');
					});

					jQuery('#flexslider-latest-posts-next-".$rand."').click(function(){
						jQuery('#flexslider-latest-posts-".$rand."').flexslider('next');
					});
				});
			</script>";

		if (is_array($galleries) && count($galleries) > 0)
		{
			foreach ($galleries as $gallery)
			{
				$content .= '
					<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery("#flexslider-latest-posts-gallery-'.$gallery.'").flexslider({
								selector: ".slides-inner > li",
								animation: "slide",
								animationLoop: true,
								controlNav: false,
								slideshowSpeed: 3000,
								prevText: "'.ts_get_prev_slider_text().'",
								nextText: "'.ts_get_next_slider_text().'"
							});
						});
					</script>';
			}
		}
	}
	// Restor original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();
	return $content;
}