<?php
/*
* Template Name: Blog Template 2
*/
global $force_featured_image_align;

get_header();
get_template_part('inc/header-image');
$have_posts = false; ?>

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
?>

<div class='wrapper'>
	<div class='container main'>
		<?php ts_get_single_post_sidebar('left'); ?>
		<?php ts_get_single_post_sidebar('left2'); ?>
		<div class='post-area grid_<?php echo ts_check_if_any_sidebar(12,9,6); ?>'>
			<div class='posts-container'>
				<?php if ( have_posts() ) : ?>
					<?php /* Start the Loop */ ?>
					<?php
					$i = 0;
					while ( have_posts() ) : the_post();
						if ($i % 2 == 0):
							$force_featured_image_align = 'left';
						else:
							$force_featured_image_align = 'right';
						endif;
						get_template_part( 'content', get_post_format() );
						$i++;
					endwhile; ?>
					<?php $have_posts = true;?>
				<?php else : //No posts were found ?>
					<?php get_template_part( 'no-results' ); ?>
				<?php endif; ?>
			</div>
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
<?php endif; //if ($have_posts === true) ?>
<?php get_footer(); ?>