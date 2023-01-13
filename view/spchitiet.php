<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="box-spchitiet">
                <div class="box-spchitiet_img" style="background-image: url(<?= $imgdir.$img ?>);"></div>
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
            
            <div class="box-sanphamct">
                <div class="box-sanphamct_header">
                    BÌNH LUẬN
                </div>
                <div class="box-sanphamct_main">

                </div>
                <div class="box-sanphamct_tb">
                    Đăng nhập để bình luận về sản phẩm này
                </div>
            </div>
            <div class="box-sanphamct">
                <div class="box-sanphamct_header">
                    HÀNG CÙNG LOẠI
                </div>
                <ul class="box-sanphamct_listsp">
                    <?php foreach($listsp as $sp): ?>
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