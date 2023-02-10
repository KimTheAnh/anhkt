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
                Đăng ký tài khoản
            </div>
            <div class="content form-content">
                <form class="form-loaihang" >
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
                        <div class="form-loaihang-btn" name="dangky" onclick="validate()">Đăng ký</div>
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

<script>
    function validate() {
        var email = document.querySelector('input[name="email"]')
        var emailValue = email.value.trim()
        var user = document.querySelector('input[name="user"]')
        var userValue = user.value.trim()
        var pass = document.querySelector('input[name="pass"]')
        var passValue = pass.value.trim()
        var repass = document.querySelector('input[name="repass"]')
        var repassValue = repass.value.trim()
        var form_data = new FormData();
        form_data.append('email', emailValue);
        form_data.append('user', userValue);
        form_data.append('pass', passValue);
        form_data.append('repass', repassValue);

        $.ajax({
            url: "admin/api.php?act=dangky", //Server api to receive the file
            type: "POST",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function(suc) {
                var thongbao = JSON.parse(suc)

                if (thongbao == "ok") {
                    toast({
                        title: "Thành công!",
                        message: "Bạn đã đăng ký thành công",
                        type: "success",
                        duration: 5000
                    });
                    setTimeout(() => {
                        window.location = "index.php"
                    }, 1000);
                } else {
                    thongbao.forEach(i => {
                        toast({
                        title: "Thất bại!",
                        message: i,
                        type: "error",
                        duration: 5000
                    });
                    });
                    
                }
            }
        });
        return false
    }
</script>