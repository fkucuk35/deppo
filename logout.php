<?php
include 'config_db.php';
include 'libs/orm/dao.php';

session_start();

if (!empty($_SESSION) && $_SESSION['logined']) {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
}
?>