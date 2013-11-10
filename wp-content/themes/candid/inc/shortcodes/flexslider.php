<?php
/**
 * Shortcode Title: Flexslider
 * Shortcode: flexslider
 * Usage: [flexslider id=x]
 */
add_shortcode('flexslider', 'ts_flexslider_func');

function ts_flexslider_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"id" => ""
		),
	$atts));

	if (!(int)$id)
	{
		return '';
	}

	require_once get_template_directory().'/framework/class/FlexSliderSlider.class.php';
	require_once get_template_directory().'/framework/class/FlexSliderSlide.class.php';

	$oSlider = new FlexSliderSlider($id);
	$oRecord = $oSlider -> get();

	if ($oRecord === false)
	{
		return '';
	}

	$oSlides = new FlexSliderSlide;
	$aSlides = $oSlides -> getSliderSlides($id);

	if ( is_array($aSlides) && count($aSlides) > 0 )
	{
		require_once get_template_directory().'/framework/class/freshizer.php';
		foreach ($aSlides as $oSlide)
		{
			$image = ts_get_resized_image_by_size($oSlide -> image, 'slider');
			$content .= '<li>'.$image.'</li>';
		}
	}
	$rand = $id.'-'.rand(1,5000);

	$animation = 'slide';
	if (in_array($oRecord -> animation,array('slide','fade')))
	{
		$animation = $oRecord -> animation;
	}
	$direction = 'horizontal';
	if (in_array($oRecord -> direction,array('horizontal','vertical')))
	{
		$direction = $oRecord -> direction;
	}
	$slideshow_speed = 100;
	if ((int)$oRecord -> slideshow_speed > 100)
	{
		$slideshow_speed = $oRecord -> slideshow_speed;
	}
	$animation_speed = 100;
	if ((int)$oRecord -> animation_speed > 100)
	{
		$animation_speed = $oRecord -> animation_speed;
	}
	$reverse = false;
	if ((int)$oRecord -> reverse == 1)
	{
		$reverse = true;
	}
	$randomize = false;
	if ((int)$oRecord -> randomize == 1)
	{
		$randomize = true;
	}
	$controlNav = true;
	if ((int)$oRecord -> control_nav == 0)
	{
		$controlNav = false;
	}
	$directionNav = true;
	if ((int)$oRecord -> direction_nav == 0)
	{
		$directionNav = false;
	}

	$before = "";
	$after = "";
	if (!empty($oRecord -> background))
	{
		$before =  "<div class='slider-background' style='background: url(".$oRecord -> background.");'>";
		$after = "</div>";
	}

	$content = $before."
		<div class='flexslider images-slider' id='flexslider-".$rand."'>
			<ul class='slides'>".do_shortcode(shortcode_unautop($content))."</ul>
		</div>".$after;

	$content .= "
		<script type='text/javascript'>
			jQuery(document).ready(function() {
			  jQuery('#flexslider-".$rand."').flexslider({
				animation: '".$animation."',
				direction: '".$direction."',
				slideshowSpeed: ".$slideshow_speed.",
				animationSpeed: ".$animation_speed.",
				controlNav: ".(int)$controlNav.",
				directionNav: ".(int)$directionNav.",
				reverse: ".(int)$reverse.",
				randomize: ".(int)$randomize.",
				prevText: \"".ts_get_prev_slider_text()."\",
				nextText: \"".ts_get_next_slider_text()."\"
			  });
			});
		</script>";

	// Restor original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();
	return $content;
}