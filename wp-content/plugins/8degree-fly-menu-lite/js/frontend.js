/*
 Eight Degree Fly Menu Lite
 Version 1.0.0
 */
/* 
 Created on : Apr 10, 2017, 10:23:04 AM
 Author     : 8Degree Themes
 */
 
 jQuery(document).ready(function ($) {

  /* Custom Toggle Js */
  var edfm_json_str = edfm_menu_settings.edfm_arr.replace(/&quot;/g, '"');
  var edfm_php_arr = jQuery.parseJSON(edfm_json_str);
  var arr = $.map(edfm_php_arr, function(el) { return el; });

  $.each(arr, function(index, edfm_menu_settings) {
    var edfm_menu_id = edfm_menu_settings.edfm_postid;
    var edfm_toggle_custom_element = edfm_menu_settings.edfm_toggle_custom_element;

    if(edfm_toggle_custom_element != 0){      
      var edfm_toggle_custom_element_id = edfm_menu_settings.edfm_toggle_custom_element_id;

      if(edfm_toggle_custom_element_id != ''){
        var edfm_menu_class = '.edfm-'+edfm_menu_id;
        var edfm_toggle_custom_element_id ='#'+edfm_toggle_custom_element_id;

        $(edfm_toggle_custom_element_id).on('click',function(){
          $(edfm_menu_class).toggleClass('edfm-menu-open');
          $(edfm_menu_class).find('.edfm-toggle').toggleClass('toggle-active');

          var other_open_menu = $(edfm_menu_class).siblings('.edfm-menu-open');
          other_open_menu.find('.edfm-toggle').removeClass('toggle-active');
          other_open_menu.removeClass('edfm-menu-open');

          /* Video Background on/off */
          if($(edfm_menu_class).find('.edfm-video').length){
            edfmPlayer = $(".edfm-video").YTPlayer();
            if($(edfm_menu_class).hasClass('edfm-menu-open')){
              edfmPlayer.YTPPlay();
              //console.log('Player is Playing');
            }else{
              edfmPlayer.YTPPause();
              //console.log('Player is Paused');
            }
          }
        });
      }
    }
  });
  
  /* Fly menu Component count */
  $('.edfm-fly-menu-wrapper-inner').each(function(){
    var selected_menu = $(this);
    div_count = 0;
    selected_menu.find('.edfm-fly-menu-body-part').each(function(){
      div_count++;
    });
    selected_menu.addClass('edfm-menu-block-'+div_count);
  });

  /*ADD CLASS WHEN PLUGIN ACTIVE */
  $('.edfm-fly-menu-wrapper').closest('body').addClass('edfm-plugin-active');

  /* Walker Toggle submenu active */
  var subdivHeight = 0;
  $("body").on('click', '.edfm-toggle-icon',function(){
    var subdivHeight = $(this).parents('.edfm-submenu').innerHeight();

    $(this).toggleClass('edfm-toggle-icon-active');
    $(this).closest('.menu-item').children('.edfm-submenu').toggleClass('edfm-submenu-active');

    var other_open_menu = $(this).closest('.menu-item').siblings('.menu-item-has-children');
    other_open_menu.find('.edfm-toggle-icon-active').removeClass('edfm-toggle-icon-active');
    other_open_menu.find('.edfm-submenu-active').removeClass('edfm-submenu-active');

    $(this).parent('.edfm-list-wrap').siblings('.edfm_position_top .edfm-submenu .edfm-submenu').css('top', subdivHeight);
    $(this).parent('.edfm-list-wrap').siblings('.edfm_position_bottom .edfm-submenu .edfm-submenu').css('bottom', subdivHeight);
  });


  $('.edfm-dropdown-toggle').on('click', function(event) {
    event.preventDefault();
    var subdivHeight = $(this).parents('.edfm-submenu').innerHeight();

    $(this).closest('.edfm-list-wrap').find('.edfm-toggle-icon').toggleClass('edfm-toggle-icon-active');
    $(this).closest('.menu-item').children('.edfm-submenu').toggleClass('edfm-submenu-active');

    var other_open_menu = $(this).closest('.menu-item').siblings('.menu-item-has-children');
    other_open_menu.find('.edfm-toggle-icon-active').removeClass('edfm-toggle-icon-active');
    other_open_menu.find('.edfm-submenu-active').removeClass('edfm-submenu-active');

    $(this).parent('.edfm-list-wrap').siblings('.edfm_position_top .edfm-submenu .edfm-submenu').css('top', subdivHeight);
    $(this).parent('.edfm-list-wrap').siblings('.edfm_position_bottom .edfm-submenu .edfm-submenu').css('bottom', subdivHeight);

    $(this).closest('.menu-item').children('.edfm_drop .edfm_side_menu_sub_menu_animation_1.edfm-submenu').slideToggle();
    $(this).closest('.menu-item').children('.edfm_drop .edfm_side_menu_sub_menu_animation_2.edfm-submenu').toggle('slide');
  });

  /* FOR TOGGLE CLASS */
  $('.edfm-toggle').on('click',function(){
    $(this).toggleClass('toggle-active');
    $(this).closest('.edfm-fly-menu-wrapper').toggleClass('edfm-menu-open');
    
    var other_open_menu = $(this).closest('.edfm-fly-menu-wrapper').siblings('.edfm-menu-open');
    other_open_menu.find('.edfm-toggle').removeClass('toggle-active');
    other_open_menu.removeClass('edfm-menu-open');
  });    

  /*Adding mCustomScrollbar */
  $(window).on("load",function(){
    $(".edfm-fly-menu-wrapper-inner").mCustomScrollbar({
      autoDraggerLength: true,
    });
    $('.edfm-long-description').mCustomScrollbar({
      autoDraggerLength: true,
    });
  });

  /* Find height of menu wrapper */
  var divHeight = $('.edfm-fly-menu-wrapper-inner').innerHeight();
  $('.edfm_position_top .edfm-long-description').css('top', divHeight);
  var divsubHeight = $('.edfm-submenu').innerHeight();
  $('.edfm_position_top .edfm-submenu .edfm-long-description').css('top', divsubHeight);
  /*for bottom menu position*/
  $('.edfm_position_bottom .edfm-long-description').css('bottom', divHeight);
  $('.edfm_position_bottom .edfm-submenu .edfm-long-description').css('bottom', divsubHeight);

  /* js for side menu dropdown */
  $('.edfm_drop .edfm_side_menu_sub_menu_animation_1.edfm-submenu, .edfm_drop .edfm_side_menu_sub_menu_animation_2.edfm-submenu').hide();
  $('.edfm-toggle-icon').on('click' ,function(){
    $(this).closest('.menu-item').children('.edfm_drop .edfm_side_menu_sub_menu_animation_1.edfm-submenu').slideToggle();
    $(this).closest('.menu-item').children('.edfm_drop .edfm_side_menu_sub_menu_animation_2.edfm-submenu').toggle('slide');
  });


  /* js for content push animation */
  $('.edfm-toggle').toggle(function(){
    $('.edfm_position_top.edfm_side_menu_animation_2 ~ div#page').css('top', divHeight);
    $('.edfm_position_bottom.edfm_side_menu_animation_2 ~ div#page').css('bottom', divHeight);
    $('.edfm_side_menu_animation_3.edfm_position_top .edfm-fly-menu-wrapper-inner').css('height', divHeight);
    $('.edfm_position_top.edfm_side_menu_animation_4 ~ div#page').css('top', divHeight);
    $('.edfm_position_bottom.edfm_side_menu_animation_4 ~ div#page').css('bottom', divHeight);
  },function(){
    $('.edfm_position_top.edfm_side_menu_animation_2 ~ div#page').css('top', 0);
    $('.edfm_position_bottom.edfm_side_menu_animation_2 ~ div#page').css('bottom', 0);
    $('.edfm_side_menu_animation_3.edfm_position_top .edfm-fly-menu-wrapper-inner').css('height', 0);
    $('.edfm_position_top.edfm_side_menu_animation_4 ~ div#page').css('top', 0);
    $('.edfm_position_bottom.edfm_side_menu_animation_4 ~ div#page').css('bottom', 0);
  });

  /* js for animation three */
  if($('.edfm_side_menu').hasClass('edfm_side_menu_animation_3')){
    $('body').addClass('edfm_side_menu_animation_3');
  } else{
    $('body').removeClass('edfm_side_menu_animation_3');
  }

  $('.edfm_nav_icon_menu_template_2 .edfm-header-search').prepend('<span class="fa fa-search"></span>');
  $('.edfm_nav_icon_menu_template_2 .edfm-footer-search').prepend('<span class="fa fa-search"></span>');

  $('.edfm_full_screen_menu ul li .edfm-submenu, .edfm_skewed_menu .edfm_skew_menu_sub_menu_animation_1.edfm-submenu').hide();

  $('.edfm_full_screen_menu ul li a.edfm-dropdown-toggle, .edfm_full_screen_menu ul li .edfm-toggle-icon, .edfm_skewed_menu ul li a.edfm-dropdown-toggle, .edfm_skewed_menu ul li .edfm-toggle-icon').on('click', function(){
    console.log('full menu');
    $(this).parent('.edfm-list-wrap').siblings('.edfm_skew_menu_sub_menu_animation_1.edfm-submenu').slideToggle(); 
    $(this).parent('.edfm-list-wrap').siblings('.edfm_full_screen_menu .edfm-submenu').slideToggle();

  });

  /* add span for full screen menu template 3 */
  $('.edfm_full_menu_template_3 .edfm-header-search, .edfm_full_menu_template_3 .edfm-footer-search').prepend('<span class="fa fa-search"></span>');

  /* toggling class for full screen menu template 3 */
  $('.edfm_full_menu_template_3 .edfm-header-search .fa.fa-search').on('click', function(){
    $(this).parent('.edfm_full_menu_template_3 .edfm-header-search').toggleClass('full-menu-search-active');
  });
  $('.edfm_full_menu_template_3 .edfm-footer-search .fa.fa-search').on('click', function(){
    $(this).parent('.edfm_full_menu_template_3 .edfm-footer-search').toggleClass('full-menu-search-active');
  });

  $('.edfm_skewed_menu.edfm_skew_menu_animation_3 .edfm-fly-menu-wrapper-inner').wrap('<div class="edfm-fly-menu-wrapper-outer"></div>');

  var winwidth = $(window).width();
  if(winwidth<=980){
    $('.edfm_position_top .edfm-fly-menu-body, .edfm_position_bottom .edfm-fly-menu-body').prepend('<span class="fa fa-bars"></span>');
  }
  $('.edfm-fly-menu-body span.fa-bars').on('click', function(){
    $('.edfm_position_top .edfm-fly-menu-body .edfm-menu, .edfm_position_bottom .edfm-fly-menu-body .edfm-menu').toggleClass('edfm-menu-active');
  });

  /*single Page Scroll Effect*/
  if($('.edfm-menu').find('a.edfm-menu-link[href^="#"]').length > 0){       
    $(document).on("scroll", onScroll);       
  }

  /** Inline Navigation Js */
  $('.edfm-menu').find('a.edfm-menu-link[href^="#"]').on('click',function (e){
   e.preventDefault();
   console.log('scroll-function');
   var target = $(this).attr('href');
   if($(target).length > 0){
     $('html, body').stop().animate({
      'scrollTop':  $(target).offset().top+1
    }, 900, 'swing', function () {            
     $(document).on("scroll", onScroll);
   });          
   }
 });

  /** Add Class on scroll */
  function onScroll(event){
    var scrollPos = $(document).scrollTop();

    $('.edfm-menu').find('a.edfm-menu-link[href^="#"]').each(function () {
      var currLink = $(this);
      var refElement = $(currLink.attr("href"));
      if(refElement != '#' && $(refElement).length > 0){
        if(refElement.position().top){
          console.log('scroll position: '+scrollPos);
          console.log('a top: '+refElement.position().top);
          console.log('a top + a height:'+refElement.position().top + refElement.height());
          if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.edfm-menu ul li.menu-item').removeClass("current-menu-item current_page_item");
            currLink.closest('.menu-item').addClass("current-menu-item ");
          }
          else{
            currLink.closest('.menu-item').removeClass("current-menu-item current_page_item");
          }
        } 
      }
    });
  }            

});
