<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback which is
 * located in the functions.php file.
 *
 * @package circles
 * @since circles 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<section class='comments'>
			<div class='comments-header'>
				<h1><?php __('Comments','circles');?></h1>
				<span class='number-of-comments'><?php _e('COMMENTS','circles');?> (<span><?php echo number_format_i18n(get_comments_number()); ?></span>)</span>
			</div>
			<div class='separator'>
				<div></div>
			</div>
			
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use theme_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define theme_comment() and that will be used instead.
				 * See theme_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'ts_theme_comment' ) );
			?>

			<?php
				$args = array(
					'prev_text'    => __('Previous','circles'),
					'next_text'    => __('Next','circles'),
				);
				paginate_comments_links($args);
			?>
		</section>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<section class='comments'>
			<div class='comments-header'>
				<h1><?php _e('Comments are closed.','circles');?></h1>
				<span class='number-of-comments'><?php _e('COMMENTS','circles');?> (<span><?php echo number_format_i18n(get_comments_number()); ?></span>)</span>
			</div>
			<div class='separator'>
				<div></div>
			</div>
		</section>
	<?php endif; ?>

	<section class='leave-comment'>
	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'id_form' => 'commentform',
		'id_submit' => 'submit',
		'title_reply' => __( 'Leave a Comment' ,'circles'),
		'title_reply_to' =>  __( 'Leave a Comment to %s'  ,'circles'),
		'cancel_reply_link' => __( 'Cancel Comment'  ,'circles'),
		'label_submit' => __( 'SENT'  ,'circles'),
		'comment_field' => '
			<div class="input-field text-area">
				<div>
					' . __( 'Comment', 'circles') . '
					<span>('.__( 'required', 'circles' ).')</span>
				</div>
				<div class="input-style dlight-grey sc-input">
					<textarea aria-required="true" rows="1" cols="1" name="comment" id="comment" ' . $aria_req . '></textarea>
				</div>
			</div>',
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'circles' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as' => '<div class="separator"><div></div></div><p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  ,'circles'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_before' => '<div class="separator"><div></div></div>',
		'comment_notes_after' => '<div><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'circles'), ' <code>' . allowed_tags() . '</code>' ) . '</p></div>',
		'fields' => apply_filters( 'comment_form_default_fields',
			array(
				'author' => '
					<div class="input-field">
						<div>
							' . __( 'Name', 'circles' ) . ' ' . ( $req ? '<span>('.__( 'required', 'circles' ).')</span>' : '' ) . '
						</div>
						<div class="input-style dlight-grey sc-input">
							<input id="author" type="text" ' . $aria_req . ' size="20" value="' . esc_attr( $commenter['comment_author'] ) . '" name="author">
						</div>
					</div>',
				'email' => '
					<div class="input-field">
						<div>
							' . __( 'Email', 'circles' ) . ' ' . ( $req ? '<span>('.__( 'required', 'circles' ).')</span>' : '' ) . '
						</div>
						<div class="input-style dlight-grey sc-input">
							<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="20"' . $aria_req . ' />
						</div>
					</div>'
			)
		)
	);
	comment_form($args); ?>
	</section>