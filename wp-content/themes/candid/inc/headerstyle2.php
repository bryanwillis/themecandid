<?php
/**
 * Header style 2
 */
?>

<?php if ( is_active_sidebar( 'sliding-panel' ) ) { ?>

	<aside id="sidebar-sliding-panel" class="sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">

		<div class="sp-wrap">

			<div class="sp-content">

				<div class="sp-content-wrap">
					<?php dynamic_sidebar( 'sliding-panel' ); ?>
				</div><!-- .sp-content-wrap -->

			</div><!-- .sp-content -->

			<div class="sp-toggle">
				<a href="#"></a>
			</div><!-- .sp-toggle -->

		</div><!-- .sp-wrap -->

	</aside><!-- #sliding-panel -->

<?php } ?>


<header class='page-header'>
	<div class="wrapper preheader">


<div class="toolbar-right">

 <?php if (is_user_logged_in() ): ?>

  <div class="bw-dropdown"> <span class="bw-dropdown-toggle" tabindex="0"></span>
  <div class="bw-dropdown-text"><?php global $userdata; get_currentuserinfo(); echo get_avatar( $userdata->ID, 46 ); ?></div>
  <ul class="bw-dropdown-content">
    <li><a href="<?php echo site_url('wp-admin/index.php') ?>" title="Global Dashboard"><i class="icon-user"></i> My Dashboard</span></a></li>
    <li><a href="<?php echo site_url('wp-admin/profile.php') ?>" title="My Account" ><i class="icon-cog"></i> Account Settings</span></a></li>
    <li><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout"><i class="icon-off"></i></i> Logout</span></a></li>
  </ul>
</div>


 <?php else: ?>

<span class="login-guy">
<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login"><i class="icon-user"></i> My Account</a>
</span>

 <?php endif ?>


<div class="ajaxsfheader"><?php echo ajaxy_search_form(); ?></div>

</div>





	<div class="container">
			</div>
	</div>

	<div class='wrapper menu-bg border-bottom-white'>
		<div class='container'>
			<div class='grid_12'>
				<a id="menu-btn" href="#"></a>

				<?php
				$defaults = array(
					'container'       => 'nav',
					'theme_location' 	=> 'primary',
					'depth' 			=> 3,
					'walker'			=> new ts_walker_nav_menu
				);
				wp_nav_menu( $defaults ); ?>

				</div>
		</div>
	</div>

<div id="thePlaceholder" class="fullsize"></div>

	<div class='absolute'>
		<?php  if (!get_post_meta(get_the_ID(), 'post_slider',true)/* && !get_post_meta(get_the_ID(),'header_background',true)*/):
			get_template_part( 'inc/top' );
		endif; ?>
	</div>
</header>