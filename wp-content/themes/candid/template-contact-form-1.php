<?php
/*
* Template Name: Contact Form Template 1
*/
//checking if email is valid
$email = ot_get_option('contact_form_email');
if ( !is_email( $email ) )
{
	$error = true;
}

$form_name = '';
$form_email = '';
$form_message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_submit']) && $_POST['form_submit'] == 1)
{

	$error = false;
	if (empty($_POST['form_name']) || empty($_POST['form_email']) || empty($_POST['form_message']))
	{
		$message .= '<p>' . __('Please fill all required fields.','circles') . '</p>';
		$error = true;
	}

	if ( $error == false && !is_email( $_POST['form_email'] ) )
	{
		$message .= '<p>' . __('Please check your email.','circles') . '</p>';
		$error = true;
	}

	if ( $error === false )
	{
		$site_name = is_multisite() ? $current_site->site_name : get_bloginfo('name');
		if (wp_mail($email, $site_name, esc_html($_POST['form_message']),'From: "'. esc_html($_POST['form_name']) .'" <' . esc_html($_POST['form_email']) . '>'))
		{
			$message = '<p>' . __('Email sent. Thank you for contacting us','circles') . '</p>';
		}
		else
		{
			$message = '<p>' .__('Server error. Pease try again later.','circles') . '</p>';
			$error = true;
		}

	}

	$form_name = $_POST['form_name'];
	$form_email = $_POST['form_email'];
	$form_message = $_POST['form_message'];
}
get_header(); ?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class='wrapper top-slider' id="map-box"><?php echo do_shortcode(get_post_meta(get_the_ID(), 'map',true)); ?></div>
	<div class='wrapper'>
		<div class='container contacts'>
			<section class='grid_3'>
				<div>
					<?php the_content(); ?>
				</div>
			</section>
			<section class='grid_9 contact-form'>
				<h2><?php _e('Contact form','circles');?></h2>
				<?php if ($error || $message): ?>
					<div class="<?php echo ($error === true ? 'error': 'message')?>"><?php echo $message; ?> </div>
				<?php endif; ?>
				<form class='clearfix' method="post" action="">
					<div class="input-field">
						<div>
							<?php _e('Name','circles'); echo ' <span>('; _e('required','circles'); echo ')</span>'; ?>
						</div>
						<div class='input-style dlight-grey sc-input'>
							<input type="text" name="form_name" size="20" value="<?php echo $form_name; ?>" />
						</div>
					</div>
					<div class="input-field">
						<div>
							<?php _e('Email','circles'); echo ' <span>('; _e('required','circles'); echo ')</span>'; ?>
						</div>
						<div class='input-style dlight-grey sc-input'>
							<input type="email" name="form_email" size="20" value="<?php echo $form_email; ?>" />
						</div>
					</div>
					<div class="input-field text-area">
						<div>
							<?php _e('Your message','circles'); echo ' <span>('; _e('required','circles'); echo ')</span>'; ?>
						</div>
						<div class='input-style dlight-grey sc-input'>
							<textarea class='contact-form_form' cols="1" rows="1" name="form_message"><?php echo $form_message; ?></textarea>
							<input type="hidden" name="form_submit" value="1" />
						</div>
					</div>
					<input class='sc-button grey-grad' type="submit" value="<?php _e('Send','circles');?>" name="submit">
					<input class='sc-button grey-grad' type="reset" value="<?php _e('Clear','circles');?>" name="reset">
				</form>
			</section>
		</div>
	</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>