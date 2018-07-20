<?php
/* 
 * Eight Degree Fly Menu - Frontend Dynamic CSS
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if($edfm_template_type != 'edfm_template_default'){


	$edfm_parent_background_color = isset($edfm_fly_menu_settings[0]['edfm_parent_background_color'])? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_background_color'] ): '#1aa579'; 

	$edfm_parent_right_background_color = isset( $edfm_fly_menu_settings[0]['edfm_parent_right_background_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_right_background_color'] ) : '#d5edf9';


	$edfm_font_family = isset($edfm_fly_menu_settings[0]['edfm_font_family'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_font_family'] ): 'Roboto';
	$edfm_font_family = preg_replace('/\s+/', '+', $edfm_font_family);


	$edfm_header_text_align = isset( $edfm_fly_menu_settings[0]['edfm_header_text_align'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_header_text_align'] ) : '';
	$edfm_body_text_align = isset( $edfm_fly_menu_settings[0]['edfm_body_text_align'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_body_text_align'] ) : '';
	$edfm_footer_text_align = isset( $edfm_fly_menu_settings[0]['edfm_footer_text_align'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_footer_text_align'] ) : '';

	$edfm_text_transform = isset($edfm_fly_menu_settings[0]['edfm_text_transform'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_text_transform'] ): 'normal';

	$edfm_font_weight = isset( $edfm_fly_menu_settings[0]['edfm_font_weight'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_font_weight'] ) : '400';
	$edfm_font_color = isset($edfm_fly_menu_settings[0]['edfm_font_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_font_color'] ): '#000';

	$edfm_parent_hover_color = isset($edfm_fly_menu_settings[0]['edfm_parent_hover_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_hover_color'] ): 'rgba(0,0,0,0.2)';
	$edfm_parent_hover_bg_color = isset($edfm_fly_menu_settings[0]['edfm_parent_hover_bg_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_hover_bg_color'] ): '';

	$edfm_child_color_background = isset($edfm_fly_menu_settings[0]['edfm_child_color_background'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_color_background'] ): '#383838';

	$edfm_description_background_color = isset($edfm_fly_menu_settings[0]['edfm_description_background_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_description_background_color'] ): '#fff';

	$edfm_parent_background_type = isset($edfm_fly_menu_settings[0]['edfm_parent_background_type'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_background_type'] ): 'none';

	$edfm_child_font_color = isset( $edfm_fly_menu_settings[0]['edfm_child_font_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_font_color'] ) : '';

	$edfm_description_font_color = isset( $edfm_fly_menu_settings[0]['edfm_description_font_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_description_font_color'] ) : '';
	$edfm_description_length = isset( $edfm_fly_menu_settings[0]['edfm_description_length'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_description_length'] ) : '';


	if($edfm_parent_background_type != 'none' && $edfm_parent_background_type == 'edfm_parent_image_background'){
		$edfm_parent_background_image_url = isset($edfm_fly_menu_settings[0]['edfm_parent_background_image_url'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_background_image_url'] ): '';
	}
	?>
	<link href="https://fonts.googleapis.com/css?family=<?php esc_attr_e($edfm_font_family);?>" rel="stylesheet">
	<?php $edfm_font_family = str_replace('+',' ',$edfm_font_family);?>

	<style type="text/css">
		 .edfm-<?php _e($postid);?> .edfm-long-description{
		 	width: <?php echo $edfm_description_length.'px';?>;
		 }
		 .edfm-<?php _e($postid);?>.edfm_position_top .edfm-long-description, 
		 .edfm-<?php _e($postid);?>.edfm_position_bottom .edfm-long-description{
		 	width: 100%;
		 	max-height: <?php echo $edfm_description_length.'px';?>;
		 }

		.edfm-<?php _e($postid);?> .edfm-fly-menu-body ul li a.edfm-menu-link,
		.edfm-<?php _e($postid);?> .edfm-header-title,
		.edfm-<?php _e($postid);?> .edfm-toggle-icon,
		.edfm-<?php _e($postid);?> .edfm-title-wrap span.edfm-title,
		.edfm-<?php _e($postid);?> .edfm-fly-menu-body .edfm-menu-header,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1 .edfm-fly-menu-wrapper-inner .search-submit,
		.edfm-<?php _e($postid);?>.edfm_side_menu span.edfm-title-description,
		.edfm-<?php _e($postid);?> .edfm-fly-menu-body,
		.edfm-<?php _e($postid);?> .edfm-header-additionl-content,
		.edfm-<?php _e($postid);?> .edfm-header-tagline,
		.edfm-<?php _e($postid);?> .edfm-fly-menu-wrapper-inner form.search-form input[type="search"],
		.edfm-<?php _e($postid);?> .edfm-fly-menu-wrapper-inner form.search-form input[type="search"]::placeholder,
		.edfm-<?php _e($postid);?> .edfm-fly-menu-body,
		.edfm-<?php _e($postid);?> ul.edfm-footer-social li a{
			color: <?php echo $edfm_font_color;?>;
		}
		/*.edfm-<?php _e($postid);?>.edfm_side_menu_template_2 ul.edfm-footer-social li a{
			border-color: <?php echo $edfm_font_color;?>;
		}*/
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-wrapper-inner form.search-form input[type="search"]::-webkit-input-placeholder { /* Chrome/Opera/Safari */
			color: <?php echo $edfm_font_color;?>;

		}
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-wrapper-inner form.search-form label input[type="search"]::-moz-placeholder { /* Firefox 19+ */
			color: <?php echo $edfm_font_color;?>;

		}
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-wrapper-inner form.search-form label input[type="search"]:-ms-input-placeholder { /* IE 10+ */
			color: <?php echo $edfm_font_color;?>;

		}
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-wrapper-inner form.search-form label input[type="search"]:-moz-placeholder { /* Firefox 18- */
			color: <?php echo $edfm_font_color;?>;

		}

		.edfm-<?php _e($postid);?>.edfm_parent_video_background .edfm-fly-menu-wrapper-inner:before, 
		.edfm-<?php _e($postid);?>.edfm_parent_image_background .edfm-fly-menu-wrapper-inner:before,
		.edfm-<?php _e($postid);?>.edfm_skewed_menu .edfm-fly-menu-wrapper-inner:before{
			background-color: <?php echo $edfm_parent_background_color;?>;
		}

		.edfm-<?php _e($postid);?>.edfm-fly-menu-wrapper,
		.edfm-<?php _e($postid);?> .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1 .edfm-fly-menu-wrapper-inner .search-submit,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-wrapper-inner form.search-form label input[type="search"]{
			font-family: '<?php echo $edfm_font_family;?>';
			text-transform: <?php echo $edfm_text_transform;?>;
			font-weight: <?php echo $edfm_font_weight;?>;
		}

		.edfm-<?php _e($postid);?> .edfm-fly-menu-header {
			text-align: <?php echo $edfm_header_text_align;?>;
		}

		.edfm-<?php _e($postid);?> .edfm-fly-menu-body,
		.edfm-<?php _e($postid);?>.edfm_full_screen_menu .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_push .edfm-submenu {
			text-align: <?php echo $edfm_body_text_align;?>;
		}

		.edfm-<?php _e($postid);?> .edfm-fly-menu-footer {
			text-align: <?php echo $edfm_footer_text_align;?>;
		}

		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1 .edfm-title-wrap span.edfm-title{
			font-weight: <?php echo $edfm_font_weight;?>;
		}

		.edfm-<?php _e($postid);?>.edfm_side_menu .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_full_menu_animation_1 .edfm-fly-menu-wrapper-inner:before, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_animation_1 .edfm-fly-menu-wrapper-inner:after,
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_3 .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_2 .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_3 .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_4 .edfm-fly-menu-wrapper-inner .mCustomScrollBox, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_3.edfm_full_menu_animation_4 .edfm-fly-menu-wrapper-inner .mCustomScrollBox,
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_5 .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_2 .edfm-fly-menu-wrapper-inner:before{
			background-color: <?php echo $edfm_parent_background_color;?>;
		}

		.edfm-<?php _e($postid);?>.edfm_skewed_menu.edfm_position_right .edfm-fly-menu-wrapper-inner:after{
			border-right-color: <?php echo $edfm_parent_background_color;?>;
		}


		.edfm-<?php _e($postid);?>.edfm_full_menu_template_2 .edfm-fly-menu-wrapper-inner:after{
			background-color: <?php echo $edfm_parent_right_background_color;?>;
		}

		.edfm-<?php _e($postid);?>.edfm_side_menu .edfm-fly-menu-body ul li.edfm_side_menu_item_animation_1 a.edfm-menu-link:hover, 
		.edfm-<?php _e($postid);?>.edfm_side_menu .edfm-fly-menu-body ul li.edfm_side_menu_item_animation_1.current-menu-item a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_side_menu .edfm-fly-menu-body ul li.edfm_side_menu_item_animation_1.current_page_item a.edfm-menu-link,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_drop .edfm-fly-menu-body ul ul li.edfm_nav_icon_menu_item_animation_2 a.edfm-menu-link:after,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_2 a.edfm-menu-link:after,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu_template_2 .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link:hover, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu_template_2 .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_1.current-menu-item a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu_template_2 .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_1.current_page_item a.edfm-menu-link,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_3 a.edfm-menu-link:after,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_4 a.edfm-menu-link:after,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_drop .edfm-fly-menu-body ul ul li.edfm_nav_icon_menu_item_animation_4 a.edfm-menu-link:after,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu_template_2 .edfm-header-search span.fa.fa-search:hover, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu_template_2 .edfm-footer-search span.fa.fa-search:hover
		{
			background-color: <?php echo $edfm_parent_hover_bg_color;?>;
		}

		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_position_left .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link:hover, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_position_left .edfm-fly-menu-body ul li.current-menu-item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_position_left .edfm-fly-menu-body ul li.current_page_item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_drop.edfm_position_left .edfm-fly-menu-body ul ul li.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link:hover, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_drop.edfm_position_left .edfm-fly-menu-body ul ul li.current-menu-item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_drop.edfm_position_left .edfm-fly-menu-body ul ul li.current_page_item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link{
			border-left-color: <?php echo $edfm_parent_hover_bg_color;?>;
		}
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1 .edfm-fly-menu-body ul li.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link:hover, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1 .edfm-fly-menu-body ul li.current-menu-item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1 .edfm-fly-menu-body ul li.current_page_item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_drop .edfm-fly-menu-body ul ul li.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link:hover, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_drop .edfm-fly-menu-body ul ul li.current-menu-item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu.edfm_nav_icon_menu_template_1.edfm_drop .edfm-fly-menu-body ul ul li.current_page_item.edfm_nav_icon_menu_item_animation_1 a.edfm-menu-link,
		.edfm-<?php _e($postid);?> a.edfm-menu-link:hover .edfm-title-wrap span.edfm-title{
			border-right-color: <?php echo $edfm_parent_hover_color;?>;
			color: <?php echo $edfm_parent_hover_color;?>;
		}

		.edfm-<?php _e($postid);?> .edfm-submenu span.edfm-title,
		.edfm-<?php _e($postid);?> .edfm-submenu span.edfm-title:hover,
		.edfm-<?php _e($postid);?>.edfm_side_menu .edfm-submenu span.edfm-title-description,
		.edfm-<?php _e($postid);?> .edfm-submenu .edfm-toggle-icon,
		.edfm-<?php _e($postid);?> .edfm-submenu .edfm-toggle-icon.fa{
			color: <?php echo $edfm_child_font_color;?>;
		}

		.edfm-<?php _e($postid);?>.edfm_full_screen_menu ul.edfm-menu li.edfm_full_menu_item_animation_1 a.edfm-menu-link:hover, 
		.edfm-<?php _e($postid);?>.edfm_full_screen_menu ul.edfm-menu li.edfm_full_menu_item_animation_1.current-menu-item a.edfm-menu-link, 
		.edfm-<?php _e($postid);?>.edfm_full_screen_menu ul.edfm-menu li.edfm_full_menu_item_animation_1.current_page_item a.edfm-menu-link,
		.edfm-<?php _e($postid);?> ul.edfm-menu li.edfm_full_menu_item_animation_2 span.edfm-title:before, 
		.edfm-<?php _e($postid);?> ul.edfm-menu li.edfm_full_menu_item_animation_2 span.edfm-title:after,
		.edfm-<?php _e($postid);?> ul.edfm-menu li.edfm_full_menu_item_animation_3 a.edfm-menu-link:hover span.edfm-title, 
		.edfm-<?php _e($postid);?> ul.edfm-menu li.edfm_full_menu_item_animation_3.current-menu-item a.edfm-menu-link span.edfm-title, 
		.edfm-<?php _e($postid);?> ul.edfm-menu li.edfm_full_menu_item_animation_3.current_page_item a.edfm-menu-link span.edfm-title,
		.edfm-<?php _e($postid);?> ul.edfm-menu li.edfm_full_menu_item_animation_4 span.edfm-title:before{
			color: <?php echo $edfm_parent_hover_color;?>;
		}

		.edfm-<?php _e($postid);?>.edfm_push .edfm-submenu,
		.edfm-<?php _e($postid);?>.edfm_drop .edfm-submenu,
		.edfm-<?php _e($postid);?>.edfm_parent_image_background .edfm-submenu:before,
		.edfm-<?php _e($postid);?>.edfm_position_top.edfm_side_menu_template_2.edfm_drop .edfm-submenu, 
		.edfm-<?php _e($postid);?>.edfm_position_bottom.edfm_side_menu_template_2.edfm_drop .edfm-submenu{
			background-color: <?php echo $edfm_child_color_background;?>;
		}

		<?php if($edfm_parent_background_type != 'none' && $edfm_parent_background_type == 'edfm_parent_image_background'):?>
		.edfm-<?php _e($postid);?>.edfm_side_menu .edfm-fly-menu-wrapper-inner, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_1 .edfm-fly-menu-wrapper-inner, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_3 .edfm-fly-menu-wrapper-inner, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_2 .edfm-fly-menu-wrapper-inner, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_2 .edfm-fly-menu-wrapper-inner, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_3 .edfm-fly-menu-wrapper-inner, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_4 .edfm-fly-menu-wrapper-inner .mCustomScrollBox, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_3.edfm_full_menu_animation_4 .edfm-fly-menu-wrapper-inner .mCustomScrollBox, 
		.edfm-<?php _e($postid);?>.edfm_full_menu_template_1.edfm_full_menu_animation_5 .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_nav_icon_menu .edfm-fly-menu-wrapper-inner,
		.edfm-<?php _e($postid);?>.edfm_skewed_menu .edfm-fly-menu-wrapper-inner:before{
			background-image: url(<?php echo $edfm_parent_background_image_url;?>);
			background-size: cover;
		}
		<?php endif;?>

	.edfm-<?php _e($postid);?> .edfm-submenu span.edfm-title,
	.edfm-<?php _e($postid);?> .edfm-submenu .edfm-icon,
	.edfm-<?php _e($postid);?> .edfm-submenu .edfm-menu-header-label,
	.edfm-<?php _e($postid);?> .edfm-submenu .edfm-title-description{
		color: <?php echo $edfm_child_font_color;?>;
	}
</style>

<?php
}