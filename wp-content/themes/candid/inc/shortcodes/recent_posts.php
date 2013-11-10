<?php
/**
 * Shortcode Title: Recent posts
 * Shortcode: recent_posts
 * Usage: [recent_posts header="Latest from the blog" limit="12"]
 */
add_shortcode('recent_posts', 'ts_recent_posts_func');

function ts_recent_posts_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
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
	
	if ( $the_query->have_posts() )
	{
		
		$list = '';
		$i = 0;
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();
			
			
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
			
			if ($i > 0)
			{
				$list .= '<div class="separator"></div>';
			}
			
			$list .= '
				<article class="post link left">
					<header>
							<a href="'.get_permalink().'"><h2>'.  get_the_title().'</h2></a>
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
								'.__('By','circles').'
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
								<span><a href="">'.$comments_msg.'</a></span>
							</div>
						</footer>
						<div class="post-body-text">
							
							<p>'.ts_get_the_excerpt_theme('short').' <a class="read-more" href="'.get_permalink().'">'.__('read more','circles').'</a></p>
						</div>
				</article>';
			$i ++;
		}
		
		$content = '
			<section class="grid_12 recent-posts">
				'.$list.'
			</section>';
	}
	// Restor original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();
	return $content;
}