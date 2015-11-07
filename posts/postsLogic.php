<?php

require_once (__DIR__ . '/../includes/DAL.php');
require_once (__DIR__ . '/../includes/helpers.php'); //Includes Session Functions

session_start();

function add_post($post) {
    $u_id = $_SESSION['u_id'];
    $uuID = $_SESSION['uuID'];

    $postUid = uniqid($uuID);

    $connection = connect();
    if (!$ps = $connection->prepare("insert into posts (u_id, p_post, p_postUid) values( ?, ?, ?)")) {
        return FALSE;
    }
    $ps->bind_param("iss", $u_id, $post, $postUid);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->close();
    $connection->close();

    return $postUid;
}






function update_post($post, $postUid) {
    $u_id = $_SESSION['u_id'];

    $connection = connect();
    if (!$ps = $connection->prepare("UPDATE posts SET p_post = ? WHERE u_id = ? AND p_postUid = ? LIMIT 1")) {
        return FALSE;
    }
    $ps->bind_param("sis", $post, $u_id, $postUid);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->close();
    $connection->close();

    return TRUE;
}





function delete_post($postUid) {
    $u_id = $_SESSION['u_id'];

    $connection = connect();
    if (!$ps = $connection->prepare("DELETE FROM posts WHERE u_id = ? AND p_postUid = ? LIMIT 1")) {
        return FALSE;
    }
    $ps->bind_param("is", $u_id, $postUid);
    if (!$ps->execute()) {
        return FALSE;
    }
    $ps->close();
    $connection->close();

    return TRUE;
}




function view_user_posts() {
    if (!$u_id = $_SESSION['u_id']) {
        return FALSE;
    }

    $sql = "SELECT p_post, p_time, p_postUid FROM posts WHERE u_id = $u_id  ORDER BY p_time DESC";


    if (!get_array($sql)) {
        return FALSE;
    }

    return get_array($sql);
}





function view_friend_posts() {
    if (!$u_id = $_SESSION['friend_id']) {
        return "not_friends";
    }

    $sql = "SELECT p_post, p_time FROM posts WHERE u_id = $u_id  ORDER BY p_time DESC";


    if (!get_array($sql)) {
        return FALSE;
    }

    return get_array($sql);
}





function view_all_friends_posts() {
    $u_id = $_SESSION['u_id'];
        

    $sql = "select u_uID, u_f_name, u_l_name, u_userName, p_post, p_time, u_image
            from users as u 
            join relationships as r 
            on u.u_id = r.friend_id 
            join posts as p
            on r.friend_id = p.u_id where r.u_id = $u_id
            order by p_time desc";

    
    $result = get_array($sql);
    
    if (!$result) {
        return FALSE;
    }
    
        foreach ($result as $k) {
            if ($k->u_image != 'def_img') {
                $k->u_image = md5($k->u_uID);
            } else {
                $k->u_image = 'def_img';
            }
            unset($k->u_uID);
        }

    

    return $result;
}


//var_dump(view_all_friends_posts());