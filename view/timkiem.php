<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="title-box_timkiemsp">
                SẢN PHẨM
            </div>
            <H1 style="color : red"><?= $thongbao ?></H1>
            <div class="home-product-list">
                <?php foreach ($listsp as $sp) : ?>
                    <?php extract($sp) ?>
                    <a href="index.php?act=spchitiet&id=<?= $id ?>" class="home-product-item">
                        <div class="home-product-item_img" style="background-image: url(<?= $imgdir . $img ?>);">
                        </div>
                        <div class="home-product-item_price">$ <?= $price ?></div>
                        <div class="home-product-item_name"><?= $name ?></div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>