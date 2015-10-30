$(function () {
    
    //Get UserName Parameter from URL
    var friendURL = window.location.href;

    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null
    }
    
    var userName = getURLParameter(friendURL);
    console.dir(userName);

    /**************************
     * Get User Profile Data
     * 
     * 
     **************************/

    $.ajax({
        type: 'GET',
        url: "friends/friendsAPI.php",
        data: {command: "get_friend_profile", username: userName},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {
            
            if (userData == 'self') {
                        window.location.href = "index.php";
                    }
            
            userData = JSON.parse(userData);
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
                $('.userPicure img').attr('src', 'profileImg/' + userData.user_image + '.png' + '?' + new Date().getTime());
            } else {
                $('.userPicure img').attr("src", "profileImg/man.jpg");
            }
        }
    });




    /**************************
     * View Friend Posts
     * 
     * 
     **************************/

    function dateTimeFormat(postDate) {
        var date = new Date(postDate);
        var hours = date.getHours();
        var minutes = "0" + date.getMinutes();
        var days = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear()
        var formattedTime = hours + ':' + minutes.substr(-2) + " " + days + "/" + month + "/" + year;

        return formattedTime;
    }
    function noPostsToView() {
        $(' <div class="panel panel-default noPostsView"><div class="panel-body"><h4 class="text-center">user does have posts</h4></div></div>').appendTo('#friendPostsBlock');
    }

    function viewPosts(postDate, postText) {
        postDate = dateTimeFormat(postDate);

        $('<div class="panel panel-default""><div class="panel-body"><p class="pull-right">' + postDate + '</p><div class="clearfix"></div><p class="postText">' + postText + '</p></div></div>').appendTo('#friendPostsBlock');
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
            if (!userData) {
                noPostsToView();
            } else {
                $.each(userData, function (i, val) {
                    viewPosts(val.p_time, val.p_post);

                });
            }
        }
    });
    /* View User Posts End*/


});