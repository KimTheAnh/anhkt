<main>
    <?php
    if (isset($listthongbao)) {
        foreach ($listthongbao as $thongbao) {
            echo '<p style="color: red">' . $thongbao . '</p>';
        }
        // dd($listthongbao);
    }
    ?>
    <div class="row column-3-1">
        <div class="sidebar-item ">
            <div class="sidebar_header">
                Nhập mật khẩu mới
            </div>
            <div class="content form-content">
                <form class="form-loaihang" action="index.php?act=resetmk&id=<?= $id ?>" method="POST">
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Nhập mật khẩu mới</div>
                        <input type="password" class="form-loaihang-input" name="pass">
                    </div>
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Nhập lại mật khẩu</div>
                        <input type="password" class="form-loaihang-input" name="repass">
                    </div>

                    <div class="form-loaihang-btns">
                        <input type="submit" class="form-loaihang-btn" value="Gửi" name="gui">
                        <input type="reset" class="form-loaihang-btn" value="Nhập lại">
                    </div>
                </form>
            </div>

        </div>

        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>