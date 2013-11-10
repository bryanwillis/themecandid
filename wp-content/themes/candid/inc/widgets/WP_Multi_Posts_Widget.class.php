<?php
/**
 * Popular posts widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Multi_Posts_Widget' );

function init_WP_Multi_Posts_Widget() {
	register_widget('WP_Multi_Posts_Widget');
}

class WP_Multi_Posts_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_multi_posts_entries', 'description' => __( "Displays tabs with most popular posts, recent posts and comments","framework" ) );
		parent::__construct('multi-posts', __( 'Multi Posts', "framework" ), $widget_ops);

		$this-> alt_option_name = 'widget_multi_posts_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $comment;

		$cache = wp_cache_get('widget_multi_posts_entries', 'widget');

		if ( !is_array($cache) )
		{
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) )
		{
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) )
		{
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);
		echo $before_widget;
		$rand = rand(15000,50000);
		?>
		<div id='tab-<?php echo $rand; ?>' class="multi-post underline">
			<ul>
				<li><a><?php _e('Popular','framework'); ?></a></li>
				<li><a><?php _e('Recent','framework'); ?></a></li>
				<li><a><?php _e('Comments','framework'); ?></a></li>
			</ul>
			<div>
				<div class='widget_bookmark_content'>
					<?php
					$number = 3;
					$r = new WP_Query( apply_filters( 'widget_posts_args', array('orderby' => 'comment_count DESC', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );
					if ($r->have_posts()) : ?>
						<?php $posts_sz = count($r->posts);?>
						<?php $i = 0;?>
							<?php  while ($r->have_posts()) : $r->the_post(); ?>
								<div class='widget_bookmark_content_item'>
									<span class="widget_bookmark_date"><?php the_time(get_option('date_format')); ?></span> <span class="widget_bookmark_separator">|</span>
									<span class="widget_bookmark_author">
										<?php _e('By','circles'); ?>
										<span>
											<?php the_author_posts_link();?>
										</span>
									</span>
									<a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php if ( get_the_title() ) echo ts_get_shortened_string(get_the_title(),5); else the_ID(); ?></a>
									<?php ts_the_excerpt_theme(8); ?>
								</div>
								<?php if ($i < 2): ?>
									<div class='g-line'></div>
								<?php endif; ?>
								<?php $i++; ?>
							<?php endwhile; ?>
						<?php
						// Reset the global $the_post as this query will have stomped on it
						wp_reset_postdata();
					endif; //have_posts()
					?>
				</div>

				<div class='widget_bookmark_content'>
					<?php
					$number = 3;
					$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true  ) ) );
					if ($r->have_posts()) : ?>
						<?php $posts_sz = count($r->posts);?>
						<?php $i = 0;?>
							<?php  while ($r->have_posts()) : $r->the_post(); ?>
								<div class='widget_bookmark_content_item'>
									<span class="widget_bookmark_date"><?php the_time(get_option('date_format')); ?></span> <span class="widget_bookmark_separator">|</span>
									<span class="widget_bookmark_author">
										<?php _e('By','circles'); ?>
										<span>
											<?php the_author_posts_link();?>
										</span>
									</span>
									<a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php if ( get_the_title() ) echo ts_get_shortened_string(get_the_title(),5); else the_ID(); ?></a>
									<?php ts_the_excerpt_theme(8); ?>
								</div>
								<?php if ($i < 2): ?>
									<div class='g-line'></div>
								<?php endif; ?>
								<?php $i++; ?>
							<?php endwhile; ?>
						<?php
						// Reset the global $the_post as this query will have stomped on it
						wp_reset_postdata();
					endif; //have_posts()
					?>
				</div>
				<div class='widget_bookmark_content'>
					<?php
					$number = 3;
					$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
					$i = 0;
					if ( $comments ) {
						foreach ( (array) $comments as $comment) {

							?>
							<div class='widget_bookmark_content_item'>
								<span class="widget_bookmark_date"><?php echo comment_time(get_option('date_format'),$comment->comment_ID); ?></span>
								<a href='<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>'><?php echo ts_get_shortened_string($comment->comment_content,5); ?></a>
							</div>
							<?php if ($i < 2): ?>
								<div class='g-line'></div>
							<?php endif; ?>
							<?php $i++; ?>
							<?php
							}
					}
					?>
				</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#tab-<?php echo $rand; ?>').zozoTabs({
					theme: 'silver'
				});
			});
		</script>
		<?php

		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_multi_posts_entries', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
		{
			delete_option('widget_recent_entries');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_multi_posts_entries', 'widget');
	}

	function form( $instance )
	{
		$number = isset($instance['number']) ? absint($instance['number']) : 3;
		?>
		<p><?php _e('No options here','framework');?></p>
		<?php
	}
}