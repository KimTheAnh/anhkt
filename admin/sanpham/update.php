<div class="admin-header">
    SỬA SẢN PHẨM
</div>

<form class="form-loaihang" action="index.php?act=updatesanpham&id=<?= $sp['id'] ?>" method="POST">
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Mã sản phẩm</div>
        <input type="text" class="form-loaihang-input" disabled placeholder="Mã tự tăng" value="<?= $sp['id'] ?>">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Tên sản phẩm</div>
        <input type="text" name="tensanpham" class="form-loaihang-input" value="<?= $sp['name'] ?>">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Giá sản phẩm</div>
        <input type="number" name="giasanpham" class="form-loaihang-input" min="0" value="<?= $sp['price'] ?>">
    </div>
    <!-- <div class="form-loaihang-box">
        <div class="form-loaihang-text">Ảnh sản phẩm</div>
        <input type="file" name="anhsanpham" class="form-loaihang-input">
    </div> -->
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Mô tả sản phẩm</div>
        <textarea name="motasanpham" id="" cols="30" rows="10" ><?= $sp['mota'] ?></textarea>
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Lượt xem sản phẩm</div>
        <input type="number" name="luotxemsanpham" class="form-loaihang-input" min="0" value="<?= $sp['luotxem'] ?>">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Số lượng sản phẩm</div>
        <input type="number" name="soluongsanpham" class="form-loaihang-input" min="0" value="<?= $sp['soluong'] ?>">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Danh mục sản phẩm</div>
        <select name="danhmucsanpham" id="" class="form-loaihang-input " style="width: 30%;">
            <?php foreach ($listdanhmuc as $danhmuc) : ?>
                <?php extract($danhmuc) ?>
                <option value="<?= $id ?>" <?php if($sp['iddm']== $id) echo "selected" ?>><?= $name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-loaihang-btns">
        <input type="submit" class="form-loaihang-btn" value="Sửa" name="sua">
        <input type="reset" class="form-loaihang-btn" value="Nhập lại">
        <a href="index.php?act=listsanpham" class="form-loaihang-btn">Danh sách</a>
    </div>
</form>


</div>