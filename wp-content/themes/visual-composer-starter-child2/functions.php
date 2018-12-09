<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
 }

function shortcode_mapa( $atts ){
  include 'maps.php';
}
add_shortcode( 'mapa', 'shortcode_mapa' );	
 
function shortcode_mapacontacto( $atts ){
  include 'mapacontacto.php';
}
add_shortcode( 'mapacontacto', 'shortcode_mapacontacto' );
 
 function smallenvelop_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Header Sidebar', 'smallenvelop' ),
        'id' => 'header-sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'smallenvelop_widgets_init' );

function register_my_menu() {
  register_nav_menu('new-menu',__( 'New Menu' ));
}
add_action( 'init', 'register_my_menu' );