<?php
    require "model/pdo.php";
    require "model/sanpham.php";
    require "model/danhmuc.php";
    require "model/taikhoan.php";
    require "global.php";
    require "view/header.php";
    
    $listdanhmuc = list_danhmuc_home(0,9);
    $spnew = get_listsanpham_home(0,9);
    $spluotxem = get_sanpham_luotxem(0, 9);
    // $act = "";
    if(isset($_GET['act']) && $_GET['act'] != "") {
        $act = $_GET['act'];
        require "view/navbar.php";
        switch ($act) {
            case 'gioithieu':
                require "view/gioithieu.php";
                break;

            case 'lienhe':
                require "view/lienhe.php";
                break;

            case 'spchitiet':
                $id = $_GET['id'];
                $sp = load_sanpham($id);
                extract($sp);
                $listsp = get_listsanpham_loai($id, $iddm);
                require "view/spchitiet.php";
                break;

            case 'timkiem':
                $kyw = $_GET['kyw'];
                $listsp = get_listsanpham_name($kyw);
                $thongbao = "";
                if(empty($listsp)) {
                    $thongbao = "Không có sản phẩm nào phù hợp";
                }
                require "view/timkiem.php";
                break;

            case 'dangky':
                if(isset($_POST['dangky'])) {
                    $listthongbao = [];
                    
                    $user = $_POST['user'];
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];
                    $repass = $_POST['repass'];
                    if($pass != $repass) {
                        $listthongbao[] = "Mật khẩu nhập lại không chính xác";
                    }

                    if(empty($listthongbao)) {
                        $sql = "INSERT INTO `duanmau`.`taikhoan` (`user`, `pass`, `email`, `address`, `tel`) VALUES ('$user', $pass, '$email', '', '')";
                        pdo_execute($sql);
                        $listthongbao[] = "Đăng ký thành công";
                    }
                }
                require ("view/dangky.php");
                break;

            default:
                require "view/home.php";
                break;
        } 
    } else {
        require "view/navbar.php";
        require "view/home.php";
    }

    
    require "view/footer.php";
?>