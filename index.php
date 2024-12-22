<?php

require "libs/functions.php";
if (!isLoggedIn()) {
    header('Location: login.php');
}
?>
<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>

<div class="container-fluid my-3">
</div>
<?php
if (!empty($_SESSION)&&$_SESSION["logined"]&&$_SESSION["newLogined"]) {
    echo "<script type='text/javascript'>\n";
    echo "$.notify('Kullanıcı girişi yapıldı...', { position:'left bottom', className: 'success' });\n";
    echo "</script>\n";
    $_SESSION["newLogined"] = NULL;
}
?>
<?php include "partials/_footer.php" ?>
