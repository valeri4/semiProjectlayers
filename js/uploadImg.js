$(function () {

    var uploadFile;
    var file;

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
        file = this.files[0];
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

            uploadUserImage(uploadFile);
        }
    });


    //Remove user Picture
    $('.userImg i').click(function () {
        $(this).css("display", "none");
        $('.userImg img').attr("src", "profileImg/man.jpg");
        
        file = '';
        $.ajax({
            type: "POST",
            url: "users/usersAPI.php",
            data: {command: "upload", user_image: "def_img"},
            cache: false
        });
    });



    //Upload Picture
    function uploadUserImage(image) {
        $.ajax({
            url: "users/usersAPI.php?command=upload",
            type: "POST",
            data: image,
            processData: false, // tell jQuery not to process the data
            contentType: false   // tell jQuery not to set contentType
        });
    }
});