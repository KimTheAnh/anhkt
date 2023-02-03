<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="box-sanphamct" style="margin-top: 0;">
                <div class="box-sanphamct_header" >
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
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="flex-center">
                                        <div class="table-giohang_img" style="background-image: url(https://images.pexels.com/photos/54300/pexels-photo-54300.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500);"></div>
                                    </div>
                                </td>
                                <td>aaaa</td>
                                <td>2</td>
                                <td>122222</td>
                                <td>
                                    <div class="form-loaihang-btns">
                                        <div class="form-loaihang-btn" onclick="Delete(<?= $id ?>)">Xoá</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>

<script>
    function Delete(id) {
        var submit = confirm("Bạn có muốn xoá danh mục này ?")
        if (submit) window.location = 'index.php?act=xoakhachhang&id=' + id
        event.stopPropagation()
    }

    function Update(id) {
        window.location = 'index.php?act=suakhachhang&id=' + id
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
        if (confirm("Bạn có muốn xoá các mục đã chọn ?")) {
            var _id = getIdCheck()
            var idQry = _id.map(function(el, idx) {
                return 'id[' + idx + ']=' + el;
            }).join('&');
            window.location = 'index.php?act=xoakhachhangcheck&' + idQry;
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