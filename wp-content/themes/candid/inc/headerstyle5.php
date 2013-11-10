<?php
/**
 * Header style 5
 *
 * @package circles
 * @since circles 3.0
 */
?>


<header class="page-header">
    <div class="wrapper main-menu">
		<div class="container">
			<?php if (ot_get_option('logo_url')): ?>
				<?php $logo = ts_get_image(ot_get_option('logo_url'), 'mini_logo tran03slinear' , esc_attr( get_bloginfo( 'name', 'display' ) )); ?>
			<?php else: ?>
				<?php $logo = '<img class="mini_logo tran03slinear" src="'.get_bloginfo('template_directory').'/images/logo.png" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'; ?>
			<?php endif;?>
			<a href='<?php echo home_url( '/' ); ?>' title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo $logo; ?></a>
			<a id="menu-btn" href="#"></a>
			<?php if (ot_get_option('show_search_nav') != 'no'): ?>
				<div id="search-icon">
					<i></i>
					<form role="search" method="get" id="searchform" action="http://circles.arenaofthemes.com" class="">
						<input type="text" value="" name="s" placeholder="Search" id="s">
					</form>
				</div>
			<?php endif;
			$defaults = array(
				'container'       => 'nav',
				'theme_location' 	=> 'primary',
				'depth' 			=> 3,
				'walker'			=> new ts_walker_nav_menu
			);
			wp_nav_menu( $defaults );
			?>
		</div>
	</div>
	<div class="wrapper">
		<div class="container">

			<div class="grid_12">
				<div class="logo">
					<?php if (ot_get_option('logo_url')): ?>
						<?php $logo = ts_get_image(ot_get_option('logo_url'), '' , esc_attr( get_bloginfo( 'name', 'display' ) )); ?>
					<?php else: ?>
						<?php $logo = '<img src="'.get_bloginfo('template_directory').'/images/logo.png" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'; ?>
					<?php endif;?>
					<a href='<?php echo home_url( '/' ); ?>' title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo $logo; ?></a>
				</div>
				<div class="header-text">
					<?php echo ot_get_option('header_text'); ?>
				</div>
				<div class="header-contact">
					<?php if (ot_get_option('header_phone')): ?>
						<a class="phone" href="#"><?php echo ot_get_option('header_phone'); ?></a>
					<?php endif; ?>
					<?php if (ot_get_option('header_email')): ?>
						<a class="email" href="mailto:<?php echo ot_get_option('header_email'); ?>"><?php echo ot_get_option('header_email'); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class='absolute'>
		<?php  if (!get_post_meta(get_the_ID(), 'post_slider',true)/* && !get_post_meta(get_the_ID(),'header_background',true)*/):
			get_template_part( 'inc/top' );
		endif; ?>
	</div>

</header>