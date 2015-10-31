
$(function () {

    //Sign Up Collaps in login.php
    $("#signUpFormCollaps").click(function () {
        $(".collapse").collapse('toggle');
    });

    $("#collapsePwd").click(function () {
        $("#collapse1").collapse('toggle');
    });

    $('#datePicker')
            .datepicker({
                format: 'dd/mm/yyyy',
                startDate: '-80y',
                endDate: '-16y'
            })
            .on('changeDate', function (e) {
                // Revalidate the date field
                $('#eventForm').formValidation('revalidateField', 'date');
            });


    /********************************
     * Registration Form Validation *
     ********************************/

    $('#defaultForm').formValidation({
        message: 'This value is not valid',
//        live: 'disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'Please enter value between %s and %s characters long'
                    },
                    notEmpty: {
                        message: 'The username is required and can\'t be empty'
                    },
                    remote: {
                        type: 'POST',
                        url: 'users/usersAPI.php?command=username',
                        message: 'The username is not available'
                    }
                }
            },
            firstName: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'Please enter value between %s and %s characters long'
                    },
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
            lastName: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'Please enter value between %s and %s characters long'
                    },
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
                    remote: {
                        type: 'POST',
                        url: 'users/usersAPI.php?command=email',
                        message: 'The email is not available'
                    }
                }
            },
            password: {
                validators: {
                    stringLength: {
                        min: 8,
                        max: 16,
                        message: 'Please enter value between %s and %s characters long'
                    },
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    different: {
                        field: 'username',
                        message: 'The password can\'t be the same as username'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    }).on('success.form.fv', function (e) {
// Prevent form submission
        e.preventDefault();
        var $form = $(e.target),
                fv = $(e.target).data('formValidation');
        $.ajax({
            url: 'users/usersAPI.php?command=registration',
            type: 'POST',
            data: $form.serialize(),
            success: function (result) {
                //If Registration passed -> redirect to index.php
                if (result == 1) {
                    window.location.href = "about.php";
                }
            }
        });
    });
    /**************************************/
    /* Custom Login Form Validation      */
    /*************************************/

    var email_logIn = $('#email_login');
    var pwd_logIn = $('#pwd_login');
    var fieldId, errMsg = '';
    //   var emailErrFlag = false;
    var passErrFlag = false;
    //Adding Bootstrap Error Class 
    function addErrorClass(fieldId, errMsg) {
        $('#' + fieldId).parent().addClass("has-error has-feedback");
        //  $('<span class="glyphicon glyphicon-remove form-control-feedback"></span>').insertAfter('#' + fieldId);
        $('<small class="help-block"  style="display: block;">' + errMsg + '</small>').insertAfter('#' + fieldId + ':last');
    }

    //Remove Bootstrap Error Class 
    function removeErrorClass(fieldId) {
        $('#' + fieldId).parent().removeClass("has-error has-feedback");
        $('#' + fieldId).next().remove();
        $('#' + fieldId).next().remove();
    }


    //Email & Password Validation 
    $('#logInSubmit').click(function () {


        var rememberMeFlag = false;
        if ($('#remember_me').is(':checked')) {
            rememberMeFlag = true;
        }

        //  var dataString = 'email_login=' + email_logIn.val() + '&pwd_login=' + pwd_logIn.val();

        $.ajax({
            type: "POST",
            url: "users/usersAPI.php",
            data: {command: "login", email_login: email_logIn.val(), pwd_login: pwd_logIn.val(), remember_me: rememberMeFlag},
            cache: false,
            beforeSend: function () {
                $("#loader").css("visibility", "visible");
            },
            complete: function () {
                $("#loader").css("visibility", "hidden");
            },
            success: function (data) {
                if (data)
                {
                    //If Password or Email wrong -> Add bootstrap error to field
                    if (data == 0) {
                        fieldId = 'pwd_login';
                        errMsg = 'Wrong Email or Password';
                        if (!passErrFlag) {
                            addErrorClass(fieldId, errMsg);
                            passErrFlag = true;
                        }
                    }
                    //If login passed -> redirect to index.php
                    if (data == 1) {
                        window.location.href = "index.php";
                    }
                }
            }
        });
    });
    //If User press Enter on the login form -> Execute Submit
    $('#formLogIn').keypress(function (e) {
        if (e.keyCode == 13) {
            $('#logInSubmit').click();
        }
    });
//    //If email was wrong and user start typing -> Remove Bootstrap error class  
//    $('#email_login').keydown(function () {
//        if (emailErrFlag) {
//            removeErrorClass('email_login');
//            emailErrFlag = false;
//        }
//    });
    //If password was wrong and user start typing -> Remove Bootstrap error class
    $('#pwd_login').keydown(function () {
        if (passErrFlag) {
            removeErrorClass('pwd_login');
            passErrFlag = false;
        }
    });
});
