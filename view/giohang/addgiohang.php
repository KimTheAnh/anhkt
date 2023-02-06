<?php
include "../../global.php";
include "../../model/pdo.php";
// session_start();
if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = [];
}
if (isset($_REQUEST['idpro'])) {
    $id = $_REQUEST['idpro'];
    $sql = "SELECT * FROM sanpham WHERE id = $id ";
    $sp = pdo_query_one($sql);
    if (empty($sp)) {
        $thongbao = [
            'title' => "Thất bại!",
            'message' => "Có lỗi xảy ra, vui lòng liên hệ chăm sóc khác hàng",
            'type' => "error",
            'duration' => 5000
        ];
    } else {
        $_SESSION['mycart'][] = $id;
        $thongbao = [
            'title' => "Thành công!!",
            'message' => "Bạn đã thêm thành công sản phẩm vào giỏ hàng",
            'type' => "success",
            'duration' => 5000
        ];
    }
} else {
    $thongbao = [
        'title' => "Thất bại!",
        'message' => "Có lỗi xảy ra, vui lòng liên hệ chăm sóc khác hàng",
        'type' => "error",
        'duration' => 5000
    ];
}

dd($_SESSION['mycart'])
?>