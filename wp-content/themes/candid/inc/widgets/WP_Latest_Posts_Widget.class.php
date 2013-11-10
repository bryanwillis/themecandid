<?php
/**
 * Popular posts widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Latest_Posts_Widget' );

function init_WP_Latest_Posts_Widget() {
	register_widget('WP_Latest_Posts_Widget');
}
 
class WP_Latest_Posts_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_latest_posts_entries', 'description' => __( "Displays the most latest posts in the footer", "framework" ) );
		parent::__construct('latest-posts', __( 'Latest Posts', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_latest_posts_entries';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;
		
		$cache = wp_cache_get('widget_latest_posts_entries', 'widget');
		
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
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Popular Posts', "framework" ) : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
		{
			$number = 10;
		}
		$r = new WP_Query( apply_filters( 'widget_posts_args', array('orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );
		if ($r->have_posts()) : ?>
			<?php echo $before_title.$title.$after_title;  ?>
			<?php $posts_sz = count($r->posts);?>
			<?php $i = 1;?>
			<ul class="latest-posts">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<li>
					<div class="latest-desc">
						<div class="latest-meta">
							<div class="latest-date"><?php the_time(get_option('date_format')); ?></div>
							<div class="latest-author"><?php _e('By', 'circles');?> <?php the_author_link(); ?></div>
						</div>
						<h3><a title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink() ?>"><?php if ( get_the_title() ) echo ts_get_shortened_string(get_the_title(),6); else the_ID(); ?></a></h3>
						<div class="latest-excerpts"><?php ts_the_excerpt_theme('tiny'); ?></div>
					</div>
					<div class="clear"></div>
				</li>
				<?php $i++;?>
				<?php endwhile; ?>
			</ul>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif; //have_posts()
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_latest_posts_entries', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_latest_posts_entries']) )
		{
			delete_option('widget_latest_posts_entries');
		}
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_latest_posts_entries', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to show:', "framework" ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}
}