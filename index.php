<?php
session_start();
require "model/pdo.php";
require "model/sanpham.php";
require "model/danhmuc.php";
require "model/taikhoan.php";
require "model/bill.php";
require "global.php";
require "view/header.php";
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// unset($_SESSION['cart']);
$listdanhmuc = list_danhmuc_home(0, 9);
$spnew = get_listsanpham_home(0, 9);
$spluotxem = get_sanpham_luotxem(0, 9);
// $act = "";
if (isset($_GET['act']) && $_GET['act'] != "") {
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
            if (empty($listsp)) {
                $thongbao = "Không có sản phẩm nào phù hợp";
            }
            require "view/timkiem.php";
            break;

        case 'dangky':
            if (isset($_POST['dangky'])) {
                $listthongbao = [];

                $user = $_POST['user'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $repass = $_POST['repass'];
                if ($pass != $repass) {
                    $listthongbao[] = "Mật khẩu nhập lại không chính xác";
                }

                if (empty($listthongbao)) {
                    $sql = "INSERT INTO `duanmau`.`taikhoan` (`user`, `pass`, `email`, `address`, `tel`) VALUES ('$user', $pass, '$email', '', '')";
                    pdo_execute($sql);
                    $listthongbao[] = "Đăng ký thành công";
                }
            }
            require "view/taikhoan/dangky.php";

        case 'dangnhap':
            if (isset($_POST['dangnhap'])) {
                $thongbao = "";
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $tk = get_user($user, $pass);

                if (empty($tk)) {
                    $thongbao = "Tên đang nhập hoặc mật khẩu của bạn không đúng!";
                } else {
                    $_SESSION['user'] = $tk;
                    $thongbao = "Đăng nhập thành công";
                }
                // dd($thongbao);
                // header("Location: index.php");
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
            break;

        case 'capnhattk':
            if (isset($_POST['capnhat'])) {
                $listthongbao = [];
                $id = $_POST['id'];
                $user = $_POST['user'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $repass = $_POST['repass'];
                $tel = $_POST['tel'];
                $address = $_POST['address'];
                if ($pass != $repass) {
                    $listthongbao[] = "Mật khẩu nhập lại không chính xác";
                }

                if (empty($listthongbao)) {
                    update_user($id, $user, $pass, $email, $address, $tel);
                    $listthongbao[] = "Cập nhật thành công";
                    $_SESSION['user'] = get_all_info_user($id);
                }
            }
            require "view/taikhoan/capnhattk.php";
            break;

        case 'quenmk':
            if (isset($_POST['gui'])) {
                $listthongbao = [];
                $user = $_POST['user'];
                $email = $_POST['email'];
                $tk = get_id_user_reset_pass($user, $email);

                if (empty($tk)) {
                    $listthongbao[] = "Dữu liệu không chính xác vui lòng nhập lại";
                } else {
                    header("Location: index.php?act=resetmk&id=" . $tk['id']);
                }
            }
            require "view/taikhoan/quenmk.php";
            break;

        case 'resetmk':
            $id = $_GET['id'];
            if (isset($_POST['gui'])) {
                $listthongbao = [];
                $pass = $_POST['pass'];
                $repass = $_POST['repass'];

                if ($pass != $repass) {
                    $listthongbao[] = "Vui lòng nhập mật khẩu trùng khớp";
                } else {
                    update_pass($id, $pass);
                    header("Location: index.php");
                }
            }
            require "view/taikhoan/resetmk.php";
            break;

        case 'giohang':
            $listsp = $_SESSION['cart'];
            // dd($listsp);
            include "view/giohang/giohang.php";

            break;


        case 'addgiohang':
            if ($_POST['idpro']) {
                $id = $_POST['idpro'];
                $quantity = $_POST['quantity'];
                $add = 1;
                foreach ($_SESSION['cart'] as $index => $value) {
                    if ($value['id'] == $id) {
                        $_SESSION['cart'][$index]['quantity'] += $quantity;
                        $add = 0;
                    }
                }

                if ($add == 1) {
                    $sp = load_sanpham($id);
                    if (!empty($sp)) {
                        extract($sp);
                        $sp = [
                            'id' => $id,
                            'name' => $name,
                            'price' => $price,
                            'img' => $img,
                            'quantity' => $quantity,
                        ];
                        $_SESSION['cart'][] = $sp;
                    }
                } else {
                    echo "Sản phẩm đã có";
                }
                dd($_SESSION['cart']);
            }
            break;


        case 'deletegiohang':
            if ($_GET['id']) {
                $id = $_GET['id'];
                foreach ($_SESSION['cart'] as $index => $value) {
                    if ($value['id'] == $id) {
                        unset($_SESSION['cart'][$index]);
                    }
                }
            }
            header("Location:" . $_SERVER['HTTP_REFERER']);
            break;

        case 'bill':
            $cart = $_SESSION['cart'];
            if (isset($_SESSION['user'])) {
                $info = $_SESSION['user'];
                extract($info);
            }
            include "view/bill/bill.php";
            break;

        case 'billcomfirm':
            if (!empty($_SESSION['cart'])) {
                $pt = $_POST['phuongthuc'];
                $date = getdate();
                $ngay = $date['mday'];
                $thang = $date['wday'];
                $nam = $date['year'];
                $ngaydathang = "$ngay/$thang/$nam";
                $cart = $_SESSION['cart'];
                $pttt = get_pttt($pt)['name'];
                if (isset($_SESSION['user'])) {
                    $idUser = $_SESSION['user']['id'];
                    $idDonHang = add_bill_login($idUser, $cart, $pt, $ngaydathang);
                    $_SESSION['cart'] = [];
                    $info = $_SESSION['user'];
                    extract($info);
                } else {
                    $user = $_POST['name'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];
                    $tel = $_POST['tel'];
                    $idDonHang = add_bill($user, $address, $email, $tel, $cart, $pt, $ngaydathang);
                    $_SESSION['cart'] = [];
                }
                include "view/bill/billcomfirm.php";
            } else {
                header("Location: index.php");
            }
            break;

        case 'thoat':
            unset($_SESSION['user']);
            header("Location:" . $_SERVER['HTTP_REFERER']);
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
