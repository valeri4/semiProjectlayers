<?php
include_once 'includes/global.php';
session_destroy();
session_unset();
$_SESSION=null;

redirect('login.php');
