$(function () {

    var postText, postBlockId, updatedPostText, postBlock;
    
    
    
    //On click => Edit Post
    $('.postsBlock').on('click', '.editPost', function () {

        //Get Post Block Object
        postBlock = $(this).parents('.post');

        postBlockId = postBlock.attr('id');

        //Get Text Value of Post
        postText = $(postBlock).find('p').text();

        //Add Text of Post to Modal Window
        $('#textEditor').val(postText);
        $('#editPostWindow').modal('show');

    });
    
    

    //Update Post
    $('#updatePost').click(function () {
        //Get Updated Post Text
        updatedPostText = $('#textEditor').val();


        postText = 'userPostId=' + postBlockId + '&userPostText=' + updatedPostText;

        $.ajax({
            type: "POST",
            url: "posts/editPost.php",
            data: postText,
            cache: false,
            beforeSend: function () {
                $("#loader").css("visibility", "visible");
            },
            complete: function () {
                $("#loader").css("visibility", "hidden");
            },
            success: function (jsondata) {

                //Update Post 
                $(postBlock).find('p').text(updatedPostText);
            }
        });
    });

    //On click => Delete Post
//    $('.post .deletePost').click(function () {
//        //Get Post Block Object
//        var postBlock = $(this).parents('.post');
//
//        $(postBlock).remove();
//
//    });

    //On click => Delete Post
    $('.postsBlock').on('click', '.deletePost', function () {
        
        postBlock = $(this).parents('.post');
        
        //Get Post ID
        postBlockId = postBlock.attr('id');

        postText = 'userPostDelete='+postBlockId;

        $.ajax({
            type: "POST",
            url: "posts/deletePost.php",
            data: postText,
            cache: false,
            beforeSend: function () {
                $("#loader").css("visibility", "visible");
            },
            complete: function () {
                $("#loader").css("visibility", "hidden");
            },
            success: function (jsondata) {

                $(postBlock).remove();

            }
        });

    });


});