$(function () {

    var uploadFile;

    //Picture preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    //Choose file to uplod, check file type, check file size, call to preview function
    $('#user_image').change(function () {

        $('small').text('');

        var file = this.files[0];
        var imagefile = file.type;

        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            errorFlag = true;
            $('small').text('Image type error');
        }

        if (file.size > (1024 * 1024 * 1.5)) {
            errorFlag = true;
            $('small').text('Image size must be less than 1.5MB');
        }

        else {

            //Add remove icon
            $('.userImg i').css({display: "inherit", cursor: "pointer"});

            //Preview Picture
            readURL(this);

            //Create File Object 
            var getForm = $('form');
            uploadFile = new FormData(getForm[1]);
        }
    });



    $('.userImg i').click(function () {
        $(this).css("display", "none");
        $('.userImg img').attr("src", "profileImg/man.jpg");
        console.dir($('#user_image').val());
        uploadFile = "dafault";
    });



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

        //Upload Picture
        $.ajax({
            url: "users/userUploadImg.php?command=upload",
            type: "POST",
            data: uploadFile,
            processData: false, // tell jQuery not to process the data
            contentType: false   // tell jQuery not to set contentType
        });

        $.ajax({
            url: '',
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