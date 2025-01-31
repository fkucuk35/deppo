<?php
require "libs/functions.php";

include 'config_db.php';
include 'libs/orm/dao.php';
include 'dao/user.php';
?>

<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<?php
$usernameErr = $emailErr = $nameErr = $passwordErr = $repasswordErr = "";
$username = $email = $name = $password = $repassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $usernameErr = "Kullanıcı adı gerekli alan.";
    } elseif (strlen($_POST["username"]) < 5 or strlen($_POST["username"]) > 20) {
        $usernameErr = "Kullanıcı adı 5-20 karakter aralığında olmalıdır.";
    } elseif (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $_POST["username"])) {
        $usernameErr = "Kullanıcı adı sadece rakam, harf ve alt çizgi karakterlerinden olmalıdır.";
    } else {
        $item = new User();
        $r = $item->checkUsernameValid(trim($_POST["username"]));
        if ($r !== NULL) {
            $usernameErr = "Kullanıcı adı alınmış";
        } else {
            $username = safe_html($_POST["username"]);
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Eposta gerekli alan.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Eposta hatalıdır";
    } else {

        $item = new User();
        $r = $item->checkEmailValid(trim($_POST["email"]));
        if ($r !== NULL) {
            $emailErr = "Bu eposta ile kayıtlı kullanıcı var";
        } else {
            $email = safe_html($_POST["email"]);
        }
    }

    if (empty($_POST["name"])) {
        $nameErr = "Ad Soyad gerekli alan.";
    } else {
        $name = safe_html($_POST["name"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Parola gerekli alan.";
    } else {
        $password = safe_html($_POST["password"]);
    }

    if ($_POST["password"] != $_POST["repassword"]) {
        $repasswordErr = "Parola tekrar alanı eşleşmiyor.";
    } else {
        $repassword = safe_html($_POST["repassword"]);
    }

    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($repasswordErr)) {

        $item = new User();
        $item->username = $username;
        $item->name = $name;
        $item->email = $email;
        $item->password = md5($password);
        $item->image_url = "";
        $item->active = "";
        $email_activation_key = generateActivationKey();
        $item->email_activation_key = $email_activation_key;
        $result = $item->insert();
        $email_send_result = sendEmail($email, "Email Doğrulama", "<a style='background: #5ca934;border-color: #478228 #478228 #3c6f22;background-image: -webkit-linear-gradient(top, #69c03b, #5ca934 66%, #54992f);background-image: -moz-linear-gradient(top, #69c03b, #5ca934 66%, #54992f);background-image: -o-linear-gradient(top, #69c03b, #5ca934 66%, #54992f);background-image: linear-gradient(to bottom, #69c03b, #5ca934 66%, #54992f);color:#ffffff;font-size:12pt;font-weight:bold;padding:20px;text-decoration:none;' href='" . $GLOBALS["HOSTING_DOMAIN"] . $GLOBALS["ROOT"] . "confirm_email.php?email_activation_key=" . $email_activation_key . "&email=" . $email . "'>E-posta adresinizi doğrulamak için tıklayınız</a>", "Kullandığınız eposta istemcisi HTML içeriği desteklemiyor. İstemci ayarlarınızı kontrol ediniz...");
        header("Location: login.php");
    }
}
?>

<div class="container-fluid my-3">

    <div class="row">
        <div class="col-12">
            <form method="post" novalidate>
                <div class="mb-1">
                    <label for="name">Ad Soyad</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <div class="text-danger"><?php echo $nameErr; ?></div>
                </div>
                <div class="mb-1">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <div class="text-danger"><?php echo $usernameErr; ?></div>
                </div>
                <div class="mb-1">
                    <label for="email">Eposta</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <div class="text-danger"><?php echo $emailErr; ?></div>
                </div>
                <div class="mb-1">
                    <label for="password">Parola</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <div class="text-danger"><?php echo $passwordErr; ?></div>
                </div>
                <div class="mb-3">
                    <label for="repassword">Parola Tekrar</label>
                    <input type="password" name="repassword" class="form-control">
                        <div class="text-danger"><?php echo $repasswordErr; ?></div>
                </div>

                <button type="submit" class="btn btn-primary">Kayıt Ol</button>
            </form>
        </div>
    </div>

</div>
<?php include "partials/_footer.php"; ?>
