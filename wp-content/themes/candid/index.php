<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package circles
 * @since circles 1.0
 */

get_header();
get_template_part('inc/header-image');
$have_posts = false; ?>
<div class='wrapper'>
	<div class='container main'>
		<div class='post-area grid_9'>
			<div class='posts-container'>
				<?php if ( have_posts() ) : ?>
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php $have_posts = true;?>
				<?php else : //No posts were found ?>
					<?php get_template_part( 'no-results' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
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