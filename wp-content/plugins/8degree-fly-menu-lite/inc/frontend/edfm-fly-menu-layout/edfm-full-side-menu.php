<?php
/* 
 * Eight Degree Fly Menu - Side Menu
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$edfm_side_menu_template = isset($edfm_fly_menu_settings[0]['edfm_side_menu_template'])? $edfm_fly_menu_settings[0]['edfm_side_menu_template']:'edfm_side_menu_template_1';
$edfm_side_menu_position = isset($edfm_fly_menu_settings[0]['edfm_side_menu_position'])? $edfm_fly_menu_settings[0]['edfm_side_menu_position']:'edfm_position_left';
$edfm_side_menu_sub_menu_type = isset($edfm_fly_menu_settings[0]['edfm_side_menu_sub_menu_type'])? $edfm_fly_menu_settings[0]['edfm_side_menu_sub_menu_type']:'edfm_push';
$edfm_side_menu_animation = isset($edfm_fly_menu_settings[0]['edfm_side_menu_animation'])? $edfm_fly_menu_settings[0]['edfm_side_menu_animation']:'edfm_side_menu_animation_1';
$edfm_side_menu_sub_menu_animation = isset($edfm_fly_menu_settings[0]['edfm_side_menu_sub_menu_animation'])? $edfm_fly_menu_settings[0]['edfm_side_menu_sub_menu_animation']:'edfm_side_menu_sub_menu_animation_1';
$edfm_side_menu_item_animation = isset($edfm_fly_menu_settings[0]['edfm_side_menu_item_animation'])? $edfm_fly_menu_settings[0]['edfm_side_menu_item_animation']:'edfm_side_menu_item_animation_1';
$edfm_side_menu_blur_effect = isset($edfm_fly_menu_settings[0]['edfm_side_menu_blur_effect'])? $edfm_fly_menu_settings[0]['edfm_side_menu_blur_effect']:0;

?>
<div class="edfm-fly-menu-wrapper edfm-<?php esc_attr_e($postid);?>
	<?php
	esc_attr_e(' '.$edfm_menu_layout.' '.$edfm_side_menu_template.' '.$edfm_side_menu_position.' '.$edfm_side_menu_sub_menu_type.' '.$edfm_side_menu_animation.' ');
	if($edfm_side_menu_blur_effect) esc_attr_e('edfm_blur_effect ');
	if($edfm_template_type != 'edfm_template_default') esc_attr_e($edfm_parent_background_type);
	?>"
	>
	<?php include(EDFML_PATH . '/inc/frontend/edfm-toggle-button.php');?>
	<div class="edfm-fly-menu-wrapper-inner">
		<?php if($edfm_fly_menu_settings[0]['edfm_enable_header']):?>
			<div class="edfm-fly-menu-header edfm-fly-menu-body-part">
			<?php 
			if (isset($edfm_fly_menu_settings[0]['edfm_top_text_option']) && !empty($edfm_fly_menu_settings[0]['edfm_top_text_option'])):
				if(! ($edfm_fly_menu_settings[0]['edfm_top_text_option'] == 'edfm-no-text')):
					?>
					
						<?php if(!empty($edfm_fly_menu_settings[0]['edfm_top_text_option'])):?>
							<div class="edfm-header-top-label">
								<?php
								switch($edfm_fly_menu_settings[0]['edfm_top_text_option']){
									case 'edfm-custom-title':
									if (isset($edfm_fly_menu_settings[0]['edfm_custom_top_text']) && isset($edfm_fly_menu_settings[0]['edfm_custom_top_tagline'])):
										?>
										<div class="edfm-header-title"><?php _e(sanitize_text_field($edfm_fly_menu_settings[0]['edfm_custom_top_text']));?></div>
										<div class="edfm-header-tagline"><?php _e(sanitize_text_field($edfm_fly_menu_settings[0]['edfm_custom_top_tagline']));?></div>
										<?php
									endif;
									break;
								}
								?>
							</div>
							<?php
						endif;
					endif;
				endif;
				?>
				<?php 
				if (isset($edfm_fly_menu_settings[0]['edfm_image_option']) && !empty($edfm_fly_menu_settings[0]['edfm_image_option'])):
					if(! ($edfm_fly_menu_settings[0]['edfm_image_option'] == 'edfm-no-image')):
						
						?>
						<div class="edfm-header-image">
							<?php
							switch($edfm_fly_menu_settings[0]['edfm_image_option']){
								case 'edfm-custom-image':

								if (isset($edfm_fly_menu_settings[0]['edfm_custom_header_image']) && !empty($edfm_fly_menu_settings[0]['edfm_custom_header_image'])):
									?>
									<img src="<?php esc_attr_e($edfm_fly_menu_settings[0]['edfm_custom_header_image']);?>"/>
									<?php
								endif;
								break;
							}
							?>
						</div>
						<?php
						
					endif;
				endif;
				?>
				<?php 
				if (isset($edfm_fly_menu_settings[0]['edfm_bottom_text_option']) && !empty($edfm_fly_menu_settings[0]['edfm_bottom_text_option'])):
					if(! ($edfm_fly_menu_settings[0]['edfm_bottom_text_option'] == 'edfm-no-text')):
						?>
						<div class="edfm-header-top-label">
							<?php
							switch($edfm_fly_menu_settings[0]['edfm_bottom_text_option']){
								case 'edfm-custom-title':
								if (isset($edfm_fly_menu_settings[0]['edfm_custom_bottom_text']) && isset($edfm_fly_menu_settings[0]['edfm_custom_bottom_tagline'])):
									?>
									<div class="edfm-header-title"><?php _e(sanitize_text_field($edfm_fly_menu_settings[0]['edfm_custom_bottom_text']));?></div>
									<div class="edfm-header-tagline"><?php _e(sanitize_text_field($edfm_fly_menu_settings[0]['edfm_custom_bottom_tagline']));?></div>
									<?php
								endif;
								break;
							}
							?>
						</div>
						<?php
					endif;
				endif;
				if (isset($edfm_fly_menu_settings[0]['edfm_enable_top_search_form']) && !empty($edfm_fly_menu_settings[0]['edfm_enable_top_search_form'])):
					if($edfm_fly_menu_settings[0]['edfm_enable_top_search_form']):
						?>
						<div class="edfm-header-search">
							<?php $this->get_edfm_search_form(1,$edfm_top_search_text);?>
						</div>
						<?php
					endif;
				endif;
				?>
			</div>
		<?php endif;?>
		<div class="edfm-fly-menu-body edfm-fly-menu-body-part">
			<?php
			if($edfm_fly_menu_settings[0]['edfm_body_content_selector'] == 'edfm-fly-menu'){
				$menu_object = wp_get_nav_menu_object( $edfm_fly_menu_settings[0]['select_menu']);
				if(!empty($menu_object)){
				$menu_slug = $menu_object->slug ;
				$args = array(
					'menu' => $edfm_fly_menu_settings[0]['select_menu'],
					'container' => 'div',
					'container_class' => 'edfm-menu-'.$menu_slug.'-container',
					'container_id' => 'efdm-'.$postid,
					'menu_id'=>'edfm-menu-'.$menu_slug,
					'menu_class' => 'edfm-menu',
					'echo' => true,
					'fallback_cb' => 'wp_page_menu',
					'before' => '',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'items_wrap' => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
					'depth' => 0,
					'walker' => new Walker_EDFM_Class()
				);
				wp_nav_menu( $args );
			}
			}else{
				_e('<div class="edfm-body-additional-content">');
				_e(do_shortcode($edfm_fly_menu_settings[0]['edfm_menu_custom_content']));
				_e('</div>');
			}
			?>
		</div>
		<?php if($edfm_fly_menu_settings[0]['edfm_enable_footer']):?>
			<div class="edfm-fly-menu-footer edfm-fly-menu-body-part">
				<?php
				if (isset($edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form']) && !empty($edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form'])):
					if($edfm_fly_menu_settings[0]['edfm_enable_bottom_search_form']):
						?>
						<div class="edfm-footer-search">
							<?php $this->get_edfm_search_form(1,$edfm_bottom_search_text);?>
						</div>
						<?php
					endif;
				endif; 
				if (isset($edfm_fly_menu_settings[0]['edfm_enable_social_icons']) && !empty($edfm_fly_menu_settings[0]['edfm_enable_social_icons'])):
					if($edfm_fly_menu_settings[0]['edfm_enable_social_icons']):
						$edfm_social_icons = get_post_meta($postid,'_edfm_social_icons'); 
						if(!empty($edfm_social_icons)){
							?><ul class="edfm-footer-social"><?php
							foreach($edfm_social_icons as $key => $socialnames){ 
								foreach($socialnames as $socialname => $innerarray){ 
									if(!empty($edfm_social_icons[0][$socialname]['url'])){
										?>
										<li class="edfm-icon-<?php esc_attr_e($edfm_social_icons[0][$socialname]['label']);?>">
											<a href="<?php esc_attr_e($edfm_social_icons[0][$socialname]['url']);?>">
												<i class="fa fa-<?php esc_attr_e($edfm_social_icons[0][$socialname]['icon']);?>"></i>
											</a>
											<?php if(!empty($edfm_social_icons[0][$socialname]['tooltip'])):?>
												<div class="edfm-social-tooltip"><?php esc_attr_e($edfm_social_icons[0][$socialname]['tooltip']);?></div>
											<?php endif;?>
										</li>
										<?php
									}
								}
							}?></ul><?php
						}
					endif;
				endif; 
				if (isset($edfm_fly_menu_settings[0]['edfm_menu_custom_footer_content']) && !empty($edfm_fly_menu_settings[0]['edfm_menu_custom_footer_content'])):
					?>
					<div class="edfm-header-additionl-content">
						<?php 
						_e(do_shortcode($edfm_fly_menu_settings[0]['edfm_menu_custom_footer_content']));
						?>
					</div>
					<?php
				endif;
				?>
			</div>
		<?php endif;?>
	</div>
</div>
<?php
	//include(EDFML_PATH . '/inc/frontend/edfm-frontend-style.php');
?>
