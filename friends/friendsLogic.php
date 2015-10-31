<?php

require_once '../includes/DAL.php';
require_once '../includes/helpers.php';

session_start();


function get_friend_data($friend_user_name) {
    $u_id = $_SESSION['u_id'];


    $friend_user_name = addslashes($friend_user_name);
    $friend_user_name = strip_tags($friend_user_name);
    $friend_user_name_length = strlen($friend_user_name);
    if ($friend_user_name_length == 0 || $friend_user_name_length > 20) {
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
        $_SESSION['friend_id'] = null;
        return 'user_not_exist';
    }

    if ($user_name_check_exist == $u_id) {
        return 'self';
    }

    $ps->close();
    $connection->close();
    /*     * ********* Check if user exist End    ************** */



    /*     * ********* Check if frinds ************** */
    $connection = connect();
    if (!$ps = $connection->prepare("select 
                                    u.u_id, u.u_uID, u_f_name, u_l_name, u_about, u_gender, u_image, u_b_day, u_userName
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
    $ps->bind_result($friend_u_id, $friend_u_uID, $friend_first_name, $friend_last_name, $friend_about, $friend_gender, $friend_image, $friend_birthdate, $friend_user_name);
    $ps->fetch();
    $ps->close();
    $connection->close();

    $friend_birthdate = dateFormat($friend_birthdate);

    //If not friends -> get user data
    if (!$friend_u_id) {
        $connection = connect();
        if (!$ps = $connection->prepare("select u_id, u_uID, u_f_name, u_l_name, u_about, u_gender, u_image, u_b_day, u_userName from users where u_id = ?")) {
            return FALSE;
        }
        $ps->bind_param("i", $user_name_check_exist);
        if (!$ps->execute()) {
            return FALSE;
        }
        $ps->bind_result($friend_u_id, $friend_u_uID, $friend_first_name, $friend_last_name, $friend_about, $friend_gender, $friend_image, $friend_birthdate, $friend_user_name);
        $ps->fetch();
        $ps->close();
        $connection->close();

        $friend_birthdate = dateFormat($friend_birthdate);

        $_SESSION['friend_id'] = null;
        $_SESSION['friend_search_id'] = $friend_u_id;

        if ($friend_image != 'def_img') {
            $friend_image = md5($friend_u_uID);
        } else {
            $friend_image = 'def_img';
        }

        return json_encode(array(
            'firstName' => $friend_first_name,
            'lastName' => $friend_last_name,
            'date' => $friend_birthdate,
            'gender' => $friend_gender,
            'user_image' => $friend_image,
            'username' => $friend_user_name,
            'friends' => 0
        ));
    }


    $_SESSION['friend_id'] = $friend_u_id;

    if ($friend_image != 'def_img') {
        $friend_image = md5($friend_u_uID);
    } else {
        $friend_image = 'def_img';
    }

    return json_encode(array(
        'firstName' => $friend_first_name,
        'lastName' => $friend_last_name,
        'date' => $friend_birthdate,
        'gender' => $friend_gender,
        'about' => $friend_about,
        'user_image' => $friend_image,
        'username' => $friend_user_name,
        'friends' => 1
    ));
}

//var_dump(get_friend_data("tet"));

function get_requests() {
    $u_id = $_SESSION['u_id'];

    $sql = "select req_u_id from friend_request where req_friend_id = $u_id";

    $result = get_array($sql);
    
    if(!$result){
        return 'no_requests';
    }

    $requestsArr = [];

    //Get object of users who send "Add frind request"
    foreach ($result as $obj) {
        $requestsArr[] = $obj->req_u_id;
    }


    $resultArr = [];
    $count = 0;
    //Get array of users info who send request
    foreach ($requestsArr as $val) {
        $count++;
        $sql = "select u_uID, u_f_name, u_l_name, u_image from users where u_id = $val";
        $result_query = get_object($sql);

        if ($result_query->u_image != 'def_img') {
            $result_query->u_uID = md5($result_query->u_uID);
        } else {
            $result_query->u_image = 'def_img';
        }
        
        //Remnove user ID
        unset($result_query -> u_uID);
        
        $resultArr[] = $result_query;
    }
    
    
    return json_encode($resultArr);
}



function send_request() {

    $u_id = $_SESSION['u_id'];

    if (!$_SESSION['friend_search_id']) {
        return 'no_friend_id';
    }
    $friend_id = $_SESSION['friend_search_id'];


    $sql = "SELECT req_id FROM friend_request 
            WHERE (req_u_id = $u_id and req_friend_id = $friend_id) 
            or (req_u_id = $friend_id and req_friend_id = $u_id)";
    $result = get_object($sql);

    if ($result) {
        return 'request_exist';
    }

    $sql = "INSERT INTO friend_request (req_u_id, req_friend_id) VALUES ($u_id, $friend_id)";
    insert($sql);

    $_SESSION['friend_search_id'] = null;

    return 'request_was_sent';
}

function accept_request() {
    
}
