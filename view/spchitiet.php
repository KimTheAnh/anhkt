<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="box-spchitiet">
                <div class="box-spchitiet_img" style="background-image: url(<?= $imgdir . $id .'/'. $linkImg[0] ?>);"></div>
                <div class="flex flex-bw">
                    <ul class="box-spchitiet_info">
                        <li>MÃ HH: <?= $id ?></li>
                        <li>TÊN HÀNG HOÁ: <?= $name ?></li>
                        <li>ĐƠN GIÁ: <?= $price ?> $</li>
                        <li>GIẢM GIÁ: 0%</li>
                        <li>SỐ LƯỢNG TRONG KHO: <?= $soluong ?></li>
                    </ul>
                    <div class="box-spchitiet_addgiohang">
                        <div class="box-spchitiet_quantity">
                            <p>Số lượng: </p>
                            <input type="number" min="1" step="1" value="1">
                        </div>
                        <div class="form-loaihang-btns">
                            <div type="submit" class="form-loaihang-btn" onclick="add_giohang(<?= $id ?>)" style="margin: 0 0 12px 12px;">Thêm vào giỏ hàng</div>
                        </div>
                    </div>
                </div>
                <div class="box-spchitiet_mota">
                    <?= $mota ?>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $("#binhluan").load("view/binhluan/binhluan.php", {
                        idpro: <?= $id ?>
                    });
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

<script>
    function add_giohang(id) {
        var soluong = document.querySelector(".box-spchitiet_quantity input").value
        soluong = Number(soluong);
        $.post("index.php?act=addgiohang", {
                    idpro: id,
                    quantity: soluong,
                },
                function() {
                    // alert("success");
                })
            .done(function() {
                toast({
                    title: "Thành công!",
                    message: "Thêm sản phẩm vào giỏ hàng thành công",
                    type: "success",
                    duration: 5000
                });
            })
            .fail(function() {
                toast({
                    title: "Thất bại!",
                    message: "Thêm sản phẩm vào giỏ hàng không thành công",
                    type: "error",
                    duration: 5000
                });
            })
            .always(function() {
                // alert("finished");
            });
        $(document).ready(function() {
            $("#giohang").load("view/giohang/giohangsm.php");
        });
        event.stopPropagation()
    }
</script>