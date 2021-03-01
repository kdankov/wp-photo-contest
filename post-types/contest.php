<?php

/**
 * Registers the `contest` post type.
 */
function contest_init() {
	register_post_type( 'contest', array(
		'labels'                => array(
			'name'                  => __( 'Contests', 'photos' ),
			'singular_name'         => __( 'Contest', 'photos' ),
			'all_items'             => __( 'All Contests', 'photos' ),
			'archives'              => __( 'Contest Archives', 'photos' ),
			'attributes'            => __( 'Contest Attributes', 'photos' ),
			'insert_into_item'      => __( 'Insert into contest', 'photos' ),
			'uploaded_to_this_item' => __( 'Uploaded to this contest', 'photos' ),
			'featured_image'        => _x( 'Featured Image', 'contest', 'photos' ),
			'set_featured_image'    => _x( 'Set featured image', 'contest', 'photos' ),
			'remove_featured_image' => _x( 'Remove featured image', 'contest', 'photos' ),
			'use_featured_image'    => _x( 'Use as featured image', 'contest', 'photos' ),
			'filter_items_list'     => __( 'Filter contests list', 'photos' ),
			'items_list_navigation' => __( 'Contests list navigation', 'photos' ),
			'items_list'            => __( 'Contests list', 'photos' ),
			'new_item'              => __( 'New Contest', 'photos' ),
			'add_new'               => __( 'Add New', 'photos' ),
			'add_new_item'          => __( 'Add New Contest', 'photos' ),
			'edit_item'             => __( 'Edit Contest', 'photos' ),
			'view_item'             => __( 'View Contest', 'photos' ),
			'view_items'            => __( 'View Contests', 'photos' ),
			'search_items'          => __( 'Search contests', 'photos' ),
			'not_found'             => __( 'No contests found', 'photos' ),
			'not_found_in_trash'    => __( 'No contests found in trash', 'photos' ),
			'parent_item_colon'     => __( 'Parent Contest:', 'photos' ),
			'menu_name'             => __( 'Contests', 'photos' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ),
		'has_archive'           => 'contests',
		'rewrite'               => array(
			'slug' => 'contest',
		),
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'menu_position'			=> 4,	
		'rest_base'             => 'contest',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'contest_init' );

/**
 * Sets the post updated messages for the `contest` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `contest` post type.
 */
function contest_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['contest'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Contest updated. <a target="_blank" href="%s">View contest</a>', 'photos' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'photos' ),
		3  => __( 'Custom field deleted.', 'photos' ),
		4  => __( 'Contest updated.', 'photos' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Contest restored to revision from %s', 'photos' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Contest published. <a href="%s">View contest</a>', 'photos' ), esc_url( $permalink ) ),
		7  => __( 'Contest saved.', 'photos' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Contest submitted. <a target="_blank" href="%s">Preview contest</a>', 'photos' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Contest scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview contest</a>', 'photos' ),
		date_i18n( __( 'M j, Y @ G:i', 'photos' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Contest draft updated. <a target="_blank" href="%s">Preview contest</a>', 'photos' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'contest_updated_messages' );
