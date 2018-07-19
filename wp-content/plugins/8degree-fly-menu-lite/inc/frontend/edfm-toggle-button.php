<?php 
/* 
 * Eight Degree Fly Menu - Toggle Button
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$edfm_button_behavior = isset($edfm_fly_menu_settings[0]['edfm_button_behavior'])?$edfm_fly_menu_settings[0]['edfm_button_behavior']:'edfm_button_fix';

$edfm_toggle_custom_element = isset($edfm_fly_menu_settings[0]['edfm_toggle_custom_element'])?$edfm_fly_menu_settings[0]['edfm_toggle_custom_element']:0;

$edfm_toggle_custom_element_id = isset($edfm_fly_menu_settings[0]['edfm_toggle_custom_element_id'])?$edfm_fly_menu_settings[0]['edfm_toggle_custom_element_id']:'';

$hide_open_toggle = '';
if($edfm_toggle_custom_element && $edfm_button_behavior == "edfm_button_hide" && !empty($edfm_toggle_custom_element_id)){
	$hide_open_toggle = 'edfm-hide-open-toggle';
}

?>
<div class="edfm-toggle-wrapper <?php esc_attr_e($edfm_button_behavior);?>">
	<div class="idioma">ES</div>
	<div class="edfm-toggle <?php esc_attr_e($hide_open_toggle)?>">
		<?php 
		switch($edfm_toggle_icon_type){
			case 'edfm_default_toggle_icon':
			$edfm_toggle_default_close = isset($edfm_fly_menu_settings[0]['edfm_toggle_default_close'])?$edfm_fly_menu_settings[0]['edfm_toggle_default_close']:'dashicons|dashicons-admin-plugins';
			$edfm_toggle_default_open = isset($edfm_fly_menu_settings[0]['edfm_toggle_default_open'])?$edfm_fly_menu_settings[0]['edfm_toggle_default_open']:'dashicons|dashicons-admin-plugins';

			if(!empty($edfm_toggle_default_close) && !empty($edfm_toggle_default_open)){
				$edfm_toggle_default_close_icon = explode( '|', $edfm_toggle_default_close);		
				if(isset($edfm_toggle_default_close_icon[1]) && !empty($edfm_toggle_default_close_icon)){
					_e('<i class="edfm_toggle_default_close_icon '.$edfm_toggle_default_close_icon[0] . ' ' . $edfm_toggle_default_close_icon[1].'"></i>');
				}
				$edfm_toggle_default_open_icon = explode( '|', $edfm_toggle_default_open);		
				if(isset($edfm_toggle_default_open_icon[1]) && !empty($edfm_toggle_default_open_icon)){
					_e('<i class="edfm_toggle_default_open_icon '.$edfm_toggle_default_open_icon[0] . ' ' . $edfm_toggle_default_open_icon[1].'"></i>');	
				}
			}
			break;
			default:
			?>
			<div class="edfm-bar1"></div>
			<div class="edfm-bar2"></div>
			<div class="edfm-bar3"></div>
			<?php
			break;

		}?>
	</div>
</div>



<?php
/* 
 * Eight Degree Fly Menu - Frontend Toggle Button Dynamic CSS
 */
	if($edfm_toggle_type != 'edfm_toggle_default'){
		$edfm_font_color = isset($edfm_fly_menu_settings[0]['edfm_font_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_font_color'] ): '#000';
		$edfm_toggle_background = isset($edfm_fly_menu_settings[0]['edfm_toggle_background'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_background'] ): '#ddd';
		$edfm_toggle_open_color = isset($edfm_fly_menu_settings[0]['edfm_toggle_open_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_open_color'] ): '#333';
		$edfm_toggle_close_color = isset($edfm_fly_menu_settings[0]['edfm_toggle_close_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_close_color'] ): '#333';
		$edfm_toggle_hover_color = isset($edfm_fly_menu_settings[0]['edfm_toggle_hover_color'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_hover_color'] ): '#333';
		$edfm_toggle_width = isset($edfm_fly_menu_settings[0]['edfm_toggle_width'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_width'] ): '40';
		$edfm_toggle_border = isset($edfm_fly_menu_settings[0]['edfm_toggle_border'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_border'] ): '0';
		$edfm_toggle_border_color = isset( $edfm_fly_menu_settings[0]['edfm_toggle_border_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_border_color'] ) : '#fff';
		$edfm_toggle_border_radius = isset($edfm_fly_menu_settings[0]['edfm_toggle_border_radius'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_border_radius'] ): '0';
		$edfm_toggle_top = isset($edfm_fly_menu_settings[0]['edfm_toggle_top'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_top'] ): '2';
		$edfm_toggle_left = isset($edfm_fly_menu_settings[0]['edfm_toggle_left'])?sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_left'] ): '1';
		?>
		<style>

			.edfm-<?php _e($postid);?> .edfm-toggle{
				background-color: <?php echo $edfm_toggle_background;?>;
				width:<?php echo $edfm_toggle_width.'px';?>;
				border: <?php echo $edfm_toggle_border.'px solid '.$edfm_toggle_border_color;?>;
				border-radius: <?php echo $edfm_toggle_border_radius.'%';?>;
			}
			.edfm-<?php _e($postid);?> .edfm-toggle.toggle-active > div{
				background-color: <?php echo $edfm_toggle_close_color;?>;
			}
			.edfm-<?php _e($postid);?> .edfm-toggle > div{
				background-color: <?php echo $edfm_toggle_open_color;?>;
			}

			.edfm-<?php _e($postid);?> .edfm-toggle:hover > div,
			.edfm-<?php _e($postid);?> .edfm-toggle.toggle-active:hover > div{
				background-color: <?php echo $edfm_toggle_hover_color;?>;
			}

			.edfm-<?php _e($postid);?> .edfm_toggle_default_open_icon{
				color: <?php echo $edfm_toggle_open_color;?>;
			}

			.edfm-<?php _e($postid);?> .edfm_toggle_default_close_icon{
				color: <?php echo $edfm_toggle_close_color;?>;
			}

			.edfm-<?php _e($postid);?> .edfm_toggle_default_close_icon:hover,
			.edfm-<?php _e($postid);?> .edfm_toggle_default_open_icon:hover{
				color: <?php echo $edfm_toggle_hover_color;?>;
			}


			.edfm-<?php _e($postid);?> .edfm-toggle-wrapper{
				top: <?php echo $edfm_toggle_top.'px';?>;
				left: <?php echo $edfm_toggle_left.'px';?>;
			}

		</style>
		<?php
	}