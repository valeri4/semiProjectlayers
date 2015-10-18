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

    //  postHtml = '<div class="panel panel-default" id=""><div class="panel-body"><p class="pull-right">Date:</p><div class="clearfix"></div></div></div>';


    /* View User Posts Start*/
    function noPostsToView() {
        $(' <div class="panel panel-default"><div class="panel-body"><h4 class="text-center">No posts to view</h4></div></div>').appendTo('#postsBlock');
    }

    function viewPosts(postId, postDate, postText) {
      //  postDate = Date.parse(postDate);
        
        $('<div class="panel panel-default" id="' + postId + '"><div class="panel-body"><p class="pull-right">Date: ' + postDate + '</p><div class="clearfix"></div>' + postText + '</div></div>').appendTo('#postsBlock');
    }

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
            if (!userData) {
                noPostsToView();
            } else {
                $.each(userData, function (i, val) {
                    viewPosts(val.p_postUid, val.p_time, val.p_post);

                });
            }
        }
    });
        /* View User Posts End*/
    
});
//
//
//        <div class="panel panel-default" id=''>    
//            <div class="panel-body">
//                <p class="pull-right">Date:</p>
//                <div class="clearfix"></div>
//                Design, build, test, and prototype using Bootstrap in real-time from your Web browser. Bootply combines the power of hand-coded HTML, CSS and JavaScript with the benefits of responsive design using Bootstrap. Find and showcase Bootstrap-ready snippets in the 100% free Bootply.com code repository.
//            </div>
//        </div>