jQuery(function ($) {

    $('#pp_paginate_visibility').on('click', function () {
        if (!$(this).val() || $(this).val() == 'unchecked') {
            $(this).val('checked');
        } else {
            $(this).val('unchecked');
        }
    });

    $('#reset_color').on('click', function (e) {
        e.preventDefault();
       $.ajax({
           type: "post",
           url: admin_ajax_action.ajaxurl,
           data: {
               action: 'ppprojects_reset_colors'
           },
           success: function (response) {
               location.reload();
           }
       }); 
    });
});
