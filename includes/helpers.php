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

