<?php
/**
 * circles functions and definitions
 *
 * @package circles
 * @since circles 1.0
 */

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );

/**
* Theme Options
*/
include_once( 'inc/theme-options.php' );

/**
* Meta boxes + page builder
*/

include_once( 'inc/meta-boxes.php' );
include_once( 'framework/page-builder.php' );

/**
 * Framework functions
 */
include_once( 'framework/framework.php' );

/**
 * Widgets initalization
 */
include_once( 'inc/widgets.php' );

/**
 * Shortcodes initalization
 */
include_once( 'inc/shortcodes.php' );

/**
 * Third Party Plugins activation
 */
include_once( 'framework/plugins-activation.php' );

/**
 * FlexSlider
 */
include_once( 'framework/flexslider.php' );

/**
 * Framework menus
 */
include_once( 'framework/custom-menus.php' );

/**
 * Elements color classes
 */
include_once( 'inc/elements-color-classes.php' );

/**
 * Featured image
 */
add_theme_support('post-thumbnails'); //enable
set_post_thumbnail_size( 594, 325, true ); //set default resolution for featured image

//standard content
ts_add_theme_image_size('full', 1156, 577, true);
ts_add_theme_image_size('one-sidebar', 863, 430,true);
ts_add_theme_image_size('two-sidebars', 566, 283 ,true);

ts_add_theme_image_size('half-full', 578, 288, true);
ts_add_theme_image_size('half-one-sidebar', 431, 215,true);
ts_add_theme_image_size('half-two-sidebars', 283, 142 ,true);

ts_add_theme_image_size('third-full', 385, 192, true);
ts_add_theme_image_size('third-one-sidebar', 287, 143,true);
ts_add_theme_image_size('third-two-sidebars', 188, 94 ,true);

ts_add_theme_image_size('fourth-full', 289, 144, true);
ts_add_theme_image_size('fourth-one-sidebar', 215, 107, true);
ts_add_theme_image_size('fourth-two-sidebars', 141, 70 ,true);

ts_add_theme_image_size('author', 77, 77, true);
ts_add_theme_image_size('blogmenu-thumb', 76, 76, true);
ts_add_theme_image_size('blogmenu', 507, 145, true);

//flexslider
ts_add_theme_image_size('slider', 1170, 360, true);

ts_add_theme_image_size('full-aligned', 1156, 577, true);
ts_add_theme_image_size('one-sidebar-aligned', 344, 266,true);
ts_add_theme_image_size('two-sidebars-aligned', 266, 266 ,true);

//template-blog-3
ts_add_theme_image_size('template-blog-3-full', 361, 181, true);
ts_add_theme_image_size('template-blog-3-one-sidebar',361, 181,true);
ts_add_theme_image_size('template-blog-3-two-sidebars', 361, 181 ,true);

//templates
ts_add_theme_image_size('portfolio-single', 834, 363 ,true);
//ts_add_theme_image_size('portfolio-related', 220, 140 ,true);
ts_add_theme_image_size('portfolio-1-2', 561,400 ,true);
ts_add_theme_image_size('portfolio-1-3', 362,250 ,true);
ts_add_theme_image_size('portfolio-1-4', 261,200 ,true);
ts_add_theme_image_size('portfolio-related', 214,199 ,true);
//ts_add_theme_image_size('portfolio-2', 636,436 ,true);
ts_add_theme_image_size('portfolio-masonry', 322, 161);
//ts_add_theme_image_size('portfolio-masonry', 271, 271);

//shortcodes
ts_add_theme_image_size('latest-posts', 360,181, true);
ts_add_theme_image_size('latest-works', 263,200, true);
ts_add_theme_image_size('recent-projects', 364,200, true);
ts_add_theme_image_size('featured-projects', 269,202, true);
ts_add_theme_image_size('related-works', 262,199, true);
ts_add_theme_image_size('person', 391, 369, true);
ts_add_theme_image_size('person-thumb', 57, 57, true);
ts_add_theme_image_size('person-mid', 350, 180, true);
ts_add_theme_image_size('teaser', 411, 414, true);
ts_add_theme_image_size('teaser-small', 414, 414, true);
ts_add_theme_image_size('promo', 355, 335, true);
ts_add_theme_image_size('teaser_2', 90, 90, true);
ts_add_theme_image_size('full-gal-thumb', 231, 132, true);
ts_add_theme_image_size('one-sidebar-gal-thumb', 177, 99, true);
ts_add_theme_image_size('two-sidebars-gal-thumb', 111, 65, true);
ts_add_theme_image_size('testimonial', 115, 115, true);

//widgets
ts_add_theme_image_size('sidebar', 102, 69, true );

/**
 * Woocommerce support
 */
add_theme_support( 'woocommerce' );

/**
 * Exerpt length
 * Usage ts_the_excerpt_theme('short');
 */
define ('TINY_EXCERPT',12);
define ('SHORT_EXCERPT',22);
define ('REGULAR_EXCERPT',55);
define ('LONG_EXCERPT',55);

define ('SLIDER_PREV_TEXT',"Left");
define ('SLIDER_NEXT_TEXT',"Right");

/**
 * Enable Retina Support
 */

function ts_theme_admin_init() {

	if (ot_get_option('retina_support') == 'enabled')
	{
		define('RETINA_SUPPORT',true);
	}
}
add_action('admin_init','ts_theme_admin_init');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since circles 1.0
 */
if ( ! isset( $content_width ) )
{
    $content_width = 602; /* pixels */
}

if ( ! function_exists( 'ts_theme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since circles 1.0
 */
function ts_theme_setup()
{
    /**
     * Custom template tags for this theme.
     */
    require( get_template_directory() . '/inc/template-tags.php' );

    /**
     * Custom functions that act independently of the theme templates
     */
    require( get_template_directory() . '/inc/tweaks.php' );

    /**
     * Make theme available for translation
     */
    load_theme_textdomain( 'circles', get_template_directory() . '/languages' );
    load_theme_textdomain( 'framework', get_template_directory() . '/languages' );

    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );


    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'circles' ),
    ) );

	add_editor_style('css/main.css');
}
endif; // theme_setup
add_action( 'after_setup_theme', 'ts_theme_setup' );

if ( ! function_exists( 'ts_theme_activation' ) ):
/**
 * Runs on theme activation
 *
 * @since circles 1.0
 */
function ts_theme_activation()
{
	global $wpdb;

	$table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_sliders'");
	if (!strstr($table,'fs_sliders'))
	{
		$wpdb-> query("
		   CREATE TABLE `".$wpdb -> prefix."fs_sliders` (
			`slider_id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(64) NOT NULL,
			`created_date` int(11) NOT NULL,
			`animation` varchar(32) NOT NULL,
			`direction` varchar(32) NOT NULL,
			`slideshow_speed` int(10) unsigned NOT NULL,
			`animation_speed` int(10) unsigned NOT NULL,
			`background` varchar(512) NOT NULL,
			`reverse` tinyint(1) unsigned NOT NULL DEFAULT '0',
			`randomize` tinyint(1) unsigned NOT NULL DEFAULT '0',
			`control_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
			`direction_nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (`slider_id`)
		  ) ENGINE=MyISAM;
		");
	}
	$table = $wpdb->get_var("SHOW TABLES LIKE '".$wpdb -> prefix."fs_slides'");
	if (!strstr($table,'fs_slides'))
	{
		$wpdb-> query("
		   CREATE TABLE `".$wpdb -> prefix."fs_slides` (
			`slide_id` int(11) NOT NULL AUTO_INCREMENT,
			`slider_id` int(11) NOT NULL,
			`image` varchar(255) NOT NULL,
			`show_order` int(10) unsigned NOT NULL,
			`update_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (`slide_id`),
			KEY `slider_id` (`slider_id`)
		  ) ENGINE=MyISAM;
		 ");
	}

	$aFields = $wpdb->get_results("SHOW COLUMNS FROM ".$wpdb -> prefix."fs_sliders");
	if (is_array($aFields))
	{
	   $bExistsReverse = false;
	   $bExistsBackground = false;
	   $bExistsRandomize = false;
	   $bExistsControlNav = false;
	   $bExistsDirectionNav = false;
	   foreach ($aFields as $aField)
	   {
		  if ($aField -> Field == 'background')
		  {
			 $bExistsBackground = true;
		  }

		  if ($aField -> Field == 'reverse')
		  {
			 $bExistsReverse = true;
		  }

		  if ($aField -> Field == 'randomize')
		  {
			 $bExistsRandomize = true;
		  }

		  if ($aField -> Field == 'control_nav')
		  {
			 $bExistsControlNav = true;
		  }

		  if ($aField -> Field == 'direction_nav')
		  {
			 $bExistsDirectionNav = true;
		  }
	   }
	   if ($bExistsBackground === false)
	   {
		  $wpdb-> query(" ALTER TABLE  `".$wpdb -> prefix."fs_sliders` ADD  `background` varchar(512) NOT NULL");
	   }

	   if ($bExistsReverse === false)
	   {
		  $wpdb-> query($q=" ALTER TABLE  `".$wpdb -> prefix."fs_sliders` ADD `reverse` tinyint(1) unsigned NOT NULL DEFAULT '0'");
	   }

	   if ($bExistsRandomize === false)
	   {
		  $wpdb-> query($q=" ALTER TABLE  `".$wpdb -> prefix."fs_sliders` ADD `randomize` tinyint(1) unsigned NOT NULL DEFAULT '0'");
	   }

	   if ($bExistsControlNav === false)
	   {
		  $wpdb-> query($q=" ALTER TABLE  `".$wpdb -> prefix."fs_sliders` ADD `control_nav` tinyint(1) unsigned NOT NULL DEFAULT '0'");
	   }

	   if ($bExistsDirectionNav === false)
	   {
		  $wpdb-> query($q=" ALTER TABLE  `".$wpdb -> prefix."fs_sliders` ADD `direction_nav` tinyint(1) unsigned NOT NULL DEFAULT '0'");
	   }
	}
}
endif; //theme_activation
add_action('after_switch_theme', 'ts_theme_activation');

/**
 * Enable support for Post Formats for post edit form
 * Formats depends on post type here
 */
function ts_set_custom_post_formats()
{
	$postType = '';
	if (isset($_GET['post'])) {
		$postType = get_post_type( $_GET['post'] );
	}

	if($postType == 'portfolio' || (isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio' ) )
    {
		add_theme_support( 'post-formats', array( 'gallery', 'video' ) );
        add_post_type_support( 'portfolio', 'post-formats' );
    }
	else
	{
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'audio', 'video', 'quote', 'status') );
    }
}

add_action( 'load-post.php','ts_set_custom_post_formats' );
add_action( 'load-post-new.php','ts_set_custom_post_formats' );

/**
 * Reset post formats for public part of the website
 * Using set_custom_ost_formats() is not enough, it sets only formats for post edit form
 */
function ts_reset_post_formats()
{
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'audio', 'video', 'quote', 'status') );
	add_post_type_support( 'portfolio', 'post-formats' );
}
add_action( 'after_setup_theme','ts_reset_post_formats' );



/**
 * Register post type
 *
 * @since circles 1.0
 */
add_action( 'init', 'ts_register_theme_post_types' );
function ts_register_theme_post_types()
{
	register_post_type( 'portfolio',
		array(
			'labels' =>
                array(
                    'name' => __( 'Portfolio' , 'circles'),
                    'singular_name' => __( 'Portfolio' , 'circles')
                ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => true,
            'supports' => array('title',
                'editor',
                //'author',
                'thumbnail',
                //'excerpt',
                //'comments'
            )
		)
	);

    register_taxonomy(
        "portfolio-categories",
        array("portfolio"),
        array(
            "hierarchical" => true,
            "label" => __("Categories",'circles'),
            "singular_label" => __("Category","circles"),
            "rewrite" => true
        )
    );

    register_post_type( 'faq',
		array(
			'labels' =>
                array(
                    'name' => __( 'FAQ' , 'circles'),
                    'singular_name' => __( 'FAQ' , 'circles')
                ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => true,
            'supports' => array('title',
                'editor',
                //'author',
                'thumbnail',
                //'excerpt',
                //'comments'
            )
		)
	);

    register_taxonomy(
        "faq-categories",
        array("faq"),
        array(
            "hierarchical" => true,
            "label" => __("Categories",'circles'),
            "singular_label" => "Category",
            "rewrite" => true
        )
    );

    register_post_type( 'team',
		array(
			'labels' =>
                array(
                    'name' => __('Team Members' , 'circles'),
                    'singular_name' => __('Team Member' , 'circles'),
                    'add_new' => __('Add New', 'circles'),
                    'add_new_item' => __('Add New Team Member', 'circles'),
                    'edit_item' => __('Edit Team Member', 'circles'),
                    'new_item' => __('New Team Member', 'circles'),
                    'all_items' => __('All Team Members', 'circles'),
                    'view_item' => __('View Team Member', 'circles'),
                    'search_items' => __('Search Team Members', 'circles'),
                    'not_found' =>  __('No team members found', 'circles'),
                    'not_found_in_trash' => __('No team member found in Trash', 'circles'),
                    'parent_item_colon' => '',
                    'menu_name' => __('Team Members', 'circles')
               ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => true,
            'capability_type' => 'page',
            'supports' => array('title',
                'editor',
                //'author',
                'thumbnail',
                //'excerpt',
                //'comments'
                'page-attributes'
            )
		)
	);
}

/**
 * Modify title placeholder for custom post types
 *
 * @since circles 1.0
 */
add_filter( 'enter_title_here', 'ts_custom_enter_title' );
function ts_custom_enter_title( $input ) {
    global $post_type;

    if ( is_admin() && 'team' == $post_type )
    {
        return __( 'Enter team member name here', 'circles' );
    }
    return $input;
}


/**
 * Enqueue scripts and styles
 *
 * @since circles 1.0
 */
function ts_theme_scripts() {

	wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), null, 'all' );
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), null, 'all' );
	wp_register_style( 'grid-system', get_template_directory_uri() . '/css/grid-system.css', array(), null, 'all' );
	wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', array(), null, 'all' );
	wp_register_style( 'shortcodes', get_template_directory_uri() . '/css/shortcodes.css', array(), null, 'all' );
	wp_register_style( 'widgets', get_template_directory_uri() . '/css/widgets.css', array(), null, 'all' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), null, 'all' );
	wp_register_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.css', array(), null, 'all' );
	wp_register_style( 'responsiveness', get_template_directory_uri() . '/css/media.css', array(), null, 'all' );

	wp_enqueue_style( 'normalize' );
	wp_enqueue_style( 'prettyPhoto' );
	wp_enqueue_style( 'grid-system' );
	wp_enqueue_style( 'main' );
	wp_enqueue_style( 'shortcodes' );
	wp_enqueue_style( 'widgets' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'icomoon' );
	wp_enqueue_style( 'responsiveness' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

    wp_enqueue_style( 'jquery');



    wp_register_script( 'jquery-prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js',array('jquery'),null,true);
    wp_register_script( 'jquery-isotope', get_template_directory_uri().'/js/jquery.isotope.min.js',array('jquery'),null,true);
    wp_register_script( 'jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js',array('jquery'),null,true);
    wp_register_script( 'jquery-iosslider', get_template_directory_uri().'/js/jquery.iosslider.min.js',array('jquery'),null,true);
	wp_register_script( 'zozo-tabs', get_template_directory_uri().'/js/zozo.tabs.min.js',null,null,true);
	wp_register_script( 'main', get_template_directory_uri().'/js/main.js',array('jquery'),null,true);
	wp_register_script( 'canvasloader', 'http://heartcode-canvasloader.googlecode.com/files/heartcode-canvasloader-min-0.9.1.js',array('jquery'),null,true);
    wp_register_script( 'retina', get_template_directory_uri().'/js/retina.js',null,null,true);

    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'main' );
	wp_enqueue_script( 'canvasloader' );
	wp_enqueue_script( 'jquery-prettyPhoto' );
    wp_enqueue_script( 'jquery-flexslider' );
	wp_enqueue_script( 'zozo-tabs' );
	wp_enqueue_script( 'jquery-isotope' );

	if (is_singular())
	{
		wp_enqueue_script( 'jquery-iosslider' );

	}
	if (defined('RETINA_SUPPORT') && RETINA_SUPPORT === true)
	{
		wp_enqueue_script( 'retina' );
	}

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ts_theme_scripts' );

$html5shim = create_function( '', 'echo \'<!--[if lt IE 9]><script src="\'.get_template_directory_uri().\'/js/html5.js"></script><![endif]-->\';' );
add_action( 'wp_head', $html5shim );

$icomoon = create_function( '', 'echo \'<!--[if lt IE 7]><script src="\'.get_template_directory_uri().\'/js/icomoon.js"></script><![endif]-->\';' );
add_action( 'wp_head', $icomoon );

function ts_ajaxurl() { ?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	<?php
}
add_action('wp_head','ts_ajaxurl');

/**
 * Google analytics ourput
 */
function ts_google_analytics_output() {

	if (ot_get_option('google_analytics_id') != "") {
	?>
		<script type="text/javascript">

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo ot_get_option('google_analytics_id'); ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();

		</script>
	<?php
	}
}

add_action( 'wp_footer', 'ts_google_analytics_output',1200);

/**
* Register theme widgets
*
* @since circles 1.0
*/
function ts_theme_widgets_init()
{
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'circles' ),
        'id' => 'main',
        'before_widget' => '<section id="%1$s" class="%2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );

    register_sidebar(
			array(
				'id'            => 'sliding-panel',
				'name'          => __( 'Sliding Panel', 'sliding-panel' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			) );

    for ($i = 1; $i <= 4; $i ++)
    {
        register_sidebar( array(
            'name' => __( 'Footer Area', 'circles' ).' '.$i,
            'id' => 'footer-area-'.$i,
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ) );
    }

	$user_sidebars = ot_get_option('user_sidebars');

    if (is_array($user_sidebars))
    {
        foreach ($user_sidebars as $sidebar)
        {
            register_sidebar( array(
                'name' => $sidebar['title'],
                'id' => sanitize_title($sidebar['title']),
                'before_widget' => '<section id="%1$s" class="%2$s">',
				'after_widget' => '</section>',
                'before_title' => '<h1>',
                'after_title' => '</h1>',
            ) );
        }
    }

}
add_action( 'widgets_init', 'ts_theme_widgets_init' );


/**
 * Add classes to body
 *
 * @param array $classes
 * @return array
 * @since framework 1.0
 */
// Add specific CSS class by filter
add_filter('body_class','ts_get_body_main_class');
function ts_get_body_main_class($classes) {

	//add body class and main menu style selected from control panel
	$added_body_class = false;
	$added_main_menu_style = false;
	if (ts_check_if_control_panel())
	{
		if (ts_check_if_use_control_panel_cookies() && !empty($_COOKIE['theme_body_class']))
		{
			$added_body_class = true;
			$classes[] = $_COOKIE['theme_body_class'];
		}
		else if (isset($_GET['switch_layout']) && !empty($_GET['switch_layout']))
		{
			$added_body_class = true;
			$classes[] = $_GET['switch_layout'];
		}

		if (ts_check_if_use_control_panel_cookies() &&  !empty($_COOKIE['theme_main_menu_style']))
		{
			$main_menu_style = $_COOKIE['theme_main_menu_style'];
		}
		elseif (isset($_GET['switch_main_menu_style']) && !empty($_GET['switch_main_menu_style']))
		{
			$main_menu_style = $_GET['switch_main_menu_style'];
		}

		if (!empty($main_menu_style))
		{
			$added_main_menu_style = true;
			switch ($main_menu_style)
			{
				case 'style1':
					break;

				case 'style2':
					$classes[] = 'headerstyle2';
					break;

				case 'style3':
					$classes[] = 'headerstyle3';
					break;

				case 'style4':
					$classes[] = 'headerstyle4';
					break;
				case 'style5':
					$classes[] = 'headerstyle5';
					break;

				case 'style6':
					$classes[] = 'headerstyle2';
					$classes[] = 'headerstyle2_2';
					break;
			}
		}
	}
	//add body_class set in theme options only if not added from control panel
	if ($added_body_class == false)
	{
		$class = ot_get_option('body_class');
		if (empty($class))
		{
			$class = 'w1170';
		}
		$classes[] = $class;
	}
	//add body_class set in theme options only if not added from control panel

	if ($added_main_menu_style == false)
	{
		$style = ts_get_main_menu_style();
		if (!empty($style))
		{
			switch ($style)
			{
				case 'style1':
					break;

				case 'style2':
					$classes[] = 'headerstyle2';
					break;

				case 'style3':
					$classes[] = 'headerstyle3';
					break;

				case 'style4':
					$classes[] = 'headerstyle4';
					break;

				case 'style5':
					$classes[] = 'headerstyle5';
					break;

				case 'style6':
					$classes[] = 'headerstyle2';
					$classes[] = 'headerstyle2_2';
					break;
			}
		}
	}
	//add class if there is not header image
	$slider = null;
	if (is_page())
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
		if (empty($slider))
		{
			$header_background = get_post_meta(get_the_ID(),'header_background',true);
			if (empty($header_background))
			{
				$classes[] = 'no-header-image';
			}
		}
	}

	//add class if sticky menu is enabled
	if (ot_get_option('show_sticky_menu') != 'no') {
		$classes[] = 'sticky-menu-on';
	}
	return $classes;
}

/**
 * Get class for specified sidebar
 *
 * @param array $classes
 * @return array
 * @since framework 1.0
 */
// Add specific CSS class by filter
add_filter('body_class','ts_get_sidebar_class');
function ts_get_sidebar_class($classes) {
	//no sidebar css
	if (is_singular() && ts_get_single_post_sidebar_position() == 'no')
	{
		$classes[] = 'no-sidebar';
	}
	//left sidebar css
	if (is_singular() && ts_get_single_post_sidebar_position() == 'left')
	{
		$classes[] = 'left-sidebar';
	}
	return $classes;
}

/**
 * Get featured image align for blog listing
 * @global string $force_featured_image_align force align for some blog templates eg. template-blog-2.php
 * @return string
 */
function ts_get_featured_image_align() {

	global $force_featured_image_align, $post;

	if (isset($force_featured_image_align) && in_array($force_featured_image_align,array('left','right')))
	{
		return $force_featured_image_align;
	}

	$featured_image_align = get_post_meta($post -> ID, 'featured_image_align',true);
	if (empty($featured_image_align))
	{
		$featured_image_align = 'center';
	}
	return $featured_image_align;
}

/**
 * Get a list of supported header styles
 * @return array
 */
function ts_get_header_styles($empty_option = false)
{
	if ($empty_option === true) {
		$styles[] = array(
			'value' => 'default',
			'label' => __('Default', 'framework'),
			'src' => ''
		);
	}

	$styles[] =  array(
		'value' => 'style1',
		'label' => __('Style 1', 'framework').' '.($empty_option === false ? __('(default)','framework') : ''),
		'src' => ''
	);
	$styles[] =  array(
		'value' => 'style2',
		'label' => __('Style 2', 'framework'),
		'src' => ''
	);
	$styles[] =  array(
		'value' => 'style3',
		'label' => __('Style 3', 'framework'),
		'src' => ''
	);
	$styles[] =  array(
		'value' => 'style4',
		'label' => __('Style 4', 'framework'),
		'src' => ''
	);
	$styles[] = array(
		'value' => 'style5',
		'label' => __('Style 5', 'framework'),
		'src' => ''
	);
	$styles[] = array(
		'value' => 'style6',
		'label' => __('Style 6', 'framework'),
		'src' => ''
	);

	return $styles;
}

/**
 * Get control panel colors
 * @return array
 */
function ts_get_control_panel_colors()
{
	return array(
		'#647c02',
		'#01748f',
		'#ab5900',
		'#ab2501',
		'#01750f',
		'#017155',
		'#1a448a',
		'#312c9b',
		'#6222a7',
		'#891b72',
		'#910c0c',
		'#22292c'
	);
}

function ts_get_control_panel_backgrounds()
{
	return array(
		'circles.jpg',
		'city.jpg',
		'city_1.jpg',
		'hills.jpg',
		'nature.jpg',
		'wood.jpg',
	);
}







//page builder configuration
//content - element required for each template
$page_builder_config = array(
	'default' => array(
		'content' => __('Page builder','framework')
	),
	'template-homepage.php' => array(
		'content_1' => __('Content area','framework').' 1',
		'content_2' => __('Content area','framework').' 2',
		'content_3' => __('Content area','framework').' 3',
		'content_4' => __('Content area','framework').' 4',
		'content_5' => __('Content area','framework').' 5',
		'content_6' => __('Content area','framework').' 6',
		'content_7' => __('Content area','framework').' 7'
	),
);




/**
 * Gettext filter, used in functions: __,_e etc.
 * @global array $ns_options_translations
 * @param string $content
 * @param string $text
 * @param string $domain
 * @return string
 */
if (!is_admin())
{
	function ts_translation($content, $text, $domain)
	{
		if (ot_get_option('enable_translations') == 'yes' && in_array($domain,array('circles')))
		{
			return ot_get_option('translator_'.sanitize_title($content),$content);
		}
		return $content;
	}
	add_filter( 'gettext','ts_translation',20, 3);
}


function ts_the_recent_tweets() {

	?>
	<?php if (get_post_meta(ts_get_current_id(),'show_recent_tweet_footer',true) == 'yes'):

		$tweets = ts_get_recent_tweet();

		if ($tweets['is_error'] == 'true' && ot_get_option('show_recent_tweet_footer_show_errors') == 'yes' ): ?>
			<aside class='wrapper blue'>
				<section class='container blue-radial-grad widget widget_single_tweet'>
					<div class='grid_12'>
						<div class='widget_single_tweet-container'>
							<article id="recent-tweets" class='item'>
								<ul class="slides">
									<li><div class="message"><?php echo $tweets['error']; ?></div></li>
								</ul>
							</article>
						</div>
					</div>
				</section>
			</aside>

		<?php elseif (!empty($tweets['tweets'])):
			$tweets['tweets'] = json_decode($tweets['tweets']);

			if (is_array($tweets['tweets']) && count($tweets['tweets']) > 0):
			?>
				<aside class='wrapper blue'>
					<section class='container blue-radial-grad widget widget_single_tweet'>
						<div class='pagination'>
							<span class='prev-t3'></span>
							<span class='next-t3'></span>
						</div>
						<div class='grid_12'>
							<div class='widget_single_tweet-container'>
								<article id="recent-tweets" class='item'>
									<ul class="slides">
										<?php

										$i = 0;
										foreach ($tweets['tweets'] as $tweet) : ?>
											<li <?php echo ($i > 0 ? 'style="display: none;"': ''); ?>>
												<?php
												$datetime = $tweet->created_at;
												$date = date('M d, Y', strtotime($datetime));
												$time = date('g:ia', strtotime($datetime));
												$tweet_text = $tweet->text;

												// check if any entites exist and if so, replace then with hyperlinked versions
												if (!empty($tweet->entities->urls) || !empty($tweet->entities->hashtags) || !empty($tweet->entities->user_mentions)) {
													foreach ($tweet->entities->urls as $url) {
														$find = $url->url;
														$replace = '<a href="'.$find.'" target="_blank">'.$find.'</a>';
														$tweet_text = str_replace($find,$replace,$tweet_text);
													}

													foreach ($tweet->entities->hashtags as $hashtag) {
														$find = '#'.$hashtag->text;
														$replace = '<a href="http://twitter.com/#!/search/%23'.$hashtag->text.'" target="_blank">'.$find.'</a>';
														$tweet_text = str_replace($find,$replace,$tweet_text);
													}

													foreach ($tweet->entities->user_mentions as $user_mention) {
														$find = "@".$user_mention->screen_name;
														$replace = '<a href="http://twitter.com/'.$user_mention->screen_name.'" target="_blank">'.$find.'</a>';
														$tweet_text = str_ireplace($find,$replace,$tweet_text);
													}
												}
												?>
												<div class="message"><?php echo $tweet_text; ?></div>
												<footer class="time"><?php echo $tweet -> created_at;?></footer>
											</li>
											<?php $i ++; ?>
										<?php endforeach; ?>
									</ul>
								</article>
								<script>
									jQuery(document).ready(function($) {

										$('footer.time').each(function() {
											var date = new Date($(this).html()),
											diff = (((new Date()).getTime() - date.getTime()) / 1000),
											day_diff = Math.floor(diff / 86400);

											if ( isNaN(day_diff) || day_diff < 0)
											{
												jQuery('footer.time').html('');
											}

											difference_text = day_diff == 0 && (
												diff < 60 && "<?php _e('just now', 'circles');?>" ||
												diff < 120 && "<?php _e('1 minute ago', 'circles');?>" ||
												diff < 3600 && Math.floor( diff / 60 ) + " <?php _e('minutes ago','circles');?>" ||
												diff < 7200 && "<?php _e('1 hour ago','circles');?>" ||
												diff < 86400 && Math.floor( diff / 3600 ) + " <?php _e('hours ago','circles');?>") ||
												day_diff == 1 && "<?php _e('Yesterday','circles');?>" ||
												day_diff < 7 && day_diff + " <?php _e('days ago','circles');?>" ||
												day_diff < 31 && Math.ceil( day_diff / 7 ) + " <?php _e('weeks ago','circles');?>" ||
												day_diff < 365 && Math.ceil( day_diff / 30 ) + " <?php _e('months ago','circles');?>" ||
												day_diff < 730  && "<?php _e('1 year ago','circles');?>" ||
												day_diff >= 730  && Math.ceil( day_diff / 365 ) + " <?php _e('years ago','circles');?>";

											$(this).html(difference_text);
										});
									});


								</script>
							</div>
						</div>
					</section>
				</aside>
			<?php
			endif;
		endif; ?>
	<?php endif; ?>
<?php
}

/**
 * Woocommerce support - hiding title on product's list
 * @param type $content
 * @return boolean
 */

function ts_hide_woocommerce_page_title($content) {
	return false;
}

add_filter('woocommerce_show_page_title','ts_hide_woocommerce_page_title');




/**
 * Wordy Changer
 */
add_filter(  'gettext',  'wps_translate_words_array'  );
add_filter(  'ngettext',  'wps_translate_words_array'  );
function wps_translate_words_array( $translated ) {
     $words = array(
                        // 'word to translate' = > 'translation'
                        'Posts' => 'Articles',
                        'Revolution' => 'HomePage',
                        'QuickPress' => 'Write an Article',
                        'Google Analytics Dashboard' => 'Analytics',
                        'WordPress Dashboard Twitter' => 'Twitter',
                        'Cloudinary' => 'Web Images',
                        'WordPress' => 'Candid',
                        'Wordpress' => 'Candid',
                        'Site Pages' => 'Candid',
		                'WPS' => 'Top Menu Toolbar',
		                'Ajaxy' => 'Autocomplete',
		                'UberMenu' => 'MegaMenu',
		                'ubermenu' => 'MegaMenu',
		                'NIC Photo Editor' => 'Canvas Editor',
		                'Manage Themes' => 'Manage Your Website',
		                'Current Theme' => 'Your Website',
		                'Right Now Reloaded' => 'Your Site At a Glance',
		                'Mini Mail' => 'Quick Mail',
		                'Revolution Sliders' => 'HomePage Sliders',
		                'FlexSlider' => 'Simple Sliders',
		                'Blog' => 'News',
		                'NIC Photo Editor' => 'Canvas Editor',
		                'Dashboard Chat' => 'Message Board',
		                'Clicky' => 'Site',
		                'clicky' => 'Site',
		                'CLICKY' => 'Site',
		 		        'Zemanta' => 'Click Through',
		                'Related Posts by Zemanta' => 'Related Posts Click Rate',
		                'Inboundwriter' => 'Research',
		                'Inbound Writer' => 'Research',
		                'InboundWriter' => 'Research',
		                'InboundWriter' => 'Research',
		                'inboundwriter' => 'Research',
		                'WP SlimStat' => 'Candid Analytics',
		                'SlimStat' => 'Candid Analytics',
		                'slimstat' => 'Candid Analytics',
		                'Slim Stat' => 'Candid Analytics',
                        'WP SlimStat ' => 'Candid Analytics',
                        'WP' => 'Candid',
                        'ammap.com' => 'Candid',
                        'Private Messages' => 'Messages',
                        'PM' => 'Message',





		 





	 
		 
		 
		 



		 
		 
		


                  );
     $translated = str_ireplace(  array_keys($words),  $words,  $translated );
     return $translated;
}


/**
 * Title Shortcode
 *
 * [title]Title Goes Here[/title]
 */
function slidertitle($atts, $content = null) {
return '<h1 class="slider-title">'.$content.'</h1>';
}
add_shortcode("general", "slidertitle");




/**
 * Subtitle Shortcode
 *
 * [subtitle]Subtitle Goes Here[/subtitle]
 */
function slidersubtitle($atts, $content = null) {
return '<h2 class="slider-subtitle">'.$content.'</h2>';
}
add_shortcode("captain", "slidersubtitle");





/**
 * Subtitle Shortcode
 *
 * [subtitle]Subtitle Goes Here[/subtitle]
 */
function subsub($atts, $content = null) {
return '<h3 class="slider-subsub">'.$content.'</h3>';
}
add_shortcode("sergeant", "subsub");




/**
 * Subtitle Shortcode
 *
 * [subtitle]Subtitle Goes Here[/subtitle]
 */
function sliderparagraph($atts, $content = null) {
return '<p class="slider-subtitle">'.$content.'</p>';
}
add_shortcode("private", "sliderparagraph");





function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wpseo-menu');
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

//if(! current_user_can( 'manage_options' ) ) {
//$wp_admin_bar->remove_menu('wpseo-menu');
//}









/**
 * Add the "My Account" item.
 *
 * @since 3.3.0
 *
 * @param WP_Admin_Bar $wp_admin_bar
 */
function wp_admin_bar_my_account_item( $wp_admin_bar ) {
	$user_id      = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url  = get_edit_profile_url( $user_id );

	if ( ! $user_id )
		return;

	$avatar = get_avatar( $user_id, 64 );
	$class  = empty( $avatar ) ? '' : 'with-avatar';

	$wp_admin_bar->add_menu( array(
		'id'        => 'my-account',
		'parent'    => 'top-secondary',
		'title'     => $avatar,
		'href'      => $profile_url,
		'meta'      => array(
			'class'     => $class,
			'title'     => __('MyCandid Account'),
		),
	) );
}

/**
 * Add the "My Account" submenu items.
 *
 * @since 3.1.0
 *
 * @param WP_Admin_Bar $wp_admin_bar
 */
function wp_admin_bar_my_account_menu( $wp_admin_bar ) {
	$user_id      = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url  = get_edit_profile_url( $user_id );

	if ( ! $user_id )
		return;

	$wp_admin_bar->add_group( array(
		'parent' => 'my-account',
		'id'     => 'user-actions',
	) );

	$user_info  = get_avatar( $user_id, 64 );
	$user_info .= "<span class='display-name'>{$current_user->display_name}</span>";

	if ( $current_user->display_name !== $current_user->user_login )
		$user_info .= "<span class='username'>{$current_user->user_login}</span>";

	$wp_admin_bar->add_menu( array(
		'parent' => 'user-actions',
		'id'     => 'user-info',
		'title'  => $user_info,
		'href'   => $profile_url,
		'meta'   => array(
			'tabindex' => -1,
		),
	) );
	$wp_admin_bar->add_menu( array(
		'parent' => 'user-actions',
		'id'     => 'edit-profile',
		'title'  => __( 'Edit My Profile' ),
		'href' => $profile_url,
	) );
	$wp_admin_bar->add_menu( array(
		'parent' => 'user-actions',
		'id'     => 'logout',
		'title'  => __( 'Log Out' ),
		'href'   => wp_logout_url(),
	) );
}



/**
 * Add edit comments link with awaiting moderation count bubble.
 *
 * @since 3.1.0
 *
 * @param WP_Admin_Bar $wp_admin_bar
 */
function wp_admin_bar_comments_menu( $wp_admin_bar ) {
	if ( !current_user_can('edit_posts') )
		return;

	$awaiting_mod = wp_count_comments();
	$awaiting_mod = $awaiting_mod->moderated;
	$awaiting_title = esc_attr( sprintf( _n( '%s comment awaiting moderation', '%s comments awaiting moderation', $awaiting_mod ), number_format_i18n( $awaiting_mod ) ) );

	$icon  = '<span class="ab-icon"></span>';
	$title = '<span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-' . $awaiting_mod . '">' . number_format_i18n( $awaiting_mod ) . '</span>';

	$wp_admin_bar->add_menu( array(
		'id'    => 'comments',
        'parent'    => 'top-secondary',
		'title' => $icon . $title,
		'href'  => admin_url('edit-comments.php'),
		'meta'  => array( 'title' => $awaiting_title ),
	) );
}




function class_to_body($classes) {
global $current_user;
$user_role = array_shift($current_user->roles);
$classes[] = $user_role;
return $classes;
}
function class_to_body_admin($classes) {
global $current_user;
$user_role = array_shift($current_user->roles);
$classes .= $user_role;
return $classes;
}

add_filter('body_class','class_to_body');
add_filter('admin_body_class', 'class_to_body_admin');