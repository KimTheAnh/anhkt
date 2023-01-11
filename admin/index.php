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

            // controller sản phẩm

            case 'addsp':
                $sql = "SELECT danhmuc.`id`, danhmuc.`name` FROM danhmuc ORDER BY danhmuc.id ASC";
                $listdanhmuc = pdo_query($sql);
                if (isset($_POST['themmoi'])) {
                    $sql = "SELECT sanpham.`id` FROM sanpham ORDER BY sanpham.id DESC LIMIT 1";
                    $id = pdo_query_one($sql)['id'];
                    $tensanpham = $_POST['tensanpham'];
                    $giasanpham = $_POST['giasanpham'];
                    $motasanpham = $_POST['motasanpham'];
                    $danhmucsanpham = $_POST['danhmucsanpham'];
                    
                    if(isset($_FILES['anhsanpham'])) {
                        $dir = "sanpham/img/";
                        $imgUpload = $_FILES['anhsanpham']['name'];
                        $imgFileType = pathinfo($imgUpload,PATHINFO_EXTENSION);
                        $imgName = ++$id.'.'.$imgFileType;
                        $imgLink = $dir.$imgName;
                        move_uploaded_file($_FILES['anhsanpham']['tmp_name'], $imgLink);
                    }
                    $sql = "INSERT INTO `duanmau`.`sanpham` (`id`, `name`, `price`, `img`, `mota`, `iddm`) VALUES ($id , '$tensanpham', $giasanpham, '$imgName', '$motasanpham', $danhmucsanpham)";
                    pdo_execute($sql);
                    $thongbao = "Thêm thành công";
                }
                require "sanpham/add.php";
                break;

                case 'listsanpham':
                    $sql = "SELECT sanpham.id, sanpham.`name`, sanpham.price, sanpham.img, sanpham.mota, sanpham.luotxem, danhmuc.`name` AS `namedm` FROM sanpham JOIN danhmuc ON sanpham.iddm = danhmuc.id";
                    $listsanpham = pdo_query($sql);
                    // print_r($listsp);
                    require "sanpham/list.php";
                    break;
                
                case 'xoasanpham':
                    if(isset($_GET['id'])&&$_GET['id']>0) {
                        $id = $_GET['id'];
                        $sql = "SELECT sanpham.img FROM sanpham WHERE `id` = $id";
                        $img = (pdo_query_one($sql)['img']);
                        $img = 'sanpham/img/'.$img;
                        if(unlink($img)) {
                            $sql = "DELETE FROM `duanmau`.`sanpham` WHERE `id` = $id;";
                            pdo_execute($sql);
                        } 
                    }
                    header("Location:index.php?act=listsanpham");
                    break;
                
                case 'suasanpham':
                    if(isset($_GET['id'])&&$_GET['id']>0) {
                        $sql = "SELECT danhmuc.`id`, danhmuc.`name` FROM danhmuc ORDER BY danhmuc.id ASC";
                        $listdanhmuc = pdo_query($sql);
                        $id = $_GET['id'];
                        $sql = "SELECT sanpham.id, sanpham.`name`, sanpham.price, sanpham.img, sanpham.mota, sanpham.luotxem, sanpham.iddm FROM sanpham WHERE sanpham.id = $id";
                        $sp = pdo_query_one($sql);
                    }
                    require "sanpham/update.php";
                    break;

                case 'updatesanpham':
                    if (isset($_POST['sua']) && isset($_GET['id'])) {
                        $masanpham = $_GET['id'];
                        $tensanpham = $_POST['tensanpham'];
                        $giasanpham = $_POST['giasanpham'];
                        $motasanpham = $_POST['motasanpham'];
                        $luotxemsanpham = $_POST['luotxemsanpham'];
                        $danhmucsanpham = $_POST['danhmucsanpham'];
                        $sql = "UPDATE `duanmau`.`sanpham` SET `name` = '$tensanpham', `price` = $giasanpham, `mota` = '$motasanpham', `luotxem` = $luotxemsanpham, `iddm` = $danhmucsanpham WHERE `id` = $masanpham;";
                        pdo_execute($sql);
                    }
                    header("Location:index.php?act=listsanpham");
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