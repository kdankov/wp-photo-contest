<?php

/**
 * Registers the `img_cat` taxonomy,
 * for use with 'image'.
 */
function img_cat_init() {
	register_taxonomy( 'img-cat', array( 'image' ), array(
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
			'name'                       => __( 'Img cats', 'photos' ),
			'singular_name'              => _x( 'Img cat', 'taxonomy general name', 'photos' ),
			'search_items'               => __( 'Search Img cats', 'photos' ),
			'popular_items'              => __( 'Popular Img cats', 'photos' ),
			'all_items'                  => __( 'All Img cats', 'photos' ),
			'parent_item'                => __( 'Parent Img cat', 'photos' ),
			'parent_item_colon'          => __( 'Parent Img cat:', 'photos' ),
			'edit_item'                  => __( 'Edit Img cat', 'photos' ),
			'update_item'                => __( 'Update Img cat', 'photos' ),
			'view_item'                  => __( 'View Img cat', 'photos' ),
			'add_new_item'               => __( 'Add New Img cat', 'photos' ),
			'new_item_name'              => __( 'New Img cat', 'photos' ),
			'separate_items_with_commas' => __( 'Separate img cats with commas', 'photos' ),
			'add_or_remove_items'        => __( 'Add or remove img cats', 'photos' ),
			'choose_from_most_used'      => __( 'Choose from the most used img cats', 'photos' ),
			'not_found'                  => __( 'No img cats found.', 'photos' ),
			'no_terms'                   => __( 'No img cats', 'photos' ),
			'menu_name'                  => __( 'Img cats', 'photos' ),
			'items_list_navigation'      => __( 'Img cats list navigation', 'photos' ),
			'items_list'                 => __( 'Img cats list', 'photos' ),
			'most_used'                  => _x( 'Most Used', 'img-cat', 'photos' ),
			'back_to_items'              => __( '&larr; Back to Img cats', 'photos' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'img-cat',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'img_cat_init' );

/**
 * Sets the post updated messages for the `img_cat` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `img_cat` taxonomy.
 */
function img_cat_updated_messages( $messages ) {

	$messages['img-cat'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Img cat added.', 'photos' ),
		2 => __( 'Img cat deleted.', 'photos' ),
		3 => __( 'Img cat updated.', 'photos' ),
		4 => __( 'Img cat not added.', 'photos' ),
		5 => __( 'Img cat not updated.', 'photos' ),
		6 => __( 'Img cats deleted.', 'photos' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'img_cat_updated_messages' );
