jQuery(document).ready(function($) {
        $('body').on('click', '.rtc-social-add', function(e) {
        e.preventDefault();
        da = $(this).siblings('.rtc-sortable-links').attr('id');
        suffix = da.match(/\d+/);
        var maximum=0;
        $( '.rtc-social-icon-wrap:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                maximum = (value > maximum) ? value : maximum;
            }
        });
        var newinput = $('.rtc-social-template').clone();
        maximum++;
        newinput.find( '.rtc-social-length' ).attr('name','widget-rtc_social_links['+suffix+'][social]['+maximum+']');
        newinput.find( '.user-social-profile' ).attr('name','widget-rtc_social_links['+suffix+'][social_profile]['+maximum+']');
        newinput.html(function(i, oldHTML) {
            return oldHTML.replace(/{{indexes}}/g, maximum);
        });

        $(this).siblings('.rtc-sortable-links').find('.rtc-social-icon-holder').before(newinput.html());
    });
    
    $(".cta-button-number").change(function() {
        if( $(this).val()== 2 )
        {
            $(".button-one-info, .button-two-info").show();
        }
        else{
            $(".button-two-info").fadeOut();
        }
    });

    $('body').on('click', '#remove-icon-list', function(e) {
        e.preventDefault();
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });
    });
    
    $('body').on('click', '.del-rtc-icon', function() {
        var con = confirm(sociconsmsg.msg);
        if (!con) {
            return false;
        }
        $(this).parent().fadeOut('slow', function() {
            $(this).remove();
            $('ul.rtc-sortable-icons input').trigger('change');
        });
        if ($('.del-rtc-icon').length < 1) {
            $('.rtc-social-add').removeAttr('disabled');
        }
    });

    $(document).on('focus','.user-social-profile',function() {
        // if($(this).val()=='')
        // {
            if( $(this).siblings('.rtc-icons-list').length < 1 )
            {
                var $iconlist = $('.rtc-icons-wrap').clone();
                $(this).after($iconlist.html());
                $(this).siblings('.rtc-icons-list').fadeIn('slow');
            }
            
            if ( $(this).siblings('.rtc-icons-list').find('#remove-icon-list').length < 1 )
            {
                var input = '<span id="remove-icon-list" class="dashicons dashicons-no"></span>';
                $(this).siblings('.rtc-icons-list:visible').prepend(input);
            }
        // }
    });

    $(document).on('click','.rtc-icons-list li',function(event) {
        var val = $(this).children().attr('class');
        val = val.substring(val.indexOf('-')+1);
        $(this).parent().siblings('.rtc-social-length').attr('value','https://'+val+'.com');
        $(this).parent().siblings('.rtc-social-icons-field-handle').removeClass('dashicons dashicons-plus').attr('class','fa fa-'+val);
        $(this).siblings('.rtc-icons-wrap-search').remove('slow');
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });
        event.preventDefault();
    });

    $(document).on('click','.rtc-icons-list li',function(event) {
        var val = $(this).children().attr('class');
        val = val.substring(val.indexOf('-')+1);
        $(this).parent().siblings('.user-social-profile').attr('value', val);
        $(this).parent().siblings('.rtc-contact-social-length').attr('value','https://'+val+'.com');
        $(this).parent().siblings('.user-social-links').trigger('change');
        $(this).parent().siblings('.user-social-profile').trigger('change');
        event.preventDefault();
    });
    $(document).on('keyup','.user-social-profile',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.rtc-icons-list').children('li').show().not(function(){
            return matcher.test($(this).find('i').attr('class'));
        }).hide();
    });
    // Set all variables to be used in scope
    var frame;

	// ADD IMAGE LINK
    $('body').on('click','.rara-upload-button',function(e) {
        e.preventDefault();
        var clicked = $(this).closest('div');
        var custom_uploader = wp.media({
            title: 'RARA Image Uploader',
            // button: {
            //     text: 'Custom Button Text',
            // },
            multiple: false  // Set this to true to allow multiple files to be selected
            })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            var str = attachment.url.split('.').pop(); 
            var strarray = [ 'jpg', 'gif', 'png', 'jpeg' ]; 
            if( $.inArray( str, strarray ) != -1 ){
                clicked.find('.rara-screenshot').empty().hide().append('<img src="' + attachment.url + '"><a class="rara-remove-image"></a>').slideDown('fast');
            }else{
                clicked.find('.rara-screenshot').empty().hide().append('<small>'+raratheme_companion_uploader.msg+'</small>').slideDown('fast');    
            }
            
            clicked.find('.rara-upload').val(attachment.id).trigger('change');
            clicked.find('.rara-upload-button').val(raratheme_companion_uploader.change);
        }) 
        .open();
    });

    $('body').on('click','.rara-remove-image',function(e) {
        
        var selector = $(this).parent('div').parent('div');
        selector.find('.rara-upload').val('').trigger('change');
        selector.find('.rara-remove-image').hide();
        selector.find('.rara-screenshot').slideUp();
        selector.find('.rara-upload-button').val(raratheme_companion_uploader.upload);
        
        return false;
    });

    // set var
    var in_customizer = false;

    // check for wp.customize return boolean
    if (typeof wp !== 'undefined') {
        in_customizer = typeof wp.customize !== 'undefined' ? true : false;
    }
    $(document).on('click', '.rara-font-group li', function() {
        var id = $(this).parents('.widget').attr('id');
        $('#' + id).find('.rara-font-group li').removeClass();
        $('#' + id).find('.icon-receiver').siblings('a').remove('.rara-remove-icon');
        $(this).addClass('selected');
        var aa = $(this).parents('.rara-font-awesome-list').find('.rara-font-group li.selected').children('i').attr('class');
        $(this).parents('.rara-font-awesome-list').siblings('p').find('.hidden-icon-input').val(aa);
        $(this).parents('.rara-font-awesome-list').siblings('p').find('.icon-receiver').html('<i class="' + aa + '"></i>');
        $('#' + id).find('.icon-receiver').append('<a class="rara-remove-icon"></a>');

        if (in_customizer) {
            $('.hidden-icon-input').trigger('change');
        }
        return $(this).focus().trigger('change');
    });

    // $(document).on('click', '.link-image-repeat .cross', function() {
        
    // });


    function rara_initColorPicker(widget) {
        widget.find('.rara-widget-color-field').wpColorPicker({
         change: _.throttle(function () { // For Customizer
         jQuery(this).trigger('change');
            }, 3000)
        });
    }
    function onFormUpdate(event, widget) {
       rara_initColorPicker(widget);
    }

    jQuery(document).on('widget-added widget-updated', onFormUpdate);

    jQuery(document).ready(function () {
       jQuery('.widget:has(.rara-widget-color-field)').each(function () {
          rara_initColorPicker(jQuery(this));
       });
    });


        /** Remove icon function */
    $(document).on('click', '.rara-remove-icon', function() {
        var id = $(this).parents('.widget').attr('id');
        $('#' + id).find('.rara-font-group li').removeClass();
        $('#' + id).find('.hidden-icon-input').val('');
        $('#' + id).find('.icon-receiver').html('<i class=""></i>').siblings('a').remove('.rara-remove-icon');
        if (in_customizer) {
            $('.hidden-icon-input').trigger('change');
        }
        return $(this).focus().trigger('change');
    });

    /** To add remove button if icon is selected in widget update event */
    $(document).on('widget-updated', function(e, widget) {
        // "widget" represents jQuery object of the affected widget's DOM element
        var $this = $('#' + widget[0].id).find('.icon-receiver');
        if ($this.find('i').hasClass('fa')) {
            $this.append('<a class="rara-remove-icon"></a>');
        }
    });

    raratheme_pro_check_icon();

    /** function to check if icon is selected and saved when loading in widget.php */
    function raratheme_pro_check_icon() {
        $('.icon-receiver').each(function() {
            var id = $(this).parents('.widget').attr('id');
            if ($('#' + id).find('.icon-receiver').find('i').hasClass('fa')) {
                $('#' + id).find('.icon-receiver').append('<a class="rara-remove-icon"></a>');
            }
        });
    }

     $('body').on('click', '.raratheme-social-add', function(e) {
        e.preventDefault();
        // da = document.getElementsByClassName('raratheme-sortable-icons')[1].getAttribute("id");
        da = $(this).siblings('.raratheme-sortable-icons').attr('id');
        suffix = da.match(/\d+/);
        var len = $('.companion-social-length:visible').length;
        len++;
        var newinput = $('.raratheme-social-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.companion-social-length' ).attr('name','widget-raratheme_social_links['+suffix+'][social]['+len+']');
            // return oldHTML.replace(/{{indexes}}/g, len);
        });

        $(this).siblings('.raratheme-sortable-icons').find('.raratheme-social-icon-holder').before(newinput.html());
    });

     $(document.body).on('blur', '.companion-social-length', function() {
        var $this = $(this),
            $_socicon = false,
            url;

        if ( url = $this.val().toLowerCase() ) {
            $.each(social_icons_admin_widgets.supported_url_icon, function(index, icon) {
                if (url.indexOf(index) !== -1) {
                    $_socicon = icon;
                    return true;
                }
            });

            if (!$_socicon) {
                $.each(social_icons_admin_widgets.allowed_socicons, function(index, icon) {
                    if (url.indexOf(icon) !== -1) {
                        $_socicon = icon;
                        return true;
                    }
                });
            }
        }
        if ($_socicon != false) {

            $this.prev().attr('class', 'raratheme-social-icons-field-handle fontawesome fa-' + $_socicon).css('font-family', 'FontAwesome');
        } else {
            
            $this.prev().attr('class', 'raratheme-social-icons-field-handle dashicons dashicons-plus').css('font-family', 'Dashicons');
        }

    });
    $('body').on('click', '.del-icon', function() {
        var con = confirm(confirming.are_you_sure);
        if (!con) {
            return false;
        }
        $(this).parent().parent().fadeOut('slow', function() {
            $(this).remove();
            $('ul.raratheme-sortable-icons input').trigger('change');
        });
        if ($('.del-icon').length < 1) {
            $('.raratheme-social-add').removeAttr('disabled');
        }
    });

    $('body').on('click', '#add-logo:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.widget-client-logo-repeater').attr('id');
        suffix = da.match(/\d+/);
        len=0;
        $(this).siblings('.widget-client-logo-repeater').children( '.link-image-repeat:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                len = (value > len) ? value : len;
            }
        });
        
        len++;
        var newinput = $('.rrtc-client-logo-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.link-image-repeat' ).attr('data-id',len);
            newinput.find( '.featured-link' ).attr('name','widget-raratheme_client_logo_widget['+suffix+'][link]['+len+']');
            newinput.find( '.widget-upload .link' ).attr('name','widget-raratheme_client_logo_widget['+suffix+'][image]['+len+']');
        });
        $('.cl-repeater-holder').before(newinput.html());
        return $(this).focus().trigger('change');
    });

    $('body').on('click', '#add-faq:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.widget-client-faq-repeater').attr('id');
        suffix = da.match(/\d+/);
        len=0;
        $( '.faqs-repeat:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                len = (value > len) ? value : len;
            }
        });
        len++;
        var newinput = $('.rrtc-faq-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.faqs-repeat' ).attr('data-id',len);
            newinput.find( '.question' ).attr('name','widget-raratheme_companion_faqs_widget['+suffix+'][question]['+len+']');
            newinput.find( '.answer' ).attr('name','widget-raratheme_companion_faqs_widget['+suffix+'][answer]['+len+']');
        });
        $('.cl-faq-holder').before(newinput.html());
        return $(this).focus().trigger('change');
    });
    $('body').on('click', '.cross', function(e) {
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
            if (in_customizer) {
                $('#add-logo').focus().trigger('change');
            }
        });
        return $(this).focus().trigger('change');
    });

    $(document).on('keyup','.rrtc-search-icon',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.rara-font-awesome-list').find('li').show().not(function(){
            return matcher.test($(this).find('i').attr('class'));
        }).hide();
    });
});
