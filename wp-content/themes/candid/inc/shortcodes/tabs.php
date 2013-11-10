<?php
/**
 * Shortcode Title: Tabs
 * Shortcode: tabs
 * Usage: [tabs orientation="horizontal" position="top-left" style="normal" autoplay="no" animation="fadein"][tab url="http://test.com" target="_blank"]Your text here...[/tab][/tabs]
 * Options: action="url/open"
 */
add_shortcode('tabs', 'ts_tabs_func');

function ts_tabs_func( $atts, $content = null ) {

	//[tabs ]
	extract(shortcode_atts(array(
	    'orientation' => 'horizontal',
	    'position' => 'top-left',
	    'style' => 'normal',
	    'autoplay' => 'no',
	    'animation' => 'fadeIn',
    ), $atts));

	if (!in_array($orientation,array('horizontal','vertical')))
	{
		$orientation = 'horizontal';
	}
	if ($orientation == 'horizontal' && !in_array($position,array("top-left", "top-right", "top-center", "top-compact", "bottom-left", "bottom-center", "bottom-right", "bottom-compact")))
	{
		$position = 'top-left';
	}
	//only 2 positions supported if orientation is verticals
	if ($orientation == 'vertical' && !in_array($position,array("top-left", "top-right")))
	{
		$position = 'top-left';
	}
	if (!in_array($style,array('normal','underline')))
	{
		$style = 'normal';
	}
	$theme = 'silver';

	if (!in_array($animation,array('fadeIn','slideDown')))
	{
		$animation = 'fadeIn';
	}
	$autoplay_code = '';
	if ($autoplay == 'yes')
	{
		$autoplay_code = ',autoplay: { interval: 5000 }';
	}

	global $shortcode_tabs;
    $shortcode_tabs = array(); // clear the array
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content

	$tabs_nav = '';
	$tabs_content = '';
	foreach ($shortcode_tabs as $tab) {

		$tabs_nav .= '<li><a>';
		if ($tab['icon'] != 'no')
		{
			$tabs_nav.= '<i class="'.$tab['icon'].' '.$tab['iconsize'].'"></i>';
		}
		$tabs_nav .= ''.$tab['title'].'</a></li>';

		$tabs_content .= '<div>'.$tab['content'].'</div>';
	}
    $shortcode_tabs = array();

	$rand = rand(15000,50000);
	$content = "
		<div id='tab-".$rand."' class='z-tabs'>
			<ul>
				".$tabs_nav."
			</ul>
			<div>
				".$tabs_content."
			</div>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#tab-".$rand."').zozoTabs({
					theme: '".$theme."',
					orientation: '".$orientation."',
					position: '".$position."',
					style: '".$style."',
					animation: {
						duration: 200,
						effects: '".$animation."',
						easing: 'swing'
					}
					".$autoplay_code."
				});
			});
		</script>";
	return $content;
}

/**
 * Shortcode Title: Tab - can be used only with tabs shortcode
 * Shortcode: tab
 * Usage: [tabs][tab label="New 1"]Your text here...[/tab][/tabs]
 * Options: action="url/open"
 */
add_shortcode('tab', 'ts_tab_func');
function ts_tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => '',
	    'icon' => 'no',
	    'iconsize' => '',
    ), $atts));
    global $shortcode_tabs;
    $shortcode_tabs[] = array('title' => $title, 'icon' => $icon, 'iconsize' => $iconsize, 'content' => trim(do_shortcode($content)));
    return $shortcode_tabs;
}