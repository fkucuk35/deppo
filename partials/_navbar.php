<nav class="navbar navbar-expand-lg navbar-dark py-1" style="background-color: #00839b">
    <img src="assets/images/app/yapisan_logo_deppo.svg" height="40" class="inline-block" style="margin-left: 5px; margin-right: 5px;"/>
    <a href="index.php" class="navbar-brand" style="font-style: italic; font-weight: bold"><?php echo $lang['app_name']; ?></a>
    <ul class="navbar-nav me-auto">
        <?php if (isAdmin()): ?>
            <li><a class="nav-link" href="order_list.php">Sipariş Listesi</a></li>
            <div class="dropdown">
                <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                    Tanımlar
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="personel_list.php">Personel Listesi</a></li>
                    <li><a class="dropdown-item" href="receipt_type_list.php">Fişi Tipleri</a></li>
                    <li><a class="dropdown-item" href="stock_card_list.php">Stok Kartları</a></li>
                    <li><a class="dropdown-item" href="supplier_list.php">Tedarikçi Firmalar/Kurumlar</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                    Araçlar
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="import_stock_card.php">Stok Kartı Aktar</a></li>
                </ul>
            </div>
        <?php endif; ?> 

    </ul>

    <ul class="navbar-nav me-2">
        <?php if (isLoggedIn()): ?>
            <li class="nav-item my-1">
                <span class="navbar-text">
                    Hoş geldiniz, <?php echo (empty($_SESSION['name'])) ? 'İsimsiz Kullanıcı' : $_SESSION['name']; ?>
                </span>
            </li>
            <div class="dropdown dropstart">
                <img class="avatar mx-2" src="assets/images/users/<?php echo (empty($_SESSION['image_url'])) ? 'no-image.jpg' : $_SESSION['image_url']; ?>" data-bs-toggle="dropdown" aria-expanded="false" />
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php">Profil</a></li>
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
            $.notify('Kullanıcı çıkışı yapıldı...', {position: 'left bottom', className: 'success'});
            sleep(1000).then(() => {
                window.location = 'logout.php';
            });
        }
    </script>
<?php endif; ?>