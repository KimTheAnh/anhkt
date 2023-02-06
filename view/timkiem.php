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
                    <div class="home-product-item" onclick="linksp(<?= $id ?>)">
                        <div class="home-product-item_img" style="background-image: url(<?= $imgdir . $img ?>);">
                        </div>
                        <div class="home-product-item_price">$ <?= $price ?></div>
                        <div class="home-product-item_name"><?= $name ?></div>
                        <div class="form-loaihang-btns">
                            <div type="submit" class="form-loaihang-btn" onclick="add_giohang(<?= $id ?>)" style="margin: 0 0 12px 12px;">Thêm vào giỏ hàng</div>
                        </div>
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
    function add_giohang(id) {
        $('#test').load('test.php', {idpro: id})
        event.stopPropagation()
    }

    function linksp(id) {
        window.location = 'index.php?act=spchitiet&id=' + id
    }
</script>