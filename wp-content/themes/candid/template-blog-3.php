<?php
/*
* Template Name: Blog Template 3
*/

get_header();
get_template_part('inc/header-image'); ?>
<?php
//adhere to paging rules
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$posts_per_page = get_post_meta(get_the_ID(),'number_of_items',true);
if (!$posts_per_page) {
	$posts_per_page = get_option('posts_per_page');
}

global $query_string;
	$args = array(
		'numberposts'     => '',
		'posts_per_page' => $posts_per_page,
		'offset'          => 0,
		'cat'        =>  '',
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'post',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> $paged,
		'post_status'     => 'publish'
	);
query_posts( $args );

/*
 * link, photo, slider, video, sound
 *
 */
?>
<div class='wrapper template-blog-3'>
	<div class='container'>
		<?php ts_get_single_post_sidebar('left'); ?>
		<?php ts_get_single_post_sidebar('left2'); ?>
		<div class='grid_<?php echo ts_check_if_any_sidebar(12,9,6); ?>'>
			<div id="blog-3" class='column'>
				<?php if ( have_posts() ) : ?>
					<?php $have_posts = true;?>
					<?php //Start the Loop ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article class="column_post <?php echo (get_post_format() ? 'format-'.get_post_format() : '');?>">
							<div class="column_post-helper">
								<?php $thumb = ts_get_circles_thumb(array('template-blog-3-full', 'template-blog-3-one-sidebar', 'template-blog-3-two-sidebars')); ?>
								<?php
								if (!empty($thumb)): ?>
									<div class='column_post-media'>
										<?php echo $thumb; ?>
									</div>
								<?php endif; ?>
								<header>
									<div class='column_post-type'>
										<span>
										</span>
									</div>
									<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
								</header>
								<footer>
									<div class="column_post-author">
										<?php _e('By','circles');?>
										<span>
											<?php the_author_posts_link();?>
										</span>
									</div>
									<div class="column_post-date">
										<span><?php the_time(get_option('date_format')); ?></span>
									</div>
									<?php
									$categories = get_the_category_list(', ');
									if (!empty($categories)): ?>
										<div class='column_post-category'>
											<span>
												<?php echo $categories; ?>
											</span>
										</div>
									<?php endif; ?>
								</footer>
								<div class="column_post-body">

									<?php
									$length = 'regular';
									$page_length = get_post_meta(ts_get_current_id(), 'excerpt_length',true);
									if (!empty($page_length)):
										$length = $page_length;
									endif;
									ts_the_excerpt_theme($length); ?>

								</div>
							</div>
						</article>
					<?php endwhile; ?>
				<?php endif;  ?>
				<?php wp_reset_postdata(); ?>
			</div>

			<?php $pagination = ts_get_theme_navi_array();

			if (isset($pagination['links']['next']))
			{
				?>
				<div class="next-page-container">
					<?php echo $pagination['links']['next']; ?>
				</div>
				<?php
			}
			?>

		</div>
		<?php ts_get_single_post_sidebar('right2'); ?>
		<?php ts_get_single_post_sidebar('right'); ?>
	</div>
</div>
<?php if ($have_posts === true): ?>
<aside class='wrapper lighter-grey'>
	<div class='container'>
		<div class='grid_9'>
			<?php ts_the_circles_navi(); ?>
		</div>
	</div>
</aside>
<?php endif; ?>
<?php get_footer(); ?>
