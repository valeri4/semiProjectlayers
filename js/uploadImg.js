$(function () {

    $('#fileUpload').change(function () {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            $('<small class="help-block"  style="display: block; color: red;">File type error</small>').insertAfter(this);
        } else {
            
            var fileUpload = new FormData(this); 
            
            $.ajax({
                type: "POST",
                url: "users/userUploadImg.php",
                data: {command: "upload", fileUpload: fileUpload},
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
                        
                    }
                }
            });
        }
    });
});