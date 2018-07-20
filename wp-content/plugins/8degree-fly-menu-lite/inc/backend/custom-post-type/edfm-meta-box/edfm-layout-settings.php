<?php 
/* 
 * Eight Degree Fly Menu - Fly Menu layout settings
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$edfm_menu_layout = isset( $edfm_fly_menu_settings[0]['edfm_menu_layout'] )? $edfm_fly_menu_settings[0]['edfm_menu_layout']:'edfm_side_menu';
?>
<div class="edfm-postbox-section">
	<h4><?php _e( 'Layout Settings', 'eight-degree-fly-menu' ); ?></h4>
	<div class="edfm-postbox-content">
		<p class="description"><?php _e('In this section you can configure the layout of the Fly menu. Choose any of the Four Layouts')?></p>
	</div>
</div>

<div class="edfm-postbox-fields-radio ">
	<input class="edfm-menu-layout" type="radio" value="edfm_side_menu" name="edfm_menu_layout" id="edfm_menu_layout_1" 
		<?php if ( $edfm_menu_layout == 'edfm_side_menu' ) _e('checked'); ?>>
	<label for="edfm_menu_layout_1">
		<?php _e( 'Full Side Menu', 'eight-degree-fly-menu' ); ?>
	</label>
</div>
<div class="edfm-postbox-fields-radio">
	<input class="edfm-menu-layout" type="radio" value="edfm_skewed_menu" name="edfm_menu_layout" id="edfm_menu_layout_4" <?php if ( $edfm_menu_layout == 'edfm_skewed_menu' ) _e('checked'); ?>>
	<label for="edfm_menu_layout_4">
		<?php _e( 'Skewed Menu', 'eight-degree-fly-menu' ); ?>
	</label>
</div>
<?php
include(EDFML_PATH . 'inc/backend/custom-post-type/edfm-meta-box/edfm-layout/edfm-full-side-menu.php');
include(EDFML_PATH . 'inc/backend/custom-post-type/edfm-meta-box/edfm-layout/edfm-skew-menu.php');
?>

