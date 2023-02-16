<?php 
    $stt = 0 ;
    $tong = 0;
?>

<main>
    <div class="row column-3-1">
        <div class="content">

            <div class="box-sanphamct" style="margin-top: 0;">
                <div class="box-sanphamct_header">
                    Cảm ơn
                </div>
                <h3 class="flex-center height-80px" >
                    Cảm ơn quý khác đã đặt hàng
                </h3>
            </div>

            <div class="box-sanphamct" style="margin-top: 0;">
                <div class="box-sanphamct_header">
                    Mã đơn hàng
                </div>
                <h3 class="flex-center height-80px" >
                    <?= $idDonHang ?>
                </h3>
            </div>

            <div class="box-sanphamct" style="margin-top: 0;">
                <div class="box-sanphamct_header">
                    Thông tin đặt hàng
                </div>

                <div class="box-input-bill">
                    <div class="input-bill_name">Người đặt hàng</div>
                    <div class="bill-thongtin"><?= $user ?></div>
                </div>

                <div class="box-input-bill">
                    <div class="input-bill_name">Địa chỉ</div>                    
                    <div class="bill-thongtin"><?= $address ?></div>

                </div>

                <div class="box-input-bill">
                    <div class="input-bill_name">Email</div>
                    <div class="bill-thongtin"><?= $email ?></div>
                    
                </div>

                <div class="box-input-bill">
                    <div class="input-bill_name">Điện thoại</div>
                    <div class="bill-thongtin"><?= $tel ?></div>
                </div>

                <div class="box-input-bill">
                    <div class="input-bill_name">Ngày đặt hàng</div>
                    <div class="bill-thongtin"><?= $ngaydathang ?></div>
                </div>
            </div>
            <div class="box-sanphamct" style="margin-top: 0;">
                <div class="box-sanphamct_header">
                    Phương thức thanh toán
                </div>
                <p style="margin-left: 20px;margin-bottom: 12px;"><?= $pttt ?></p>
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
                            <?php foreach ($cart as $sp) : ?>
                                <?php 
                                    extract($sp) ;
                                    $linkImg = explode(", ", $img);
                                    $tong += $price * $quantity;
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


        </div>
        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>