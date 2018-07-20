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
 

?>