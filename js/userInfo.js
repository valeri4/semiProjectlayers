$(function () {

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

    function showUserImage(userImagePath) {
        d = new Date();
        $('#user_image_preview').attr('src', 'profileImg/' + userImagePath + '.png'+ '?' + new Date().getTime());
        $('.userImg i').css({display: "inherit", cursor: "pointer"});
    }



    //Get User Profile Data
    $.ajax({
        type: 'GET',
        url: "users/usersAPI.php",
        data: {command: "get_user_profile"},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {
            userData = JSON.parse(userData);
            console.dir(userData);
            $('#username').val(userData.username);
            $('#firstName').val(userData.firstName);
            $('#lastName').val(userData.lastName);
            $('#email').val(userData.email);
            $('#bdayCalendar').val(userData.date);
            $('#about').val(userData.about);
            if (userData.gender == 'male') {
                $('#male').prop('checked', true);
            } else {
                $('#female').prop('checked', true);
            }

            //If Image not Default
            if (userData.user_image != 'def_img') {
                showUserImage(userData.user_image);
            }
        }
    });



    //UserInfo Validation
    $('#userInfo').formValidation({
        message: 'This value is not valid',
        // live: 'disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
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
            },
            about: {
                validators: {
                    stringLength: {
                        min: 20,
                        max: 800,
                        message: 'Please enter value between %s and %s characters long'
                    },
                    notEmpty: {
                        message: 'The About is required and cannot be empty'
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
            url: 'users/usersAPI.php?command=update_user_profile',
            type: 'POST',
            data: $form.serialize(),
            success: function (result) {
                //If Registration passed -> redirect to index.php
                if (result == 1) {
                    window.location.href = "index.php";
                }
            }
        });
    });

    var passErrFlag = false;

    function addErrorClass() {
        $('#old_password').parent().removeClass('has-success').addClass("has-error has-feedback");
        //  $('<span class="glyphicon glyphicon-remove form-control-feedback"></span>').insertAfter('#' + fieldId);
        $('<small class="help-block"  style="display: block;">Invalid old password</small>').insertAfter('#old_password:last');
    }

    //Remove Bootstrap Error Class 
    function removeErrorClass() {
        $('#old_password').parent().removeClass("has-error has-feedback");
        $('#old_password').next().remove();
        $('#old_password').next().remove();
    }


    $('#changePassword').formValidation({
        message: 'This value is not valid',
        // live: 'disabled',
//        icon: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh'
//        },
        fields: {
            old_password: {
                validators: {
                    stringLength: {
                        min: 8,
                        max: 16,
                        message: 'Please enter value between %s and %s characters long'
                    },
                    notEmpty: {
                        message: 'The old password is required and cannot be empty'
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
            }
        }
    }).on('success.form.fv', function (e) {
// Prevent form submission
        e.preventDefault();
        var $form = $(e.target),
                fv = $(e.target).data('formValidation');
        $.ajax({
            url: 'users/usersAPI.php?command=password_update',
            type: 'POST',
            data: $form.serialize(),
            success: function (result) {
                //If Registration passed -> redirect to index.php
                if (result == 1) {
                    window.location.href = "index.php";
                }
                if (result == 'password') {
                    //If Password or Email wrong -> Add bootstrap error to field
                    if (!passErrFlag) {
                        addErrorClass();
                        passErrFlag = true;
                    }
                }
            }
        });
    });

    $('#old_password').keydown(function () {
        if (passErrFlag) {
            removeErrorClass();
            passErrFlag = false;
        }
    });
});