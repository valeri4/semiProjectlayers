<?php

require_once (__DIR__ . '/../includes/DAL.php');
require_once (__DIR__ . '/../includes/helpers.php'); //Includes Session Functions

session_start();

function add_post($post) {
    $u_id = $_SESSION['u_id'];
    $uuID = $_SESSION['uuID'];
    
    $postUid = uniqid($uuID);
    
    $connection = connect();
    if(!$ps = $connection->prepare("insert into posts (u_id, p_post, p_postUid) values( ?, ?, ?)")){
        return FALSE;
    }
    $ps->bind_param("iss", $u_id, $post, $postUid);
    if(!$ps->execute()){
        return FALSE;
    }
    $u_id = $ps->insert_id;
    $ps->close();
    $connection->close();
    
    return TRUE;
}



function view_user_posts(){
    if(!$u_id = $_SESSION['u_id']){
        return FALSE;
    }
    
    $sql = "SELECT p_post, p_time, p_postUid FROM posts WHERE u_id = $u_id";
    
    return get_array($sql);
    
}
