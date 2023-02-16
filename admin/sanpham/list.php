<main>
<div class="admin-header">
    QUẢN LÝ LOẠI HÀNG
</div>

<table class="list-loaihang-table" style="text-align: center;">
    <thead>
        <tr class="list-loaihang-table_text-center">
            <th style="width: 5%;"></th>
            <th>MÃ </th>
            <th>TÊN </th>
            <th>GIÁ </th>
            <th>ẢNH </th>
            <th>MÔ TẢ </th>
            <th>LƯỢT XEM </th>
            <th>DANH MỤC </th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($listsanpham as $sanpham) : ?>
            <?php 
                extract($sanpham);
                $linkImg = explode(', ', $img);

            ?>
            <tr onclick="sanphamCheck(this)">
                <td style="position: relative;"><input type="checkbox" onclick="event.stopPropagation()"></td>
                <td><?= $id ?></td>
                <td><?= $name ?></td>
                <td><?= $price ?></td>
                <td>
                    <div class="list-loaihang-table_box-img">
                        <div class="list-loaihang-table_img" style="background-image: url(sanpham/img/<?= $id . "/" . $linkImg[0] ?>);"></div>
                    </div>
                </td>
                <!-- <td><?= $mota ?></td> -->
                <td><?= $luotxem ?></td>
                <td><?= $namedm ?></td>
                <td>
                    <div class="form-loaihang-btns">
                        <div class="form-loaihang-btn" onclick="sanphamUpdate(<?= $id ?>)">Sửa</div>
                        <div class="form-loaihang-btn" onclick="sanphamDelete(<?= $id ?>)">Xoá</div>
                        <div class="form-loaihang-btn" onclick="inputSoLuong(<?= $id ?>, this)">Thêm số lượng</div>
                        <input id="themluong" type="number" min='0' step="1" value="0" style="">
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="form-loaihang-btns">
    <div class="form-loaihang-btn" onclick="sanphamCheckAll()">Chọn tất cả</div>
    <div class="form-loaihang-btn" onclick="sanphamUnCheckAll()">Bỏ chọn tất cả</div>
    <div class="form-loaihang-btn" onclick="sanphamDeleteCheck()">Xoá các mục chọn</div>
    <a href="index.php?act=addsp" class="form-loaihang-btn">Nhập thêm</a>
</div>
</div>
<script>
    // var a = document.querySelector('a')
    // a.
    function sanphamDelete(id) {
        var submit = confirm("Bạn có muốn xoá danh mục này ?")
        if (submit) window.location = 'index.php?act=xoasanpham&id=' + id
        event.stopPropagation()
    }

    function inputSoLuong(id, e) {
        
        e.replaceWith(e.parentElement.querySelector('#themluong'))
        event.stopPropagation()

    }

    function sanphamUpdate(id) {
        window.location = 'index.php?act=suasanpham&id=' + id
        event.stopPropagation()
    }

    function sanphamCheck(x) {
        var checkBox = x.querySelector("input")
        if (checkBox.checked) {
            checkBox.checked = false
        } else {
            checkBox.checked = true
        }
    }

    function sanphamCheckAll() {
        var rows = document.querySelector("tbody").querySelectorAll("tr")
        rows.forEach((row) => {
            var checkBox = row.querySelector("td").querySelector("input")
            checkBox.checked = true
        })
    }

    function sanphamUnCheckAll() {
        var rows = document.querySelector("tbody").querySelectorAll("tr")
        rows.forEach((row) => {
            var checkBox = row.querySelector("td").querySelector("input")
            checkBox.checked = false
        })
    }

    function sanphamDeleteCheck() {
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
</main>