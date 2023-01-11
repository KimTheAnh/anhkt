<?php
function add_sanpham($id, $tensanpham, $giasanpham, $imgName, $motasanpham, $danhmucsanpham)
{
    $sql = "INSERT INTO `duanmau`.`sanpham` (`id`, `name`, `price`, `img`, `mota`, `iddm`) VALUES ($id , '$tensanpham', $giasanpham, '$imgName', '$motasanpham', $danhmucsanpham)";
    pdo_execute($sql);
}

function get_listdanhmuc() {
    $sql = "SELECT danhmuc.`id`, danhmuc.`name` FROM danhmuc ORDER BY danhmuc.id ASC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

function list_sanpham()
{
    $sql = "SELECT sanpham.id, sanpham.`name`, sanpham.price, sanpham.img, sanpham.mota, sanpham.luotxem, danhmuc.`name` AS `namedm` FROM sanpham JOIN danhmuc ON sanpham.iddm = danhmuc.id";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

function get_img_sanpham($id) {
    $sql = "SELECT sanpham.img FROM sanpham WHERE `id` = $id";
    $img = (pdo_query_one($sql)['img']);
    return $img;
}

function delete_sanpham($id)
{
    $sql = "DELETE FROM `duanmau`.`sanpham` WHERE `id` = $id;";
    pdo_execute($sql);
}

function update_sanpham($masanpham , $tensanpham, $giasanpham, $motasanpham, $luotxemsanpham, $danhmucsanpham)
{
    $sql = "UPDATE `duanmau`.`sanpham` SET `name` = '$tensanpham', `price` = $giasanpham, `mota` = '$motasanpham', `luotxem` = $luotxemsanpham, `iddm` = $danhmucsanpham WHERE `id` = $masanpham;";
    pdo_execute($sql);
}

function delete_sanpham_check($_id)
{
    $sqlId = join(' OR ', array_map(function ($id) {
        return '`id` =' . $id;
    }, $_id));
    foreach($_id as $id) {
        $img = get_img_sanpham($id);
        $img = 'sanpham/img/'.$img;
        unlink($img);
    }
    
    $sql = "DELETE FROM `duanmau`.`sanpham` WHERE $sqlId;";
    pdo_execute($sql);
}

function load_sanpham($id)
{
    $sql = "SELECT sanpham.id, sanpham.`name`, sanpham.price, sanpham.img, sanpham.mota, sanpham.luotxem, sanpham.iddm FROM sanpham WHERE sanpham.id = $id";
    $sp = pdo_query_one($sql);
    return $sp;
}
