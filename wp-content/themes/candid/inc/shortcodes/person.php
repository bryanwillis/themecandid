<?php
/**
 * Shortcode Title: Person
 * Shortcode: person
 * Usage: [person id=x]
 */
add_shortcode('person', 'ts_person_func');

function ts_person_func($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => 0,
					), $atts));

	global $post;

	$new_post = null;
	if (!empty($id)) {
		$new_post = get_post($id);
	}
	if ($new_post) {
		$old_post = $post;
		$post = $new_post;

		$image = '';
		if (has_post_thumbnail($post->ID, 'post')) {
			$image = ts_get_resized_post_thumbnail($post->ID, 'person-mid');
		}

		$facebook = get_post_meta($post->ID, 'facebook_url', true);
		$twitter = get_post_meta($post->ID, 'twitter_url', true);
		$skype = get_post_meta($post->ID, 'skype_username', true);
		$dribbble = get_post_meta($post->ID, 'dribbble_url', true);
		$youtube = get_post_meta($post->ID, 'youtube_url', true);

		$content = stripslashes($post->post_content);

		$html = '
			<article class="team-member">
				<div class="item-con-t1">
					<div class="container-t1">
						<div class="container-t1-margin">'.$image.'</div>
					</div>
				</div>
				<h2>' . get_the_title() . '</h2>
				<h3>' . get_post_meta($post->ID, 'team_position', true) . '</h3>
				<hr>
				<p>'.ts_get_shortened_string(strip_tags($content),30).'<br/><a class="read-more" href="'.get_permalink($post -> ID).'">'.__('read more','circles').'</a></p>
				<hr>
				<ul class="socials">
					' . (!empty($facebook) ? '<li><span class="tran02slinear"></span><br><a class="facebook tran02slinear" href="' . $facebook . '" target="_blank" title="Facebook"></a></li>' : '') . '
					' . (!empty($twitter) ? '<li><span class="tran02slinear"></span><br><a class="twitter tran02slinear" href="' . $twitter . '" target="_blank" title="Twitter"></a></li>' : '') . '
					' . (!empty($skype) ? '<li><span class="tran02slinear"></span><br><a class="skype tran02slinear" href="skype:' . $skype . '?call" title="Skype"></a></li>' : '') . '
					' . (!empty($dribbble) ? '<li><span class="tran02slinear"></span><br><a class="dribbble tran02slinear" href="' . $dribbble . '" target="_blank" title="Dribble"></a></li>' : '') . '
					' . (!empty($youtube) ? '<li><span class="tran02slinear"></span><br><a class="youtube tran02slinear" href="' . $youtube . '" target="_blank" title="Youtube"></a></li>' : '') . '
				</ul>
			</article>';

		$post = $old_post;
	}
	return $html;
}