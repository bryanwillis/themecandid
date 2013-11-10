<?php
/*
* Template Name: Contact Form Template 2
*/

get_header(); ?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class='wrapper top-slider' id="map-box"><?php echo do_shortcode(get_post_meta(get_the_ID(), 'map',true)); ?></div>
	<div class='wrapper'>
		<div class='container contacts'>
			<section class='grid_12'>
				<div>
					<?php the_content(); ?>
				</div>
			</section>
		</div>
	</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>