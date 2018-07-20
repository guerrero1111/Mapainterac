<?php
/* 
 * Eight Degree Fly Menu - Meta box Tab options
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
wp_nonce_field('edfm_save_custom_post_type_settings','edfm_meta_nonce');
$edfm_fly_menu_settings = get_post_meta($post->ID,'_edfm_select_menu');
$edfm_social_icons = get_post_meta($post->ID,'_edfm_social_icons');
$edfm_specific_pages = get_post_meta($post->ID,'_edfm_specific_pages');

//$this->print_array($edfm_fly_menu_settings);

?>
<div class="edfm-postbox-wrapper inside">
	<div class="edfm-postbox-wrapper-inner">
		<ul class="nav-tab-wrapper">
			<li class="nav-tab nav-tab-active" data-tab="edfm-tab-1"><?php _e( 'Build Fly Menu', 'eight-degree-fly-menu-lite' ); ?></li>
			<li class="nav-tab" data-tab="edfm-tab-2"><?php _e( 'Layout Settings', 'eight-degree-fly-menu-lite' ); ?></li>
			<li class="nav-tab" data-tab="edfm-tab-3"><?php _e( 'Font & Color', 'eight-degree-fly-menu-lite' ); ?></li>
			<li class="nav-tab" data-tab="edfm-tab-6"><?php _e( 'Toggle Button Settings', 'eight-degree-fly-menu-lite' ); ?></li>
			<li class="nav-tab" data-tab="edfm-tab-4"><?php _e( 'Display Settings', 'eight-degree-fly-menu-lite' ); ?></li>
			<li class="nav-tab" data-tab="edfm-tab-5"><?php _e( 'Custom CSS', 'eight-degree-fly-menu-lite' ); ?></li>

		</ul>	
		<div id="edfm-tab-1" class="edfm-tab-content edfm-current">
			<?php include(EDFML_PATH . '/inc/backend/custom-post-type/edfm-meta-box/edfm-build-fly-menu.php'); ?>
		</div>
		<div id="edfm-tab-2" class="edfm-tab-content">
			<?php include(EDFML_PATH . '/inc/backend/custom-post-type/edfm-meta-box/edfm-layout-settings.php'); ?>
		</div>
		<div id="edfm-tab-3" class="edfm-tab-content">
			<?php include(EDFML_PATH . '/inc/backend/custom-post-type/edfm-meta-box/edfm-font-settings.php'); ?>
		</div>
		<div id="edfm-tab-6" class="edfm-tab-content">
			<?php include(EDFML_PATH . '/inc/backend/custom-post-type/edfm-meta-box/edfm-button-settings.php'); ?>
		</div>
		<div id="edfm-tab-4" class="edfm-tab-content">
			<?php include(EDFML_PATH . '/inc/backend/custom-post-type/edfm-meta-box/edfm-display-settings.php'); ?>
		</div>
		<div id="edfm-tab-5" class="edfm-tab-content">
			<?php include(EDFML_PATH . '/inc/backend/custom-post-type/edfm-meta-box/edfm-custom-css.php'); ?>
		</div>

	</div>
</div>



