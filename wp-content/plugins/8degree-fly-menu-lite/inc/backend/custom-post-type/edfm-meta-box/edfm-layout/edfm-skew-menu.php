<?php
/* 
 * Eight Degree Fly Menu - Skew Menu Options
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$edfm_skew_menu_template = isset($edfm_fly_menu_settings[0]['edfm_skew_menu_template'])?$edfm_fly_menu_settings[0]['edfm_skew_menu_template']:'edfm_skew_menu_template_1';
$edfm_skew_menu_position = isset($edfm_fly_menu_settings[0]['edfm_skew_menu_position'])?$edfm_fly_menu_settings[0]['edfm_skew_menu_position']:'edfm_position_left';
$edfm_skew_menu_sub_menu_type = isset($edfm_fly_menu_settings[0]['edfm_skew_menu_sub_menu_type'])?$edfm_fly_menu_settings[0]['edfm_skew_menu_sub_menu_type']:'edfm_drop';
$edfm_skew_menu_animation = isset($edfm_fly_menu_settings[0]['edfm_skew_menu_animation'])?$edfm_fly_menu_settings[0]['edfm_skew_menu_animation']:'edfm_skew_menu_animation_1';
$edfm_skew_menu_sub_menu_animation = isset($edfm_fly_menu_settings[0]['edfm_skew_menu_sub_menu_animation'])?$edfm_fly_menu_settings[0]['edfm_skew_menu_sub_menu_animation']:'edfm_skew_menu_sub_menu_animation_1';
$edfm_skew_menu_item_animation = isset($edfm_fly_menu_settings[0]['edfm_skew_menu_item_animation'])?$edfm_fly_menu_settings[0]['edfm_skew_menu_item_animation']:'edfm_skew_menu_item_animation_1';
$edfm_skew_menu_blur_effect = isset($edfm_fly_menu_settings[0]['edfm_skew_menu_blur_effect'])?$edfm_fly_menu_settings[0]['edfm_skew_menu_blur_effect']:0;
?>
<div class="edfm-postbox-section edfm-postbox-fields-layout-content edfm-postbox-fields-layout-skew-menu-content"
<?php 

if(isset($edfm_fly_menu_settings[0]['edfm_menu_layout'])){
	if($edfm_fly_menu_settings[0]['edfm_menu_layout']!= 'edfm_skewed_menu'){
		echo 'style="display:none;"';
	}
}else{
	echo 'style="display:none;"';
}

?>
>
<h4><?php _e('Skew Menu');?></h4>
<div class="edfm-postbox-fields edfm-icon-radio">
	<label><?php _e( 'Choose Template', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-postbox-fields-radio">
		<input type="radio" name="edfm_skew_menu_template" id="edfm_skew_menu_template_1" value="edfm_skew_menu_template_1" <?php if ( $edfm_skew_menu_template == "edfm_skew_menu_template_1" ) echo 'checked'; ?>/>
		<label for="edfm_skew_menu_template_1">
			<img src="<?php echo EDFML_IMG_DIR.'/edfm-backend-icons/edfm-skew-left.png';?>" alt="<?php _e( 'Left', 'eight-degree-fly-menu' ); ?>"><span><?php _e( 'Forward Skew', 'eight-degree-fly-menu' ); ?></span>
		</label>
	</div>
		<div class="edfm-postbox-fields-radio">
		<input type="radio" name="edfm_skew_menu_template" id="edfm_skew_menu_template_2" value="edfm_skew_menu_template_2" <?php if ( $edfm_skew_menu_template == "edfm_skew_menu_template_2" ) echo 'checked'; ?>/>
		<label for="edfm_skew_menu_template_2">
			<img src="<?php echo EDFML_IMG_DIR.'/edfm-backend-icons/edfm-skew-right.png';?>" alt="<?php _e( 'Left', 'eight-degree-fly-menu' ); ?>"><span><?php _e( 'Backward Skew', 'eight-degree-fly-menu' ); ?></span>
		</label>
	</div>
</div>
<div class="edfm-postbox-fields edfm-icon-radio">
	<label><?php _e( 'Menu Position', 'eight-degree-fly-menu' ); ?></label>
	<div class="edfm-postbox-fields-radio">
		<input type="radio" name="edfm_skew_menu_position" id="edfm_skew_position_left" value="edfm_position_left" <?php if ( $edfm_skew_menu_position == "edfm_position_left" ) echo 'checked'; ?>/>
		<label for="edfm_skew_position_left">
			<img src="<?php echo EDFML_IMG_DIR.'/edfm-backend-icons/edfm-left.png';?>" alt="<?php _e( 'Left', 'eight-degree-fly-menu' ); ?>"><span><?php _e( 'Left', 'eight-degree-fly-menu' ); ?></span>
		</label>
	</div>
	<div class="edfm-postbox-fields-radio">
		<input type="radio" name="edfm_skew_menu_position" id="edfm_skew_position_right" value="edfm_position_right" <?php if ( $edfm_skew_menu_position == "edfm_position_right" ) echo 'checked'; ?>/>
		<label for="edfm_skew_position_right">
			<img src="<?php echo EDFML_IMG_DIR.'/edfm-backend-icons/edfm-right.png';?>" alt="<?php _e( 'Right', 'eight-degree-fly-menu' ); ?>"><span><?php _e( 'Right', 'eight-degree-fly-menu' ); ?></span>
		</label>
	</div>
</div>
<div class="edfm-postbox-fields edfm-icon-radio">	
	<label><?php _e( 'Sub Menu Type', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-postbox-fields-radio">
		<input type="radio" name="edfm_skew_menu_sub_menu_type" id="edfm_skew_drop" value="edfm_drop" <?php if ( $edfm_skew_menu_sub_menu_type == "edfm_drop" ) echo 'checked'; ?>/>
		<label for="edfm_skew_drop">
			<img src="<?php echo EDFML_IMG_DIR.'/edfm-backend-icons/edfm-drop.png';?>" alt="<?php _e( 'Drop', 'eight-degree-fly-menu' ); ?>"><span><?php _e( 'Drop Sub Menu', 'eight-degree-fly-menu' ); ?></span>
		</label>
	</div>
</div>
<div class="edfm-postbox-fields"><h4><?php _e( 'Animation Settings' , 'eight-degree-fly-menu' ); ?></h4></div>
<div class="edfm-postbox-fields">	
	<label><?php _e( 'Menu Animation', 'eight-degree-fly-menu' ); ?></label>
	<select class="edfm-menu-animation" name="edfm_skew_menu_animation">
		<option value="edfm_skew_menu_animation_1" <?php if($edfm_skew_menu_animation == 'edfm_skew_menu_animation_1') _e('selected');?>><?php _e( 'Slide Overlap', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_animation_2" <?php if($edfm_skew_menu_animation == 'edfm_skew_menu_animation_2') _e('selected');?>><?php _e( 'Push Content', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_animation_3" <?php if($edfm_skew_menu_animation == 'edfm_skew_menu_animation_3') _e('selected');?>><?php _e( 'Flip in', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_animation_4" <?php if($edfm_skew_menu_animation == 'edfm_skew_menu_animation_4') _e('selected');?>><?php _e( 'Drop', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_animation_5" <?php if($edfm_skew_menu_animation == 'edfm_skew_menu_animation_5') _e('selected');?>><?php _e( 'Fade', 'eight-degree-fly-menu' ); ?></option>
	</select>
</div>
<div class="edfm-postbox-fields">	
	<label><?php _e( 'Sub Menu Animation', 'eight-degree-fly-menu' ); ?></label>
	<select class="edfm-sub-menu-animation" name="edfm_skew_menu_sub_menu_animation">
		<option value="edfm_skew_menu_sub_menu_animation_1" <?php if($edfm_skew_menu_sub_menu_animation == 'edfm_skew_menu_sub_menu_animation_1') _e('selected');?>><?php _e( 'Slide in Top', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_sub_menu_animation_2" <?php if($edfm_skew_menu_sub_menu_animation == 'edfm_skew_menu_sub_menu_animation_2') _e('selected');?>><?php _e( 'Slide in Left', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_sub_menu_animation_3" <?php if($edfm_skew_menu_sub_menu_animation == 'edfm_skew_menu_sub_menu_animation_3') _e('selected');?>><?php _e( 'Slide in Bottom', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_sub_menu_animation_4" <?php if($edfm_skew_menu_sub_menu_animation == 'edfm_skew_menu_sub_menu_animation_4') _e('selected');?>><?php _e( 'Slide in Right', 'eight-degree-fly-menu' ); ?></option>
	</select>
</div>
<div class="edfm-postbox-fields">	
	<label><?php _e( 'Menu Item Animation', 'eight-degree-fly-menu' ); ?></label>
	<select class="edfm-menu-position" name="edfm_skew_menu_item_animation">
		<option value="edfm_skew_menu_item_animation_1" <?php if($edfm_skew_menu_item_animation == 'edfm_skew_menu_item_animation_1') _e('selected');?>><?php _e( 'Move Forward', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_item_animation_2" <?php if($edfm_skew_menu_item_animation == 'edfm_skew_menu_item_animation_2') _e('selected');?>><?php _e( 'Butterfly', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_item_animation_3" <?php if($edfm_skew_menu_item_animation == 'edfm_skew_menu_item_animation_3') _e('selected');?>><?php _e( 'Stun', 'eight-degree-fly-menu' ); ?></option>
		<option value="edfm_skew_menu_item_animation_4" <?php if($edfm_skew_menu_item_animation == 'edfm_skew_menu_item_animation_4') _e('selected');?>><?php _e( 'Focus out', 'eight-degree-fly-menu' ); ?></option>
	</select>
</div>
<div class="edfm-postbox-fields">
	<div class="edfm-label-info-wrap">
		<label><?php _e('Content Blur Effect','eight-degree-fly-menu');?></label>
	</div>	
	<div class="edfm-slide-checkbox-wrapper">
		<div class="edfm-slide-checkbox-wrapper-inner">
			<div class="edfm-slide-checkbox">  
				<input type="checkbox" name="edfm_skew_menu_blur_effect" <?php if($edfm_skew_menu_blur_effect =='1') _e('checked');?>/>
				<label for="edfm-disable-edfm"></label>
			</div>
		</div>
	</div>
	
	
</div>
</div>