<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/* 
 * Eight Degree Fly Menu - Custom Post Type 
 */

$singular = __( '8Degree Fly Menu Lite', 'eight-degree-fly-menu-lite' );
$plural = __( '8Degree Fly Menus Lite', 'eight-degree-fly-menu-lite' );
//Used for the rewrite slug below.
$plural_slug = str_replace( ' ', '_', $plural );

//Setup all the labels to accurately reflect this post type.
$labels = array(
	'name' => $plural,
	'singular_name' => $singular,
	'add_new' => __( 'Add New ', 'eight-degree-fly-menu-lite' ),
	'add_new_item' => __( 'Add New ', 'eight-degree-fly-menu-lite' ) . $singular,
	'edit' => __( 'Edit ', 'eight-degree-fly-menu-lite' ),
	'edit_item' => __( 'Edit ', 'eight-degree-fly-menu-lite' ) . $singular,
	'new_item' => __( 'New ', 'eight-degree-fly-menu-lite' ) . $singular,
	'view' => __( 'View ', 'eight-degree-fly-menu-lite' ) . $singular,
	'view_item' => __( 'View ', 'eight-degree-fly-menu-lite' ) . $singular,
	'search_term' => __( 'Search ', 'eight-degree-fly-menu-lite' ) . $plural,
	'parent' => __( 'Parent ', 'eight-degree-fly-menu-lite' ) . $singular,
	'not_found' => __( 'No ', 'eight-degree-fly-menu-lite' ) . $plural . __( ' found', 'eight-degree-fly-menu-lite' ),
	'not_found_in_trash' => __( 'No ', 'eight-degree-fly-menu-lite' ) . $plural . __( ' in Trash', 'eight-degree-fly-menu-lite' )
);

//Define all the arguments for this post type.
$args = array(
	'labels' => $labels,
	'public' => false,	
	'publicly_queryable' => false,
	'exclude_from_search' => true,
	'show_in_nav_menus' => false,
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'menu_position' => 70,
	'menu_icon' => 'dashicons-editor-alignleft',
	'can_export' => true,
	'delete_with_user' => false,
	'hierarchical' => false,
	'has_archive' => false,
	'query_var' => false,
	'capability_type' => 'page',
	'map_meta_cap' => true,
	// 'capabilities' => array(),
	'rewrite' => array(
		'slug' => strtolower( $plural_slug ),
		'with_front' => true,
		'pages' => true,
		'feeds' => false,
	),
	'supports' => array(
		'title'
	)
);
register_post_type( 'edfm_menu', $args );

