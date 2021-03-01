<?php
/**
 * @package Photos
 */

get_header();

$contests = get_field('contests');
$votes    = get_field('votes');
$cuser_id = get_current_user_id();

if ( ! is_array( $votes ) ) $votes = array();
if ( ! is_array( $contests ) ) $contests = array();

?>

	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<p>Uploaded by: <?php the_author(); ?></p>

					<h3>Contest</h3>
					<ul class="entry-contests">
						<?php foreach ( $contests as $entry ) : ?>
							<li>
								<a href="<?php echo get_the_permalink( $entry->ID ); ?>">
									<?php echo $entry->post_title; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</header>

				<section class="entry-image">
					<?php the_post_thumbnail('large'); ?>
				</section>


			</article>

<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
?>
		<?php endwhile; ?>

	</main>

<?php
get_footer();
