<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package framework
 * @since framework 1.0
 */
 
 /**
 * 
 *
 * @since framework 1.0
 */
function ts_set_custom_title( $title ) {
   
	if (is_single() || is_page())
	{
		$subtitle = get_post_meta (get_the_ID(), 'subtitle', true);
		if (!empty($subtitle))
		{
			$title .= $subtitle.' | ';
		}
	}
   return $title;
}
add_filter( 'wp_title', 'ts_set_custom_title' );
 
 /**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since framework 1.0
 */
function ts_theme_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'ts_theme_page_menu_args' );

/**
 * Echo pagination
 *
 * @since framework 1.0
 * 
 * @param array $args array of
 * @param string|array $args Optional. Override defaults.
 * @return void
 */
function ts_wp_custom_corenavi( $args = '')
{
    global $wp_query, $wp_rewrite;
	
	$defaults = array(
		'container' => 'ul',
		'container_id' => 'pager',
		'container_class' => 'clearfix',
        'items_wrap' => '<li class="%s">%s</li>',
        'item_class' => 'page',
        'item_active_class' => 'active page',
        'list_item_active_class' => '',
        'item_prev_class' => 'prev-page icon-chevron-left',
        'item_next_class' => 'next-page icon-chevron-right',
		'prev_text' => __('&laquo; Previous','circles'),
		'next_text' => __('Next &raquo;','circles'),
        'next_prev_only' => false,
		'type' => 'plain' //plain/array
	);
    
    $args = wp_parse_args( $args, $defaults );
	extract($args, EXTR_SKIP);
	
    $pages = '';
    $max = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged'))
    {
        $current = 1;
    }
    
    $a = array(
		'items_wrap' => $items_wrap,
        'item_class' => $item_class,
        'item_active_class' => $item_active_class,
        'list_item_active_class' => $list_item_active_class,
        'item_prev_class' =>  $item_prev_class,
        'item_next_class' => $item_next_class,
		'prev_text' => $prev_text,
		'next_text' => $next_text,
		'type' => $type,
        'next_prev_only' => $next_prev_only,
    );
    
    $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total'] = $max;
    $a['current'] = $current;

    $total = 1; //1 - display the text "Page N of N", 0 - not display
    $a['mid_size'] = 1; //how many links to show on the left and right of the current
    if ($current <= 4)
    {
    	$a['mid_size'] += 6-$current;
    }
    $a['end_size'] = 3; //how many links to show in the beginning and end
    if ($max-$current <= 4)
    {
    	$a['mid_size'] += 5-($max-$current);
	}
    
	if ($type == 'array')
    {
        return ts_wp_custom_paginate_links($a);
    }
    else
    {
		if ($max > 1) echo '<'.$container.(!empty($container_id) ? ' id="'.$container_id.'"':'').(!empty($container_class) ? ' class="'.$container_class.'"':'').'>';
        echo wp_custom_paginate_links($a);
        if ($max > 1) echo '</'.$container.'>';
    }
}
/**
 * Retrieve paginated link for archive post pages.
 *
 * Technically, the function can be used to create paginated link list for any
 * area. The 'base' argument is used to reference the url, which will be used to
 * create the paginated links. The 'format' argument is then used for replacing
 * the page number. It is however, most likely and by default, to be used on the
 * archive post pages.
 *
 * The 'type' argument controls format of the returned value. The default is
 * 'plain', which is just a string with the links separated by a newline
 * character. The other possible values are either 'array' or 'list'. The
 * 'array' value will return an array of the paginated link list to offer full
 * control of display. The 'list' value will place all of the paginated links in
 * an unordered HTML list.
 *
 * The 'total' argument is the total amount of pages and is an integer. The
 * 'current' argument is the current page number and is also an integer.
 *
 * An example of the 'base' argument is "http://example.com/all_posts.php%_%"
 * and the '%_%' is required. The '%_%' will be replaced by the contents of in
 * the 'format' argument. An example for the 'format' argument is "?page=%#%"
 * and the '%#%' is also required. The '%#%' will be replaced with the page
 * number.
 *
 * You can include the previous and next links in the list by setting the
 * 'prev_next' argument to true, which it is by default. You can set the
 * previous text, by using the 'prev_text' argument. You can set the next text
 * by setting the 'next_text' argument.
 *
 * If the 'show_all' argument is set to true, then it will show all of the pages
 * instead of a short list of the pages near the current page. By default, the
 * 'show_all' is set to false and controlled by the 'end_size' and 'mid_size'
 * arguments. The 'end_size' argument is how many numbers on either the start
 * and the end list edges, by default is 1. The 'mid_size' argument is how many
 * numbers to either side of current page, but not including current page.
 *
 * It is possible to add query vars to the link by using the 'add_args' argument
 * and see {@link add_query_arg()} for more information.
 *
 * @since framework 1.0
 *
 * @param string|array $args Optional. Override defaults.
 * @return array|string String of page links or array of page links.
 */
function ts_wp_custom_paginate_links( $args = '' ) {
	$defaults = array(
		'base' => '%_%', // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
		'format' => '?page=%#%', // ?page=%#% : %#% is replaced by the page number
		'total' => 1,
		'current' => 0,
		'show_all' => false,
		'prev_next' => true,
		'prev_text' => __('&laquo; Previous','circles'),
		'next_text' => __('Next &raquo;','circles'),
        'next_prev_only' => false,
        'items_wrap' => '<li class="%s">%s</li>',
        'item_class' => 'page',
        'item_active_class' => 'active page',
        'list_item_active_class' => 'active',
        'item_prev_class' => 'prev-page  icon-chevron-left',
        'item_next_class' => 'next-page  icon-chevron-right',
		'end_size' => 1,
		'mid_size' => 2,
		'type' => 'plain',      //plain/array
		'add_args' => false, // array of query args to add
		'add_fragment' => '',
    );
    
    $args = wp_parse_args( $args, $defaults );
	extract($args, EXTR_SKIP);

	// Who knows what else people pass in $args
	$total = (int) $total;
	if ( $total < 2 )
		return;
	$current  = (int) $current;
	$end_size = 0  < (int) $end_size ? (int) $end_size : 1; // Out of bounds?  Make it the default.
	$mid_size = 0 <= (int) $mid_size ? (int) $mid_size : 2;
	$add_args = is_array($add_args) ? $add_args : false;
	$r = '';
	$page_links = array();
	$page_links_active = array();
	$n = 0;
	$dots = false;

	if ( $prev_next && $current && 1 < $current ) :
		$link = str_replace('%_%', 2 == $current ? '' : $format, $base);
		$link = str_replace('%#%', $current - 1, $link);
		if ( $add_args )
			$link = add_query_arg( $add_args, $link );
		$link .= $add_fragment;
		$page_links['prev'] = '<a class="'.$item_prev_class.'" href="' . esc_url( $link ) . '">' . $prev_text . '</a>';
		$page_links_active['prev'] = false;
	else:
		//$page_links[] = '<a class="'.$item_prev_class.'" href="javascript:;">' . $prev_text . '</a>';
	endif;
    
    if ($next_prev_only !== true)
    {
		$items_left = 4; //show x items left from the selected page
		$items_right = 4; //show x items right from the selected page
		if ($current <= 4) {
			$items_right = 8 - $current + 1;
		}
		if ($current + 4 > $total) {
			$items_left = $current - $total + 8;
		}
		
		for ( $n = 1; $n <= $total; $n++ ) :
			
			if ($total > 8 && ($n < $current - $items_left || $n > $current + $items_right)) {
				$page_links_active[$n] = false;
				continue;
			}
			
            //$n_display = sprintf("%02s", $n);
            $n_display = $n;
            $link = str_replace('%_%', 1 == $n ? '' : $format, $base);
            $link = str_replace('%#%', $n, $link);
            if ( $add_args ):
                $link = add_query_arg( $add_args, $link );
            endif;
            
            $link .= $add_fragment;
            
            if ( $n == $current ) :
                $page_links[$n] = "<a class='".$item_active_class."' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>$n_display</a>";
				$page_links_active[$n] = true;
			else:
                $page_links[$n] = "<a class='".$item_class."' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>$n_display</a>";
				$page_links_active[$n] = false;
			endif;
        endfor;
    }
	
	if ( $prev_next && $current && ( $current < $total || -1 == $total ) ) :
		$link = str_replace('%_%', $format, $base);
		$link = str_replace('%#%', $current + 1, $link);
		if ( $add_args )
			$link = add_query_arg( $add_args, $link );
		$link .= $add_fragment;
		$page_links['next'] = '<a class="'.$item_next_class.'" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $next_text . '</a>';
		$page_links_active['next'] = false;
	else:
		//$page_links[] = '<a class="'.$item_next_class.'" href="javascript:;">' . $next_text . '</a>';
	endif;
    
    if (!empty($items_wrap)):
        
		foreach ($page_links as $key => $val):
			if (substr_count($items_wrap,"%s") == 2)
			{
				$class = '';
				if ($page_links_active[$key] === true)
				{
					$class = $list_item_active_class;
				}
				$page_links[$key] = sprintf($items_wrap,$class,$val);
			}
			else
			{
				$page_links[$key] = sprintf($items_wrap,$val);
			}
        endforeach;
    endif;
    
    switch ( $type ) :
		case 'array' :
			return array('links' => $page_links, 'active' => $page_links_active);
			break;
		default :
			$r = join("\n", $page_links);
			break;
	endswitch;
	return $r;
}

/**
 * Fix for shortcode, remove empty paragrpah
 *
 * @since framework 1.0
 */
function ts_shortcode_empty_paragraph_fix($content)
{
    $array = array(
    '<p>[' => '[',
    ']</p>' => ']',
    ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'ts_shortcode_empty_paragraph_fix');
