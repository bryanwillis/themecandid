<?php
/**
 * Shortcode Title: Embed Media
 * Shortcode: embed_media
 * Usage: [embed_media]http://youtube.com/test[/embed_media]
 */
add_shortcode('embed_media', 'ts_embed_media_func');

function ts_embed_media_func( $atts, $content = null ) {
    
	$embed = ts_get_embaded_video($content);
	if (empty($embed))
	{
		global $wp_embed;
        $embed = $wp_embed->run_shortcode('[embed width=640 height=480]'.$content.'[/embed]');
	}
	return '<div class="sc-embed-media">'.$embed.'</div>';
}