<?php

require_once (__DIR__ . '/../includes/DAL.php');
require_once (__DIR__ . '/../includes/helpers.php');

function set_user_cookies($u_id, $username, $email) {

    //Add User Hash For Auto Login
    $user_hash = sha1($username + $email + time());
    //Function from DAL.php
    $sql = "insert into auto_login(a_u_id, a_u_hash) values ('$u_id', '$user_hash')";
    insert($sql);
    //Set Cookie
    $expire = time() + (60 * 60 * 24 * 30);
    setcookie('remember_me', $user_hash, $expire, '/');
}

function update_user_cookies($u_id, $username, $email) {

    //Add User Hash For Auto Login
    $user_hash = sha1($username + $email + time());
    //Function from DAL.php
    $sql = "update auto_login set a_u_hash = '$user_hash' where a_u_id = '$u_id' limit 1";
    $result = update($sql);
    //Set Cookie
    $expire = time() + (60 * 60 * 24 * 30);
    setcookie('remember_me', $user_hash, $expire, '/');
}

function check_user_cookie($user_cookie) {

    $connection = connect();
    $ps = $connection->prepare("select  u_id, u_uID, u_email, u_pwd, u_f_name, u_l_name, u_b_day, u_gender, u_userName, u_about 
                                from auto_login as a
                                left join users as u
                                on u.u_id = a.a_u_id 
                                where a_u_hash = ? limit 1");
    $ps->bind_param("s", $user_cookie); //string
    $ps->execute();
    $ps->bind_result($u_id, $uuid, $email, $password, $firstName, $lastName, $date, $gender, $username, $about);
    $ps->fetch();

    if (!$u_id) {

        return NULL;
    }

    if ($gender == 1) {
        $gender = 'male';
    } else {
        $gender = 'female';
    }

    //Custom date Formating d/m/Y function from helpers.php
    $date = dateFormat($date);

    $userSession = new stdClass();
    $userSession->u_id = $u_id;
    $userSession->uuid = $uuid;
    $userSession->email = $email;
    $userSession->firstName = $firstName;
    $userSession->lastName = $lastName;
    $userSession->date = $date;
    $userSession->gender = $gender;
    $userSession->username = $username;
    $userSession->about = $about;

    //Add userData to Session helpers.php
    session_write($userSession);

    $ps->close();
    $connection->close();

    //Update User Cookie on client side and DB every time after cookie checking
    //update_user_cookies($u_id, $username, $email);

    return TRUE;
}
