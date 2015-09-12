<?php

require_once '../includes/DAL.php';
require_once '../includes/helpers.php'; //Includes Session Functions


/* * *********************
  Registration Block
 * ********************* */

//Check if userName exist
function check_reg_nickName($user_name) {
    $connection = connect();
    $ps = $connection->prepare("select u_userName from users WHERE u_userName=? LIMIT 1");
    $ps->bind_param("s", $user_name); //string
    $ps->execute();
    $ps->bind_result($user_name_check);
    $ps->fetch();

    $ps->close();
    $connection->close();

    $isAvailable = false;

    if (!$user_name_check) {
        $isAvailable = true;
    }

    return json_encode(array(
        'valid' => $isAvailable,
    ));
}

//Check if Email exist
function check_reg_email($email) {
    $connection = connect();
    $ps = $connection->prepare("select u_email from users WHERE u_email=? LIMIT 1");
    $ps->bind_param("s", $email); //string
    $ps->execute();
    $ps->bind_result($email_check);
    $ps->fetch();
    $ps->close();
    $connection->close();

    $isAvailable = false;

    if (!$email_check) {
        $isAvailable = true;
    }

    return json_encode(array(
        'valid' => $isAvailable,
    ));
}

//Registration New User
function registration($username, $firstName, $lastName, $password, $email, $date, $gender) {

    //gender convert
    if ($gender == "male") {
        $gender = 1;
    } else {
        $gender = 0;
    }
    //generate UUID
    $uuid = uniqid(rand(), true);
    //Date convert to SQl format
    $date = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
    //Password encryption
    $password = password_hash($password, PASSWORD_DEFAULT);

    $connection = connect();
    $ps = $connection->prepare("insert into users (u_uID, u_email, u_pwd, u_f_name, u_l_name, u_b_day, u_gender, u_userName) values( ?, ?, ?, ?, ?, ?, ?, ?) ");
    $ps->bind_param("ssssssis", $uuid, $email, $password, $firstName, $lastName, $date, $gender, $username);
    $ps->execute();
    $ps->close();
    $connection->close();

    //Custom date Formating d/m/Y function from helpers.php
    $date = dateFormat($date);

    $userSession = new stdClass();
    $userSession->uuid = $uuid;
    $userSession->firstName = $firstName;
    $userSession->lastName = $lastName;
    $userSession->date = $date;
    $userSession->username = $username;
    $userSession->about = $about;

    //Add userData to Session
    session_write($userSession);

    return TRUE;
}

/* * *********************
  LogIn Block
 * ********************* */

function log_in($email, $user_password) {
    $connection = connect();
    $ps = $connection->prepare("select u_uID, u_email, u_pwd, u_f_name, u_l_name, u_b_day, u_gender, u_userName, u_about from users WHERE u_email=? LIMIT 1");
    $ps->bind_param("s", $email); //string
    $ps->execute();
    $ps->bind_result($uuid, $email, $password, $firstName, $lastName, $date, $gender, $username, $about);
    $ps->fetch();

    //if Email wrong return "email" to front End
    if (!$email) {
        return "email";
    }

    //If Password wrong return "password" to front End
    if (!password_verify($user_password, $password)) {
        return "password";
    }

    //Custom date Formating d/m/Y function from helpers.php
    $date = dateFormat($date);

    $userSession = new stdClass();
    $userSession->uuid = $uuid;
    $userSession->email = $email;
    $userSession->firstName = $firstName;
    $userSession->lastName = $lastName;
    $userSession->date = $date;
    $userSession->username = $username;
    $userSession->about = $about;


    //Add userData to Session
    session_write($userSession);



    $ps->close();
    $connection->close();

    return TRUE;
}
