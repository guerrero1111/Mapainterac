<?php
/* 
 * Eight Degree Fly Menu - Menu color customization options
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$edfm_template_type = isset( $edfm_fly_menu_settings[0]['edfm_template_type'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_template_type'] ) : 'edfm_template_default';

$edfm_font_family = isset( $edfm_fly_menu_settings[0]['edfm_font_family'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_font_family'] ) : 'Roboto';

$edfm_font_weight = isset( $edfm_fly_menu_settings[0]['edfm_font_weight'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_font_weight'] ) : '';

$edfm_text_transform = isset( $edfm_fly_menu_settings[0]['edfm_text_transform'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_text_transform'] ) : 'normal';

$edfm_header_text_align = isset( $edfm_fly_menu_settings[0]['edfm_header_text_align'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_header_text_align'] ) : '';
$edfm_body_text_align = isset( $edfm_fly_menu_settings[0]['edfm_body_text_align'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_body_text_align'] ) : '';
$edfm_footer_text_align = isset( $edfm_fly_menu_settings[0]['edfm_footer_text_align'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_footer_text_align'] ) : '';

$edfm_font_color = isset( $edfm_fly_menu_settings[0]['edfm_font_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_font_color'] ) : '';

$edfm_parent_background_type = isset( $edfm_fly_menu_settings[0]['edfm_parent_background_type'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_background_type'] ) : 'edfm_parent_color_background';
$edfm_parent_background_color = isset( $edfm_fly_menu_settings[0]['edfm_parent_background_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_background_color'] ) : '';

$edfm_parent_right_background_color = isset( $edfm_fly_menu_settings[0]['edfm_parent_right_background_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_right_background_color'] ) : '';

$edfm_parent_background_image_url = isset( $edfm_fly_menu_settings[0]['edfm_parent_background_image_url'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_background_image_url'] ) : '';

$edfm_child_color_background = isset( $edfm_fly_menu_settings[0]['edfm_child_color_background'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_color_background'] ) : '';

$edfm_child_font_color = isset( $edfm_fly_menu_settings[0]['edfm_child_font_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_font_color'] ) : '';

$edfm_parent_hover_color = isset( $edfm_fly_menu_settings[0]['edfm_parent_hover_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_hover_color'] ) : '';

$edfm_parent_hover_bg_color = isset( $edfm_fly_menu_settings[0]['edfm_parent_hover_bg_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_parent_hover_bg_color'] ) : '';

$edfm_child_background_color = isset( $edfm_fly_menu_settings[0]['edfm_child_background_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_background_color'] ) : '';

$edfm_child_hover_color = isset( $edfm_fly_menu_settings[0]['edfm_child_hover_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_hover_color'] ) : '';

$edfm_child_notification_background_color = isset( $edfm_fly_menu_settings[0]['edfm_child_notification_background_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_notification_background_color'] ) : '';
$edfm_child_notification_font_color = isset( $edfm_fly_menu_settings[0]['edfm_child_notification_font_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_child_notification_font_color'] ) : '';

$edfm_default_nav_icon_options = isset( $edfm_fly_menu_settings[0]['edfm_default_nav_icon_options'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_default_nav_icon_options'] ) : 'fa-angle-right';
?>
<div class="edfm-postbox-section">
	<div class="edfm-postbox-fields edfm-toggle-behavior">
		<h4><?php _e( 'Select Template type', 'eight-degree-fly-menu' ); ?></h4>
		<div class="edfm-postbox-radio-field">
			<input type="radio" name="edfm_template_type" class="edfm-template-type" id="edfm_template_default" value="edfm_template_default" <?php if ( $edfm_template_type == "edfm_template_default" ) echo 'checked'; ?>/>
			<label for="edfm_template_default"><?php _e( 'Default', 'eight-degree-fly-menu' ); ?></label>
		</div>
		<div class="edfm-postbox-radio-field">
			<input type="radio" name="edfm_template_type" class="edfm-template-type" id="edfm_template_custom" value="edfm_template_custom" <?php if ( $edfm_template_type == "edfm_template_custom" ) echo 'checked'; ?>/>
			<label for="edfm_template_custom"><?php _e( 'Custom', 'eight-degree-fly-menu' ); ?></label>
		</div>
		<p class="description">
			<?php _e( 'Choose Default to use pre-defined fly template or choose Custom to change menu colors, fonts, etc.', 'eight-degree-fly-menu' ); ?>
		</p>
	</div>
</div>
<div class="edfm-postbox-section edfm-postbox-inline" <?php if ( $edfm_template_type == 'edfm_template_default' ) echo 'style="display:none;"'; ?>>
	<h4><?php _e( 'Menu Font Settings', 'eight-degree-fly-menu' ); ?></h4>

	<div class="edfm-postbox-fields">
		<label><?php _e( 'Font Family', 'eight-degree-fly-menu' ); ?></label>
		<select class="typography-selected" name="edfm_font_family">
			<option value="Abril Fatface" <?php if ( $edfm_font_family =='Abril Fatface' ) _e( 'selected' ); ?>><?php _e( 'Abril Fatface' ); ?></option>
			<option value="Amatic SC" <?php if ( $edfm_font_family =='Amatic SC' ) _e( 'selected' ); ?>><?php _e( 'Amatic SC' ); ?></option>
			<option value="Arimo" <?php if ( $edfm_font_family =='Arimo' ) _e( 'selected' ); ?>><?php _e( 'Arimo' ); ?></option>
			<option value="Arvo" <?php if ( $edfm_font_family =='Arvo' ) _e( 'selected' ); ?>><?php _e( 'Arvo' ); ?></option>
			<option value="Cabin" <?php if ( $edfm_font_family =='Cabin' ) _e( 'selected' ); ?>><?php _e( 'Cabin' ); ?></option>
			<option value="Droid Sans" <?php if ( $edfm_font_family =='Droid Sans' ) _e( 'selected' ); ?>><?php _e( 'Droid Sans' ); ?></option>
			<option value="Droid Serif" <?php if ( $edfm_font_family =='Droid Serif' ) _e( 'selected' ); ?>><?php _e( 'Droid Serif' ); ?></option>
			<option value="Fira Sans" <?php if ( $edfm_font_family =='Fira Sans' ) _e( 'selected' ); ?>><?php _e( 'Fira Sans' ); ?></option>
			<option value="Great Vibes" <?php if ( $edfm_font_family =='Great Vibes' ) _e( 'selected' ); ?>><?php _e( 'Great Vibes' ); ?></option>
			<option value="Italianno" <?php if ( $edfm_font_family =='Italianno' ) _e( 'selected' ); ?>><?php _e( 'Italianno' ); ?></option>
			<option value="Josefin Sans" <?php if ( $edfm_font_family =='Josefin Sans' ) _e( 'selected' ); ?>><?php _e( 'Josefin Sans' ); ?></option>
			<option value="Josefin Slab" <?php if ( $edfm_font_family =='Josefin Slab' ) _e( 'selected' ); ?>><?php _e( 'Josefin Slab' ); ?></option>
			<option value="Lato" <?php if ( $edfm_font_family =='Lato' ) _e( 'selected' ); ?>><?php _e( 'Lato' ); ?></option>
			<option value="Lora" <?php if ( $edfm_font_family =='Lora' ) _e( 'selected' ); ?>><?php _e( 'Lora' ); ?></option>
			<option value="Merriweather" <?php if ( $edfm_font_family =='Merriweather' ) _e( 'selected' ); ?>><?php _e( 'Merriweather' ); ?></option>
			<option value="Montserrat" <?php if ( $edfm_font_family =='Montserrat' ) _e( 'selected' ); ?>><?php _e( 'Montserrat' ); ?></option>
			<option value="Old Standard TT" <?php if ( $edfm_font_family =='Old Standard TT' ) _e( 'selected' ); ?>><?php _e( 'Old Standard TT' ); ?></option>
			<option value="Open Sans" <?php if ( $edfm_font_family =='Open Sans' ) _e( 'selected' ); ?>><?php _e( 'Open Sans' ); ?></option>
			<option value="PT Sans" <?php if ( $edfm_font_family =='PT Sans' ) _e( 'selected' ); ?>><?php _e( 'PT Sans' ); ?></option>
			<option value="PT Sans Narrow" <?php if ( $edfm_font_family =='PT Sans Narrow' ) _e( 'selected' ); ?>><?php _e( 'PT Sans Narrow' ); ?></option>
			<option value="PT Serif" <?php if ( $edfm_font_family =='PT Serif' ) _e( 'selected' ); ?>><?php _e( 'PT Serif' ); ?></option>
			<option value="Raleway" <?php if ( $edfm_font_family =='Raleway' ) _e( 'selected' ); ?>><?php _e( 'Raleway' ); ?></option>
			<option value="Roboto" <?php if ( $edfm_font_family =='Roboto' ) _e( 'selected' ); ?>><?php _e( 'Roboto' ); ?></option>
			<option value="Roboto Condensed" <?php if ( $edfm_font_family =='Roboto Condensed' ) _e( 'selected' ); ?>><?php _e( 'Roboto Condensed' ); ?></option>
			<option value="Roboto Slab" <?php if ( $edfm_font_family =='Roboto Slab' ) _e( 'selected' ); ?>><?php _e( 'Roboto Slab' ); ?></option>
			<option value="Rubik" <?php if ( $edfm_font_family =='Rubik' ) _e( 'selected' ); ?>><?php _e( 'Rubik' ); ?></option>
			<option value="Signika" <?php if ( $edfm_font_family =='Signika' ) _e( 'selected' ); ?>><?php _e( 'Signika' ); ?></option>
			<option value="Ubuntu" <?php if ( $edfm_font_family =='Ubuntu' ) _e( 'selected' ); ?>><?php _e( 'Ubuntu' ); ?></option>
			<option value="Varela Round" <?php if ( $edfm_font_family =='Varela Round' ) _e( 'selected' ); ?>><?php _e( 'Varela Round' ); ?></option>
			<option value="Vollkorn" <?php if ( $edfm_font_family =='Vollkorn' ) _e( 'selected' ); ?>><?php _e( 'Vollkorn' ); ?></option>
		</select> 
		
		<?php //$this->print_array($edfm_variant);?>
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Text Transform', 'ultimate-author-box' ); ?></label>
		<select class="edfm-menu-layout edfm_text_transform" name="edfm_text_transform">
			<option value="normal" <?php if ( $edfm_text_transform == 'normal' ) _e( 'selected' ); ?>><?php _e( 'Normal', 'eight-degree-fly-menu' ); ?></option>
			<option value="uppercase"<?php if ( $edfm_text_transform == 'uppercase' ) _e( 'selected' ); ?>><?php _e( 'Uppercase', 'eight-degree-fly-menu' ); ?></option>
			<option value="lowercase" <?php if ( $edfm_text_transform == 'lowercase' ) _e( 'selected' ); ?>><?php _e( 'Lowercase', 'eight-degree-fly-menu' ); ?></option>
			<option value="capitalize" <?php if ( $edfm_text_transform == 'capitalize' ) _e( 'selected' ); ?>><?php _e( 'Capitalize', 'eight-degree-fly-menu' ); ?></option>
		</select>
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Font Weight', 'ultimate-author-box' ); ?></label>
		<select class="edfm-menu-layout edfm_text_transform" name="edfm_font_weight">
			<option value="100" <?php if ( $edfm_font_weight == '100' ) _e( 'selected' ); ?>><?php _e( '100', 'eight-degree-fly-menu' ); ?></option>
			<option value="200"<?php if ( $edfm_font_weight == '200' ) _e( 'selected' ); ?>><?php _e( '200', 'eight-degree-fly-menu' ); ?></option>
			<option value="300" <?php if ( $edfm_font_weight == '300' ) _e( 'selected' ); ?>><?php _e( '300', 'eight-degree-fly-menu' ); ?></option>
			<option value="400" <?php if ( $edfm_font_weight == '400' ) _e( 'selected' ); ?>><?php _e( '400', 'eight-degree-fly-menu' ); ?></option>
			<option value="500" <?php if ( $edfm_font_weight == '500' ) _e( 'selected' ); ?>><?php _e( '500', 'eight-degree-fly-menu' ); ?></option>
			<option value="600"<?php if ( $edfm_font_weight == '600' ) _e( 'selected' ); ?>><?php _e( '600', 'eight-degree-fly-menu' ); ?></option>
			<option value="700" <?php if ( $edfm_font_weight == '700' ) _e( 'selected' ); ?>><?php _e( '700', 'eight-degree-fly-menu' ); ?></option>
			<option value="800" <?php if ( $edfm_font_weight == '800' ) _e( 'selected' ); ?>><?php _e( '800', 'eight-degree-fly-menu' ); ?></option>
			<option value="900" <?php if ( $edfm_font_weight == '900' ) _e( 'selected' ); ?>><?php _e( '900', 'eight-degree-fly-menu' ); ?></option>
		</select>
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Header Text Align', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_header_text_align" id="edfm_header_text_align_left" value="left" <?php if ( $edfm_header_text_align == "left" ) echo 'checked'; ?>/>
			<label for="edfm_header_text_align_left"><i class="fa fa-align-left"></i></label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_header_text_align" id="edfm_header_text_align_center" value="center" <?php if ( $edfm_header_text_align == "center" ) echo 'checked'; ?>/>
			<label for="edfm_header_text_align_center"><i class="fa fa-align-center"></i></label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_header_text_align" id="edfm_header_text_align_right" value="right" <?php if ( $edfm_header_text_align == "right" ) echo 'checked'; ?>/>
			<label for="edfm_header_text_align_right"><i class="fa fa-align-right"></i></label>
		</div>
	</div>

	<div class="edfm-postbox-fields">
		<label><?php _e( 'Body Text Align', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_body_text_align" id="edfm_body_text_align_left" value="left" <?php if ( $edfm_body_text_align == "left" ) echo 'checked'; ?>/>
			<label for="edfm_body_text_align_left"><i class="fa fa-align-left"></i></label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_body_text_align" id="edfm_body_text_align_center" value="center" <?php if ( $edfm_body_text_align == "center" ) echo 'checked'; ?>/>
			<label for="edfm_body_text_align_center"><i class="fa fa-align-center"></i></label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_body_text_align" id="edfm_body_text_align_right" value="right" <?php if ( $edfm_body_text_align == "right" ) echo 'checked'; ?>/>
			<label for="edfm_body_text_align_right"><i class="fa fa-align-right"></i></label>
		</div>
	</div>

	<div class="edfm-postbox-fields">
		<label><?php _e( 'Footer Text Align', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_footer_text_align" id="edfm_footer_text_align_left" value="left" <?php if ( $edfm_footer_text_align == "left" ) echo 'checked'; ?>/>
			<label for="edfm_footer_text_align_left"><i class="fa fa-align-left"></i></label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_footer_text_align" id="edfm_footer_text_align_center" value="center" <?php if ( $edfm_footer_text_align == "center" ) echo 'checked'; ?>/>
			<label for="edfm_footer_text_align_center"><i class="fa fa-align-center"></i></label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_footer_text_align" id="edfm_footer_text_align_right" value="right" <?php if ( $edfm_footer_text_align == "right" ) echo 'checked'; ?>/>
			<label for="edfm_footer_text_align_right"><i class="fa fa-align-right"></i></label>
		</div>
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Font Color', 'eight-degree-fly-menu' ); ?></label>
		<input type="text" name="edfm_font_color" data-alpha="true" class="edfm-color-picker edfm-font-color" value="<?php esc_attr_e( $edfm_font_color ); ?>">
	</div>
</div>

<div class="edfm-postbox-section edfm-postbox-inline" <?php if ( $edfm_template_type == 'edfm_template_default' ) echo 'style="display:none;"'; ?>>
	<h4><?php _e( 'Parent Menu Settings', 'eight-degree-fly-menu' ); ?></h4>
	<div class="edfm-postbox-color">
		<div class="edfm-toggle-tab-header">	
			<h4><?php _e( 'Color and Background', 'eight-degree-fly-menu' ); ?></h4>
		</div>
		<div class="edfm-postbox-fields edfm_parent_background_color" >	
			<label><?php _e( 'Background color', 'eight-degree-fly-menu' ); ?></label>
			<input type="text" name="edfm_parent_background_color" data-alpha="true" class="edfm-color-picker edfm-parent-bg-color" value="<?php esc_attr_e( $edfm_parent_background_color ); ?>">
		</div>
		
		<div class="edfm-postbox-fields edfm_parent_background_color" style="<?php if(!($edfm_menu_layout == 'edfm_full_screen_menu' && $edfm_full_menu_template == 'edfm_full_menu_template_2')) echo 'display:none';?>">	
			<label><?php _e( 'Right Background color', 'eight-degree-fly-menu' ); ?></label>
			<input type="text" name="edfm_parent_right_background_color" data-alpha="true" class="edfm-color-picker" value="<?php esc_attr_e( $edfm_parent_right_background_color ); ?>">
		</div>
		<div class="edfm-postbox-fields">	
			<label><?php _e( 'Background Type', 'eight-degree-fly-menu' ); ?></label>
			<select class="edfm-menu-layout edfm-background-type" name="edfm_parent_background_type">
				<option value="none" <?php if ( $edfm_parent_background_type == 'none' ) _e( 'selected' ); ?>><?php _e( 'None', 'eight-degree-fly-menu' ); ?></option>
				<option value="edfm_parent_image_background"<?php if ( $edfm_parent_background_type == 'edfm_parent_image_background' ) _e( 'selected' ); ?>><?php _e( 'Image Background', 'eight-degree-fly-menu' ); ?></option>
			</select>
		</div>
		<div class="edfm-postbox-fields edfm_background_type edfm_parent_background_image_url" <?php if($edfm_parent_background_type != 'edfm_parent_image_background') echo 'style="display:none;"'; ?>>	
			<label><?php _e( 'Image URL', 'eight-degree-fly-menu' ); ?></label>
			<input type="text" name="edfm_parent_background_image_url" class="edfm-background-upload-url" value="<?php esc_attr_e( $edfm_parent_background_image_url ); ?>">
			<button class="edfm-background-upload button-secondary"><i class="fa fa-upload" aria-hidden="true"></i></button>
			<div class="edfm-description"><?php _e( 'Click on icon to upload image from the library or directly insert the image URL. Recommended image size is 50x50 px.', 'eight-degree-fly-menu' ); ?></div>
		</div>
	</div>
	<div class="edfm-postbox-border">
		<div class="edfm-toggle-tab-header">	
			<h4><?php _e( 'Hover Settings', 'eight-degree-fly-menu' ); ?></h4>
		</div>
		<div class="edfm-postbox-fields">
			<label><?php _e( 'Menu Hover Color', 'eight-degree-fly-menu' ); ?></label>
			<input type="text" name="edfm_parent_hover_color" data-alpha="true" class="edfm-color-picker edfm-hover" value="<?php esc_attr_e( $edfm_parent_hover_color ); ?>">
		</div>
		<div class="edfm-postbox-fields">
			<label><?php _e( 'Menu Hover Background', 'eight-degree-fly-menu' ); ?></label>
			<input type="text" name="edfm_parent_hover_bg_color" data-alpha="true" class="edfm-bg_color-picker edfm-hover" value="<?php esc_attr_e( $edfm_parent_hover_bg_color ); ?>">
		</div>
	</div>
</div>

<div class="edfm-postbox-section edfm-postbox-inline" <?php if ( $edfm_template_type == 'edfm_template_default' ) echo 'style="display:none;"'; ?>>
	<h4><?php _e( 'Child Menus Settings', 'eight-degree-fly-menu' ); ?></h4>
	<div class="edfm-child-color">
		<div class="edfm-toggle-tab-header">	
			<h4><?php _e( 'Color and Background', 'eight-degree-fly-menu' ); ?></h4>
		</div>
		<div class="edfm-postbox-fields edfm_parent_background_color" >	
			<label><?php _e( 'Background color', 'eight-degree-fly-menu' ); ?></label>
			<input type="text" name="edfm_child_color_background" data-alpha="true" class="edfm-color-picker edfm-child-bg-color" value="<?php esc_attr_e( $edfm_child_color_background ); ?>">
		</div>
		<div class="edfm-postbox-fields edfm_parent_background_color" >	
			<label><?php _e( 'Font color', 'eight-degree-fly-menu' ); ?></label>
			<input type="text" name="edfm_child_font_color" data-alpha="true" class="edfm-color-picker" value="<?php esc_attr_e( $edfm_child_font_color ); ?>">
		</div>
	</div>
</div>
<div class="edfm-postbox-section">
	<h4><?php _e( 'Sub Menu Navigation Icon', 'eight-degree-fly-menu' ); ?></h4>
	<div class="edfm-postbox-fields edfm_nav_icon_option edfm_default_nav_icon_options">
		<label><?php _e( 'Choose Icon', 'eight-degree-fly-menu' ); ?></label>
		<?php
		$nav_icon_count = 0;
		$nav_icon_set = array( 'fa-angle-double-right', 'fa-angle-right', 'fa-arrow-right', 'fa-caret-right','fa-chevron-circle-right', 'fa-chevron-right', 'fa-play', 'fa-play-circle', 'fa-play-circle-o', 'fa-plus-circle');
		foreach ( $nav_icon_set as $nav_icon ) {
			?>
			<div class="edfm-postbox-fields-radio">
				<input type="radio" name="edfm_default_nav_icon_options" id="edfm_default_nav_icon_options_<?php esc_attr_e( $nav_icon_count ); ?>" value="<?php esc_attr_e( $nav_icon ); ?>" <?php if ( $nav_icon == $edfm_default_nav_icon_options ) echo 'checked'; ?>/>
				<label for="edfm_default_nav_icon_options_<?php esc_attr_e( $nav_icon_count ); ?>">
					<i class="fa <?php esc_attr_e( $nav_icon ); ?>"></i>
				</label>
			</div>
			<?php $nav_icon_count++;
		} ?>
	</div>
</div>

