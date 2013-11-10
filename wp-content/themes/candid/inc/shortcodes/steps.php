<?php
/**
 * Shortcode Title: Steps
 * Shortcode: steps
 * Usage: [steps][step icon="..." title="Your title" subtitle="Your subtitle" url="http://.." target="_blank"][/steps]
 * Options: action="url/open"
 */
add_shortcode('steps', 'ts_steps_func');

function ts_steps_func( $atts, $content = null ) {

	global $shortcode_steps;
    $shortcode_steps = array(); // clear the array
    do_shortcode($content); // execute the '[step]' shortcode first to get the title and content

	$steps_content = '';
	$i = 1;
	$steps_count = count($shortcode_steps);
	foreach ($shortcode_steps as $step) {

		$steps_content .= "
			<section class='plate tran03slinear'>
				<a href='".$step['url']."' target='".$step['target']."'>
					<div class='separator'>
						<div></div>
					</div>";
		if ($i == 1)
		{
			$steps_content .= "<div class='alpha tran03slinear'></div>";
		}
		else if ($i == $steps_count)
		{
			$steps_content .= "<div class='omega tran03slinear'></div>";
		}

		switch ($step['icon'])
		{
			case 'brain':	$icon = 'three-plates-img-1'; break;
			case 'bulb':	$icon = 'three-plates-img-2'; break;
			case 'idea':	$icon = 'three-plates-idea'; break;
			case 'list':	$icon = 'three-plates-list'; break;
			case 'mental':	$icon = 'three-plates-mental'; break;
			case 'start':	$icon = 'three-plates-start'; break;
			case 'strategy':$icon = 'three-plates-strategy'; break;
			case 'target':	$icon = 'three-plates-target'; break;
			case 'time':	$icon = 'three-plates-time'; break;
			case 'zen':		$icon = 'three-plates-img-3'; break;
			default:		$icon = 'three-plates-img-1'; break;
		}
		$steps_content .= "
					<div class='".$icon."'>
						<span class='tran03slinear'></span>
						<span class='tran03slinear'></span>
					</div>
					<h2 class='tran03slinear'>".$step['title']."</h2>
					<h3 class='tran03slinear'>".$step['subtitle']."</h3>
				</a>
			</section>";

		$i++;
	}
	//reset array for another steps shortcode
    $shortcode_steps = array();

	$content = "
		<div class='three-plates'>
			<div class='container'>
			".$steps_content."
			</div>
		</div>";

	return $content;
}

/**
 * Shortcode Title: Step - can be used only with steps shortcode
 * Shortcode: step
 * Usage: [steps][step icon="..." title="Your title" subtitle="Your subtitle" url="http://..." target="_self"][/tabs]
 */
add_shortcode('step', 'ts_step_func');
function ts_step_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'icon' => '',
	    'title' => '',
	    'subtitle' => '',
	    'url' => '',
	    'target' => '_self',
    ), $atts));
    global $shortcode_steps;
    $shortcode_steps[] = array('icon' => $icon, 'title' => $title, 'subtitle' => $subtitle, 'url' => $url, 'target' => $target);
    return $shortcode_steps;
}