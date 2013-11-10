<?php
/**
 * Latest Tweets Widget
 *
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Side_Navi_Widget' );

function init_WP_Side_Navi_Widget() {
	register_widget('WP_Side_Navi_Widget');
}

class WP_Side_Navi_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_side_navi', 'description' => __( 'Shows choosen WordPress pages','framework') );
		parent::__construct('side_navi', __('Side Navi','framework'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Side Navi','framework' ) : $instance['title'], $instance, $this->id_base);
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$include = empty( $instance['include'] ) ? '' : $instance['include'];
		
		if ( $sortby == 'menu_order' )
			$sortby = 'menu_order, post_title';
		
		$out = '';
		if (!empty($include))
		{
			$out = wp_list_pages(
				apply_filters('widget_pages_args',
					array(
						'title_li' => '',
						'echo' => 0,
						'sort_column' => $sortby,
						'include' => $include
					)
				)
			);
		}
		$out = str_replace('</a>','</a><div></div>',$out);
		
		if ( !empty( $out ) ) {
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
		?>
		<ul class='left_navigation'>
			<?php echo $out; ?>
		</ul>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['include'] = strip_tags( $new_instance['include'] );
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'include' => '') );
		$title = esc_attr( $instance['title'] );
		$include = esc_attr( $instance['include'] );
		$exclude = esc_attr( $instance['exclude'] );
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','framework'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:' ,'framework'); ?></label>
			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title','framework'); ?></option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order','framework'); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID','framework' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('include'); ?>"><?php _e( 'Include:' ,'framework'); ?></label> <input type="text" value="<?php echo $include; ?>" name="<?php echo $this->get_field_name('include'); ?>" id="<?php echo $this->get_field_id('include'); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Page IDs, separated by commas.' ,'framework'); ?></small>
		</p>
<?php
	}

}