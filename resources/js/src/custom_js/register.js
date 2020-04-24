"use strict";
$(document).ready(function () {
    //=================Preloader===========//
    $(window).on('load', function () {
        $('.preloader img').fadeOut();
        $('.preloader').fadeOut();
    });
    //=================end of Preloader===========//
    $('.signup_validator').bootstrapValidator({
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required.'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required.'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required.'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address.'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Please provide a password.'
                    }
                }
            },
            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required.'
                    },
                    identical: {
                        field: 'password',
                        message: 'Please enter the same password.'
                    }
                }
            },
        }
    });
    //password validation
    $('#password').on('keyup', function () {
        var pswd = $("#password input[name='password']").val();
        var pswd_cnf = $("#password-confirm input[name='password_confirmation']").val();
        if (pswd != '') {
            $('.signup_validator').bootstrapValidator('revalidateField', $('#password'));
        }
        if (pswd_cnf != '') {
            $('.signup_validator').bootstrapValidator('revalidateField', $('#password-confirm'));
        }
    })

});
