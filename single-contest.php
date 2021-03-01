<?php
/**
 * @package Photos
 */

get_header();

$photos     = get_field('images');
$start_date = get_field('start_date');
$end_date   = get_field('end_date');
$cuser_id   = get_current_user_id();

if ( ! is_array( $photos ) ) $photos = array();
?>

	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php $contest_id = get_the_ID(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h3>Photography Contest</h3>
					<h1>
						Theme: <?php the_title(); ?>
						<?php if ( ! get_field( 'active' ) ) { ?>
							<span>(Closed)</span>
						<?php } ?>
					</h1>
					<a href="/rules" target="_blank">Rules</a>
				</header><!-- .entry-header -->

				<section class="entry-description">
					<?php the_content(); ?>
				</section>

				<?php if ( count( $photos ) > 0 ) : ?>
					<section class="entry-photos">
					<?php foreach( $photos as $photo ) : ?>
						<article class="photo-entry">
							<div class="image"><?php echo get_the_post_thumbnail( $photo->ID, 'thumbnail' ); ?></div>
							<h3 class="title">
								<a href="<?php echo get_the_permalink( $photo->ID ); ?>" target="_blank">
									<?php echo $photo->post_title; ?>
								</a>
							</h3>
							<?php 

							$photo_author_id = get_post_field( 'post_author', $photo->ID );


							$votes = get_field( 'votes', $photo->ID ); 

							if ( ! is_array( $votes ) ) $votes = array();

							if ( count( $votes ) > 0 ) {
								echo '<p class="votes"><span class="label">Votes</span><span class="value">' . count( $votes ) . '</span></p>';
							}

							if ( $cuser_id != $photo_author_id ) {

								$key = array_search( $cuser_id, $votes );

								if ( FALSE === $key ) {
									if ( get_field( 'active') ) {
										echo do_shortcode('[gravityform id="2" title="false" description="false" field_values="contest_id=' . $contest_id . '&photo_id=' . $photo->ID .'&user_id=' . $cuser_id . '"]'); 
									} else {
										//echo '<p class="user-voted">The contest is closed</p>';
									}
								} else {
									echo '<p class="user-voted">This Photo has your vote!</p>';
								}
							} else {
								echo '<p class="user-voted">Nice work, this is your photo.</p>';
							}


							?>
						</article>
					<?php endforeach; ?>
					</section>
				<?php else : ?>
					<p class="entry-first">Be the first one to upload a photo!</p>
				<?php endif; ?>

				<div id="upload-a-photo">
					<?php echo do_shortcode('[gravityform id="1" title="true" description="true" field_values="contest_id=' . get_the_ID() . '"]'); ?>
					<a href="#" class="close" id="upload-a-photo-close">Close</a>
				</div>
				<div class="overlay"></div>
			</article>

		<?php endwhile; ?>

	</main><!-- #main -->


<?php
get_footer();
