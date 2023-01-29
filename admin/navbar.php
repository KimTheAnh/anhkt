
<?php 
    $listNavbar = array(
        [
            'link' => "index.php?",
            'name' => "Trang chủ",
            'actLink' => "",
        ],
        [
            'link' => "index.php?",
            'name' => "Loại hàng",
            'actLink' => "act=adddm",
        ],
        [
            'link' => "index.php?",
            'name' => "Hàng hoá",
            'actLink' => 'act=addsp',
        ],
        [
            'link' => "index.php?",
            'name' => "Khách hàng",
            'actLink' => 'act=dskh',
        ],
        [
            'link' => "index.php?",
            'name' => "Bình luận",
            'actLink' => 'act=binhluan',
        ],
        [
            'link' => "index.php?",
            'name' => "Thống kê",
            'actLink' => 'act=thongke',
        ],
      );
?>

<nav>
    <ul class="navbar-list">
        <?php foreach ($listNavbar as $nb) : ?>
            <?php extract($nb) ?>
            <a href="<?= $link . $actLink ?>" class="navbar-item <?php 
            if (!isset($act) && $actLink == "") {
                echo "here";
            } else if (isset($act ) && strpos($actLink, $act)) {
                echo "here";
            }
                
            ?>"><?= $name ?></a>
        <?php endforeach; ?>
    </ul>
</nav>