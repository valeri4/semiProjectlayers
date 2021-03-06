<?php

require_once (__DIR__ . '/../includes/DAL.php');
require_once (__DIR__ . '/../includes/helpers.php'); //Includes Session Functions
require_once (__DIR__ . '/../includes/class.upload.php');
require_once 'autoLogin.php'; //Includes User Cookies functions

session_start();




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

    return $isAvailable;
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

    return $isAvailable;
}

//Registration New User
function registration($username, $firstName, $lastName, $password, $email, $date, $gender) {
    //Check another time email and username if exist. 
    //If somebody sent registration request don't through front end
    if (!check_reg_nickName($username)) {
        return 0;
    }

    if (!check_reg_email($email)) {
        return 0;
    }

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

    $user_image = 'def_img';

    $connection = connect();
    $ps = $connection->prepare("insert into users (u_uID, u_email, u_pwd, u_f_name, u_l_name, u_b_day, u_gender, u_userName, u_image) values( ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    $ps->bind_param("ssssssiss", $uuid, $email, $password, $firstName, $lastName, $date, $gender, $username, $user_image);
    $ps->execute();
    $u_id = $ps->insert_id;
    $ps->close();
    $connection->close();

    //Custom date Formating d/m/Y function from helpers.php
    $date = dateFormat($date);

    $about = '';

    //gender convert
    if ($gender == 1) {
        $gender = "male";
    } else {
        $gender = 'female';
    }

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

    //Some bug with write to session througt stdClass
    $_SESSION['user_image'] = $user_image;

    set_user_cookies($u_id, $username, $email);

    return TRUE;
}

function about_update_after_registration($about) {

    $u_id = $_SESSION['u_id'];


    $connection = connect();
    $ps = $connection->prepare("UPDATE users SET u_about=? WHERE u_id=?");
    $ps->bind_param("si", $about, $u_id);
    $ps->execute();
    $ps->close();
    $connection->close();


    $_SESSION['about'] = $about;

    return TRUE;
}

/* * *********************
  LogIn Block
 * ********************* */

function log_in($email, $user_password, $remember_me) {

    $connection = connect();
    $ps = $connection->prepare("select u_id, u_uID, u_email, u_pwd, u_f_name, u_l_name, u_b_day, u_gender, u_userName, u_about, u_image from users WHERE u_email=? LIMIT 1");
    $ps->bind_param("s", $email); //string
    $ps->execute();
    $ps->bind_result($u_id, $uuid, $email, $password, $firstName, $lastName, $date, $gender, $username, $about, $user_image);
    $ps->fetch();

    //if Email wrong return "email" to front End
    if (!$email) {
        return 0;
    }

    //If Password wrong return "password" to front End
    if (!password_verify($user_password, $password)) {
        return 0;
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

    //Some bug with write to session througt stdClass
    $_SESSION['user_image'] = $user_image;

    $ps->close();
    $connection->close();

    //If User checked 'Remember me' -> Set Cookies
    if ($remember_me == 'true') {
        update_user_cookies($u_id, $username, $email);
    }

    return TRUE;
}

/* * *********************
  User Profile
 * ********************* */

function view_user_profile() {

    if (!isset($_SESSION['uuID'])) {
        return 'user not logged ';
    }

    if ($_SESSION['user_image'] != 'def_img') {
        $user_image = md5($_SESSION['uuID']);
    } else {
        $user_image = 'def_img';
    }

    return json_encode(array(
        'email' => $_SESSION['email'],
        'firstName' => $_SESSION['firstName'],
        'lastName' => $_SESSION['lastName'],
        'date' => $_SESSION['date'],
        'gender' => $_SESSION['gender'],
        'username' => $_SESSION['username'],
        'about' => $_SESSION['about'],
        'user_image' => $user_image
    ));
}

function update_user_profile($firstName, $lastName, $date, $gender, $about) {

    if (!$_SESSION['auth']) {
        return false;
    }

    $uuID = $_SESSION['uuID'];

    //gender convert
    if ($gender == "male") {
        $gender = 1;
    } else {
        $gender = 0;
    }

    //Date convert to SQl format
    $date = date("Y-m-d", strtotime(str_replace('/', '-', $date)));

    $connection = connect();
    $ps = $connection->prepare("UPDATE users SET u_f_name=?, u_l_name=?, u_b_day=?, u_about=?, u_gender=? WHERE u_uId=? ");
    $ps->bind_param("ssssis", $firstName, $lastName, $date, $about, $gender, $uuID);
    $ps->execute();
    $ps->close();
    $connection->close();

    //Custom date Formating d/m/Y function from helpers.php
    $date = dateFormat($date);

    if ($gender == 1) {
        $gender = 'male';
    } else {
        $gender = 'female';
    }

    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['date'] = $date;
    $_SESSION['gender'] = $gender;
    $_SESSION['about'] = $about;

    return TRUE;
}

function password_update($old_password, $new_password) {

    if (!$_SESSION['auth']) {
        return false;
    }

    $uuID = $_SESSION['uuID'];

    $connection = connect();

    //Get current password
    $ps = $connection->prepare("select u_pwd from users WHERE u_uId=? LIMIT 1");
    $ps->bind_param("s", $uuID); //string
    $ps->execute();
    $ps->bind_result($password);
    $ps->fetch();
    $ps->close();

    if (!password_verify($old_password, $password)) {
        return "password";
    }

    $new_password = password_hash($new_password, PASSWORD_DEFAULT);

    $ps = $connection->prepare("UPDATE users SET u_pwd=? WHERE u_uId=? ");
    $ps->bind_param("ss", $new_password, $uuID);
    $ps->execute();
    $ps->close();
    $connection->close();

    return TRUE;
}

function write_user_image_to_db($userPicture = 'user_uuid') {

    $u_id = $_SESSION['u_id'];

    $connection = connect();
    $ps = $connection->prepare("UPDATE users SET u_image=? WHERE u_id=? ");
    $ps->bind_param("ss", $userPicture, $u_id);
    $ps->execute();
    $ps->close();
    $connection->close();

    //Session Update
    $_SESSION['user_image'] = $userPicture;

    return $userPicture;
}

//Upload User Picture with class.upload.php library
function createUserPicture($userPicture) {

    $user_picture_name = md5($_SESSION['uuID']);

    $userPicture = new Upload($_FILES['user_image']);
    if ($userPicture->uploaded) {
        $userPicture->file_new_name_body = $user_picture_name;
        $userPicture->image_resize = true;
        $userPicture->image_x = 600;
        $userPicture->image_ratio_y = true;
        $userPicture->file_overwrite = true;
        $userPicture->image_convert = 'png';
        // save uploaded image with no changes
        $userPicture->Process('../profileImg');
        if ($userPicture->processed) {
            write_user_image_to_db();
        } else {
            echo 'error : ';
        }
    }
}

//var_dump(password_update(1234, 5555));
