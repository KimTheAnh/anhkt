<div class="admin-header">
    THÊM MỚI SẢN PHẨM
</div>

<?php
if (isset($thongbao) && $thongbao != '') echo $thongbao;
?>

<form class="form-loaihang" enctype="multipart/form-data">
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Mã sản phẩm</div>
        <input type="text" class="form-loaihang-input" disabled placeholder="Mã tự tăng">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Tên sản phẩm<p style="color: red;display:inline-block">(*)</p>
        </div>
        <input type="text" name="tensanpham" class="form-loaihang-input">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Giá sản phẩm<p style="color: red;display:inline-block">(*)</p>
        </div>
        <input type="number" name="giasanpham" class="form-loaihang-input" min="0">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Ảnh sản phẩm<p style="color: red;display:inline-block">(*)</p>
        </div>
        <input id="anh" type="file" name="anhsanpham[]" class="form-loaihang-input" multiple>
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Mô tả sản phẩm</div>
        <textarea name="motasanpham" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Danh mục sản phẩm<p style="color: red;display:inline-block">(*)</p>
        </div>
        <select name="danhmucsanpham" id="" class="form-loaihang-input " style="width: 30%;">
            <!-- <option value="0" disabled>--- Chọn danh mục ---</option> -->
            <?php foreach ($listdanhmuc as $danhmuc) : ?>
                <?php extract($danhmuc) ?>
                <option value="<?= $id ?>"><?= $name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-loaihang-btns">
        <div class="form-loaihang-btn" name="themmoi" onclick="validate()">Thêm mới</div>
        <input type="reset" class="form-loaihang-btn" value="Nhập lại">
        <a href="index.php?act=listsanpham" class="form-loaihang-btn">Danh sách</a>
    </div>
</form>


</div>

<script>
    function validate() {
        var tensanpham = document.querySelector('input[name="tensanpham"]')
        var tensanphamValue = tensanpham.value
        var giasanpham = document.querySelector('input[name="giasanpham"]')
        var giasanphamValue = giasanpham.value
        var motasanpham = document.querySelector('textarea[name="motasanpham"]')
        var motasanphamValue = motasanpham.value
        var danhmucsanpham = document.querySelector('select[name="danhmucsanpham"]')
        var danhmucsanphamValue = danhmucsanpham.value
        var form_data = new FormData();
        form_data.append('tensanpham', tensanphamValue);
        form_data.append('giasanpham', giasanphamValue);
        form_data.append('motasanpham', motasanphamValue);
        form_data.append('danhmucsanpham', danhmucsanphamValue);



        var _file_data = $('#anh').prop('files'); //Fetch the file
        for (var i = 0; i < _file_data.length; i++) {
            form_data.append("file[]", _file_data[i]);
        }

        $.ajax({
            url: "api.php?act=addsp", //Server api to receive the file
            type: "POST",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function(suc) {
                var thongbao = JSON.parse(suc)

                if (thongbao == "ok") {
                    toast({
                        title: "Thành công!",
                        message: "Sản phẩm đã được thêm vào",
                        type: "success",
                        duration: 5000
                    });
                    $('.form-loaihang').trigger("reset")

                } else {
                    thongbao.forEach(i => {
                        toast({
                            title: "Thất bại!",
                            message: i,
                            type: "error",
                            duration: 5000
                        });
                    });

                }
            }
        });
        return false
    }
</script>