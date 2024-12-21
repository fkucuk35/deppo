<?php

session_start();
if (!empty($_SESSION) && $_SESSION['logined']) {

    $_SESSION = array();
    session_destroy();
    
    header("Location: login.php");
}
?>