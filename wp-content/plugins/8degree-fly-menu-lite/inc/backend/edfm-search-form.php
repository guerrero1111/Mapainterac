<?php
/* 
 * Eight Degree Fly Menu - Frontend Search Box overwrite
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$screen_reader_text = 'screen-reader-text';

if($edfm_nav_icon_menu_template == 'edfm_nav_icon_menu_template_2'){
  $screen_reader_text = 'screen-reader-txt';
}


$form = '';
do_action( 'pre_get_search_form' );
$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';
$format = apply_filters( 'search_form_format', $format );
if ( 'html5' == $format ) {
  if($edfm_nav_icon_menu_template == 'edfm_nav_icon_menu_template_2'){
    $form .= '<div class="edfm-search-wrapper">';
  }
  $form .= '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <label>
          <input type="search" class="search-field" placeholder="' . $edfm_placeholder . '" value="' . get_search_query() . '" name="s" />
        </label>
        <button type="submit" class="search-submit"><span class="'.$screen_reader_text.'">'. esc_attr_x( 'Search', 'submit button' ) .'</span></button>
      </form>';
      if($edfm_nav_icon_menu_template == 'edfm_nav_icon_menu_template_2'){
        $form .= '</div>';
      }  
    } else {
      if($edfm_nav_icon_menu_template == 'edfm_nav_icon_menu_template_2'){
        $form .= '<div class="edfm-search-wrapper">';
      }
  $form .= '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <div>
          <label>
            <input type="search" value="' . get_search_query() . '" name="s" id="s" class="search-field"/>
          </label>
          <button type="submit" id="searchsubmit"><span class="'.$screen_reader_text.'">'. esc_attr_x( 'Search', 'submit button' ) .'</span></button>
        </div>
      </form>';
      if($edfm_nav_icon_menu_template == 'edfm_nav_icon_menu_template_2'){
        $form .= '</div>';
      }    
    }
    $result = apply_filters( 'get_search_form', $form );

    if ( null === $result )
      $result = $form;

    if ( $echo )
      echo $result;
    else
      return $result;