<div class="admin-header">
    QUẢN LÝ TÀI KHOẢN
</div>

<table class="list-loaihang-table" style="text-align: center;">
    <thead>
        <tr class="list-loaihang-table_text-center">
            <th style="width: 5%;"></th>
            <th>Mã Khách Hàng </th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($listtk as $tk) : ?>
            <?php extract($tk) ?>
            <tr onclick="Check(this)">
                <td style="position: relative;"><input type="checkbox" onclick="event.stopPropagation()"></td>
                <td><?= $id ?></td>
                <td><?= $user ?></td>
                <td><?= $pass ?></td>
                <td><?= $email ?></td>
                <td><?= $address ?></td>
                <td><?= $tel ?></td>
                <td><?= $role ?></td>
                <td>
                    <div class="form-loaihang-btns">
                        <div class="form-loaihang-btn" onclick="Update(<?= $id ?>)">Sửa</div>
                        <div class="form-loaihang-btn" onclick="Delete(<?= $id ?>)">Xoá</div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="form-loaihang-btns">
    <div class="form-loaihang-btn" onclick="CheckAll()">Chọn tất cả</div>
    <div class="form-loaihang-btn" onclick="UnCheckAll()">Bỏ chọn tất cả</div>
    <!-- <div class="form-loaihang-btn" onclick="DeleteCheck()">Xoá các mục chọn</div> -->
</div>
</div>
<script>
    function Delete(id) {
        var submit = confirm("Bạn có muốn xoá danh mục này ?")
        if (submit) window.location = 'index.php?act=xoatk&id=' + id
        event.stopPropagation()
    }

    function Update(id) {
        window.location = 'index.php?act=suasanpham&id=' + id
        event.stopPropagation()
    }

    function Check(x) {
        var checkBox = x.querySelector("input")
        if (checkBox.checked) {
            checkBox.checked = false
        } else {
            checkBox.checked = true
        }
    }

    function CheckAll() {
        var rows = document.querySelector("tbody").querySelectorAll("tr")
        rows.forEach((row) => {
            var checkBox = row.querySelector("td").querySelector("input")
            checkBox.checked = true
        })
    }

    function UnCheckAll() {
        var rows = document.querySelector("tbody").querySelectorAll("tr")
        rows.forEach((row) => {
            var checkBox = row.querySelector("td").querySelector("input")
            checkBox.checked = false
        })
    }

    function DeleteCheck() {
        if(confirm("Bạn có muốn xoá các mục đã chọn ?")) {
            var _id = getIdCheck()
            var idQry = _id.map(function(el, idx) {
                return 'id[' + idx + ']=' + el;
            }).join('&');
            window.location = 'index.php?act=xoasanphamcheck&' + idQry;
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