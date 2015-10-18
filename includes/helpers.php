<?php


function redirect($location) {
    header('Location: ' . $location);
    die();
}

function vdd($expression) {
    var_dump($expression);
    die();
}

function vd($expression) {
    var_dump($expression);
}



function dateFormat($userDate) {
    $date = date_create($userDate);
    $bdateview = date_format($date, 'd/m/Y');
    return ($bdateview);
}

//Start Session after LogIn or Registration
function session_write($userSession) {

    $_SESSION['auth'] = true;
    $_SESSION['u_id'] = $userSession->u_id;
    $_SESSION['uuID'] = $userSession->uuid;
    $_SESSION['email'] = $userSession->email;
    $_SESSION['firstName'] = $userSession->firstName;
    $_SESSION['lastName'] = $userSession->lastName;
    $_SESSION['date'] = $userSession->date;
    $_SESSION['gender'] = $userSession->gender;
    $_SESSION['username'] = $userSession->username;
    $_SESSION['about'] = $userSession->about;

}

