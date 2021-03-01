<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photos
 */

?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">

		<?php if ( has_term( array('panorama', 'skyscraper'), 'type', get_the_ID() ) ) { ?>
			<?php echo wp_get_attachment_image(get_the_ID(), 'medium'); ?>
		<?php } else { ?>
			<?php echo wp_get_attachment_image(get_the_ID(), 'thumbnail'); ?>
		<?php } ?>
		<span class="image-title">
			<?php the_title(); ?>
		</span>
	</a>
</li>
