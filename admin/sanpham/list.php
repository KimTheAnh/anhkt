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
                            <div class="form-loaihang-btn" onclick="inputSoLuong(this)">Thêm số lượng</div>
                            <input id="themluong" type="number" min='0' step="1" value="0" style="" onkeypress="nhapsoluong(event, this, <?= $id ?>)" onclick="event.stopPropagation()">
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

        function sanphamDelete(id) {
            var submit = confirm("Bạn có muốn xoá danh mục này ?")
            if (submit) window.location = 'index.php?act=xoasanpham&id=' + id
            event.stopPropagation()
        }

        function inputSoLuong(e) {
            var input = e.parentElement.querySelector('#themluong')
            input.style.display = "block"
            e.replaceWith(input)
            event.stopPropagation()
        }

        function nhapsoluong(e, x, id) {
            if (e.keyCode == 13) {
                var soluong = Number(x.value);
                if (soluong < 0) {
                    toast({
                        title: "Thất bại!",
                        message: "Bạn phải nhập số lớn hơn 0",
                        type: "error",
                        duration: 5000
                    });
                } else {
                    var form_data = new FormData();
                    form_data.append('id', id)
                    form_data.append('soluong', soluong)
                    $.ajax({
                        url: "api.php?act=nhapluong", //Server api to receive the file
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(res) {
                            var soluongSP = JSON.parse(res)
                            toast({
                                title: "Thành công!",
                                message: `Thêm thành công số lượng của sản phẩm giờ là <h4>${soluongSP}</h4>`,
                                type: "success",
                                duration: 5000
                            });
                            x.style.display = "none"
                            x.value = 0
                            var btn = document.createElement('div')
                            btn.innerHTML = "Thêm số lượng"
                            btn.classList.add('form-loaihang-btn')
                            btn.addEventListener('click', function() {
                                var input = this.parentElement.querySelector('#themluong')
                                input.style.display = "block"
                                this.replaceWith(input)
                                event.stopPropagation()
                            })
                            x.parentElement.appendChild(btn)
                        }
                    });
                }
            }
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
            if (confirm("Bạn có muốn xoá các mục đã chọn ?")) {
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