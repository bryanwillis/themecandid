<?php
/**
 * Shortcode Title: Dropcaps
 * Shortcode: dropcaps
 * Usage: [dropcaps type="circle" color="#C4C4C4" background="#A4A4A4"]Your text here...[/dropcaps]
 */
add_shortcode('dropcaps', 'ts_dropcaps_func');

function ts_dropcaps_func( $atts, $content = null )
{    
	if (empty($content))
	{
		return '';
	}
	
	extract(shortcode_atts(array(
		'type' => '',
		'color' => '',
		'background' => '',
		), 
	$atts));
	
	$class = '';
	if ($type == 'circle')
	{
		$class = 'dropcap_circle';
	}
	$styles = array();
	if ($color)
	{
		$styles[] = 'color: '.$color;
	}
	if ($background && $type == 'circle')
	{
		$styles[] = 'background-color: '.$background;
	}
	$style = '';
	if (count($styles) > 0)
	{
		$style = 'style="'.implode(';', $styles).'"';
	}
	
	$letter = substr($content,0,1);
	$content = substr($content,1);
	
	return "
		<div class='dropcap ".$class."'>
			<span class='dropcap_holder'></span>
			<p class='dropcap_text'><span class='dropcap_letter' ".$style.">".$letter."</span>".$content." </p>
		</div>";
}