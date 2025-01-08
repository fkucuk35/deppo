<?php
require "libs/functions.php";
if (!isLoggedIn()) {
    header('Location: login.php');
}
?>
<?php include "partials/_header.php"; ?>
<?php include "partials/_navbar.php"; ?>

<div class="container-fluid my-3">
    <?php include "tools/import/index.php"; ?>
</div>
<?php include "partials/_footer.php"; ?>
