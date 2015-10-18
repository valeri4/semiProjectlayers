<?php
require_once 'global.php';
require_once (__DIR__ . '/../users/autoLogin.php');

function auto_login_fail() {
    redirect('login.php');
}

if (isset($_COOKIE['remember_me'])) {

    //Get User Cookie
    $user_cookie = $_COOKIE['remember_me'];
    $user_cookie = addslashes($user_cookie);
    $user_cookie = strip_tags($user_cookie);


    if (!check_user_cookie($user_cookie)) {
        //Remove Cookie
        setcookie('remember_me', "", time() - 10, '/');
        auto_login_fail();
    }
}


if (!$_SESSION['auth']) {
    auto_login_fail();
}
?>