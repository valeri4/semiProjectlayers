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

function session_write($userSession) {
    $_SESSION['auth'] = true;
    $_SESSION['uuID'] = $userSession->uuid;
    $_SESSION['firstName'] = $userSession->firstName;
    $_SESSION['lastName'] = $userSession->lastName;
    $_SESSION['date'] = $userSession->date;
    $_SESSION['username'] = $userSession->username;
    $_SESSION['about'] = $userSession->about;
}

function dateFormat($userDate) {
    $date = date_create($userDate);
    $bdateview = date_format($date, 'd/m/Y');
    return ($bdateview);
}

//Call this function to update user information in SESSION
function userArrRefresh($dbCon) {
    $uId = userId();
    $sql = "SELECT * FROM users 
                        WHERE uuId='$uId' LIMIT 1";
    $result = $dbCon->query($sql);
    if (!$result) {
        die('Query failed: ' . $dbCon->error);
    }
    $userArr = $result->fetch_assoc();

    $_SESSION['loggedUser'] = $userArr;
}

