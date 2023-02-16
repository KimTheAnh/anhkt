<?php
$stt = 0;
$tong = 0;
?>

<main>
    <div class="row">
        <div class="content">
            <form name="bill-form" action="index.php?act=billcomfirm" id="myform" method="POST">
                <div class="box-sanphamct" style="margin-top: 0;">
                    <div class="box-sanphamct_header">
                        Thông tin đặt hàng
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Người đặt hàng <p style="color: red;display:inline-block">(*)</p>
                        </div>
                        <input type="text" class="input-bill_input" name="name" id="" value="<?php if (isset($info)) echo "$user" ?>" <?php if (isset($info)) echo "disabled" ?>>
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Địa chỉ <p style="color: red;display:inline-block">(*)</p>
                        </div>
                        <input type="text" class="input-bill_input" name="address" id="" value="<?php if (isset($info)) echo $address ?>" <?php if (isset($info)) echo "disabled" ?>>
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Email</div>
                        <input type="email" class="input-bill_input" name="email" id="" value="<?php if (isset($info)) echo  $email ?>" <?php if (isset($info)) echo "disabled" ?>>
                    </div>

                    <div class="box-input-bill">
                        <div class="input-bill_name">Điện thoại <p style="color: red;display:inline-block">(*)</p>
                        </div>
                        <input type="text" class="input-bill_input" name="tel" id="" value="<?php if (isset($info)) echo  $tel ?>" <?php if (isset($info)) echo "disabled" ?>>
                    </div>
                </div>

                <div class="box-sanphamct" style="margin-top: 0;">
                    <div class="box-sanphamct_header">
                        Phương tức thanh toán
                    </div>
                    <div class="box-input-bill">
                        <div class="flex">
                            <input type="radio" class="input-bill_radio" name="phuongthuc" value="1">
                            <div class="input-bill_radio-value">Trả tiền khi nhận hàng</div>
                        </div>
                        <div class="flex">
                            <input type="radio" class="input-bill_radio" name="phuongthuc" value="2">
                            <div class="input-bill_radio-value">Chuyển khoản ngân hàng</div>
                        </div>
                        <div class="flex">
                            <input type="radio" class="input-bill_radio" name="phuongthuc" value="3">
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
                                <?php foreach ($cart as $sp) : ?>
                                    <?php
                                    extract($sp);
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
                                <tr style="border-top: 1px solid #ccc;">
                                    <td colspan="4">Tổng tiền</td>
                                    <td> <?= $tong ?> VNĐ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="form-loaihang-btns">
                    <div class="form-loaihang-btn" onclick="validate()">Đồng ý đặt hàng</div>
                </div>
            </form>

        </div>
        <!-- <?php
                require "view/sidebar.php";
                ?> -->
    </div>
</main>

<script>
    
    function validate() {
        var ok = false
        var _thongbao = []
        var name = document.querySelector("input[name='name']").value
        var address = document.querySelector("input[name='address']").value
        var tel = document.querySelector("input[name='tel']").value
        var email = document.querySelector("input[name='email']").value
        var _pt = document.querySelectorAll("input[name='phuongthuc']")
        var pttt = 0
        var _soluong
        _pt.forEach((pt) => {
            if (pt.checked) {
                pttt = pt.value
            }
        })


        if (name == '' || address == '' || tel == '') {
            _thongbao.push('Các trường đánh dấu không được để trống')
        }

        if (tel.length != 10 && tel != "") {
            _thongbao.push('Trường điện thoại phải chính xác')
        } else {
            for (let i = 0; i < tel.length; i++) {
                if (isNaN(tel[i])) {
                    _thongbao.push('Trường điện thoại phải chính xác')
                }
            }
        }

        $.get("admin/api.php?act=checkSoLuong",
            function(res) {

                if (JSON.parse(res) != []) {
                    JSON.parse(res).forEach((thongbao) => {
                        _thongbao.push(thongbao)
                    })
                }
            },
        );
        if (pttt == 0) {
            _thongbao.push("Bạn phải chọn phương thức thanh toán")
        }

        toast({
            title: "Xử lý!",
            message: "Đang xử lý đơn hàng xin đợi",
            type: "warning",
            duration: 1000
        });


        setTimeout(() => {
            if (_thongbao.length == 0) {
                $('#myform').submit()
            }
            _thongbao.forEach((thongbao) => {
                toast({
                    title: "Thất bại!",
                    message: thongbao,
                    type: "error",
                    duration: 5000
                });
            })
        }, 2000);

        return false

    }
</script>