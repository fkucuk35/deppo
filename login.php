<?php
include "libs/ayar.php";
require "libs/variables.php";
require "libs/functions.php";

if (isLoggedIn()) {
    header("Location: index.php");
}

$username = $password = "";
$usernameErr = $passwordErr = $loginErr = "";

if (isset($_POST["login"])) {

    if (empty($_POST["username"])) {
        $usernameErr = "username gerekli alan.";
    } else {
        $username = safe_html($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "password gerekli alan.";
    } else {
        $password = safe_html($_POST["password"]);
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        $sql = "SELECT id, username, password, name, image_url, user_type from deppo_users WHERE username=? AND active='ü'";

        if ($stmt = mysqli_prepare($baglanti, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // parola kontrolü
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $name, $image_url, $user_type);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["logined"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["name"] = $name;
                            $_SESSION["user_type"] = $user_type;
                            $_SESSION["image_url"] = $image_url;
                            $_SESSION["newLogined"] = true;

                            header("Location: index.php");
                        } else {
                            $loginErr = "Kullanıcı adı ve/veya Parola yanlış";
                        }
                    }
                } else {
                    $loginErr = "Kullanıcı adı ve/veya Parola yanlış";
                }
            } else {
                $loginErr = "İşlem sırasında bir hata oluştu";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }
}
?>
<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<div class="container-fluid my-3">

    <div class="row">
        <div class="col-12">
            <form id="loginForm" action="login.php" method="post">
                <div class="mb-3">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
                        <div class="text-danger"><?php echo $usernameErr; ?></div>
                </div>
                <div class="mb-3">
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
    echo "$.notify('".$loginErr."', { position:'left bottom' });\n";
    echo "$('#loginForm').form('clear');\n";
    echo "$('#username').focus();\n";
    echo "</script>\n";
}
?>
<?php include "partials/_footer.php" ?>
