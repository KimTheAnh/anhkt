<main>
    <div class="row column-3-1">
        <div class="sidebar-item">
            <div class="sidebar_header">
                Cập nhật tài khoản
            </div>
            <?php
            if (isset($listthongbao)) {
                foreach ($listthongbao as $thongbao) {
                    echo '<p style="color: red">' . $thongbao . '</p>';
                }
            }
            extract($_SESSION['user']);
            ?>
            <div class="content form-content">
                <form class="form-loaihang" action="index.php?act=capnhattk" method="POST">
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Email</div>
                        <input type="email" class="form-loaihang-input" name="email" value="<?= $email ?>">
                    </div>
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Tên đăng nhập</div>
                        <input type="text" class="form-loaihang-input" name="user" value="<?= $user ?>">
                    </div>
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Địa chỉ</div>
                        <input type="text" class="form-loaihang-input" name="address" value="<?= $address ?>">
                    </div>
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Số điện thoại</div>
                        <input type="text" class="form-loaihang-input" name="tel" value="<?= $tel ?>">
                    </div>
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Mật khẩu</div>
                        <input type="password" class="form-loaihang-input" name="pass" value="<?= $pass ?>">
                    </div>
                    <div class="form-loaihang-box">
                        <div class="form-loaihang-text">Nhập lại mật khẩu</div>
                        <input type="password" class="form-loaihang-input" name="repass" value="<?= $pass ?>">
                    </div>
    
                    <div class="form-loaihang-btns">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="submit" class="form-loaihang-btn" value="Cập nhật" name="capnhat">
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