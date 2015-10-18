$(function () {
    //Bug fix
    $('#about').val('');

    $('#u').formValidation({
        message: 'This value is not valid',
        // live: 'disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
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
            url: 'users/usersAPI.php?command=update_about',
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
});