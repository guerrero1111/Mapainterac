<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
 * Eight Degree extended Walker Class
 */

if ( !class_exists( 'Walker_EDFM_Class' ) ) {


	class Walker_EDFM_Class extends Walker_Nav_Menu {
		/* 
		 * Eight Degree Fly Menu - Modify <ul> in wp_menu
		 */
		function start_lvl( &$output, $depth = 0, $arg = array() ) {

			$post_id[] = $arg->container_id;
			$postid[] = explode('-', $post_id[0]);
			$postID = trim($postid[0][1]);

			/* 
			 * Eight Degree Fly Menu - Get Menu settings
			 */

			$edfm_fly_menu_settings = get_post_meta($postID,'_edfm_select_menu'); 

			$edfm_menu_layout = isset($edfm_fly_menu_settings[0]['edfm_menu_layout'])?$edfm_fly_menu_settings[0]['edfm_menu_layout']:'edfm_side_menu';
			switch($edfm_menu_layout){
				case 'edfm_side_menu':
				$edfm_nav_icon_menu_sub_menu_animation = $edfm_fly_menu_settings[0]['edfm_side_menu_sub_menu_animation'];
				break;
				case 'edfm_skewed_menu':
				$edfm_nav_icon_menu_sub_menu_animation = $edfm_fly_menu_settings[0]['edfm_skew_menu_sub_menu_animation'];
				break;
			}

			$indent = str_repeat( "\t", $depth );
			$submenu = ($depth >= 0) ? 'sub-menu' : '';
			$output .= "\n$indent<div class=\"edfm-submenu $edfm_nav_icon_menu_sub_menu_animation \"><div class=\"edfm-v-center\"><ul class=\"edfm-dropdown-menu-$submenu edfm_depth_$depth\">\n";
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$post_id[] = $args->container_id;
			$postid[] = explode('-', $post_id[0]);
			$postID = isset($postid[0][1])?trim($postid[0][1]):'';
			$edfm_fly_menu_settings = get_post_meta($postID,'_edfm_select_menu'); 
			$edfm_menu_layout = isset($edfm_fly_menu_settings[0]['edfm_menu_layout'])?$edfm_fly_menu_settings[0]['edfm_menu_layout']:'edfm_side_menu';
			switch($edfm_menu_layout){
				case 'edfm_side_menu':
				$edfm_nav_icon_menu_item_animation = $edfm_fly_menu_settings[0]['edfm_side_menu_item_animation'];
				break;
				case 'edfm_skewed_menu':
				$edfm_nav_icon_menu_item_animation = $edfm_fly_menu_settings[0]['edfm_skew_menu_item_animation'];
				break;
			}

			if($item->post_type == 'nav_menu_item'){
				$edfm_menu_item_settings = get_post_meta( $item->ID, '_edfmItemSettings' );
				
				$hide_nav_label = isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_show_nativation_label'] ) ? $edfm_menu_item_settings[0]['edfm_edit_menu_item_show_nativation_label'] : 0;
				$short_description = isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_short_description'] ) ? $edfm_menu_item_settings[0]['edfm_edit_menu_item_short_description'] : '';
								
				$indent = ($depth) ? str_repeat( "\t", $depth ) : '';
				$li_attributes = '';
				$class_names = $value = '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = $edfm_nav_icon_menu_item_animation;
				$classes[] = ($args->walker->has_children) ? 'edfm-dropdown' : '';
				$classes[] = ($item->current || $item->current_item_anchestor) ? 'edfm-active' : '';
				$classes[] = 'edfm-menu-item-' . $item->ID;
				if ( $depth && $args->walker->has_children ) {
					$classes[] = 'edfm-dropdown-submenu';
				}
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';
				$id = apply_filters( 'nav_menu_item_id', 'edfm-menu-item-' . $item->ID, $item, $args );
				$id = strlen( $id ) ? 'id="' . esc_attr( $id ) . '"' : '';
				$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

				$menu_default_icon = isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_default_icon'] ) ? $edfm_menu_item_settings[0]['edfm_edit_menu_item_default_icon'] : '';
				$menu_custom_icon = isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon'] ) ? $edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon'] : '';
				$menu_icon_type = isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] ) ? $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] : 'edfm_no_icon';
				$edfm_list_icon = " ";
				if((!empty($menu_default_icon)||!empty($menu_custom_icon)) && $menu_icon_type != 'edfm_no_icon') $edfm_list_icon ="edfm-list-icon";
				!empty($notification_label)? $edfm_notification = 'edfm-notification-enabled': $edfm_notification = '';
				$attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
				$attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
				$attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
				$attributes .= !empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
				$attributes .= ( $args->walker->has_children ) ? ' class="edfm-dropdown-toggle edfm-menu-link '.$edfm_list_icon.'" data-toggle="edfm-dropdown"' : 'class="'.$edfm_list_icon.' edfm-menu-link"';
				$item_output = $args->before;
				$item_output .= '<div class="edfm-list-wrap"><a' . $attributes . '>';

				switch($menu_icon_type){
					case 'edfm_default_icon':
					$v = explode( '|', $menu_default_icon);		
					if(isset($v[1]) && !empty($v)){
						$item_output .= '<i class="edfm-icon '.$v[0] . ' ' . $v[1].'"></i>';	
					}
					break;
					case 'edfm_custom_icon':
					$item_output .= '<img src="'.$menu_custom_icon.'"/>';
					break;
				}
				$item_output .= '<div class="edfm-title-wrap">';
				if(!$hide_nav_label){
					$item_output .= '<span class="edfm-title" data-hover="'.$item->title.'">';
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= '</span>';	
				}
				
				$item_output .= '</div>';
				
				$item_output .= !empty($short_description)?'<span class="edfm-title-description">'.$short_description.'</span>':'';
				$item_output .= '</a>';


				$edfm_default_nav_icon_options = isset($edfm_fly_menu_settings[0]['edfm_default_nav_icon_options'])?$edfm_fly_menu_settings[0]['edfm_default_nav_icon_options']:'fa-angle-double-right';
					$item_output .= ($args->walker->has_children ) ? '<i class="edfm-toggle-icon fa '.$edfm_default_nav_icon_options.'"></i></div>':'</div>';

				$item_output .= $args->after;
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

/* 
 * Eight Degree Fly Menu - Print Function
 */
function print_array( $array ) {
	echo "<pre>";
	print_r( $array );
	echo "</pre>";
}

}

	// End of Class
}// End of If



