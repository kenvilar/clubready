'use strict';
$(document).ready(function () {
    //=================Preloader===========//
    $(window).on('load', function () {
        $('.preloader img').fadeOut();
        $('.preloader').fadeOut();
    });
    //=================end of Preloader===========//

    $("#forgot_password").bootstrapValidator({
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required.'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address.'
                    },
                }
            }
        }
    });

});
