<?php

/**
 * Shortcode Title: For Accordion Sidebar Toggle
 * Shortcode: accordion_toggle
 * Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
 * Options: title=your title
 * add_shortcode('accordion_toggle', 'accordion_toggle_func');
 */
add_shortcode('accordion_toggle', 'ts_accordion_toggle_func');

function ts_accordion_toggle_func($atts, $content = null) {
	extract(shortcode_atts(array(
				'title' => '',
					), $atts));
	global $single_tab_array;
	$single_tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
	return '';
}

/**
 * Shortcode Title: For Sidebar Accordion
 * Shortcode: accordion
 * Usage:   [accordion style="normal"]
 * [accordion]Your content goes here...[/accordion]
 * [/accordion]
 */
add_shortcode('accordion', 'ts_accordion_func');

function ts_accordion_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'style' => 'normal',
		'open' => 'no'
	), $atts));

	global $single_tab_array;
	$single_tab_array = array(); // clear the array

	do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
	$i = 0;

	foreach ($single_tab_array as $tab => $tab_attr_array) {

		$open_class = '';
		if ($open == "yes" && $i == 0)
		{
			$open_class = 'active';
		}

		$tabs_nav .= '
			<li class="item '.$open_class.'">
				<article>
					<footer class="button">
						<span>+</span>
						<span>-</span>
					</footer>
					<header>
						<h2 class="tran03slinear">'.$tab_attr_array['title'].'</h2>
					</header>
					<div class="item-container" '.($open == "yes" && $i == 0 ? 'style="display: block;"' : '').'>
						' . $tab_attr_array['content'] . '
					</div>
				</article>
			</li>';
		$i++;
	}


	if ($style == 'boxed')
	{
		$content = '
			<section class="widget widget_accordion accordion_style_boxed">
				<ul>
					'.$tabs_nav.'
				</ul>
			</section>';
	}
	else if ($style == 'modern')
	{
		$content = '
			<section class="widget widget_accordion accordion_style3">
				<ul>
					'.$tabs_nav.'
				</ul>
			</section>';
	}
	else
	{
		$content = '
			<section class="widget widget_accordion accordion_style2">
				<ul>
					'.$tabs_nav.'
				</ul>
			</section>';
	}

	$single_tab_array = array();
	return $content;
}