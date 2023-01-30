<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="box-spchitiet">
                <div class="box-spchitiet_img" style="background-image: url(<?= $imgdir . $img ?>);"></div>
                <ul class="box-spchitiet_info">
                    <li>MÃ HH: <?= $id ?></li>
                    <li>TÊN HÀNG HOÁ: <?= $name ?></li>
                    <li>ĐƠN GIÁ: <?= $price ?> $</li>
                    <li>GIẢM GIÁ: 0%</li>
                </ul>
                <div class="box-spchitiet_mota">
                    <?= $mota ?>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#binhluan").load("view/binhluan/binhluan.php", {idpro: <?= $id ?>});
                });
            </script>
            <div class="box-sanphamct" id="binhluan">
                
            </div>
            <div class="box-sanphamct">
                <div class="box-sanphamct_header">
                    HÀNG CÙNG LOẠI
                </div>
                <ul class="box-sanphamct_listsp">
                    <?php foreach ($listsp as $sp) : ?>
                        <?php extract($sp) ?>
                        <li><a href="index.php?act=spchitiet&id=<?= $id ?>"><?= $name ?></a></li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>