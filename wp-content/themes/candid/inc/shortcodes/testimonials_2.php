<?php
/**
 * Shortcode Title: Testimonials
 * Shortcode: testimonials
 * Usage: [testimonials_2 category="3" limit="3" color="#FF0000" content_font_size="12" author_font_size="10"]
 */
add_shortcode('testimonials_2', 'ts_testimonials_2_func');

function ts_testimonials_2_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"category" => '',
		"limit" => 5,
		"color" => "",
		"content_font_size" => "",
		"author_font_size" => "",
		),
	$atts));

	if (empty($limit)) {
		$limit = 5;
	}
	
	$styles_content = array();
	$styles_author = array();
	
	if (!empty($color)) {
		$color_css = 'color: '.$color;
		$styles_content[] = $color_css;
		$styles_author[] = $color_css;
	}
	
	if (intval($content_font_size) > 0) {
		$styles_content[] = 'font-size: '.intval($content_font_size).'px';
	}
	
	if (intval($author_font_size) > 0) {
		$styles_author[] = 'font-size: '.intval($author_font_size).'px';
	}
	
	$styles_content_html = '';
	if (count($styles_content) > 0) {
		$styles_content_html = 'style="'.implode(';',$styles_content).'"';
	}
	
	$styles_author_html = '';
	if (count($styles_author) > 0) {
		$styles_author_html = 'style="'.implode(';',$styles_author).'"';
	}
	
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
				$author = '<a href="mailto:'.$email.'">'.$author.'</a>';
			}
			else
			{
				$author = $author;
			}

			if (!empty($company))
			{
				if (!empty($url))
				{
					$company = '<a href="'.$url.'" target="_blank">'.(!empty($widget_title) ? ', ' : '').$company.'</a>';
				}
			}

			$post_content = stripslashes($post -> post_content);

			
			$content .= '
				<li>
				  <article class="sc-testimonial">
					<p '.$styles_content_html.'>'.$post_content.'</p>
					<span '.$styles_author_html.'>- '.$author.' '.$widget_title.' '.$company.'</span>
				  </article>
				</li>';
			
		}

	}
	// Restor original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();
	if (!empty($content))
	{
		return '
			 <section class="sc-testimonial-slider">
          <div class="flexslider control-nav">
            <ul class="slides">
              <li>
                <article class="sc-testimonial">
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur quam augue, vehicula</p>
                  <span>- John Doe, New York</span>
                </article>
              </li>
              <li>
                <article class="sc-testimonial">
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur quam augue, vehicula</p>
                  <span>- John Doe, New York</span>
                </article>
              </li>
              <li>
                <article class="sc-testimonial">
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur quam augue, vehicula</p>
                  <span>- John Doe, New York</span>
                </article>
              </li>
            </ul>
          </div>
        </section>';
	}
}