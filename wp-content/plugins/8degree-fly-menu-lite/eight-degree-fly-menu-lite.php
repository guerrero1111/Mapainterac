<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
  Plugin Name: 8Degree Fly Menu Lite- Free Responsive Off-Canvas Menu Plugin for WordPress 
  Plugin URI:  http://8degreethemes.com/wordpress-plugins/eight-degree-fly-menu-lite/
  Description: 8Degree Fly menu lite is an off canvas menu to style your site with easy information and navigation.
  Version:     1.0.2
  Author:      8Degree Themes
  Author URI:  http://8degreethemes.com
  License:     GPL2 or later
  Domain Path: /languages/
  Text Domain: eight-degree-fly-menu-lite
 */

  /* Create class Ultimate_Author_Box*/
  if ( !class_exists( 'EightDegreeFlyMenuLite' ) ) {

    class EightDegreeFlyMenuLite {

      function __construct() {
        $this->define_constants();
        add_action( 'init', array( $this, 'edfm_init' ) );
        add_action( 'init', array( $this, 'edfm_register_post_type' ) );

        /*Metabox hooks*/
        add_action( 'add_meta_boxes', array( $this, 'edfm_add_metabox' ) );
        
        /*add_action( 'add_meta_boxes', array( $this, 'edfm_add_metabox_preview' ) );*/
        add_action( 'save_post', array( $this, 'edfm_save_custom_post_type_settings' ) );

        /*Enqueue Scripts and style*/
        add_action( 'admin_enqueue_scripts', array( $this, 'edfm_backend_assets' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'edfm_frontend_assets' ) );
        
        /*Register Admin Menu items to Custom post type*/
        add_action( 'admin_menu', array( $this, 'edfm_sub_menu_how_to' ) );
        add_action( 'admin_menu', array( $this, 'edfm_sub_menu_about' ) );

        /*Load menu to frontend header*/
        add_action( 'wp_head', array( $this, 'edfm_fly_menu' ) );

        /*Metabox hooks for nav-menu.php*/
        add_action( 'load-nav-menus.php', array( $this, 'edfm_register_menu_meta_box' ) );

        /*Metabox select menu as edfm-menu*/
        add_action( 'wp_ajax_edfm_select_menu', array( $this, 'edfm_select_menu' ) );
        add_action( 'wp_ajax_edfm_unselect_menu', array( $this, 'edfm_unselect_menu' ) );

        /*Load pop-up module in nav-menu.php*/
        add_action( 'admin_footer', array( $this, 'edfm_admin_footer_function' ) );
        add_action( 'wp_ajax_edfm_show_lightbox_html', array( $this, 'edfm_lightbox_content' ) );
        add_action( 'wp_ajax_edfm_menu_item_save', array( $this, 'edfm_menu_item_save' ) );

        /*Sanitize wp-editor content*/
        add_filter( 'wp_kses_allowed_html', array( $this,'edfm_custom_wpkses_post_tags'), 10, 2 );
        add_action( 'wp_ajax_edfm_fetch_posts', array( $this, 'edfm_fetch_posts' ) );

        //add_filter('wp_nav_menu_args', array($this,'edfm_modify_nav_arguments'), 1000);
      }

      /*edfm_modify_nav_arguments*/
      function edfm_modify_nav_arguments($args){
        $edfm_selected_menu = get_option('edfm_selected_menu'); 
        $current_menu_id = $args['menu'];
        if(!empty($edfm_selected_menu) && !empty($current_menu_id) && is_array($edfm_selected_menu)){
          if(in_array($current_menu_id, $edfm_selected_menu)){
            $args['walker'] = new Walker_EDFM_Class();
            return $args;
          }
        }
        return $args;
      }

      /*Fetch posts for Display option*/
      function edfm_fetch_posts($post_type, $postID, $edfm_specific_page){
        if ( isset($_POST[ '_wpnonce' ]) && wp_verify_nonce($_POST[ '_wpnonce' ], 'edfm-ajax-nonce') ) {
          $selected_pages = isset($_POST[ 'selected_pages' ]) ? sanitize_text_field($_POST[ 'selected_pages' ]) : '';
          $edfm_specific_page = explode(',', $selected_pages);

          $post_type = isset($_POST[ 'post_type' ]) ? sanitize_text_field($_POST[ 'post_type' ]) : $post_type;
          $paged = isset($_POST[ 'page_number' ]) ? sanitize_text_field($_POST[ 'page_number' ]) : 1;

          $post_args = array( 
            'posts_per_page' => 10, 
            'post_status'    => 'publish', 
            'post_type'      => $post_type, 
            'paged'          => $paged, 
            'orderby'        => 'date', 
            'order'          => 'DESC' 
          );

          $loop = new WP_Query($post_args);

/*          echo 'selected_pages: '.$selected_pages;
          echo 'post_type: '.$post_type;
          echo 'paged: '.$paged;
          $this->print_array($edfm_specific_page);
          $this->print_array($loop);*/
          if(!empty($loop->posts)):
            ?>
            <div class="edfm-postbox-fields edfm-hide-singular" data-post_type="<?php esc_attr_e($post_type);?>" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_single_pages'] ) && $edfm_fly_menu_settings[0]['edfm_single_pages'] == 1 ) echo 'style="display:none;"'; ?>>
              <div class="edfm-toggle-tab-header">
                <h4>
                  <?php _e('Specific ','eight-degree-fly-menu'); _e(ucwords($post_type));?>
                  <span class="toggle-indicator" aria-hidden="true"></span>
                </h4>
              </div>
              <div class="edfm-postbox-fields edfm-toggle-tab-body" >
                <?php
                while ( $loop->have_posts() ) : $loop->the_post();
                  $post_id = get_the_ID();
                  ?>
                  <p>
                    <input class="edfm-post-checkbox" type="checkbox" id="edfm-post-<?php esc_attr_e($post_id);?>" value="<?php esc_attr_e($post_id);?>" <?php if(in_array($post_id,$edfm_specific_page)) echo 'checked';?> />
                    <label for="edfm-post-<?php esc_attr_e($post_id);?>"><?php the_title();?></label>
                  </p>
                  <?php
                endwhile; 
                ?>
                <div class="edfm-pagination-wrap">
                  <?php
                  $big = 999999999; /* need an unlikely integer*/
                  $paginate_links = paginate_links(array(
                    'type' => 'plain',
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '&paged=%#%',
                    'current' => max(1, $paged),
                    'total' => $loop->max_num_pages
                  ));
                  echo $paginate_links;
                  ?>
                  <div class="edfm-spinner spinner"></div>
                </div>
              </div>
              <?php
              wp_reset_query();
              ?>
            </div>
            <?php
          endif;
          wp_die();
        }else{    
          $edfm_specific_page = isset($edfm_specific_page) ? $edfm_specific_page : array();

          $post_type = isset($_POST[ 'post_type' ]) ? sanitize_text_field($_POST[ 'post_type' ]) : $post_type;

          $paged = isset($_POST[ 'page_number' ]) ? sanitize_text_field($_POST[ 'page_number' ]) : 1;

          $post_args = array( 
            'posts_per_page' => 10, 
            'post_status'    => 'publish', 
            'post_type'      => $post_type, 
            'paged'          => $paged, 
            'orderby'        => 'date', 
            'order'          => 'DESC'  
          );

          $loop = new WP_Query($post_args);

          if(!empty($loop->posts)):
            ?>
            <div class="edfm-postbox-fields edfm-hide-singular" data-post_type="<?php esc_attr_e($post_type);?>" <?php if ( isset( $edfm_fly_menu_settings[0]['edfm_single_pages'] ) && $edfm_fly_menu_settings[0]['edfm_single_pages'] == 1 ) echo 'style="display:none;"'; ?>>
              <div class="edfm-toggle-tab-header">
                <h4>
                  <?php _e('Specific ','eight-degree-fly-menu'); _e(ucwords($post_type));?>
                  <span class="toggle-indicator" aria-hidden="true"></span>
                </h4>
              </div>
              <div class="edfm-postbox-fields edfm-toggle-tab-body">
                <?php
                while ( $loop->have_posts() ) : $loop->the_post();
                  $post_id = get_the_ID();
                  ?>
                  <p>
                    <input class="edfm-post-checkbox" type="checkbox" id="edfm-post-<?php esc_attr_e($post_id);?>" value="<?php esc_attr_e($post_id);?>" <?php if(in_array($post_id,$edfm_specific_page)) echo 'checked';?> />
                    <label for="edfm-post-<?php esc_attr_e($post_id);?>"><?php the_title();?></label>
                  </p>
                  <?php
                endwhile; 
                ?>
                <div class="edfm-pagination-wrap">
                  <?php
                  $big = 999999999; /* need an unlikely integer*/
                  $paginate_links = paginate_links(array(
                    'type' => 'plain',
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '&paged=%#%',
                    'current' => max(1, $paged),
                    'total' => $loop->max_num_pages
                  ));
                  echo $paginate_links;
                  /*$this->print_array($paginate_links)*/
                  ?>
                  <div class="edfm-spinner spinner"></div>
                </div>
              </div>
              <?php
              wp_reset_query();
              ?>
            </div>
            <?php
          endif;
        } 
      }

      /*Allow iframe tag in wp-editor*/
      function edfm_custom_wpkses_post_tags( $tags, $context ) {
       if ( 'post' === $context ) {
        $tags['iframe'] = array(
         'src'             => true,
         'height'          => true,
         'width'           => true,
         'frameborder'     => true,
         'allowfullscreen' => true,
       );
        $tags['br'] = array();
      }
      return $tags;
    }

    /* Define File Paths */

    function define_constants() {
     defined( 'EDFML_CSS_DIR' ) or define( 'EDFML_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' );
     defined( 'EDFML_JS_DIR' ) or define( 'EDFML_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );
     defined( 'EDFML_IMG_DIR' ) or define( 'EDFML_IMG_DIR', plugin_dir_url( __FILE__ ) . 'images' );
     defined( 'EDFML_PATH' ) or define( 'EDFML_PATH', plugin_dir_path( __FILE__ ) );
     defined( 'EDFML_VERSION' ) or define( 'EDFML_VERSION', '1.0.2' );
   }

   /* Define Text Domain */

   function edfm_init() {
     load_plugin_textdomain( 'eight-degree-fly-menu-lite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
   }

   /* Enqueue Backend Scripts and Style */

   function edfm_backend_assets() {

    /*Enqueue Font icons*/
    wp_enqueue_style( 'edfm-font-awesome-style', EDFML_CSS_DIR . '/font-awesome.min.css', array(), EDFML_VERSION );
    wp_enqueue_style( 'edfm-icon-picker-genericons-css', EDFML_CSS_DIR . '/genericons.css', EDFML_VERSION );
    wp_enqueue_style( 'edfm-icon-picker-css', EDFML_CSS_DIR . '/icon-picker.css', EDFML_VERSION );
    wp_enqueue_script( 'edfm-linearicons', 'https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js' );
    wp_enqueue_style( 'edfm-linearicons-css', 'https://cdn.linearicons.com/free/1.0.0/icon-font.min.css');
    wp_enqueue_style( 'edfm-materialdesign', '//cdn.materialdesignicons.com/1.9.32/css/materialdesignicons.min.css');
    wp_enqueue_style( 'edfm-themify-css', EDFML_CSS_DIR . '/themify-icons.css', EDFML_VERSION );
    
    /*Enqueue codemirror css for Custom CSS editor*/
    wp_enqueue_style( 'edfm-codemirror-css', EDFML_CSS_DIR . '/codemirror.css', array(), EDFML_VERSION );

    /*Enqueue backend.css*/
    wp_enqueue_style( 'edfm-backend-style', EDFML_CSS_DIR . '/backend.css', array(), EDFML_VERSION );

    /*Enqueue media for custom image upload*/
    wp_enqueue_media();

    /*For color picker*/
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'edfm-color-picker-js', EDFML_JS_DIR . '/wp-color-picker-alpha.js', array('jquery','wp-color-picker'), EDFML_VERSION );

    /*For Custom CSS editor*/
    wp_enqueue_script( 'edfm-codemirror-js', EDFML_JS_DIR . '/codemirror.js', array( 'jquery' ), EDFML_VERSION );
    wp_enqueue_script( 'edfm-codemirror-css-js', EDFML_JS_DIR . '/css.js', array('jquery', 'edfm-codemirror-js'), EDFML_VERSION );

    /*For default icon picker*/
    wp_enqueue_script( 'edfm-icon-picker-script', EDFML_JS_DIR . '/icon-picker.js', array( 'jquery', 'edfm-backend-script' ), EDFML_VERSION );

    /*Enqueue backend.js*/
    wp_enqueue_script( 'edfm-backend-script', EDFML_JS_DIR . '/backend.js', array( 'jquery','jquery-ui-sortable','edfm-codemirror-js','edfm-codemirror-css-js'), EDFML_VERSION );

    /*Send php values to JS script*/
    wp_localize_script( 'edfm-backend-script', 'edfm_admin_js_obj', array(
      'edfm_image_path' => EDFML_IMG_DIR,
      'edfm_ajaxurl' => admin_url( 'admin-ajax.php' ),
      'edfm_ajax_nonce' => wp_create_nonce( 'edfm-ajax-nonce' )
      ) );
  }

  /* Enqueue Frontend Scripts and Style */

  function edfm_frontend_assets() {

    /*Enqueue frontend.css*/
    wp_enqueue_style( 'edfm-frontend-style', EDFML_CSS_DIR . '/frontend.css', array(), EDFML_VERSION );

    /*Enqueue fonts and icons*/
    wp_enqueue_style( 'edfm-icon-picker-genericons-css', EDFML_CSS_DIR . '/genericons.css', EDFML_VERSION );
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_style( 'edfm-font-awesome-style', EDFML_CSS_DIR . '/font-awesome.min.css', array(), EDFML_VERSION );
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Amatic+SC|Merriweather|Roboto+Slab|Montserrat:400,700|Italianno|PT+Sans+Narrow|Raleway:400,500,600,800|Roboto:300,400,500,700|Great+Vibes|Varela+Round|Roboto+Condensed|Fira+Sans|Lora|Signika|Cabin|Arimo|Droid+Serif|Rubik|Abril+Fatface|Arvo:400,400i,700,700i|Droid+Sans:400,700|Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i|Josefin+Slab:100,100i,300,300i,400,400i,600,600i,700,700i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Old+Standard+TT:400,400i,700|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|PT+Sans:400,400i,700,700i|PT+Serif:400,400i,700,700i|Ubuntu:300,300i,400,400i,500,500i,700,700i|Vollkorn:400,400i,700,700i' );

    wp_enqueue_style( 'edfm-themify-css', EDFML_CSS_DIR . '/themify-icons.css', EDFML_VERSION );


    wp_enqueue_script( 'edfm-linearicons', 'https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js' );
    wp_enqueue_style( 'edfm-linearicons-css', 'https://cdn.linearicons.com/free/1.0.0/icon-font.min.css');
    wp_enqueue_style( 'edfm-materialdesign', '//cdn.materialdesignicons.com/1.9.32/css/materialdesignicons.min.css');

    /*Enqueue scrollbar*/
    wp_enqueue_style( 'edfm-scrollbar-css', EDFML_CSS_DIR . '/jquery.mCustomScrollbar.min.css', array(), EDFML_VERSION );
    wp_enqueue_script( 'edfm-scrollbar-js', EDFML_JS_DIR . '/jquery.mCustomScrollbar.min.js', array( 'jquery'), EDFML_VERSION );
    

    

    /*Running loop foreach fly menu and sending required setting from php to js*/
    $query = new WP_Query( array('post_type' => 'edfm_menu', 'posts_per_page' => -1 )); 

    $edfm_fly_menu_settings_js = array();

    if ( $query->have_posts() ) : 
      /*Enqueue frontend.js*/
      wp_enqueue_script( 'edfm-frontend-script', EDFML_JS_DIR . '/frontend.js', array( 'jquery'), EDFML_VERSION );
      while ( $query->have_posts() ) : 
        $query->the_post(); 
        $postid = get_the_ID(); 
        $edfm_fly_menu_settings = get_post_meta($postid,'_edfm_select_menu'); 

        if(!empty($edfm_fly_menu_settings)){

          $edfm_toggle_custom_element = isset( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element'] ) : 0;
          $edfm_toggle_custom_element_id = isset( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element_id'] ) ? sanitize_text_field( $edfm_fly_menu_settings[0]['edfm_toggle_custom_element_id'] ) : '';
          
          $edfm_fly_menu_settings_js[$postid] = array(
            'edfm_postid'=>$postid,
            'edfm_toggle_custom_element' => $edfm_toggle_custom_element,
            'edfm_toggle_custom_element_id'=>$edfm_toggle_custom_element_id
          );
        }
      endwhile; 
      
      $edfm_json_str = json_encode($edfm_fly_menu_settings_js);
      
      wp_localize_script( 'edfm-frontend-script', 'edfm_menu_settings', array(
        'edfm_arr' => $edfm_json_str
      ));
      
      wp_reset_postdata();
    endif;
  }
  /* Backend How to use Page */

  function edfm_sub_menu_how_to() {
    add_submenu_page(
     'edit.php?post_type=edfm_menu', __( 'How to use', 'eight-degree-fly-menu-lite' ), __( 'How to use', 'eight-degree-fly-menu-lite' ), 'manage_options', 'edfm-how-to', array( $this, 'edfm_how_to' )
   );
  }

/* 
 * Eight Degree Fly Menu - How to callback function
 */
function edfm_how_to() {
  include(EDFML_PATH . '/inc/backend/boards/edfm-how-to.php');
}

/* Backend About Page */

function edfm_sub_menu_about() {
  add_submenu_page(
   'edit.php?post_type=edfm_menu', __( 'About', 'eight-degree-fly-menu-lite' ), __( 'About', 'eight-degree-fly-menu-lite' ), 'manage_options', 'edfm-about', array( $this, 'edfm_about' )
 );
}

/* 
 * Eight Degree Fly Menu - About page callback function
 */
function edfm_about() {
  include(EDFML_PATH . '/inc/backend/boards/edfm-about.php');
}

/* Custom Utility Print Function */

function print_array( $array ) {
  echo "<pre>";
  print_r( $array );
  echo "</pre>";
}

/* Load Menu on Header */

function edfm_fly_menu() {
  include(EDFML_PATH . '/inc/frontend/edfm-fly-menu.php');
}

/* Creating Meta box for nav-menu.php */

function edfm_register_menu_meta_box() {
  add_meta_box(
   'edfm-menu-meta-box-id', esc_html__( '8Degree Fly Menu Lite', 'eight-degree-fly-menu-lite' ), array( $this, 'edfm_render_menu_meta_box' ), 'nav-menus', 'side', 'high'
 );
}

/* Eight Degree Fly Menu - Nav.php Mets Box */
function edfm_render_menu_meta_box() {
  $nav_menus = wp_get_nav_menus();
  if(!empty($nav_menus)){
    $edfm_current_menu_id = $this->edfm_current_menu_id();
    $menu_object = wp_get_nav_menu_object( $edfm_current_menu_id );
    $menu_name = !empty( $menu_object ) ? $menu_object->name : '';
    $menu_slug = !empty( $menu_object ) ? $menu_object->slug : '';
    $edfm_selected_menu = get_option('edfm_selected_menu'); 
    if(empty($edfm_selected_menu)){
      $edfm_selected_menu = array();
    }

    /* $this->print_array($edfm_selected_menu);*/
    ?>
    <input type="hidden" id="edfm_current_menu_id" value="<?php esc_attr_e($edfm_current_menu_id);?>"/>
    <input type="hidden" id="edfm_menu_name" value="<?php esc_attr_e($menu_name);?>"/>
    <input type="hidden" id="edfm_menu_slug" value="<?php esc_attr_e($menu_slug);?>"/>

    <input type="checkbox" id="edfm_select_menu" <?php if(in_array($edfm_current_menu_id, $edfm_selected_menu)) _e('checked');?>/>
    <label for="edfm_select_menu">        
     <?php _e( 'Use as flymenu?<p>Please check here to make ', 'eight-degree-fly-menu-lite' ); ?><strong><?php _e( $menu_name ); ?></strong><?php _e( ' work as 8Degree Fly Menu. </p><p>Checking this will will enable you to configure fly menu item settings.</p><p> Click save after adding new menu items to get fly menu options for that item.</p>', 'eight-degree-fly-menu-lite' ); ?>
   </label>
   <?php
 }else{
  _e( 'No Menu Created.', 'eight-degree-fly-menu-lite' );
}
}

/* Eight Degree Fly Menu - Set Menu as Fly Menu */
function edfm_select_menu(){
  if ( check_ajax_referer( 'edfm-ajax-nonce', 'wp_nonce' ) ) {
    if( ! empty($_POST['menu_id'])){
      $selected_menu = get_option('edfm_selected_menu');
      if(! empty($selected_menu)){
        $edfm_selected_menu_id = sanitize_text_field($_POST['menu_id']);
        $edfm_selected_menu[] = $edfm_selected_menu_id;
      }else{
        $edfm_selected_menu[] = $_POST['menu_id'];
      }
      update_option('edfm_selected_menu', $edfm_selected_menu);
      wp_send_json_success();
    }
  }else {
    die( 'No script kiddies please!' );
  }
  wp_die();
}

/* Eight Degree Fly Menu - Unset Menu as Fly Menu */
function edfm_unselect_menu(){
  if ( check_ajax_referer( 'edfm-ajax-nonce', 'wp_nonce' ) ) {
    if( ! empty($_POST['menu_id'])){
      $edfm_selected_menu_id = $_POST['menu_id'];
      $edfm_selected_menu = get_option('edfm_selected_menu');

      $nav_menus = wp_get_nav_menus();
      $all_nav_menu =array();
      if(!empty($nav_menus)){
        foreach($nav_menus as $nav_menu){
          $all_nav_menu[] = $nav_menu->term_id;
        }
      }
      foreach($edfm_selected_menu as $junk_id => $junk_value){
        if(!in_array($junk_id,$all_nav_menu)){
          $pos = array_search($junk_value, $edfm_selected_menu);
          unset($edfm_selected_menu[$pos]);
        }
      }
      if(in_array($edfm_selected_menu_id,$edfm_selected_menu)){
        $pos = array_search($edfm_selected_menu_id, $edfm_selected_menu);
        unset($edfm_selected_menu[$pos]);
      }
      update_option('edfm_selected_menu', $edfm_selected_menu);
      wp_send_json_success();
    }
  }else {
    die( 'No script kiddies please!' );
  }
  wp_die();
}

/*Get current menu id for nav-menu.php metabox.*/
function edfm_current_menu_id() {
  /*Get List of registered menus*/
  $nav_menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

  /*Count numbr of Menus*/
  $menu_count = count( $nav_menus );

  $edfmSelectedID = isset( $_REQUEST['menu'] ) ? (int) $_REQUEST['menu'] : 0;

  $edfmAddNewScreen = ( isset( $_GET['menu'] ) && 0 == $_GET['menu'] ) ? true : false;
  $page_count = wp_count_posts( 'page' );
  $one_theme_location_no_menus = ( 1 == count( get_registered_nav_menus() ) && !$edfmAddNewScreen && empty( $nav_menus ) && !empty( $page_count->publish ) ) ? true : false;

  /* Get recently edited nav menu*/
  $recently_edited = absint( get_user_option( 'nav_menu_recently_edited' ) );

  if ( empty( $recently_edited ) && is_nav_menu( $edfmSelectedID ) ) {
    $recently_edited = $edfmSelectedID;
  }

  /* Use $recently_edited if none are selected*/
  if ( empty( $edfmSelectedID ) && !isset( $_GET['menu'] ) && is_nav_menu( $recently_edited ) ) {
    $edfmSelectedID = $recently_edited;
  }

  /* On deletion of menu, if another menu exists, show it*/
  if ( !$edfmAddNewScreen && 0 < $menu_count && isset( $_GET['action'] ) && 'delete' == $_GET['action'] ) {
    $edfmSelectedID = $nav_menus[0]->term_id;
  }

  /* Set $edfmSelectedID to 0 if no menus*/
  if ( $one_theme_location_no_menus ) {
    $edfmSelectedID = 0;
  } elseif ( empty( $edfmSelectedID ) && !empty( $nav_menus ) && !$edfmAddNewScreen ) {
    /* if we have no selection yet, and we have menus, set to the first one in the list*/
    $edfmSelectedID = $nav_menus[0]->term_id;
  }

  return $edfmSelectedID;
}

/*nav-menu.php footer*/
function edfm_admin_footer_function() {
  echo "<div class='edfm_menu_wrapper'><div class='edfm_overlay'></div>";
  echo "<div id='edfm_menu_settings_frame' style='display:none;'><div class='edfm_frame_header'>";
  echo "<button type='button' class='media-modal-close'><span class='media-modal-icon edfm_close_btn'><span class='screen-reader-text'>Close menu panel</span></span></div>";
  echo "<div class='edfm_main_content'></div></div></div>";
}

/*nav-menu.php footer ajax pop-up response*/
function edfm_lightbox_content() {
  if ( check_ajax_referer( 'edfm-ajax-nonce', 'wp_nonce' ) ) {
    include(EDFML_PATH . 'inc/backend/nav-menu-settings/edfm-nav-menu-popup-settings.php');
  }
  wp_die();
}

/*Ajax menu item settings save.*/
function edfm_menu_item_save() {
  if ( check_ajax_referer( 'edfm-ajax-nonce', 'wp_nonce' ) ) {
   $edfm_menu_item_id = absint( $_POST['menu_item_id'] );
   if ( isset( $_POST['edfm_menu_item_save'] ) && !empty( $_POST['edfm_menu_item_save'] ) ) {
    $edfm_menu_item_settings = array();
    parse_str( $_POST['edfm_menu_item_save'], $edfm_menu_item_settings );

    $edfm_menu_item_settings['edfm_edit_menu_item_show_header'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_show_header'] ) ? 1 : 0;
    $edfm_menu_item_settings['edfm_edit_menu_item_header_icon_type'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_header_icon_type'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_header_icon_type'] ) : 'edfm_default_header_icon';
    $edfm_menu_item_settings['edfm_edit_menu_item_header_default_icon'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_header_default_icon'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_header_default_icon'] ) : 'dashicons|dashicons-admin-home';
    $edfm_menu_item_settings['edfm_edit_menu_item_header_custom_icon'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_header_custom_icon'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_header_custom_icon'] ) : '';
    $edfm_menu_item_settings['edfm_edit_menu_item_header_label_text'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_header_label_text'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_header_label_text'] ) : '';
    $edfm_menu_item_settings['edfm_edit_menu_item_icon_type'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_icon_type'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_icon_type'] ) : 'edfm_default_icon';
    $edfm_menu_item_settings['edfm_edit_menu_item_default_icon'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_default_icon'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_default_icon'] ) : 'dashicons|dashicons-admin-home';
    $edfm_menu_item_settings['edfm_edit_menu_item_custom_icon'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_custom_icon'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_custom_icon'] ) : '';
    $edfm_menu_item_settings['edfm_edit_menu_item_show_nativation_label'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_show_nativation_label'] ) ? 1 : 0;
    $edfm_menu_item_settings['edfm_edit_menu_item_short_description'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_short_description'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_short_description'] ) : '';
    $edfm_menu_item_settings['edfm_edit_menu_item_notification_label'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_notification_label'] ) ? sanitize_text_field( $edfm_menu_item_settings['edfm_edit_menu_item_notification_label'] ) : '';
    $edfm_menu_item_settings['edfm_edit_menu_item_description'] = isset( $edfm_menu_item_settings['edfm_edit_menu_item_description'] ) ? wp_kses_post( $edfm_menu_item_settings['edfm_edit_menu_item_description'] ) : '';

    $get_existing_settings = get_post_meta( $edfm_menu_item_id, '_edfmItemSettings', true );
    if ( is_array( $get_existing_settings ) ) {
      $edfm_menu_item_settings = array_merge( $get_existing_settings, $edfm_menu_item_settings );
    }
    update_post_meta( $edfm_menu_item_id, '_edfmItemSettings', $edfm_menu_item_settings );
    wp_send_json_success();
  }
} else {
  die( 'No script kiddies please!' );
}
wp_die();
}

/*Register Custom Post Type*/
function edfm_register_post_type() {
  include(EDFML_PATH . 'inc/backend/custom-post-type/edfm-custom-post-type.php');
}

/*Meta Box For Custom Post Type*/
function edfm_add_metabox() {
  add_meta_box( 'edfm_menu', __( '8Degree Fly Menu Lite Settings', 'eight-degree-fly-menu-lite' ), array( $this, 'edfm_meta_callback' ), 'edfm_menu', 'normal', 'core' );
}

/* 
 * Eight Degree Fly Menu - Nav.php Modal Box Options
 */
/*function edfm_add_metabox_preview() {
  add_meta_box( 'edfm_menu_preview', __( '8Degree Menu Preview', 'eight-degree-fly-menu-lite' ), array( $this, 'edfm_meta_callback_preview' ), 'edfm_menu', 'side', 'low' );
}*/

/*Meta Box Callback Function*/
function edfm_meta_callback( $post ) {
  include(EDFML_PATH . 'inc/backend/custom-post-type/edfm-meta-box/edfm-meta-box.php');
}

/*Meta Box Preview Callback Function*/
/*function edfm_meta_callback_preview($post) {
  include(EDFML_PATH . 'inc/backend/custom-post-type/edfm-meta-box/edfm-meta-box-preview.php');
}*/

/* 
 * Eight Degree Fly Menu - Save Meta values
 */
function edfm_save_custom_post_type_settings($post_id){
  include(EDFML_PATH . 'inc/backend/custom-post-type/edfm-meta-box/edfm-meta-saves/edfm-meta-saves.php');
}

/* 
 * Eight Degree Fly Menu - Get font list from google fonts
 */
function edfm_fonts_array(){
  $font_file = plugin_dir_url( __FILE__ ) . 'fonts/google-fonts.txt';
  $font_json = file_get_contents($font_file);
  return $font_decoded->items;
}

/* Define custom search form */
function get_edfm_search_form( $echo = true, $edfm_placeholder = '',$edfm_nav_icon_menu_template='' ) {
  include(EDFML_PATH . 'inc/backend/edfm-search-form.php');
}


  }//End of class EightDegreeFlyMenuLite

//Create EightDegreeFlyMenuLite Object
  $eight_degree_fly_menu_obj = new EightDegreeFlyMenuLite();
}




