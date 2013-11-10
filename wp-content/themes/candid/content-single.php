<?php
/**
 * The default template for displaying single post content
 *
 * @package circles
 * @since circles 1.0
 */

$classes = array(
	'post',
	(get_post_format() ? 'format-'.get_post_format() : ''),
	'center'
);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	<?php
	$thumb = '';
	switch (get_post_format())
	{
		case 'gallery':
			$gallery = get_post_meta($post->ID, 'gallery_images',true);
			if (is_array($gallery) && count($gallery) > 0)
			{ ?>



			<?php	$thumb = "
				<div class='facilities visible-on-hover'>
					<div class='gallery-image-links'>
						<a class='prev' title='".__('Previous','circles')."' href='#' id='prev-".$post -> ID."'>
							<span></span>
							<span class='tran03slinear'></span>
							<span></span>
						</a>
						<a class='next' title='".__('Next','circles')."' href='#' id='next-".$post -> ID."'>
							<span></span>
							<span class='tran03slinear'></span>
							<span></span>
						</a>
					</div>
				</div>
					<div class='flexslider' id='flexslider-".$post->ID."'>
						<ul class='slides'>";
				foreach ($gallery as $image)
				{
					$thumb .= "<li>".ts_get_resized_image_sidebar($image['image'],array('full', 'one-sidebar', 'two-sidebars'),$image['title'])."</li>";
				}
				$thumb .= "
						</ul>
					  </div>
					<script type='text/javascript'>
						jQuery(document).ready(function() {
						  jQuery('#flexslider-".$post->ID."').flexslider({
							animation: 'slide',
							controlNav: false,
							prevText: \"".ts_get_prev_slider_text()."\",
							nextText: \"".ts_get_next_slider_text()."\"
						  });
						});
						jQuery('#prev-".$post->ID."').click(function(){
							jQuery('#flexslider-".$post->ID."').flexslider('prev');
							return false;
						});

						jQuery('#next-".$post->ID."').click(function(){
							jQuery('#flexslider-".$post->ID."').flexslider('next');
							return false;
						});

					</script>";
			}
			break;
		case 'video':
			$url = get_post_meta($post -> ID, 'video_url',true);
			if (!empty($url))
			{
				$thumb = ts_get_embaded_video($url);
			}
			else if (empty($url))
			{
				$thumb = get_post_meta($post -> ID, 'embedded_video',true);
			}
			$thumb = '<div class="videoWrapper"><img src="'.get_bloginfo("template_directory").'/img/img16_9.png" alt=""/>'.$thumb.'</div>';
			break;
		default:
			$thumb = ts_get_resized_post_thumbnail_sidebar($post -> ID, array('full', 'one-sidebar', 'two-sidebars'),get_the_title());
			break;
	}
	?>
	<header>
		<a href='<?php the_permalink();?>'><h2><?php the_title(); ?></h2></a>
	</header>
	<?php get_template_part( 'inc/post-info' ); ?>
	<div class="post-body clearfix">
		<?php if ( !empty($thumb) ): ?>
			<article class='item-con-t1'>
				<div class='container-t1'>
					<div class='container-t1-margin'>
						<?php echo $thumb; ?>
					</div>
				</div>
				<div class='blue-line'></div>
			</article>
		<?php endif; ?>
		<div class='post-body-text'>
			<?php the_content( ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'circles' ), 'after' => '</div>' ) ); ?>
		</div>
	</div>
</article>

<?php if (get_the_author_meta('description')): ?>
	<section class='about'>
		<h1><?php _e('About the author','circles'); ?></h1>
		<div class='separator'>
			<div></div>
		</div>
		<article class='about-content'>
			<footer>
				<div class='about-helper-absolute'>
					<div class='avatar'>
						<?php echo get_avatar( $post -> post_author, 61);?>
					</div>
				</div>
			</footer>
			<div class='about-body'>
				<p><?php echo get_the_author_meta('description');?></p>
			</div>
		</article>
	</section>
<?php endif; ?>