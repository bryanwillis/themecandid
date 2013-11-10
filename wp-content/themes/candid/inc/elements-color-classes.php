<?php
/**
 * A list of css classes for elements color settings set in theme options
 * Used in template-tags.php, control-panel.php
 *
 * @package circles
 * @since circles 1.0
 */

/**
 * Get main color classes
 */
function ts_get_main_color_classes() {
?>
	a,
	.widget_categories li.active a, .widget_categories li.active,
	.z-active .z-link,
	.tab-nav li.active a,
	.menu>li:hover>a,
	.menu>li.current_page_item>a,
	.menu>li:hover>a:after,
	.menu>li.current_page_item>a:after,
	.advantages a:hover h1,
	.why-choose-us a:hover h1,
	.post>header h2,
	.post-author a,
	.post-comments.inline a,
	.read-more,
	.post-pagination li:hover a,
	.post-pagination li.active a
	.widget_categories li:hover,
	.widget_categories a:hover,
	.gallery-filters a:hover,
	.gallery-filters a.selected,
	.column_post header a,
	.column_post header h1,
	.column_post-category span,
	.column_post-category a,
	.column_post-author span,
	.column_post-author a,
	.purchase-plate_header,
	.widget_recent_posts_2 .item header h1,
	.widget_recent_posts_2 .item header h1 a,
	.member-info span,
	.post-blockquote,
	.post h1,
	.number-of-comments span,
	.comment-reply,
	blockquote,
	.widget_accordion .item.active h1,
	.post-category span, .post-category a,
	.post-comments.inline a,
	.widget_categories li:hover,
	.widget_categories a:hover,
	.dropcap_letter,
	.widget_accordion footer span+span,
	.sc-list ul li:hover,
	.service-icon:hover span,
	li.mega-menu > .sub-menu > li li a:hover,
	.featured-project:hover h2,
	.sc-icon span, .why-choose-us a:hover h2, .advantages a:hover h2, 
	.widget_accordion .item.active h2, 
	.service.service-style2 .service-icon span, 
	.sc-list ul li:before
<?php
}


/**
 * Get main color background classes
 */
function ts_get_main_color_background_classes()
{
	?>
	.menu>li:hover>a:after,
	.menu>li.current_page_item>a:after,
	.blue,
	.widget_out_stuff2 .item-con-t1:hover header .bg-black-045,
	.widget_multi_posts_entries .header .item.active .button,
	.underline .z-active .z-link,
	.advantages a .advantages-img span:first-child+span,
	.why-choose-us .why-choose-us-img span:first-child+span,
	.post-comments span,
	.border-bottom-blue-3px:after,
	.socials li span,
	.infobox .bottom-line,
	.widget_out_stuff2 .item-con-t1 header .overlay,
	.item-con-t1 .blue-line,
	.widget_out_stuff-container .item-con-t1 .corner,
	.member-social a:hover,
	.gallery-image-links a span:first-child+span,
	.images-slider .flex-direction-nav li a:hover,
	.teaser a .advantages-img span:first-child+span,
	.rev-direction-nav a span:hover,
	.dropcap_circle .dropcap_letter,
	.sc-icon.sc-icon-style2:hover span, .btn-style2, 
	.sc-skillbar-style-2 .sc-skillbar-bar span, 
	.sc-skillbar-style-2 .sc-skillbar-bar span:after, 
	.service.service-style2:hover .service-icon div
	<?php
}

/**
 * Get main color background gradient classes
 */
function ts_get_main_color_background_gradient_classes()
{
	?>
	.blue-grad
	<?php
}


/**
 * Get main color background radial gradient classes
 */
function ts_get_main_color_background_radial_gradient_classes()
{
	?>
	.blue-radial-grad
	<?php
}

/**
 * Get main color selection classes
 */
function ts_get_main_color_selection_classes()
{
	?>

	<?php
}

/**
 * Get main color border color classes
 */
function ts_get_main_color_border_color_classes()
{
	?>
	.service-icon:hover div
	<?php
}

/**
 * Get main color border top color classes
 */
function ts_get_main_color_border_top_color_classes()
{
	?>
	.menu>li:hover>.sub-menu,
	.z-active .z-link
	<?php
}

/**
 * Get main color border top color classes
 */
function ts_get_main_color_border_bottom_color_classes()
{
	?>
	.widget_multi_posts_entries .header,
	.underline .z-link,
	.infobox .bottom-line,
	.bottom-left .z-active .z-link,
	.bottom-right .z-active .z-link,
	.bottom-center .z-active .z-link
	<?php
}


/**
 * Get main color border left color classes
 */
function ts_get_main_color_border_left_color_classes()
{
	?>
	.purchase-plate,
	.sc-call-to-action,
	.vertical.top-left .z-active .z-link
	<?php
}

/**
 * Get main color border right color classes
 */
function ts_get_main_color_border_right_color_classes()
{
	?>
	.vertical.top-right .z-active .z-link
	<?php
}

/**
 * Get main body text color classes
 */
function ts_get_main_body_text_color_classes()
{
	?>
	body
	<?php
}

/**
 * Get second body text color classes
 */
function ts_get_second_body_text_color_classes()
{
	?>

	<?php
}

/**
 * Get header background color classess
 */
function ts_get_header_background_color_classes()
{
	?>
	header.page-header .preheader,
	header.page-header .wrapper-bg
	<?php
}

/**
 * Get page title background color classess
 */
function ts_get_page_title_background_color_classes()
{
	?>
	.marble
	<?php
}

/**
 * Get menu background color classess
 */
function ts_get_menu_background_color_classes()
{
	?>
	div.wrapper.menu-bg.custom-menu-bg,
	.wrapper.dark-menu
	<?php
}

/**
 * Get body background color 1 classess
 */
function ts_get_body_background_color_1_classes()
{
	?>
	.marble-color
	<?php
}

/**
 * Get body background color 2 classess
 */
function ts_get_body_background_color_2_classes()
{
	?>
	.default-bg
	<?php
}

/**
 * Get headers text color classes
 */
function ts_get_headers_text_color_classes()
{
	?>
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.post>header h2,
	.post h1,
	.widget_recent_posts_2 .item header h1,
	.widget_recent_posts_2 .item header h1 a,
	.sc-divider-style-2 .sc-divider-text,
	.number-of-comments,
	.number-of-comments span
	<?php
}

/**
 * Get sub menu background color classes
 */
function ts_get_sub_menu_background_color_classes()
{
	?>
	.mega-menu>ul,
	.menu>li>.sub-menu>li>a
	<?php
}

/**
 * Get sub menu background color classes
 */
function ts_get_sub_menu_background_color_2_classes()
{
	?>
	.menu>li>.sub-menu>li>a,
	.headerstyle4 .menu li.mega-menu ul li a
	<?php
}

/**
 * Get preheader background color classes
 */
function ts_get_preheader_background_color_classes()
{
	?>
	.preheader
	<?php
}

/**
 * Get preheader text color classes
 */
function ts_get_preheader_text_color_classes()
{
	?>
	.preheader .phone.contact
	<?php
}


/**
 * get foote_background_color_classes
 */
function ts_get_footer_background_color_classes()
{
	?>
	footer>.grey
	<?php
}

/**
 * Get footer headers color classes
 */
function ts_get_footer_headers_color_classes()
{
	?>
	footer .widget h1
	<?php
}

/**
 * Get footer main text color classes
 */
function ts_get_footer_main_text_color_classes()
{
	?>
	footer p,
	footer p.wysija-text,
	footer .widget_text address,
	footer .latest-excerpts p,
	footer .widget_text div
	<?php
}

/**
 * Get footer second text color classes
 */
function ts_get_footer_second_text_color_classes()
{
	?>

	<?php
}

/**
 * Get copyrights bar background classes
 */
function ts_get_copyrights_bar_background_classes()
{
	?>
	footer .copyright-bar
	<?php
}

/**
 * Get copyrights bar text color classes
 */
function ts_get_copyrights_bar_text_color_classes()
{
	?>
	footer .copyright-bar,
	footer .copyright-bar span.copyright
	<?php
}

/**
 * Get our staff shadow color classes
 */
function ts_get_our_staff_shadow_color_classes()
{
	?>
	.widget_out_stuff-container .item-con-t1:hover
	<?php
}
?>