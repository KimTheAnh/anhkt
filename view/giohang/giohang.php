<?php $stt = 0 ?>
<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="box-sanphamct" style="margin-top: 0;">
                <div class="box-sanphamct_header">
                    Giỏ hàng
                </div>
                <div class="box-giohang">
                    <table class="table-giohang">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hình</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listsp as $sp) : ?>
                                <?php
                                extract($sp);
                                $linkImg = explode(", ", $img);
                                ?>
                                <tr>
                                    <td><?= ++$stt ?></td>
                                    <td>
                                        <div class="flex-center">
                                            <div class="table-giohang_img" style="background-image: url(<?= $imgdir . $id . '/' . $linkImg[0] ?>);"></div>
                                        </div>
                                    </td>
                                    <td><?= $name ?></td>
                                    <td><?= $quantity ?></td>
                                    <td><?= $price * $quantity ?> VNĐ</td>
                                    <td>
                                        <div class="form-loaihang-btns">
                                            <div class="form-loaihang-btn" onclick="Delete(<?= $id ?>)">Xoá</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="form-loaihang-btns">
                        <div href="" class="form-loaihang-btn" style="margin-top: 20px;" onclick="let_bill()">Đặt hàng</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>

<script>
    function Delete(id) {
        var submit = confirm("Bạn có muốn xoá danh mục này ?")
        if (submit) window.location = 'index.php?act=deletegiohang&id=' + id
        event.stopPropagation()
    }

    function let_bill() {
        var item = document.querySelector('tbody').querySelector('tr')

        $.get("admin/api.php?act=cart",
            function(res) {
                var thongbao = JSON.parse(res)

                if (thongbao == "ok") {
                    if (item) {
                        window.location = 'index.php?act=bill'
                    } else {
                        toast({
                            title: "Thất bại!",
                            message: "Phải có sản phẩm mới có thể đặt hàng",
                            type: "error",
                            duration: 5000
                        });
                    }
                } else {
                    toast({
                        title: "Thất bại!",
                        message: thongbao,
                        type: "error",
                        duration: 5000
                    });
                }
            },
        );
    }
</script>