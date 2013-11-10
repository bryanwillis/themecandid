<?php
/**
 * Shortcodes
 *
 * @package framework
 * @since framework 1.0
 */

require_once get_template_directory().'/inc/shortcodes/accordion.php';
require_once get_template_directory().'/inc/shortcodes/button.php';
require_once get_template_directory().'/inc/shortcodes/columns.php';
require_once get_template_directory().'/inc/shortcodes/call_to_action.php';
require_once get_template_directory().'/inc/shortcodes/call_to_action_2.php';
require_once get_template_directory().'/inc/shortcodes/divider.php';
require_once get_template_directory().'/inc/shortcodes/dropcaps.php';
require_once get_template_directory().'/inc/shortcodes/embed_media.php';
require_once get_template_directory().'/inc/shortcodes/featured_projects.php';
require_once get_template_directory().'/inc/shortcodes/flexslider.php';
require_once get_template_directory().'/inc/shortcodes/gal.php';
require_once get_template_directory().'/inc/shortcodes/headers.php';
require_once get_template_directory().'/inc/shortcodes/highlight.php';
require_once get_template_directory().'/inc/shortcodes/icons.php';
require_once get_template_directory().'/inc/shortcodes/icons_list.php';
require_once get_template_directory().'/inc/shortcodes/icon.php';
require_once get_template_directory().'/inc/shortcodes/icon_2.php';
require_once get_template_directory().'/inc/shortcodes/icon_3.php';
require_once get_template_directory().'/inc/shortcodes/icon_4.php';
require_once get_template_directory().'/inc/shortcodes/icon_5.php';
require_once get_template_directory().'/inc/shortcodes/icon_box.php';
require_once get_template_directory().'/inc/shortcodes/image.php';
require_once get_template_directory().'/inc/shortcodes/images_slider.php';
require_once get_template_directory().'/inc/shortcodes/intro.php';
require_once get_template_directory().'/inc/shortcodes/latest_posts.php';
require_once get_template_directory().'/inc/shortcodes/latest_works.php';
require_once get_template_directory().'/inc/shortcodes/list.php';
require_once get_template_directory().'/inc/shortcodes/message.php';
require_once get_template_directory().'/inc/shortcodes/our_clients.php';
require_once get_template_directory().'/inc/shortcodes/person.php';
require_once get_template_directory().'/inc/shortcodes/person_details.php';
require_once get_template_directory().'/inc/shortcodes/posts_slider.php';
require_once get_template_directory().'/inc/shortcodes/price_list.php';
require_once get_template_directory().'/inc/shortcodes/pricing_table.php';
require_once get_template_directory().'/inc/shortcodes/promo.php';
require_once get_template_directory().'/inc/shortcodes/promo_line.php';
require_once get_template_directory().'/inc/shortcodes/recent_posts.php';
require_once get_template_directory().'/inc/shortcodes/recent_projects.php';
require_once get_template_directory().'/inc/shortcodes/round_counter.php';
require_once get_template_directory().'/inc/shortcodes/quotes.php';
require_once get_template_directory().'/inc/shortcodes/s.php';
require_once get_template_directory().'/inc/shortcodes/skillbar.php';
require_once get_template_directory().'/inc/shortcodes/space.php';
require_once get_template_directory().'/inc/shortcodes/steps.php';
require_once get_template_directory().'/inc/shortcodes/special_text.php';
require_once get_template_directory().'/inc/shortcodes/tabs.php';
require_once get_template_directory().'/inc/shortcodes/teaser.php';
require_once get_template_directory().'/inc/shortcodes/teaser_2.php';
require_once get_template_directory().'/inc/shortcodes/testimonial.php';
require_once get_template_directory().'/inc/shortcodes/testimonials.php';
require_once get_template_directory().'/inc/shortcodes/testimonials_2.php';
require_once get_template_directory().'/inc/shortcodes/text.php';


/* PLEASE ADD every new shortcode to the get_shortcodes_help function below (all except columns shortcodes which are includes in inc/tinymce.js.php */

/**
 * Get shortcodes list
 *
 */
function ts_get_shortcodes_list()
{
	$aHelp = array(
		/*
		array(
			'shortcode' => '',
			'name' => 'Title',
			'description' => Description,  can be an array,
			'usage' => 'Example usage, can be an array',
		),
		*/
		array(
			'shortcode' => 'accordion',
			'name' => __('Accordion','framework'),
			'description' => '',
			'usage' => '[accordion style="normal" open="yes"][accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle][/accordion]',
			'code' => '[accordion style="{style}" open="{open}"]{child}[/accordion]',
			'fields' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'desc' => '',
					'values' => array(
						'boxed' => __('boxed', 'framework'),
						'normal' => __('normal', 'framework'),
						'modern' => __('modern', 'framework')
					)
				),
				'open' => array(
					'type' => 'select',
					'label' => __('Open first', 'framework'),
					'desc' => '',
					'values' => array(
						'yes' => __('yes', 'framework'),
						'no' => __('no', 'framework')
					)
				)
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'fields' => array(
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				),
				'name' => __('Accordion item','framework'),
				'code' => '[accordion_toggle title="{title}"]{content}[/accordion_toggle]',
			)
		),
		array(
			'shortcode' => 'button',
			'name' => __('Button','framework'),
			'description' => array(
				__('color - text color','framework'),
				__('background - background color','framework'),
				__('size - small, regular, large - default: regular','framework'),
				__('target - _blank, _parent, _self, _top','framework'),
			),
			'usage' => '[button color="#555555" style="1" size="small" icon="icon-briefcase" url="http://yourdomain.com" target="_blank" ]Your content here...[/button]',
			'code' => '[button color="{color}" style="{style}" size="{size}" icon="{icon}" target="{target}" url="{url}"]{content}[/button]',
			'fields' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3'
					),
					'default' => '1',
					'desc' => ''
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Text color', 'framework'),
					'desc' => ''
				),
				'size' => array(
					'type' => 'select',
					'label' => __('Size', 'framework'),
					'values' => array(
						'small' => __('small', 'framework'),
						'regular' => __('regular', 'framework'),
						'large' => __('large', 'framework')
					),
					'default' => 'regular',
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon (style 2 only)', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'call_to_action',
			'name' => __('Call To Action','framework'),
			'description' => array(
				__('color - gray, black, red, orange, blue, green','framework'),
				__('size - small, regular, large','framework'),
				__('target - _blank, _parent, _self, _top','framework'),
				__('position - left, right, bottom','framework'),
			),
			'usage' => '[call_to_action button_text="test" text="test" color="gray" size="regular" url="" target="" position="bottom"]',
			'code' => '[call_to_action button_text="{buttontext}" text="{text}" color="{color}" size="{size}" url="{url}" target="{target}" position="{position}"]',
			'fields' => array(
				'buttontext' => array(
					'type' => 'text',
					'label' => __('Button label', 'framework'),
					'desc' => ''
				),
				'text' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Button color', 'framework'),
					'desc' => ''
				),
				'size' => array(
					'type' => 'select',
					'label' => __('Button size', 'framework'),
					'values' => array(
						'small' => __('small', 'framework'),
						'regular' => __('regular', 'framework'),
						'large' => __('large', 'framework')
					),
					'default' => 'regular',
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'position' => array(
					'type' => 'select',
					'label' => __('Position', 'framework'),
					'values' => array(
						'left' => __('left', 'framework'),
						'right' => __('right', 'framework'),
						'bottom' => __('bottom', 'framework')
					),
					'default' => 'regular',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'call_to_action_2',
			'name' => __('Call To Action 2','framework'),
			'description' => '',
			'usage' => '[call_to_action_2 style="1" header="Header text" content="Content text" buttontext="Button label"  background="#FF0000" background_hover="#FFFF00" url="http://url.." target="_self"]',
			'code' => '[call_to_action_2 style="{style}" header="{header}" content="{content}" buttontext="{buttontext}" background="{background}" background_hover="{backgroundhover}" url="{url}" target="{target}"]',
			'fields' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => __('1', 'framework'),
						'2' => __('2', 'framework'),
						'3' => __('3 (wide with gradient background)', 'framework'),
						'4' => __('4', 'framework')
					),
					'default' => '1',
					'desc' => ''
				),
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
				'buttontext' => array(
					'type' => 'text',
					'label' => __('Button label', 'framework'),
					'desc' => ''
				),
				'background' => array(
					'type' => 'colorpicker',
					'label' => __('Button background color', 'framework'),
					'desc' => ''
				),
				'backgroundhover' => array(
					'type' => 'colorpicker',
					'label' => __('Button hover background color', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'dropcaps',
			'name' => __('Dropcaps','framework'),
			'description' => array(
				__('type - circle - optional','framework')
			),
			'usage' => '[dropcaps type="circle" color="#C4C4C4" background="#A4A4A4"]Your text here...[/dropcaps]',
			'code' => '[dropcaps type="{type}" color="{color}" background="{background}"]{content}[/dropcaps]',
			'fields' => array(
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'circle' => __('circle', 'framework'),
						'standard' => __('standard', 'framework')
					),
					'default' => 'circle',
					'desc' => ''
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Color', 'framework'),
					'desc' => ''
				),
				'background' => array(
					'type' => 'colorpicker',
					'label' => __('Background color', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'featured_projects',
			'name' => __('Featured projects','framework'),
			'description' => '',
			'usage' => '[featured_projects category="" header="Featured projects" limit="6"]Your text here...[/featured_projects]',
			'code' => '[featured_projects category="{category}" header="{header}" limit="{limit}"]{description}[/featured_projects]',
			'fields' => array(
				'category' => array(
					'type' => 'text',
					'label' => __('Category ID', 'framework'),
					'desc' => ''
				),
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				),
				'description' => array(
					'type' => 'wp_editor',
					'label' => __('Description', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'divider',
			'name' => __('Divider','framework'),
			'description' => array(
				__('align - left, right, center','framework'),
				__('size - smaller, normal, larger','framework'),
				__('scrolltext - optional','framework')
			),
			'usage' => '[divider style="1" align="left" size="normal" scrolltext="Scroll to top"]Your text here...[/divider]',
			'code' => '[divider style="{style}" align="{align}" size="{size}" variant="{variant}" dimension="{dimension}" color="{color}" scrolltext="{scrolltext}"]{content}[/divider]',
			'fields' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2'
					),
					'default' => '1',
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Text align', 'framework'),
					'values' => array(
						'center' => __('center','framework'),
						'left' => __('left','framework'),
						'right' => __('right','framework')
					),
					'desc' => ''
				),
				'size' => array(
					'type' => 'select',
					'label' => __('Content font size', 'framework'),
					'values' => array(
						'normal' => __('normal','framework'),
						'smaller' => __('smaller','framework'),
						'larger' => __('larger','framework')
					),
					'desc' => ''
				),
				'variant' => array(
					'type' => 'select',
					'label' => __('Variant (style 1 only)', 'framework'),
					'values' => array(
						'normal' => __('normal','framework'),
						'dotted' => __('dotted','framework')
					),
					'desc' => ''
				),
				'dimension' => array(
					'type' => 'select',
					'label' => __('Dimension (style 1 only)', 'framework'),
					'values' => array(
						'1px' => '1 px',
						'2px' => '2 px',
						'3px' => '3 px',
						'4px' => '4 px',
						'5px' => '5 px'
					),
					'desc' => ''
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Color (style 1 only)', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
				'scrolltext' => array(
					'type' => 'text',
					'label' => __('Scroll to top text', 'framework'),
					'desc' => __('Leave empty to disable scrolling', 'framework'),
				)
			)

		),
		array(
			'shortcode' => 'gal',
			'name' => __('Gallery','framework'),
			'description' => '',
			'usage' => '[gal zoom="enabled"][gal_item tooltip="Your text here..."]image.png[/gal_item][/gal]',
			'code' => '[gal zoom="{zoom}"]{child}[/gal]',
			'fields' => array(
				'zoom' => array(
					'type' => 'select',
					'label' => __('Zoom image', 'framework'),
					'values' => array(
						'enabled' => __('Enabled','framework'),
						'disabled' => __('Disabled','framework')
					),
					'default' => 'enabled',
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Gallery Item', 'framework'),
			'child' => array(
				'name' => __('Gallery item','framework'),
				'code' => '[gal_item tooltip="{tooltip}"]{image}[/gal_item]',
				'fields' => array(
					'image' => array(
						'type' => 'upload',
						'label' => __('Image', 'framework'),
						'desc' => ''
					),
					'tooltip' => array(
						'type' => 'textarea',
						'label' => __('Tooltip', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'heading',
			'name' => __('Heading','framework'),
			'description' => '',
			'usage' => '[heading type="1"]Your text here...[/heading]',
			'code' => '[heading type={type}]{content}[/heading]',
			'fields' => array(
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'1' => 'H1',
						'2' => 'H2',
						'3' => 'H3',
						'4' => 'H4',
						'5' => 'H5'
					),
					'default' => '1',
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'highlight',
			'name' => __('Highlight','framework'),
			'description' => array(
				__('color - background color','framework'),
				__('fullwidth - yes, no - from edge to edge of the screen','framework')
			),
			'usage' => '[highlight color="#ebebeb" border_color="#dedede" background_image="image.png" background_attachment="scroll" horizontal_position="left" vertical_position="top" background_stretch="no" min_height="100" first_page="no" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="0" fullwidth="yes"]Your text here...[/highlight]',
			'code' => '[highlight color="{color}" border_color="{bordercolor}" background_image="{backgroundimage}" background_attachment="{backgroundattachment}" background_position="{backgroundposition}" background_stretch="{backgroundstretch}" min_height="{minheight}" first_page="{firstpage}" last_page="{lastpage}" padding_top="{paddingtop}" padding_bottom="{paddingbottom}" margin_bottom="{marginbottom}" fullwidth="{fullwidth}"]{content}[/highlight]',
			'fields' => array(
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Color', 'framework'),
					'desc' => ''
				),
				'bordercolor' => array(
					'type' => 'colorpicker',
					'label' => __('Border color', 'framework'),
					'desc' => ''
				),
				'backgroundimage' => array(
					'type' => 'upload',
					'label' => __('Background image', 'framework'),
					'desc' => ''
				),
				'backgroundattachment' => array(
					'type' => 'select',
					'label' => __('Background attachment', 'framework'),
					'values' => array(
						'scroll' => __('scroll', 'framework'),
						'fixed' => __('fixed', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'backgroundposition' => array(
					'type' => 'select',
					'label' => __('Background position', 'framework'),
					'values' => array(
						'left top' => __('left top','framework'),
						'left center' => __('left center','framework'),
						'left bottom' => __('left bottom','framework'),
						'right top' => __('right top','framework'),
						'right center' => __('right center','framework'),
						'right bottom' => __('right bottom','framework'),
						'center top' => __('center top','framework'),
						'center center' => __('center center','framework'),
						'center bottom' => __('center bottom','framework')
					),
					'default' => 'left top',
					'desc' => ''
				),
				'backgroundstretch' => array(
					'type' => 'select',
					'label' => __('Background stretch', 'framework'),
					'values' => array(
						'yes' => __('yes', 'framework'),
						'no' => __('no', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'minheight' => array(
					'type' => 'text',
					'label' => __('Minimum height (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'firstpage' => array(
					'type' => 'select',
					'label' => __('First element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'lastpage' => array(
					'type' => 'select',
					'label' => __('Last element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'paddingtop' => array(
					'type' => 'text',
					'label' => __('Padding top (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'paddingbottom' => array(
					'type' => 'text',
					'label' => __('Padding bottom (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'marginbottom' => array(
					'type' => 'text',
					'label' => __('Margin bottom (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'fullwidth' => array(
					'type' => 'select',
					'label' => __('Full width', 'framework'),
					'values' => array(
						'yes' => __('yes', 'framework'),
						'no' => __('no', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon',
			'name' => __('Icon','framework'),
			'description' => '',
			'usage' => '[icon icon="img-1" icon_upload="" animation="showup" title="Your title" content="Your content here..."]',
			'code' => '[icon icon="{icon}" icon_upload="{iconupload}" url="{url}" target="{target}" animation="{animation}" title="{title}" content="{content}"]',
			'fields' => array(
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon (choose or upload below)', 'framework'),
					'values' => array(
						'none' => __('none', 'framework'),
						'img-1' => __('Dialog', 'framework'),
						'img-2' => __('Scalability', 'framework'),
						'img-3' => __('Globe', 'framework'),
						'img-4' => __('Test', 'framework'),
						'img-5' => __('Docs', 'framework'),
						'img-6' => __('Paint', 'framework'),
						'img-7' => __('Exchange', 'framework'),
						'img-8' => __('Equalizer', 'framework'),
						'footprint' => __('Footprint', 'framework'),
						'setting' => __('Setting', 'framework'),
					),
					'default' => '',
					'desc' => ''
				),
				'iconupload' => array(
					'type' => 'upload',
					'label' => __('Upload icon', 'framework'),
					'desc' => ''
				),
				'animation' => array(
					'type' => 'select',
					'label' => __('Animation', 'framework'),
					'values' => array(
						'none' => __('none','framework'),
						'showup' => __('show up','framework')
					),
					'default' => '',
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('Url', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon_2',
			'name' => __('Icon 2','framework'),
			'description' => '',
			'usage' => '[icon_2 icon="img-1" url="http://...." target="_blank" title="Your title" content="Your content here..."]',
			'code' => '[icon_2 icon="{icon}" url="{url}" target="{target}" title="{title}" content="{content}"]',
			'fields' => array(
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'url' => array(
					'type' => 'text',
					'label' => __('Url', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon_3',
			'name' => __('Icon 3','framework'),
			'description' => '',
			'usage' => '[icon_3 icon="icon-glass" title="Your title"]Your content here...[/icon_3]',
			'code' => '[icon_3 icon="{icon}" title="{title}"]{content}[/icon_3]',
			'fields' => array(
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon_4',
			'name' => __('Icon 4','framework'),
			'description' => '',
			'usage' => '[icon_4 icon="icon-glass" size="12" color="#FF0000"]',
			'code' => '[icon_4 icon="{icon}" size="{size}" color="{color}"]',
			'fields' => array(
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'size' => array(
					'type' => 'text',
					'label' => __('Size (px)', 'framework'),
					'desc' => __('Default size if empty', 'framework')
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Color', 'framework'),
					'desc' => __('Default color if empty', 'framework')
				)
			)
		),
		array(
			'shortcode' => 'icon_5',
			'name' => __('Icon 5','framework'),
			'description' => '',
			'usage' => '[icon_5 icon="icon_search" color="#FF0000" title="Your title"]Your content here...[/icon_5]',
			'code' => '[icon_5 icon="{icon}" icon_color="{iconcolor}" text_color="{textcolor}" title="{title}"]{content}[/icon_5]',
			'fields' => array(
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'iconcolor' => array(
					'type' => 'colorpicker',
					'label' => __('Icon background color', 'framework'),
					'desc' => ''
				),
				'textcolor' => array(
					'type' => 'colorpicker',
					'label' => __('Text color', 'framework'),
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icon_box',
			'name' => __('Icon Box','framework'),
			'description' => '',
			'usage' => '[icon_box icon="icon-search" url="http://..." target="_self" title="Your title"]Your content here...[/icon_box]',
			'code' => '[icon_box icon="{icon}" url="{url}" target="{target}" title="{title}"]{content}[/icon_box]',
			'fields' => array(
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				),
				'url' => array(
					'type' => 'text',
					'label' => __('Url', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'icons',
			'name' => __('Icons','framework'),
			'description' => '',
			'usage' => '[icons animation="showup"][icon type="icon-music" url="http://..." title="Your title..."]Your content...[/icon][/icons]',
			'code' => '[icons animation="{animation}"]{child}[/icons]',
			'fields' => array(
				'animation' => array(
					'type' => 'select',
					'label' => __('Animation', 'framework'),
					'values' => array(
						'none' => __('none','framework'),
						'showup' => __('show up','framework')
					),
					'default' => '',
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Icon', 'framework'),
			'child' => array(
				'name' => __('Icon','framework'),
				'code' => '[icon_item type="{type}" url="{url}" target="{target}" title="{title}"]{content}[/icon_item]',
				'fields' => array(
					'type' => array(
						'type' => 'select',
						'label' => __('Type', 'framework'),
						'values' => ts_getFontAwesomeArray(true,
							array(
								'img-1' => __('Box', 'framework'),
								'img-2' => __('Dynamic', 'framework'),
								'img-3' => __('Support', 'framework'),
								'champion' => __('Champion', 'framework'),
								'function' => __('Function', 'framework'),
								'leaf' => __('Leaf', 'framework'),
								'light' => __('Light', 'framework'),
								'settings' => __('Settings', 'framework'),
								'show' => __('Show', 'framework'),
								'time' => __('Time', 'framework')
							)
						),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					),
					'url' => array(
						'type' => 'text',
						'label' => __('Url', 'framework'),
						'desc' => ''
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Target', 'framework'),
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'icons_list',
			'name' => __('Icons List','framework'),
			'description' => '',
			'usage' => '[icons_list animation="showup"][icons_list_item type="icon-music" url="http://..." title="Your title..."]Your content...[/icons_list_item][/icons_list]',
			'code' => '[icons_list animation="{animation}"]{child}[/icons_list]',
			'fields' => array(
				'animation' => array(
					'type' => 'select',
					'label' => __('Animation', 'framework'),
					'values' => array(
						'none' => __('none','framework'),
						'showup' => __('show up','framework')
					),
					'default' => '',
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Icon', 'framework'),
			'child' => array(
				'name' => __('Icon','framework'),
				'code' => '[icons_list_item type="{type}" title="{title}"]{content}[/icons_list_item]',
				'fields' => array(
					'type' => array(
						'type' => 'select',
						'label' => __('Type', 'framework'),
						'values' => ts_getFontAwesomeArray(true),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'wp_editor',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'image',
			'name' => __('Image','framework'),
			'description' => '',
			'usage' => '[image animaton="scale" size="half" align="alignleft"]image.png[/image]',
			'code' => '[image animation="{animation}" size="{size}" align="{align}"]{image}[/image]',
			'fields' => array(
				'image' => array(
					'type' => 'upload',
					'label' => __('Image', 'framework'),
					'desc' => ''
				),
				'animation' => array(
					'type' => 'select',
					'label' => __('Animation', 'framework'),
					'values' => array(
						'left-to-right' => __('left-to-right', 'framework'),
						'right-to-left' => __('right-to-left', 'framework'),
						'bottom-to-top' => __('bottom-to-top', 'framework'),
						'scale' => __('scaless', 'framework')
					),
					'default' => 'left-to-right',
					'desc' => ''
				),
				'size' => array(
					'type' => 'select',
					'label' => __('Image width', 'framework'),
					'values' => array(
						'dont_scale' => __('dont scale', 'framework'),
						'full' => __('full', 'framework'),
						'half' => __('half', 'framework'),
						'one_third' => __('1/3', 'framework'),
						'one_fourth' => __('1/4', 'framework')
					),
					'default' => 'dont_scale',
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Align', 'framework'),
					'values' => array(
						'alignnone' => __('none', 'framework'),
						'alignleft' => __('left', 'framework'),
						'alignright' => __('right', 'framework'),
						'aligncenter' => __('center', 'framework')
					),
					'default' => 'dont_scale',
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'images_slider',
			'name' => __('Images Slider','framework'),
			'description' => array(
				__('url - optional','framework'),
				__('target - _blank, _parent, _self, _top','framework')
			),
			'usage' => array(
				'[images_slider][image_item url="http://test.com" target="_blank"]image.png[/image_item][image_item url="http://test2.com"]image2.png[/image_item][/images_slider]'
			),
			'code' => '[images_slider]{child}[/images_slider]',
			'add_child_button' => __('Add Slider Item', 'framework'),
			'child' => array(
				'name' => __('Sliders item','framework'),
				'code' => '[image_item url="{url}" target="{target}"]{image}[/image_item]',
				'fields' => array(
					'url' => array(
						'type' => 'text',
						'label' => __('URL', 'framework'),
						'desc' => ''
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Target', 'framework'),
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
						'desc' => ''
					),
					'image' => array(
						'type' => 'upload',
						'label' => __('Image', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'latest_posts',
			'name' => __('Latest posts','framework'),
			'description' => '',
			'usage' => '[latest_posts header="Latest posts" limit="12"]',
			'code' => '[latest_posts header="{header}" limit="{limit}"]',
			'fields' => array(
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Posts limit', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'latest_works',
			'name' => __('Latest works','framework'),
			'description' => '',
			'usage' => '[latest_works header="Latest Works" limit=10]',
			'code' => '[latest_works header="{header}" description="{description}" limit="{limit}"]',
			'fields' => array(
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				),
				'description' => array(
					'type' => 'text',
					'label' => __('Description', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'list',
			'name' => __('List','framework'),
			'description' => array(
				__('type - icon-ok, icon-check, icon-check-empty, icon-circle, icon-angle-right, icon-check-empty','framework')
			),
			'usage' => '[list type="icon-check-empty"]Your UL list here...[/list]',
			'code' => '[list type="{type}"]<ul>{child}</ul>[/list]',
			'fields' => array(
				'type' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'icon-arrow' => 'icon-arrow',
						'icon-circle' => 'icon-circle',
						'icon-check' => 'icon-check',
						'icon-star' => 'icon-star',
						'icon-plus' => 'icon-plus',
						'icon-dash' => 'icon-dash'
					),
					'desc' => ''
				),
			),
			'add_child_button' => __('Add List Item', 'framework'),
			'child' => array(
				'name' => __('List item','framework'),
				'code' => '<li>{content}</li>',
				'fields' => array(
					'content' => array(
						'type' => 'text',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				),
			)
		),
		array(
			'shortcode' => 'message',
			'name' => __('Message','framework'),
			'description' => __('type - info, alert, success, error','framework'),
			'usage' => '[message type="info"]Your content here...[/message]',
			'code' => '[message type="{type}"]{content}[/message]',
			'fields' => array(
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'info' => __('info','framework'),
						'alert' => __('alert','framework'),
						'success' => __('success','framework'),
						'error' => __('error','framework')
					),
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'our_clients',
			'name' => __('Our clients','framework'),
			'description' => '',
			'usage' => array(
				'[our_clients header="Your header..."][our_clients_item url="http://test.com" target="_blank"]image.png[/our_clients_item][/our_clients]'
			),
			'code' => '[our_clients header="{header}"]{child}[/our_clients]',
			'fields' => array(
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Item', 'framework'),
			'child' => array(
				'name' => __('Items','framework'),
				'code' => '[our_clients_item url="{url}" target="{target}"]{image}[/our_clients_item]',
				'fields' => array(
					'url' => array(
						'type' => 'text',
						'label' => __('URL', 'framework'),
						'desc' => ''
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Target', 'framework'),
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
						'desc' => ''
					),
					'image' => array(
						'type' => 'upload',
						'label' => __('Image', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'person',
			'name' => __('Person','framework'),
			'description' => '',
			'usage' => '[persons id=1]',
			'code' => '[person id="{id}"]',
			'fields' => array(
				'id' => array(
					'type' => 'text',
					'label' => __('Person ID', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'person_details',
			'name' => __('Person details','framework'),
			'description' => '',
			'usage' => '[person_details id=1 header="Personal details"]',
			'code' => '[person_details id="{id}" header="{header}"]',
			'fields' => array(
				'id' => array(
					'type' => 'text',
					'label' => __('Person ID', 'framework'),
					'desc' => ''
				),
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'posts_slider',
			'name' => __('Posts slider','framework'),
			'description' => array(
				__('id - included posts (optional)','framework'),
				__('post_type - post type to show (default: post)','framework'),
				__('category - list of categories to show or to exclude (optional)','framework'),
				__('orderby - sort retrieved posts by parameter (default: date)','framework'),
				__('order - designates the ascending or descending order (default: DESC)','framework'),
				__('description - no, excerpt - show or hide description (default: excerpt)','framework'),
			),
			'usage' => '[posts_slider id="2,4,3" post_type="post/page" category="1,-2,-3" limit="4" orderby="date" order="desc" description="excerpt" excerpt="12"]',
			'code' => '[posts_slider id="{id}" post_type="{type}" category="{category}" limit="{limit}" orderby="{orderby}" order="{order}" description="{description}" excerpt="{excerpt}"]',
			'fields' => array(
				'id' => array(
					'type' => 'text',
					'label' => __('Post IDs (comma separated)', 'framework'),
					'desc' => ''
				),
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'post' => __('post','framework'),
						'page' => __('page','framework')
					),
					'desc' => ''
				),
				'category' => array(
					'type' => 'text',
					'label' => __('Category IDs (comma separated)', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				),
				'orderby' => array(
					'type' => 'select',
					'label' => __('Order By', 'framework'),
					'values' => array(
						'date' => __('date','framework'),
						'title' => __('title','framework')
					),
					'desc' => ''
				),
				'order' => array(
					'type' => 'select',
					'label' => __('Order', 'framework'),
					'values' => array(
						'DESC' => __('DESC','framework'),
						'ASC' => __('ASC','framework')
					),
					'desc' => ''
				),
				'description' => array(
					'type' => 'select',
					'label' => __('Description', 'framework'),
					'values' => array(
						'no' => __('hidden','framework'),
						'excerpt' => __('excerpt','framework')
					),
					'desc' => ''
				),
				'excerpt' => array(
					'type' => 'text',
					'label' => __('Excerpt words limit', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'promo',
			'name' => __('Promo','framework'),
			'description' => '',
			'usage' => '[promo header="Header" content="Content" url="http://..." target="_self" image="sample.png"]',
			'code' => '[promo header="{header}" content="{content}" url="{url}" target="{target}" image="{image}"]',
			'fields' => array(
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'image' => array(
					'type' => 'upload',
					'label' => __('Image', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'promo_line',
			'name' => __('Promo line','framework'),
			'description' => '',
			'usage' => '[promo_line color="#ebebeb" border_color="#dedede" background_image="image.png" background_attachment="scroll" horizontal_position="left" vertical_position="top" first_page="no" last_page="yes" padding_top="10" padding_bottom="10" margin_bottom="0" fullwidth="yes" header="Your header" subheader="Your subheader" buttontext="Click me" url="http://..." target="_blank" icon="icon-glass"]',
			'code' => '[promo_line color="{color}" border_color="{bordercolor}" background_image="{backgroundimage}" background_attachment="{backgroundattachment}" background_position="{backgroundposition}" first_page="{firstpage}" last_page="{lastpage}" padding_top="{paddingtop}" padding_bottom="{paddingbottom}" margin_bottom="{marginbottom}" fullwidth="{fullwidth}" header="{header}" subheader="{subheader}" buttontext="{buttontext}" url="{url}" target="{target}" icon="{icon}"]',
			'fields' => array(
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Color', 'framework'),
					'desc' => ''
				),
				'bordercolor' => array(
					'type' => 'colorpicker',
					'label' => __('Border color', 'framework'),
					'desc' => ''
				),
				'backgroundimage' => array(
					'type' => 'upload',
					'label' => __('Background image', 'framework'),
					'desc' => ''
				),
				'backgroundattachment' => array(
					'type' => 'select',
					'label' => __('Background attachment', 'framework'),
					'values' => array(
						'scroll' => __('scroll', 'framework'),
						'fixed' => __('fixed', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'backgroundposition' => array(
					'type' => 'select',
					'label' => __('Background position', 'framework'),
					'values' => array(
						'left top' => __('left top','framework'),
						'left center' => __('left center','framework'),
						'left bottom' => __('left bottom','framework'),
						'right top' => __('right top','framework'),
						'right center' => __('right center','framework'),
						'right bottom' => __('right bottom','framework'),
						'center top' => __('center top','framework'),
						'center center' => __('center center','framework'),
						'center bottom' => __('center bottom','framework')
					),
					'default' => 'left top',
					'desc' => ''
				),
				'minheight' => array(
					'type' => 'text',
					'label' => __('Minimum height (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'firstpage' => array(
					'type' => 'select',
					'label' => __('First element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'lastpage' => array(
					'type' => 'select',
					'label' => __('Last element on a page', 'framework'),
					'values' => array(
						'no' => __('no', 'framework'),
						'yes' => __('yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),
				'paddingtop' => array(
					'type' => 'text',
					'label' => __('Padding top (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'paddingbottom' => array(
					'type' => 'text',
					'label' => __('Padding bottom (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'marginbottom' => array(
					'type' => 'text',
					'label' => __('Margin bottom (px)', 'framework'),
					'default' => '',
					'desc' => ''
				),
				'fullwidth' => array(
					'type' => 'select',
					'label' => __('Full width', 'framework'),
					'values' => array(
						'yes' => __('yes', 'framework'),
						'no' => __('no', 'framework')
					),
					'default' => 'yes',
					'desc' => ''
				),
				'header' => array(
					'type' => 'text',
					'label' => __('Header', 'framework'),
					'desc' => ''
				),
				'subheader' => array(
					'type' => 'text',
					'label' => __('subheader', 'framework'),
					'desc' => ''
				),
				'buttontext' => array(
					'type' => 'text',
					'label' => __('Button text', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('URL', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon', 'framework'),
					'values' => ts_getFontAwesomeArray(true),
					'default' => '',
					'desc' => '',
					'class' => 'icons-dropdown'
				)
			)
		),
		array(
			'shortcode' => 'recent_posts',
			'name' => __('Recent posts','framework'),
			'description' => '',
			'usage' => '[recent_posts limit="12"]',
			'code' => '[recent_posts limit="{limit}"]',
			'fields' => array(
				'limit' => array(
					'type' => 'text',
					'label' => __('Posts limit', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'recent_projects',
			'name' => __('Recent projects','framework'),
			'description' => '',
			'usage' => '[recent_projects]',
			'code' => '[recent_projects]',
			'fields' => array(
				'description' => array(
					'type' => 'description',
					'label' => __('No options here', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'round_counter',
			'name' => __('Round counter','framework'),
			'description' => '',
			'usage' => '[round_counter title="Your title" counter="123"]',
			'code' => '[round_counter title="{title}" counter="{counter}"]',
			'fields' => array(
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'counter' => array(
					'type' => 'text',
					'label' => __('Counter', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'quotes',
			'name' => __('Quotes','framework'),
			'description' => array(
				__('style - classic, modern - default: classic','framework'),
				__('align - center, left, right - default: center','framework')
			),
			'usage' => array(
				'[quotes style="classic" author="John Doe"]Your text here...[/quotes]',
				'[quotes style="modern" align="" author="John Doe"]Your text here...[/quotes]'),
			
			'code' => '[quotes style="{style}" align="{align}" author="{author}"]{content}[/quotes]',
			'fields' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'classic' => __('classic','framework'),
						'modern' => __('modern','framework')
					),
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Align', 'framework'),
					'values' => array(
						'center' => __('center','framework'),
						'left' => __('left','framework'),
						'right' => __('right','framework')
					),
					'desc' => ''
				),
				'author' => array(
					'type' => 'text',
					'label' => __('Author', 'framework'),
					'desc' => ''
				),
				'content' => array(
					'type' => 'text',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'skillbars',
			'name' => __('Skill bars','framework'),
			'description' => '',
			'usage' => '[skillbar style="1" type="vertical" height="100"][skillbar_item percentage="80" title="Cooking"][skillbar_item percentage="99" title="Sleeping"][/skillbar]',
			'code' => '[skillbar style="{style}" type="{type}" height="{height}"]{child}[/skillbar]',
			'fields' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2'
					),
					'desc' => ''
				),
				
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'horizontal' => __('Horizontal','framework'),
						'vertical' => __('Vertical','framework')
					),
					'desc' => ''
				),
				'height' => array(
					'type' => 'text',
					'label' => __('Height (px)', 'framework'),
					'desc' => __('For vertical type only', 'framework')
				)
			),
			'add_child_button' => __('Add Skill Bar', 'framework'),
			'child' => array(
				'name' => __('Skill bar','framework'),
				'code' => '[skillbar_item percentage="{percentage}" title="{title}" color="{color}"]',
				'fields' => array(
					'percentage' => array(
						'type' => 'select',
						'label' => __('Percentage', 'framework'),
						'values' => ts_get_percentage_select_values(),
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'color' => array(
						'type' => 'colorpicker',
						'label' => __('Color', 'framework'),
						'desc' => ''
					)
				)
			)
		),
		array(
			'shortcode' => 'space',
			'name' => __('Space','framework'),
			'description' => '',
			'usage' => '[space height="20"]',
			'code' => '[space height="{height}"]',
			'fields' => array(
				'height' => array(
					'type' => 'text',
					'label' => __('Height (px)', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'special_text',
			'name' => __('Special text','framework'),
			'description' => '',
			'usage' => array('[special_text tagname="h2" pattern="no" color="#FF0000" font_size="12" font_weight="bold" font="Arial" margin_top="10" margin_bottom="10" align="left"]Your text here...[/special_text]'),
			'code' => '[special_text tagname="{tagname}" pattern="{pattern}" color="{color}" font_size="{fontsize}" font_weight="{fontweight}" font="{font}" margin_top="{margintop}" margin_bottom="{marginbottom}" align="{align}"]{content}[/special_text]',
			'fields' => array(
				'tagname' => array(
					'type' => 'select',
					'label' => __('Tag name', 'framework'),
					'values' => array(
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6'
					),
					'default' => 'brain',
					'desc' => ''
				),
				'pattern' => array(
					'type' => 'select',
					'label' => __('Pattern', 'framework'),
					'values' => array(
						'no' => __('No','framework'),
						'yes' => __('Yes', 'framework')
					),
					'default' => 'no',
					'desc' => ''
				),	
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Font color', 'framework'),
					'desc' => ''
				),
				'fontsize' => array(
					'type' => 'text',
					'label' => __('Font size', 'framework'),
					'desc' => ''
				),
				'fontweight' => array(
					'type' => 'select',
					'label' => __('Font weight', 'framework'),
					'values' => array(
						'default' => __('Default','framework'),
						'normal' => __('Normal', 'framework'),
						'bold' => __('Bold', 'framework'),
						'bolder' => __('Bolder', 'framework'),
						'light' => __('Light', 'framework')
					),
					'default' => 'default',
					'desc' => ''
				),
				'font' => array(
					'type' => 'select',
					'label' => __('Font', 'framework'),
					'desc' => '',
					'values' => ts_get_font_choices(true)
				),
				'margintop' => array(
					'type' => 'text',
					'label' => __('Margin top (px)', 'framework'),
					'desc' => ''
				),
				'marginbottom' => array(
					'type' => 'text',
					'label' => __('Margin bottom (px)', 'framework'),
					'desc' => ''
				),
				'align' => array(
					'type' => 'select',
					'label' => __('Align', 'framework'),
					'values' => array(
						'left' => __('Left','framework'),
						'center' => __('Center', 'framework'),
						'right' => __('Right', 'framework')
					),
					'default' => 'left',
					'desc' => ''
				),
				'content' => array(
					'type' => 'textarea',
					'label' => __('Content', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'steps',
			'name' => __('Steps','framework'),
			'description' => '',
			'usage' => '[steps][step icon="..." title="Your title" subtitle="Your subtitle" url="http://.." target="_blank"][/steps]',
			'code' => '[steps]{child}[/steps]',
			'add_child_button' => __('Add Step', 'framework'),
			'child' => array(
				'name' => __('Step','framework'),
				'code' => '[step icon="{icon}" title="{title}" subtitle="{subtitle}" url="{url}" target="{target}"]',
				'fields' => array(
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => array(
							'brain' => __('Brain', 'framework'),
							'bulb' => __('Bulb', 'framework'),
							'idea' => __('Idea', 'framework'),
							'list' => __('List', 'framework'),
							'mental' => __('Mental', 'framework'),
							'start' => __('Start', 'framework'),
							'strategy' => __('Strategy', 'framework'),
							'target' => __('Target', 'framework'),
							'time' => __('Time', 'framework'),
							'zen' => __('Zen', 'framework')
						),
						'default' => 'brain',
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'subtitle' => array(
						'type' => 'text',
						'label' => __('Subtitle', 'framework'),
						'desc' => ''
					),
					'url' => array(
						'type' => 'text',
						'label' => __('URL', 'framework'),
						'desc' => ''
					),
					'target' => array(
						'type' => 'select',
						'label' => __('Target', 'framework'),
						'values' => array(
							'_blank' => __('_blank', 'framework'),
							'_parent' => __('_parent', 'framework'),
							'_self' => __('_self', 'framework'),
							'_top' => __('_top', 'framework')
						),
						'default' => '_self',
						'desc' => ''
					)
				)
			)
		),
		array(
			'shortcode' => 'tabs',
			'name' => __('Tabs','framework'),
			'description' => '',
			'usage' => '[tabs orientation="horizontal" position="top-left" style="normal" autoplay="no" animation="fadein"][tab url="http://test.com" target="_blank"]Your text here...[/tab][/tabs]',
			'code' => '[tabs orientation="{orientation}" position="{position}" style="{style}" autoplay="{autoplay}" animation="{animation}"]{child}[/tabs]',
			'fields' => array(
				'orientation' => array(
					'type' => 'select',
					'label' => __('Orientation', 'framework'),
					'values' => array(
						'horizontal' => __('horizontal','framework'),
						'vertical' => __('vertical','framework')
					),
					'desc' => ''
				),
				'position' => array(
					'type' => 'select',
					'label' => __('Position', 'framework'),
					'values' => array(
						'top-left' => __('top-left','framework'),
						'top-right' => __('top-right','framework'),
						'top-center' => __('top-center','framework'),
						'top-compact' => __('top-compact','framework'),
						'bottom-left' => __('bottom-left','framework'),
						'bottom-center' => __('bottom-center','framework'),
						'bottom-right' => __('bottom-right','framework'),
						'bottom-compact' => __('bottom-compact','framework')
					),
					'desc' => __('When orientation option is set to "vertical", "only top-left" and "top-right" is supported!', 'framework')
				),
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'normal' => __('normal','framework'),
						'underline' => __('underline','framework')
					),
					'desc' => ''
				),
				'autoplay' => array(
					'type' => 'select',
					'label' => __('Autoplay', 'framework'),
					'values' => array(
						'no' => __('no','framework'),
						'yes' => __('yes','framework')
					),
					'desc' => ''
				),
				'animation' => array(
					'type' => 'select',
					'label' => __('Animation', 'framework'),
					'values' => array(
						'fadeIn' => __('fadeIn','framework'),
						'slideDown' => __('slideDown','framework')
					),
					'desc' => ''
				)
			),
			'add_child_button' => __('Add Tab', 'framework'),
			'child' => array(
				'name' => __('Tab','framework'),
				'code' => '[tab title="{title}" icon="{icon}" iconsize="{iconsize}"]{content}[/tab]',
				'fields' => array(
					'icon' => array(
						'type' => 'select',
						'label' => __('Icon', 'framework'),
						'values' => ts_getFontAwesomeArray(true),
						'default' => '',
						'desc' => '',
						'class' => 'icons-dropdown'
					),
					'iconsize' => array(
						'type' => 'select',
						'label' => __('Icon size', 'framework'),
						'values' => array(
							'icon-regular' => 'icon-regular',
							'icon-large' => 'icon-large',
							'icon-2x' => 'icon-2x',
							'icon-4x' => 'icon-4x',
						),
						'default' => '',
						'desc' => ''
					),
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'framework'),
						'desc' => ''
					),
					'content' => array(
						'type' => 'textarea',
						'label' => __('Content', 'framework'),
						'desc' => ''
					),
				)
			)
		),
		array(
			'shortcode' => 'teaser',
			'name' => __('Teaser','framework'),
			'description' => '',
			'usage' => '[teaser style="1" image="image.png" icon="..." title="Your title" subtitle="Your subtitle" url="http://..." target="_self"]',
			'code' => '[teaser style="{style}" image="{image}" icon={icon} title="{title}" subtitle="{subtitle}" url="{url}" target="{target}"]',
			'fields' => array(
				'style' => array(
					'type' => 'select',
					'label' => __('Style', 'framework'),
					'values' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5'
					),
					'desc' => ''
				),
				'image' => array(
					'type' => 'upload',
					'label' => __('Image', 'framework'),
					'desc' => ''
				),
				'icon' => array(
					'type' => 'select',
					'label' => __('Icon (style 3 and 4 only)', 'framework'),
					'values' => array(
						'teaser-icon1.png' => __('Icon 1', 'framework'),
						'teaser-icon2.png' => __('Icon 2', 'framework'),
						'teaser-icon3.png' => __('Icon 3', 'framework')
					),
					'default' => 'teaser-icon1',
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle (style 1,2 and 5 only)', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('Url', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'teaser_2',
			'name' => __('Teaser 2','framework'),
			'description' => '',
			'usage' => '[teaser_2 image="image.png" title="Your title" button="Click me" url="http://..." target="_self"]Your content..[/teaser_2]',
			'code' => '[teaser_2 image="{image}" title="{title}" button="{button}" url="{url}" target="{target}"]{content}[/teaser_2]',
			'fields' => array(
				'image' => array(
					'type' => 'upload',
					'label' => __('Image', 'framework'),
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'framework'),
					'desc' => ''
				),
				'button' => array(
					'type' => 'text',
					'label' => __('Button', 'framework'),
					'desc' => ''
				),
				'url' => array(
					'type' => 'text',
					'label' => __('Url', 'framework'),
					'desc' => ''
				),
				'target' => array(
					'type' => 'select',
					'label' => __('Target', 'framework'),
					'values' => array(
						'_blank' => __('_blank', 'framework'),
						'_parent' => __('_parent', 'framework'),
						'_self' => __('_self', 'framework'),
						'_top' => __('_top', 'framework')
					),
					'default' => '_self',
					'desc' => ''
				),
				'content' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'testimonial',
			'name' => __('Testimonial','framework'),
			'description' => '',
			'usage' => array('[testimonial id="2"]'),
			'code' => '[testimonial id="{id}"]',
			'fields' => array(
				'id' => array(
					'type' => 'text',
					'label' => __('ID', 'framework'),
					'desc' => ''
				)
			)
		),
		array(
			'shortcode' => 'testimonials',
			'name' => __('Testimonials','framework'),
			'description' => array(
				__('type - static/slider - default: slider','framework'),
				__('category - testimonial categories','framework'),
				__('limit - default: 3','framework')
			),
			'usage' => array('[testimonials type="static" title="Your title" category="3" limit="3"]'),
			'code' => '[testimonials type="{type}" title="{title}" category="{category}" limit="{limit}"]',
			'fields' => array(
				'type' => array(
					'type' => 'select',
					'label' => __('Type', 'framework'),
					'values' => array(
						'slider' => __('slider','framework'),
						'slider2' => __('slider','framework').' 2',
						'static' => __('static','framework')
					),
					'desc' => ''
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title (only slider 2)', 'framework'),
					'desc' => ''
				),
				'category' => array(
					'type' => 'text',
					'label' => __('Category ID', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'testimonials_2',
			'name' => __('Testimonials 2','framework'),
			'description' => '',
			'usage' => array('[testimonials_2 category="3" limit="3" color="#FF0000" content_font_size="12" author_font_size="10"]'),
			'code' => '[testimonials_2 category="{category}" limit="{limit}" color="{color}" content_font_size="{contentfontsize}" author_font_size="{authorfontsize}"]',
			'fields' => array(
				'category' => array(
					'type' => 'text',
					'label' => __('Category ID', 'framework'),
					'desc' => ''
				),
				'limit' => array(
					'type' => 'text',
					'label' => __('Limit', 'framework'),
					'desc' => ''
				),
				'color' => array(
					'type' => 'colorpicker',
					'label' => __('Text color', 'framework'),
					'desc' => ''
				),
				'contentfontsize' => array(
					'type' => 'text',
					'label' => __('Content font size', 'framework'),
					'desc' => ''
				),
				'authorfontsize' => array(
					'type' => 'text',
					'label' => __('Author font size', 'framework'),
					'desc' => ''
				),
			)
		),
		array(
			'shortcode' => 'text',
			'name' => __('Text','framework'),
			'description' => '',
			'usage' => '[text]Your text here...[/text]',
			'code' => '[text]{text}[/text]',
			'fields' => array(
				'text' => array(
					'type' => 'wp_editor',
					'label' => __('Content', 'framework'),
					'desc' => ''
				)
			)
		),
	);
	
	//adding custom items which are not shortcodes but are required for popup.php (eg. nav-menus.php icons)
	if (isset($_GET['custom_popup_items']) && $_GET['custom_popup_items'] == 1 && function_exists('ts_get_custom_popup_items')) {
		$custom_items = ts_get_custom_popup_items();
		if (is_array($custom_items)) {
			$aHelp = array_merge($aHelp,$custom_items);
		}
	}
	
	return $aHelp;
}

function ts_get_percentage_select_values()
{
	$a = array();
	for ($i = 1; $i <= 100; $i++)
	{
		$a[$i] = $i;
	}
	return $a;
}