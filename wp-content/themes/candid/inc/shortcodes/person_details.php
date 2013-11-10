<?php
/**
 * Shortcode Title: Person details
 * Shortcode: person
 * Usage: [person id=x]
 */
add_shortcode('person_details', 'ts_person_details_func');

function ts_person_details_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"id" => 0,
		'header' => ''
		),
	$atts));

	global $post;

	$new_post = null;
	if (!empty($id))
	{
		$new_post = get_post( $id);
	}
	if ( $new_post )
	{
		$old_post = $post;
		$post = $new_post;

		$image = '';
		if (has_post_thumbnail($post->ID,'post'))
		{
			$image = ts_get_resized_post_thumbnail($post->ID,'person-thumb');
		}

		$facebook = get_post_meta($post -> ID,'facebook_url',true);
		$twitter = get_post_meta($post -> ID,'twitter_url',true);
		$skype = get_post_meta($post -> ID,'skype_username',true);

		$content = stripslashes($post -> post_content);
		$skills = get_post_meta($post -> ID,'skills',true);
		$skills_html = '';
		if (is_array($skills))
		{
			foreach ($skills as $skill)
			{
				$skills_html .= '<div><span style="width:'.$skill['percentage'].'%">'.$skill['title'].'</span></div>';
			}
		}

		$html = '
			<section class="container personal-details">
				<h2 class="title">'.$header.'</h2>
				<div class="separator">
					<div></div>
				</div>
				<div class="member-details">
					<div class="grid_6 member-info">
						'.$image.'
						<h2>'.get_the_title($post -> ID).'</h2>
						<span>'.get_post_meta($post -> ID,'team_position',true).'</span>
						<p class="description">'.get_post_meta($post -> ID,'short_description',true).'</p>
						'.do_shortcode($content).'
					</div>
					<div class="grid_6">
						<div class="member-social">
							'.(!empty($facebook) ? '<a class="facebook" href="'.$facebook.'" target="_blank" title="Facebook"></a>' : '').'
							'.(!empty($twitter) ? '<a class="twitter" href="'.$twitter.'" target="_blank" title="Twitter"></a>' : '').'
							'.(!empty($skype) ? '<a class="skype" href="skype:'.$skype.'?call" title="Skype"></a>' : '').'
						</div>
						<div class="member-skills">
							'.$skills_html.'
						</div>
					</div>
				</div>
			</section>';

		$post = $old_post;
	}
	return $html;
}