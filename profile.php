<?php
require "libs/functions.php";
if (!isLoggedIn()) {
    header('Location: login.php');
}
include 'config_db.php';
include 'libs/orm/dao.php';
require_once 'dao/user.php';
require_once 'dao/log.php';
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
        $log = new Log();
        $log->user_id = $_SESSION['id'];
        $log->operation = "profile_update";
        $log->operation_detail = "Kullanıcı profili güncellendi";
        $log->insert();
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
<script type="text/javascript">
    function changePassword() {
        var password = document.getElementById("password").value;
        var repassword = document.getElementById("repassword").value;
        document.getElementById("passwordErr").innerHTML = "";
        document.getElementById("repasswordErr").innerHTML = "";
        if ((password !== "") || (repassword !== "")) {
            if (password === repassword) {
                $.ajax({
                    type: "POST",
                    url: "operations/user_operations.php",
                    data: {op: 5, id: <?php echo $_SESSION["id"]; ?>, password: password},
                    dataType: "json",
                    success: function (result) {
                        if (result.success) {
                            $.notify('Parola başarıyla değiştirildi. Bundan sonraki kullanıcı girişinizden itibaren yeni parolanız geçerli olacaktır.', {position: 'left bottom', className: 'success'});
                        } else {

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(jqXHR.responseText);
                    }
                });
                document.getElementById("passwordErr").innerHTML = "";
                document.getElementById("repasswordErr").innerHTML = "";
            } else {
                document.getElementById("repasswordErr").innerHTML = "Girilen parolalar birbiriyle eşleşmiyor";
                document.getElementById("repassword").value = "";
            }
        } else
        {
            if ((password === "")) {
                document.getElementById("passwordErr").innerHTML = "Parola gerekli alan.";
            }
            if ((repassword === "")) {
                document.getElementById("repasswordErr").innerHTML = "Parola Tekrar gerekli alan.";
            }
        }

    }
    function setShowHide() {
        obj = document.getElementById("password");
        obj.setAttribute('type', obj.getAttribute('type') === 'password' ? 'text' : 'password');
        obj = document.getElementById("repassword");
        obj.setAttribute('type', obj.getAttribute('type') === 'password' ? 'text' : 'password');
    }
</script>
<div class="container-fluid my-3">

    <div class="row">
        <div class="col-2">
            <div class="card" style="width: 18rem;display: inline">
                <img src="assets/images/personels/no-image.jpg" class="img-thumbnail"/>
                <div class="card-body">
                    <label for="password">Parola</label>
                    <input type="password" name="password" id="password" class="form-control"/>
                    <div class="text-danger" id="passwordErr"></div>
                    <label for="repassword">Parola Tekrar</label>
                    <input type="password" name="repassword" id="repassword" class="form-control"/>
                    <div class="text-danger" id="repasswordErr"></div>
                    <input class="form-check-input mx-1" type="checkbox" id="showhidePassword" onclick="setShowHide()">Şifreyi Göster</input>
                    <button class="btn btn-primary mt-1" style="width: -webkit-fill-available" onclick="changePassword()">Parola Değiştir</button>
                </div>
            </div>
        </div>
        <div class="col-10">
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
                <button type="submit" class="btn btn-primary" style="width: -webkit-fill-available">Kaydet</button>
            </form>
        </div>
    </div>

</div>
<?php include "partials/_footer.php" ?>