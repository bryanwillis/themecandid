<?php
/**
 * The default template for displaying portfolio content
 *
 * @package circles
 * @since circles 1.0
 */

get_header();
get_template_part('inc/header-image');

global $template_portfolio_columns, $template_portfolio_columns_size, $query_string;

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$posts_per_page = get_post_meta(get_the_ID(),'number_of_items',true);
if (!$posts_per_page) {
	$posts_per_page = -1;
}

	$args = array(
		'numberposts'     => '',
		'posts_per_page'     => $posts_per_page,
		'offset'          => 0,
		'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
		'cat'        =>  '',
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'portfolio',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> $paged,
		'post_status'     => 'publish'
	);
query_posts( $args );
?>
<?php if ( have_posts() ) : ?>
	<?php $terms = get_terms( 'portfolio-categories', array('orderby' => 'name') ); ?>
	<?php if (count($terms) > 0): ?>
		<div class='wrapper marble border-tb-white'>
			<div class='container'>
				<div class='grid_12 gallery-filters'>
					<?php _e('Filter','circles');?>:
					<ul>
						<li><a href="#" class="selected" data-filter="*"><?php _e('All','circles');?></a></li>
						<?php foreach ($terms as $term): ?>
							<li><a href="#" data-filter=".<?php echo $term -> slug; ?>"><?php echo $term -> name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class='wrapper'>
		<div class='container'>
			<div class='grid_12 gallery-container'>
				<div class='gallery'>

					<?php // Start the Loop  ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php $terms = wp_get_post_terms( $post -> ID, 'portfolio-categories', $args );
						$term_slugs = array();
						$term_names = array();
						if (count($terms) > 0):
							foreach ($terms as $term):
								$term_slugs[] = $term -> slug;
								$term_names[] = $term -> name;
							endforeach;
						endif; ?>
						<?php
						$gallery_html = '';
						$prettyPhotoContent = '';
						$icon = '';
						$rel = '';
						$title = get_the_title();
						switch (get_post_format()):
							case 'gallery':
								$gallery = get_post_meta($post->ID, 'gallery_images',true);
								if (is_array($gallery) && count($gallery) > 0):
									foreach ($gallery as $key => $image):
										if ($key == 0):
											$title = $image['title'];
											$prettyPhotoContent = $image['image'];
										else:
											$gallery_html .= '<a rel="prettyPhoto[gallery-'.$post->ID.']" href="'.$image['image'].'" title="'.  esc_attr($image['title']).'"></a>';
										endif;
									endforeach;
								endif;
								$icon = 'format-gallery';
								$rel = 'prettyPhoto[gallery-'.$post->ID.']';
								break;

							case 'video':
								$prettyPhotoContent = get_post_meta($post -> ID, 'video_url', true);
								$icon = 'video';
								$rel = 'prettyPhoto';
								break;

							default:
								$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								$prettyPhotoContent = (isset($image_src[0]) ? $image_src[0] : '');
								$icon = 'zoom';
								$rel = 'prettyPhoto';
						endswitch;

						if (empty($prettyPhotoContent)):
							$prettyPhotoContent = '#';
							$rel = ''; 
						endif;
						?>
						<article class='item-con-t1 <?php echo implode(' ',$term_slugs);?> size1_<?php echo $template_portfolio_columns; ?>'>
							<div class='container-t1'>
								<div class='container-t1-margin'>
									<header class='visible-on-hover'>
										<h2><?php the_title(); ?></h2>
										<h3><?php echo implode(' ',$term_names);?></h3>
									</header>
									<?php ts_the_resized_post_thumbnail($template_portfolio_columns_size,get_the_title()); ?>
									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', true );
									?>
									<div class='facilities visible-on-hover'>
										<div class='bg-black-045'></div>
										<div class='image-links'>
											<a rel="<?php echo $rel; ?>" title="<?php esc_attr_e($title); ?>" href="<?php echo $prettyPhotoContent; ?>"><span class='<?php echo $icon; ?>'></span></a>
											<a rel="" title="<?php esc_attr_e(get_the_title()); ?>" href="<?php the_permalink();?>"><span class='link'></span></a>
										</div>
									</div>
								</div>
								<?php echo $gallery_html; ?>
							</div>
							<div class='blue-line visible-on-hover tran03slinear'></div>
						</article>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
<?php else : //No posts were found ?>
	<?php get_template_part( 'no-results' ); ?>
<?php endif; //have_posts(); ?>
<?php get_footer(); ?>