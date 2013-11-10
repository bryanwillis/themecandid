<?php
/**
 * Shortcode Title: Posts Slider
 * Shortcode: posts_slider
 * Usage: [posts_slider id=x]
 */
add_shortcode('posts_slider', 'ts_posts_slider_func');

function ts_posts_slider_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"id" => "",
		"post_type" => "post",
		"category" => "",
		"limit" => 10,
		"orderby" => "date",
		"order" => "desc",
		"description" => "excerpt",
		"excerpt" => 0
		),
	$atts));

	switch ($order)
	{
		case 'asc':
		case 'ASC':
			$order = 'ASC';
			break;

		case 'desc':
		case 'DESC':
		default:
			$order = 'DESC';
			break;
	}
	$post_ids = array();
	if (!empty($id))
	{
		$post_ids = explode(',',$id);
	}

	global $query_string, $post;
	$args = array(
		'posts_per_page'  => $limit,
		'offset'          => 0,
		'cat'        	  =>  $category,
		'orderby'         => $orderby,
		'order'           => $order,
		'post__in'         => $post_ids,
		'post_type'       => $post_type,
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );

	$content = '';

	if ( $the_query->have_posts() )
	{
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();

			$content .= '<li>';
			$content .= '<article class="post link left post-slider">';

			$embadded_video = '';
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
				$content .= '<div class="videoWrapper"><img src="'.get_bloginfo("template_directory").'/img/img16_9.png" alt=""/>';
				$content .= $embadded_video;
				$content .= '</div>';
			}
			else
			{
				$content .= ts_get_resized_post_thumbnail_sidebar($post->ID,array('full', 'one-sidebar', 'two-sidebars'));
			}

			$comments = get_comments_number();

			switch ($comments)
			{
				case 0:
					$comments_msg = __('No comments','circles');
					break;

				case 1:
					$comments_msg = __('1 Comment','circles');
					break;

				default:
					$comments_msg = sprintf(__('%s Comments','circles'),$comments);
					break;
			}

			$content .= '
				<header>
					<a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a>
				</header>
				<footer>
					<div class="post-helper-absolute">
						<div class="post-day-aside">
							<span>'.get_the_time('d').'</span>
						</div>
						<div class="post-month-aside">
							<span>'.get_the_time('M').', '.get_the_time('Y').'</span>
						</div>
					</div>
					<div class="post-author inline">
						By
						<span>
							'.get_the_author_link().'
						</span>
					</div>
					<div class="post-category">
						<span>
							'.get_the_category_list( ', ', '', $post -> ID ).'
						</span>
					</div>
					<div class="post-comments inline">
						<span><a href="'.  get_permalink().'#comments">'.$comments_msg.'</a></span>
					</div>
				</footer>';

			if ($description == 'excerpt')
			{
				$excerpt_limit = 'regular';
				if ((int)$excerpt)
				{
					$excerpt_limit = $excerpt;
				}

				$content .= '
					<div class="post-body-text">
						<p>'.ts_get_the_excerpt_theme($excerpt_limit).' <a href="'.get_permalink().'" title="'.esc_attr( get_the_title() ).'" class="read-more">'.__( 'read more', 'circles' ).'</a></p>
					</div>';
			}
			$content .= '</article>';
			$content .= '</li>';
		}
	}
	$rand = rand(1,5000);

	$content = '
		<div class="flexslider flexslider-posts-slider  images-slider" id="flexslider-posts-slider-'.$rand.'">
			<ul class="slides">
				'.$content.'
			</ul>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
			  jQuery("#flexslider-posts-slider-'.$rand.'").flexslider({
				animation: "slide",
				controlNav: false,
				prevText: "'.ts_get_prev_slider_text().'",
				nextText: "'.ts_get_next_slider_text().'"
			  });
			});
		</script>';

	// Restore original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();
	return $content;
}