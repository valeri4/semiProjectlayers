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

    if (!$result) {
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
        $sql = "select u_uID, u_f_name, u_l_name, u_image, u_userName from users where u_id = $val";
        $result_query = get_object($sql);

        if ($result_query->u_image != 'def_img') {
            $result_query->u_image = md5($result_query->u_uID);
        } else {
            $result_query->u_image = 'def_img';
        }

        //Remnove user ID
        unset($result_query->u_uID);


        $_SESSION['friends_req_count'] = $count;
        $_SESSION["friend_$count"] = $result_query;

        $resultArr[] = $result_query;
    }


    return json_encode($resultArr);
}

function get_friends_req_result() {
    if (isset($_SESSION['friends_req_count']) == false) {
        return 'no_requests';
    }

    $count = $_SESSION['friends_req_count'];

    $resultArr = [];

    for ($i = 1; $i <= $count; $i++) {
        $resultArr[] = $_SESSION["friend_$i"];
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

//Function for Adding or ignore new friend. var note_id -> num of friend in  $_SESSION. var command -> command to execute, add or ignore
function accept_ignore_request($friend_user_name, $note_id, $command = null) {
    $u_id = $_SESSION['u_id'];


    $note_id = addslashes($note_id);
    $note_id = strip_tags($note_id);

    if ($command != null) {
        $command = addslashes($command);
        $command = strip_tags($command);
    }

    $friend_user_name = addslashes($friend_user_name);
    $friend_user_name = strip_tags($friend_user_name);
    $friend_user_name_length = strlen($friend_user_name);
    if ($friend_user_name_length == 0 || $friend_user_name_length > 20) {
        return FALSE;
    }


    ///Check if exist request to me with sended username 
    $connection = connect();
    if (!$ps = $connection->prepare("select u_id from users as u
                                        join friend_request as f
                                        on u_id = req_u_id where u_userName = ?
                                        and req_friend_id = ?")) {
        return FALSE;
    }
    $ps->bind_param("si", $friend_user_name, $u_id);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->bind_result($friend_id);
    $ps->fetch();


    //if request does not exist or 
    if (!$friend_id) {
        return FALSE;
    }

    $ps->close();
    $connection->close();

    //if coommand ignore -> delete user request to me
    if ($command != 'ignore') {
        $sql = "insert into relationships (u_id, friend_id) values ($u_id, $friend_id), ($friend_id, $u_id)";
        insert($sql);

        $sql = "insert into new_friend_temp ( newf_u_id, newf_friend_id) values ($u_id, $friend_id)";
        insert($sql);
    }

    $sql = "delete from friend_request 
            where (req_u_id = $u_id and req_friend_id = $friend_id) 
            or (req_u_id = $friend_id and req_friend_id = $u_id) ";

    delete($sql);

    unset($_SESSION["friend_$note_id"]);
    $_SESSION['friends_req_count'] = -1;

    return TRUE;
}

//var_dump(accept_ignore_request('tet', 2));


function get_new_friend_view(){
    
}



function get_all_friends() {
    $u_id = $_SESSION['u_id'];

    $sql = "select u.u_uID, u_f_name, u_l_name, u_image, u_userName
              from users  as u
              join relationships as r
              on u.u_id = r.u_id where friend_id = $u_id";

    $result = get_array($sql);

    if (!$result) {
        return 'no_friends_to_view';
    }

    $requestsArr = [];

    //Get user Image and unset u_uID after image check
    foreach ($result as $obj) {
        $u_uID = $obj->u_uID;
        $userImg = $obj->u_image;

        if ($userImg != 'def_img') {
            $obj->u_image = md5($u_uID);
        } else {
            $userImg = 'def_img';
        }

        unset($obj->u_uID);
    }

    return json_encode($result);
}

function delete_friend($friend_username) {
    $u_id = $_SESSION['u_id'];

    $friend_username = addslashes($friend_username);
    $friend_username = strip_tags($friend_username);

    $connection = connect();
    if (!$ps = $connection->prepare("select u.u_id
                                     from users  as u
                                     join relationships as r
                                     on u.u_id = r.u_id where friend_id = ? and u.u_userName = ? ")) {
        return FALSE;
    }
    $ps->bind_param("is", $u_id, $friend_username);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->bind_result($friend_id);
    $ps->fetch();
    $ps->close();
    $connection->close();

    if (!$friend_id) {
        return "user_not_exist";
    }

    $sql = "delete from relationships
            where (u_id = $u_id and friend_id = $friend_id) 
            or (u_id = $friend_id and friend_id = $u_id)";
    $result = delete($sql);

    if ($result != 2) {
        return 'delete_error';
    }

    return 'user_deleted';
}
