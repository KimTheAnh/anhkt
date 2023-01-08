<div class="admin-header">
    QUẢN LÝ LOẠI HÀNG
</div>

<table class="list-loaihang-table">
    <tr>
        <th style="width: 5%;"></th>
        <th>MÃ LOẠI</th>
        <th>TÊN LOẠI</th>
        <th></th>
    </tr>

    <?php foreach ($listdanhmuc as $danhmuc) : ?>
        <?php extract($danhmuc) ?>
        <tr>
            <td style="position: relative;"><input type="checkbox"></td>
            <td><?= $id ?></td>
            <td><?= $name ?></td>
            <td>
                <div class="form-loaihang-btns">
                    <div class="form-loaihang-btn" onclick="danhmucUpdate(<?= $id ?>)">Sửa</div>
                    <div class="form-loaihang-btn" onclick="danhmucDelete(<?= $id ?>)">Xoá</div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="form-loaihang-btns">
    <div class="form-loaihang-btn">Chọn tất cả</div>
    <div class="form-loaihang-btn">Bỏ chọn tất cả</div>
    <div class="form-loaihang-btn">Xoá các mục chọn</div>
    <a href="index.php?act=adddm" class="form-loaihang-btn">Nhập thêm</a>
</div>
</div>
<script>
    function danhmucDelete(id) {
        var submit = confirm("Bạn có muốn xoá danh mục này ?")
        if(submit) window.location = 'index.php?act=xoadanhmuc&id=' + id
    }

    function danhmucUpdate(id) {
        window.location = 'index.php?act=suadanhmuc&id=' + id
    }
</script>