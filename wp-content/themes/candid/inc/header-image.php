<?php
/**
 * Header image/slider
 *
 * @package circles
 * @since circles 1.0
 */

$slider = null;
if (is_home() || is_page() || is_single())
{
	$slider = get_post_meta(get_the_ID(), 'post_slider',true);
	if ($slider)
	{
		$slider = ts_get_post_slider(get_the_ID());
	}
	else
	{
		$slider = null;
	}
}
$path_only_class = '';
$header_background = '';
if (empty($slider) && is_page())
{
	$header_background = get_post_meta(get_the_ID(),'header_background',true);
}
else if (!is_page()) {
	$header_background = ot_get_option('default_title_background');
}

//set different background height if only breadcrumbs selected for this page
$titlebar = get_post_meta(get_the_ID(),'titlebar',true);
if ($titlebar == 'breadcrumbs')
{
	$path_only_class = 'header-image-path-only';
}
else if ($titlebar == 'no_titlebar' && !$header_background)
{
	$path_only_class = 'header-image-no-titlebar';
}

if (!empty($slider)): ?>
	<div class='wrapper top-slider <?php echo get_post_meta(get_the_ID(), 'parallax_effect',true) == 'yes' ? 'parallax-slider' : ''; ?>'><?php echo $slider; ?></div>
<?php elseif (!empty($header_background)): ?>
	<div class='wrapper header-image <?php echo $path_only_class; ?>' style="background: url('<?php echo $header_background; ?>')"></div>
<?php else:?>
<div class='wrapper header-image <?php echo $path_only_class; ?>'></div>
<?php endif;?>