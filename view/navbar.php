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