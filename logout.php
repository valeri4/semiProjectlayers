<?php
require_once 'includes/global.php';

setcookie('remember_me', "", time() -100, '/');
session_destroy();
session_unset();
$_SESSION=null;

redirect('login.php');
