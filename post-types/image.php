<?php

/**
 * Registers the `image` post type.
 */
function image_init() {
	register_post_type( 'image', array(
		'labels'                => array(
			'name'                  => __( 'Images', 'photos' ),
			'singular_name'         => __( 'Image', 'photos' ),
			'all_items'             => __( 'All Images', 'photos' ),
			'archives'              => __( 'Image Archives', 'photos' ),
			'attributes'            => __( 'Image Attributes', 'photos' ),
			'insert_into_item'      => __( 'Insert into image', 'photos' ),
			'uploaded_to_this_item' => __( 'Uploaded to this image', 'photos' ),
			'featured_image'        => _x( 'Featured Image', 'image', 'photos' ),
			'set_featured_image'    => _x( 'Set featured image', 'image', 'photos' ),
			'remove_featured_image' => _x( 'Remove featured image', 'image', 'photos' ),
			'use_featured_image'    => _x( 'Use as featured image', 'image', 'photos' ),
			'filter_items_list'     => __( 'Filter images list', 'photos' ),
			'items_list_navigation' => __( 'Images list navigation', 'photos' ),
			'items_list'            => __( 'Images list', 'photos' ),
			'new_item'              => __( 'New Image', 'photos' ),
			'add_new'               => __( 'Add New', 'photos' ),
			'add_new_item'          => __( 'Add New Image', 'photos' ),
			'edit_item'             => __( 'Edit Image', 'photos' ),
			'view_item'             => __( 'View Image', 'photos' ),
			'view_items'            => __( 'View Images', 'photos' ),
			'search_items'          => __( 'Search images', 'photos' ),
			'not_found'             => __( 'No images found', 'photos' ),
			'not_found_in_trash'    => __( 'No images found in trash', 'photos' ),
			'parent_item_colon'     => __( 'Parent Image:', 'photos' ),
			'menu_name'             => __( 'Images', 'photos' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments' ),
		'has_archive'           => 'photos',
		'rewrite'               => array(
			'slug' => 'photo',
		),
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'menu_position'			=> 4,	
		'rest_base'             => 'image',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'image_init' );

/**
 * Sets the post updated messages for the `image` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `image` post type.
 */
function image_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['image'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Image updated. <a target="_blank" href="%s">View image</a>', 'photos' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'photos' ),
		3  => __( 'Custom field deleted.', 'photos' ),
		4  => __( 'Image updated.', 'photos' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Image restored to revision from %s', 'photos' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Image published. <a href="%s">View image</a>', 'photos' ), esc_url( $permalink ) ),
		7  => __( 'Image saved.', 'photos' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Image submitted. <a target="_blank" href="%s">Preview image</a>', 'photos' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Image scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview image</a>', 'photos' ),
		date_i18n( __( 'M j, Y @ G:i', 'photos' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Image draft updated. <a target="_blank" href="%s">Preview image</a>', 'photos' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'image_updated_messages' );
