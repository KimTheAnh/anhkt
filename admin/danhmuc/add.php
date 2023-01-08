<div class="admin-header">
            THÊM MỚI LOẠI HÀNG
        </div>

        <form class="form-loaihang" action="index.php?act=adddm" method="POST">
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
            if(isset($thongbao)&&$thongbao!='') echo $thongbao;
        ?>

    </div>