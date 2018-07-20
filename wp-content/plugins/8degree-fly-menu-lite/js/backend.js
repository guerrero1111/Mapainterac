/*
 Eight Degree Fly Menu
 Version 1.0.0
 */
/* 
 Created on : Apr 10, 2017, 10:23:04 AM
 Author     : 8Degree Themes
 */

jQuery(document).ready(function ($) {
    $('.edfm-header-close').on('click',function(){
        $(this).parent('.edfm-head-social-link').remove();
    });
    
    //Input field Slider Js
    $('.edfm-range-slider').on('change',function(){
        var slider_value = $(this).val();
        var slider_text = $(this).closest('.edfm-slider-field').find('.edfm-range-slider-text')
        slider_text.val(slider_value);
        slider_text.css('opacity',slider_value);
    });

    //Disable Meta Box Sortable 
    $('#edfm_menu').closest('.meta-box-sortables').sortable({
        disabled: true
    });
    $('#edfm_menu').find('.hndle').css('cursor', 'pointer');


    AjaxUrl = edfm_admin_js_obj.edfm_ajaxurl;
    admin_nonce = edfm_admin_js_obj.edfm_ajax_nonce;

    /*Nav Menu Metabox Js*/
    if ($('#edfm_select_menu').is(':checked')) {
        if(! $('body').hasClass('edfm-menu-active')){
            $('body').addClass('edfm-menu-active');    
        }
    }

    $('#edfm_select_menu').on('click',function(){
        if(this.checked){
            if(! $('body').hasClass('edfm-menu-active')){
                $('body').addClass('edfm-menu-active');    
            }
            var menu_id = $(this).siblings('#edfm_current_menu_id').val();
            var menu_name = $(this).siblings('#edfm_menu_name').val();
            var menu_slug =$(this).siblings('#edfm_menu_slug').val();
            $.ajax({
                url: AjaxUrl,
                type: 'post',
                data: {
                    action: "edfm_select_menu",
                    menu_id: menu_id,
                    menu_name: menu_name,
                    menu_slug: menu_slug,
                    wp_nonce: admin_nonce
                },
                success: function (response) {
                    var response = $(response);
                    console.log(response);
                }
            });
            $('.edfm_nav_launch').fadeIn();
        }else{
            if($('body').hasClass('edfm-menu-active')){
                $('body').removeClass('edfm-menu-active');    
            }
            var menu_id = $(this).siblings('#edfm_current_menu_id').val();
            var menu_name = $(this).siblings('#edfm_menu_name').val();
            var menu_slug =$(this).siblings('#edfm_menu_slug').val();
            $.ajax({
                url: AjaxUrl,
                type: 'post',
                data: {
                    action: "edfm_unselect_menu",
                    menu_id: menu_id,
                    menu_name: menu_name,
                    menu_slug: menu_slug,
                    wp_nonce: admin_nonce
                },
                success: function (response) {
                    var response = $(response);
                    console.log(response);
                }
            });
            $('.edfm_nav_launch').fadeOut();
        }
    });

    $('.nav-menus-php a.menu-delete').on('click',function(){
        if($('body').hasClass('edfm-menu-active')){
            var decision = confirm("Are you sure you want to remove Menu from Fly Menu List?");
            if(decision){
                var edfm_menu_url = $(this).attr('href');
                $.urlParam = function(name){
                    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(edfm_menu_url);
                    if (results==null){
                        return null;
                    }
                    else{
                        return results[1] || 0;
                    }
                }
                var menu_id = $.urlParam('menu');
                $.ajax({
                    url: AjaxUrl,
                    type: 'post',
                    data: {
                        action: "edfm_unselect_menu",
                        menu_id: menu_id,
                        wp_nonce: admin_nonce
                    },
                    success: function (response) {
                        var response = $(response);
                        console.log(response);
                    }
                });

                $('body').removeClass('edfm-menu-active');
            }else{
                alert('Good Choice!');
            }
        }
    });

    /*Nav Menu Pop-up Module Js*/
    $('#menu-to-edit li.menu-item').each(function () {
        if($('body').hasClass('edfm-menu-active')){
            var menu_item = $(this);
            var menu_id = $('input#menu').val();
            console.log('Menu ID: ' + menu_id);
            var title = menu_item.find('.menu-item-title').text();

            if (!title) {
                title = menu_item.find('.item-title').text();
            }

            var id = parseInt(menu_item.attr('id').match(/[0-9]+/)[0], 10);

            var button = $("<span>").addClass("edfm_nav_launch").html('8Degree Fly Menu Lite').on('click', function () {
                if($('body').hasClass('edfm-menu-active')){
                    var depth = menu_item.attr('class').match(/\menu-item-depth-(\d+)\b/)[1];

                    $.ajax({
                        url: AjaxUrl,
                        type: 'post',
                        data: {
                            action: "edfm_show_lightbox_html",
                            menu_item_id: id,
                            menu_item_title: title,
                            menu_item_depth: depth,
                            menu_id: menu_id,
                            wp_nonce: admin_nonce
                        },
                        beforeSend: function () {
                            $('.edfm_menu_wrapper #edfm_menu_settings_frame').css('display', 'block');
                            $('.edfm_menu_wrapper .edfm_overlay').css('display', 'block');
                        },
                        success: function (response) {
                            var response = $(response);

                            var form = response.find('form');
                            form.on("submit", function () {
                                var edfm_menu_item_save = $(this).serialize();
                                //alert(edfm_menu_item_save);
                                $('.edfm-spinner.spinner').addClass('is-active');
                                $.ajax({
                                    url: AjaxUrl,
                                    type: 'post',
                                    data: {
                                        action: "edfm_menu_item_save",
                                        menu_item_id: id,
                                        menu_item_title: title,
                                        menu_item_depth: depth,
                                        menu_id: menu_id,
                                        edfm_menu_item_save: edfm_menu_item_save,
                                        wp_nonce: admin_nonce
                                    },
                                    success: function (save) {
                                        $('.edfm-spinner.spinner').removeClass('is-active');
                                        console.log(save);
                                    }
                                }
                                );
                                return false;
                            });

                            /*Add pop-up HTML*/
                            var pop_up_content = $('.edfm_menu_wrapper .edfm_main_content').html(response);

                            /*Show pop-up on second click*/
                            pop_up_content.closest('.edfm_menu_wrapper').fadeIn();

                            /*Initianlize Icon Picker JS*/
                            $('.icon-picker').iconPicker();

                            /*Pop-up tab js*/
                            $('.nav-menus-php').on('click', 'ul.nav-tab-wrapper li', function () {
                                var tab_id = $(this).attr('data-tab');

                                $('ul.nav-tab-wrapper li').removeClass('nav-tab-active');
                                $('.edfm-tab-content').removeClass('edfm-current');

                                $(this).addClass('nav-tab-active');
                                $("#" + tab_id).addClass('edfm-current');
                            });

                            /*Header enable/disable*/
                            $('.edfm-edit-menu-item-show-header').on('click',function(){
                                if(this.checked){
                                    $(this).closest('.edfm-tab-content').find('.edfm-pop-up-header-content').fadeIn();
                                }else{
                                    $(this).closest('.edfm-tab-content').find('.edfm-pop-up-header-content').fadeOut();
                                }
                            });

                            /*Pop-up Media Uploader JS*/
                            $('.custom_image_background_button').click(function (e) {
                                e.preventDefault();
                                var uploadButton = $(this);
                                var image = wp.media({
                                    title: 'Upload Image',
                                    multiple: false
                                }).open().on('select', function () {
                                    var uploaded_image = image.state().get('selection').first();
                                    console.log(uploaded_image);
                                    var image_url = uploaded_image.toJSON().url;
                                    uploadButton.siblings('.edfm_upload_background_url').val(image_url);
                                    if (uploadButton.siblings('.edfm_upload_background_url').val(image_url) !== '') {
                                        uploadButton.find('.current-background-image img').remove();
                                        uploadButton.find('.current-background-image').append('<img src="'+image_url+'" width="35" height="35"/>');
                                        uploadButton.find('.current-background-image').show();
                                    } else {
                                        uploadButton.find('.current-background-image').hide();
                                    }
                                });
                            });

                            /*Pop-up Module close*/
                            $('.edfm_close_btn').on('click', function () {
                                $(this).closest('.edfm_menu_wrapper').fadeOut();
                            });

                            /*Image Select option*/
                            $('.edfm-icon-select').on('change',function(){
                                var icon_selector = $(this); 
                                var selected_icon = $('option:selected',this).val();
                                switch(selected_icon){
                                    case 'edfm_default_header_icon':
                                    icon_selector.closest('.edfm-nav-menu-field').siblings('.edfm-header-icon-option-wrapper').fadeIn();
                                    icon_selector.closest('.edfm-tab-content').find('.edfm-header-icon-option').hide();
                                    icon_selector.closest('.edfm-pop-up-header-content').find('.edfm-default-header-icon').fadeIn();
                                    break;
                                    case 'edfm_custom_header_icon':
                                    icon_selector.closest('.edfm-nav-menu-field').siblings('.edfm-header-icon-option-wrapper').fadeIn();
                                    icon_selector.closest('.edfm-tab-content').find('.edfm-header-icon-option').hide();
                                    icon_selector.closest('.edfm-pop-up-header-content').find('.edfm-custom-header-icon').fadeIn();
                                    break;
                                    case 'edfm_no_header_icon':
                                    icon_selector.closest('.edfm-nav-menu-field').siblings('.edfm-header-icon-option-wrapper').hide();
                                    break;
                                    case 'edfm_default_icon':
                                    icon_selector.closest('.edfm-nav-menu-field').siblings('.edfm-icon-option-wrapper').fadeIn();
                                    icon_selector.closest('.edfm-tab-content').find('.edfm-icon-option').hide();
                                    icon_selector.closest('.edfm-tab-content').find('.edfm-default-icon').fadeIn();
                                    break;
                                    case 'edfm_custom_icon':
                                    icon_selector.closest('.edfm-nav-menu-field').siblings('.edfm-icon-option-wrapper').fadeIn();
                                    icon_selector.closest('.edfm-tab-content').find('.edfm-icon-option').hide();
                                    icon_selector.closest('.edfm-tab-content').find('.edfm-custom-icon').fadeIn();
                                    break;
                                    case 'edfm_no_icon':
                                    icon_selector.closest('.edfm-nav-menu-field').siblings('.edfm-icon-option-wrapper').hide();
                                    break;
                                }
                            });
                        }
                    });
}else{
    alert('Please select menu as fly menu.');
}
});
$('.item-title', menu_item).append(button);
}
});

/*EDFM Custom post type Js*/
/*Pop-up Media Uploader JS*/
$('.edfm-meta-box-upload').click(function (e) {
    e.preventDefault();
    var uploadButton = $(this);
    var image = wp.media({
        title: 'Upload Image',
        multiple: false
    }).open().on('select', function () {
        var uploaded_image = image.state().get('selection').first();
        console.log(uploaded_image);
        var image_url = uploaded_image.toJSON().url;
        uploadButton.closest('.edfm-header-image').find('.edfm-custom-image-path').attr('value',image_url);
        uploadButton.closest('.edfm-header-image').find('.edfm-custom-image-preview').remove();
        uploadButton.closest('.edfm-header-image').append('<div class="edfm-custom-image-preview"><img src="'+image_url+'"/></div>');
    });
});
$('.edfm-background-upload').click(function (e) {
    e.preventDefault();
    var uploadButton = $(this);
    var image = wp.media({
        title: 'Upload Image',
        multiple: false
    }).open().on('select', function () {
        var uploaded_image = image.state().get('selection').first();
        console.log(uploaded_image);
        var image_url = uploaded_image.toJSON().url;
        uploadButton.closest('.edfm-postbox-fields').find('.edfm-background-upload-url').attr('value',image_url);   
        $('.edfm-preview-menu-inner-wrapper').css('background-image','url("'+image_url+'")');    
    });
});


$('.edfm-enable-header').on('click',function(){
    if(this.checked){
        $(this).closest('.edfm-postbox-header-section').find('.edfm-postbox-header-content').fadeIn();
        $('.edfm-preview-header-wrapper').fadeIn();
    }else{
        $(this).closest('.edfm-postbox-header-section').find('.edfm-postbox-header-content').fadeOut();
        $('.edfm-preview-header-wrapper').fadeOut();
    }
});

$('.edfm-enable-footer').on('click',function(){
    if(this.checked){
        $(this).closest('.edfm-postbox-footer-section').find('.edfm-postbox-footer-content').fadeIn();
        $('.edfm-preview-footer-wrapper').fadeIn();
    }else{
        $(this).closest('.edfm-postbox-footer-section').find('.edfm-postbox-footer-content').fadeOut();
        $('.edfm-preview-footer-wrapper').fadeOut();
    }
}); 

$('.edfm-enable-social-icons').on('click',function(){
    if(this.checked){
        $(this).closest('.edfm-social-icon').find('.edfm-social-outlets-fields').fadeIn();
        $('.edfm-preview-footer-social').fadeIn();
    }else{
        $(this).closest('.edfm-social-icon').find('.edfm-social-outlets-fields').fadeOut();
        $('.edfm-preview-footer-social').fadeOut();
    }
}); 

$('.edfm_search_enable_header').on('click',function(){
    if(this.checked){
        $(this).closest('.edfm-postbox-section').find('.edfm_search_placeholder').fadeIn();
        $('.edfm-preview-header-search').fadeIn();
    }else{
        $(this).closest('.edfm-postbox-section').find('.edfm_search_placeholder').fadeOut();
        $('.edfm-preview-header-search').fadeOut();
    }
}); 

$('.edfm_search_enable_footer').on('click',function(){
    if(this.checked){
        $(this).closest('.edfm-postbox-section').find('.edfm_search_placeholder').fadeIn();
        $('.edfm-preview-footer-search').fadeIn();
    }else{
        $(this).closest('.edfm-postbox-section').find('.edfm_search_placeholder').fadeOut();
        $('.edfm-preview-footer-search').fadeOut();
    }
});

$('.edfm-top-text-option').on('change',function(){
    var icon_selector = $(this); 
    var selected_icon = $('option:selected',this).val();
    if(selected_icon == 'edfm-custom-title'){
        icon_selector.closest('.edfm-postbox-header-content').find('.edfm-top-text-tagline-wrapper').fadeIn();
    }else{
        icon_selector.closest('.edfm-postbox-header-content').find('.edfm-top-text-tagline-wrapper').fadeOut();
    }
    if(selected_icon == 'edfm-no-text'){
        $('.edfm-preview-top-text').fadeOut();
    }else{
        $('.edfm-preview-top-text').fadeIn();
    }
});

$('.edfm-border-type').on('change',function(){
    var border_types = $(this); 
    var border_type = $('option:selected',this).val();
    switch(border_type){
        case 'edfm_border_solid':
        $('.edfm-preview-header-wrapper > div, .edfm-preview-body-wrapper > div, .edfm-preview-footer-wrapper > div').css('border-top','1px solid');
        break;
        case 'edfm_border_dotted':
        $('.edfm-preview-header-wrapper > div, .edfm-preview-body-wrapper > div, .edfm-preview-footer-wrapper > div').css('border-top','1px dotted');
        break;
        case 'edfm_border_dashed':
        $('.edfm-preview-header-wrapper > div, .edfm-preview-body-wrapper > div, .edfm-preview-footer-wrapper > div').css('border-top','1px dashed');
        break;
        default:
        $('.edfm-preview-header-wrapper > div, .edfm-preview-body-wrapper > div, .edfm-preview-footer-wrapper > div').css('border-top','1px none');

    }
});


$('.edfm-bottom-text-option').on('change',function(){
    var icon_selector = $(this); 
    var selected_icon = $('option:selected',this).val();
    if(selected_icon == 'edfm-custom-title'){
        icon_selector.closest('.edfm-postbox-header-content').find('.edfm-bottom-text-tagline-wrapper').fadeIn();
    }else{
        icon_selector.closest('.edfm-postbox-header-content').find('.edfm-bottom-text-tagline-wrapper').fadeOut();
    }
    if(selected_icon == 'edfm-no-text'){
        $('.edfm-preview-bottom-text').fadeOut();
    }else{
        $('.edfm-preview-bottom-text').fadeIn();
    }
});

$('.edfm-image-option').on('change',function(){
    var icon_selector = $(this); 
    var selected_icon = $('option:selected',this).val();
    if(selected_icon == 'edfm-custom-image'){
        icon_selector.closest('.edfm-postbox-fields').find('.edfm-header-image').fadeIn();
    }else{
        icon_selector.closest('.edfm-postbox-fields').find('.edfm-header-image').fadeOut();
    }
    if(selected_icon == 'edfm-no-image'){
        $('.edfm-preview-image').fadeOut();
    }else{
        $('.edfm-preview-image').fadeIn();
    }
});

$('.edfm-body-content-selector').on('change',function(){
    var icon_selector = $(this); 
    var selected_icon = $('option:selected',this).val();
    if(selected_icon == 'edfm-fly-menu'){
        icon_selector.closest('.edfm-postbox-section').find('.edfm-body-fly-menu-wrapper').fadeIn();
        icon_selector.closest('.edfm-postbox-section').find('.edfm-body-custom-content-wrapper').fadeOut();
        $('.edfm-preview-custom-content').fadeOut();
        $('.edfm-preview-menu-content').fadeIn();
    }else{
        icon_selector.closest('.edfm-postbox-section').find('.edfm-body-fly-menu-wrapper').fadeOut();
        icon_selector.closest('.edfm-postbox-section').find('.edfm-body-custom-content-wrapper').fadeIn();
        $('.edfm-preview-menu-content').fadeOut();
        $('.edfm-preview-custom-content').fadeIn();
    }
});

$('.edfm-social-outlets-fields').sortable({containment: "parent" });

$('.edfm-postbox-wrapper').on('click', 'ul.nav-tab-wrapper li', function () {
    var tab_id = $(this).attr('data-tab');

    $('ul.nav-tab-wrapper li').removeClass('nav-tab-active');
    $('.edfm-tab-content').removeClass('edfm-current');

    $(this).addClass('nav-tab-active');
    $("#" + tab_id).addClass('edfm-current');
    
    //Activate CodeMirror for Custom CSS 
    codeMirrorDisplay();

});

function codeMirrorDisplay() {
    var $codeMirrorEditors = $('.edfm-codemirror-textarea');
    $codeMirrorEditors.each(function(i, el) {
        var $active_element = $(el);
        if ($active_element.data('cm')) {
            $active_element.data('cm').doc.cm.toTextArea();
        }
        var codeMirrorEditor = CodeMirror.fromTextArea(el, {
            lineNumbers: true,
            lineWrapping: true
        });
        $active_element.data('cm', codeMirrorEditor);
    });
}

$('.custom_image_background_button').click(function (e) {
    e.preventDefault();
    var uploadButton = $(this);
    var image = wp.media({
        title: 'Upload Image',
        multiple: false
    }).open().on('select', function () {
        var uploaded_image = image.state().get('selection').first();
        console.log(uploaded_image);
        var image_url = uploaded_image.toJSON().url;
        uploadButton.siblings('.edfm_upload_background_url').val(image_url);
        uploadButton.find('.current-background-image').html('<img src="'+image_url+'" width="35" height="35"/>');
        if (uploadButton.siblings('.edfm_upload_background_url').val(image_url) !== '') {
            uploadButton.find('.current-background-image').show();
        } else {
            uploadButton.find('.current-background-image').hide();
        }
    });
});

$('.icon-picker').iconPicker();

var edfm_font_color = {
    palettes: true,
    change: function(event, ui){
        $('.edfm-preview-menu-wrapper div').css('color',ui.color.toString());
        
    }, 
};
$('.edfm-font-color').wpColorPicker(edfm_font_color);

var edfm_bg_color = {
    palettes: true,
    change: function(event, ui){
        $('.v-center-inner').css('background-color',ui.color.toString());
        
    }, 
};
$('.edfm-parent-bg-color').wpColorPicker(edfm_bg_color);

var edfm_border_color = {
    palettes: true,
    change: function(event, ui){
        $('.edfm-preview-menu-wrapper div').css('border-color',ui.color.toString());
        
    }, 
};
$('.edfm-border').wpColorPicker(edfm_border_color);

var edfm_hover = {
    palettes: true,
    change: function(event, ui){
        $('.edfm-preview-content').on('mouseenter',function(){
            var hover_element = $(this).parent().attr('class');
            $('.'+hover_element+':hover').css('background-color',ui.color.toString());
        });
        $('.edfm-preview-content').on('mouseleave',function(){
            var hover_element = $(this).parent().attr('class');
            $('.'+hover_element+':hover').css('background-color','transparent');
        });
        
    } 
};
$('.edfm-hover').wpColorPicker(edfm_hover);

var edfm_notification_bg = {
    palettes: true,
    change: function(event, ui){
         $('.edfm-preview-notification').css('background-color',ui.color.toString()); 
    } 
};
$('.edfm-notification-bg').wpColorPicker(edfm_notification_bg);

var edfm_notification_color = {
    palettes: true,
    change: function(event, ui){
         $('.edfm-preview-notification').css('color',ui.color.toString()); 
    } 
};
$('.edfm-notification-color').wpColorPicker(edfm_notification_color);

$('.edfm-color-picker').wpColorPicker();

//Display Settings ToggleSlide
$('.edfm-toggle-tab-header').on('click',function(){
    $(this).toggleClass('edfm-toggle-active');
    $(this).siblings('.edfm-toggle-tab-body').slideToggle();
});

//Layout Page option
$('.edfm-menu-layout:checked').closest('.edfm-postbox-fields-radio').addClass('edfm-menu-layout-active');
$('.edfm-menu-layout').on('click',function(){
    var selected_layout = $(this).val();
    var select = $(this);
    select.closest('.edfm-tab-content').find('.edfm-postbox-fields-radio').removeClass('edfm-menu-layout-active');
    select.closest('.edfm-postbox-fields-radio').addClass('edfm-menu-layout-active');
    //alert(selected_layout);
    select.closest('.edfm-tab-content').find('.edfm-postbox-fields-layout-content').hide();
    switch(selected_layout){
        case 'edfm_nav_icon_menu':
        select.closest('.edfm-tab-content').find('.edfm-postbox-fields-layout-nav-icon-menu-content').show();
        break;
        case 'edfm_side_menu':
        select.closest('.edfm-tab-content').find('.edfm-postbox-fields-layout-side-menu-content').show();
        break;
        case 'edfm_full_screen_menu':
        select.closest('.edfm-tab-content').find('.edfm-postbox-fields-layout-full-menu-content').show();
        break;
        case 'edfm_skewed_menu':
        select.closest('.edfm-tab-content').find('.edfm-postbox-fields-layout-skew-menu-content').show();
        break;
    }
});


/*Typography js*/
$(".edfm-font-weight").on('change',function(){
    var font_weight = $(this).val();
    //alert(font_weight);
    $(".font-change-preview-span").css({
        "font-weight": font_weight
    });
});

$(".edfm-font-size").on('change',function(){
    var font_size = $(this).val();
    //alert(font_size);
    $(".edfm-preview-menu-wrapper div").css('font-size',font_size+'px');
});

$(".typography-selected").on('change',function(){
    var font_family = $(this).val();
    //alert(font_family);
    WebFont.load({
        google: {
          families: [font_family]
      }
  });

    $(".edfm-preview-menu-wrapper div").css('font-family',font_family);
});

$('.edfm-background-type').on('change',function(){
    var background_type = $(this); 
    var background_type_option = $('option:selected',this).val();
    background_type.closest('.edfm-postbox-section').find('.edfm_background_type').hide();
    switch(background_type_option){
        case 'edfm_parent_image_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_parent_background_image_url').show();
        break;
        case 'edfm_parent_video_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_parent_background_video_url').show();
        break;
        case 'edfm_child_color_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_child_background_color').show();
        break;
        case 'edfm_child_image_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_child_background_image_url').show();
        break;
        case 'edfm_child_video_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_child_background_video_url').show();
        break;
        case 'edfm_description_color_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_description_background_color').show();
        break;
        case 'edfm_description_image_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_description_background_image_url').show();
        break;
        case 'edfm_description_video_background':
        background_type.closest('.edfm-postbox-section').find('.edfm_description_background_video_url').show();
        break;
        default:
        $('.edfm-preview-menu-inner-wrapper').css('background-image','');
    }
});
$('.edfm_nav_icon_options').on('change',function(){
    var edfm_nav_icon_options = $(this); 
    var edfm_nav_icon_option = $('option:selected',this).val();
    edfm_nav_icon_options.closest('.edfm-postbox-section').find('.edfm_nav_icon_option').hide();
    switch(edfm_nav_icon_option){
        case 'edfm_default_nav_icon':
        edfm_nav_icon_options.closest('.edfm-postbox-section').find('.edfm_default_nav_icon_options').show();
        break;
        case 'edfm_custom_nav_icon':
        edfm_nav_icon_options.closest('.edfm-postbox-section').find('.edfm_custom_nav_icon_options').show();
        break;
    }
});

$('#edfm_enable_toggle_text').on('click',function(){
    $(this).closest('.edfm-postbox-section').find('.edfm_enable_text_label').toggle();
});

$('#edfm_toggle_custom_element').on('click',function(){
    $(this).closest('.edfm-postbox-section').find('.edfm_toggle_custom_element_id').toggle();
});

$('.edfm-button-icon').on('click',function(){
    var button_icon_source = $(this).val();
    var button_icon = $(this);
    switch(button_icon_source){
        case 'edfm_default_toggle_icon':
        button_icon.closest('.edfm-postbox-section').find('.edfm-custom-icon-set').hide();
        button_icon.closest('.edfm-postbox-section').find('.edfm-default-icon-set').show();
        break;
        case 'edfm_custom_toggle_icon':
        button_icon.closest('.edfm-postbox-section').find('.edfm-custom-icon-set').show();
        button_icon.closest('.edfm-postbox-section').find('.edfm-default-icon-set').hide();
        break;
        case 'edfm_hamburger_toggle_icon':
        button_icon.closest('.edfm-postbox-section').find('.edfm-custom-icon-set').hide();
        button_icon.closest('.edfm-postbox-section').find('.edfm-default-icon-set').hide();
        break;
    }
});

/*Enable/ Disable Custom CSS*/
$('input#edfm-enable-custom-css').on('change', function() {
    var checked_value = $('input#edfm-enable-custom-css:checked').val();
    if(checked_value == 'on'){
        $(this).closest('.edfm-postbox-fields').siblings('.edfm-postbox-fields').slideDown();
        codeMirrorDisplay();
    }else{
        $(this).closest('.edfm-postbox-fields').siblings('.edfm-postbox-fields').slideUp();
    }
});

/*Show/ Hide Single Page Options*/
$('input#edfm_single_pages').on('change', function() {
    var checked_value = $('input#edfm_single_pages:checked').val();
    if(checked_value == 'on'){
        $(this).closest('.edfm-postbox-section').find('.edfm-hide-singular').fadeOut();
    }else{
        $(this).closest('.edfm-postbox-section').find('.edfm-hide-singular').fadeIn();
    }
});

/*Show/Hide Custom Toggle Settings*/
$('.edfm-toggle-type').on('change', function() {
    var checked_value = $('.edfm-toggle-type:checked').val();
    
    if(checked_value == 'edfm_toggle_default'){
        $(this).closest('.edfm-postbox-section').siblings('.edfm-postbox-section').fadeOut();
    }else{
        $(this).closest('.edfm-postbox-section').siblings('.edfm-postbox-section').fadeIn();
    }
});

/*Show/Hide Font and Color Settings*/
$('.edfm-template-type').on('change', function() {
    
    var checked_value = $('.edfm-template-type:checked').val();
    console.log(checked_value);
    if(checked_value == 'edfm_template_default'){
        $(this).closest('.edfm-postbox-section').siblings('.edfm-postbox-inline').fadeOut();
    }else{
        $(this).closest('.edfm-postbox-section').siblings('.edfm-postbox-inline').fadeIn();
    }
});


/*Change Template Image*/
$('.edfm-template').on('change',function(){
    var selector = $(this);
    var selected_template = $('option:selected',this).val();
    var img_path = edfm_admin_js_obj.edfm_image_path;
    var img_path_1 = img_path+'/edfm-backend-icons/edfm-side-template-1.png';
    var img_path_2 = img_path+'/edfm-backend-icons/edfm-side-template-2.png';
    switch(selected_template){
        case 'edfm_side_menu_template_1':
        selector.siblings('.edfm-template-preview').find('img').attr('src',img_path_1);
        break;
        case 'edfm_side_menu_template_2':
        selector.siblings('.edfm-template-preview').find('img').attr('src',img_path_2);
        break;
    }
});

//Pagination
    $('body').on('click', '.edfm-pagination-wrap .page-numbers', function (e) {
        e.preventDefault();   

        var edfm_url = $(this).attr('href');
        var edfm_question_mark = edfm_url.split('?');
        var edfm_and = edfm_question_mark[1].split('&');
        var edfm_index = '';
        $.each( edfm_and, function( key, value ) {
            if(value.indexOf('paged') > -1){
                edfm_index = value;
            }
        });
        var edfm_equals = edfm_index.split('=');
        
        var page_number = edfm_equals[1];

        var selected_pages = $('#edfm-hidden-values').val();
        
        var $selector = $(this);
        var post_type = $selector.closest('.edfm-fetched-posts-wrapper').find('.edfm-postbox-fields').attr('data-post_type');
        
        if (post_type != '') {
            $.ajax({
                type: 'post',
                url: AjaxUrl,
                data: {
                    post_type: post_type,
                    page_number: page_number,
                    action: 'edfm_fetch_posts',
                    selected_pages: selected_pages,
                    _wpnonce: admin_nonce,
                },
                beforeSend: function (xhr) {
                    $selector.siblings('.edfm-spinner').addClass('is-active');
                },
                success: function (res) {
                    $selector.siblings('.edfm-spinner').removeClass('is-active');
                    $selector.closest('.edfm-fetched-posts-wrapper').html(res);
                }
            });
        } else {
            /*$('#eg-post-type-trigger').parent().append('<div class="eg-error">' + notices.post_type_error + '</div>');*/
        }

    });

    //Update checked elements
    $('body').on('click', '.edfm-post-checkbox', function () {
        var page_id = $(this).val();
        var selected_pages = $('#edfm-hidden-values').val();
        if(selected_pages == ''){
            selected_pages_array = [];
        }else{

            var selected_pages_array = selected_pages.split(',');
        }
        if ($(this).is(':checked')) {
            if ($.inArray(page_id, selected_pages_array) == -1) {
                selected_pages_array.push(page_id);
            }
        } else {
            if ($.inArray(page_id, selected_pages_array) != -1) {
                var index = $.inArray(page_id, selected_pages_array);
                selected_pages_array.splice(index, 1);
            }
        }
        if (selected_pages_array.length > -1) {
            $('#edfm-hidden-values').val(selected_pages_array.join());
        }
    });

});

