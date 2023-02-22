<?php
function add_sanpham($id, $tensanpham, $giasanpham, $imgName, $motasanpham, $danhmucsanpham)
{
    $sql = "INSERT INTO `duanmau`.`sanpham` (`id`, `name`, `price`, `img`, `mota`, `iddm`) 
    VALUES ($id , '$tensanpham', $giasanpham, '$imgName', '$motasanpham', $danhmucsanpham)";
    pdo_execute($sql);
}

function add_soluong($id, $soluong) {
    $sql = "UPDATE `duanmau`.`sanpham` SET `soluong` = sanpham.soluong + $soluong WHERE `id` = $id;";
    pdo_execute($sql);
}

function get_listdanhmuc()
{
    $sql = "SELECT danhmuc.`id`, danhmuc.`name` FROM danhmuc ORDER BY danhmuc.id ASC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

function get_listsanpham_home($st, $ed) {
    $sql = "SELECT sanpham.id, sanpham.`name`, sanpham.price, sanpham.img FROM sanpham 
    ORDER BY sanpham.id DESC LIMIT $st,$ed";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

function get_sanpham_luotxem($st, $ed) {
    $sql = "SELECT sanpham.id, sanpham.`name`, sanpham.img FROM sanpham 
    ORDER BY sanpham.luotxem DESC LIMIT $st,$ed";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

function increase_spluotxem($id) {
    $sql = "UPDATE `duanmau`.`sanpham` SET `luotxem` = `luotxem` + 1 WHERE `id` = $id;";
    pdo_execute($sql);
}

function list_sanpham()
{
    $sql = "SELECT sanpham.id, sanpham.`name`, sanpham.price, sanpham.img, sanpham.mota, sanpham.luotxem, danhmuc.`name` AS `namedm` 
    FROM sanpham JOIN danhmuc ON sanpham.iddm = danhmuc.id";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

function get_img_sanpham($id)
{
    $sql = "SELECT sanpham.img FROM sanpham WHERE `id` = $id";
    $img = (pdo_query_one($sql)['img']);
    return $img;
}

function delete_sanpham($id)
{
    $sql = "DELETE FROM `duanmau`.`sanpham` WHERE `id` = $id;";
    pdo_execute($sql);
}

function update_sanpham($masanpham, $tensanpham, $giasanpham, $motasanpham, $luotxemsanpham, $danhmucsanpham, $soluongsanpham)
{
    $sql = "UPDATE `duanmau`.`sanpham` SET `name` = '$tensanpham', `price` = $giasanpham, `mota` = '$motasanpham', `luotxem` = $luotxemsanpham, `iddm` = $danhmucsanpham, `soluong` = $soluongsanpham WHERE `id` = $masanpham;";
    pdo_execute($sql);
}

function delete_sanpham_check($_id)
{
    $sqlId = join(' OR ', array_map(function ($id) {
        return '`id` =' . $id;
    }, $_id));
    foreach ($_id as $id) {
        $img = get_img_sanpham($id);
        $img = 'sanpham/img/' . $img;
        unlink($img);
    }

    $sql = "DELETE FROM `duanmau`.`sanpham` WHERE $sqlId;";
    pdo_execute($sql);
}

function load_sanpham($id)
{
    $sql = "SELECT * FROM sanpham WHERE sanpham.id = $id";
    $sp = pdo_query_one($sql);
    return $sp;
}

function get_listsanpham_loai($id ,$iddanhmuc) {
    $sql = "SELECT sanpham.id, sanpham.`name` FROM sanpham 
    WHERE sanpham.iddm = $iddanhmuc AND sanpham.id != $id";
    $listsp = pdo_query($sql);
    return $listsp;
}

function get_listsanpham_name($kyw) {
    $sql = "SELECT * FROM sanpham WHERE sanpham.`name` LIKE '%$kyw%'";
    $listsp = pdo_query($sql);
    return $listsp;
}

function get_soluongsp($id) {
    $sql = "SELECT sanpham.soluong FROM sanpham WHERE sanpham.id = $id";
    return pdo_query_one($sql)['soluong'];
}

function get_top10_luotxem() {
    $sql = "SELECT sanpham.`name`, sanpham.luotxem FROM sanpham ORDER BY sanpham.luotxem DESC LIMIT 10";
    return pdo_query($sql);
}

function get_top10_banchay() {
    $sql = "SELECT sanpham.`name` ,SUM(donhangct.soluong) as soluong FROM donhangct 
    INNER JOIN sanpham ON donhangct.idsp = sanpham.id GROUP BY donhangct.idsp 
    ORDER BY soluong DESC ";
    return pdo_query($sql);
}

function get_soluong($id) {
    $sql = "SELECT sanpham.soluong FROM sanpham WHERE `id` = $id";
    $soluong = pdo_query_one($sql)['soluong'];
    return $soluong;
}
