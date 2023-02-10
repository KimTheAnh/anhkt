<?php
function add_bill_login($idUser, $cart, $pt, $ngaydathang) {
    
    $sql = "INSERT INTO `duanmau`.`donhang` (`iduser`, `pttt`, `ngaydathang`) VALUES ($idUser, $pt, '$ngaydathang');";
    $IdDonHang = pdo_execute_lastInsertId($sql);
    foreach($cart as $item) {
        extract($item);
        $sql = "INSERT INTO `duanmau`.`donhangct` (`iddonhang`, `idsp`, `soluong`) VALUES ($IdDonHang, $id, $quantity);";
        pdo_execute($sql);
    }

    return $IdDonHang;
}

function add_bill($user_name, $user_address, $user_email, $user_tel, $cart, $pt, $ngaydathang) {
    
    $sql = "INSERT INTO `duanmau`.`donhang` (`pttt`, `ngaydathang`, `user_name`, `user_address`, `user_email`, `user_tel`) VALUES ($pt, '$ngaydathang', '$user_name', '$user_address', '$user_email', '$user_tel');";
    $IdDonHang = pdo_execute_lastInsertId($sql);
    foreach($cart as $item) {
        extract($item);
        $sql = "INSERT INTO `duanmau`.`donhangct` (`iddonhang`, `idsp`, `soluong`) VALUES ($IdDonHang, $id, $quantity);";
        pdo_execute($sql);
    }

    return $IdDonHang;
}

function get_pttt($pt) {
    $sql = "SELECT thanhtoan.`name` FROM thanhtoan WHERE id = $pt";
    return pdo_query_one($sql);
}

function reduce_soluong_sp($cart) {
    foreach($cart as $item) {
        extract($item);
        $sql = "UPDATE `duanmau`.`sanpham` SET `soluong` = `soluong` - $quantity WHERE `id` = $id;";
        pdo_execute($sql);
    }
    
}