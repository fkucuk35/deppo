<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "libs/phpmailer/src/PHPMailer.php";
require "libs/phpmailer/src/Exception.php";
require "libs/phpmailer/src/SMTP.php";

class EmailSettings {

    private static $charset = "utf-8";
    private static $encoding = "base64";
    private static $host = "csmtp.yaanimail.com";
    private static $username = "depo@yapisanpark.com";
    private static $password = "Yapisan135!";
    private static $smtpSecure = "ssl";
    private static $port = 465;
    private static $from = "depo@yapisanpark.com";
    private static $name = "Yapısanpark Depo";

    static function createMailer() {
        $mail = new PHPMailer(true);
        date_default_timezone_set('Europe/Istanbul');
        $mail->CharSet = self::$charset;
        $mail->Encoding = self::$encoding;
        $mail->Host = self::$host;
        $mail->SMTPAuth = true;
        $mail->Username = self::$username;
        $mail->Password = self::$password;
        $mail->SMTPSecure = self::$smtpSecure;
        $mail->Port = self::$port;
        $mail->setFrom(self::$from, self::$name);
        $mail->isSMTP();
        $mail->isHTML(true);
        return $mail;
    }
}

?>