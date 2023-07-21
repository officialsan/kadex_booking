<?php 
$head = '<link href="'.APP_URL.'/assets/css/detail-page.css" rel="stylesheet">';
require_once 'includes/header.php'; 
?>
<main>
    <div class="hero_in detail_page background-image bgtheme" data-background="url(<?= APP_URL; ?>/assets/img/hero_5.svg)">
        <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <!-- <div class="container">
                <div class="main_info">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6">
                            <div class="head">

                            </div>
                            <h1>Pizzeria da Alfredo</h1>
                            ITALIAN - 27 Old Gloucester St, 4530 -

                        </div>
                    </div>
                    
                </div>
            </div> -->
        </div>
    </div>
    <!--/hero_in-->
    <!-- /secondary_nav -->
    <div class="bg_gray">
        <div class="container margin_detail">
            <div class="row">
                <div class="col-lg-8 list_menu">
                    <section id="section-1">
                        <h4>
                            <?= $service->service ?>
                        </h4>
                        <div class="row">
                            <?php foreach($products as $product) { ?>
                            <div class="col-md-6">
                                <div class="menu_item pr-20 " href="<?= APP_URL ?>/modal-product/<?= $product['id'] ?>" data-id="<?= $product['id']; ?>"
                                    data-task="<?= $product['tasks'] ?>">
                                    <!-- <figure>
                                            <img src="<?= APP_URL; ?>/assets/img/menu-thumb-placeholder.jpg" data-src="<?= APP_URL; ?>/assets/img/menu-thumb-1.jpg" alt="thumb"
                                                class="lazy">
                                        </figure> -->
                                    <h3>
                                        <?= $product['product']; ?>
                                    </h3>
                                    <p>
                                        <?= $product['tasks'];?>
                                    </p>
                                    <div class="" style="margin-bottom: 75px;">
                                        <h4 class="float-left">
                                            <?= CURRENCY. " ".  $product['price'];?>
                                        </h4>
                                        <div class="numbers-row">
                                            <input type="text" value="1" class="qty2 form-control quantity-<?= $product['id']; ?>" name="quantity">
                                        </div>
                                    </div>
                                    <p class="text-right">
                                        <button class="btn_1 gradient  san-add-to-cart" href="<?= APP_URL ?>/modal-product/<?= $product['id'] ?>" value="<?= $product['id']; ?>">Add to cart</button>
                                        <!-- <strong></strong> -->
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <!-- /row -->
                    </section>
                </div>
                <!-- /col -->
                <div class="col-lg-4  " id="sidebar_fixed">
                    <?php view('cart'); ?>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->
    <!-- /container -->
</main>
<?php include 'includes/footer.php';?>
<script>
</script>
</body>

</html>