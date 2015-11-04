$(function () {

//Get UserName Parameter from URL
    var friendURL = window.location.href;
    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null;
    }

    var userName = getURLParameter(friendURL);
    console.dir(userName);



    /**************************
     *
     * View Profile and Posts if URL has username
     * 
     **************************/

    function friendUser(userName) {

        /**********   View Friend Posts       *****************************************/

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
            $('#friendPostsBlock').html("Only friends can see this content. <mark><a href='#addToFriends' class='addTofriendslink'>Add " + firstName + " " + lastName + "</a></mark> to friends");
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
                            $('#friendsContenHeader h3').text('Posts: ');
                            $.each(userData, function (i, val) {
                                viewPosts(val.p_time, val.p_post);
                            });
                        }
                    }
                }
            });
        }
        /* View User Posts End*/

        /**********  Get friend Profile Data       *****************************************/
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






    /**************************
     *
     * Friends Request 
     * 
     **************************/

    /**********  Send Request        *****************************************/
    $('#friendPostsBlock, #aboutBlock').on('click', 'a[href*="addToFriends"]', function () {
        send_friend_request();
    });

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


    /**********  Execute Accept or Ignore       *****************************************/
    function accept_ignore_request(username, note_id, note_idOrg, trueText, falseText, command) {
        var command2Send;

        console.log(command);
        if (command == 'accept') {
            command2Send = {command: "accept_ignore_request", username: username, note_id: note_id};

        } else {
            command2Send = {command: "accept_ignore_request", username: username, note_id: note_id, ignore: 'ignore'};
        }

        $.ajax({
            type: 'POST',
            url: "friends/friendsAPI.php",
            data: command2Send,
            error: function (err) {
                console.log("Error: " + err.status);
            },
            success: function (userData) {
                if (userData == true) {
                    $('#requestModal').modal('show');
                    $('#requestModalBody p').text(username + trueText);
                    $('#' + note_idOrg).remove();
                    bg = $('#requestBadge');
                    if (bg.text() > 1) {
                        bg.text(parseInt(bg.text()) - 1)
                    } else {
                        bg.text(0);
                        headerMsg('No New Friends');
                    }
                }
                if (userData == false) {
                    $('#requestModal').modal('show');
                    $('#requestModalBody p').text(falseText + username);
                }
            }
        });
    }

    /**********  Accept Request        *****************************************/
    $('#friendPostsBlock').on('click', 'a[href*="accept"]', function () {
        note_idOrg = $(this).parent().parent().attr('id');
        note_id = note_idOrg.slice(7);
        note_id = parseInt(note_id) + 1;
        username = $(this).attr('id');
        trueText = ' was appended to friends list';
        falseText = 'Error: Can\'t add to friends ';
        command = 'accept';

        accept_ignore_request(username, note_id, note_idOrg, trueText, falseText, command);

    });

    /**********  Ignore Request        *****************************************/
    $('#friendPostsBlock').on('click', 'a[href*="Ignore_"]', function () {
        note_idOrg = $(this).parent().parent.attr('id');
        note_id = note_idOrg.slice(7);
        note_id = parseInt(note_id) + 1;
        username = $(this).attr('id');
        trueText = ' was ignored';
        falseText = 'Error: Can\'t ignore ';
        command = 'ignore';

        accept_ignore_request(username, note_id, note_idOrg, trueText, falseText, command)
    });




    /**************************
     *
     * View All Requests from Users
     * 
     **************************/
    function headerMsg(msg) {
        $('#friendsContenHeader h3').text(msg);
    }

    function view_friends_req(count, firstName, lastName, userImg, userName) {

        if (userImg != 'def_img') {
            imgSrc = 'profileImg/' + userImg + '.png';
        } else {
            imgSrc = "profileImg/man.jpg";
        }

        $('#friendPostsBlock').append("<div id='friend_" + count + "' class='friend_req_user'><img src='" + imgSrc + "' alt='User Image' height='50' width='50'/><p><a href='friends.php?" + userName + "'>" + firstName + " " + lastName + "</a></p><a href='#accept_" + userName + "' class='btn btn-xs btn-success reqAccept' id='" + userName + "'>Accept</a><a href='#Ignore_" + userName + "' class='btn btn-xs btn-danger reqIgnore' id='" + userName + "'>Ignore</a></div>");
    }

    function newFriendRequest() {
        $('#friendInfo').remove();
        headerMsg('New Friends:');
        $.ajax({
            type: 'GET',
            url: "friends/friendsAPI.php",
            data: {command: "get_friend_req_result"},
            error: function (err) {
                console.log("Error: " + err.status);
            },
            success: function (userData) {
                switch (userData) {
                    case 'no_requests':
                        headerMsg('No New Friends');
                        break;
                    case '[]':
                        headerMsg('No New Friends');
                        break;
                    default:
                        userData = JSON.parse(userData);
                        for (i = 0; i < userData.length; i++) {
                            console.dir(userData[i]);
                            firstName = userData[i].u_f_name;
                            lastName = userData[i].u_l_name;
                            userImg = userData[i].u_image;
                            userName = userData[i].u_userName;
                            view_friends_req(i, firstName, lastName, userImg, userName);
                        }
                }
            }
        });
    }




    /**************************
     *
     * View All Friends
     * 
     **************************/

    var countFriends2view = 0;
    countNewFriends2view = $('#newFriends').text();
    console.log('new count: ' + countNewFriends2view);
    function all_friends_view(count, firstName, lastName, userImg, userName) {

        countFriends2view++;
        console.log(countFriends2view);
        if (userImg != 'def_img') {
            imgSrc = 'profileImg/' + userImg + '.png';
        } else {
            imgSrc = "profileImg/man.jpg";
        }

        $('#friendPostsBlock').append("<div id='friend_" + count + "' class='friend_req_user'><div class='newFriend'><img src='" + imgSrc + "' alt='User Image' height='50' width='50'/><p><a href='friends.php?" + userName + "'>" + firstName + " " + lastName + "</a></p><a href='#remove_" + userName + "' class='btn btn-xs btn-danger reqIgnore' id='" + userName + "'>Remove</a></div></div>");

        if (countFriends2view <= countNewFriends2view) {
            $('.newFriend').css({width: '360px', background: 'rgba(178, 255, 102, .3)'});
        }
    }

    function allFriends() {
        $('#friendInfo').remove();
        $.ajax({
            type: 'GET',
            url: "friends/friendsAPI.php",
            data: {command: "get_all_friends"},
            error: function (err) {
                console.log("Error: " + err.status);
            },
            success: function (userData) {

                switch (userData) {
                    case 'no_friends_to_view':
                        headerMsg('You haven\'t friends');
                        break;
                    default:
                        headerMsg('My Friends:')
                        userData = JSON.parse(userData);
                        for (i = 0; i < userData.length; i++) {
                            console.dir(userData[i]);
                            firstName = userData[i].u_f_name;
                            lastName = userData[i].u_l_name;
                            userImg = userData[i].u_image;
                            userName = userData[i].u_userName;
                            all_friends_view(i, firstName, lastName, userImg, userName);
                        }
                }
                console.dir(userData);

                console.dir(userData.length);
            }
        });
    }


    /**************************
     *
     * Delete Friend
     * 
     **************************/

    function deleteUserModal(body) {
        $('#modalHeader').text('Delete friend');
        $('#requestModalBody p').text(body);
        $('.modal-footer').html('<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>');
        $('#requestModal').modal('show');
    }


    $('#friendPostsBlock').on('click', 'a[href*="remove"]', function () {

        userblock_id = $(this).parent().parent().attr('id');
        userNameDel = $(this).attr('id');

        $('#modalHeader').text('Delete');
        $('#requestModalBody p').text("Are you sure you want to delete: " + userNameDel);
        $('.modal-footer').html("<a href='#removeSure_" + userNameDel + "' class='btn btn-xs btn-success reqAccept'>Yes</a><a href='#NO' class='btn btn-xs btn-danger reqIgnore' data-dismiss='modal'>No</a>");
        $('#requestModal').modal('show');
    });


    $('#requestModal .modal-footer').on('click', 'a[href*="removeSure_"]', function () {
        $.ajax({
            type: 'POST',
            url: "friends/friendsAPI.php",
            data: {command: "delete_friend", username: userNameDel},
            error: function (err) {
                console.log("Error: " + err.status);
            },
            success: function (userData) {
                switch (userData) {
                    case 'user_not_exist':
                        deleteUserModal("Error: " + userNameDel + " does not exist");
                        break;
                    case 'delete_error':
                        deleteUserModal("Error: Can\'t delete " + userNameDel);
                        break;
                    default:
                        $('#' + userblock_id).remove();
                        deleteUserModal(userNameDel + " successfully deleted");
                        countFriends2view--;
                        if (countFriends2view == 0) {
                            headerMsg('You haven\'t friends');
                        }
                }
            }
        });
    });


    /**************************
     *
     * Main Switch Case which controls all requests
     * 
     **************************/


    switch (userName) {
        case 'allfriends':
            allFriends();
            break;
        case 'newFriend':
            newFriendRequest();
            break;
        default:
            friendUser(userName);
    }
}
);