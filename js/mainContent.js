$(function () {

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
            $('.fullName').text(userData.firstName + " " + userData.lastName);
            $('#lastName').val(userData.lastName);
            $('#email').val(userData.email);
            $('.birthDay').text("Birth date: " + userData.date);
            $('.aboutMeBody').text(userData.about);
            if (userData.gender == '1') {
                $('.gender').text('Gender: Male');
            } else {
                $('.gender').text('Gender: Female');
            }

            //If Image not Default
            if (userData.user_image != 'def_img') {
                $('.userPicure img').attr('src', 'profileImg/' + userData.user_image + '.png');
            } else {
                $('.userPicure img').attr("src", "profileImg/man.jpg");
            }
        }
    });


    $.ajax({
        type: 'GET',
        url: "posts/postsAPI.php",
        data: {command: "load_posts"},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {
            userData = JSON.parse(userData);
            console.dir(userData);
        }
    });

});