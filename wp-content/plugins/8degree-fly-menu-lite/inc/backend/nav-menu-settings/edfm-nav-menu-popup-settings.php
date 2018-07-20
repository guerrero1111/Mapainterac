<?php
/* 
 * Eight Degree Fly Menu - Nav.php Modal Box Options
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$menu_id = sanitize_text_field( $_POST[menu_id] );
$menu_item_id = sanitize_text_field( $_POST[menu_item_id] );
$menu_item_title = sanitize_text_field( $_POST[menu_item_title] );

$edfm_menu_item_settings = get_post_meta( $menu_item_id, '_edfmItemSettings' );

//$this->print_array($edfm_menu_item_settings);
$edfm_edit_menu_item_description = isset($edfm_menu_item_settings[0]['edfm_edit_menu_item_description'])?$edfm_menu_item_settings[0]['edfm_edit_menu_item_description']: '';
$edfm_edit_menu_item_description = wp_kses_post($edfm_edit_menu_item_description);

?>
<div class="edfm-nav-menu-response">

	<form class="edfm-menu-item-data" action="" method="POST" enctype="multipart/form-data">
		<div class="edfm-nav-menu-header">
			<h2>
				<?php
				_e( 'Menu Settings - ', 'eight-degree-fly-menu' );
				_e( $menu_item_title );
				?>
			</h2>
		</div>
		<div class="edfm-nav-menu-content">
			<?php
				//$this->print_array( $edfm_menu_item_settings );
			?>
			<ul class="nav-tab-wrapper">
				<li class="nav-tab nav-tab-active" data-tab="tab-1"><?php _e( 'General Settings', 'eight-degree-fly-menu' ); ?></li>
			</ul>
			<div id="tab-1" class="edfm-tab-content edfm-current">
				<div class="edfm-nav-menu-field">
						<label for="edfm_edit_menu_item_icon_type_<?php esc_attr_e( $menu_item_id ); ?>"><?php _e( 'Select Menu Icon', 'eight-degree-fly-menu' ); ?></label>
						<select id="edfm_edit_menu_item_icon_type_<?php esc_attr_e( $menu_item_id ); ?>" class="edfm-icon-select" name="edfm_edit_menu_item_icon_type">
							<option value="edfm_no_icon" <?php if ( isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] ) && $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] == 'edfm_no_icon' ) echo 'selected'; ?>><?php _e( 'None', 'eight-degree-fly-menu' ); ?></option>
							<option value="edfm_default_icon" <?php if ( isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] ) && $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] == 'edfm_default_icon' ) echo 'selected'; ?>><?php _e( 'Default Icon Set', 'eight-degree-fly-menu' ); ?></option>
							<option value="edfm_custom_icon" <?php if ( isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] ) && $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] == 'edfm_custom_icon' ) echo 'selected'; ?>><?php _e( 'Upload Custom Icon', 'eight-degree-fly-menu' ); ?></option>
						</select>		
				</div>
				<div class="edfm-icon-option-wrapper" <?php if(isset($edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type']) && $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] == 'edfm_no_icon' ) echo 'style="display:none;"';if(!isset($edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'])) echo 'style="display:none;"';?>>
					<div class="edfm-nav-menu-field edfm-default-icon edfm-icon-option" <?php if(isset($edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type']) && $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] == 'edfm_custom_icon' ) echo 'style="display:none;"'; ?>>
							<label for="edfm_edit_menu_default_icon_<?php esc_attr_e( $menu_item_id ); ?>"><?php _e( 'Choose Menu Icon from default Icon set', 'eight-degree-fly-menu' ); ?></label>
							<div id="edfm-menu-icon-div-1" data-target="#edfm_edit_menu_item_default_icon_<?php esc_attr_e( $menu_item_id ); ?>" class="button icon-picker <?php
								if ( isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_default_icon'] ) ) {
									$v = explode( '|', $edfm_menu_item_settings[0]['edfm_edit_menu_item_default_icon'] );
									echo $v[0] . ' ' . $v[1];
								}
								?>">
							</div>
							<input class="edfm-icon-picker" type="text" id="edfm_edit_menu_item_default_icon_<?php esc_attr_e( $menu_item_id ); ?>" name="edfm_edit_menu_item_default_icon" value="<?php isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_default_icon'] ) ? esc_attr_e( $edfm_menu_item_settings[0]['edfm_edit_menu_item_default_icon'] ) : 'dashicons|dashicons-admin-home'; ?>"/>
						<div class="edfm-description"><?php _e( 'Click button to select default icon. You can also directly add icon code such as dashicons|dashicons-admin-site or fa|fa-envelope-o or genericon|genericon-aside', 'eight-degree-fly-menu' ); ?></div>
					</div>
					<div class="edfm-nav-menu-field edfm-custom-icon edfm-icon-option" <?php if(!isset($edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'])) echo 'style="display:none;"'; if(isset($edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type']) && $edfm_menu_item_settings[0]['edfm_edit_menu_item_icon_type'] == 'edfm_default_icon' ) echo 'style="display:none;"'; ?>>
							<label for="edfm_edit_menu_item_custom_icon_<?php esc_attr_e( $menu_item_id ); ?>"><?php _e( 'Upload a custom Menu Icon', 'eight-degree-fly-menu' ); ?></label>
							<div class="button custom_image_background_button">
								<div class="current-background-image" >
									<?php if(isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon']) && !empty($edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon'])) { ?>
									<img src="<?php isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon'] ) ? esc_attr_e( $edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon'] ) : ''; ?>" style="height:35px; width:35px;"/>
									<?php }?>
								</div>
							</div>
							<input type="text" class="edfm_upload_background_url" name="edfm_edit_menu_item_custom_icon" id="edfm_edit_menu_item_custom_icon_<?php esc_attr_e( $menu_item_id ); ?>" value="<?php isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon'] ) ? esc_attr_e( $edfm_menu_item_settings[0]['edfm_edit_menu_item_custom_icon'] ) : ''; ?>"/>
						<div class="edfm-description"><?php _e( 'Click button to upload media from media libraryor directly place image URL or directly place image URL. Recommended icon size is 50x50px.', 'eight-degree-fly-menu' ); ?></div>
					</div>
				</div>
				<div class="edfm-nav-menu-field">
						<label for="edfm_edit_menu_item_show_nativation_label_<?php esc_attr_e( $menu_item_id ); ?>"><?php _e( 'Hide Menu Name', 'eight-degree-fly-menu' ); ?></label>
						<input type="checkbox" id="edfm_edit_menu_item_show_nativation_label_<?php esc_attr_e( $menu_item_id ); ?>" name="edfm_edit_menu_item_show_nativation_label" class="edfm-edit-menu-item-show-nativationlabel" <?php if ( isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_show_nativation_label'] ) && $edfm_menu_item_settings[0]['edfm_edit_menu_item_show_nativation_label'] == 1 ) echo 'checked'; ?>/>
					<div class="edfm-description"><?php _e( 'Check to not show menu name in frontend.', 'eight-degree-fly-menu' ); ?></div>
				</div>
				<div class="edfm-nav-menu-field">
						<label for="edfm_edit_menu_item_short_description_<?php esc_attr_e( $menu_item_id ); ?>"><?php _e( 'Menu Short Description', 'eight-degree-fly-menu' ); ?></label>
						<input type="text" id="edfm_edit_menu_item_short_description_<?php esc_attr_e( $menu_item_id ); ?>" name="edfm_edit_menu_item_short_description" value="<?php isset( $edfm_menu_item_settings[0]['edfm_edit_menu_item_short_description'] ) ? esc_attr_e( $edfm_menu_item_settings[0]['edfm_edit_menu_item_short_description'] ) : ''; ?>"/>
				</div>
			</div>
		</div>
		<div class="edfm-nav-menu-footer major-publishing-actions publishing-action">
			<div>
				<input type="submit" class="button button-primary button-large menu-save" value="<?php esc_attr_e( 'Save', 'eight-degree-fly-menu' ); ?>"/>
				<button class="button button-primary button-large edfm_close_btn"><?php esc_attr_e( 'Close after Save', 'eight-degree-fly-menu' ); ?></button><div class="edfm-spinner spinner" style="float:none;"></div>

		</div>
	</form>
</div>



