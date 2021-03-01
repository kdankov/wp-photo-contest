<?php

/**
 * Remove jQuery from the Front End
 */
function faster_remove_jquery() {

	wp_deregister_script( 'jquery' );

}
add_action( 'wp_enqueue_scripts', 'faster_remove_jquery' );

/**
 * Remove gutenberg styles
 */
function faster_remove_gutenberg_css(){

	wp_dequeue_style( 'wp-block-library' );

}
add_action( 'wp_enqueue_scripts', 'faster_remove_gutenberg_css', 100 );

/**
 * Remove wp-embed
 */
function faster_remove_wpembed(){

	wp_deregister_script( 'wp-embed' );

}
add_action( 'wp_enqueue_scripts', 'faster_remove_wpembed' );

/**
 * Disable the emoji's
 */
function faster_disable_emojis() {

	remove_action( 'wp_head',                               'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts',   'print_emoji_detection_script' );
	remove_action( 'wp_print_styles',               'print_emoji_styles' );
	remove_action( 'admin_print_styles',    'print_emoji_styles' );
	remove_filter( 'the_content_feed',              'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss',              'wp_staticize_emoji' );
	remove_filter( 'wp_mail',                               'wp_staticize_emoji_for_email' );

	add_filter( 'tiny_mce_plugins',         'faster_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints',        'faster_disable_emojis_remove_dns_prefetch', 10, 2 );

}
add_action( 'init', 'faster_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function faster_disable_emojis_tinymce( $plugins ) {

	if ( is_array( $plugins ) ) {

		return array_diff( $plugins, array( 'wpemoji' ) );

	} else {

		return array();

	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function faster_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {

	if ( 'dns-prefetch' == $relation_type ) {

		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );

	}

	return $urls;
}

/**
 * Remove query strings from static resources
 */
function faster_remove_query_strings() {

	if ( ! is_admin() ) {

		add_filter('script_loader_src', 'faster_remove_query_strings_split', 15);
		add_filter('style_loader_src', 'faster_remove_query_strings_split', 15);

	}
}

function faster_remove_query_strings_split($src){

	$output = preg_split("/(&ver|\?ver)/", $src);

	return $output[0];

}

add_filter( 'emoji_svg_url', '__return_false' );

add_action('init', 'faster_remove_query_strings');

remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_resource_hints');
remove_action( 'wp_head', 'print_emoji_detection_script');
remove_action( 'wp_head', 'rel_canonical');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'wp_oembed_add_host_js');

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version


/**
 * Force GFORM Scripts inline next to Form Output
 *
 * force the script tags inline next to the form. This allows
 * us to regex them out each time the form is rendered.
 * 
 * see strip_inline_gform_scripts() function below
 * which implements the required regex
 */
function force_gform_inline_scripts() {
	return false;
}
add_filter("gform_init_scripts_footer", "force_gform_inline_scripts");

/**
 * Strip out GForm Script tags
 *
 * note: this diables post and pre render hooks which are triggered
 * when the form renders so if you need these then it's important
 * to manually re-add them in your compiled JS source code
 */
function strip_inline_gform_scripts( $form_string, $form ) {
	return $form_string = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $form_string);
}
add_filter("gform_get_form_filter", "strip_inline_gform_scripts", 10, 2);


/**
 * Turn Off Admin Bar for everyone but Admins
 */
function remove_admin_bar() {
	if ( ! current_user_can('administrator') && !is_admin() ) {
		show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');
