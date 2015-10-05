<?php

require_once 'usersLogic.php';
require_once '../includes/helpers.php';

$command = $_REQUEST['command'];

switch ($command) {


    //Registration NickName check if exist
    case 'username':
        $user_name = $_POST['username'];
        $user_name = addslashes($user_name);

        $result = check_reg_nickName($user_name);
        echo json_encode(array(
            'valid' => $result,
        ));

        break;

    //Registration Email check if exist
    case 'email':
        $email = $_POST['email'];
        $email = addslashes($email);

        $result = check_reg_email($email);
        echo json_encode(array(
            'valid' => $result,
        ));

        break;

    // http://localhost/SemiProjectLayers/users/usersAPI.php?command=registration&username=asdf&firstName=bla&lastName=foo&password=12345678&confirmPassword=12345678&email=vvv@dfdfd.com&date=15/12/2015&gender=male
    //Registration new user
    //
    case 'registration':

        $username = $_POST['username'];
        $username = addslashes($username);
        $username = strip_tags($username);
        $username_length = strlen($username);
        if ($username_length < 3 || $username_length > 20) {
            redirect('../error.php');
            echo 'user';
            break;
        }

        $firstName = $_POST['firstName'];
        $firstName = addslashes($firstName);
        $firstName = strip_tags($firstName);
        $firstName_length = strlen($firstName);
        if ($firstName_length < 3 || $firstName_length > 20) {
            redirect('../error.php');
            echo 'first';
            break;
        }


        $lastName = $_POST['lastName'];
        $lastName = addslashes($lastName);
        $lastName = strip_tags($lastName);
        $lastName_length = strlen($lastName);
        if ($lastName_length < 3 || $lastName_length > 20) {
            redirect('../error.php');
            echo 'last';
            break;
        }

        $password = $_POST['password'];
        $password = addslashes($password);
        $password = strip_tags($password);
        $password_length = strlen($password);
        if ($password_length < 8) {
            redirect('../error.php');
            echo 'pass length';
            break;
        }

        $confirmPassword = $_POST['confirmPassword'];
        $confirmPassword = addslashes($confirmPassword);
        $confirmPassword = strip_tags($confirmPassword);

        if (strcmp($password, $confirmPassword) != 0) {
            redirect('../error.php');
            echo 'pass_confirm';
            break;
        }


        $email = $_POST['email'];
        $email = addslashes($email);
        $email = strip_tags($email);
        if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+){1,4}$/", $email) == false) {
            redirect('../error.php');
            echo 'mail';
            break;
        }

        $date = $_POST['date'];
        $date = addslashes($date);
        $date = addslashes($date);
        if (preg_match('/([0-2]\d|3[0-1])\/(0\d|1[0-2])\/(19|20)\d{2}/', $date) == false) {
            //redirect('../error.php');
            echo 'date';
            break;
        }

        $gender = $_POST['gender'];
        $gender = addslashes($gender);
        $gender = strip_tags($gender);
        if (strcmp($gender, 'male') != 0) {
            if (strcmp($gender, 'female') != 0) {
                redirect('../error.php');
                echo 'gender';
                break;
            }
        }

        $registration_result = registration($username, $firstName, $lastName, $password, $email, $date, $gender);

        if ($registration_result == 0) {
            redirect('../error.php');
            break;
        }

        echo $registration_result;
        break;

    //LogIn exist user
    case 'login':
        $email = $_POST['email_login'];
        $user_password = $_POST['pwd_login'];
        echo log_in($email, $user_password);
        break;

    //View User Profile
    case 'get_user_profile':
        echo view_user_profile();
        break;

    //Update User Profile
    case 'update_user_profile':
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $about = $_POST['about'];
        $date = $_POST['date'];
        $gender = $_POST['gender'];
        echo update_user_profile($firstName, $lastName, $date, $gender, $about);
        break;

    case 'password_update':
        $old_password = $_POST['old_password'];
        $new_password = $_POST['password'];
        echo password_update($old_password, $new_password);
        break;
}
