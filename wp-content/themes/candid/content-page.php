<?php
/**
 * The default template for displaying single page content
 *
 * @package circles
 * @since circles 1.0
 */
?>
<div class='wrapper <?php echo in_array(ts_get_main_menu_style(),array('style2','style5')) && get_post_meta(get_the_ID(),'transparent_content',true) == 'yes' ? 'transparent-content' : '' ?>'>
	<div class='container main'>
						<?php ts_get_single_post_sidebar('left'); ?>
		<?php ts_get_single_post_sidebar('left2'); ?>
		<div class='post-area grid_<?php echo ts_check_if_any_sidebar(12,9,6); ?>'>
			<div>
				<?php if (has_post_thumbnail()): ?>
					<div class='post-img'><?php ts_the_resized_post_thumbnail_sidebar(array('full', 'one-sidebar', 'two-sidebars'),get_the_title()); ?></div>
				<?php endif; ?>
				<?php if (get_post_meta(get_the_ID(), 'show_page_content',true) != 'no'): ?>
					<?php the_content( ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'circles' ), 'after' => '</div>' ) ); ?>
				<?php endif; ?>
			</div>
		</div>

		<?php ts_get_single_post_sidebar('right2'); ?>
		<?php ts_get_single_post_sidebar('right'); ?>
	</div>
</div>