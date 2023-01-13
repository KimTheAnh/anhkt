<?php
    require "model/pdo.php";
    require "model/sanpham.php";
    require "model/danhmuc.php";
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