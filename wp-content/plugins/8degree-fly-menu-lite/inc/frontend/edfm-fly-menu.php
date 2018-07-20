<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
* Eight Degree Fly Menu - Frontend Code
*/

/*
* Include Walker Class
*/
include(EDFML_PATH . '/inc/frontend/edfm-walker-class.php');
global $post;
$current_page_id = $post->ID;
$count = 0;
$query = new WP_Query( array('post_type' => 'edfm_menu', 'posts_per_page' => -1 )); 
if ( $query->have_posts() ) : 
	while ( $query->have_posts() ) : 
		$query->the_post(); 

		$postid = get_the_ID(); 
		$edfm_fly_menu_settings = get_post_meta($postid,'_edfm_select_menu'); 
		//$this->print_array($edfm_fly_menu_settings);
		if(!empty($edfm_fly_menu_settings)){
			$edfm_specific_pages = get_post_meta($postid,'_edfm_specific_pages');
				//$this->print_array($edfm_specific_pages);
			$edfm_specific_page = array();
			if(!empty($edfm_specific_pages)){
				foreach($edfm_specific_pages as $key => $values){
					foreach($values as $value){
						$edfm_specific_page[] = $value;
					}
				}	
			}

			if(in_array($current_page_id, $edfm_specific_page)){
				continue;
			}

			if($edfm_fly_menu_settings[0]['edfm_front_pages'] || $edfm_fly_menu_settings[0]['edfm_blog_pages']){	
				if ( is_front_page() && is_home() ) {
					continue;
				} elseif ( is_front_page() ) {
					continue;
				} elseif ( is_home() ) {
					continue;
				}
			}

			if($edfm_fly_menu_settings[0]['edfm_single_pages']){
				if(is_single() || is_page())
					continue;					
			}

			if($edfm_fly_menu_settings[0]['edfm_404_pages']){
				if(is_404())
					continue;
			}
			if($edfm_fly_menu_settings[0]['edfm_search_pages']){
				if(is_search())
					continue;
			}

			$custom_term_flag = 1;
			$edfm_custom_terms_obj = isset( $edfm_fly_menu_settings[0]['edfm_custom_terms'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_custom_terms'] ) : '';
			if(!empty($edfm_custom_terms_obj)){
				$edfm_custom_terms = explode(',',$edfm_custom_terms_obj);
				
				foreach($edfm_custom_terms as $edfm_custom_term){
					$edfm_custom_term = strtolower($edfm_custom_term);

					//echo $edfm_custom_term.'<br/>';
					if(term_exists($edfm_custom_term)){
						//echo 'term exists<br/>';
						if(is_category($edfm_custom_term)){
							//echo 'is category<br/>';
							$custom_term_flag = 0;
						}
						if(is_tag($edfm_custom_term)){
							//echo 'is tag<br/>';
							$custom_term_flag = 0;
						}
						$taxonomies = get_taxonomies($args=array(),'names');
						foreach($taxonomies as $taxonomy ){
							$taxonomy_list[] = $taxonomy;
						}
					//$this->print_array($taxonomy_list);
						foreach($taxonomy_list as $taxonomy){
							if(is_tax($taxonomy,$edfm_custom_term)){
								//echo 'is:'.$edfm_custom_term.'<br/>';
								$custom_term_flag = 0;
							}
						}

					}
				}
				
			}
			if(!$custom_term_flag){
				continue;
			};

			$edfm_template_type = isset($edfm_fly_menu_settings[0]['edfm_template_type'])?$edfm_fly_menu_settings[0]['edfm_template_type']:'edfm_template_default';
			$edfm_toggle_type = isset($edfm_fly_menu_settings[0]['edfm_toggle_type'])?$edfm_fly_menu_settings[0]['edfm_toggle_type']:'edfm_toggle_default';

			$edfm_top_search_text = isset($edfm_fly_menu_settings[0]['edfm_top_search_text'])?$edfm_fly_menu_settings[0]['edfm_top_search_text']:'';
			$edfm_bottom_search_text = isset($edfm_fly_menu_settings[0]['edfm_bottom_search_text'])?$edfm_fly_menu_settings[0]['edfm_bottom_search_text']:'';
			$edfm_menu_layout = isset($edfm_fly_menu_settings[0]['edfm_menu_layout'])?$edfm_fly_menu_settings[0]['edfm_menu_layout']:'edfm_nav_icon_menu';
			$edfm_enable_toggle_text = isset($edfm_fly_menu_settings[0]['edfm_enable_toggle_text'])?$edfm_fly_menu_settings[0]['edfm_enable_toggle_text']:0;
			$edfm_toggle_icon_type = isset($edfm_fly_menu_settings[0]['edfm_toggle_icon_type'])?$edfm_fly_menu_settings[0]['edfm_toggle_icon_type']:'edfm_hamburger_toggle_icon';

			if($edfm_enable_toggle_text){
				$edfm_enable_text_label = isset($edfm_fly_menu_settings[0]['edfm_enable_text_label'])?$edfm_fly_menu_settings[0]['edfm_enable_text_label']:'';
				$edfm_text_behavior = isset($edfm_fly_menu_settings[0]['edfm_text_behavior'])?$edfm_fly_menu_settings[0]['edfm_text_behavior']:'edfm-show-text';
				//echo $edfm_enable_text_label;
			}
			


			$edfm_parent_background_type = isset($edfm_fly_menu_settings[0]['edfm_parent_background_type'])?$edfm_fly_menu_settings[0]['edfm_parent_background_type']:'none';
			
			switch($edfm_parent_background_type){
				case 'edfm_parent_image_background':
				$edfm_parent_background_image_url = isset($edfm_fly_menu_settings[0]['edfm_parent_background_image_url'])?$edfm_fly_menu_settings[0]['edfm_parent_background_image_url']:'';
				break;
			}


			

			switch($edfm_menu_layout){
				case 'edfm_side_menu':
				include(EDFML_PATH . '/inc/frontend/edfm-fly-menu-layout/edfm-full-side-menu.php');
				break;
				case 'edfm_skewed_menu':
				include(EDFML_PATH . '/inc/frontend/edfm-fly-menu-layout/edfm-skew-menu.php');
				break;

			}
			include(EDFML_PATH . '/inc/frontend/edfm-frontend-style.php');

			if(isset($edfm_fly_menu_settings[0]['edfm_enable_custom_css'])){
				if ($edfm_fly_menu_settings[0]['edfm_enable_custom_css']){
					echo '<style>';
					_e($edfm_fly_menu_settings[0]['edfm_custom_css']);
					echo '</style>';
				}	
			}

		}
	endwhile; 
	wp_reset_postdata();
	else : ?>
	<?php _e( '','eight-degree-fly-menu' ); ?>
<?php endif; 


