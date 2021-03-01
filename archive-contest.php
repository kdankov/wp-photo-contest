<?php
/**
 * @package Photos
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<ul class="listing contest">
			<?php while ( have_posts() ) : the_post(); ?>
				<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<a href="<?php the_permalink(); ?>">
						<?php echo wp_get_attachment_image(get_the_ID(), 'medium'); ?>
						<span class="title">
							<span class="type">Photography Contest</span>
							<span class="theme">Theme: <?php the_title(); ?></span>
						</span>
						<span class="dates">
							<span class="start"><strong>From</strong> <?php the_field('start_date'); ?></span>
							<span class="end"><strong>to</strong> <?php the_field('end_date'); ?></span>
						</span>
					</a>
					<?php 
					$images = get_field('gallery', get_the_ID());
					if( $images ): ?>
						<ul class="background">
							<?php foreach( $images as $image ): ?>
								<li>
									<img src="<?php echo $image['sizes']['thumbnail']; ?>" />
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endwhile; ?>
			</ul>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<p>No Contests</p>

		<?php endif; ?>

	</main><!-- #main -->

<?php
get_footer();
