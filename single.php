<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Photos
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<?php the_post_thumbnail(); ?>

				<?php the_content(); ?>

			</article>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();
