<?php
    if(isset($_GET['id'])&&$_GET['id']>0) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM danhmuc WHERE danhmuc.`id`=$id";
        $dm = pdo_query_one($sql);
        extract($dm);
    }
?>

<div class="admin-header">
    SỬA LOẠI HÀNG
</div>

<form class="form-loaihang" action="index.php?act=updatedanhmuc&id=<?= $id ?>" method="POST">
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Mã loại</div>
        <input type="text" class="form-loaihang-input" disabled placeholder="Mã tự tăng" value="<?= $id ?>">
    </div>
    <div class="form-loaihang-box">
        <div class="form-loaihang-text">Tên loại</div>
        <input type="text" name="tenloai" class="form-loaihang-input" value="<?= $name ?>">
    </div>
    <div class="form-loaihang-btns">
        <input type="submit" class="form-loaihang-btn" value="Sửa" name="sua">
        <input type="reset" class="form-loaihang-btn" value="Nhập lại">
        <a href="index.php?act=listdanhmuc" class="form-loaihang-btn">Danh sách</a>
    </div>
</form>
<?php
// if (isset($thongbao) && $thongbao != '') echo $thongbao;
?>

</div>