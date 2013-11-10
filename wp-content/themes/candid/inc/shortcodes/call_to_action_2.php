<?php
/**
 * Shortcode Title: Call To Action 2
 * Shortcode: call_to_action_2
 * Usage: [call_to_action_2 style="1" header="Header text" content="Content text" buytext="Buy Text" url="http://url.." target="_self"]
 */
add_shortcode('call_to_action_2', 'ts_call_to_action_2_func');

function ts_call_to_action_2_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"style" => '1',
		"header" => '',
		"content" => '',
		"buttontext" => '',
		"url" => '',
		"target" => '_self',
		"background" => '',
		"background_hover" => '',
		),
	$atts));

	$data = '';
	$class = '';
	if (!empty($background_hover))
	{
		$class = "sc-button-hover";
		$data = 'data-background-hover="'.$background_hover.'"';
	}

	$add = $data." style='".(!empty($color) ? "color:".$color.";": "")." ".(!empty($background) ? "background-color:".$background.";": "")."'";

	switch ($style)
	{
		case '3':
			$content = "
				<aside class='wrapper blue'>
					<div class='container blue-radial-grad'>
						<section class='grid_12 two-headers'>
							<h2>".$header."</h2>
							<h3>".$content."</h3>
							<a target='".$target."' href='".$url."'><span>".$buttontext."</span></a>
						</section>
					</div>
				</aside>";
			break;

		case '2':
			$content = '
				<div class="infobox marble">
					<h2>'.$header.'</h2>
					<h3>'.$content.'</h3>
					<a class="btn small '.$class.'" target="'.$target.'" href="'.$url.'" '.$add.'>'.$buttontext.'</a>
					<span class="bottom-line"></span>
				</div>';
			break;

		case '1':
		default:

			if (empty($url))
			{
				$url = '#';
			}
			$button = "<a class='purchase-plate_button ".$class."' target='".$target."' href='".$url."' ".$add.">".$buttontext."</a>";

			$content = '
					<div class="purchase-plate">
						<h5 class="purchase-plate_header">'.$header.'</h5>
						<span class="purchase-plate_text">'.$content.'</span>
						'.$button.'
					</div>';
			break;
	}
	return $content;
}