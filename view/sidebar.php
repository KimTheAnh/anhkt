<div class="sidebar">
    <?php
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        extract($_SESSION['user']);
    ?>

        <div class="sidebar-item" style="padding-bottom: 20px;">
            <div class="sidebar_header">
                TÀI KHOẢN
            </div>
            <h2 style="padding: 0 20px 10px;">Xin chào</h2>
            <p style="padding: 0 20px;"><?= $user ?></p>
            <ul class="auth-form-list_help">
                <li class="auth-form_help"><a href="index.php?act=capnhattk">Cập nhật tài khoản</a></li>
                <?php if($role == 1){ ?>
                <li class="auth-form_help"><a href="admin/index.php">Đăng nhập Admin</a></li>
                <?php }?>
                <li class="auth-form_help"><a href="index.php?act=thoat">Thoát</a></li>
            </ul>
        </div>

    <?php } else {
    ?>
        <div class="sidebar-item">
            <div class="sidebar_header">
                TÀI KHOẢN
            </div>
            <form class="auth-form" action="index.php?act=dangnhap" method="post">
                <div class="auth-form_box">
                    <div class="auth-form_text">Tên đăng nhập</div>
                    <input type="text" class="auth-form_input" name="user">
                </div>
                <div class="auth-form_box">
                    <div class="auth-form_text">Mật khẩu</div>
                    <input type="password" class="auth-form_input" value="" name="pass">
                </div>
                <input type="checkbox" class="auth-form_save" id="">
                <div class="auth-form_savetext">Ghi nhớ tải khoản ?</div>
                <input type="submit" class="auth-form_btn" value="Đăng nhập" name="dangnhap">

                <ul class="auth-form-list_help">
                    <li class="auth-form_help"><a href="index.php?act=quenmk">Quên mật khẩu</a></li>
                    <li class="auth-form_help"><a href="index.php?act=dangky">Đăng ký thành viên</a></li>
                </ul>
            </form>
        </div>

    <?php } ?>




    <div class="sidebar-item">
        <div class="sidebar_header">DANH MỤC</div>
        <div class="danhmuc-list">
            <?php foreach ($listdanhmuc as $danhmuc) : ?>
                <?php extract($danhmuc) ?>
                <a href="" class="danhmuc-item"><?= $name ?></a>
            <?php endforeach; ?>
        </div>
        <div class="timkiem-input">
            <input type="text" onkeypress="timkiemsp(event, this)" oninput="loadtimkiemsp(this)" placeholder="Từ khoá tìm kiếm">
        </div>
    </div>

    <div class="sidebar-item">
        <div class="sidebar_header">TOP 10 YÊU THÍCH</div>
        <div class="toplike-list">
            <?php foreach ($spluotxem as $sp) : ?>
                <?php 
                    extract($sp);
                    $linkImg = explode(', ', $img);
                ?>
                <a href="index.php?act=spchitiet&id=<?= $id ?>" class="toplike-item">
                    <div class="toplike-item_img" style="background-image: url(<?= $imgdir .$id.'/'. $linkImg[0] ?>);">
                    </div>
                    <div class="toplike-item_name"><?= $name ?></div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    function timkiemsp(e, x) {
        if (e.keyCode == 13) {
            var kyw = x.value.trim()
            if (kyw != "") {
                window.location = "index.php?act=timkiem&kyw=" + kyw
            }
        }
    }

    function loadtimkiemsp(x) {
        // console.log(x.value)
    }
</script>