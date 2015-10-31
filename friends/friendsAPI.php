<?php

require_once 'friendsLogic.php';
require_once (__DIR__ . '/../includes/helpers.php');

$command = $_REQUEST['command'];

switch ($command) {

    case 'get_friend_profile':
        
        $friend_user_name = $_GET['username'];
        $result = get_friend_data($friend_user_name);
        if(!$result){
            echo FALSE;
            break;
        }
        
        if($result == 'self'){
            echo 'self';
            break;
        }
        
        echo $result;
        break;
        
        
    case 'send_friend_request':
        echo send_request();
        break;
    //default : redirect('../error.php');
}
