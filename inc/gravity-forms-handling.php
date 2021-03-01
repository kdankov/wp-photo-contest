<?php

/*
 * Form - Vote
 */
add_action( 'gform_after_submission_2', 'gform_after_submission_2', 10, 2 );
function gform_after_submission_2( $entry, $form ) {
 

	GFCommon::log_debug( '<!-- Form VOTE Debug -->' . "\n\n" );

	GFCommon::log_debug( '$entry => ' . print_r( $entry, 1 ) . "\n\n" );

	$votes = get_field( 'votes', $entry[2] );

	if ( ! is_array( $votes ) ):
		$votes = array();
	endif;

	GFCommon::log_debug( '$votes count =>' . count( $votes ) . "\n" );

	$key = array_search( $entry[3], $votes );

	if ( $key === FALSE ) { 

		array_push( $votes, $entry[3] );

		update_field( 'votes', $votes, $entry[2] );
		update_field( 'field_5fcbf76acfc8d', $votes, $entry[2] );

		GFAPI::delete_entry( $entry['id'] );

		GFCommon::log_debug( 'Contest Permalink =>' . get_permalink( $entry[1] ) . "\n" );

		wp_redirect( get_permalink( $entry[1] ) );
	}

    GFCommon::log_debug( '<!-- Form VOTE Debug -->' . "\n" );
 
}

/*
 * Form - Upload a photo
 */
add_filter( 'gform_advancedpostcreation_post_after_creation', 'gform_after_create_post_1', 10, 4 );
function gform_after_create_post_1( $post_id, $feed, $entry, $form ) {
 
	if ( ! empty( $entry[4] ) ) {

		$photo = get_post( $post_id ); // TODO: Remove get_post as it looks like its not needed

		GFCommon::log_debug( '<!-- Form Upload Debug -->' . "\n\n" );

		GFCommon::log_debug( '$photo => ' . print_r( $photo, 1 ) );
		GFCommon::log_debug( '$entry => ' . print_r( $entry, 1 ) );

		update_field('contests', $entry[4], $photo->ID );
		update_field('field_5fcbf7844ba1b', $entry[4], $photo->ID );

		$contest_photos = get_field( 'images', $entry[4] );

		GFCommon::log_debug( '$contest_photos => ' . print_r( $contest_photos, 1 ) );

		if ( ! is_array( $contest_photos ) ):
			$contest_photos = array();
		endif;

		array_push( $contest_photos, $photo->ID );

		GFCommon::log_debug( '$contest_photos => ' . print_r( $contest_photos, 1 ) );

		update_field( 'images', $contest_photos, $entry[4] );
		update_field( 'field_5fccd9c81dcc9', $contest_photos, $entry[4] );

		GFAPI::delete_entry( $entry['id'] );

		wp_redirect( get_permalink( $entry[4] ) );

	} else {

		GFCommon::log_debug( 'Image Upload Form - Debug - ERROR - Missing Contest ID!' . "\n" );

	}
}
