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
		<?php ts_get_single_post_sidebar('left'); ?>
		<?php ts_get_single_post_sidebar('left2'); ?>
		<div class='post-area grid_<?php echo ts_check_if_any_sidebar(12,9,6); ?>'>
			<div class='posts-container'>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'single' ); ?>
					<?php
						if ( comments_open() || '0' != get_comments_number() ):
							comments_template( '', true );
						endif;
					?>
				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
		<?php ts_get_single_post_sidebar('right2'); ?>
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