<?php
/**
 * The Template for displaying all single posts.
 *
 * @package circles
 * @since circles 1.0
 */

get_header();

get_template_part('inc/header-image'); ?>

<div class='wrapper'>
	<div class='container main'>
		<div class='post-area grid_9'>
			<div class='posts-container'>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php
					$classes = array(
						'post',
						'format-image',
						'center'
					);
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
						<?php
						$thumb = ts_get_resized_post_thumbnail_sidebar($post -> ID, array('full', 'one-sidebar', 'two-sidebars'),get_the_title());
						?>
						<header>
							<a href='<?php the_permalink();?>'><h1><?php the_title(); ?></h1></a>
						</header>
						<?php get_template_part( 'inc/post-info' ); ?>
						<div class="post-body clearfix">
							<?php if ( !empty($thumb) ): ?>
								<article class='item-con-t1'>
									<div class='container-t1'>
										<div class='container-t1-margin'>
											<?php echo $thumb; ?>
										</div>
									</div>
									<div class='blue-line'></div>
								</article>
							<?php endif; ?>
						</div>
					</article>
				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
		<?php ts_get_single_post_sidebar('right'); ?>
	</div>
</div>
<aside class='wrapper lighter-grey'>
	<div class='container'>
		<div class='grid_<?php echo ts_check_if_any_sidebar(12,9,6); ?>'>
			<div class='posts-container'>
				<div class='post-single-pagination'>
					<?php
					previous_post_link('%link',__('previous post','circles'));
					next_post_link('%link',__('next post','circles')); ?>

				</div>
			</div>
		</div>
	</div>
</aside>
<?php get_footer(); ?>