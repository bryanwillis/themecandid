<?php
/**
 * Latest Tweets Widget
 *
 * @package framework
 * @since framework 1.0
 */

add_action( 'widgets_init', 'init_WP_Latest_Tweets_Widget' );

function init_WP_Latest_Tweets_Widget() {
	register_widget('WP_Latest_Tweets_Widget');
}

class WP_Latest_Tweets_Widget extends WP_Widget {

	function __construct() {
		// widget actual processes
		parent::WP_Widget( 'latest_tweets_widget', __('Latest Tweets Widget','framework'), array( 'description' => __('Tweets from Twitter account','framework') ) );
	}

	function form($instance) {
		// outputs the options form on admin
		if ( !function_exists('quot') ){
			function quot($txt){
				return str_replace( "\"", "&quot;", $txt );
			}
		}

		// format some of the options as valid html
		$username = htmlspecialchars($instance['user'], ENT_QUOTES);
		$updateCount = htmlspecialchars($instance['count'], ENT_QUOTES);
		$showTweetTimeTF = $instance['showTweetTimeTF'];
		$widgetTitle = stripslashes(quot($instance['widgetTitle']));
	?>
		<p>
		
			<label for="<?php echo $this->get_field_id('user'); ?>" style="line-height:35px;display:block;"><?php _e('Twitter user:','framework');?> @<input type="text" size="12" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" value="<?php echo $username; ?>" /></label>
			<label for="<?php echo $this->get_field_id('count'); ?>" style="line-height:35px;display:block;"><?php _e('Show:','framework');?> <input type="text" id="<?php echo $this->get_field_id('count'); ?>" size="2" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $updateCount; ?>" /> twitter updates</label>
			<label for="<?php echo $this->get_field_id('widgetTitle'); ?>" style="line-height:35px;display:block;"><?php _e('Widget title:','framework');?>: <input type="text" id="<?php echo $this->get_field_id('widgetTitle'); ?>" size="16" name="<?php echo $this->get_field_name('widgetTitle'); ?>" value="<?php echo $widgetTitle; ?>" /></label>
			 
           <p><input type="checkbox" id="<?php echo $this->get_field_id('showTweetTimeTF'); ?>" value="1" name="<?php echo $this->get_field_name('showTweetTimeTF'); ?>"<?php if($showTweetTimeTF){ ?> checked="checked"<?php } ?>> <label for="<?php echo $this->get_field_id('showTweetTimeTF'); ?>">Show tweeted "time ago"</label></p>  
		   <p><strong>The wiget requires</strong> Consumer key, consumer secret, user token and access secret token set in theme options!</p>
			
		</p>
<?php
	}

	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['user'] = esc_html($new_instance['user']);
		$instance['count'] = esc_html($new_instance['count']);
		$instance['widgetTitle'] = esc_html( $new_instance['widgetTitle']);
		
		if( $new_instance['showTweetTimeTF']=="1"){
			$instance['showTweetTimeTF'] = true;
		} else{
			$instance['showTweetTimeTF'] = false;
		}
		if( $new_instance['includeRepliesTF']=="1"){
			$instance['includeRepliesTF'] = true;
		} else{
			$instance['includeRepliesTF'] = false;
		}
		return $instance;
	}

	function widget($args, $instance) {
		// outputs the content of the widget
		extract($args, EXTR_SKIP);
		//default to my twitter name
		$profilePicFileName = '' ;
		$username = empty($instance['user']) ? "salzano" : $instance['user'];
		$updateCount = empty($instance['count']) ? 3 : $instance['count'];
		$showTweetTimeTF = $instance['showTweetTimeTF'];
		$title = $instance['widgetTitle'];
		$includeRepliesTF = $instance['includeRepliesTF'];

		//have we fetched twitter data in the last 30 minutes?
		if(1 || $this->file_missing_or_old( $username, 30 )){
			//get new data from twitter
			$jsonData = $this->get_from_twitter( $username );
		} else {
			//already have data, get the data out of db
			$jsonData = $this->get_json_data_from_file( $username );
		}
		
		if( $tweets = json_decode( $jsonData )){
			$haveTwitterData = true;
		} else{
			//tweets is null
			$haveTwitterData = false;
		}
		
		// output the widget
		$title = empty($title) ? '&nbsp;' : apply_filters('widget_title', $title);
		echo $before_widget;
		if( !empty( $title ) && $title != "&nbsp;" )
		{
			echo $before_title . $title . $after_title;
		}
		if( $haveTwitterData ){
			$linkHTML = "<a href=\"http://twitter.com/".$username."\">";
			$pluginURL = home_url()."/wp-content/plugins/latest-twitter-sidebar-widget/";
			$icon = $pluginURL . "twitter.png";
			$pic = $pluginURL . $profilePicFileName;
			$i=1;
			
			echo '<ul class="tweets">';
			foreach( $tweets as $tweet ){
				//exit this loop if we have reached updateCount
				if( $i > $updateCount ){ break; }
				//skip this iteration of the loop if this is a reply and we are not showing replies
				if( !$includeRepliesTF && strlen( $tweet->in_reply_to_screen_name )){ 		continue;	} ?>
					<li>
						<div class="tweets-img"></div>
						<div class="tweets-desc">
							<h3><?php echo $this->fix_twitter_update( $tweet->text, $tweet->entities ); ?></h3>
							<?php if( $showTweetTimeTF ): ?>
								<h4>(<?php echo $this->twitter_time_ltw( $tweet->created_at ); ?>)</h4>
							<?php endif; ?>
						</div>
						<div class="clear"></div>
					</li>
				<?php
				$i++;
			}
			echo "</ul>";
		} else{
			echo __("No tweets",'framework');
		}
		echo $after_widget;
	}

	function fix_twitter_update($origTweet,$entities) {
		$index = array();
		if( $entities == null ){ return $origTweet; }
		foreach( $entities->urls as $url ){
			$index[$url->indices[0]] = "<a target='_blank' href=\"".$url->url."\">".$url->url."</a>";
			$endEntity[(int)$url->indices[0]] = (int)$url->indices[1];
		}
		foreach( $entities->hashtags as $hashtag ){
			$index[$hashtag->indices[0]] = "<a target='_blank' href=\"http://twitter.com/#!/search?q=%23".$hashtag->text."\">#".$hashtag->text."</a>";
			$endEntity[$hashtag->indices[0]] = $hashtag->indices[1];
		}
		foreach( $entities->user_mentions as $user_mention ){
			$index[$user_mention->indices[0]] = "<a target='_blank' href=\"http://twitter.com/".$user_mention->screen_name."\">@".$user_mention->screen_name."</a>";
			$endEntity[$user_mention->indices[0]] = $user_mention->indices[1];
		}
		$fixedTweet="";
		for($i=0;$i<iconv_strlen($origTweet, "UTF-8" );$i++){
			if(iconv_strlen(@$index[(int)$i], "UTF-8" )>0){
				$fixedTweet .= $index[(int)$i];
				$i = $endEntity[(int)$i]-1;
			} else{
				$fixedTweet .= iconv_substr( $origTweet,$i,1, "UTF-8" );
			}
		}
		return $fixedTweet;
	}

	function twitter_time_ltw($a) {
		//get current timestamp
		$b = strtotime("now");
		//get timestamp when tweet created
		$c = strtotime($a);
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour = $minute * 60;
		$day = $hour * 24;
		$week = $day * 7;

		if(is_numeric($d) && $d > 0) {
			//if less then 3 seconds
			if($d < 3) return "right now";
			//if less then minute
			if($d < $minute) return floor($d) . " seconds ago";
			//if less then 2 minutes
			if($d < $minute * 2) return "about 1 minute ago";
			//if less then hour
			if($d < $hour) return floor($d / $minute) . " minutes ago";
			//if less then 2 hours
			if($d < $hour * 2) return "about 1 hour ago";
			//if less then day
			if($d < $day) return floor($d / $hour) . " hours ago";
			//if more then day, but less then 2 days
			if($d > $day && $d < $day * 2) return "yesterday";
			//if less then year
			if($d < $day * 365) return floor($d / $day) . " days ago";
			//else return more than a year
			return "over a year ago";
		}
	}

	function get_from_twitter( $username ){
		
		require_once get_template_directory().'/framework/class/tmhOAuth.php';
		require_once get_template_directory().'/framework/class/tmhUtilities.php';
		$tmhOAuth = new tmhOAuth($a = array(
			'consumer_key'    => ot_get_option('twitter_consumer_key'),
			'consumer_secret' => ot_get_option('twitter_consumer_secret'),
			'user_token'      => ot_get_option('twitter_user_token'),
			'user_secret'     => ot_get_option('twitter_token_secret'),
			'curl_ssl_verifypeer'   => false
		));

		$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
		  'screen_name' => $username));
		$response = $tmhOAuth->response;
		
		if ($response['code'] == 200 && isset($response['response']) && !empty($response['response'])) {
			
			update_option('latest_post_widget_'.$username, $response['body']);
			update_option('latest_post_widget_timestamp_'.$username, mktime());
			//that worked out well
			
			return $response['response'];
			
		} else {
			return false;
		}
	}

	function file_missing_or_old( $username, $ageInMinutes ){
		
		$latest_post_widget_timestamp = get_option('latest_post_widget_timestamp_'.$username);
		if (mktime() - (30 * 60) < $latest_post_widget_timestamp)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function get_json_data_from_file( $username ){
		
		$latest_post_widget = get_option('latest_post_widget_'.$username);
		return $latest_post_widget;
	}
}