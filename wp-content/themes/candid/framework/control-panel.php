<?php
/**
 * Control panel
 *
 * Shows the Control Panel on your homepage if enabled.
 *
 * @package framework
 * @since framework 1.0
 */

if (ts_check_if_use_control_panel_cookies() && isset($_COOKIE['theme_body_class']))
{
	$body_class = $_COOKIE['theme_body_class'];
}
elseif (isset($_GET['switch_layout']) && !empty($_GET['switch_layout']))
{
	$body_class = $_GET['switch_layout'];
}
else
{
	$body_class = ot_get_option('body_class');
}
$main_menu_style = ts_get_main_menu_style();
$background_patterns = ts_get_background_patterns(true);

?>
<div id="control-panel">
	<div class="panel-container">
		<div class="panel-header">
			<?php _e('Style Switcher','framework'); ?>
		</div>
		<div class="panel-content">
			<h3><?php _e('Choose layout','framework'); ?></h3>
			<select>
				<option <?php echo $body_class == 'w1170' ? 'selected="selected"' : ''; ?> value="<?php echo add_query_arg( array('switch_layout' => 'w1170') ); ?>">Full Width 1170px</option>
				<option <?php echo $body_class == 'b1170' ? 'selected="selected"' : ''; ?> value="<?php echo add_query_arg( array('switch_layout' => 'b1170') ); ?>">Boxed Width 1170px</option>
				<option <?php echo $body_class == 'w960' ? 'selected="selected"' : ''; ?> value="<?php echo add_query_arg( array('switch_layout' => 'w960') ); ?>">Full Width 960px</option>
				<option <?php echo $body_class == 'b960' ? 'selected="selected"' : ''; ?> value="<?php echo add_query_arg( array('switch_layout' => 'b960') ); ?>">Boxed Width 960px</option>
			</select>
			<hr>

			<?php $colors = ts_get_control_panel_colors(); ?>
			<?php if (is_array($colors) && count($colors) > 0): ?>
				<div id="panel-main-color-container">
					<h3><?php _e('Choose main color','framework'); ?></h3>
					<ul id="panel-main-color">
						<?php foreach ($colors as $color): ?>
							<li><div style="background-color: <?php echo $color; ?>"></div></li>
						<?php endforeach; ?>
					</ul>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
			<hr>
			<?php if (is_array($background_patterns) && count($background_patterns) > 0): ?>
				<div id="background-pattern-container">
					<h3><?php _e('Background patterns','framework'); ?></h3>
					<?php if (!in_array($body_class,array('b1170','b960'))): ?>
						<?php _e('Boxed layout only','framework'); ?>
					<?php else: ?>
						<ul id="background-pattern">
							<?php foreach ($background_patterns as $pattern): ?>
								<li><div style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/body-bg/<?php echo $pattern['value']; ?>);" data-bg="<?php echo $pattern['value']; ?>"></div></li>
							<?php endforeach; ?>
						</ul>
						<div class="clear"></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<hr>

			<?php $background_images = ts_get_control_panel_backgrounds(); ?>
			<?php if (is_array($background_images) && count($background_images) > 0): ?>
				<div id="background-image-container">
					<h3><?php _e('Background images','framework'); ?></h3>
					<?php if (!in_array($body_class,array('b1170','b960'))): ?>
						<?php _e('Boxed layout only','framework'); ?>
					<?php else: ?>
						<ul id="background-image">
							<?php foreach ($background_images as $background): ?>
								<li><div style="background-image: url(<?php echo ts_get_resized_image(get_template_directory_uri().'/images/body-img/'.$background,25, 25, '', '', true, true); ?>);" data-img="<?php echo $background; ?>"></div></li>
							<?php endforeach; ?>
						</ul>
						<div class="clear"></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<hr>

			<div id="reset-to-defaults">
				<a href="<?php echo add_query_arg( 'control_panel=defaults', '', home_url( $wp->request )); ?>"><?php _e('Reset to defaults','framework');?></a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="panel-switcher"></div>
</div>
<script>
	jQuery(document).ready(function($) {

		var changeLeft = 230;

		$('#control-panel .panel-switcher').click(function() {
			$('#control-panel').animate({
				left: '+=' + changeLeft
				}, 500, function() {
					changeLeft = changeLeft * -1;
				}
			);
		});


		$('#panel-main-color li div').click(function() {

			var current_color_container = this;
			$(current_color_container).html('<i class="icon-spinner icon-spin"></i>');

			jQuery.ajax({
				type: 'GET',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					action: 'the_theme_dynamic_styles',
					main_color: rgb2hex($(this).css('background-color'))
				},
				success: function(data, textStatus, XMLHttpRequest){
					$(current_color_container).html('');
					jQuery("#dynamic-styles").html('');
					jQuery("#dynamic-styles").html(data);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					//alert(errorThrown);
				}
			});
		});

		$('#background-pattern li div').click(function() {

			background_image = '<?php echo get_template_directory_uri(); ?>/images/body-bg/' + $(this).attr('data-bg');
			$('body').css({background : 'url('+background_image+')'});
			cookie_val = 'body-bg/' + $(this).attr('data-bg');


			var cookieStr = escape('theme_background') +"=";
			if (typeof cookie_val != "undefined") {
				cookieStr += escape(cookie_val);
			}

			document.cookie = cookieStr;
		});

		$('#background-image li div').click(function() {

			background_image = '<?php echo get_template_directory_uri(); ?>/images/body-img/' + $(this).attr('data-img');
			$('body').css({
				background : 'url('+background_image+') no-repeat fixed center'
			});
			cookie_val = 'body-img/' + $(this).attr('data-img');

			var cookieStr = escape('theme_background') +"=";
			if (typeof cookie_val != "undefined") {
				cookieStr += escape(cookie_val);
			}

			document.cookie = cookieStr;
		});

		//set default background when boxed is choosed
		$('#choice-b1170,#choice-b960').click(function() {

			cookie_val = 'body-bg/dark_wood.png';
			document.cookie = escape('theme_background') + "=" + escape(cookie_val);
		});

		//clear background when boxed is choosed
		$('#choice-w1170,#choice-w960').click(function() {

			cookie_val = '';
			document.cookie = escape('theme_background') + "=" + escape(cookie_val);
		});

	});

	var hexDigits = new Array
        ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");

	//Function to convert hex format to a rgb color
	function rgb2hex(rgb) {
		rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
	}

	function hex(x) {
		return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
	}

 </script>