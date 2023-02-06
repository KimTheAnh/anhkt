<?php 
    $stt = 0 ;
    $tong = 0;
?>

<main>
    <div class="row column-3-1">
        <div class="content">
            <form action="index.php?act=bill" method="post">
                <div class="box-sanphamct" style="margin-top: 0;">
                    <div class="box-sanphamct_header">
                        Thông tin đặt hàng
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Người đặt hàng</div>
                        <input type="text" class="input-bill_input" name="name" id="" value="<?php if(isset($info)) echo $user ?>">
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Địa chỉ</div>
                        <input type="text" class="input-bill_input" name="address" id=""  value="<?php if(isset($info)) echo $address ?>">
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Email</div>
                        <input type="text" class="input-bill_input" name="email" id=""  value="<?php if(isset($info)) echo  $email ?>">
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Điện thoại</div>
                        <input type="text" class="input-bill_input" name="tel" id=""  value="<?php if(isset($info)) echo  $tel ?>">
                    </div>
                </div>
                
                <div class="box-sanphamct" style="margin-top: 0;">
                    <div class="box-sanphamct_header">
                        Phương tức thanh toán
                    </div>
                    <div class="box-input-bill">
                        <div class="flex">
                            <input type="radio" class="input-bill_radio" name="phuongthuc" id="" value="0">
                            <div class="input-bill_radio-value">Trả tiền khi nhận hàng</div>
                        </div>
                        <div class="flex">
                            <input type="radio" class="input-bill_radio" name="phuongthuc" id="" value="1">
                            <div class="input-bill_radio-value">Chuyển khoản ngân hàng</div>
                        </div>
                        <div class="flex">
                            <input type="radio" class="input-bill_radio" name="phuongthuc" id="" value="2">
                            <div class="input-bill_radio-value">Thanh toán online</div>
                        </div>
                    </div>
                </div>

                
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listsp as $sp) : ?>
                                <?php 
                                    extract($sp) ;
                                    $tong += $price * $quantity;
                                ?>
                                <tr>
                                    <td><?= ++$stt ?></td>
                                    <td>
                                        <div class="flex-center">
                                            <div class="table-giohang_img" style="background-image: url(<?= $imgdir . $img ?>);"></div>
                                        </div>
                                    </td>
                                    <td><?= $name ?></td>
                                    <td><?= $quantity ?></td>
                                    <td><?= $price * $quantity ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Tổng tiền</td>
                                <td > <?= $tong ?> VNĐ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
                <div class="form-loaihang-btns">
                    <input type="submit" value="Đồng ý đặt hàng" class="form-loaihang-btn" onclick="" name="submit">
                </div>
            </form>

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
</script>