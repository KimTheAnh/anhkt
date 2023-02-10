<main>
    <div class="row column-3-1">
        <div class="content">
            <div class="home-banner">
                <div class="home-banner_list-btn">
                    <div class="home-banner_btn" onclick="bannerImg(0)">
                        <div class="ti-angle-left"></div>
                    </div>
                    <div class="home-banner_btn" onclick="bannerImg(1)">
                        <div class="ti-angle-right"></div>
                    </div>
                </div>
                <div class="home-banner_list-sl">
                    <div class="home-banner_sl home-banner_sl-x" onclick="sl(0)"></div>
                    <div class="home-banner_sl" onclick="sl(1)"></div>
                    <div class="home-banner_sl" onclick="sl(2)"></div>
                </div>
                <div class="home-banner_list">
                    <div class="home-banner_img" style="background-image: url(img/b53e9bc613d0b6114cc0e4ae1d33bf96_2014940736099744340.png);">
                    </div>
                    <div class="home-banner_img" style="background-image: url(img/Screenshot\ 2023-01-02\ at\ 09.46.20.png);"></div>
                    <div class="home-banner_img" style="background-image: url(img/b53e9bc613d0b6114cc0e4ae1d33bf96_2014940736099744340.png);">
                    </div>
                </div>
            </div>
            <script>
                var bannerImgIndex = 0

                function bannerImg(z) {

                    if (z == 1) {
                        bannerImgIndex++
                        if (bannerImgIndex > 2) bannerImgIndex = 0
                    } else {
                        bannerImgIndex--
                        if (bannerImgIndex < 0) bannerImgIndex = 2
                    }
                    sl(bannerImgIndex)

                }

                var intervalBanner = setInterval(() => {
                    bannerImgIndex++
                    if (bannerImgIndex > 2) bannerImgIndex = 0
                    sl(bannerImgIndex)
                }, 2000)

                function loadBanner(z) {
                    var homeBanner = document.querySelector(".home-banner")
                    var widthBanner = homeBanner.offsetWidth
                    var bannerList = homeBanner.querySelector(".home-banner_list")
                    bannerList.style.transform = `translateX(-${z * widthBanner}px)`
                    clearInterval(intervalBanner)
                    intervalBanner = setInterval(() => {
                        bannerImgIndex++
                        if (bannerImgIndex > 2) bannerImgIndex = 0
                        sl(bannerImgIndex)
                    }, 2000)
                }

                function removeClassAllEle(classEle, className) {
                    var listEle = document.querySelectorAll(`.${classEle}`)
                    listEle.forEach((ele) => {
                        ele.classList.remove(className)
                    })

                    return listEle
                }

                function sl(z) {
                    listEle = removeClassAllEle("home-banner_sl", "home-banner_sl-x")
                    bannerImgIndex = z
                    listEle[z].classList.add("home-banner_sl-x")
                    loadBanner(z)
                }
            </script>
            <div class="home-product-list">
                <?php foreach ($spnew as $sp) : ?>
                    <?php 
                        extract($sp);
                        $imgLink = explode(", ", $img);
                        // echo $imgLink;
                    ?>
                    <div class="home-product-item" onclick="linksp(<?= $id ?>)">
                        <div class="home-product-item_img" style="background-image: url(<?= $imgdir . $id . '/' . $imgLink[0] ?>);">
                        </div>
                        <div class="home-product-item_price">$ <?= $price ?></div>
                        <div class="home-product-item_name"><?= $name ?></div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <?php
        require "view/sidebar.php";
        ?>
    </div>
</main>
<script>
    function linksp(id) {
        window.location = 'index.php?act=spchitiet&id=' + id
    }
</script>