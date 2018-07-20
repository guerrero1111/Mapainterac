<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$edfm_fly_menu_settings = get_post_meta($post->ID,'_edfm_select_menu');
$edfm_parent_background_type = 'none';
$edfm_parent_background_image_url = '';
$edfm_parent_background_video_url='';
$edfm_video_mute = '';
$edfm_video_img = '';
$edfm_video_loop = '';
$edfm_video_play = '';
$edfm_video_blur = '';
$edfm_parent_border_type = '';

?>
<div class="edfm-preview-menu-wrapper" >
	<div id="edfm-preview-video" class="edfm-preview-video" data-property="{videoURL:'lZ2e3IKCNpw', containment:'#edfm-preview-video', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, addRaster:false, quality:'default'}" >
		<div class="edfm-preview-menu-inner-wrapper" >
			<div class="v-center-outer">
				<div class="v-center-inner">
					<div class="edfm-preview-header-wrapper" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_header'] ) && $edfm_fly_menu_settings[0]['edfm_enable_header'] == 1 )) _e('style="display:none;"'); ?>>
						<span class="edfm-preview-header"><?php _e('Header','eight-degree-fly-menu');?></span>
						<div class="edfm-preview-top-text" <?php if(!isset($edfm_fly_menu_settings[0]['edfm_top_text_option'])) _e('style="display:none;"');if ( isset( $edfm_fly_menu_settings[0]['edfm_top_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_top_text_option'] == 'edfm-no-text' ) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Top text','eight-degree-fly-menu');?></span>
						</div>
						<div class="edfm-preview-image" <?php if(!isset($edfm_fly_menu_settings[0]['edfm_image_option'])) _e('style="display:none;"');if ( isset( $edfm_fly_menu_settings[0]['edfm_image_option'] ) && $edfm_fly_menu_settings[0]['edfm_image_option'] == 'edfm-no-image' ) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Image','eight-degree-fly-menu');?></span>
						</div>
						<div class="edfm-preview-bottom-text" <?php if(!isset($edfm_fly_menu_settings[0]['edfm_bottom_text_option'])) _e('style="display:none;"');if ( isset( $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] == 'edfm-no-text' ) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Bottom text','eight-degree-fly-menu');?></span>
						</div>
						<div class="edfm-preview-header-content" <?php if(!isset($edfm_fly_menu_settings[0]['edfm_menu_custom_header_content'])) _e('style="display:none;"');if ( isset( $edfm_fly_menu_settings[0]['edfm_menu_custom_header_content'] ) && empty($edfm_fly_menu_settings[0]['edfm_menu_custom_header_content'])) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Header Custom content','eight-degree-fly-menu');?></span>
						</div>
						<div class="edfm-preview-header-search" <?php if(!isset($edfm_fly_menu_settings[0]['edfm_enable_top_search_form'])) _e('style="display:none;"');if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_top_search_form'] ) && $edfm_fly_menu_settings[0]['edfm_enable_top_search_form'] == 1 )) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Header search','eight-degree-fly-menu');?></span>
						</div>
					</div>
					<div class="edfm-preview-body-wrapper">
						<span class="edfm-preview-header"><?php _e('Body','eight-degree-fly-menu');?></span>
						<div class="edfm-preview-custom-content" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ) && $edfm_fly_menu_settings[0]['edfm_body_content_selector'] == 'edfm-custom-content' )) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Body Custom content','eight-degree-fly-menu');?></span><span class="edfm-preview-notification"><?php _e('Hot!','eight-degree-fly-menu');?></span>
						</div>
						<div class="edfm-preview-menu-content" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ))) _e('style="display:block;"'); if (!( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ) && $edfm_fly_menu_settings[0]['edfm_body_content_selector'] == 'edfm-fly-menu' )) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Fly Menu','eight-degree-fly-menu');?></span><span class="edfm-preview-notification"><?php _e('Hot!','eight-degree-fly-menu');?></span>
						</div>
					</div>
					<div class="edfm-preview-footer-wrapper" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_footer'] ) && $edfm_fly_menu_settings[0]['edfm_enable_footer'] == 1 )) _e('style="display:none;"'); ?>>
						<span class="edfm-preview-header"><?php _e('Footer','eight-degree-fly-menu');?></span>
						<div class="edfm-preview-footer-search" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form'] ) && $edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form'] == 1 )) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Footer Search','eight-degree-fly-menu');?></span>
						</div>
						<div class="edfm-preview-footer-social" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_social_icons'] ) && $edfm_fly_menu_settings[0]['edfm_enable_social_icons'] == 1 )) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Social icons','eight-degree-fly-menu');?></span>
						</div>
						<div class="edfm-preview-footer-content" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_menu_custom_footer_content'] ) && empty($edfm_fly_menu_settings[0]['edfm_menu_custom_footer_content'])) _e('style="display:none;"'); ?>>
							<span class="edfm-preview-content"><?php _e('Footer Custom Content','eight-degree-fly-menu');?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
