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
                Xác minh tài khoản
            </div>
            <div class="content form-content">
                <form class="form-loaihang" action="index.php?act=quenmk" method="POST">
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Email</div>
                        <input type="email" class="form-loaihang-input" name="email">
                    </div>
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Tên đăng nhập</div>
                        <input type="text" class="form-loaihang-input" name="user">
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