<?php
function add_taikhoan($user, $pass, $email)
{
    $sql = "INSERT INTO `duanmau`.`taikhoan` (`user`, `pass`, `email`, `address`, `tel`) VALUES ('$user', $pass, '$email', '', '')";
    pdo_execute($sql);
}

function check_user_isExist($user) {
    $sql = "SELECT * FROM taikhoan WHERE taikhoan.`user` = '$user'";
    $check = pdo_query_one($sql);
    if($check == []) return false;
    return true;
}

function get_user($user, $pass)
{
    $sql = "SELECT * FROM taikhoan WHERE user = '$user' AND pass = '$pass'";
    $tk = pdo_query_one($sql);

    return $tk;
}

function update_user($id, $user, $pass, $email, $address, $tel)
{
    $sql = "UPDATE `duanmau`.`taikhoan` SET `user` = '$user', `pass` = '$pass', `email` = '$email', `address` = '$address', `tel` = '$tel' WHERE `id` = $id;";
    pdo_execute($sql);
}

function update_pass($id, $pass)
{
    $sql = "UPDATE `duanmau`.`taikhoan` SET `pass` = '$pass' WHERE `id` = $id;";
    pdo_execute($sql);
}

function get_id_user_reset_pass($user, $email)
{
    $sql = "SELECT taikhoan.id FROM taikhoan WHERE user = '$user' AND email = '$email'";
    $id = pdo_query_one($sql);

    return $id;
}

function get_all_info_user($id)
{
    $sql = "SELECT * FROM taikhoan WHERE id = $id";
    $tk = pdo_query_one($sql);

    return $tk;
}

function get_listtk()
{
    $sql = "SELECT * FROM taikhoan";
    $listtk = pdo_query($sql);

    return $listtk;
}


function delete_khachhang($id)
{
    $sql = "DELETE FROM `duanmau`.`taikhoan` WHERE `id` = $id;";
    pdo_execute($sql);
}

function delete_khachhang_check($_id)
{
    $sqlId = join(' OR ', array_map(function ($id) {
        return '`id` =' . $id;
    }, $_id));

    $sql = "DELETE FROM `duanmau`.`taikhoan` WHERE $sqlId;";
    pdo_execute($sql);
}

function update_role($id, $role) {
    $sql = "UPDATE `duanmau`.`taikhoan` SET `role` = '$role' WHERE `id` = $id;";
    pdo_execute($sql);
}
