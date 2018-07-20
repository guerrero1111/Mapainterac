<?php
/* 
 * Eight Degree Fly Menu - Save all backend meta box values
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if(!isset($_POST['edfm_meta_nonce'])){
  return;
}

if(! wp_verify_nonce( $_POST['edfm_meta_nonce'],'edfm_save_custom_post_type_settings')){
  return;
}

if(! current_user_can( 'edit_post',$post_id)){
  return;
}

$edfm_fly_menu_settings = array();

$edfm_fly_menu_settings['edfm_enable_header'] = isset($_POST['edfm_enable_header'])? 1: 0;						 
$edfm_fly_menu_settings['edfm_top_text_option'] = isset($_POST['edfm_top_text_option'])? sanitize_text_field($_POST['edfm_top_text_option']):'edfm-no-text';						 
$edfm_fly_menu_settings['edfm_custom_top_text'] = isset($_POST['edfm_custom_top_text'])? sanitize_text_field($_POST['edfm_custom_top_text']):'';
$edfm_fly_menu_settings['edfm_custom_top_tagline'] = isset($_POST['edfm_custom_top_tagline'])? sanitize_text_field($_POST['edfm_custom_top_tagline']):'';						 

$edfm_fly_menu_settings['edfm_image_option'] = isset($_POST['edfm_image_option'])? sanitize_text_field($_POST['edfm_image_option']):'edfm-no-image';						 
$edfm_fly_menu_settings['edfm_custom_header_image'] = isset($_POST['edfm_custom_header_image'])? sanitize_text_field($_POST['edfm_custom_header_image']):'';	

$edfm_fly_menu_settings['edfm_bottom_text_option'] = isset($_POST['edfm_bottom_text_option'])? sanitize_text_field($_POST['edfm_bottom_text_option']):'edfm-no-text';	
$edfm_fly_menu_settings['edfm_custom_bottom_text'] = isset($_POST['edfm_custom_bottom_text'])? sanitize_text_field($_POST['edfm_custom_bottom_text']):'';	
$edfm_fly_menu_settings['edfm_custom_bottom_tagline'] = isset($_POST['edfm_custom_bottom_tagline'])? sanitize_text_field($_POST['edfm_custom_bottom_tagline']):'';	

$edfm_fly_menu_settings['edfm_enable_top_search_form'] = isset($_POST['edfm_enable_top_search_form'])? 1:0;	
$edfm_fly_menu_settings['edfm_top_search_text'] = isset($_POST['edfm_top_search_text'])? sanitize_text_field($_POST['edfm_top_search_text']):'';

$edfm_fly_menu_settings['edfm_body_content_selector'] = isset($_POST['edfm_body_content_selector'])? sanitize_text_field($_POST['edfm_body_content_selector']):'edfm-fly-menu';	
$edfm_fly_menu_settings['select_menu'] = isset($_POST['select_menu'])? sanitize_text_field($_POST['select_menu']):'';	
$edfm_fly_menu_settings['edfm_menu_custom_content'] = isset($_POST['edfm_menu_custom_content'])? wp_kses_post($_POST['edfm_menu_custom_content']):'';	

$edfm_fly_menu_settings['edfm_enable_footer'] = isset($_POST['edfm_enable_footer'])? 1:0;	
$edfm_fly_menu_settings['edfm_enable_bottom_search_form'] = isset($_POST['edfm_enable_bottom_search_form'])? 1:0;	
$edfm_fly_menu_settings['edfm_bottom_search_text'] = isset($_POST['edfm_bottom_search_text'])? sanitize_text_field($_POST['edfm_bottom_search_text']):'';

$edfm_fly_menu_settings['edfm_enable_social_icons'] = isset($_POST['edfm_enable_social_icons'])? 1:0;	
$edfm_fly_menu_settings['edfm_menu_custom_footer_content'] = isset($_POST['edfm_menu_custom_footer_content'])? wp_kses_post($_POST['edfm_menu_custom_footer_content']):'';	

$edfm_fly_menu_settings['edfm_front_pages'] = isset($_POST['edfm_front_pages'])? 1:0;	
$edfm_fly_menu_settings['edfm_blog_pages'] = isset($_POST['edfm_blog_pages'])? 1:0;	
$edfm_fly_menu_settings['edfm_archive_pages'] = isset($_POST['edfm_archive_pages'])? 1:0;	
$edfm_fly_menu_settings['edfm_single_pages'] = isset($_POST['edfm_single_pages'])? 1:0;	
$edfm_fly_menu_settings['edfm_404_pages'] = isset($_POST['edfm_404_pages'])? 1:0;	
$edfm_fly_menu_settings['edfm_search_pages'] = isset($_POST['edfm_search_pages'])? 1:0;	

$edfm_fly_menu_settings['edfm_custom_terms'] = isset($_POST['edfm_custom_terms'])? sanitize_text_field($_POST['edfm_custom_terms']):'';

$edfm_fly_menu_settings['edfm_menu_layout'] = isset($_POST['edfm_menu_layout'])? sanitize_text_field($_POST['edfm_menu_layout']):'edfm_side_menu';

$edfm_fly_menu_settings['edfm_side_menu_template'] = isset($_POST['edfm_side_menu_template'])? sanitize_text_field($_POST['edfm_side_menu_template']):'edfm_side_menu_template_1';
$edfm_fly_menu_settings['edfm_side_menu_position'] = isset($_POST['edfm_side_menu_position'])? sanitize_text_field($_POST['edfm_side_menu_position']):'edfm_side_menu_position_left';
$edfm_fly_menu_settings['edfm_side_menu_sub_menu_type'] = isset($_POST['edfm_side_menu_sub_menu_type'])? sanitize_text_field($_POST['edfm_side_menu_sub_menu_type']):'edfm_drop';
$edfm_fly_menu_settings['edfm_side_menu_animation'] = isset($_POST['edfm_side_menu_animation'])? sanitize_text_field($_POST['edfm_side_menu_animation']):'edfm_side_menu_animation_1';
$edfm_fly_menu_settings['edfm_side_menu_sub_menu_animation'] = isset($_POST['edfm_side_menu_sub_menu_animation'])? sanitize_text_field($_POST['edfm_side_menu_sub_menu_animation']):'edfm_side_menu_sub_menu_animation_1';
$edfm_fly_menu_settings['edfm_side_menu_item_animation'] = isset($_POST['edfm_side_menu_item_animation'])? sanitize_text_field($_POST['edfm_side_menu_item_animation']):'edfm_side_menu_item_animation_1';     
$edfm_fly_menu_settings['edfm_side_menu_blur_effect'] = isset($_POST['edfm_side_menu_blur_effect'])? 1:0;	

$edfm_fly_menu_settings['edfm_skew_menu_template'] = isset($_POST['edfm_skew_menu_template'])? sanitize_text_field($_POST['edfm_skew_menu_template']):'edfm_skew_menu_template_1';
$edfm_fly_menu_settings['edfm_skew_menu_position'] = isset($_POST['edfm_skew_menu_position'])? sanitize_text_field($_POST['edfm_skew_menu_position']):'edfm_skew_menu_position_left';
$edfm_fly_menu_settings['edfm_skew_menu_sub_menu_type'] = isset($_POST['edfm_skew_menu_sub_menu_type'])? sanitize_text_field($_POST['edfm_skew_menu_sub_menu_type']):'edfm_skew_menu_push';
$edfm_fly_menu_settings['edfm_skew_menu_animation'] = isset($_POST['edfm_skew_menu_animation'])? sanitize_text_field($_POST['edfm_skew_menu_animation']):'edfm_skew_menu_animation_1';
$edfm_fly_menu_settings['edfm_skew_menu_sub_menu_animation'] = isset($_POST['edfm_skew_menu_sub_menu_animation'])? sanitize_text_field($_POST['edfm_skew_menu_sub_menu_animation']):'edfm_skew_menu_sub_menu_animation_1';
$edfm_fly_menu_settings['edfm_skew_menu_item_animation'] = isset($_POST['edfm_skew_menu_item_animation'])? sanitize_text_field($_POST['edfm_skew_menu_item_animation']):'edfm_skew_menu_item_animation_1';     
$edfm_fly_menu_settings['edfm_skew_menu_blur_effect'] = isset($_POST['edfm_skew_menu_blur_effect'])? 1:0;

$edfm_fly_menu_settings['edfm_template_type'] = isset($_POST['edfm_template_type'])? sanitize_text_field($_POST['edfm_template_type']):'edfm_template_default';

$edfm_fly_menu_settings['edfm_font_family'] = isset($_POST['edfm_font_family'])? sanitize_text_field($_POST['edfm_font_family']):'Roboto';
$edfm_fly_menu_settings['edfm_text_transform'] = isset($_POST['edfm_text_transform'])? sanitize_text_field($_POST['edfm_text_transform']):'normal';
$edfm_fly_menu_settings['edfm_font_weight'] = isset($_POST['edfm_font_weight'])? sanitize_text_field($_POST['edfm_font_weight']):'400';
$edfm_fly_menu_settings['edfm_header_text_align'] = isset($_POST['edfm_header_text_align'])? sanitize_text_field($_POST['edfm_header_text_align']):'';
$edfm_fly_menu_settings['edfm_body_text_align'] = isset($_POST['edfm_body_text_align'])? sanitize_text_field($_POST['edfm_body_text_align']):'';
$edfm_fly_menu_settings['edfm_footer_text_align'] = isset($_POST['edfm_footer_text_align'])? sanitize_text_field($_POST['edfm_footer_text_align']):'';
$edfm_fly_menu_settings['edfm_font_color'] = isset($_POST['edfm_font_color'])? sanitize_text_field($_POST['edfm_font_color']):'#000';
$edfm_fly_menu_settings['edfm_parent_background_type'] = isset($_POST['edfm_parent_background_type'])? sanitize_text_field($_POST['edfm_parent_background_type']):'edfm_parent_color_background';
$edfm_fly_menu_settings['edfm_parent_background_color'] = isset($_POST['edfm_parent_background_color'])? sanitize_text_field($_POST['edfm_parent_background_color']):'#1aa579';
$edfm_fly_menu_settings['edfm_parent_right_background_color'] = isset($_POST['edfm_parent_right_background_color'])? sanitize_text_field($_POST['edfm_parent_right_background_color']):'#d5edf9';
$edfm_fly_menu_settings['edfm_parent_background_image_url'] = isset($_POST['edfm_parent_background_image_url'])? sanitize_text_field($_POST['edfm_parent_background_image_url']):'';

$edfm_fly_menu_settings['edfm_parent_hover_color'] = isset($_POST['edfm_parent_hover_color'])? sanitize_text_field($_POST['edfm_parent_hover_color']):'rgba(0,0,0,0.2)';
$edfm_fly_menu_settings['edfm_parent_hover_bg_color'] = isset($_POST['edfm_parent_hover_bg_color'])? sanitize_text_field($_POST['edfm_parent_hover_bg_color']):'';

$edfm_fly_menu_settings['edfm_child_background_type'] = isset($_POST['edfm_child_background_type'])? sanitize_text_field($_POST['edfm_child_background_type']):'edfm_child_color_background';

$edfm_fly_menu_settings['edfm_child_color_background'] = isset($_POST['edfm_child_color_background'])? sanitize_text_field($_POST['edfm_child_color_background']):'#383838';
$edfm_fly_menu_settings['edfm_child_font_color'] = isset($_POST['edfm_child_font_color'])? sanitize_text_field($_POST['edfm_child_font_color']):'';

$edfm_fly_menu_settings['edfm_child_background_color'] = isset($_POST['edfm_child_background_color'])? sanitize_text_field($_POST['edfm_child_background_color']):'#fff';

$edfm_fly_menu_settings['edfm_toggle_custom_element'] = isset($_POST['edfm_toggle_custom_element'])? 1:0;
$edfm_fly_menu_settings['edfm_toggle_custom_element_id'] = isset($_POST['edfm_toggle_custom_element_id'])? sanitize_text_field($_POST['edfm_toggle_custom_element_id']):'';
$edfm_fly_menu_settings['edfm_button_behavior'] = isset( $_POST['edfm_button_behavior'] ) ? sanitize_text_field( $_POST['edfm_button_behavior'] ) : 'edfm_button_fix';

$edfm_fly_menu_settings['edfm_toggle_type'] = isset($_POST['edfm_toggle_type'])? sanitize_text_field($_POST['edfm_toggle_type']):'edfm_toggle_default';

$edfm_fly_menu_settings['edfm_toggle_icon_type'] = isset($_POST['edfm_toggle_icon_type'])? sanitize_text_field($_POST['edfm_toggle_icon_type']):'edfm_hamburger_toggle_icon';
$edfm_fly_menu_settings['edfm_toggle_default_close'] = isset($_POST['edfm_toggle_default_close'])? sanitize_text_field($_POST['edfm_toggle_default_close']):'fa-close';
$edfm_fly_menu_settings['edfm_toggle_default_open'] = isset($_POST['edfm_toggle_default_open'])? sanitize_text_field($_POST['edfm_toggle_default_open']):'fa-navicon ';
$edfm_fly_menu_settings['edfm_toggle_custom_close'] = isset($_POST['edfm_toggle_custom_close'])? sanitize_text_field($_POST['edfm_toggle_custom_close']):'#';
$edfm_fly_menu_settings['edfm_toggle_custom_open'] = isset($_POST['edfm_toggle_custom_open'])? sanitize_text_field($_POST['edfm_toggle_custom_open']):'#';
$edfm_fly_menu_settings['edfm_toggle_background'] = isset($_POST['edfm_toggle_background'])? sanitize_text_field($_POST['edfm_toggle_background']):'#fff';

$edfm_fly_menu_settings['edfm_toggle_open_color'] = isset($_POST['edfm_toggle_open_color'])? sanitize_text_field($_POST['edfm_toggle_open_color']):'';
$edfm_fly_menu_settings['edfm_toggle_close_color'] = isset($_POST['edfm_toggle_close_color'])? sanitize_text_field($_POST['edfm_toggle_close_color']):'';
$edfm_fly_menu_settings['edfm_toggle_hover_color'] = isset($_POST['edfm_toggle_hover_color'])? sanitize_text_field($_POST['edfm_toggle_hover_color']):'';

$edfm_fly_menu_settings['edfm_toggle_width'] = isset( $_POST['edfm_toggle_width'] ) ? sanitize_text_field( $_POST['edfm_toggle_width'] ) : '';
$edfm_fly_menu_settings['edfm_toggle_border'] = isset( $_POST['edfm_toggle_border'] ) ? sanitize_text_field( $_POST['edfm_toggle_border'] ) : '';

$edfm_fly_menu_settings['edfm_toggle_border_color'] = isset($_POST['edfm_toggle_border_color'])? sanitize_text_field($_POST['edfm_toggle_border_color']):'#fff';
$edfm_fly_menu_settings['edfm_toggle_border_radius'] = isset( $_POST['edfm_toggle_border_radius'] ) ? sanitize_text_field( $_POST['edfm_toggle_border_radius'] ) : '';
$edfm_fly_menu_settings['edfm_toggle_top'] = isset( $_POST['edfm_toggle_top'] ) ? sanitize_text_field( $_POST['edfm_toggle_top'] ) : '2';
$edfm_fly_menu_settings['edfm_toggle_left'] = isset( $_POST['edfm_toggle_left'] ) ? sanitize_text_field( $_POST['edfm_toggle_left'] ) : '2';

$edfm_fly_menu_settings['edfm_default_nav_icon_options'] = isset($_POST['edfm_default_nav_icon_options'])? sanitize_text_field($_POST['edfm_default_nav_icon_options']):'#';

$edfm_fly_menu_settings['edfm_enable_custom_css'] = isset($_POST['edfm_enable_custom_css'])? 1:0;
$edfm_fly_menu_settings['edfm_custom_css'] = isset($_POST['edfm_custom_css'])? wp_kses_post($_POST['edfm_custom_css']):'';		

$edfm_fly_menu_settings['edfm_selected_pages'] = isset($_POST['edfm_specific_pages']['0'])? sanitize_text_field($_POST['edfm_specific_pages']['0']):'';  

update_post_meta($post_id,'_edfm_select_menu',$edfm_fly_menu_settings);

if(isset($_POST['edfm_specific_pages']['0'])){
      $edfm_specific_pages = array();
      $edfm_specific_pages = explode(',', $_POST['edfm_specific_pages']['0']);
      update_post_meta($post_id, '_edfm_specific_pages', $edfm_specific_pages);
    }else{
      $edfm_specific_pages = array();
      update_post_meta($post_id, '_edfm_specific_pages', $edfm_specific_pages);
    }

if(isset($_POST['edfm_social_icons'])){
  $edfm_social_icons = array();
  foreach($_POST['edfm_social_icons'] as $socialname => $innerarray){
    $edfm_social_icons[$socialname]['icon'] = $socialname;
    $edfm_social_icons[$socialname]['label'] = $socialname;
    $edfm_social_icons[$socialname]['url'] = $innerarray['url'];
    $edfm_social_icons[$socialname]['tooltip'] = $innerarray['tooltip'];
}
update_post_meta( $post_id, '_edfm_social_icons', $edfm_social_icons);
}
