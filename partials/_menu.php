<?php
    if(isset($_GET["categoryid"]) && is_numeric($_GET["categoryid"])) {
        $secilenKategori = $_GET["categoryid"];
    }
    else {
        $secilenKategori = 0;
    }
?>


<div class="list-group">
    <a href="courses.php" class="list-group-item list-group-item-action<?php echo ($secilenKategori!=0)?"":" active"; ?>">Tüm kurslar</a>
    <?php 
        $sonuc = getCategories();
        while($kategori = mysqli_fetch_assoc($sonuc)): ?>

        <a 
            href="<?php echo "courses.php?categoryid=".$kategori["id"]?>" 
            class="list-group-item list-group-item-action 
            <?php
                if($kategori["id"] == $secilenKategori) {
                    echo "active";
                }            
            ?>">
            <?php echo $kategori["kategori_adi"]; ?>
        </a>

    <?php endwhile; ?>
</div>