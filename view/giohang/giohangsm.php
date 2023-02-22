<?php
require "../../global.php";
session_start();
$cart = $_SESSION['cart'];
// dd($cart);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if(empty($cart)) { ?>
        <div class="giohang-empty">Không có sản phẩm</div>
    <?php } else { ?>
        <div class="giohang-title">Sản phẩm trong giỏ</div>
        <?php foreach ($cart as $item) : ?>
            <?php 
                extract($item);
                $linkImg = explode(', ', $img); 
            ?>
            <div class="giohang-item">
                <div class="giohang-item-img" style="background-image: url(<?= $imgdir.$id.'/'.$linkImg[0] ?>);"></div>
                <div class="giohang-item-name"><?= $name ?></div>
                <div class="giohang-item-price"><?= $price ?> VNĐ</div>
            </div>
        <?php endforeach; ?>
    <?php }; ?>
</body>

</html>