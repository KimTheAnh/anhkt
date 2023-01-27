<?php 
    $listNavbar = array(
        [
            'link' => "index.php?",
            'name' => "Trang chủ",
            'actLink' => "",
        ],
        [
            'link' => "index.php?",
            'name' => "Giới thiệu",
            'actLink' => "act=gioithieu",
        ],
        [
            'link' => "index.php?",
            'name' => "Liên hệ",
            'actLink' => 'act=lienhe',
        ],
        [
            'link' => "index.php?",
            'name' => "Góp ý",
            'actLink' => 'act=gopy',
        ],
        [
            'link' => "index.php?",
            'name' => "Hỏi đáp",
            'actLink' => 'act=hoidap',
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