<?php
/**
 * Top secion of the theme, includes page header or image slider
 *
 * @package circles
 * @since circles 1.0
 */

$subtitle = '';

if( is_tag() )
{
	$title = sprintf(__('Posts Tagged "%s"','circles'),single_tag_title('',false));
}
elseif (is_day())
{
	$title = sprintf(esc_html__('Posts made in %s','circles'),get_the_time('F jS, Y'));
}
elseif (is_month())
{
	$title =sprintf(esc_html__('Posts made in %s','circles'),get_the_time('F, Y'));
}
elseif (is_year())
{
	$title = sprintf(esc_html__('Posts made in %s','circles'),  get_the_time('Y'));
}
elseif (is_search())
{
	$title = sprintf(esc_html__('Search results for %s','circles'), get_search_query());
}
elseif (is_category())
{
	$title = single_cat_title('',false);
}
elseif (is_author())
{
	global $wp_query;
	$curauth = $wp_query->get_queried_object();
	$title = sprintf(__('Posts by %s','circles'), $curauth->nickname);
}
elseif ( is_single())
{
	if (get_post_type() == 'post')
	{
		$title = __('Blog','circles');
	}
	else
	{
		$title = get_the_title();
		
		if (ts_get_main_menu_style() == 'style2' || ts_get_main_menu_style() == 'style5') {
			$subtitle = get_post_meta (get_the_ID(), 'subtitle', true);
		}
	}
}
elseif ( is_page() )
{
	$title = get_the_title();
	if (ts_get_main_menu_style() == 'style2' || ts_get_main_menu_style() == 'style5') {
		$subtitle = get_post_meta (get_the_ID(), 'subtitle', true);
	}
}
else if (is_404())
{
	$title = __('404 Page Not Found','circles');
}
else if (function_exists('is_woocommerce') && is_woocommerce())
{
	$title = __('Shop','circles');
}
else
{
	$title = get_bloginfo('name');
}

$titlebar = get_post_meta(get_the_ID(),'titlebar',true);
$no_titlebar = false;
$page_path_class = '';
switch ($titlebar)
{
	case 'title':
		$show_title = true;
		$show_breadcrumbs = false;
		$page_path_class = '';
		break;

	case 'breadcrumbs':
		$show_title = false;
		$show_breadcrumbs = true;
		$page_path_class = 'only-path';
		break;

	case 'no_titlebar':
		$no_titlebar = true;
		break;

	default:
		$show_title = true;
		$show_breadcrumbs = true;
}


if ($no_titlebar === false && is_page_template('template-contact-form-1.php')): ?>
	<div class='wrapper headline relative <?php echo $page_path_class; ?>'>
		<div class='bg-black-045'></div>
		<div class='container relative'>
			<div class='grid_12'>
				<?php if ($show_title): ?>
					<h1><?php echo $title; echo (!empty($subtitle) ? '<span> '.$subtitle.'</span>' : ''); ?></h1>
				<?php endif; ?>
				<?php if ($show_breadcrumbs && ot_get_option('show_breadcrumbs') != "no"): ?>
					<div class='page-path'>
						<?php ts_the_breadcrumbs();?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php elseif ($no_titlebar === false): 
	
	$headlinge_class = '';
	if (is_page() && !get_post_meta(get_the_ID(),'header_background',true) || !is_page() && !ot_get_option('default_title_background')) {
		$headlinge_class = 'marble border-bottom-black-tr';
	}
	?>
	<div class='wrapper headline <?php echo $page_path_class; ?> <?php echo $headlinge_class; ?>'>
		<div class='container'>
			<div class='grid_12'>
				<?php if ($show_title): ?>
					<h1><?php echo $title; echo (!empty($subtitle) ? '<span> '.$subtitle.'</span>' : ''); ?></h1>
				<?php endif; ?>
				<?php if ($show_breadcrumbs && ot_get_option('show_breadcrumbs') != "no"): ?>
					<div class='page-path'>
						<?php ts_the_breadcrumbs();?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php  endif; ?>