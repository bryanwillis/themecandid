<?php
/*
* Template Name: Homepage
*/
get_header();
get_template_part('inc/header-image'); ?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php if (get_post_meta(get_the_ID(), 'show_page_content',true) != 'no'): ?>

		<?php
		$content_1 = ts_get_page_builder_content('content_1');
		$content_2 = ts_get_page_builder_content('content_2');
		$content_3 = ts_get_page_builder_content('content_3');
		$content_4 = ts_get_page_builder_content('content_4');
		$content_5 = ts_get_page_builder_content('content_5');
		$content_6 = ts_get_page_builder_content('content_6');
		$content_7 = ts_get_page_builder_content('content_7');
		?>

		<?php if(!empty($content_1)) : ?>
			<!-- Content area 1 -->
			<aside class='wrapper blue'>
				<?php echo $content_1; ?>
			</aside>
		<?php endif; ?>

		<?php if(!empty($content_2)) : ?>
			<!-- Content area 2 -->
			<aside class='wrapper'>
				<?php echo $content_2; ?>
			</aside>
		<?php endif; ?>

		<?php if(!empty($content_3)) : ?>
			<!-- Content area 3 -->
			<aside class='wrapper default-bg'>
				<div class='container'>
					<?php echo $content_3; ?>
				</div>
			</aside>
		<?php endif; ?>

		<?php if(!empty($content_4)) : ?>
			<!-- Content area 4 -->
			<aside class='wrapper border-tb-white marble-color'>
				<div class='container'>
					<?php echo $content_4; ?>
				</div>
			</aside>
		<?php endif; ?>

		<?php if(!empty($content_5)) : ?>
			<!-- Content area 5 -->
			<aside class='wrapper default-bg'>
				<div class='container'>
					<?php echo $content_5; ?>
				</div>
			</aside>
		<?php endif; ?>
		<?php if(!empty($content_6)) : ?>
			<!-- Content area 6 -->
			<aside class='wrapper border-tb-white marble-color'>
				<div class='container'>
					<?php echo $content_6; ?>
				</div>
			</aside>
		<?php endif; ?>
		<?php if(!empty($content_7)) : ?>
			<!-- Content area 7 -->
			<aside class='wrapper lighter-grey default-bg'>
				<div class='container'>
					<?php echo $content_7; ?>
				</div>
			</aside>
		<?php endif; ?>
	<?php endif; ?>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>