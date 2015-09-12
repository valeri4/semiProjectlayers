<?php
if (!$_SESSION['auth']) {
    redirect('login.php');
}
?>