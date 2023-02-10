<div class="admin-header">
    THÊM MỚI LOẠI HÀNG
</div>

<form class="form-loaihang" action="index.php?act=adddm" method="POST" onsubmit="return validate()">
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Mã loại</div>
        <input type="text" class="form-loaihang-input" disabled placeholder="Mã tự tăng">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Tên loại</div>
        <input type="text" name="tenloai" class="form-loaihang-input">
    </div>
    <div class="form-loaihang-btns">
        <input type="submit" class="form-loaihang-btn" value="Thêm mới" name="themmoi">
        <input type="reset" class="form-loaihang-btn" value="Nhập lại">
        <a href="index.php?act=listdanhmuc" class="form-loaihang-btn">Danh sách</a>
    </div>
</form>
<?php
if (isset($thongbao) && $thongbao != '') echo $thongbao;
?>



</div>

<script>
    function validate() {
        var danhmuc = document.querySelector('input[name="tenloai"]')
        var danhmucValue = danhmuc.value
        $.post("api.php?act=adddm", {
                name: danhmucValue
            },
            function(res) {
                var thongbao = JSON.parse(res)

                if (thongbao == "") {
                    toast({
                        title: "Thành công!",
                        message: "Danh mục đã được thêm vào",
                        type: "success",
                        duration: 5000
                    });
                    danhmuc.value = ""
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
        return false
    }
</script>