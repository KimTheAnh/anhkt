<?php
    require "header.php";
    require "../model/pdo.php";

    if(isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
            case 'adddm':
                if (isset($_POST['themmoi'])) {
                    $tenloai = $_POST['tenloai'];
                    $sql = "INSERT INTO danhmuc(name) VALUE ('$tenloai')";
                    pdo_execute($sql);
                    $thongbao = "Thêm thành công";
                }
                require "danhmuc/add.php";
                break;

            case 'addsp':
                require "sanpham/add.php";
                break;

            case 'listdanhmuc':
                $sql = "SELECT danhmuc.`id`, danhmuc.`name` FROM danhmuc ORDER BY danhmuc.id ASC";
                $listdanhmuc = pdo_query($sql);
                require "danhmuc/list.php";
                break;
                
            case 'xoadanhmuc':
                if(isset($_GET['id'])&&$_GET['id']>0) {
                    $id = $_GET['id'];
                    $sql = "DELETE FROM `duanmau`.`danhmuc` WHERE `id` = $id;";
                    pdo_execute($sql);
                }
                header("Location:index.php?act=listdanhmuc");
                break;

            case 'suadanhmuc':
                require "danhmuc/update.php";
                break;

            case 'updatedanhmuc':
                if (isset($_POST['sua']) && isset($_GET['id'])) {
                    $tenloai = $_POST['tenloai'];
                    $maloai = $_GET['id'];
                    echo $maloai;
                    $sql = "UPDATE `duanmau`.`danhmuc` SET `name` = '$tenloai' WHERE `id` = $maloai";
                    pdo_execute($sql);
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