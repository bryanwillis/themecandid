<?php
/**
 * The Template for displaying all single pages.
 *
 * @package circles
 * @since circles 1.0
 */
 
get_header(); 
get_template_part('inc/header-image'); ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php if (get_post_meta(get_the_ID(), 'show_page_content',true) != 'no'): ?>
		<?php get_template_part( 'content', 'page' ); ?>
	<?php endif; ?>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>