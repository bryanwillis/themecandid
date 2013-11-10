<?php
/**
 * The Template for displaying all woo commerce content
 *
 * @package circles
 * @since circles 1.0
 */

get_header(); 
get_template_part('inc/header-image'); ?>
<div class='wrapper'>
	<div class='container main'>
		<div class='post-area grid_<?php echo ts_check_if_any_sidebar(12,9,6); ?>'>
			<div>
				<?php woocommerce_content(); ?>
			</div>
		</div>
		<?php get_sidebar('woocomerce'); ?>
	</div>
</div>
<?php get_footer(); ?>