<?php
/**
 * Photos functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Photos
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'photos_setup' ) ) :
	function photos_setup() {

		load_theme_textdomain( 'photos', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ));

		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'photos' ),
			)
		);

		add_image_size( 'huge', 4000, 4000 );

	}
endif;
add_action( 'after_setup_theme', 'photos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photos_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photos_content_width', 640 );
}
add_action( 'after_setup_theme', 'photos_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function photos_scripts() {

	wp_enqueue_style( 'photos-style',  get_template_directory_uri() . '/assets/dist/css/site.css', array(), _S_VERSION );

}
add_action( 'wp_enqueue_scripts', 'photos_scripts' );

/**
 * Taxonomies and CPTs
 */
require get_template_directory() . '/taxonomies/img-tag.php';
require get_template_directory() . '/taxonomies/img-cat.php';

require get_template_directory() . '/post-types/contest.php';
require get_template_directory() . '/post-types/image.php';

/**
 * Strip down the front end from anything not needed
 */
require get_template_directory() . '/inc/cleanup.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/webp-plugin-config.php';

/**
 * Handling Gravity Forms custom logic in forms
 */
require get_template_directory() . '/inc/gravity-forms-handling.php';

