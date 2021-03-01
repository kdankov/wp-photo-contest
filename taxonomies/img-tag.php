<?php

/**
 * Registers the `img_tag` taxonomy,
 * for use with 'image'.
 */
function img_tag_init() {
	register_taxonomy( 'img-tag', array( 'image' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Img tags', 'photos' ),
			'singular_name'              => _x( 'Img tag', 'taxonomy general name', 'photos' ),
			'search_items'               => __( 'Search Img tags', 'photos' ),
			'popular_items'              => __( 'Popular Img tags', 'photos' ),
			'all_items'                  => __( 'All Img tags', 'photos' ),
			'parent_item'                => __( 'Parent Img tag', 'photos' ),
			'parent_item_colon'          => __( 'Parent Img tag:', 'photos' ),
			'edit_item'                  => __( 'Edit Img tag', 'photos' ),
			'update_item'                => __( 'Update Img tag', 'photos' ),
			'view_item'                  => __( 'View Img tag', 'photos' ),
			'add_new_item'               => __( 'Add New Img tag', 'photos' ),
			'new_item_name'              => __( 'New Img tag', 'photos' ),
			'separate_items_with_commas' => __( 'Separate img tags with commas', 'photos' ),
			'add_or_remove_items'        => __( 'Add or remove img tags', 'photos' ),
			'choose_from_most_used'      => __( 'Choose from the most used img tags', 'photos' ),
			'not_found'                  => __( 'No img tags found.', 'photos' ),
			'no_terms'                   => __( 'No img tags', 'photos' ),
			'menu_name'                  => __( 'Img tags', 'photos' ),
			'items_list_navigation'      => __( 'Img tags list navigation', 'photos' ),
			'items_list'                 => __( 'Img tags list', 'photos' ),
			'most_used'                  => _x( 'Most Used', 'img-tag', 'photos' ),
			'back_to_items'              => __( '&larr; Back to Img tags', 'photos' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'img-tag',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'img_tag_init' );

/**
 * Sets the post updated messages for the `img_tag` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `img_tag` taxonomy.
 */
function img_tag_updated_messages( $messages ) {

	$messages['img-tag'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Img tag added.', 'photos' ),
		2 => __( 'Img tag deleted.', 'photos' ),
		3 => __( 'Img tag updated.', 'photos' ),
		4 => __( 'Img tag not added.', 'photos' ),
		5 => __( 'Img tag not updated.', 'photos' ),
		6 => __( 'Img tags deleted.', 'photos' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'img_tag_updated_messages' );
