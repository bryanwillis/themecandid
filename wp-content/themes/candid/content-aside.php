<?php
/**
 * Template for displaying aside post type
 *
 * @package circles
 * @since circles 1.0
 */

$featured_image_align = ts_get_featured_image_align();
?>
<article class='post <?php echo (get_post_format() ? 'format-'.get_post_format() : '');?> <?php echo $featured_image_align; ?>'>
	<?php get_template_part( 'inc/post-info' ); ?>
	<div class="post-body clearfix">
		<?php if ( !is_search() && has_post_thumbnail() ) : // display thumbnail if not Search ?>
			<article class='item-con-t1'>
				<div class='container-t1'>
					<div class='container-t1-margin'>
						<?php
						switch ($featured_image_align)
						{
							case 'left':
							case 'right':
								ts_the_resized_post_thumbnail_sidebar(array('full-aligned', 'one-sidebar-aligned', 'two-sidebars-aligned'),get_the_title());
								break;
							case 'center':
							default:
								ts_the_resized_post_thumbnail_sidebar(array('full', 'one-sidebar', 'two-sidebars'),get_the_title());
								break;
						}
						?>
					</div>
				</div>
				<div class='blue-line'></div>
			</article>
		<?php endif; ?>
		<div class='post-body-text'>
			<p><?php ts_the_excerpt_theme('regular'); ?></p>
		</div>
		<a href='<?php the_permalink();?>' title="<?php esc_attr_e( get_the_title() ); ?>" class='sc-button grey-grad'><?php _e( 'read more', 'circles' ); ?></a>
	</div>
</article>