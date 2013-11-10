<?php
/**
 * The template for displaying gallery post format content
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
		<?php $gallery = get_post_meta($post->ID, 'gallery_images',true); ?>
		<?php if (is_array($gallery) && count($gallery) > 0): ?>
			<article class='item-con-t1'>
				<div class='container-t1'>
					<div class='container-t1-margin'>
						<div class='facilities visible-on-hover'>
							<div class='gallery-image-links'>
								<a class='prev' title='<?php _e('Previous','circles'); ?>' href='#' id="prev-<?php echo $post->ID;?>">
									<span></span>
									<span class='tran03slinear'></span>
									<span></span>
								</a>
								<a class='next' title='<?php _e('Next','circles'); ?>' href='#' id="next-<?php echo $post->ID;?>">
									<span></span>
									<span class='tran03slinear'></span>
									<span></span>
								</a>
							</div>
							<a class='image-link' rel='prettyPhoto' title='Sed diam nonumy' href='http://circles.arenaofthemes.com/wp-content/uploads/2013/03/smaller_size-3.jpg'><span class='zoom'></span></a>
						</div>
						<div class="flexslider" id="flexslider-<?php echo $post->ID;?>">
							<ul class="slides">
								<?php foreach ($gallery as $image): ?>
									<li>
										<?php
										switch ($featured_image_align)
										{
											case 'left':
											case 'right':
												ts_the_resized_image_sidebar($image['image'], array('full-aligned', 'one-sidebar-aligned', 'two-sidebars-aligned'), $image['title']);
												break;
											case 'center':
											default:
												ts_the_resized_image_sidebar($image['image'], array('full', 'one-sidebar', 'two-sidebars'), $image['title']);
												break;
										}
										?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<script type="text/javascript">
							jQuery(document).ready(function() {
								jQuery('#flexslider-<?php echo $post->ID;?>').flexslider({
									animation: "slide",
									controlNav: false,
									prevText: "<?php echo ts_get_prev_slider_text(); ?>",
									nextText: "<?php echo ts_get_next_slider_text(); ?>"
								});
								jQuery("#prev-<?php echo $post->ID;?>").click(function(){
									jQuery('#flexslider-<?php echo $post->ID;?>').flexslider("prev");
									return false;
								});

								jQuery("#next-<?php echo $post->ID;?>").click(function(){
									jQuery('#flexslider-<?php echo $post->ID;?>').flexslider("next");
									return false;
								});
							});
						</script>
					</div>
				</div>
				<div class='blue-line'></div>
			</article>
		<?php elseif (has_post_thumbnail()): ?>
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