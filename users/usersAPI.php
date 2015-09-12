<?php

require_once 'logRegProfileLogic.php';

$command = $_REQUEST['command'];

switch ($command) {


    //Registration NickName check if exist
    case 'username':
        $user_name = $_POST['username'];
        echo check_reg_nickName($user_name);
        break;

    //Registration Email check if exist
    case 'email':
        $email = $_POST['email'];
        echo check_reg_email($email);
        break;
    
    //Registration new user
    case 'registration':
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $gender = $_POST['gender'];
        echo registration($username, $firstName, $lastName, $password, $email, $date, $gender);
        break;

    //LogIn exist user
    case 'login':
        $email = $_POST['email_login'];
        $user_password = $_POST['pwd_login'];
        echo log_in($email, $user_password);
        break;
}
