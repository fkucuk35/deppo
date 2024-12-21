<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #00839b">
    <img src="assets/images/app/yapisan_logo_deppo.svg" height="40" class="inline-block" style="margin: 5px"/>
    <a href="index.php" class="navbar-brand" style="font-style: italic; font-weight: bold">Deppo</a>
    <ul class="navbar-nav me-auto">
        <?php if (isAdmin()): ?>
            <div class="dropdown">
                <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                    Tanımlar
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="personel_list.php">Personel Listesi</a></li>
                    <li><a class="dropdown-item" href="stock_card_list.php">Stok Kartları</a></li>
                </ul>
            </div>
        <?php endif; ?> 

    </ul>

    <ul class="navbar-nav me-2">

        <?php if (isLoggedIn()): ?>
            <li class="nav-item">
                <a href="login.php" class="nav-link">Hoş geldiniz, <?php echo (empty($_SESSION['name'])) ? 'Misafir Kullanıcı' : $_SESSION['name'] . " " . $_SESSION['surname']; ?></a>
            </li>
            <div class="dropdown dropstart">
                <img class="avatar mx-2" src="assets/images/users/<?php echo (empty($_SESSION['image_url'])) ? 'no-image.jpg' : $_SESSION['image_url']; ?>" data-bs-toggle="dropdown" aria-expanded="false" />
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profil</a></li>
                    <li><a class="dropdown-item" href="#" onclick="logOut()">Çıkış Yap</a></li>
                </ul>
            </div>
        <?php else: ?>   
            <li class="nav-item">
                <a href="login.php" class="nav-link">Giriş Yap</a>
            </li>
            <li class="nav-item">
                <a href="register.php" class="nav-link">Kayıt Ol</a>
            </li>
        <?php endif; ?>   
    </ul>
</nav>
<?php if (isLoggedIn()): ?>
    <script type="text/javascript">
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        function logOut() {
            $.notify('Kullanıcı çıkışı yapıldı...', {position: 'left bottom'});
            sleep(1000).then(() => {
                window.location = 'logout.php';
            });
        }
    </script>
<?php endif; ?>