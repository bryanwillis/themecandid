<?php
/**
 * Shortcode Title: Promo line
 * Shortcode: promo_line
 * Usage: [promo_line color="#ebebeb" border_color="#dedede" background_image="image.png" background_attachment="scroll" horizontal_position="left" vertical_position="top" first_page="no" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="0" fullwidth="yes" header="Your header" subheader="Your subheader" buttontext="Click me" url="http://..." target="_blank" icon="icon-glass"]
 */
add_shortcode('promo_line', 'promo_line_func');

function promo_line_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		'fullwidth' => 'yes',
		'color' => '',
		'border_color' => '',
		'background_image' => '',
		'background_attachment' => '',
		'background_position' => '',
		'first_page' => '',
		'last_page' => '',
		'padding_top' => '',
		'padding_bottom' => '',
		'margin_bottom' => '',
		'header' => '',
		'subheader' => '',
		'buttontext' => '',
		'url' => '',
		'target' => '_self',
		'icon' => '',
		), 
	$atts));
	
	$classes = array();
	$styles = array();
	
	if ($fullwidth == 'yes')
	{
		$classes[] = 'sc-highlight-full-width';
	}
	else
	{
		$classes[] = 'sc-highlight-standard';
	}
	
	if (!empty($color)) {
		$styles[] = 'background-color: '.$color.';'; 
	}
	
	if (!empty($border_color)) {
		$styles[] = 'border: 1px solid '.$border_color.';'; 
	}
	
	if (!empty($background_image)) {
		$styles[] = 'background-image: url('.$background_image.');';
	}
	
	if (!empty($background_attachment)) {
		$styles[] = 'background-attachment: '.$background_attachment.';';
	}
	
	if (intval($min_height)) {
		$styles[] = 'min-height: '.intval($min_height).'px;';
	}
	
	if (!empty($background_position)) {
		$styles[] = 'background-position: '.$background_position.';';
	}
	
	if ($background_stretch == 'yes') {
		$styles[] = 'background-size: 100% 100%;';
	}
	
	if ($first_page == 'yes') {
		$styles[] = 'margin-top: -30px;';
	}
	
	if (intval($padding_top)) {
		$styles[] = 'padding-top: '.intval($padding_top).'px;';
	}
	
	if (intval($padding_bottom)) {
		$styles[] = 'padding-bottom: '.intval($padding_bottom).'px;';
	}
	
	if (intval($margin_bottom)) {
		$styles[] = 'margin-bottom: '.intval($margin_bottom).'px;';
	}
	else if ($last_page == 'yes') {
		$styles[] = 'margin-bottom: -30px;';
	}
	
	return '
		<div class="sc-promo-line '.implode(' ',$classes).'" style="'.implode(' ',$styles).'">
			<div class="sc-highlight">
				<div class="sc-promo-line-text">
					<p><span class="sc-promo-line-header">'.$header.'</span> '.$subheader.'</p>
				</div>
				<div class="sc-promo-line-button">
					<p><a target="'.$target.'" href="'.$url.'" class="sc-promoline-button btn-style3 '.$icon.'">'.$buttontext.'</a></p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	';
}