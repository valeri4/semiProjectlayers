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




    /**************************
     * View User Posts
     * 
     * 
     **************************/
    function noPostsToView() {
        $(' <div class="panel panel-default"><div class="panel-body"><h4 class="text-center">No posts to view</h4></div></div>').appendTo('#postsBlock');
    }

    function viewPosts(postId, postDate, postText) {
        //  postDate = Date.parse(postDate);
//        var temp = new Date(postDate);
//        postDate = temp.getDate();

        $('<div class="panel panel-default postBlock" id="' + postId + '"><div class="panel-body"><div class="dropdown pull-right"><button class="btn btn-default postMenu dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" id="editPost">Edit</a></li><li><a href="#" id="deletePost">Delete</a></li></ul></div><p class="pull-right">Date: ' + postDate + '</p><div class="clearfix"></div><p class="postText">' + postText + '</p></div></div>').appendTo('#postsBlock');
    }

    function addPost(postId) {
        //  postDate = Date.parse(postDate);
        var postDate = new Date();
        var postText = $('#addPost').val();

        $('#postsBlock').prepend('<div class="panel panel-default postBlock" id="' + postId + '"><div class="panel-body"><div class="dropdown pull-right"><button class="btn btn-default postMenu dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" id="editPost">Edit</a></li><li><a href="#" id="deletePost">Delete</a></li></ul></div><p class="pull-right">Date: ' + postDate + '</p><div class="clearfix"></div><p class="postText">' + postText + '</p></div></div>');
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




    /**************************
     * Custom Post Validation 
     * 
     * 
     **************************/

    var postTextarea = $('#addPost'); //Input field
    var postButton = $('#postBtn'); //Submit button

    textValidation(postTextarea, postButton);


    function textValidation(postTextarea, postButton) {

        var maxLength = 25; //Max length of input field
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




//    //On click => Edit Post
//    $('.postsBlock').on('click', '.editPost', function () {
//
//        //Get Post Block Object
//        postBlock = $(this).parents('.post');
//
//        postBlockId = postBlock.attr('id');
//
//        //Get Text Value of Post
//        postText = $(postBlock).find('p').text();
//
//        //Add Text of Post to Modal Window
//        $('#textEditor').val(postText);
//        $('#editPostWindow').modal('show');
//
//    });



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

    var postId, postBlock, postText, updateBtn, textEditor;

    $('#postsBlock').on('click', '#deletePost', function () {
        //Get Post Block Object
        postBlock = $(this).parents('.postBlock');

        //Get Post Id
        postId = postBlock.attr('id');
        
        postBlock.remove();
    });

//    $('#editPost').click(function(){
//        console.dir($(this));
//    });
});