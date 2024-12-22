<?php

require "libs/functions.php";

include 'config_db.php';
include 'libs/orm/dao.php';
include 'dao/user.php';

if (isLoggedIn()) {
    header("Location: index.php");
}

$username = $password = "";
$usernameErr = $passwordErr = $loginErr = "";

if (isset($_POST["login"])) {

    if (empty($_POST["username"])) {
        $usernameErr = "Kullanıcı adı gerekli alan.";
    } else {
        $username = safe_html($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Parola gerekli alan.";
    } else {
        $password = safe_html($_POST["password"]);
    }

    if (empty($usernameErr) && empty($passwordErr)) {

        $item = new User();
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $r = $item->checkLogin($username, $password);

        if ($r !== NULL) {

            $_SESSION["logined"] = true;
            $_SESSION["id"] = $r['id'];
            $_SESSION["username"] = $r['username'];
            $_SESSION["name"] = $r['name'];
            $_SESSION["user_type"] = $r['user_type'];
            $_SESSION["image_url"] = $r['image_url'];
            $_SESSION["newLogined"] = true;

            header("Location: index.php");
        } else {
            $loginErr = "Kullanıcı adı ve/veya Parola yanlış";
        }
    }
}
?>
<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<div class="container-fluid my-3">

    <div class="row">
        <div class="col-12">
            <form id="loginForm" action="login.php" method="post">
                <div class="mb-1">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
                        <div class="text-danger"><?php echo $usernameErr; ?></div>
                </div>
                <div class="mb-1">
                    <label for="password">Parola</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>">
                        <div class="text-danger"><?php echo $passwordErr; ?></div>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Giriş Yap</button>
            </form>
        </div>
    </div>

</div>
<?php
if (!empty($loginErr)) {
    echo "<script type='text/javascript'>\n";
    echo "$.notify('" . $loginErr . "', { position:'left bottom' });\n";
    echo "$('#loginForm').form('clear');\n";
    echo "$('#username').focus();\n";
    echo "</script>\n";
}
?>
<?php include "partials/_footer.php" ?>
