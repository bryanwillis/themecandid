<?php
/**
 * Random Work widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Random_Work_Widget' );

function init_WP_Random_Work_Widget() {
	register_widget('WP_Random_Work_Widget');
}
 
class WP_Random_Work_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_random_work_item', 'description' => __( "Display one random portoflio item", "framework" ) );
		parent::__construct('random-work', __( 'Random Work', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_random_work_item';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		$cache = wp_cache_get('widget_random_work_item', 'widget');
		
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
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Random Work', "framework" ) : $instance['title'], $instance, $this->id_base);
		
		global $wpdb;
		
		global $query_string; 
		$args = array(
			'numberposts'     => 1,
			'posts_per_page'  => 3,
			'meta_query' => array(array('key' => '_thumbnail_id')),
			'offset'          => 0,
			'cat'        =>  '',
			'orderby'         => 'rand',
			'order'           => '', 
			'include'         => '',
			'exclude'         => '',
			'meta_key'        => '',
			'meta_value'      => '',
			'post_type'       => 'portfolio',
			'post_mime_type'  => '',
			'post_parent'     => '',
			'paged'				=> 1,
			'post_status'     => 'publish'
		);
		$the_query = new WP_Query( $args );
		
		if ($the_query->have_posts()) : ?>
			<?php echo $before_title.$title.$after_title;  ?>
			
			<?php  while ($the_query->have_posts()) : ?>
				<?php $the_query->the_post(); ?>
					<?php if (has_post_thumbnail()): ?>
					<div class='widget-random-work'>
						<a href="<?php the_permalink();?>" title="<?php esc_attr_e(get_the_title());?>"><?php ts_the_resized_post_thumbnail('sidebar-work');?></a>
					</div>
					<?php break; ?>
				<?php endif; ?>
			<?php endwhile; ?>
			
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif; //have_posts()
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_random_work_item', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_random_work_item', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
	}
}
