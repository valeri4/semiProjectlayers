<?php
require_once 'postsLogic.php';

$command = $_REQUEST['command'];

switch ($command) {
    case "addPost":
        $add_post = $_POST['addPost'];
        $add_post = addslashes($add_post);
        $add_post = strip_tags($add_post);
        $add_post_length = strlen($add_post);
        if ($add_post_length < 3 || $add_post_length > 1000) {
            redirect('../error.php');
            break;
        }
        
        echo add_post($add_post);
        break;
        
    case "load_posts":
        echo json_encode(view_user_posts());
        break;
}