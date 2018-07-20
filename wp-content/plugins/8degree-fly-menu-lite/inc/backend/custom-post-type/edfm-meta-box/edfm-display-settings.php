<?php
/* 
 * Eight Degree Fly Menu - Display Options
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$edfm_specific_page = array();
if(!empty($edfm_specific_pages)){
	foreach($edfm_specific_pages as $key => $values){
		foreach($values as $value){
			$edfm_specific_page[] = $value;
		}
	}	
}
$edfm_selected_page = join(",",$edfm_specific_page);

$edfm_selected_pages = isset( $edfm_fly_menu_settings[0]['edfm_selected_pages'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_selected_pages'] ) : $edfm_selected_page;
?>
<div class="edfm-postbox-section">
	

	<div class="edfm-postbox-fields">
		<h4><?php _e('Hide Fly Menu in','eight-degree-fly-menu');?></h4>
		<div class="edfm-toggle-tab-header edfm-toggle-active"><h4><?php _e('Default WordPress Pages','eight-degree-fly-menu');?><span class="toggle-indicator" aria-hidden="true"></span></h4></div>
		<div class="edfm-postbox-fields edfm-toggle-tab-body">
			<p><input type="checkbox" name="edfm_front_pages" id="edfm_front_pages"<?php if ( isset( $edfm_fly_menu_settings[0]['edfm_front_pages'] ) && $edfm_fly_menu_settings[0]['edfm_front_pages'] == 1 ) esc_attr_e('checked'); ?>/><label for="edfm_front_pages"><?php _e('Front Page','eight-degree-fly-menu');?></label></p>
			<p><input type="checkbox" name="edfm_blog_pages" id="edfm_blog_pages"<?php if ( isset( $edfm_fly_menu_settings[0]['edfm_blog_pages'] ) && $edfm_fly_menu_settings[0]['edfm_blog_pages'] == 1 ) esc_attr_e('checked'); ?>/><label for="edfm_blog_pages"><?php _e('Home/Blog Page','eight-degree-fly-menu');?></label></p>
			<p><input type="checkbox" name="edfm_archive_pages" id="edfm_archive_pages"<?php if ( isset( $edfm_fly_menu_settings[0]['edfm_archive_pages'] ) && $edfm_fly_menu_settings[0]['edfm_archive_pages'] == 1 ) esc_attr_e('checked'); ?>/><label for="edfm_archive_pages"><?php _e('Archive Page','eight-degree-fly-menu');?></label></p>
			<p><input type="checkbox" name="edfm_404_pages"  id="edfm_404_pages"<?php if ( isset( $edfm_fly_menu_settings[0]['edfm_404_pages'] ) && $edfm_fly_menu_settings[0]['edfm_404_pages'] == 1 ) esc_attr_e('checked'); ?>/><label for="edfm_404_pages"><?php _e('404 Page','eight-degree-fly-menu');?></label></p>
			<p><input type="checkbox" name="edfm_search_pages"  id="edfm_search_pages"<?php if ( isset( $edfm_fly_menu_settings[0]['edfm_search_pages'] ) && $edfm_fly_menu_settings[0]['edfm_search_pages'] == 1 ) esc_attr_e('checked'); ?>/><label for="edfm_search_pages"><?php _e('Search Page','eight-degree-fly-menu');?></label></p>
			<p><input type="checkbox" name="edfm_single_pages" id="edfm_single_pages"<?php if ( isset( $edfm_fly_menu_settings[0]['edfm_single_pages'] ) && $edfm_fly_menu_settings[0]['edfm_single_pages'] == 1 ) esc_attr_e('checked'); ?>/><label for="edfm_single_pages"><?php _e('All Single Page','eight-degree-fly-menu');?></label></p>
		</div>
	</div>
	<?php

	$post_types = get_post_types(array('public'=>'false'));
	sort($post_types);
	foreach($post_types as $post_type){
		if(!($post_type == 'attachment')){
			?>
				<div class="edfm-fetched-posts-wrapper">
					<?php
						$this->edfm_fetch_posts($post_type,$post->ID,$edfm_specific_page);
					?>
				</div>
			<?php
			/*$loop = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post_status'=>'publish' ) );
			if(!empty($loop->posts)):
				?>
				<div class="edfm-postbox-fields edfm-hide-singular" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_single_pages'] ) && $edfm_fly_menu_settings[0]['edfm_single_pages'] == 1 ) echo 'style="display:none;"'; ?>><div class="edfm-toggle-tab-header"><h4><?php _e('Specific ','eight-degree-fly-menu'); _e(ucwords($post_type));?><span class="toggle-indicator" aria-hidden="true"></span></h4></div><div class="edfm-postbox-fields edfm-toggle-tab-body" style="display:none;">
				<?php
				while ( $loop->have_posts() ) : $loop->the_post();
					$post_id = get_the_ID();
					?>
					<p><input type="checkbox" name="edfm_specific_pages[]" id="edfm-post-<?php esc_attr_e($post_id);?>" value="<?php esc_attr_e($post_id);?>" <?php if( isset($edfm_specific_pages) && in_array($post_id,$edfm_specific_page)) echo 'checked';?>	/><label for="edfm-post-<?php esc_attr_e($post_id);?>"><?php the_title();?></label></p>
					<?php
				endwhile; 
				wp_reset_query();
				?></div></div><?php
			endif;*/

		}	
	}
	?>
	<input type="hidden" name="edfm_specific_pages[]" value="<?php esc_attr_e($edfm_selected_pages);?>" id="edfm-hidden-values"/>
	<?php
	$edfm_custom_terms = isset( $edfm_fly_menu_settings[0]['edfm_custom_terms'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_custom_terms'] ) : '';
	?>

	<div class="edfm-postbox-fields">
		<label><?php _e('Exclude Fly menu from given categories','eight-degree-fly-menu');?></label>
		<input type="text" name="edfm_custom_terms" value="<?php esc_attr_e( $edfm_custom_terms ); ?>"/>
		<div class="edfm-description"><?php _e('Manually enter the custom slugs of the desired terms where you do not want to show fly menu. For example: category-1,category-2','eight-degree-fly-menu');?></div>
	</div>

</div>