<?php
require "libs/functions.php";

include 'config_db.php';
include 'libs/orm/dao.php';
include 'dao/user.php';
?>

<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<?php
$username = $email = $name = $password = $repassword = "";
$usernameErr = $emailErr = $nameErr = $passwordErr = $repasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"];
    if (empty($_POST["email"])) {
        $emailErr = "Eposta gerekli alan.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Eposta hatalıdır.";
    } elseif ($_SESSION['email'] != trim($_POST["email"])) {
        $item = new User();
        $r = $item->checkEmailValid(trim($_POST["email"]));
        if ($r !== NULL) {
            $emailErr = "Girilen yeni eposta ile kayıtlı kullanıcı var.";
        } else {
            $email = safe_html($_POST["email"]);
        }
    } else {
        $email = safe_html($_POST["email"]);
    }

    if (!empty($emailErr)) {
        $emailErr .= " Önceki girilen eposta sistemde kayıtlı kalmaya devam edecek.";
        $email = safe_html($_SESSION['email']);
    }

    if (empty($_POST["name"])) {
        $nameErr = "Ad Soyad gerekli alan.";
    } else {
        $name = safe_html($_POST["name"]);
    }

    if (!empty($nameErr)) {
        $nameErr .= " Önceki girilen ad soyad sistemde kayıtlı kalmaya devam edecek.";
        $name = safe_html($_SESSION['name']);
    }

    if (empty($emailErr) && empty($nameErr)) {
        $inst = new User();
        $columns = NULL;
        $where = 'id = ' . $_SESSION['id'];
        $item = $inst->readAll($columns, $where);
        $user = $item[0];
        $inst->id = $user->id;
        $inst->username = $user->username;
        $inst->email = $email;
        $inst->password = $user->password;
        $inst->name = $name;
        $inst->image_url = $user->image_url;
        $inst->active = $user->active;
        $inst->date_added = $user->date_added;
        $inst->user_type = $user->user_type;
        $inst->update();
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["profileUpdated"] = true;
        header("Location: index.php");
    }
} else {
    $inst = new User();
    $columns = NULL;
    $where = 'id = ' . $_SESSION['id'];
    $item = $inst->readAll($columns, $where);
    $user = $item[0];
    $username = $user->username;
    $email = $user->email;
    $name = $user->name;
}
?>

<div class="container-fluid my-3">

    <div class="row">
        <div class="col-12">
            <form method="post" novalidate>
                <div class="mb-1">
                    <label for="name">Ad Soyad</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"/>
                    <div class="text-danger"><?php echo $nameErr; ?></div>
                </div>
                <div class="mb-1">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" name="username" class="form-control"value="<?php echo $username; ?>" disabled="true"/>
                </div>
                <div class="mb-1">
                    <label for="email">Eposta</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>"/>
                    <div class="text-danger"><?php echo $emailErr; ?></div>
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
        </div>
    </div>

</div>
<?php include "partials/_footer.php" ?>
