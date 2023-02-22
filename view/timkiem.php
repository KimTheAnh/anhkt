<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="title-box_timkiemsp">
                SẢN PHẨM
            </div>
            <H1 style="color : red"><?= $thongbao ?></H1>
            <div class="home-product-list">
                <?php foreach ($listsp as $sp) : ?>
                    <?php 
                        extract($sp);
                        $linkImg = explode(', ', $img);
                    ?>
                    <div class="home-product-item" onclick="linksp(<?= $id ?>)">
                        <div class="home-product-item_img" style="background-image: url(<?= $imgdir . $id .'/'. $linkImg[0] ?>);">
                        </div>
                        <div class="home-product-item_price">$ <?= $price ?></div>
                        <div class="home-product-item_name"><?= $name ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>

<script>
    function linksp(id) {
        window.location = 'index.php?act=spchitiet&id=' + id
    }
</script>