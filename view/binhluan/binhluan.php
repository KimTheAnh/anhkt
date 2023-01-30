<?php
include "../../global.php";
include "../../model/binhluan.php";
include "../../model/pdo.php";
session_start();
$idpro = $_REQUEST['idpro'];
$listbinhluan = get_binhluan($idpro);
if (isset($_POST['gui'])) {
    $noidung = $_POST['ndbinhluan'];
    $idpro = $_POST['idpro'];
    $iduser = $_SESSION['user']['id'];
    $date = getdate();
    $ngay = $date['mday'];
    $thang = $date['wday'];
    $nam = $date['year'];
    $ngaybinhluan = "$ngay/$thang/$nam";
    add_binhluan($noidung, $iduser, $idpro, $ngaybinhluan);
    header("Location:" . $_SERVER['HTTP_REFERER']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <title>Document</title>
</head>

<body>

    <div class="box-sanphamct_header">
        BÌNH LUẬN
    </div>
    <ul class="box-sanphamct_main">
        <?php foreach ($listbinhluan as $binhluan) : ?>
            <?php extract($binhluan) ?>
            <li class="box-sanphamct_item">
                <div class="sanphamct_trai"><?= $noidung ?></div>
                <div class="sanphamct_phai">
                    <div class="sanphamct_user"><?= $user ?>,&nbsp</div>
                    <div class="sanphamct_day"><?= $ngaybinhluan ?></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php if (!isset($_SESSION['user'])) { ?>
        <div class="box-sanphamct_tb">
            Đăng nhập để bình luận về sản phẩm này
        </div>
    <?php } else { ?>
        <div class="binhluan-input">
            <form action="view/binhluan/binhluan.php" method="post">
                <input type="text" name="ndbinhluan" placeholder="Viết bình luận">
                <input type="hidden" name="idpro" value="<?= $idpro ?>">
                <input type="submit" value="Gửi" name="gui">
            </form>
        </div>
    <?php } ?>


</body>

</html>