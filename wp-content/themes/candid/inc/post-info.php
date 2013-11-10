<?php
/**
 * The default template for displaying post info
 *
 * @package circles
 * @since circles 1.0
 */
?>
<footer>
	<div class='post-helper-absolute'>
		<div class='avatar big'>
			<?php echo get_avatar( get_the_author_meta('email'), '61' ); ?>
		</div>
		<div class='post-comments'>
			<span><?php comments_number('0','1','%'); ?></span>
		</div>
		<div class='post-author'>
			<?php _e('By','circles'); ?>
			<span>
				<?php the_author_posts_link();?>
			</span>
		</div>
		<div class='post-type'>
			<span></span>
		</div>
	</div>
	<div class='post-date'>
		<span><?php the_time(get_option('date_format')); ?></span>
	</div>
	<?php
	$categories = get_the_category_list(', ');
	if (!empty($categories)): ?>
		<div class='post-category'>
			<span>
				<?php echo $categories; ?>
			</span>
		</div>
	<?php endif; ?>
	<div class='separator'>
	</div>
</footer>