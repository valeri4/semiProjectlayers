$(function () {

    //Get UserName Parameter from URL
    var friendURL = window.location.href;

    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null;
    }

    var userName = getURLParameter(friendURL);
    console.dir(userName);



    /****** View Profile and Posts if URL has username ******/

    function friendUser(userName) {

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
            $(' <div class="panel panel-default noPostsView"><div class="panel-body"><h4 class="text-center">user does not have posts</h4></div></div>').appendTo('#friendPostsBlock');
        }


        function notFriends() {
            $('#friendPostsBlock').html("Only friends can see this content. Add <a href='#addToFriends'>" + firstName + " " + lastName + "</a> to friends");
        }

        function viewPosts(postDate, postText) {
            postDate = dateTimeFormat(postDate);

            $('<div class="panel panel-default""><div class="panel-body"><p class="pull-right">' + postDate + '</p><div class="clearfix"></div><p class="postText">' + postText + '</p></div></div>').appendTo('#friendPostsBlock');
        }

        function get_friend_posts() {
            $.ajax({
                type: 'GET',
                url: "posts/postsAPI.php",
                data: {command: "load_frien_posts"},
                error: function (err) {
                    console.log("Error: " + err.status);
                },
                success: function (userData) {
                    userData = JSON.parse(userData);
                    if (userData == 'not_friends') {
                        notFriends();
                    } else {
                        if (!userData) {
                            noPostsToView();
                        } else {
                            $.each(userData, function (i, val) {
                                viewPosts(val.p_time, val.p_post);

                            });
                        }
                    }
                }
            });

        }
        /* View User Posts End*/


        /**************************
         * Get friend Profile Data
         * 
         * 
         **************************/
        var firstName;
        var lastName;

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

                if (userData == 'user_not_exist') {
                    $('#friendPostsBlock').html("<h2>User: " + userName + " does not exist<h2>");
                }

                userData = JSON.parse(userData);
                $('#username').val(userData.username);
                $('.fullName').text(userData.firstName + " " + userData.lastName);
                $('#lastName').val(userData.lastName);
                $('#email').val(userData.email);
                $('.birthDay').text("Birth date: " + userData.date);

                firstName = userData.firstName;
                lastName = userData.lastName;

                if (firstName) {
                    get_friend_posts();
                }

                if (userData.friends == 0) {
                    $('.aboutMeBody').html("<p> Only friends can see this content. Add <a href='#addToFriends" + userName + "'>" + firstName + " " + lastName + "</a> to friends</p>");
                } else {
                    $('.aboutMeBody').text(userData.about);
                }

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
    }





    function send_friend_request() {
        $.ajax({
            type: 'GET',
            url: "friends/friendsAPI.php",
            data: {command: "send_friend_request"},
            error: function (err) {
                console.log("Error: " + err.status);
            },
            success: function (userData) {
                if (userData == 'request_was_sent') {
                    $('#requestModal').modal('show');
                    $('#requestModalBody p').text('Request was sent');
                    setTimeout(function () {
                        window.location.href = 'index.php';
                    }, 3000);
                }
                if (userData == 'request_exist') {
                    $('#requestModal').modal('show');
                    $('#requestModalBody p').text('Error: Request exist');
                    setTimeout(function () {
                        window.location.href = 'index.php';
                    }, 3000);
                }
                if (userData == 'no_friend_id') {
                    window.location.href = 'error.php';
                }
            }
        });
    }


    $('#friendPostsBlock, #aboutBlock').on('click', 'a[href*="addToFriends"]', function () {
        send_friend_request();
    });


    
    $('#friendPostsBlock').on('click', 'a[href*="accept"]', function(){
        console.dir($(this).parent().remove());
    });


    function view_friends_req(count, firstName, lastName, userImg, userName) {

        if (userImg != 'def_img') {
            imgSrc = 'profileImg/' + userImg + '.png';
        } else {
            imgSrc = "profileImg/man.jpg";
        }

        $('#friendPostsBlock').append("<div id='friend_" + count + "' class='friend_req_user'><img src='" + imgSrc + "' alt='User Image' height='50' width='50'/><p><a href='friends.php?"+ userName+"'>" + firstName + " " + lastName + "</a></p><a href='#accept_" + userName + "' class='btn btn-xs btn-success reqAccept' id='" + userName + "'>Accept</a><a href='#Ignore_" + userName + "' class='btn btn-xs btn-danger reqIgnore' id='" + userName + "'>Ignore</a></div>");
    }





    function newFriendRequest() {
        $('#friendInfo').remove();
        $.ajax({
            type: 'GET',
            url: "friends/friendsAPI.php",
            data: {command: "get_friend_req_result"},
            error: function (err) {
                console.log("Error: " + err.status);
            },
            success: function (userData) {
                console.dir(userData);
                if (userData == 'no_requests') {
                    $('#friendPostsBlock').html('<p>No friends Requests</p>');
                }
                userData = JSON.parse(userData);
                for (i = 0; i < userData.length; i++) {
                    console.dir(userData[i]);
                    firstName = userData[i].u_f_name;
                    lastName = userData[i].u_l_name;
                    userImg = userData[i].u_image;
                    userName = userData[i].u_userName;

                    view_friends_req(i, firstName, lastName, userImg, userName);
                }


                console.dir(userData.length);
            }
        });
    }

    function allFriends() {
        alert('All Friends');
    }

    if (userName == 'allfriends') {
        allFriends();
    }
    if (userName == 'newFriend') {
        newFriendRequest();
    } else {
        friendUser(userName);
    }
});