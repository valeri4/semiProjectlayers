<?php

require_once 'friendsLogic.php';
require_once (__DIR__ . '/../includes/helpers.php');

$command = $_REQUEST['command'];

switch ($command) {

    case 'get_friend_profile':

        $friend_user_name = $_GET['username'];
        $result = get_friend_data($friend_user_name);
        if (!$result) {
            echo FALSE;
            break;
        }

        if ($result == 'self') {
            echo 'self';
            break;
        }

        echo $result;
        break;


    case 'send_friend_request':
        echo send_request();
        break;

    case 'get_friend_req_result':
        echo get_friends_req_result();
        break;

    case 'get_requests':
        echo get_requests();
        break;

    case 'accept_ignore_request':
        $friend_user_name = $_POST['username'];
        $note_id = $_POST['note_id'];
         
        if (isset($_POST['ignore']) && $ignore = 'ignore') {
            echo accept_ignore_request($friend_user_name, $note_id, $ignore);
            break;
        }

        echo accept_ignore_request($friend_user_name, $note_id);
        break;

    case 'get_all_friends':
        echo get_all_friends();
        break;

    case 'delete_friend':
        $friend_user_name = $_POST['username'];
        echo delete_friend($friend_user_name);
        break;
    
    
    //ALL FRIENDS COUNT!!!!
    case 'get_new_friend_view':
        echo get_new_friend_view();
        break;
    
    
    case 'autocomplete':
        $search_input = $_GET['search_input'];
        echo autocomplete_search($search_input);
        break;
    //default : redirect('../error.php');
}
