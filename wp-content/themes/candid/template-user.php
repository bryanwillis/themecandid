<?php
/*
* Template Name: Blog Template 1
*/

get_header(); ?>


<div class='wrapper'>
	<div class='container main'>

<a href="<?php echo site_url('wp-admin/profile.php') ?>" title="Go to My Account"> <?php global $userdata; get_currentuserinfo(); echo get_avatar( $userdata->ID, 46 ); ?><span class="bwusername"><?php echo $user_identity; ?></span></a>

<?php echo get_avatar(get_the_author_meta('ID'),60,'',get_the_author_meta('display_name')); ?>


	</div>
</div>

<?php get_footer(); ?>