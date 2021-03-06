<?php

require_once 'postsLogic.php';

$command = $_REQUEST['command'];

switch ($command) {

    case "load_posts":
        echo json_encode(view_user_posts());
        break;
    
    case "load_frien_posts":
        echo json_encode(view_friend_posts());
        break;

    case "view_all_friends_posts":
        echo json_encode(view_all_friends_posts());
        break;


    case "add_post":
        $add_post = $_POST['addPost'];
        $add_post = addslashes($add_post);
        $add_post = strip_tags($add_post);
        $add_post_length = strlen($add_post);
        if ($add_post_length < 1 || $add_post_length > 1000) {
            echo FALSE;
            break;
        }
        echo add_post($add_post);
        break;


    case "update_post":
        $update_post = $_POST['updatePost'];
        $update_post = addslashes($update_post);
        $update_post = strip_tags($update_post);
        $update_post_length = strlen($update_post);
        if ($update_post_length < 1 || $update_post_length > 1000) {
            echo FALSE;
            break;
        }

        $postUid = $_POST['postUid'];
        $postUid = addslashes($postUid);
        $postUid = strip_tags($postUid);
        $postUid_length = strlen($postUid);
        if ($postUid_length < 10) {
            echo FALSE;
            break;
        }
        echo update_post($update_post, $postUid);
        break;


    case "delete_post":
        $postUid = $_POST['postUid'];
        $postUid = addslashes($postUid);
        $postUid = strip_tags($postUid);
        $postUid_length = strlen($postUid);
        if ($postUid_length < 10) {
            echo FALSE;
            break;
        }
        echo delete_post($postUid);
        break;
}