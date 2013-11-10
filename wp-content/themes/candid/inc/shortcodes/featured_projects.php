<?php
/**
 * Shortcode Title: Recent projects
 * Shortcode: recent_projects
 * Usage: [recent_projects]
 */
add_shortcode('featured_projects', 'ts_featured_projects_func');

function ts_featured_projects_func( $atts, $content = null ) {
	
	global $post;
	
    extract(shortcode_atts(array(
		'header' => '',
		'category' => '',
		'limit' => 10,
		),
	$atts));

	$html = '';
	$args = array(
		'numberposts'     => "",
		'posts_per_page'  => $limit,
		'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
		'offset'          => 0,
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
	
	if (!empty($category)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio-categories',
				'field' => 'id',
				'terms' => explode(',',$category)
			),
		);
	}
	
	$the_query = new WP_Query( $args );
	
	if ( $the_query->have_posts() )
	{
		$list = '';
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();
			if (has_post_thumbnail($post->ID))
			{
				$image = ts_get_resized_post_thumbnail($post->ID,'featured-projects',get_the_title());
			}
			else
			{
				continue;
			}

			$terms = strip_tags(get_the_term_list( $post->ID, 'portfolio-categories', '', ' ', '' ));
			
			$a1 = '<a rel="" title="'.esc_attr(get_the_title()).'" href="'.get_permalink().'">';
			$a2 = '</a>';
			
			$list .= '
				<li>
					<article class="featured-project">
					  '.$a1.$image.$a2.'
					  <div class="project-body">
						'.$a1.'
							<h2>'.ts_get_shortened_string_by_letters(get_the_title(),20,true).'</h2>
							<h3>'.$terms.'</h3>
						'.$a2.'
						<span class="likes icon-heart" data-post-id="'.$post -> ID.'">'.ts_get_theme_likes($post -> ID).'</span>
					  </div>
					</article>
				</li>';
		}
		if (!empty($list))
		{
			$rand = rand(1,10000);
			
			$html = '
				<div class="featured-projects">
					<div class="sc-divider sc-divider-center sc-divider-normal"><div class="sc-divider-text">'.$header.'</div></div>
					'.$content.'
					<div class="pagination">
					  <span id="flexslider-featured-projects-prev-'.$rand.'" class="prev-t1"></span>
					  <span id="flexslider-featured-projects-next-'.$rand.'" class="next-t1"></span>
					</div>
					<div id="flexslider-featured-projects-'.$rand.'" class="flexslider featured-project-slider">
					  <ul class="slides">
						'.$list.'
					  </ul>
					</div>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function() {
					  jQuery("#flexslider-featured-projects-'.$rand.'").flexslider({
						animation: "slide",
						animationLoop: true,
						itemWidth: 320,
						itemMargin: 0,
						slideshow: false,
						controlNav: false,
						directionNav: false,
						minItems: 4,
						maxItems: 4,
						move: 1
					  });

					  jQuery("#flexslider-featured-projects-prev-'.$rand.'").click(function(){
						jQuery("#flexslider-featured-projects-'.$rand.'").flexslider("prev");
					  });

					  jQuery("#flexslider-featured-projects-next-'.$rand.'").click(function(){
						jQuery("#flexslider-featured-projects-'.$rand.'").flexslider("next");
					  });
					});
				  </script>';
		}
		// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();
	}
	return $html;
}