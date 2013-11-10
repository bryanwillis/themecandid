<?php
/**
 * Header style 3
 *
 * @package circles
 * @since circles 1.0
 */
?>
<header class='page-header'>
	<div class='wrapper wrapper-bg border-bottom-white'>
		<div class='container'>
			<div class='grid_12'>
				<div class='logo'>
					<?php if (ot_get_option('logo_url')): ?>
						<?php $logo = ts_get_image(ot_get_option('logo_url'), '' , esc_attr( get_bloginfo( 'name', 'display' ) )); ?>
					<?php else: ?>
						<?php $logo = '<img src="'.get_bloginfo('template_directory').'/images/logo.png" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'; ?>
					<?php endif;?>
					<a href='<?php echo home_url( '/' ); ?>' title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo $logo; ?></a>
				</div>
				<?php $active_social_items = ot_get_option('active_social_items');
				if (!is_array($active_social_items))
				{
					$active_social_items = array();
				}
				?>
				<ul class='socials'>
					<?php if (in_array('facebook',$active_social_items)): ?>
						<li>
							<a class='facebook' href='<?php echo ot_get_option('facebook_url'); ?>' title="Facebook" target="_blank"></a><div class="cloud">Facebook<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('twitter',$active_social_items)): ?>
						<li>
							<a class='twitter' href='<?php echo ot_get_option('twitter_url'); ?>' title="Twitter" target="_blank"></a><div class="cloud">Twitter<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('skype',$active_social_items)): ?>
						<li>
							<a class='skype' href='skype:<?php echo ot_get_option('skype_url'); ?>?call'></a><div class="cloud">Skype<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('dribble',$active_social_items)): ?>
						<li>
							<a class='dribbble' href='<?php echo ot_get_option('dribble_url'); ?>' title="Dribble" target="_blank"></a><div class="cloud">Dribble<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('youtube',$active_social_items)): ?>
						<li>
							<a class='youtube' href='<?php echo ot_get_option('youtube_url'); ?>' title="Youtube" target="_blank"></a><div class="cloud">Youtube<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('pinterest',$active_social_items)): ?>
						<li>
							<a class='pinterest' href='<?php echo ot_get_option('pinterest_url'); ?>' title="Pinterest" target="_blank"></a><div class="cloud">Pinterest<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('tumblr',$active_social_items)): ?>
						<li>
							<a class='tumblr' href='<?php echo ot_get_option('tumblr_url'); ?>' title="Tumblr" target="_blank"></a><div class="cloud">Tumblr<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('google_plus',$active_social_items)): ?>
						<li>
							<a class='google-plus' href='<?php echo ot_get_option('google_plus_url'); ?>' title="Google+" target="_blank"></a><div class="cloud">Google+<div class="helper"></div></div>
						</li>
					<?php endif;?>
					<?php if (in_array('linkedin',$active_social_items)): ?>
						<li>
							<a class='linkedin' href='<?php echo ot_get_option('linkedin_url'); ?>' title="LinkedIn" target="_blank"></a><div class="cloud">LinkedIn<div class="helper"></div></div>
						</li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>
	<div class='absolute'>
	<div class='wrapper menu-bg custom-menu-bg border-bottom-black-tr'>
		<div class='container'>

			<div class='grid_12'>
				<?php if (ot_get_option('sticky_logo_url')): ?>
					<?php echo ts_get_image(ot_get_option('sticky_logo_url'), 'mini_logo tran03slinear' , esc_attr( get_bloginfo( 'name', 'display' ) )); ?>
				<?php else: ?>
					<?php echo '<img class="mini_logo tran03slinear" src="'.get_bloginfo('template_directory').'/images/logo.png" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'; ?>
				<?php endif;?>
			<a id="menu-btn" href="#"></a>
				<?php if (ot_get_option('header_phone')): ?>
					<a class="phone contact" href="#"><?php echo ot_get_option('header_phone'); ?></a>
				<?php endif; ?>
				<?php if (ot_get_option('header_email')): ?>
					<a class="email contact" href="mailto:<?php echo ot_get_option('header_email'); ?>"><?php echo ot_get_option('header_email'); ?></a>
				<?php endif; ?>
			
				<?php echo ot_get_option('preheader_text'); ?>
				<?php
				$defaults = array(
					'container'       => 'nav',
					'theme_location' 	=> 'primary',
					'depth' 			=> 3,
					'walker'			=> new ts_walker_nav_menu
				);
				wp_nav_menu( $defaults ); ?>
			</div>
			<ul class='socials mobile-socials'>
				<?php if (in_array('facebook',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='facebook tran02slinear' href='<?php echo ot_get_option('facebook_url'); ?>' title="Facebook" target="_blank"></a>
					</li>
				<?php endif;?>
				<?php if (in_array('twitter',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='twitter tran02slinear' href='<?php echo ot_get_option('twitter_url'); ?>' title="Twitter" target="_blank"></a>
					</li>
				<?php endif;?>
				<?php if (in_array('skype',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='skype tran02slinear' href='skype:<?php echo ot_get_option('skype_url'); ?>?call'></a>
					</li>
				<?php endif;?>
				<?php if (in_array('dribble',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='dribbble tran02slinear' href='<?php echo ot_get_option('dribble_url'); ?>' title="Dribble" target="_blank"></a>
					</li>
				<?php endif;?>
				<?php if (in_array('youtube',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='youtube tran02slinear' href='<?php echo ot_get_option('youtube_url'); ?>' title="Youtube" target="_blank"></a>
					</li>
				<?php endif;?>
				<?php if (in_array('pinterest',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='pinterest tran02slinear' href='<?php echo ot_get_option('pinterest_url'); ?>' title="Pinterest" target="_blank"></a>
					</li>
				<?php endif;?>
				<?php if (in_array('tumblr',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='tumblr tran02slinear' href='<?php echo ot_get_option('tumblr_url'); ?>' title="Tumblr" target="_blank"></a>
					</li>
				<?php endif;?>
				<?php if (in_array('google_plus',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='google-plus tran02slinear' href='<?php echo ot_get_option('google_plus_url'); ?>' title="Google+" target="_blank"></a>
					</li>
				<?php endif;?>
				<?php if (in_array('linkedin',$active_social_items)): ?>
					<li>
						<span class="tran02slinear"></span>
						<a class='linkedin tran02slinear' href='<?php echo ot_get_option('linkedin_url'); ?>' title="LinkedIn" target="_blank"></a>
					</li>
				<?php endif;?>
			</ul>
		</div>
	</div>
	<?php  if (!get_post_meta(get_the_ID(), 'post_slider',true)):
		get_template_part( 'inc/top' );
	endif; ?>
</div>
</header>