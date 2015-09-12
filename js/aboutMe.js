$(function () {
    var aboutTextAreaEmpty = $('#aboutMeEmpty');
    
    $('#aboutSend').click(function () {
        
        var postText = 'about=' + aboutTextAreaEmpty.val();
        $.ajax({
            type: "POST",
            url: "users/aboutMe.php",
            data: postText,
            cache: false,
            beforeSend: function () {
                $("#loader").css("visibility", "visible");
            },
            complete: function () {
                $("#loader").css("visibility", "hidden");
            },
            success: function () {

                    
                    $(".aboutMe").after(aboutTextAreaEmpty.val());

            }
        });
    });

});