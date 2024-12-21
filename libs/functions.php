<?php
session_start();

function isLoggedIn() {
    return (isset($_SESSION["logined"]) && $_SESSION["logined"] == true);    
}

function isAdmin() {
    return (isLoggedIn() && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin");    
}

function uploadImage(array $file) {
    if(isset($file)) {
        $dest_path = "./img/";
        $filename = $file["name"];
        $fileSourcePath = $file["tmp_name"];
        $fileDestPath = $dest_path.$filename;

        move_uploaded_file($fileSourcePath,$fileDestPath);
    }
}

function safe_html($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data ;
}
?>