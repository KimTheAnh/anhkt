<div class="admin-header">
    QUẢN LÝ LOẠI HÀNG
</div>

<table class="list-loaihang-table">
    <thead>
        <tr>
            <th style="width: 5%;"></th>
            <th>MÃ LOẠI</th>
            <th>TÊN LOẠI</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($listdanhmuc as $danhmuc) : ?>
            <?php extract($danhmuc) ?>
            <tr onclick="danhmucCheck(this)">
                <td style="position: relative;"><input type="checkbox" onclick="event.stopPropagation()"></td>
                <td class="form-loaihang-id"><?= $id ?></td>
                <td><?= $name ?></td>
                <td>
                    <div class="form-loaihang-btns">
                        <div class="form-loaihang-btn" onclick="danhmucUpdate(<?= $id ?>)">Sửa</div>
                        <div class="form-loaihang-btn" onclick="danhmucDelete(<?= $id ?>)">Xoá</div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="form-loaihang-btns">
    <div class="form-loaihang-btn" onclick="danhmucCheckAll()">Chọn tất cả</div>
    <div class="form-loaihang-btn" onclick="danhmucUnCheckAll()">Bỏ chọn tất cả</div>
    <div class="form-loaihang-btn" onclick="danhmucDeleteCheck()">Xoá các mục chọn</div>
    <a href="index.php?act=adddm" class="form-loaihang-btn">Nhập thêm</a>
</div>
</div>
<script>
    function danhmucDelete(id) {
        var submit = confirm("Bạn có muốn xoá danh mục này ?")
        if (submit) window.location = 'index.php?act=xoadanhmuc&id=' + id
        event.stopPropagation()
    }

    function danhmucUpdate(id) {
        window.location = 'index.php?act=suadanhmuc&id=' + id
        event.stopPropagation()

    }

    function danhmucCheck(x) {
        var checkBox = x.querySelector("input")
        if (checkBox.checked) {
            checkBox.checked = false
        } else {
            checkBox.checked = true
        }
    }

    function danhmucCheckAll() {
        var rows = document.querySelector("tbody").querySelectorAll("tr")
        rows.forEach((row) => {
            var checkBox = row.querySelector("td").querySelector("input")
            checkBox.checked = true
        })
    }

    function danhmucUnCheckAll() {
        var rows = document.querySelector("tbody").querySelectorAll("tr")
        rows.forEach((row) => {
            var checkBox = row.querySelector("td").querySelector("input")
            checkBox.checked = false
        })
    }

    function danhmucDeleteCheck() {
        if(confirm("Bạn có muốn xoá các mục đã chọn ?")) {
            var _id = getIdCheck()
            var idQry = _id.map(function(el, idx) {
                return 'id[' + idx + ']=' + el;
            }).join('&');
            window.location = 'index.php?act=xoadanhmuccheck&' + idQry;
        }   
    }

    function getIdCheck() {
        var _id = []
        var rows = document.querySelector("tbody").querySelectorAll("tr")
        rows.forEach((row) => {
            var checkBox = row.querySelector("td").querySelector("input")
            if (checkBox.checked) {
                var id = Number(row.firstElementChild.nextElementSibling.innerHTML)
                _id.push(id)
            }
        })
        return _id
    }
</script>