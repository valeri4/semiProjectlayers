<?php

require_once '../includes/DAL.php';

session_start();

//function get_friend_data($friend_user_name) {
//
//    $u_id = $_SESSION['u_id'];
//
//    $connection = connect();
//    if (!$ps = $connection->prepare("
//        select u.u_id, u.u_uID, u_f_name, u_l_name, u_about, u_gender, u_image, u.u_userName, 
//        if(exists(select * from users 
//        where u_userName = ?), 1, 0) as user_exists
//        from users  as u
//        join relationships as r
//        on u.u_id = r.u_id where u_userName = ? and friend_id = ? 
//    ")) {
//        return FALSE;
//    }
//    $ps->bind_param("ssi", $friend_user_name, $friend_user_name, $u_id);
//    if (!$ps->execute()) {
//        return 'execute';
//    }
//    $ps->bind_result($friend_u_id, $friend_u_uID, $friend_first_name, $friend_last_name, $friend_about, $friend_gender, $friend_image, $friend_user_name, $friend_user_name_exists);
//    $ps->fetch();
//
//
//    var_dump('u_id = ' . $friend_u_id, 'uuid = ' . $friend_u_uID, 'first = ' . $friend_first_name, 'last = ' . $friend_last_name, 'about = ' . $friend_about, 'gender = ' . $friend_gender, 'image = ' . $friend_image, 'user name = ' . $friend_user_name, 'user exists = ' . $friend_user_name_exists);
//
//    $_SESSION['friend_search_id'] = $friend_u_id;
//    
//    if(!$friend_u_id){
//        return 'user';
//    }
//
//    $ps->close();
//    $connection->close();
//    
//    return TRUE;
//}
//
//var_dump(get_friend_data('tet'));



function get_friend_data($friend_user_name) {
    $u_id = $_SESSION['u_id'];

    $friend_user_name = addslashes($friend_user_name);
    $friend_user_name = strip_tags($friend_user_name);
    $friend_user_name_length = strlen($friend_user_name);
    if ($friend_user_name_length < 3 || $friend_user_name_length > 20) {
        return FALSE;
    }

    /*     * ********* Check if user exist Start     ************** */
    $connection = connect();
    if (!$ps = $connection->prepare("SELECT u_id FROM users where u_userName = ?")) {
        return FALSE;
    }
    $ps->bind_param("s", $friend_user_name);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->bind_result($user_name_check_exist);
    $ps->fetch();

    if (!$user_name_check_exist) {
        return 'user_not_exist';
    }

    $ps->close();
    $connection->close();
    /*     * ********* Check if user exist End    ************** */

    var_dump($user_name_check_exist);
    var_dump($u_id);


    /*     * ********* Check if a friend and get user data Start     ************** */
    $connection = connect();
    if (!$ps = $connection->prepare("select 
                                    u.u_id, u.u_uID, u_f_name, u_l_name, u_about, u_gender, u_image, u.u_userName
                                    from users  as u
                                    join relationships as r
                                    on u.u_id = r.u_id where r.u_id = ? and friend_id = ?
                                    ")) {
        return FALSE;
    }
    $ps->bind_param("ii", $user_name_check_exist, $u_id);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->bind_result($friend_u_id, $friend_u_uID, $friend_first_name, $friend_last_name, $friend_about, $friend_gender, $friend_image, $friend_user_name);
    $ps->fetch();

    var_dump($friend_u_id, $friend_u_uID, $friend_first_name, $friend_last_name, $friend_about, $friend_gender, $friend_image, $friend_user_name);

    if (!$friend_u_id) {
        return 'not_friend';
    }

    $ps->close();
    $connection->close();
    /*     * ********* Check if a friend and get user data Start     ************** */




    return TRUE;
}

var_dump(get_friend_data("tet"));

function send_request() {

    $u_id = $_SESSION['u_id'];
    $friend_id = $_SESSION['friend_search_id'];

    $connection = connect();
    if (!$ps = $connection->prepare("insert into friend_request (req_u_id, req_friend_id) values( ?, ?)")) {
        return FALSE;
    }
    $ps->bind_param("ii", $u_id, $friend_id);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->close();
    $connection->close();

    return TRUE;
}

function accept_request() {
    
}
