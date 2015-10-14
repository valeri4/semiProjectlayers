<?php
require_once 'includes/global.php';
require_once 'includes/auth.php';
require_once 'includes/header.php';

var_dump($_SESSION['about']);
var_dump($_SESSION['username']);
var_dump($_SESSION['u_id']);
var_dump($_SESSION['uuID']);
var_dump($_COOKIE['remember_me']);

?>




<?php
require_once './includes/footer.php';
