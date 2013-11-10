<?php
/**
 * The template for displaying the footer.
 *
 * @package circles
 * @since circles 1.0
 */
?>
		<?php ts_the_recent_tweets(); ?>
		<footer>
			<div class='wrapper grey'>
				<div class='container'>
					<?php get_sidebar('footer'); ?>
				</div>
			</div>
			<div class='wrapper dark-grey copyright-bar'>
				<div class='container'>
					<div class='grid_12'>
						<span class='copyright'><?php echo ot_get_option('footer_text'); ?></span>
					</div>
				</div>
			</div>
		</footer>
		<a id="back_to_top" href="#"></a>
		<?php echo ot_get_option('scripts_footer'); ?>
		<?php wp_footer(); ?>
		<div class="media_for_js"></div>
	</body>
</html>