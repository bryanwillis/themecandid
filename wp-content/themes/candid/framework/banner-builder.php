<?php
/**
 * Banner Builder
 *
 * @package framework
 * @since framework 1.0
 */

/**
 * Banner builder custom post type registration
 */
function ts_register_banner_builder_post_type()
{
	$labels = array(
		'name' => __( 'Banner Builder' , 'framework'),
		'singular_name' => __( 'Banner Builder' , 'framework'),
		'add_new' => __( 'Add New' , 'framework'),
		'add_new_item' => __( 'Add New Banner' , 'framework'),
		'edit_item' => __( 'Edit Banner' , 'framework'),
		'new_item' => __( 'New Banner' , 'framework'),
		'all_items' => __( 'All Banners' , 'framework'),
		'view_item' => __( 'View Banner' , 'framework'),
		'search_items' => __( 'Search Banners' , 'framework'),
		'not_found' =>  __( 'No banners found' , 'framework'),
		'not_found_in_trash' => __( 'No banners found in Trash' , 'framework'),
		'parent_item_colon' => '',
		'menu_name' => __( 'Banners' , 'framework'),
	);

	register_post_type( 'banner-builder',
		array(
			'labels' => $labels,
            'public' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
            'has_archive' => false,
            'rewrite' => true,
            'supports' => array(
				'title',
                'editor'
            )
		)
	);
}
add_action( 'init', 'ts_register_banner_builder_post_type' );

function ts_get_banners_list() {

	global $post;

	$args = array(
		'posts_per_page'  => -1,
		'offset'          => 0,
		'cat'        	  =>  '',
		'orderby'         => 'title',
		'order'           => 'ASC',
		'post_type'       => 'banner-builder',
		'paged'				=> 1,
		'post_status'     => 'publish'
	);
	$the_query = new WP_Query( $args );

	$banners = array();
	if ( $the_query->have_posts() )
	{
		while ( $the_query->have_posts() )
		{
			$the_query->the_post();

			$banners[] = array(
				'id' => get_the_ID(),
				'title' => get_the_title()
			);
		}
	}

	// Restore original Query & Post Data
	wp_reset_query();
	wp_reset_postdata();

	if (count($banners) > 0) {
		return $banners;
	}
	return false;
}


function td_get_banner($id) {

	if (empty($id)) {
		return '';
	}
	$banner = get_post( $id);
	if ($banner) {

		$content = apply_filters('the_content', $banner -> post_content);
		$content = str_replace(']]>', ']]&gt;', $content);

		$height = get_post_meta($id,'height',true);
		$padding_top = get_post_meta($id,'padding_top',true);
		$padding_bottom = get_post_meta($id,'padding_bottom',true);
		$padding_left = get_post_meta($id,'padding_left',true);
		$padding_right = get_post_meta($id,'padding_right',true);
		$padding_unit = (get_post_meta($id,'padding_unit',true) == 'pixels' ? 'px': '%');
		$background_image = get_post_meta($id,'background_image',true);
		$background_repeat = get_post_meta($id,'background_repeat',true);
		$background_position = get_post_meta($id,'background_position',true);
		$background_attachment = get_post_meta($id,'background_attachment',true);
		$background_size = get_post_meta($id,'background_size',true);

		$styles = array();

		if (intval($height) > 0) {
			$styles[] = 'height: '.intval($height).'px';
		}

		if (!empty($background_image)) {
			$styles[] = 'background-image: url('.$background_image.')';
		}

		if (!empty($background_repeat)) {
			$styles[] = 'background-repeat: '.$background_repeat;
		}

		if (!empty($background_position)) {
			$styles[] = 'background-position: '.$background_position;
		}

		if (!empty($background_attachment)) {
			$styles[] = 'background-attachment: '.$background_attachment;
		}

		if (!empty($background_size) && $background_size == 'fit') {
			$styles[] = 'background-size: 100% 100%;';
		}

		$styles_html = '';
		if (is_array($styles) && count($styles) > 0) {
			$styles_html = 'style="'.implode(';',$styles).'"';
		}

		$styles_inner = array();
		if (intval($padding_top)) {
			$styles_inner[] = 'padding-top: '.intval($padding_top).$padding_unit;
		}

		if (intval($padding_bottom)) {
			$styles_inner[] = 'padding-bottom: '.intval($padding_bottom).$padding_unit;
		}

		if (intval($padding_left)) {
			$styles_inner[] = 'padding-left: '.intval($padding_left).$padding_unit;
		}

		if (intval($padding_right)) {
			$styles_inner[] = 'padding-right: '.intval($padding_right).$padding_unit;
		}

		$styles_inner_html = '';
		if (is_array($styles_inner) && count($styles_inner) > 0) {
			$styles_inner_html = 'style="'.implode(';',$styles_inner).'"';
		}

		$banner_html = '<div id="canvasloader-container" class="banner-wrapper">';
		$banner_html .= '<div class="banner-builder" '.$styles_html.'>';
		$banner_html .= '<div class="banner-inner container" '.$styles_inner_html.'>';
		$banner_html .= $content;
		$banner_html .= '</div>';
		$banner_html .= '</div>';
		$banner_html .= '<div class="banner-overlay"></div>';
		$banner_html .= '</div>';
		return $banner_html;
	}
}