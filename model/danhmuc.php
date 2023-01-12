<?php
function add_danhmuc($tenloai)
{
    $sql = "INSERT INTO danhmuc(name) VALUE ('$tenloai')";
    pdo_execute($sql);
}

function list_danhmuc()
{
    $sql = "SELECT danhmuc.`id`, danhmuc.`name` FROM danhmuc ORDER BY danhmuc.id ASC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

function list_danhmuc_home($st, $ed) {
    $sql = "SELECT danhmuc.`id`, danhmuc.`name` FROM danhmuc ORDER BY danhmuc.id ASC LIMIT $st, $ed";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

function delete_danhmuc($id)
{
    $sql = "DELETE FROM `duanmau`.`danhmuc` WHERE `id` = $id;";
    pdo_execute($sql);
}

function update_danhmuc($maloai, $tenloai)
{
    $sql = "UPDATE `duanmau`.`danhmuc` SET `name` = '$tenloai' WHERE `id` = $maloai";
    pdo_execute($sql);
}

function delete_danhmuc_check($_id)
{
    $sqlId = join(' OR ', array_map(function ($id) {
        return '`id` =' . $id;
    }, $_id));
    $sql = "DELETE FROM `duanmau`.`danhmuc` WHERE $sqlId;";
    pdo_execute($sql);
}

function load_danhmuc($id)
{
    $sql = "SELECT * FROM danhmuc WHERE danhmuc.`id`=$id";
    $dm = pdo_query_one($sql);
    return $dm;
}
