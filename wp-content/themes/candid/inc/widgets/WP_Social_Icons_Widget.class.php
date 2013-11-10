<?php
/**
 * Social Icons widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Social_Icons_Widget' );

function init_WP_Social_Icons_Widget() {
	register_widget('WP_Social_Icons_Widget');
}
 
class WP_Social_Icons_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_social_icons_item', 'description' => __( "Display social icons activated in theme options", "framework" ) );
		parent::__construct('random-work', __( 'Social Icons', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_social_icons_item';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		$cache = wp_cache_get('widget_social_icons_item', 'widget');
		
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
		
		$active_social_items = ot_get_option('active_social_items');
		if (is_array($active_social_items) && count($active_social_items) > 0)
		{
			echo $before_title.$title.$after_title; 
			?>
			<ul class='socials-bottom clearfix'>
				<?php if (in_array('facebook',$active_social_items)): ?>
					<li>
						<a class='facebook' href='<?php echo ot_get_option('facebook_url'); ?>' target="_blank"></a>
						<div class='cloud'>Facebook<div class='helper'></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('twitter',$active_social_items)): ?>
					<li>
						<a class='twitter' href='<?php echo ot_get_option('twitter_url'); ?>' target="_blank"></a>
						<div class='cloud'>Twitter<div class='helper'></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('skype',$active_social_items)): ?>
					<li>
						<a class='skype' href='skype:<?php echo ot_get_option('skype_url'); ?>?call'></a>
						<div class='cloud'>Skype<div class='helper'></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('dribble',$active_social_items)): ?>
					<li>
						<a class='dribbble' href='<?php echo ot_get_option('dribble_url'); ?>' target="_blank"></a>
						<div class='cloud'>Dribbble<div class='helper'></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('youtube',$active_social_items)): ?>
					<li>
						<a class='youtube' href='<?php echo ot_get_option('youtube_url'); ?>' target="_blank"></a>
						<div class='cloud'>Youtube<div class='helper'></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('pinterest',$active_social_items)): ?>
					<li>
						<a class='pinterest' href='<?php echo ot_get_option('pinterest_url'); ?>' title="Pinterest" target="_blank"></a>
						<div class="cloud">Pinterest<div class="helper"></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('tumblr',$active_social_items)): ?>
					<li>
						<a class='tumblr' href='<?php echo ot_get_option('tumblr_url'); ?>' title="Tumblr" target="_blank"></a>
						<div class="cloud">Tumblr<div class="helper"></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('google_plus',$active_social_items)): ?>
					<li>
						<a class='google-plus' href='<?php echo ot_get_option('google_plus_url'); ?>' title="Google+" target="_blank"></a>
						<div class="cloud">Google+<div class="helper"></div></div>
					</li>
				<?php endif;?>
				<?php if (in_array('linkedin',$active_social_items)): ?>
					<li>
						<a class='linkedin' href='<?php echo ot_get_option('linkedin_url'); ?>' title="LinkedIn" target="_blank"></a>
						<div class="cloud">LinkedIn<div class="helper"></div></div>
					</li>
				<?php endif;?>
			</ul>
			<?php
			echo $after_widget;
		}
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_social_icons_item', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_social_icons_item', 'widget');
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
