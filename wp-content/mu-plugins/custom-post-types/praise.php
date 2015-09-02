<?php
// https://codex.wordpress.org/Post_Types
// https://codex.wordpress.org/Function_Reference/register_post_type

add_action( 'init', 'create_post_type_praise' );
function create_post_type_praise() {
  register_post_type( 'praise',
    array(
      'labels' => array(
        'name' => __( 'Praises' ),
        'singular_name' => __( 'Praise' ),
        'add_new' => 'Add New Praise',
        'add_new_item' => 'Add New Praise',
        'edit_item' => 'Edit Praise',
        'new_item' => 'New Praise',
        'view_item' => 'View Praise',
        'search_items' => 'Search Praises',
        'not_found' => 'No praises found',
        'not_found_in_trash' => "No praises found in Trash",
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-heart',
      'supports' => array(
      	'title',
      	'editor',
      ),
      'register_meta_box_cb' => 'add_meta_box_praise_from',
    )
  );
}

function praise_change_title_text( $title ){
	$screen = get_current_screen();
	if ( 'praise' == $screen->post_type ) {
		$title = 'Author of praise';
	}
	return $title;
}

add_filter( 'enter_title_here', 'praise_change_title_text' );