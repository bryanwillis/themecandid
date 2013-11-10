<?php
/**
 * Shortcode Title: Call to action
 * Shortcode: call_to_action 
 * Usage: [call_to_action content="Content text" buytext="Buy Text" url="http://url.." target="_self"]
 */
add_shortcode('call_to_action', 'ts_call_to_action_func');

function ts_call_to_action_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"button_text" => "",
		"text" => "",
		"position" => "left",
		"color" => "",
		"size" => "",
		"url" => "#",
		"target" => '_self'
		), 
	$atts));
	
	$data = '';
	$class = "default";
	
	$a = "<a class='".$class."' ".(!empty($color) ? "style='background-color: ".$color."'" : "")." ".$data." target='".$target."' href='".$url."'>".$button_text."</a>";
	
	if ($position == "left" || $position == 'right')
	{
		$content = "
			<span class='sc-call-to-action-button'>".$a."</span>
			<span class='sc-call-to-action-text'>".$text."</span>
		";
	}
	else
	{
		$content = "
			<span class='sc-call-to-action-text'>".$text."</span>
			<span class='sc-call-to-action-button'>".$a."</span>
		";
	}
	
	$content = "
		<div class='sc-call-to-action sc-call-to-action-".$position." sc-call-to-action-".$size."'>
			".$content."
			<div class='sc-call-to-action-clear'></div>
		</div>";
	
	return $content;
}