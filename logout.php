<?php
include 'config_db.php';
include 'libs/orm/dao.php';
include 'dao/log.php';

session_start();

if (!empty($_SESSION) && $_SESSION['logined']) {
    $log = new Log();
    $log->user_id = $_SESSION['id'];
    $log->operation = "logout";
    $log->operation_detail = "Kullanıcı çıkışı yapıldı";
    $log->insert();
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
}
?>