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
        <div class="content">
            <div class="admin-header" style="margin-top: 0;">
                Đăng ký tài khoản
            </div>
            <form class="form-loaihang" action="index.php?act=dangky" method="POST">
                <div class="form-loaihang-box">
                    <div class="form-loaihang-text">Email</div>
                    <input type="email" class="form-loaihang-input" name="email">
                </div>
                <div class="form-loaihang-box">
                    <div class="form-loaihang-text">Tên đăng nhập</div>
                    <input type="text" class="form-loaihang-input" name="user">
                </div>
                <div class="form-loaihang-box">
                    <div class="form-loaihang-text">Mật khẩu</div>
                    <input type="text" class="form-loaihang-input" name="pass">
                </div>
                <div class="form-loaihang-box">
                    <div class="form-loaihang-text">Nhập lại mật khẩu</div>
                    <input type="text" class="form-loaihang-input" name="repass">
                </div>

                <div class="form-loaihang-btns">
                    <input type="submit" class="form-loaihang-btn" value="Đăng ký" name="dangky">
                    <input type="reset" class="form-loaihang-btn" value="Nhập lại">
                </div>
            </form>
        </div>


        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>