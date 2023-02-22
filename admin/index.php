<?php
    session_start();
    require "header.php";
    require "../model/pdo.php";
    require "../model/danhmuc.php";
    require "../model/sanpham.php";
    require "../model/taikhoan.php";
    require "../model/binhluan.php";
    require "../global.php";
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']['role'] == 0) {
            header('Location:../index.php');
        }
    } else {
        header('Location:../index.php');
    }
    if(isset($_GET['act'])) {
        $act = $_GET['act'];
        require "navbar.php";
        switch ($act) {
            case 'adddm':
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
                $listdanhmuc = get_listdanhmuc();
                // if (isset($_POST['themmoi'])) {
                //     $sql = "SELECT sanpham.`id` FROM sanpham ORDER BY sanpham.id DESC LIMIT 1";
                //     $id = pdo_query_one($sql)['id'];
                //     $tensanpham = $_POST['tensanpham'];
                //     $giasanpham = $_POST['giasanpham'];
                //     $motasanpham = $_POST['motasanpham'];
                //     $danhmucsanpham = $_POST['danhmucsanpham'];
                    
                //     if(isset($_FILES['anhsanpham'])) {
                //         $dir = "sanpham/img/";
                //         $imgUpload = $_FILES['anhsanpham']['name'];
                //         $imgFileType = pathinfo($imgUpload,PATHINFO_EXTENSION);
                //         $imgName = ++$id.'.'.$imgFileType;
                //         $imgLink = $dir.$imgName;
                //         move_uploaded_file($_FILES['anhsanpham']['tmp_name'], $imgLink);
                //     }
                //     add_sanpham($id, $tensanpham, $giasanpham, $imgName, $motasanpham, $danhmucsanpham);
                //     $thongbao = "Thêm thành công";
                // }
                require "sanpham/add.php";
                break;

                case 'listsanpham':
                    $listsanpham = list_sanpham();
                    require "sanpham/list.php";
                    break;
                
                case 'xoasanpham':
                    if(isset($_GET['id'])&&$_GET['id']>0) {
                        $id = $_GET['id'];
                        $img = get_img_sanpham($id);
                        $img = 'sanpham/img/'.$img;
                        if(unlink($img)) {
                            delete_sanpham($id);
                        }
                    }
                    header("Location:index.php?act=listsanpham");
                    break;
                
                case 'suasanpham':
                    if(isset($_GET['id'])&&$_GET['id']>0) {
                        $listdanhmuc = get_listdanhmuc();
                        $id = $_GET['id'];
                        $sp = load_sanpham($id);
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
                        $soluongsanpham = $_POST['soluongsanpham'];
                        update_sanpham($masanpham , $tensanpham, $giasanpham, $motasanpham, $luotxemsanpham, $danhmucsanpham,$soluongsanpham);
                    }
                    header("Location:index.php?act=listsanpham");
                    break;

                case 'xoasanphamcheck':
                    if (isset($_GET['id'])) {
                        $_id = $_GET['id'];
                        delete_sanpham_check($_id);
                    }
                    header("Location:index.php?act=listsanpham");
                    break;

                case 'dskh':
                    $listtk = get_listtk();
                    require "taikhoan/list.php";
                    break;

                case 'xoakhachhang':
                    $id = $_GET['id'];
                    delete_khachhang($id);
                    header("Location: index.php?act=dskh");
                    require "binhluan/list.php";
                    break;
                
                case 'xoakhachhangcheck':
                    if (isset($_GET['id'])) {
                        $_id = $_GET['id'];
                        delete_khachhang_check($_id);
                    }
                    header("Location:index.php?act=dskh");
                    break;

                case 'listbinhluan':
                    $listbinhluan = get_list_binhluan();
                    require "binhluan/list.php";
                    break;

                case 'xoabinhluan':
                    $id = $_GET['id'];
                    delete_binhluan($id);
                    header("Location: index.php?act=listbinhluan");
                    require "binhluan/list.php";
                    break;
                
                case 'xoabinhluancheck':
                    if (isset($_GET['id'])) {
                        $_id = $_GET['id'];
                        delete_binhluan_check($_id);
                    }
                    header("Location:index.php?act=listbinhluan");
                    break;
                
                
                case 'updaterole':
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $role = $_GET['role'];
                        update_role($id, $role);
                    }
                    header("Location:index.php?act=dskh");
                    break;
                
                case 'thongke':
                    require 'thongke/thongke.php';
                    break;
            default:
                require "home.php";
                break;
        }
    } else {
        require "navbar.php";
        require "home.php";
    }


    require "footer.php";
?>