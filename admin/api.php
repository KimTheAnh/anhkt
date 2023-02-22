<?php
require "../model/pdo.php";
require "../model/danhmuc.php";
require "../model/sanpham.php";
require "../model/taikhoan.php";
require "../model/binhluan.php";
require "../global.php";
session_start();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'adddm':
            $thongbao = '';
            $danhmuc = $_POST['name'];
            if ($danhmuc == "") {
                $thongbao = 'Danh mục không được để trống';
                echo_json($thongbao);
                break;
            }
            $listDanhMuc = get_listdanhmuc();
            foreach ($listDanhMuc as $item) {
                extract($item);
                if ($name == $danhmuc) {
                    $thongbao = 'Danh mục đã tồn tại';
                    echo_json($thongbao);
                    break;
                }
            }

            if ($thongbao == '') {
                echo_json($thongbao);
                add_danhmuc($danhmuc);
            }
            break;

        case 'dangky':
            $thongbao = [];
            if(isset($_POST)) {
                $user = $_POST['user'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $repass = $_POST['repass'];

                if($user == "" || $email == "" || $pass == "") {
                    $thongbao[] = "Cách trường đánh dấu không được để trống";
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL) && $email != "") {
                    $thongbao[] = "Trường email phải nhập email";
                }
                if($user != "" && check_user_isExist($user)) {
                    $thongbao[] = "Tên đăng nhập này đã tồn tại";
                }
                if ($pass != $repass && $pass != "") {
                    $thongbao[] = "Mật khẩu nhập lại không chính xác";
                }

                if (empty($thongbao)) {
                    add_taikhoan($user, $pass, $email);
                    $tk = get_user($user, $pass);
                    $_SESSION['user'] = $tk;
                    echo_json("ok");
                } else {
                    echo_json($thongbao);
                }
            }
            break;

        case 'addsp':
            if (isset($_POST)) {
                $thongbao = [];

                $tensanpham = $_POST['tensanpham'];
                $giasanpham = $_POST['giasanpham'];
                $motasanpham = $_POST['motasanpham'];
                $danhmucsanpham = $_POST['danhmucsanpham'];

                if ($tensanpham == "" || $giasanpham  == "" || !isset($_FILES['file'])) {
                    $thongbao[] = "Các trường đánh dấu không được bỏ trống";
                }

                if ($giasanpham < 0 && $giasanpham != "") {
                    $thongbao[] = "Giá sản phẩm không được nhỏ hơn 0";
                }

                if ($thongbao == []) {
                    $sql = "SELECT sanpham.`id` FROM sanpham ORDER BY sanpham.id DESC LIMIT 1";
                    $id = pdo_query_one($sql)['id'];
                    // dd($id);
                    $id++;
                    mkdir('sanpham/img/' . $id, 0777, true);
                    $dir = "sanpham/img/" . $id . "/";
                    $listImg = [];
                    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                        $imgUpload = $_FILES['file']['name'][$i];
                        $imgFileType = pathinfo($imgUpload, PATHINFO_EXTENSION);
                        $imgName = $i . '.' . $imgFileType;
                        $imgLink = $dir . $imgName;
                        $listImg[] = $imgName;
                        move_uploaded_file($_FILES['file']['tmp_name'][$i], $imgLink);
                    }

                    $stringListImg =  implode(", ", $listImg);
                    add_sanpham($id, $tensanpham, $giasanpham, $stringListImg, $motasanpham, $danhmucsanpham);
                    echo_json("ok");
                } else {
                    echo_json($thongbao);
                }


                $thongbao = "Thêm thành công";
            }
            break;

            case 'cart':
                if(isset($_SESSION['user'])) {
                    $thongbao = "";
                    if($_SESSION['user']['address'] == "" || $_SESSION['user']['tel'] == "") {
                        $thongbao = "Bạn phải cập nhật số điện thoại và địa chỉ thì mới có thể đặt hàng";
                        echo_json($thongbao);
                    }

                    if($thongbao == "") echo_json("ok");
                } else {
                    echo_json("ok");
                }
                break;

            case 'checkSoLuong':
                $thongbao = [];
                foreach($_SESSION['cart'] as $item) {
                    if($item['quantity'] > get_soluongsp($item['id'])) {
                        $thongbao[] = 'Sản phẩm ' . $item['name'] . " không có đủ lượng trong kho vui lòng liên hệ chăm sóc khách hàng" ;
                    }
                }
                echo_json($thongbao);
                break;
            

            case 'nhapluong':
                $soluong = $_POST['soluong'];
                $id = $_POST['id'];
                add_soluong($id, $soluong);
                $sql = "SELECT sanpham.soluong FROM sanpham WHERE `id` = $id";
                $luongSP = get_soluong($id);
                echo_json($luongSP);
                break;
            
            case 'thongke':
                switch ($_POST['name']) {
                    case 'soluotxem':
                        $listsp = get_top10_luotxem();
                        $_name = [];
                        $_luotxem = [];
                        foreach($listsp as $sp) {
                            $_name[] = $sp['name'];
                            $_luotxem[] = $sp['luotxem'];
                        };
                        $data = [
                            'label' => $_name,
                            'data' => $_luotxem,
                            'name' => 'Top 10 lượt xem'
                        ];

                        echo_json($data);
                        break;

                    case 'hangbanchay':
                        $listsp = get_top10_banchay();
                        $_name = [];
                        $_soluong = [];
                        foreach($listsp as $sp) {
                            $_name[] = $sp['name'];
                            $_soluong[] = $sp['soluong'];
                        };
                        $data = [
                            'label' => $_name,
                            'data' => $_soluong,
                            'name' => 'Top 10 bán chạy'
                        ];

                        echo_json($data);
                        break;
                        
                }
                break;
    }
}
