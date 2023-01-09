<?php
    require "header.php";
    require "../model/pdo.php";
    require "../model/danhmuc.php";
    
    if(isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
            case 'adddm':
                if (isset($_POST['themmoi'])) {
                    $tenloai = $_POST['tenloai'];
                    add_danhmuc($tenloai);
                    $thongbao = "Thêm thành công";
                }
                require "danhmuc/add.php";
                break;

            case 'addsp':
                require "sanpham/add.php";
                break;

            case 'listdanhmuc':
                $listdanhmuc = list_danhmuc();
                require "danhmuc/list.php";
                break;
                
            case 'xoadanhmuc':
                if(isset($_GET['id'])&&$_GET['id']>0) {
                    $id = $_GET['id'];
                    delete_danhmuc($id);
                }
                header("Location:index.php?act=listdanhmuc");
                break;

            case 'suadanhmuc':
                if(isset($_GET['id'])&&$_GET['id']>0) {
                    $id = $_GET['id'];
                    $dm = load_danhmuc($id);
                }
                require "danhmuc/update.php";
                break;

            case 'updatedanhmuc':
                if (isset($_POST['sua']) && isset($_GET['id'])) {
                    $tenloai = $_POST['tenloai'];
                    $maloai = $_GET['id'];
                    update_danhmuc($maloai,$tenloai);
                }
                header("Location:index.php?act=listdanhmuc");
                break;

            case 'xoadanhmuccheck':
                if (isset($_GET['id'])) {
                    $_id = $_GET['id'];
                    delete_danhmuc_check($_id);
                }
                header("Location:index.php?act=listdanhmuc");
                break;

            default:
                require "home.php";
                break;
        }
    } else {
        require "home.php";
    }


    require "footer.php";
?>