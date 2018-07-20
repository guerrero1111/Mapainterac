<?php
/* 
 * Eight Degree Fly Menu - Toggle Button Options
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$edfm_toggle_custom_element = isset( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element'] ) : 0;
$edfm_toggle_custom_element_id = isset( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element_id'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element_id'] ) : '';
$edfm_button_behavior = isset( $edfm_fly_menu_settings[0]['edfm_button_behavior'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_button_behavior'] ) : 'edfm_button_fix';

$edfm_toggle_icon_type = isset( $edfm_fly_menu_settings[0]['edfm_toggle_icon_type'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_icon_type'] ) : 'edfm_hamburger_toggle_icon';
$edfm_toggle_default_close = isset( $edfm_fly_menu_settings[0]['edfm_toggle_default_close'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_default_close'] ) : '';
$edfm_toggle_default_open = isset( $edfm_fly_menu_settings[0]['edfm_toggle_default_open'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_default_open'] ) : '';
$edfm_toggle_background = isset( $edfm_fly_menu_settings[0]['edfm_toggle_background'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_background'] ) : '';
$edfm_toggle_open_color = isset( $edfm_fly_menu_settings[0]['edfm_toggle_open_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_open_color'] ) : '';
$edfm_toggle_close_color = isset( $edfm_fly_menu_settings[0]['edfm_toggle_close_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_close_color'] ) : '';
$edfm_toggle_hover_color = isset( $edfm_fly_menu_settings[0]['edfm_toggle_hover_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_hover_color'] ) : '';

$edfm_toggle_width = isset( $edfm_fly_menu_settings[0]['edfm_toggle_width'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_width'] ) : '';
$edfm_toggle_border = isset( $edfm_fly_menu_settings[0]['edfm_toggle_border'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_border'] ) : '';
$edfm_toggle_border_color = isset( $edfm_fly_menu_settings[0]['edfm_toggle_border_color'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_border_color'] ) : '';
$edfm_toggle_border_radius = isset( $edfm_fly_menu_settings[0]['edfm_toggle_border_radius'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_border_radius'] ) : '';
$edfm_toggle_top = isset( $edfm_fly_menu_settings[0]['edfm_toggle_top'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_top'] ) : '';
$edfm_toggle_left = isset( $edfm_fly_menu_settings[0]['edfm_toggle_left'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_left'] ) : '';

$edfm_toggle_type = isset( $edfm_fly_menu_settings[0]['edfm_toggle_type'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_type'] ) : 'edfm_toggle_default';


?>
<div class="edfm-postbox-section">
	<div class="edfm-postbox-fields edfm-toggle-behavior">
		<h4><?php _e( 'Toggle Button Settings', 'eight-degree-fly-menu' ); ?></h4>
		<div class="edfm-postbox-radio-field">
			<input type="radio" name="edfm_toggle_type" class="edfm-toggle-type" id="edfm_toggle_default" value="edfm_toggle_default" <?php if ( $edfm_toggle_type == "edfm_toggle_default" ) echo 'checked'; ?>/>
			<label for="edfm_toggle_default"><?php _e( 'Default', 'eight-degree-fly-menu' ); ?></label>
		</div>
		<div class="edfm-postbox-radio-field">
			<input type="radio" name="edfm_toggle_type" class="edfm-toggle-type" id="edfm_toggle_custom" value="edfm_toggle_custom" <?php if ( $edfm_toggle_type == "edfm_toggle_custom" ) echo 'checked'; ?>/>
			<label for="edfm_toggle_custom"><?php _e( 'Custom', 'eight-degree-fly-menu' ); ?></label>
		</div>
		<p class="description">
			<?php _e( 'Choose Default to use pre-defined toggle  button or choose Custom to change toggle button colors, fonts, positions etc.', 'eight-degree-fly-menu' ); ?>
		</p>
	</div>
</div>
<div class="edfm-postbox-section" <?php if ( $edfm_toggle_type == 'edfm_toggle_default' ) echo 'style="display:none;"'; ?>>
	<div class="edfm-postbox-fields">
		<div class="edfm-label-info-wrap">
			<label><?php _e( 'Define Custom Toggle Element', 'eight-degree-fly-menu' ); ?></label>
		</div>	
		<div class="edfm-slide-checkbox-wrapper">
			<div class="edfm-slide-checkbox-wrapper-inner">
				<div class="edfm-slide-checkbox">  
					<input type="checkbox" name="edfm_toggle_custom_element" id="edfm_toggle_custom_element" <?php if ( $edfm_toggle_custom_element == '1' ) _e( 'checked' ); ?>>
					<label for="edfm_toggle_custom_element"></label>
				</div>
			</div>
		</div>
		<div class="edfm-description"><?php _e('Use any element to trigger the menu. Turn on and specify the ID of the element you want to use to trigger the menu.','eight-degree-fly-menu');?></div>
	</div>
	<div class="edfm-postbox-fields edfm_toggle_custom_element_id" <?php if($edfm_toggle_custom_element != 1) echo 'style="display:none;"'; ?>>
		<label><?php _e( 'Custom Toggle Element ID', 'eight-degree-fly-menu' ); ?></label>
		<input type="text" name="edfm_toggle_custom_element_id" value="<?php esc_attr_e( $edfm_toggle_custom_element_id ); ?>" placeholder="<?php _e('For example: my-toggle-button','eight-degree-fly-menu');?>">
	</div>
	<div class="edfm-postbox-fields edfm-toggle-behavior">
		<label><?php _e( 'Toggle Button Behavior', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_button_behavior" id="edfm_button_fix" value="edfm_button_fix" <?php if ( $edfm_button_behavior == "edfm_button_fix" ) echo 'checked'; ?>/>
			<label for="edfm_button_fix">
				<?php _e( 'Fixed', 'eight-degree-fly-menu' ); ?>
			</label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_button_behavior" id="edfm_button_scroll" value="edfm_button_scroll" <?php if ( $edfm_button_behavior == "edfm_button_scroll" ) echo 'checked'; ?>/>
			<label for="edfm_button_scroll">
				<?php _e( 'Scroll', 'eight-degree-fly-menu' ); ?>
			</label>
		</div>
		<div class="edfm-postbox-fields-radio">
			<input type="radio" name="edfm_button_behavior" id="edfm_button_hide" value="edfm_button_hide" <?php if ( $edfm_button_behavior == "edfm_button_hide" ) echo 'checked'; ?>/>
			<label for="edfm_button_hide">
				<?php _e( 'Hide', 'eight-degree-fly-menu' ); ?>
			</label>
		</div>
		<div class="edfm-description"><?php _e('Choose to fix the toggle button on your page or make it scrollable or hide the button. Hide option can be useful while using the custom toggle element option to initially hide the toggle icon.','eight-degree-fly-menu');?></div>
	</div>
	<div class="edfm-postbox-fields edfm-toggle-behavior">
		<label><?php _e( 'Choose Button Icon Source', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-postbox-radio-field">
			<input type="radio" name="edfm_toggle_icon_type" class="edfm-button-icon" id="Default Icon Set" value="edfm_default_toggle_icon" <?php if ( $edfm_toggle_icon_type == 'edfm_default_toggle_icon' ) _e( 'checked' ); ?>><label for="Default Icon Set"><?php _e( 'Default Icon Set', 'eight-degree-fly-menu' ); ?></label>
		</div>
		<div class="edfm-postbox-radio-field">
			<input type="radio" name="edfm_toggle_icon_type" class="edfm-button-icon" id="Simple Hamburger" value="edfm_hamburger_toggle_icon" <?php if ( $edfm_toggle_icon_type == 'edfm_hamburger_toggle_icon' ) _e( 'checked' ); ?>><label for="Simple Hamburger"><?php _e( 'Simple Hamburger', 'eight-degree-fly-menu' ); ?></label>
		</div>
	</div>
	<div class="edfm-default-icon-set" <?php if($edfm_toggle_icon_type != 'edfm_default_toggle_icon') echo 'style="display:none;"'; ?>>
		<div class="edfm-postbox-fields">
			<label><?php _e( 'Menu Close Button Icon', 'eight-degree-fly-menu' ); ?></label>
			<div id="edfm-menu-close-div" data-target="#edfm_toggle_default_close" class="button icon-picker 
			<?php
			if ( isset( $edfm_toggle_default_close ) ) {
				$v = explode( '|', $edfm_toggle_default_close );
				echo $v[0];
				if(isset($v[1])) echo ' '.$v[1];
			}
			?>"></div>
			<input class="edfm-icon-picker" type="text" name="edfm_toggle_default_close" id="edfm_toggle_default_close" value="<?php esc_attr_e( $edfm_toggle_default_close ); ?>"/>
		</div>
		<div class="edfm-postbox-fields">
			<label><?php _e( 'Menu Open Button Icon', 'eight-degree-fly-menu' ); ?></label>
			<div id="edfm-menu-open-div" data-target="#edfm_toggle_default_open" class="button icon-picker 
			<?php
			if ( isset( $edfm_toggle_default_open ) ) {
				$v = explode( '|', $edfm_toggle_default_open );
				echo $v[0];
				if(isset($v[1])) echo ' '.$v[1];
			}
			?>">
		</div>
		<input class="edfm-icon-picker" type="text" name="edfm_toggle_default_open" id="edfm_toggle_default_open" value="<?php esc_attr_e( $edfm_toggle_default_open ); ?>"/>
	</div>
</div>
<div class="edfm-toggle-option">
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Button Background color', 'ultimate-author-box' ); ?></label>
		<input type="text" name="edfm_toggle_background" data-alpha="true" class="edfm-color-picker" value="<?php esc_attr_e( $edfm_toggle_background ); ?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Icon open color', 'ultimate-author-box' ); ?></label>
		<input type="text" name="edfm_toggle_open_color" data-alpha="true" class="edfm-color-picker" value="<?php esc_attr_e( $edfm_toggle_open_color ); ?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Icon close color', 'ultimate-author-box' ); ?></label>
		<input type="text" name="edfm_toggle_close_color" data-alpha="true" class="edfm-color-picker" value="<?php esc_attr_e( $edfm_toggle_close_color ); ?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Icon hover color', 'ultimate-author-box' ); ?></label>
		<input type="text" name="edfm_toggle_hover_color" data-alpha="true" class="edfm-color-picker" value="<?php esc_attr_e( $edfm_toggle_hover_color ); ?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Button width', 'ultimate-author-box' ); ?></label>
		<input type="number" name="edfm_toggle_width" min="0" value="<?php esc_attr_e( $edfm_toggle_width ); ?>" placeholder="<?php esc_attr_e('40 px');?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Button border', 'ultimate-author-box' ); ?></label>
		<input type="number" name="edfm_toggle_border" min="0" value="<?php esc_attr_e( $edfm_toggle_border ); ?>" placeholder="<?php esc_attr_e('1 px');?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Border color', 'ultimate-author-box' ); ?></label>
		<input type="text" name="edfm_toggle_border_color" data-alpha="true" class="edfm-color-picker" value="<?php esc_attr_e( $edfm_toggle_border_color ); ?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Button border radius', 'ultimate-author-box' ); ?></label>
		<input type="number" name="edfm_toggle_border_radius" min="0" value="<?php esc_attr_e( $edfm_toggle_border_radius ); ?>" placeholder="<?php esc_attr_e('1 %');?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Button Position Top', 'ultimate-author-box' ); ?></label>
		<input type="number" name="edfm_toggle_top" value="<?php esc_attr_e( $edfm_toggle_top ); ?>" placeholder="<?php esc_attr_e('2 px');?>">
	</div>
	<div class="edfm-postbox-fields">
		<label><?php _e( 'Button Position Left', 'ultimate-author-box' ); ?></label>
		<input type="number" name="edfm_toggle_left" value="<?php esc_attr_e( $edfm_toggle_left ); ?>" placeholder="<?php esc_attr_e('1 px');?>">
	</div>
</div>
</div>