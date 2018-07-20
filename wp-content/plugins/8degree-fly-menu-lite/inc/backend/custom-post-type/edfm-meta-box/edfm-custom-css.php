<?php 
/* 
 * Eight Degree Fly Menu - Custom CSS Section
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); 
?>
<div class="edfm-postbox-section">
	<div class="edfm-postbox-fields">
		<h4><?php _e( 'Custom CSS Section', 'eight-degree-fly-menu' ); ?></h4>
		<label><?php _e( 'Enable Custom CSS Section', 'eight-degree-fly-menu' ); ?></label>
		<div class="edfm-slide-checkbox-wrapper">
		<div class="edfm-slide-checkbox-wrapper-inner">
			<div class="edfm-slide-checkbox">  
				<input type="checkbox" id="edfm-enable-custom-css" name="edfm_enable_custom_css" <?php if ( !empty($edfm_fly_menu_settings[0]['edfm_enable_custom_css'] )) echo 'checked'; ?>>
				<label for="edfm-enable-custom-css"></label>
			</div>
		</div>
	</div>
		<p class="description">
			<?php _e( 'Check to Enable Custom CSS Section', 'eight-degree-fly-menu' ); ?>
		</p>
	</div>

<div class="edfm-postbox-fields" <?php if (empty($edfm_fly_menu_settings[0]['edfm_enable_custom_css'] )) echo 'style="display:none;"'; ?>>
	<label for="edfm-codemirror-textarea">
		<h4><?php _e('Custom CSS');?></h4>
	</label>
	<textarea class="edfm-codemirror-textarea" name="edfm_custom_css"><?php echo isset($edfm_fly_menu_settings[0]['edfm_custom_css'])? wp_kses_post($edfm_fly_menu_settings[0]['edfm_custom_css']):'';?></textarea>
</div>
</div>