<?php
/**
 * Template Name: Gallery
 *
 * @package Photos
 */

$gallery_args = array(
	'post_type'      => 'attachment',
	'post_status'    => 'inherit',
	'offset'         => 0,
	'post_mime_type' => 'image',
	'orderby'        => 'date',
	'order'          => 'ASC',
	'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'media-categories',
            'field'    => 'slug',
            'terms'    => 'drone-photography'
        )
    )
);

$gallery = new WP_Query( $gallery_args );

get_header();
?>

	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php while ( $gallery->have_posts() ) : $gallery->the_post(); ?>
				<?php echo wp_get_attachment_image( get_the_ID() ); ?>
			<?php endwhile; ?>

		<?php endwhile; ?>

	</main>

<?php
get_footer();
