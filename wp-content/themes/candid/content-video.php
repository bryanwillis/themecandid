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
	<header>
		<a href='<?php the_permalink();?>'><h2><?php the_title(); ?></h2></a>
	</header>
	<?php get_template_part( 'inc/post-info' ); ?>
	<div class="post-body clearfix">
		<?php
		$url = get_post_meta($post -> ID, 'video_url',true);
		if (!empty($url))
		{
			$embadded_video = ts_get_embaded_video($url);
		}
		else if (empty($url))
		{
			$embadded_video = get_post_meta($post -> ID, 'embedded_video',true);
		}
		if (isset($embadded_video)): ?>
			<article class='item-con-t1'>
				<div class='container-t1'>
					<div class='container-t1-margin'>
						<div class="videoWrapper">
							<img src="<?php bloginfo('template_directory') ?>/img/360x181.png" width="360" height="181" alt="">
							<?php echo $embadded_video; ?>

						</div>
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