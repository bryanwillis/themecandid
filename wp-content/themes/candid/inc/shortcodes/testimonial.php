<?php
/**
 * Shortcode Title: Testimonial
 * Shortcode: testimonial
 * Usage: [testimonial id="3"]
 */
add_shortcode('testimonial', 'ts_testimonial_func');

function ts_testimonial_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"id" => 0,
		"category"
		),
	$atts));

	$post = get_post($id);

	

	if ( $post )
	{
		$content = apply_filters('the_content', $post -> post_content);
		
		$widget_title = get_post_meta($post->ID, 'testimonials-widget-title', true);
		$email = get_post_meta($post->ID, 'testimonials-widget-email', true);
		$company = get_post_meta($post->ID, 'testimonials-widget-company', true);
		$url = get_post_meta($post->ID, 'testimonials-widget-url', true);
		$author = apply_filters( 'the_title', $post -> post_title, $post -> ID);
		
		return '
			<article class="sc-testimonial sc-testimonial-style2">
			'.ts_get_resized_post_thumbnail($post->ID,'testimonial', $author).'
			'.$content.'
			<span><b>'. $author.'</b> '.$widget_title.(!empty($company) ? ', ' : '').$company.'</span>
		  </article>
		';
	}
}