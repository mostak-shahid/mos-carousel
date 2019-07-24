<?php
//Sliders
add_action( 'init', 'mos_slider_post' );
function mos_slider_post() {
	$labels = array(
		'name'               => _x( 'Sliders', 'post type general name', 'excavator-template' ),
		'singular_name'      => _x( 'Slider', 'post type singular name', 'excavator-template' ),
		'menu_name'          => _x( 'Sliders', 'admin menu', 'excavator-template' ),
		'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'excavator-template' ),
		'add_new'            => _x( 'Add New', 'slider', 'excavator-template' ),
		'add_new_item'       => __( 'Add New Slider', 'excavator-template' ),
		'new_item'           => __( 'New Slider', 'excavator-template' ),
		'edit_item'          => __( 'Edit Slider', 'excavator-template' ),
		'view_item'          => __( 'View Slider', 'excavator-template' ),
		'all_items'          => __( 'All Sliders', 'excavator-template' ),
		'search_items'       => __( 'Search Sliders', 'excavator-template' ),
		'parent_item_colon'  => __( 'Parent Sliders:', 'excavator-template' ),
		'not_found'          => __( 'No Sliders found.', 'excavator-template' ),
		'not_found_in_trash' => __( 'No Sliders found in Trash.', 'excavator-template' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'excavator-template' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'slider' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon' => 'dashicons-desktop',
		'supports'           => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
	);

	register_post_type( 'slider', $args );
}