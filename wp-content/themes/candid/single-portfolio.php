<?php
/**
 * The Template for displaying single portfolio.
 *
 * @package circles
 * @since circles 1.0
 */

get_header();
get_template_part('inc/header-image');?>


<?php if ( have_posts() ) : the_post();
	$categories_list = wp_get_object_terms($post->ID, 'portfolio-categories',array('fields' => 'names'));
	$categories = '';
	if (is_array($categories_list))
	{
		$categories = '<span>'.implode('</span> <span>',$categories_list).'</span>';
	}
	$image_src = '';
	if (has_post_thumbnail())
	{
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
		$image_src = $image[0];
	}

	?>
	<aside class='wrapper marble border-tb-white'>
		<div class='container'>
			<div class='grid_9'>
				<div class='gallery-single-pagination'>
					<?php if (get_previous_post()): ?>
						<?php previous_post_link('%link', __('previous','circles')); ?>
					<?php else: ?>
						<a href="#" class="prev" rel="prev"><?php _e('previous','circles'); ?></a>
					<?php endif;
					$portfolio_page = ot_get_option('portfolio_page');
					if (!empty($portfolio_page)): ?>
						<a href="<?php echo get_permalink($portfolio_page);?>" class="to_gallery"></a>
					<?php else: ?>
						<a href="#" class="to_gallery"></a>
					<?php endif; ?>
					<?php if (get_next_post()): ?>
						<?php next_post_link('%link', __('next','circles')); ?>
					<?php else: ?>
						<a href="#" class="next" rel="next"><?php _e('next','circles'); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</aside>
	<div class='wrapper'>
		<div class='container single-gallery'>
			<div class='grid_9'>
				<div class='single-gallery-container'>
					<article class='item-con-t1'>
						<div class='container-t1'>
							<div class='container-t1-margin'>
								<?php
								if (get_post_format() == 'video'):
									$url = get_post_meta($post -> ID, 'video_url',true);
									if (!empty($url)):
										$embadded_video = ts_get_embaded_video($url);
									elseif (empty($url)):
										$embadded_video = get_post_meta($post -> ID, 'embedded_video',true);
									endif;
								elseif (get_post_format() == 'gallery'):
									$gallery = get_post_meta($post->ID, 'gallery_images',true);
									$gallery_html = '';
									if (is_array($gallery)):
										foreach ($gallery as $image):
											$gallery_html .= '<li>'.ts_get_resized_image_by_size($image['image'], 'portfolio-single', $image['title']).'</li>';
										endforeach;
									endif;
								endif;
								?>
								<?php if (!isset($embadded_video)): ?>
									<header>
										<div class='bg-black-045'></div>
										<h2><?php the_title(); ?></h2>
										<h3><?php echo $categories; ?></h3>
									</header>
								<?php endif; ?>
								<?php
								if (isset($embadded_video)): ?>
									<div class="videoWrapper">
										<img src="<?php echo get_bloginfo('template_directory') ?>/img/360x181.png" width="360" height="181" alt="">
										<?php echo $embadded_video; ?>
									</div>
								<?php elseif (isset($gallery_html)): ?>
									<div class="portfolio-gallery">
										<div class="flexslider" id="portfolio-gallery-<?php echo $post -> ID; ?>">
											<ul class="slides">
												<?php echo $gallery_html; ?>
											</ul>
										</div>
										<script type="text/javascript">
											jQuery(document).ready(function() {
												jQuery("#portfolio-gallery-<?php echo $post -> ID; ?>").flexslider({
													animation: "slide",
													animationLoop: true,
													directionNav: true,
													controlNav: false,
													slideshowSpeed: 7000,
													prevText: "<?php echo ts_get_prev_slider_text(); ?>",
													nextText: "<?php echo ts_get_next_slider_text(); ?>"
												});

												jQuery("#portfolio-gallery-prev").click(function(){
													jQuery("#portfolio-gallery-<?php echo $post -> ID; ?>").flexslider("prev");
													return false;
												});

												jQuery("#portfolio-gallery-next").click(function(){
													jQuery("#portfolio-gallery-<?php echo $post -> ID; ?>").flexslider("next");
													return false;
												});

											});
										</script>
									</div>
									<div class='facilities visible-on-hover'>
										<div class='gallery-image-links'>
											<a class='prev'  href="#" id="portfolio-gallery-prev">
												<span></span>
												<span class='tran03slinear'></span>
												<span></span>
											</a>
											<a class='next' href="#" id="portfolio-gallery-next">
												<span></span>
												<span class='tran03slinear'></span>
												<span></span>
											</a>
										</div>
									</div>
								<?php else: ?>
									<?php ts_the_resized_post_thumbnail('portfolio-single',get_the_title()); ?>
									<div class='facilities visible-on-hover'>
										<a class='image-link' rel="prettyPhoto" title="<?php esc_attr_e(get_the_title());?>" href="<?php echo $image_src; ?>"><span class='zoom'></span></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class='blue-line'></div>
					</article>
				</div>
			</div>
			<div class='grid_3'>
				<?php if (get_post_meta(get_the_ID(), 'project_info', true)): ?>
					<section class='project-info'>
						<h1><?php _e('project info','circles');?></h1>
						<?php echo get_post_meta(get_the_ID(), 'project_info', true); ?>
					</section>
				<?php endif; ?>
				<?php if (get_post_meta(get_the_ID(), 'project_details', true)): ?>
					<section>
						<h1><?php _e('project details','circles');?></h1>
						<?php echo get_post_meta(get_the_ID(), 'project_details', true); ?>
					</section>
				<?php endif; ?>
			</div>
		</div>
		<div class='container'>
			<div class='grid_12'>
				<section class='project-info'>
					<?php the_content(); ?>
				</section>
			</div>
		</div>
	</div>
	<?php if (ot_get_option('show_related_projects_on_portfolio_single') != 'no'): ?>
		<?php
			$args = array(
					'posts_per_page'     => -1,
					'offset'          => 0,
					'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
					'cat'        	  =>  '',
					'orderby'         => 'date',
					'order'           => 'DESC',
					'include'         => '',
					'exclude'         => get_the_ID(),
					'meta_key'        => '',
					'meta_value'      => '',
					'post_type'       => 'portfolio',
					'post_mime_type'  => '',
					'post_parent'     => '',
					'paged'				=> 1,
					'post_status'     => 'publish',
					'portfolio-categories' => @implode(',',$categories),
					'post__not_in'         => array(get_the_ID())
				);
			query_posts( $args );
		?>
		<?php if ( have_posts() ) : ?>
			<aside class='wrapper related-works marble-color border-tb-white'>
				<section class='container'>
				<section class='widget widget_recent_works'>
					<div class='grid_3'>
						<h2><?php echo ot_get_option('portfolio_page_related_projects_header',__('related works','circles')); ?></h2>
						<?php echo ot_get_option('portfolio_page_related_projects_description'); ?>
						<span id='flexslider-related-works-prev' class='prev-t1'></span>
						<span id='flexslider-related-works-next' class='next-t1'></span>
					</div>
					<div class='grid_9'>
						<div class='flexslider widget_recent_works-container clearfix' id='flexslider-related-works'>
							<ul class='slides'>
								<?php while ( have_posts() ) : the_post();

									if (has_post_thumbnail($post->ID)):
										$image = ts_get_resized_post_thumbnail($post->ID,'related-works',get_the_title());
										$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

										if (!isset($image_src[0])):
											$image_src = array();
											$image_src[0] = '#';
										endif;
									else:
										continue;
									endif;

									$terms = wp_get_post_terms( $post -> ID, 'portfolio-categories', $args );
									$term_slugs = array();
									$term_names = array();
									if (count($terms) > 0):
										foreach ($terms as $term):
											$term_slugs[] = $term -> slug;
											$term_names[] = $term -> name;
										endforeach;
									endif;
									?>

									<li>
										<article class='item-con-t1'>
											<div class='container-t1'>
												<div class='container-t1-margin'>
													<header>
														<div class='bg-black-045'></div>
														<h2><?php the_title(); ?></h2>
														<h3><?php echo implode(' ',$term_names);?></h3>
													</header>
													<?php echo $image; ?>
													<div class='facilities visible-on-hover'>
														<div class='bg-black-045'></div>
														<div class='image-links'>
															<a rel='prettyPhoto[related-works]' title='<?php esc_attr_e(get_the_title()); ?>' href='<?php echo $image_src[0]; ?>'><span class='zoom'></span></a>
															<a title='<?php esc_attr_e(get_the_title()); ?>' href='<?php the_permalink(); ?>'><span class='link'></span></a>
														</div>
													</div>
												</div>
											</div>
											<div class='blue-line visible-on-hover tran03slinear'></div>
										</article>
									</li>
								<?php endwhile; //while ( have_posts() ) ?>
							</ul>
						</div>
					</div>
				</section>
			</section>
			</aside>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#flexslider-related-works").flexslider({
						animation: "slide",
						animationLoop: true,
						itemWidth: 246,
						itemMargin: 0,
						slideshow: false,
						controlNav: false,
						directionNav: false,
						minItems: 3,
						maxItems:3,
						move: 1
					});

					jQuery("#flexslider-related-works-prev").click(function(){
						jQuery("#flexslider-related-works").flexslider("prev");
					});

					jQuery("#flexslider-related-works-next").click(function(){
						jQuery("#flexslider-related-works").flexslider("next");
					});
				});
			</script>
		<?php endif; //if ( have_posts() ) ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; //if (ot_get_option('show_related_projects_on_portfolio_single') != 'no') ?>
<?php endif; ?>
<?php get_footer(); ?>