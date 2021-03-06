$(function () {


    /**************************
     * Get User Profile Data
     * 
     * 
     **************************/

    $.ajax({
        type: 'GET',
        url: "users/usersAPI.php",
        data: {command: "get_user_profile"},
        error: function (err) {
            console.log("Error: " + err.status);
        },
        success: function (userData) {
            userData = JSON.parse(userData);
            $('#username').val(userData.username);
            $('.fullName').text(userData.firstName + " " + userData.lastName);
            $('#lastName').val(userData.lastName);
            $('#email').val(userData.email);
            $('.birthDay').text("Birth date: " + userData.date);
            $('.aboutMeBody').text(userData.about);
            console.log(userData.gender);
            if (userData.gender == 'male') {
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
     * View User Posts
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
        $(' <div class="panel panel-default noPostsView"><div class="panel-body"><h4 class="text-center">No posts to view</h4></div></div>').appendTo('#postsBlock');
    }

    function viewPosts(postId, postDate, postText) {
        postDate = dateTimeFormat(postDate);

        $('<div class="panel panel-default postBlock" id="' + postId + '"><div class="panel-body"><div class="dropdown pull-right"><button class="btn btn-default postMenu dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" id="editPost">Edit</a></li><li><a href="#" id="deletePost">Delete</a></li></ul></div><p class="pull-right">' + postDate + '</p><div class="clearfix"></div><p class="postText">' + postText + '</p></div></div>').appendTo('#postsBlock');
    }

    function addPost(postId) {
        //Remove No Posts Div after Posting a first message
        if ($('.noPostsView').length > 0) {
            $('.noPostsView').remove();
        }

        var postDate = new Date();
        postDate = dateTimeFormat(postDate);
        var postText = $('#addPost').val();

        $('#postsBlock').prepend('<div class="panel panel-default postBlock" id="' + postId + '"><div class="panel-body"><div class="dropdown pull-right"><button class="btn btn-default postMenu dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" id="editPost">Edit</a></li><li><a href="#" id="deletePost">Delete</a></li></ul></div><p class="pull-right">' + postDate + '</p><div class="clearfix"></div><p class="postText">' + postText + '</p></div></div>');
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
                    viewPosts(val.p_postUid, val.p_time, val.p_post);

                });
            }
        }
    });
    /* View User Posts End*/

    /**********   View All Friends Posts       *****************************************/
    function noAllFriendsPostsToView() {
        $(' <div class="panel panel-default noPostsView"><div class="panel-body"><h4 class="text-center">No posts to view</h4></div></div>').appendTo('#allFriendsPosts');
    }


    function viewAllFriendsPosts(postDate, postText, username, firstName, lastName, image) {
        postDate = dateTimeFormat(postDate);
        if(image == 'def_img'){image = 'man.jpg'}
        else{image += '.png' }
        $('<div class="panel panel-default""><div class="panel-body"><p class="allFriendPosts_user"><a href="friends.php?'+ username +'"><img src="profileImg/' + image +'" height="50" width="50"/>' + firstName + ' ' + lastName + '</a></p><p class="pull-right">' + postDate + '</p><div class="clearfix"></div><p class="postText allFriendsPosts">' + postText + '</p></div></div>').appendTo('#allFriendsPosts');
    }


        $.ajax({
            type: 'GET',
            url: "posts/postsAPI.php",
            data: {command: "view_all_friends_posts"},
            error: function (err) {
                console.log("Error: " + err.status);
            },
            success: function (userData) {
                userData = JSON.parse(userData);
                if (userData == 'not_friends') {
                    notFriends();
                } else {
                    if (!userData) {
                        noAllFriendsPostsToView();
                    } else {
                        $.each(userData, function (i, val) {
                            viewAllFriendsPosts(val.p_time, val.p_post, val.u_userName, val.u_l_name, val.u_f_name, val.u_image);
                        });
                    }
                }
            }
        });
  
    /* View User Posts End*/




    /**************************
     * Custom Post Validation 
     * 
     * 
     **************************/

    var postTextarea = $('#addPost'); //Input field
    var postButton = $('#postBtn'); //Submit button

    textValidation(postTextarea, postButton);


    function textValidation(postTextarea, postButton) {

        var maxLength = 1000; //Max length of input field
        var minLength = 1; //Min length of input field
        var errFlag = false;

        function addError(indefecator, errText) {
            indefecator.parent().addClass('has-error');
            indefecator.after('<small class="help-block"  style="display: block; color: red;">' + errText + '</small>');
        }

        function removeError(indefecator) {
            indefecator.parent().removeClass('has-error');
            $('small').remove();
        }

        postTextarea.on('input', function () {
            //Check Error Flag after every character input
            if (errFlag) {
                removeError(postTextarea);
                errFlag = false;
                postButton.prop('disabled', false);
            }

            //Check for min length
            if (postTextarea.val().length < minLength) {
                addError(postTextarea, 'Form can\'t be empty');
                errFlag = true;
                postButton.prop('disabled', 'true');
            }
            //Check for max length
            if (postTextarea.val().length >= maxLength) {
                addError(postTextarea, 'Maximum length of ' + maxLength + ' characters');
                errFlag = true;
                postButton.prop('disabled', 'true');
            }
        });
        /* Custom Validation Start*/
    }




    /**************************
     * Post Send Start
     * 
     * 
     **************************/

    postButton.click(function () {
        $.ajax({
            type: "POST",
            url: "posts/postsAPI.php",
            data: {command: "add_post", addPost: postTextarea.val()},
            cache: false,
            beforeSend: function () {
                $("#loader").css("visibility", "visible");
            },
            error: function (err) {
                console.log("Error: " + err.status + ", " + err.statusText);
            },
            complete: function () {
                $("#loader").css("visibility", "hidden");
            },
            success: function (result) {

                if (result) {
                    addPost(result);
                    postTextarea.val('');
                }
                if (!result) {
                    addError(postTextarea, 'ERROR: Could not append message to Posts');
                }
            }
        });

    });
    /*Post Send End*/





    /**************************
     * Edit Post
     * 
     * 
     **************************/
    var postId, postBlock, postText, updateBtn, textEditor;

    $('#postsBlock').on('click', '#editPost', function () {
        //Get Post Block Object
        postBlock = $(this).parents('.postBlock');

        //Get Post Id
        postId = postBlock.attr('id');
        //Get Text Value of Post
        postText = $(postBlock).find('p.postText');

        textEditor = $('#textEditor');
        updateBtn = $('#updatePost');
        //Show modal window
        textEditor.val(postText.text());
        $('#editPostWindow').modal('show');
        //Run validation function
        textValidation(textEditor, updateBtn);
    });

    $('#updatePost').on('click', function () {
        console.log(postText.text());
        console.log(textEditor.val());

        $.ajax({
            type: "POST",
            url: "posts/postsAPI.php",
            data: {command: "update_post", updatePost: textEditor.val(), postUid: postId},
            cache: false,
            beforeSend: function () {
                $("#loader").css("visibility", "visible");
            },
            error: function (err) {
                console.log("Error: " + err.status + ", " + err.statusText);
            },
            complete: function () {
                $("#loader").css("visibility", "hidden");
            },
            success: function (result) {
                if (result) {
                    postText.text(textEditor.val());
                }
                if (!result) {
                    addError(postTextarea, 'ERROR: The post could not be updated');
                }
            }
        });
    });





    /**************************
     * Remove Post
     * 
     * 
     **************************/

    var postId, postBlock;

    $('#postsBlock').on('click', '#deletePost', function () {
        //Get Post Block Object
        postBlock = $(this).parents('.postBlock');

        //Get Post Id
        postId = postBlock.attr('id');

        $.ajax({
            type: "POST",
            url: "posts/postsAPI.php",
            data: {command: "delete_post", postUid: postId},
            cache: false,
            beforeSend: function () {
                $("#loader").css("visibility", "visible");
            },
            error: function (err) {
                console.log("Error: " + err.status + ", " + err.statusText);
            },
            complete: function () {
                $("#loader").css("visibility", "hidden");
            },
            success: function (result) {
                if (result) {
                    postBlock.remove();
                }
                if (!result) {
                    alert('ERROR: The post could not be deleted');
                }
            }
        });


    });
});