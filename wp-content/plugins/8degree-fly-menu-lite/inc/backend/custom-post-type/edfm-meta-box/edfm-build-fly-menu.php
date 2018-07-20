<?php 
/* 
 * Eight Degree Fly Menu - Build Fly Menu Options
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="edfm-postbox-section">
	<h4><?php _e('Build Fly Menu','eight-degree-fly-menu');?></h4>
	<div class="edfm-postbox-content">
		<p class="description"><?php _e('In this section you wil be controlling the content for your fly menu. The fly menu consists of mainly three sections; header, body and footer. <br/><br/>When you are done, go to <strong>Layout Settings</strong> to choose a fly menu layout.')?></p>
	</div>
</div>
<div class="edfm-postbox-section edfm-postbox-header-section">
	<h4><?php _e('Header Section','eight-degree-fly-menu');?></h4>
	<div class="edfm-postbox-fields">
		<div class="edfm-label-info-wrap">
			<label><?php _e('Enable Header Section','eight-degree-fly-menu');?></label>
		</div>
		<div class="edfm-slide-checkbox-wrapper">
			<div class="edfm-slide-checkbox-wrapper-inner">
				<div class="edfm-slide-checkbox">  
					<input class="edfm-enable-header" type="checkbox" name="edfm_enable_header" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_enable_header'] ) && $edfm_fly_menu_settings[0]['edfm_enable_header'] == 1 ) esc_attr_e('checked'); ?>/>
					<label for="edfm-disable-edfm"></label>
				</div>
			</div>
		</div>	
		<div class="edfm-description"><?php _e('Turn on to show/enable the header settings.','eight-degree-fly-menu');?></div>
	</div>
	<div class="edfm-postbox-header-content" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_header'] ) && $edfm_fly_menu_settings[0]['edfm_enable_header'] == 1 )) _e('style="display:none;"'); ?>>
		<div class="edfm-postbox-fields">
			<label><?php _e('Add Fly Menu Top Text','eight-degree-fly-menu');?></label>
			<select class="edfm-top-text-option" name="edfm_top_text_option" >
				<option value="edfm-no-text" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_top_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_top_text_option'] == 'edfm-no-text' ) echo 'selected'; ?>><?php _e('No Text','eight-degree-fly-menu');?></option>	
				<option value="edfm-custom-title" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_top_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_top_text_option'] == 'edfm-custom-title' ) echo 'selected'; ?>><?php _e('Custom Text and Tagline','eight-degree-fly-menu');?></option>
			</select>
			<div class="edfm-description"><?php _e('Choose to add a Top menu text in your header.','eight-degree-fly-menu');?></div>
		</div>
		<div class="edfm-top-text-tagline-wrapper" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_top_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_top_text_option'] == 'edfm-custom-title' )) _e('style="display:none;"'); ?>>
			<div class="edfm-postbox-fields">
				<label><?php _e('Top Text Label','eight-degree-fly-menu');?></label>
				<input type="text" name="edfm_custom_top_text" value="<?php isset($edfm_fly_menu_settings[0]['edfm_custom_top_text'])?esc_attr_e($edfm_fly_menu_settings[0]['edfm_custom_top_text']):'';?>" placeholder="<?php _e('Enter Top level text','eight-degree-fly-menu');?>">
			</div>
			<div class="edfm-postbox-fields">
				<label><?php _e('Top Text Tagline','eight-degree-fly-menu');?></label>
				<input type="text" name="edfm_custom_top_tagline" value="<?php isset($edfm_fly_menu_settings[0]['edfm_custom_top_tagline'])?esc_attr_e($edfm_fly_menu_settings[0]['edfm_custom_top_tagline']):'';?>" placeholder="<?php _e('Enter Top level tagline','eight-degree-fly-menu');?>">
			</div>
		</div>
		<div class="edfm-postbox-fields">
			<label><?php _e('Add Fly Menu Header Image','eight-degree-fly-menu');?></label>
			<select class="edfm-image-option" name="edfm_image_option">
				<option value="edfm-no-image" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_image_option'] ) && $edfm_fly_menu_settings[0]['edfm_image_option'] == 'edfm-no-image' ) echo 'selected'; ?>><?php _e('No Image','eight-degree-fly-menu');?></option>
				<option value="edfm-custom-image" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_image_option'] ) && $edfm_fly_menu_settings[0]['edfm_image_option'] == 'edfm-custom-image' ) echo 'selected'; ?>><?php _e('Upload Custom Image','eight-degree-fly-menu');?></option>
			</select>
			<div class="edfm-description"><?php _e('Choose header image type.','eight-degree-fly-menu');?></div>
			<div class="edfm-header-image" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_image_option'] ) && $edfm_fly_menu_settings[0]['edfm_image_option'] == 'edfm-custom-image' )) _e('style="display:none;"'); ?>>
				<label><?php _e('Custom Header Image','eight-degree-fly-menu');?></label>
				<input type="text" name="edfm_custom_header_image" class="edfm-custom-image-path" value="<?php isset($edfm_fly_menu_settings[0]['edfm_custom_header_image'])?esc_attr_e($edfm_fly_menu_settings[0]['edfm_custom_header_image']):'';?>"/>
				<button class="edfm-meta-box-upload button-secondary"><i class="fa fa-upload" aria-hidden="true"></i></button>
				<div class="edfm-description"><?php _e('Click on icon to upload image from the library or directly insert the image URL.','eight-degree-fly-menu');?></div>

				<?php
				if(isset($edfm_fly_menu_settings[0]['edfm_custom_header_image']) && !empty($edfm_fly_menu_settings[0]['edfm_custom_header_image'])){
					?>
					<div class="edfm-custom-image-preview">
						<img src="<?php esc_attr_e($edfm_fly_menu_settings[0]['edfm_custom_header_image']);?>"/>
					</div>	
					<?php
				}
				?>

			</div>
		</div>
		<div class="edfm-postbox-fields">
			<label><?php _e('Add Fly Menu Bottom Text','eight-degree-fly-menu');?></label>
			<select class="edfm-bottom-text-option" name="edfm_bottom_text_option">
				<option value="edfm-no-text" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] == 'edfm-no-text' ) echo 'selected'; ?>><?php _e('No Text','eight-degree-fly-menu');?></option>		
				<option value="edfm-custom-title" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] == 'edfm-custom-title' ) echo 'selected'; ?>><?php _e('Custom Text and Tagline','eight-degree-fly-menu');?></option>
			</select>
			<div class="edfm-description"><?php _e('Choose to add a Bottom menu text in your header.','eight-degree-fly-menu');?></div>
		</div>
		<div class="edfm-bottom-text-tagline-wrapper" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] ) && $edfm_fly_menu_settings[0]['edfm_bottom_text_option'] == 'edfm-custom-title' )) _e('style="display:none;"'); ?>>
			<div class="edfm-postbox-fields">
				<label><?php _e('Bottom Text Label','eight-degree-fly-menu');?></label>
				<input type="text" name="edfm_custom_bottom_text" value="<?php isset($edfm_fly_menu_settings[0]['edfm_custom_bottom_text'])?esc_attr_e($edfm_fly_menu_settings[0]['edfm_custom_bottom_text']):'';?>" placeholder="<?php _e('Enter bottom header text','eight-degree-fly-menu');?>">
			</div>
			<div class="edfm-postbox-fields">
				<label><?php _e('Bottom Text Tagline','eight-degree-fly-menu');?></label>
				<input type="text" name="edfm_custom_bottom_tagline" value="<?php isset($edfm_fly_menu_settings[0]['edfm_custom_bottom_tagline'])?esc_attr_e($edfm_fly_menu_settings[0]['edfm_custom_bottom_tagline']):'';?>" placeholder="<?php _e('Enter bottom header tagline','eight-degree-fly-menu');?>">
			</div>
		</div>

		<div class="edfm-postbox-fields">
			<div class="edfm-label-info-wrap">
				<label><?php _e('Add Search form in Header','eight-degree-fly-menu');?></label>
			</div>
			<div class="edfm-slide-checkbox-wrapper">
				<div class="edfm-slide-checkbox-wrapper-inner">
					<div class="edfm-slide-checkbox">  
						<input type="checkbox" name="edfm_enable_top_search_form" class="edfm_search_enable edfm_search_enable_header" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_enable_top_search_form'] ) && $edfm_fly_menu_settings[0]['edfm_enable_top_search_form'] == 1 ) esc_attr_e('checked'); ?>/>
						<label for="edfm-disable-edfm"></label>
					</div>
				</div>
			</div>	
			<div class="edfm-description"><?php _e('Turn on to enable Search Box in the header section.','eight-degree-fly-menu');?></div>
		</div>
		<div class="edfm-postbox-fields edfm_search_placeholder" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_top_search_form'] ) && $edfm_fly_menu_settings[0]['edfm_enable_top_search_form'] == 1 )) _e('style="display:none;"'); ?>>
			<div class="edfm-label-info-wrap">
				<label><?php _e('Search form placeholder text','eight-degree-fly-menu');?></label>
			</div>
			<input type="text" name="edfm_top_search_text" value="<?php isset($edfm_fly_menu_settings[0]['edfm_top_search_text'])?esc_attr_e($edfm_fly_menu_settings[0]['edfm_top_search_text']):'';?>" placeholder="<?php _e('Enter search form place holder.','eight-degree-fly-menu');?>">
		</div>

	</div>
</div>
<div class="edfm-postbox-section edfm-postbox-body-section">
	<h4><?php _e('Body Section','eight-degree-fly-menu');?></h4>
	<p class="description"><?php _e('You can choose the Fly menu border to be either a menu or you can add custom content to the body using the editor.');?></p>
	<div class="edfm-postbox-fields">
		<label><?php _e('Body Content','eight-degree-fly-menu');?></label>
		<select class="edfm-body-content-selector" name="edfm_body_content_selector">
			<option value="edfm-fly-menu" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ) && $edfm_fly_menu_settings[0]['edfm_body_content_selector'] == 'edfm-fly-menu' ) echo 'selected'; ?>>Use Fly Menu</option>
			<option value="edfm-custom-content" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ) && $edfm_fly_menu_settings[0]['edfm_body_content_selector'] == 'edfm-custom-content' ) echo 'selected'; ?>>Use Custom Content</option>
		</select>
		<div class="edfm-description"><?php _e('Choose body content type.','eight-degree-fly-menu');?></div>
	</div>
	<div class="edfm-body-fly-menu-wrapper" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ))) _e('style="display:block;"'); if (!( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ) && $edfm_fly_menu_settings[0]['edfm_body_content_selector'] == 'edfm-fly-menu' )) _e('style="display:none;"'); ?>>
		<div class="edfm-postbox-fields">
			<label>Select Fly Menu</label>
			<?php $selected_menu = get_option('edfm_selected_menu'); ?>
			<select name="select_menu" <?php if(empty($selected_menu)) esc_attr_e('disabled'); ?>>
				<?php
				$nav_menus = wp_get_nav_menus();
				$all_nav_menu =array();
				if(!empty($nav_menus)){
					foreach($nav_menus as $nav_menu){
						$all_nav_menu[] = $nav_menu->term_id;
					}
				}
				$edfm_selected_menu = get_option('edfm_selected_menu');	
				if(!empty($edfm_selected_menu)){
					
					foreach($edfm_selected_menu as $menu_id){
						if(in_array($menu_id, $all_nav_menu)){
							$menu_object = wp_get_nav_menu_object( $menu_id );	
							?>
							<option value="<?php esc_attr_e($menu_object->term_id);?>" <?php if ( isset( $edfm_fly_menu_settings[0]['select_menu'] ) && $edfm_fly_menu_settings[0]['select_menu'] == esc_attr($menu_object->term_id)) echo 'selected'; ?>><?php echo $menu_object->name;?></option>
							<?php
						}
					}
				}else{
					?>
					<option value="no-menu">Fly menu not set</option>
					<?php
				}
				?>
			</select>
			<div class="edfm-description"><?php _e('Select a fly menu. If you have not created a fly menu, please click ');?> <a href="<?php echo admin_url().'nav-menus.php';?>" target="_blank">here</a><?php _e(' to create a fly','eight-degree-fly-menu');?></div>
		</div>
	</div>
	<div class="edfm-body-custom-content-wrapper" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_body_content_selector'] ) && $edfm_fly_menu_settings[0]['edfm_body_content_selector'] == 'edfm-custom-content' )) _e('style="display:none;"'); ?>>
		<div class="edfm-postbox-fields">
			<label>Custom content</label>
			<div class="edfm-description"><?php _e('You can place custom content or shortcodes here.','eight-degree-fly-menu');?></div>
			<?php
			$content = isset($edfm_fly_menu_settings[0]['edfm_menu_custom_content'])?wp_kses_post($edfm_fly_menu_settings[0]['edfm_menu_custom_content']):'';
			$editor_id = 'edfm_menu_custom_content';
			$settings = array(
				'wpautop' => true,
				'media_buttons' => true,
				'textarea_name' => $editor_id, 
				'textarea_rows' => 8,
				'tabindex' => 'none',
				'editor_class' => 'edfm_wp_editor',
				'teeny' => false,
				'dfw' => false,
				'tinymce' => true,
				'quicktags' => true,
				'drag_drop_upload' => true
			);
			wp_editor( $content, $editor_id, $settings);
			?>
		</div>
	</div>
</div>

<div class="edfm-postbox-section edfm-postbox-footer-section">
	<h4><?php _e('Footer Section','eight-degree-fly-menu');?></h4>
	<div class="edfm-postbox-fields">
		<div class="edfm-label-info-wrap">
			<label><?php _e('Enable Footer Section','eight-degree-fly-menu');?></label>
		</div>
		<div class="edfm-slide-checkbox-wrapper">
			<div class="edfm-slide-checkbox-wrapper-inner">
				<div class="edfm-slide-checkbox">  
					<input class="edfm-enable-footer" type="checkbox" name="edfm_enable_footer" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_enable_footer'] ) && $edfm_fly_menu_settings[0]['edfm_enable_footer'] == 1 ) esc_attr_e('checked'); ?>/>
					<label for="edfm-disable-edfm"></label>
				</div>
			</div>
		</div>	
		<div class="edfm-description"><?php _e('Turn on to show/enable the header settings.','eight-degree-fly-menu');?></div>

	</div>
	<div class="edfm-postbox-footer-content" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_footer'] ) && $edfm_fly_menu_settings[0]['edfm_enable_footer'] == 1 )) _e('style="display:none;"'); ?>>
		<div class="edfm-postbox-fields">
			<div class="edfm-label-info-wrap">
				<label><?php _e('Add Search form in Footer','eight-degree-fly-menu');?></label>
			</div>
			<div class="edfm-slide-checkbox-wrapper">
				<div class="edfm-slide-checkbox-wrapper-inner">
					<div class="edfm-slide-checkbox">  
						<input type="checkbox" name="edfm_enable_bottom_search_form" class="edfm_search_enable edfm_search_enable_footer"<?php if ( isset( $edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form'] ) && $edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form'] == 1 ) esc_attr_e('checked'); ?>/>
						<label for="edfm-disable-edfm"></label>
					</div>
				</div>
			</div>		
			<div class="edfm-description"><?php _e('Turn on to enable Search Box in the footer section.','eight-degree-fly-menu');?></div>	
		</div>
		<div class="edfm-postbox-fields edfm_search_placeholder" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form'] ) && $edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form'] == 1 )) _e('style="display:none;"'); ?>>
			<div class="edfm-label-info-wrap">
				<label><?php _e('Search form placeholder text','eight-degree-fly-menu');?></label>
			</div>
			<input type="text" name="edfm_bottom_search_text" value="<?php isset($edfm_fly_menu_settings[0]['edfm_bottom_search_text'])?esc_attr_e($edfm_fly_menu_settings[0]['edfm_bottom_search_text']):'';?>" placeholder="<?php _e('Enter search form place holder.','eight-degree-fly-menu');?>">
		</div>

		<div class="edfm-social-icon">
			<div class="edfm-postbox-fields">
				<div class="edfm-label-info-wrap">
					<label><?php _e('Add Social Icons in Footer','eight-degree-fly-menu');?></label>
				</div>
				<div class="edfm-slide-checkbox-wrapper">
					<div class="edfm-slide-checkbox-wrapper-inner">
						<div class="edfm-slide-checkbox">  

							<input type="checkbox" class="edfm-enable-social-icons" name="edfm_enable_social_icons" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_enable_social_icons'] ) && $edfm_fly_menu_settings[0]['edfm_enable_social_icons'] == 1 ) esc_attr_e('checked'); ?>/>
							<label for="edfm-disable-edfm"></label>
						</div>
					</div>
				</div>	
				<div class="edfm-description"><?php _e('Turn on to enable social icons in the footer section.','eight-degree-fly-menu');?></div>	
			</div>
			<?php
			if(empty($edfm_social_icons)){
				$edfm_social_icons = array(
					'0' =>array(
						'facebook' => array(
							'icon' => 'facebook',
							'label' => 'Facebook',
							'url' => '',
							'tooltip' => ''
						),
						'twitter' => array(
							'icon' => 'twitter',
							'label' => 'Twitter',
							'url' => '',
							'tooltip' => ''
						),
						'instagram' => array(
							'icon' => 'instagram',
							'label' => 'Instagram',
							'url' => '',
							'tooltip' => ''
						),
						'youtube' => array(
							'icon' => 'youtube',
							'label' => 'Youtube',
							'url' => '',
							'tooltip' => ''
						),
						'linkedin' => array(
							'icon' => 'linkedin',
							'label' => 'Linkedin',
							'url' => '',
							'tooltip' => ''
						),
						'google-plus' => array(
							'icon' => 'google-plus',
							'label' => 'Google+',
							'url' => '',
							'tooltip' => ''
						)
					)
				);
			}else{
				$edfm_social_icons = get_post_meta($post->ID,'_edfm_social_icons');
			}
			?>
			<ul class="edfm-social-outlets-fields" <?php if (!( isset( $edfm_fly_menu_settings[0]['edfm_enable_social_icons'] ) && $edfm_fly_menu_settings[0]['edfm_enable_social_icons'] == 1 )) _e('style="display:none;"'); ?>>
				<?php 
				if(!empty($edfm_social_icons)){
					foreach($edfm_social_icons as $key => $value){ 
						foreach($value as $socialname => $innerarray){ 
							?>
							<li>
								<div class="edfm-social-title edfm-<?php esc_attr_e($edfm_social_icons[0][$socialname]['label']);?>"><i class="fa fa-<?php echo $edfm_social_icons[0][$socialname]['icon'];?>"></i><?php esc_html_e($edfm_social_icons[0][$socialname]['label']);?></div>
								<div class="edfm-postbox-fields">
									<label><?php _e('URL','eight-degree-fly-menu');?></label>
									<input type="url" name="edfm_social_icons[<?php esc_attr_e($socialname);?>][url]" value="<?php esc_attr_e($edfm_social_icons[0][$socialname]['url']);?>" placeholder="<?php esc_attr_e('Enter link for social media icon', 'eight-degree-fly-menu' );?>">
								</div>
								<div class="edfm-postbox-fields">
									<label><?php _e('Label','eight-degree-fly-menu');?></label>
									<input type="text" name="edfm_social_icons[<?php esc_attr_e($socialname);?>][tooltip]" value="<?php esc_attr_e($edfm_social_icons[0][$socialname]['tooltip']);?>" placeholder="<?php esc_attr_e('Enter tooltip text', 'eight-degree-fly-menu' );?>">
								</div>
							</li>
							<?php
						}
					}
				}
				?>	
			</ul>
		</div>
		<div class="edfm-postbox-fields">
			<label>Additional Footer Content</label>
			<div class="edfm-description"><?php _e('Enter additional footer content or shortcodes here.','eight-degree-fly-menu');?></div>
			<?php
			$content = isset($edfm_fly_menu_settings[0]['edfm_menu_custom_footer_content'])?wp_kses_post($edfm_fly_menu_settings[0]['edfm_menu_custom_footer_content']):'';
			$editor_id = 'edfm_menu_custom_footer_content';
			$settings = array(
				'wpautop' => true,
				'media_buttons' => true,
				'textarea_name' => $editor_id, 
				'textarea_rows' => 8,
				'tabindex' => 'none',
				'editor_class' => 'edfm_wp_editor',
				'teeny' => false,
				'dfw' => false,
				'tinymce' => true,
				'quicktags' => true,
				'drag_drop_upload' => true
			);
			wp_editor( $content, $editor_id, $settings);
			?>	
		</div>
	</div>
</div>