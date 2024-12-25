<?php

require_once "libs/phpmailer/config.php";

session_start();

function isLoggedIn() {
    return (isset($_SESSION["logined"]) && $_SESSION["logined"] == true);
}

function isAdmin() {
    return (isLoggedIn() && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin");
}

function uploadImage(array $file) {
    if (isset($file)) {
        $dest_path = "./img/";
        $filename = $file["name"];
        $fileSourcePath = $file["tmp_name"];
        $fileDestPath = $dest_path . $filename;

        move_uploaded_file($fileSourcePath, $fileDestPath);
    }
}

function safe_html($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generateActivationKey() {
    $key = '';
    $keys = array_merge(range(0, 9), range('A', 'Z'));

    for ($i = 0; $i < 125; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return "#" . implode("-", str_split($key, 5));
}

function sendEmail($address, $subject, $body, $altBody) {
    $mail = EmailSettings::createMailer();
    try {
        $mail->addAddress($address);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $altBody;
        $mail->send();
        $result["success"] = true;
        return $result;
    } catch (Exception $e) {
        $result["success"] = false;
        $result["msg"] = $mail->ErrorInfo;
        return $result;
    }
}

?>