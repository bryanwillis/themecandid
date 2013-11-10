<?php
/**
 * Flickr widget
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Flickr_Tiles_Widget' );

function init_WP_Flickr_Tiles_Widget() {
	register_widget('WP_Flickr_Tiles_Widget');
}
 
class WP_Flickr_tiles_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_flickr_tiles', 'description' => __( "Displays Flickr images", "framework" ) );
		parent::__construct('flickr-tiles', __( 'Flickr Tiles', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_flickr_tiles';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		$cache = wp_cache_get('widget_flickr_tiles', 'widget');
		
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
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Flickr', "framework" ) : $instance['title'], $instance, $this->id_base);
		
		$rss_feed = isset($instance['rss_feed']) ? esc_attr($instance['rss_feed']) : '';
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$api_key = isset($instance['api_key']) ? esc_attr($instance['api_key']) : '';
		$limit = isset($instance['limit']) ? (int)$instance['limit'] : '';
		$tags = isset($instance['tags']) ? esc_attr($instance['tags']) : '';
		
		
		echo $before_title.$title.$after_title;
		
		if (!empty($rss_feed) && strstr($rss_feed,'http'))
		{
			$url = $rss_feed.'&format=php_serial&tags=' . urlencode($tags) . '&tagmode=any';
		}
		else
		{
			$url = 'http://api.flickr.com/services/feeds/photos_public.gne?id='.$username.'&lang=en-us&format=rss_200&format=php_serial&tags=' . urlencode($tags) . '&tagmode=any';
		}
		
		$feed = wp_remote_get($url);
		
		if (is_array($feed) && !empty($feed['body']))
		{
			$images = unserialize($feed['body']);
		}
		
		
		?>
		<?php
		if (is_array($images['items']))
		{
			$i = 0;
			foreach ($images['items'] as $item)
			{
				
				if ($limit > 0 && $limit <= $i)
				{
					break;
				}
				$i ++;
				echo '<a href="'.$item['photo_url'].'" rel="prettyPhoto[flickr]"><img src="'.$item['m_url'].'" alt="'.$item['title'].'" /></a>';
			}
		}
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_flickr_tiles', $cache, 'widget');
	}
	
//	function request( $args)
//	{
//		//$args['method'] = $method;
//		$args['format'] = 'json';
//		//$args['api_key'] = $api_key;
//		$args['nojsoncallback'] = 1;
//		$url = esc_url_raw( add_query_arg( $args, 'http://api.flickr.com/services/rest/' ) );
//
//		$response = wp_remote_get( $url );
//		if ( is_wp_error( $response ) )
//		{
//			return false;
//		}
//		$body = wp_remote_retrieve_body( $response );
// 		$obj = json_decode( $body );
//
//		if ( $obj && $obj->stat == 'fail' )
//		{
//			return new WP_Error( 'error', $obj->message );
//		}
//		return $obj ? $obj : false;
//	}
//	
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['rss_feed'] = strip_tags($new_instance['rss_feed']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['api_key'] = strip_tags($new_instance['api_key']);
		$instance['limit'] = (int)$new_instance['limit'];
		$instance['tags'] = strip_tags($new_instance['tags']);
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_flickr_tiles', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$rss_feed = isset($instance['rss_feed']) ? esc_attr($instance['rss_feed']) : '';
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$api_key = isset($instance['api_key']) ? esc_attr($instance['api_key']) : '';
		$limit = isset($instance['limit']) ? (int)$instance['limit'] : '';
		$tags = isset($instance['tags']) ? esc_attr($instance['tags']) : '';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'rss_feed' ); ?>"><?php _e("Flickr RSS Feed URL:",'framework'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'rss_feed' ); ?>" name="<?php echo $this->get_field_name( 'rss_feed' ); ?>" type="text" value="<?php echo esc_attr($rss_feed); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e("or User ID:",'framework'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
<!--		<p><label for="<?php echo $this->get_field_id( 'api_key' ); ?>"><?php _e("API Key",'framework'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'api_key' ); ?>" name="<?php echo $this->get_field_name( 'api_key' ); ?>" type="text" value="<?php echo esc_attr($api_key); ?>" /></label></p>-->
		<p><label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e("Limit items",'framework'); ?> <select class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>"><?php for ( $i = 1; $i <= 20; ++$i ) echo "<option value=\"$i\" ".($limit==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
		<p><label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e("Filter by tags (comma seperated):",'framework'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" type="text" value="<?php echo esc_attr($tags); ?>" /></label></p>	
		<?php
	}
}