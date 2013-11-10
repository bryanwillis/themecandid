<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package circles
 * @since circles 1.0
 */

/**
 * Getting google web fonts
 * @return type
 */
function ts_get_used_googe_web_fonts()
{
	$fonts = array(
		'content_font' => ot_get_option('content_font'),
		'title_font' => ot_get_option('title_font'),
		'menu_font' => ot_get_option('menu_font'),
		'headers_font' => ot_get_option('headers_font')
	);
	//get fonts from page content
	if (is_page()) {
		$page = get_page( get_the_ID() );
		preg_match_all('/google_web_font_[a-zA-Z0-9. ]*+/i',$page -> post_content,$matches);
		
		if (isset($matches[0]) && is_array($matches[0])) {
			foreach ($matches[0] as $font) {
				$fonts[] = $font;
			}
		}
	}
	
	$fonts_to_get = array();
	$fonts_to_get[] = 'Open Sans';
	$fonts_return = array();
	foreach ($fonts as $key => $font)
	{
		if (empty($font))
		{
			continue;
		}
		$tmp = $font;
		if (strstr($font,'google_web_font_'))
		{
			$tmp = str_replace('google_web_font_','',$tmp);
			$fonts_to_get[] = $tmp;
		}
		$fonts_return[$key] = $tmp;
	}
	
	$fonts_to_get = array_unique($fonts_to_get);

	if (count($fonts_to_get) > 0)
	{
		$protocol = is_ssl() ? 'https' : 'http';

		foreach ($fonts_to_get as $font)
		{?>
			<link href="<?php echo $protocol; ?>://fonts.googleapis.com/css?family=<?php echo urlencode($font);?>:400,800,300,700" rel="stylesheet" type="text/css">
		<?php
		}
	}
	return $fonts_return;
}

if ( ! function_exists( 'theme_styles' ) ) :

function theme_styles()
{
	$fonts = ts_get_used_googe_web_fonts();
	
	$content_font = isset($fonts['content_font']) ? $fonts['content_font'] : '';
	$title_font = isset($fonts['title_font']) ? $fonts['title_font'] : '';
	$menu_fontt = isset($fonts['menu_font']) ? $fonts['menu_font'] : '';
	$headers_font = isset($fonts['headers_font']) ? $fonts['headers_font'] : '';
	?>
	<style type="text/css">
		<?php if (!empty( $content_font ) && $content_font != 'default'): ?>
			body,
			article .column_post-body,
			.post-body-text,
			.post-area 
			{ font-family: '<?php echo $content_font; ?>'; }
		<?php endif; ?>

		<?php if (ot_get_option('content_font_size')): ?>
			article .column_post-body,
			.post-body-text,
			.post-area
			{ font-size: <?php echo ot_get_option('content_font_size'); ?>px; }
		<?php endif; ?>

		<?php if (!empty( $title_font ) && $title_font != 'default'): ?>
			.headline h1 { font-family: '<?php echo $title_font; ?>'; }
		<?php endif; ?>

		<?php if (ot_get_option('title_font_size')): ?>
			.headline h1 { font-size: <?php echo ot_get_option('title_font_size'); ?>px; }
		<?php endif; ?>

		<?php if (!empty( $menu_font ) && $menu_font != 'default'): ?>
			.menu .menu-item a,
			.menu .page_item a { font-family: '<?php echo $menu_font; ?>'; }
		<?php endif; ?>

		<?php if (ot_get_option('menu_font_size')): ?>
			.menu .menu-item a,
			.menu .page_item a
			{ font-size: <?php echo ot_get_option('menu_font_size'); ?>px; }
		<?php endif; ?>

		<?php if (!empty( $headers_font ) && $headers_font != 'default'): ?>
			.post-area h1, .post-body-text h1,
			.post-area h2, .post-body-text h2,
			.post-area h3, .post-body-text h3,
			.post-area h4, .post-body-text h4,
			.post-area h5, .post-body-text h5,
			.post-area h6, .post-body-text h6, aside h5 {
				font-family: '<?php echo $headers_font; ?>';
			}
		<?php endif; ?>

		<?php if (ot_get_option('h1_size')): ?>
			.post-area h1, .post-body-text h1 { font-size: <?php echo ot_get_option('h1_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h2_size')): ?>
			.post-area h2, .post-body-text h2 { font-size: <?php echo ot_get_option('h2_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h3_size')): ?>
			.post-area h3, .post-body-text h3 { font-size: <?php echo ot_get_option('h3_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h4_size')): ?>
			.post-area h4, .post-body-text h4 { font-size: <?php echo ot_get_option('h4_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h5_size')): ?>
			.post-area h5, .post-body-text h5 { font-size: <?php echo ot_get_option('h5_size'); ?>px;}
		<?php endif; ?>

		<?php if (ot_get_option('h6_size')): ?>
			.post-area h6, .post-body-text h6 { font-size: <?php echo ot_get_option('h6_size'); ?>px;}
		<?php endif; ?>

		<?php if (
				in_array(ot_get_option('body_class'),array('b1170','b960')) && (!isset($_GET['switch_layout']) || in_array($_GET['switch_layout'],array('b1170','b960'))) || 
				isset($_GET['switch_layout']) && ($_GET['switch_layout'] == 'b1170' || $_GET['switch_layout'] == 'b960') ||
				(ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_body_class']) && in_array($_COOKIE['theme_body_class'],array('b1170','b960') ) ) 
			): ?>
			body {
				
				<?php if (isset($_GET['switch_layout']) && ($_GET['switch_layout'] == 'b1170' || $_GET['switch_layout'] == 'b960') ): ?>
					background-image: url(<?php echo get_template_directory_uri(); ?>/images/body-bg/dark_wood.png);
					background-attachment: fixed;
				
				<?php elseif (ts_check_if_control_panel() && isset($_COOKIE['theme_background']) && !empty($_COOKIE['theme_background'])): ?>
					background-image: url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $_COOKIE['theme_background']; ?>); 
					background-repeat: no-repeat;
					background-position: center;
					background-attachment: fixed;
				
				<?php elseif (ot_get_option('background_pattern') == 'image' && ot_get_option('background_image') != '' ): ?>
					background-image: url(<?php echo ot_get_option('background_image'); ?>);
					
					<?php if (ot_get_option('background_attachment') != '' ): ?>
						background-attachment: <?php echo ot_get_option('background_attachment'); ?>;
					<?php endif; ?>
						
				<?php elseif (ot_get_option('background_pattern') != 'none' ): ?>
					background-image: url(<?php echo get_template_directory_uri(); ?>/images/body-bg/<?php echo ot_get_option('background_pattern'); ?>);
					
					<?php if (ot_get_option('background_attachment') != '' ): ?>
						background-attachment: <?php echo ot_get_option('background_attachment'); ?>;
					<?php endif; ?>
					
				<?php endif; ?>
				<?php if (ot_get_option('background_color') != '' ): ?>
					background-color: <?php echo ot_get_option('background_color'); ?>;
				<?php endif; ?>
				<?php if (ot_get_option('background_repeat') != '' ): ?>
					background-repeat: <?php echo ot_get_option('background_repeat'); ?>;
				<?php endif; ?>
				<?php if (ot_get_option('background_position') != '' ): ?>
					background-position: <?php echo ot_get_option('background_position'); ?> top;
				<?php endif; ?>
				<?php if (ot_get_option('background_size') == 'browser' ): ?>
					background-size: 100%;
				<?php endif; ?>
			}
		<?php endif; ?>

		#logo {
			<?php if (ot_get_option('logo_top_margin')): ?>
				margin-top: <?php echo ot_get_option('logo_top_margin'); ?>px;
			<?php endif; ?>
			<?php if (ot_get_option('logo_left_margin')): ?>
				margin-left: <?php echo ot_get_option('logo_left_margin'); ?>px;
			<?php endif; ?>
			<?php if (ot_get_option('logo_bottom_margin')): ?>
				margin-bottom: <?php echo ot_get_option('logo_bottom_margin'); ?>px;
			<?php endif; ?>
		}
		
		<?php
		if (is_page()):
			$title_bar_text_color = get_post_meta(get_the_ID(),'title_bar_background_text_color',true);
			if (!empty($title_bar_text_color)): ?>

				.headline h1, 
				.page-path span,
				.page-path a {
					color: <?php echo $title_bar_text_color; ?> !important;
				}
			<?php endif; ?>
		<?php endif; ?>
	</style>
	<style type="text/css" id="dynamic-styles">
		<?php ts_the_theme_dynamic_styles(false); ?>
	</style>
	<?php if (ot_get_option('custom_css')): ?>
		<style type="text/css">
			<?php echo ot_get_option('custom_css'); ?>
		</style>
	<?php endif;
}
add_action('wp_head','theme_styles');
endif;

/**
 * Display dynamic css styles, function is used when opening page and in control panel when we change colors
 * @param type $ajax_request
 */
function ts_the_theme_dynamic_styles($ajax_request = true)
{
	$main_color = ot_get_option('main_color');
	
	//change color if control panel is enabled
	if (ts_check_if_control_panel())
	{
		if (isset($_GET['main_color']) && !empty($_GET['main_color']))
		{
			setcookie('theme_main_color', $_GET['main_color'],null,'/');
			$_COOKIE['theme_main_color'] = $_GET['main_color'];
			$main_color = $_COOKIE['theme_main_color'];
		}

		if (ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_main_color']) && !empty($_COOKIE['theme_main_color']))
		{
			$main_color = $_COOKIE['theme_main_color'];
		}
	}
	?>
	<?php if (1 == 2): //fake <style> tag, reguired only for editor formatting, please don't remove ?>
		<style>
	<?php endif; ?>
	
	<?php if (in_array(ot_get_option('body_class'),array('w1170','w960')) && ot_get_option('main_body_background_color')): ?>
		body {
			background: <?php echo ot_get_option('main_body_background_color'); ?>
		}
	<?php endif; ?>
	<?php if (in_array(ot_get_option('body_class'),array('b1170','b960')) && ot_get_option('main_body_background_color')): ?>
		.b1170 .page-header>.wrapper,
		.b960 .page-header>.wrapper, 
		.b1170>div.wrapper,
		.b960>div.wrapper {
			background: <?php echo ot_get_option('main_body_background_color'); ?>
		}
	<?php endif; ?>
	
	<?php if ($main_color): ?>
		/* main_color */
		<?php ts_get_main_color_classes() ?>
		{
			color: <?php echo $main_color; ?>;
		}

		<?php ts_get_our_staff_shadow_color_classes() ?>
		{
			-webkit-box-shadow: 0 3px 0 0 <?php echo $main_color; ?>;
			box-shadow: 0 3px 0 0 <?php echo $main_color; ?>;
		}

		<?php ts_get_main_color_background_classes();?>
		{
			background-color: <?php echo $main_color; ?>;
		}

		<?php ts_get_main_color_background_gradient_classes();?>
		{
			background: -moz-radial-gradient(center, ellipse cover, <?php echo ts_change_color($main_color,20,true,'0.94'); ?> 0%, <?php echo ts_hex_to_rgb($main_color,'0.85'); ?> 100%);
			background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,<?php echo ts_change_color($main_color,20,true,'0.94'); ?>), color-stop(100%,<?php echo ts_hex_to_rgb($main_color,'0.85'); ?>));
			background: -webkit-radial-gradient(center, ellipse cover, <?php echo ts_change_color($main_color,20,true,'0.94'); ?> 0%,<?php echo ts_hex_to_rgb($main_color,'0.85'); ?> 100%);
			background: -o-radial-gradient(center, ellipse cover, <?php echo ts_change_color($main_color,20,true,'0.94'); ?> 0%,<?php echo ts_hex_to_rgb($main_color,'0.85'); ?> 100%);
			background: -ms-radial-gradient(center, ellipse cover, <?php echo ts_change_color($main_color,20,true,'0.94'); ?> 0%,<?php echo ts_hex_to_rgb($main_color,'0.85'); ?> 100%);
			background: radial-gradient(ellipse at center, <?php echo ts_change_color($main_color,20,true,'0.94'); ?> 0%,<?php echo ts_hex_to_rgb($main_color,'0.85'); ?> 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f048bddb', endColorstr='#d93476a3',GradientType=1 );
		}

		<?php ts_get_main_color_background_radial_gradient_classes();?>
		{
			background: <?php echo $main_color; ?>;
			background: -moz-radial-gradient(50% 100%, circle farthest-side, <?php echo ts_change_color($main_color,15); ?>, <?php echo $main_color; ?>);
			background: -webkit-gradient(radial, 50% 100%, 0, 50% 100%, 100%, color-stop(0%,<?php echo ts_change_color($main_color,15); ?>), color-stop(100%,<?php echo $main_color; ?>));
			background: -webkit-radial-gradient(50% 100%, circle farthest-side, <?php echo ts_change_color($main_color,15); ?>, <?php echo $main_color; ?>);
			background: -o-radial-gradient(50% 100%, circle farthest-side, <?php echo ts_change_color($main_color,15); ?>, <?php echo $main_color; ?>);
			background: -ms-radial-gradient(50% 100%, circle farthest-side, <?php echo ts_change_color($main_color,15); ?>, <?php echo $main_color; ?>);
			background: radial-gradient(50% 100%, circle farthest-side, <?php echo ts_change_color($main_color,15); ?>, <?php echo $main_color; ?>);
		}

		<?php ts_get_main_color_selection_classes(true);?>
		{
			background-color: <?php echo $main_color; ?>;
		}

		<?php ts_get_main_color_border_color_classes(true); ?>
		{
			border-color: <?php echo $main_color; ?>;
		}

		<?php ts_get_main_color_border_top_color_classes(true); ?>
		{
			border-top-color: <?php echo $main_color; ?>;
		}

		<?php ts_get_main_color_border_bottom_color_classes(true); ?>
		{
			border-bottom-color: <?php echo $main_color; ?>;
		}

		<?php ts_get_main_color_border_left_color_classes(true); ?>
		{
			border-left-color: <?php echo $main_color; ?>;
		}

		<?php ts_get_main_color_border_right_color_classes(true); ?>
		{
			border-right-color: <?php echo $main_color; ?>;
		}

		.vertical.top-left .z-active .z-link {
			-webkit-box-shadow: inset 1px 0 0 0  <?php echo $main_color; ?>;
			box-shadow: inset 1px 0 0 0  <?php echo $main_color; ?>;
		}
		
		.vertical.top-right .z-active .z-link {
			-webkit-box-shadow: inset -1px 0 0 0  <?php echo $main_color; ?>;
			box-shadow: inset -1px 0 0 0  <?php echo $main_color; ?>;
		}
		
		.bottom-left .z-active .z-link, 
		.bottom-right .z-active .z-link, 
		.bottom-center .z-active .z-link {
			box-shadow: inset 0 -1px 0 0 <?php echo $main_color; ?>;
		}

		.z-active .z-link {
			box-shadow: inset 0 1px 0 0  <?php echo $main_color; ?>;
		}

	<?php endif;?>

	<?php if (ot_get_option('main_body_text_color')): ?>
		/* main_body_text_color */
		<?php ts_get_main_body_text_color_classes(true); ?>
		{
			color: <?php echo ot_get_option('main_body_text_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('header_background_color')): ?>
		/* header_background_color */
		<?php ts_get_header_background_color_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('header_background_color'); ?>;
		}
	<?php endif; ?>
		
	<?php if (ot_get_option('page_title_background_color')): ?>
		/* page_title_background_color */
		<?php ts_get_page_title_background_color_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('page_title_background_color'); ?> !important;
		}
	<?php endif; ?>
		
	<?php if (ot_get_option('menu_background_color')): ?>
		/* menu_background_color */
		<?php ts_get_menu_background_color_classes(true); ?>
		{
			background-color: <?php echo ts_hex_to_rgb(ot_get_option('menu_background_color'),ot_get_option('menu_background_transparency')) ; ?>;
		}
	<?php endif; ?>
		
	<?php if (ot_get_option('headers_text_color')): ?>
		/* headers_text_color */
		<?php ts_get_headers_text_color_classes(true); ?>
		{
			color: <?php echo ot_get_option('headers_text_color'); ?>;
		}
	<?php endif; ?>
	<?php if (ot_get_option('preheader_background_color')): ?>
		/* preheader_background_color */
		<?php ts_get_preheader_background_color_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('preheader_background_color'); ?>;
		}
	<?php endif; ?>
	<?php if ($menu_background_color): ?>
		/* menu_background_color */
		<?php ts_get_menu_background_color_classes(true); ?>
		{
			background-color: <?php echo $menu_background_color; ?> !important;
			background-image: none;
		}
	<?php endif; ?>

	<?php if (ot_get_option('sub_menu_background_color')): ?>
		
		<?php if (in_array(ts_get_main_menu_style(),array('style4')) || (isset($_GET['switch_main_menu_style']) && in_array($_GET['switch_main_menu_style'],array('style4')))): ?>
			<?php ts_get_sub_menu_background_color_2_classes(true); ?>
			{
				background-color: <?php echo ts_hex_to_rgb(ot_get_option('sub_menu_background_color'),ot_get_option('menu_background_transparency')); ?> !important;
			}
		<?php else: ?>
			<?php ts_get_sub_menu_background_color_classes(true); ?>
			{
				background-color: <?php echo ot_get_option('sub_menu_background_color'); ?> !important;
			}
		<?php endif; ?>
		/*.headerstyle4 .menu li ul li a {
			background-color: transparent;
		}*/
	<?php endif; ?>
	
	<?php if (ot_get_option('body_background_color_1')): ?>
		/* body_background_color_1 */
		<?php ts_get_body_background_color_1_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('body_background_color_1'); ?> !important;
		}
	<?php endif; ?>
		
	<?php if (ot_get_option('body_background_color_2')): ?>
		/* body_background_color_2 */
		<?php ts_get_body_background_color_2_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('body_background_color_2'); ?> !important;
		}
	<?php endif; ?>
	
	<?php if (ot_get_option('preheader_background_color')): ?>
		/* preheader_background_color */
		<?php ts_get_preheader_background_color_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('preheader_background_color'); ?> !important;
		}
	<?php endif; ?>

	<?php if (ot_get_option('preheader_text_color')): ?>
		/* preheader_text_color */
		<?php ts_get_preheader_text_color_classes(true); ?>
		{
			color: <?php echo ot_get_option('preheader_text_color'); ?> !important;
		}
	<?php endif; ?>
		
	<?php if (ot_get_option('footer_background_color')): ?>
		/* footer_background_color */
		<?php ts_get_footer_background_color_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('footer_background_color'); ?> !important;
		}
	<?php endif; ?>

	<?php if (ot_get_option('footer_headers_color')): ?>
		<?php ts_get_footer_headers_color_classes(true); ?>
		{
			color: <?php echo ot_get_option('footer_headers_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('footer_main_text_color')): ?>
		/* footer_main_text_color */
		<?php ts_get_footer_main_text_color_classes(true); ?>
		{
			color: <?php echo ot_get_option('footer_main_text_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('footer_second_text_color')): ?>
		/* footer_second_text_color */
		<?php ts_get_footer_second_text_color_classes(true); ?>
		{
			color: <?php echo ot_get_option('footer_second_text_color'); ?>;
		}
	<?php endif; ?>

	<?php if (ot_get_option('copyrights_bar_background')): ?>
		/* copyrights_bar_background */
		<?php ts_get_copyrights_bar_background_classes(true); ?>
		{
			background-color: <?php echo ot_get_option('copyrights_bar_background'); ?> !important;
		}
	<?php endif; ?>

	<?php if (ot_get_option('copyrights_bar_text_color')): ?>
		/* copyrights_bar_text_color */
		<?php ts_get_copyrights_bar_text_color_classes(true); ?>
		{
			color: <?php echo ot_get_option('copyrights_bar_text_color'); ?>;
		}
	<?php endif; ?>

	<?php if (1 == 2): //fake </style> tag, reguired only for editor formatting, please don't remove ?>
		</style>
	<?php endif; ?>

	<?php

	if ($ajax_request === true)
	{
		die();
	}
}

function ts_the_theme_dynamic_styles_ajax_request()
{
	ts_the_theme_dynamic_styles(true);
}

add_action( 'wp_ajax_nopriv_the_theme_dynamic_styles', 'ts_the_theme_dynamic_styles_ajax_request' );
add_action( 'wp_ajax_the_theme_dynamic_styles', 'ts_the_theme_dynamic_styles_ajax_request' );


if ( ! function_exists( 'ts_theme_comment' ) ) :
/**
 * Comments and pingbacks. Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since circles 1.0
 */
function ts_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<article <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'circles' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'circles' ), ' ' ); ?></p>
	</article>
	<?php
			break;
		default :
	?>
	<article <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
		<footer>
			<div class='comment-helper-absolute'>
				<div class='avatar'>
					<?php echo get_avatar( $comment, 61 ); ?>
				</div>
				<div class='post-author'>
					<?php _e('By','circles'); ?>
					<span>
						<?php comment_author_link();?>
					</span>
				</div>
			</div>
			<div class='post-date'>
				<time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php  printf( '<span class="comment-day">%1$s</span><span class="comment-time">at %2$s</span>', get_comment_date(), get_comment_time() );?></time>
			</div>
			<span class="comment-reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 3 ) ) ); ?><?php edit_comment_link( __( 'Edit', 'circles' ), ' ' );?></span>
		</footer>
		<div class='comment-body'>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php __( 'Your comment is awaiting moderation.', 'circles' ); ?></em>
			<?php endif; ?>
			<?php comment_text(); ?>
		</div>
	</article>
	<?php
			break;
	endswitch;
}
endif; // ends check for theme_comment()

if (!function_exists('ts_theme_navi')):

/**
 * Posts annd search pagination
 *
 * @since circles 1.0
 */
function ts_theme_navi()
{
	$args = array(
		'container' => 'ul',
		'container_id' => 'pager',
		'container_class' => 'post-pagination',
		'items_wrap' => '<li class="%s"><span></span>%s</li>',
		'item_class' => '',
		'item_active_class' => '',
		'list_item_active_class' => 'active',
        'item_prev_class' => 'prev-page',
        'item_next_class' => 'next-page',
		'prev_text' => '',
		'next_text' => ''
	);
	ts_wp_custom_corenavi( $args);
}
endif; //ends check for theme_navi

if (!function_exists('ts_get_theme_navi_array')):

/**
 * Get Posts annd search pagination array
 *
 * @since circles 1.0
 */
function ts_get_theme_navi_array()
{
	$args = array(
		'container' => '',
		'container_id' => 'pager',
		'container_class' => 'clearfix',
		'items_wrap' => '%s',
		'item_class' => 'page',
		'item_active_class' => 'active',
		'item_prev_class' => 'prev-page',
        'item_next_class' => 'next-page',
		'prev_text' => '',
		'next_text' => '',
		'next_prev_only' => false,
		'type' => 'array'
	);
	return ts_wp_custom_corenavi( $args);
}
endif; //ends check for theme_navi

if (!function_exists('ts_the_circles_navi')):

/**
 * Show circles navi
 *
 * @since circles 1.0
 */
function ts_the_circles_navi()
{
	$pagination = ts_get_theme_navi_array();
	if (is_array($pagination['links']) && count($pagination['links']) > 0)
	{
		?>
		<ul class='post-pagination'>
			<?php foreach ($pagination['links'] as $key => $item): ?>

				<?php if ($key == 'prev' || $key == 'next'): ?>
					<li>
						<?php echo $item; ?>
					</li>
				<?php else: ?>
					<li <?php echo ($pagination['active'][(int)$key] === true ? 'class="active"': '')?>>
						<span></span>
						<?php echo $item; ?>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}
endif; //ends check for theme_navi

function ts_the_breadcrumbs() {

  /* === OPTIONS === */
  $text['home']     = __('Home','circles'); // text for the 'Home' link
  $text['category'] = __('Archive by Category "%s"','circles'); // text for a category page
  $text['search']   = __('Search Results for "%s" Query','circles'); // text for a search results page
  $text['tag']      = __('Posts Tagged "%s"','circles'); // text for a tag page
  $text['author']   = __('Posts by %s','circles'); // text for an author page
  $text['404']      = __('404 Page Not Found','circles'); // text for the 404 page

  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter   = ' <span class="delimiter">|</span> '; // delimiter between crumbs
  $before      = '<span class="current">'; // tag before the current crumb
  $after       = '</span>'; // tag after the current crumb
  /* === END OF OPTIONS === */

  global $post;
  $homeLink = home_url() . '/';
  $linkBefore = '<span typeof="v:Breadcrumb">';
  $linkAfter = '</span>';
  $linkAttr = ' rel="v:url" property="v:title"';
  $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

  if (is_home() || is_front_page()) {

    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

  } else {

    echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
	
	if (function_exists('is_shop') && is_shop()) {
		echo $before . __('Shop','circles') . $after;
	} else if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
      }
      echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

    } elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;

    } elseif ( is_day() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
		
		if ($post_type -> query_var == 'product') {
			$label = __('Shop','circles');
		} else {
			$label = $post_type->labels->singular_name;
		}
		$slug = $post_type->rewrite;
		
		$portfolio_page_id = null;
		if (get_post_type() == 'portfolio') {
			$portfolio_page_id = ot_get_option('portfolio_page');
		}
		if (!empty($portfolio_page_id)) {
			echo '<a href="'.get_permalink($portfolio_page_id).'">'.get_the_title($portfolio_page_id).'</a>';
		} else {
			printf($link, get_post_type_archive_link( $post_type -> name ), $label);
		}
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      $cats = get_category_parents($cat, TRUE, $delimiter);
	  if (!is_wp_error($cats))
	  {
		$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
		$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
		echo $cats;
		printf($link, get_permalink($parent), $parent->post_title);
	  }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo $delimiter;
      }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;

    } elseif ( is_404() ) {
      echo $before . $text['404'] . $after;
    }
    echo '</div>';

  }
}

/**
 * Get post slider
 * @since circles 1.0
 */
if (!function_exists('ts_get_post_slider'))
{
function ts_get_post_slider($post_id)
{
	$a = get_post_meta(get_the_ID(), 'post_slider',true);

	if (strstr($a,'LayerSlider'))
	{
		$id = str_replace('LayerSlider-','',$a);
		return do_shortcode('[layerslider id="'.$id.'"]');
	}
	else if (strstr($a,'revslider'))
	{
		$id = str_replace('revslider-','',$a);
		return do_shortcode('[rev_slider '.$id.']');
	}

	if (strstr($a,'flexslider'))
	{
		$id = str_replace('flexslider-','',$a);
		return do_shortcode('[flexslider id="'.$id.'"]');
	}
	
	if (strstr($a,'banner-builder'))
	{
		$id = str_replace('banner-builder-','',$a);
		return td_get_banner($id);
	}
}
}

/**
 * Get circles thumbnail (image,gallery slider or video), must be run in loop
 * @global object $post
 * @param array $sizes different sizes for page without or with one or two sidebars
 * @return string
 */
function ts_get_circles_thumb($sizes)
{
	global $post;

	$thumb = '';
	switch (get_post_format())
	{
		case 'gallery':
			$gallery = get_post_meta($post->ID, 'gallery_images',true);
			if (is_array($gallery) && count($gallery) > 0)
			{
				$thumb = "
					<div class='flexslider' id='flexslider-".$post->ID."'>
						<ul class='slides'>";
				foreach ($gallery as $image)
				{
					$thumb .= "<li>".ts_get_resized_image_sidebar($image['image'],$sizes,$image['title'])."</li>";
				}
				$thumb .= '
						</ul>
					  </div>
					<script type="text/javascript">
						jQuery(document).ready(function() {
						  jQuery("#flexslider-'.$post->ID.'").flexslider({
							animation: "slide",
							controlNav: false,
							prevText: "'.ts_get_prev_slider_text().'",
							nextText: "'.ts_get_next_slider_text().'"
						  });
						});
					</script>';
			}
			break;
		case 'video':
			$url = get_post_meta($post -> ID, 'video_url',true);
			if (!empty($url))
			{
				$thumb = ts_get_embaded_video($url);
			}
			else if (empty($url))
			{
				$thumb = get_post_meta($post -> ID, 'embedded_video',true);
			}
			$thumb = '<div class="videoWrapper">'.$thumb.'</div>';
			break;
		default:
			$thumb = ts_get_resized_post_thumbnail_sidebar($post -> ID, $sizes,get_the_title());
			break;
	}
	return $thumb;
}