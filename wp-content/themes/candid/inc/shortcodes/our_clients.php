<?php
/**
 * Shortcode Title: Images slider
 * Shortcode: our_clients
 * Usage: [our_clients][our_clients_item url="http://test.com" target="_blank"]image.png[/our_clients_item][/our_clients]
 * Options: action="url/open"
 */
add_shortcode('our_clients', 'ts_our_clients_func');

function ts_our_clients_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'header' => ''
    ), $atts));
	$rand = rand(15000,50000);

	return '
			<section class="widget widget_our_clients">
				<h2 class="title">'.$header.'</h2>
				<div class="separator"><div></div></div>
				<div class="pagination"></div>
				<div class="grid_12">
					<div class="widget_our_clients-container flexslider clearfix" id="flexslider-'.$rand.'">
						<ul class="slides">
							'.do_shortcode(shortcode_unautop($content)).'
						</ul>
					</div>
				</div>
			</section>
		<script type="text/javascript">// <![CDATA[
			jQuery(document).ready(function() {
				jQuery("#flexslider-'.$rand.'").flexslider({
					animation: "slide",
					controlNav: false,
					directionNav: true,
					itemWidth: 200,
					itemMargin: 0,
					minItems: 1,
					maxItems: 5,
					move:1
				});
			});
			// ]]>
		</script>';
}

/**
 * Shortcode Title: Image item - can be used only with our_clients shortcode
 * Shortcode: our_clients_item
 */
add_shortcode('our_clients_item', 'ts_our_clients_item_func');
function ts_our_clients_item_func( $atts, $content = null )
{
	 extract(shortcode_atts(array(
	    'url' => '',
	    'target' => '',
    ), $atts));

	//wordpress is replacing "x" with special character in strings like 1920x1080
	//we have to bring back our "x"
	$content = str_replace('&#215;','x',$content);

	$item = '<li>';
	$image = '<img src="'.$content.'">';
	if (!empty($url))
	{
		$item .= '<a href="'.$url.'" '.(!empty($target) ? 'target="'.$target.'"':'').'>'.$image.'</a>';
	}
	else
	{
		$item .= $image;
	}

	$item .= '</li>';

	return $item;
}