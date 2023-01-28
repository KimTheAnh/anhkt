<?php
function add_taikhoan($user, $pass, $email)
{
    $sql = "INSERT INTO `duanmau`.`taikhoan` (`user`, `pass`, `email`, `address`, `tel`) VALUES ('$user', $pass, '$email', '', '')";
    pdo_execute($sql);
}

function get_user($user, $pass)
{
    $sql = "SELECT * FROM taikhoan WHERE user = '$user' AND pass = '$pass'";
    $tk = pdo_query_one($sql);

    return $tk;
}

function get_all_info_user($id) 
{
    $sql = "SELECT * FROM taikhoan WHERE id = $id";
    $tk = pdo_query_one($sql);
    
    return $tk;
}
