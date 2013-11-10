<?php

/**
 * Theme options
 *
 * @package framework
 * @since framework 1.0
 */
/**
 * Initialize the options before anything else.
 */
add_action('admin_init', 'ts_custom_theme_options', 1);

/**
 * Initalize theme options scripts
 */
add_action('admin_enqueue_scripts', 'ts_framework_theme_options_scripts');

function ts_framework_theme_options_scripts() {
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_style('jquery-ui-my-theme', get_template_directory_uri() . "/framework/css/jquery-ui/jquery.ui.my-theme.css", false);
	
	wp_register_script('theme_options', get_template_directory_uri() . '/framework/js/theme-options.js', array('jquery'));
	wp_enqueue_script('theme_options');
	
	wp_register_script('screwdefaultbuttons', get_template_directory_uri() . '/framework/js/jquery.screwdefaultbuttonsV2.min.js', array('jquery'));
	wp_enqueue_script('screwdefaultbuttons');
}

/**
 * Build the custom settings & update OptionTree.
 */
function ts_custom_theme_options() {
	/**
	 * Get a copy of the saved settings array. 
	 */
	$saved_settings = get_option('option_tree_settings', array());
	
	$user_sidebars = ot_get_option('user_sidebars');
	$sidebar_choices = array();
	$sidebar_choices[] = array(
		'label' => __('Main', 'framework'),
		'value' => 'main',
		'src' => ''
	);
	if (is_array($user_sidebars)) {
		foreach ($user_sidebars as $sidebar) {
			$sidebar_choices[] = array(
				'label' => $sidebar['title'],
				'value' => sanitize_title($sidebar['title']),
				'src' => ''
			);
		}
	}
	
	/**
	 * Custom settings array that will eventually be 
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array(
		'sections' => array(
			array(
				'id' => 'general_settings',
				'title' => __('General Settings', 'framework')
			),
			array(
				'id' => 'fonts',
				'title' => __('Fonts', 'framework')
			),
			array(
				'id' => 'elements_color',
				'title' => __('Elements Color', 'framework')
			),
			array(
				'id' => 'pages',
				'title' => __('Pages', 'framework')
			),
			array(
				'id' => 'sidebars',
				'title' => __('Sidebars', 'framework')
			),
			array(
				'id' => 'integration',
				'title' => __('Integration', 'framework')
			),
			array(
				'id' => 'social',
				'title' => __('Contacts & Social', 'framework')
			),
			array(
				'id' => 'contact_form',
				'title' => __('Contact Form', 'framework')
			),
			array(
				'id' => 'translations',
				'title' => __('Translations', 'framework')
			)
		),
		//general_settings
		'settings' => array(
			array(
				'id' => 'body_class',
				'label' => __('Body class', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'w1170',
						'label' => __('Wide 1170px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'w960',
						'label' => __('Wide 960px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'b1170',
						'label' => __('Boxed 1170px', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'b960',
						'label' => __('Boxed 960px', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'logo_url',
				'label' => __('Custom logo', 'framework'),
				'desc' => __('Enter full URL of your logo image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'alternative_logo_url',
				'label' => __('Alternative custom logo for main menu style 4', 'framework'),
				'desc' => __('Enter full URL of your logo image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'sticky_logo_url',
				'label' => __('Sticky custom logo', 'framework'),
				'desc' => __('Enter full URL of your logo image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'show_sticky_menu',
				'label' => __('Show sticky menu', 'framework'),
				'desc' => __('Show or hide sticky menu', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'logo_top_margin',
				'label' => __('Logo top margin', 'framework'),
				'desc' => __('Enter number to set the top space of the logo', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'logo_left_margin',
				'label' => __('Logo left margin', 'framework'),
				'desc' => __('Enter number to set the left space of the logo', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'logo_bottom_margin',
				'label' => __('Logo bottom margin', 'framework'),
				'desc' => __('Enter number to set the bottom space of the logo', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'favicon',
				'label' => __('Favicon', 'framework'),
				'desc' => __('Enter Full URL of your favicon image or choose upload button', 'framework'),
				'std' => '',
				'type' => 'upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_color',
				'label' => __('Background color', 'framework'),
				'desc' => __('Enabled only when boxed layout is selected', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_pattern',
				'label' => __('Background pattern', 'framework'),
				'desc' => __('Enabled only when boxed layout is selected', 'framework'),
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_background_patterns()
			),
			array(
				'id' => 'background_image',
				'label' => __('Background image', 'framework'),
				'desc' => __('Choose "Image" option on "Background pattern" list and boxed layout to enable background', 'framework'),
				'std' => '',
				'type' => 'Upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'background_repeat',
				'label' => __('Background repeat', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'repeat',
						'label' => __('Repeat horizontally & vertically', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'repeat-x',
						'label' => __('Repeat horizontally', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'repeat-y',
						'label' => __('Repeat vertically', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no-repeat',
						'label' => __('No repeat', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'background_position',
				'label' => __('Background position', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'left',
						'label' => __('Left', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'center',
						'label' => __('Center', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'right',
						'label' => __('Right', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'background_attachment',
				'label' => __('Background attachment', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'scroll',
						'label' => __('Scroll', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'fixed',
						'label' => __('Fixed', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'background_size',
				'label' => __('Background size', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'original',
						'label' => __('Original', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'browser',
						'label' => __('Fits to browser size', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'default_title_background',
				'label' => __('Default title background', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Upload',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'header_text',
				'label' => __('Header text', 'framework'),
				'desc' => __('Main menu "Style 5" only', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'header_phone',
				'label' => __('Header phone', 'framework'),
				'desc' => __('Main menu style 2,3,5 only, works only with preheader enabled for  "Style 2"', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'header_email',
				'label' => __('Header email', 'framework'),
				'desc' => __('Main menu "Style 3" only', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'footer_text',
				'label' => __('Footer text', 'framework'),
				'desc' => __('You can add copyright text here.', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'main_menu_style',
				'label' => __('Main menu style', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_header_styles()
			),
			array(
				'id' => 'show_preheader',
				'label' => __('Show preheader', 'framework'),
				'desc' => __('Show or hide preheader (main menu "Style 2" only)', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			
			array(
				'id' => 'show_breadcrumbs',
				'label' => __('Show breadcrumbs', 'framework'),
				'desc' => __('Show or hide breadcrumbs', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'show_search_nav',
				'label' => __('Show search icon in navigation', 'framework'),
				'desc' => __('Show or hide search form right to the main navigation', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'retina_support',
				'label' => __('Retina support', 'framework'),
				'desc' => __('If enabled all images should be uploaded 2x larger. Requires more server resources if enabled.', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'disabled',
						'label' => __('Disabled', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled',
						'label' => __('Enabled', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'control_panel',
				'label' => __('Show control panel', 'framework'),
				'desc' => __('Shows the Control Panel on your homepage if enabled.', 'framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'general_settings',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'disabled',
						'label' => __('Disabled', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled_admin',
						'label' => __('Enabled for administrator', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'enabled_all',
						'label' => __('Enabled for all', 'framework'),
						'src' => ''
					)
				)
			),
			//fonts
			array(
				'id' => 'title_font',
				'label' => __('Title font', 'framework'),
				'desc' => __('Font style for page title','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'title_font_size',
				'label' => __('Title font size', 'framework'),
				'desc' => __('The size of the page title in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'content_font',
				'label' => __('Content font', 'framework'),
				'desc' => __('Font style for content','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'content_font_size',
				'label' => __('Content font size', 'framework'),
				'desc' => __('The size of the page content in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'menu_font',
				'label' => __('Menu font', 'framework'),
				'desc' => __('Font style for menu items', 'framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'menu_font_size',
				'label' => __('Menu font size', 'framework'),
				'desc' => __('The size of the menu elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'headers_font',
				'label' => __('Header font', 'framework'),
				'desc' => __('Font style for all headers (H1, H2 etc.)','framework'),
				'std' => '',
				'type' => 'select',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_font_choices()
			),
			array(
				'id' => 'h1_size',
				'label' => __('H1 font size', 'framework'),
				'desc' => __('The size of H1 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h2_size',
				'label' => __('H2 font size', 'framework'),
				'desc' => __('The size of H2 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h3_size',
				'label' => __('H3 font size', 'framework'),
				'desc' => __('The size of H3 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h4_size',
				'label' => __('H4 font size', 'framework'),
				'desc' => __('The size of H4 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h5_size',
				'label' => __('H5 font size', 'framework'),
				'desc' => __('The size of H5 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'h6_size',
				'label' => __('H6 font size', 'framework'),
				'desc' => __('The size of H6 elements in pixels','framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'fonts',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			//elements_color
			array(
				'id' => 'main_color',
				'label' => __('Main color', 'framework'),
				'desc' => __('Main theme color','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'main_body_background_color',
				'label' => __('Main body background color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'main_body_text_color',
				'label' => __('Main body text color', 'framework'),
				'desc' => __('Main body text color, used for post content.','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'headers_text_color',
				'label' => __('Headers text color', 'framework'),
				'desc' => __('Color of all headers','framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'header_background_color',
				'label' => __('Header background color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'page_title_background_color',
				'label' => __('Page title background color', 'framework'),
				'desc' => __('Background color of the page title', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'menu_background_color',
				'label' => __('Menu background color', 'framework'),
				'desc' => __('Background color of the menu (header style 1, 2 and 3 only)', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'menu_background_transparency',
				'label' => __('Menu background transparency', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ts_get_menu_background_transparency_values()
			),
			array(
				'id' => 'sub_menu_background_color',
				'label' => __('Sub menu background color', 'framework'),
				'desc' => __('Background color of the sub menu item', 'framework'),
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'body_background_color_1',
				'label' => __('Home background color 1', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'body_background_color_2',
				'label' => __('Home background color 2', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'preheader_background_color',
				'label' => __('Preheader background color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'preheader_text_color',
				'label' => __('Preheader text color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'footer_background_color',
				'label' => __('Footer background color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'footer_headers_color',
				'label' => __('Footer headers color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'footer_main_text_color',
				'label' => __('Footer main text color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'copyrights_bar_background',
				'label' => __('Copyrights bar background color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			array(
				'id' => 'copyrights_bar_text_color',
				'label' => __('Copyrights bar text color', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'colorpicker',
				'section' => 'elements_color',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => ''
			),
			//pages
			array(
				'id'          => 'portfolio_page',
				'label'       => __('Portfolio page', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'page-select',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id' => 'show_related_projects_on_portfolio_single',
				'label' => __('Related projects', 'framework'),
				'desc' => __('Show related projects on a single post page', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'pages',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-on',
				'choices' => array(
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id'          => 'portfolio_page_related_projects_header',
				'label'       => __('Portfolio page - related projects header', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'id'          => 'portfolio_page_related_projects_description',
				'label'       => __('Portfolio page - related projects description', 'framework'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'textarea',
				'section'     => 'pages',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			//integration
			array(
				'id' => 'google_analytics_id',
				'label' => __('Google Analytics ID', 'framework'),
				'desc' => __('Your Google Analytics ID eg. UA-1xxxxx8-1', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'scripts_header',
				'label' => __('Header scripts', 'framework'),
				'desc' => __('Scripts will be added to the header. Don\'t forget to add &lsaquo;script&rsaquo;;...&lsaquo;/script&rsaquo; tags.', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'scripts_footer',
				'label' => __('Footer scripts', 'framework'),
				'desc' => __('Scripts will be added to the footer. You can use this for Google Analytics etc. Don\'t forget to add &lsaquo;script&rsaquo;...&lsaquo;/script&rsaquo; tags.', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'custom_css',
				'label' => __('Custom CSS', 'framework'),
				'desc' => __('Please add css classes only', 'framework'),
				'std' => '',
				'type' => 'textarea-simple',
				'section' => 'integration',
				'rows' => '10',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'active_social_items',
				'label' => __('Actived items', 'framework'),
				'desc' => __('Items available on your website', 'framework'),
				'std' => '',
				'type' => 'checkbox',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => array(
					array(
						'value' => 'twitter',
						'label' => __('Twitter', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'facebook',
						'label' => __('Facebook', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'skype',
						'label' => __('Skype', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'dribble',
						'label' => __('Dribble', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'youtube',
						'label' => __('Youtube', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'pinterest',
						'label' => __('Pinterest', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'tumblr',
						'label' => __('Tumblr', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'google_plus',
						'label' => __('Google+', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'linkedin',
						'label' => __('LinkedIn', 'framework'),
						'src' => ''
					)
				),
			),
			array(
				'id' => 'facebook_url',
				'label' => __('Facebook URL', 'framework'),
				'desc' => __('URL to your Facebook account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_url',
				'label' => __('Twitter URL', 'framework'),
				'desc' => __('URL to your Twitter account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'skype_username',
				'label' => __('Skype username', 'framework'),
				'desc' => __('Your Skype username', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'dribble_url',
				'label' => __('Dribble URL', 'framework'),
				'desc' => __('URL to your Dribble account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'youtube_url',
				'label' => __('Youtube URL', 'framework'),
				'desc' => __('URL to your Youtube account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'pinterest_url',
				'label' => __('Pinterest URL', 'framework'),
				'desc' => __('URL to your Pinterest account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'tumblr_url',
				'label' => __('Tumblr URL', 'framework'),
				'desc' => __('URL to your Tumblr account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'google_plus_url',
				'label' => __('Google+ URL', 'framework'),
				'desc' => __('URL to your Google+ account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'linkedin_url',
				'label' => __('LinkedIn URL', 'framework'),
				'desc' => __('URL to your LinkedIn account', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_account_recent_tweets',
				'label' => __('Twitter URL', 'framework'),
				'desc' => __('Your Twitter URL to use in the footer', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_consumer_key',
				'label' => __('Consumer key', 'framework'),
				'desc' => __("Consumer key from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_consumer_secret',
				'label' => __('Consumer secret', 'framework'),
				'desc' => __("Consumer secret from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_user_token',
				'label' => __('User token', 'framework'),
				'desc' => __("'User token from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'twitter_token_secret',
				'label' => __('Access token secret', 'framework'),
				'desc' => __("'Access token secret from your application's OAuth settings.", 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'id' => 'show_recent_tweet_footer_show_errors',
				'label' => __('Show recent tweets authentication errors', 'framework'),
				'desc' => __('Use this option if you test your setttings only.', 'framework'),
				'std' => '',
				'type' => 'Radio',
				'section' => 'social',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'contact_form_email',
				'label' => __('Email', 'framework'),
				'desc' => __('Email to receive messages from contact forms', 'framework'),
				'std' => '',
				'type' => 'text',
				'section' => 'contact_form',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => ''
			),
			array(
				'label' => 'Sidebars',
				'id' => 'user_sidebars',
				'type' => 'list-item',
				'desc' => __('List of user defined sidebars. Please use "save changes" button after adding or editing sidebars.', 'framework'),
				'settings' => array(
					array(
						'label' => __('Description', 'framework'),
						'id' => 'user_sidebar_description',
						'type' => 'text',
						'desc' => '',
						'std' => '',
						'rows' => '',
						'post_type' => '',
						'taxonomy' => '',
						'class' => ''
					)
				),
				'std' => '',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'section' => 'sidebars'
			),
			array(
				'id' => 'woocomerce_sidebar',
				'label' => __('WooCommerce sidebar', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Select',
				'section' => 'sidebars',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '',
				'choices' => $sidebar_choices
			),
			array(
				'id' => 'enable_translations',
				'label' => __('Enable translations', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'Radio',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => 'switcher-off',
				'choices' => array(
					array(
						'value' => 'no',
						'label' => __('No', 'framework'),
						'src' => ''
					),
					array(
						'value' => 'yes',
						'label' => __('Yes', 'framework'),
						'src' => ''
					)
				)
			),
			array(
				'id' => 'translator_'.sanitize_title('%s Comments'),
				'label' => __('%s Comments', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => '%s Comments' 
			),
			array(
				'id' => 'translator_'.sanitize_title('1 Comment'),
				'label' => __('1 Comment', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => '1 Comment' 
			),
			array(
				'id' => 'translator_'.sanitize_title('1 hour ago'),
				'label' => __('1 hour ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => '1 hour ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('1 minute ago'),
				'label' => __('1 minute ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => '1 minute ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('1 year ago'),
				'label' => __('1 year ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => '1 year ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('404 Page Not Found'),
				'label' => __('404 Page Not Found', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => '404 Page Not Found' 
			),
			array(
				'id' => 'translator_'.sanitize_title('About the author'),
				'label' => __('About the author', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'About the author' 
			),
			array(
				'id' => 'translator_'.sanitize_title('About the author'),
				'label' => __('About the author', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'About the author' 
			),
			array(
				'id' => 'translator_'.sanitize_title('All'),
				'label' => __('All', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'All' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.'),
				'label' => __('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Archive by Category "%s"'),
				'label' => __('Archive by Category "%s"', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Archive by Category "%s"' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Blog'),
				'label' => __('Blog', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Blog' 
			),
			array(
				'id' => 'translator_'.sanitize_title('By'),
				'label' => __('By', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'By' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Cancel Comment'),
				'label' => __('Cancel Comment', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Cancel Comment' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Clear'),
				'label' => __('Clear', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Clear' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Comment'),
				'label' => __('Comment', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Comment' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Comments'),
				'label' => __('Comments', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Comments' 
			),
			array(
				'id' => 'translator_'.sanitize_title('COMMENTS'),
				'label' => __('COMMENTS', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'COMMENTS' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Comments are closed.'),
				'label' => __('Comments are closed.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Comments are closed.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Contact form'),
				'label' => __('Contact form', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Contact form' 
			),
			array(
				'id' => 'translator_'.sanitize_title('days ago'),
				'label' => __('days ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'days ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Edit'),
				'label' => __('Edit', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Edit' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Email'),
				'label' => __('Email', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Email' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Email sent. Thank you for contacting us.'),
				'label' => __('Email sent. Thank you for contacting us.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Email sent. Thank you for contacting us.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Filter'),
				'label' => __('Filter', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Filter' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Home'),
				'label' => __('Home', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Home' 
			),
			array(
				'id' => 'translator_'.sanitize_title('hours ago'),
				'label' => __('hours ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'hours ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('just now'),
				'label' => __('just now', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'just now' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Leave a Comment'),
				'label' => __('Leave a Comment', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Leave a Comment' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Leave a Comment to %s'),
				'label' => __('Leave a Comment to %s', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Leave a Comment to %s' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'),
				'label' => __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' 
			),
			array(
				'id' => 'translator_'.sanitize_title('minutes ago'),
				'label' => __('minutes ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'minutes ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('months ago'),
				'label' => __('months ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'months ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Name'),
				'label' => __('Name', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Name' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Next'),
				'label' => __('Next', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Next' 
			),
			array(
				'id' => 'translator_'.sanitize_title('next'),
				'label' => __('next', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'next' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Next &raquo;'),
				'label' => __('Next &raquo;', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Next &raquo;' 
			),
			array(
				'id' => 'translator_'.sanitize_title('next post'),
				'label' => __('next post', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'next post' 
			),
			array(
				'id' => 'translator_'.sanitize_title('No comments'),
				'label' => __('No comments', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'No comments' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Page %s'),
				'label' => __('Page %s', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Page %s' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Pages:'),
				'label' => __('Pages:', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Pages:' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Pingback:'),
				'label' => __('Pingback:', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Pingback:' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Please check your email.'),
				'label' => __('Please check your email.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Please check your email.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Please fill all required fields.'),
				'label' => __('Please fill all required fields.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Please fill all required fields.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Posts by %s'),
				'label' => __('Posts by %s', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Posts by %s' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Posts by %s'),
				'label' => __('Posts by %s', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Posts by %s' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Posts made in %s'),
				'label' => __('Posts made in %s', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Posts made in %s' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Posts Tagged "%s"'),
				'label' => __('Posts Tagged "%s"', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Posts Tagged "%s"' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Previous'),
				'label' => __('Previous', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Previous' 
			),
			array(
				'id' => 'translator_'.sanitize_title('previous'),
				'label' => __('previous', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'previous' 
			),
			array(
				'id' => 'translator_'.sanitize_title('previous post'),
				'label' => __('previous post', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'previous post' 
			),
			array(
				'id' => 'translator_'.sanitize_title('&laquo; Previous'),
				'label' => __('&laquo; Previous', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => '&laquo; Previous' 
			),
			array(
				'id' => 'translator_'.sanitize_title('project details'),
				'label' => __('project details', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'project details' 
			),
			array(
				'id' => 'translator_'.sanitize_title('project info'),
				'label' => __('project info', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'project info' 
			),
			array(
				'id' => 'translator_'.sanitize_title('read more'),
				'label' => __('read more', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'read more' 
			),
			array(
				'id' => 'translator_'.sanitize_title('related works'),
				'label' => __('related works', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'related works' 
			),
			array(
				'id' => 'translator_'.sanitize_title('required'),
				'label' => __('required', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'required' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Search Results for "%s" Query'),
				'label' => __('Search Results for "%s" Query', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Search Results for "%s" Query' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Search results for %s'),
				'label' => __('Search results for %s', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Search results for %s' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Send'),
				'label' => __('Send', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Send' 
			),
			array(
				'id' => 'translator_'.sanitize_title('SENT'),
				'label' => __('SENT', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'SENT' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Server error. Pease try again later.'),
				'label' => __('Server error. Pease try again later.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Server error. Pease try again later.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('weeks ago'),
				'label' => __('weeks ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'weeks ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('years ago'),
				'label' => __('years ago', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'years ago' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Yesterday'),
				'label' => __('Yesterday', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Yesterday' 
			),
			array(
				'id' => 'translator_'.sanitize_title('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s'),
				'label' => __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' 
			),
			array(
				'id' => 'translator_'.sanitize_title('You must be <a href="%s">logged in</a> to post a comment.'),
				'label' => __('You must be <a href="%s">logged in</a> to post a comment.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'You must be <a href="%s">logged in</a> to post a comment.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Your comment is awaiting moderation.'),
				'label' => __('Your comment is awaiting moderation.', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Your comment is awaiting moderation.' 
			),
			array(
				'id' => 'translator_'.sanitize_title('Your message'),
				'label' => __('Your message', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'Your message' 
			),
			array(
				'id' => 'translator_'.sanitize_title('WHAT CLIENTS SAY'),
				'label' => __('WHAT CLIENTS SAY', 'framework'),
				'desc' => '',
				'std' => '',
				'type' => 'text',
				'section' => 'translations',
				'rows' => '',
				'post_type' => '',
				'taxonomy' => '',
				'class' => '', 
				'default' => 'WHAT CLIENTS SAY' 
			)
		)
	);

	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters('option_tree_settings_args', $custom_settings);

	/* settings are not the same update the DB */
	if ($saved_settings !== $custom_settings) {
		update_option('option_tree_settings', $custom_settings);
	}
}

/**
 * Get font choices for theme options
 * @param bool $return_string if true returned array is strict, example array item: font_name => font_label
 * @return array
 */
function ts_get_font_choices($return_strict = false) {
	$aFonts = array(
		array(
			'value' => 'default',
			'label' => __('Default', 'framework'),
			'src' => ''
		),
		array(
			'value' => 'Verdana',
			'label' => 'Verdana',
			'src' => ''
		),
		array(
			'value' => 'Geneva',
			'label' => 'Geneva',
			'src' => ''
		),
		array(
			'value' => 'Arial',
			'label' => 'Arial',
			'src' => ''
		),
		array(
			'value' => 'Arial Black',
			'label' => 'Arial Black',
			'src' => ''
		),
		array(
			'value' => 'Trebuchet MS',
			'label' => 'Trebuchet MS',
			'src' => ''
		),
		array(
			'value' => 'Helvetica',
			'label' => 'Helvetica',
			'src' => ''
		),
		array(
			'value' => 'sans-serif',
			'label' => 'sans-serif',
			'src' => ''
		),
		array(
			'value' => 'Georgia',
			'label' => 'Georgia',
			'src' => ''
		),
		array(
			'value' => 'Times New Roman',
			'label' => 'Times New Roman',
			'src' => ''
		),
		array(
			'value' => 'Times',
			'label' => 'Times',
			'src' => ''
		),
		array(
			'value' => 'serif',
			'label' => 'serif',
			'src' => ''
		)
	);

	if (file_exists(get_template_directory() . '/framework/fonts/google-fonts.json')) {
		$google_fonts = file_get_contents(get_template_directory() . '/framework/fonts/google-fonts.json', true);
		$aGoogleFonts = json_decode($google_fonts, true);
		
		if (!isset($aGoogleFonts['items']) || !is_array($aGoogleFonts['items'])) {
			continue;
		}
		
		$aFonts[] = array(
			'value' => 'google_web_fonts',
			'label' => '---Google Web Fonts---',
			'src' => ''
		);

		foreach ($aGoogleFonts['items'] as $aGoogleFont) {
			$aFonts[] = array(
				'value' => 'google_web_font_' . $aGoogleFont['family'],
				'label' => $aGoogleFont['family'],
				'src' => ''
			);
		}
	}
	
	if ($return_strict) {
		$aFonts2 = array();
		foreach ($aFonts as $font) {
			$aFonts2[$font['value']] = $font['label'];
		}
		return $aFonts2;
	}
	return $aFonts;
}

/**
 * Get background patterns
 * @param bool $control_panel if true return array for control panel (front end)
 * @return type
 */
function ts_get_background_patterns($control_panel = false)
{
	$patterns = array();
	
	
	if ($control_panel === false)
	{
		$patterns[] = array(
			'value' => 'none',
			'label' => __('None', 'framework'),
			'src' => ''
		);
		
		$patterns[] = array(
			'value' => 'image',
			'label' => __('Image (choose below)', 'framework'),
			'src' => ''
		);
	}
	
	$patterns[] = array(
		'value' => 'cartographer.png',
		'label' => __('Cartographer', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'concrete_wall.png',
		'label' => __('Concrete Wall', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'dark_wall.png',
		'label' => __('Dark Wall', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'dark_wood.png',
		'label' => __('Dark Wood', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'irongrip.png',
		'label' => __('Irongrip', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'purty_wood.png',
		'label' => __('Purty Wood', 'framework'),
		'src' => ''
	);
	$patterns[] = array(
		'value' => 'px_by_Gre3g.png',
		'label' => __('PX', 'framework'),
		'src' => ''
	);
	return $patterns;
}

/**
 * Get menu background transparency values
 * @return int
 */
function ts_get_menu_background_transparency_values()
{
	$values = array();
	for ($i = 0; $i <= 100; $i ++)
	{
		$v = $i;
		$v = 100 - $i;
		if ($v == 100)
		{
			$v = 1;
		}
		else
		{
			if ($v < 10)
			{
				$v = '0'.$v;
			}
			$v = '0.'.$v;
		}
		$values[] = array(
			'value' => $v,
			'label' => $i.'%',
			'src' => ''
		);
	}
	return $values;
}