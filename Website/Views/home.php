<?php
    require ('Website/Views/Partials/Navigation.php');
?>
<div class="container">
    <h2>Last Updated</h2>
    <div class="row">
        <?php foreach ($lastUpdatedProducts as $product) { ?>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <?php require('Website/Views/Partials/Product-Card.php'); ?>
            </div>
        <?php } ?>
    </div>

    <hr/>
    <a href="<?= BASEPATH ?>/categories/electronics/">
        <h2>Electronics</h2>
    </a>
    <div class="row">
        <?php if ($electronicProducts) {
            foreach ($electronicProducts as $product) { ?>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <?php require('Website/Views/Partials/Product-Card.php'); ?>
                </div>
            <?php }
            } else { ?>
            <div class="card-category col-sm-12 col-md-12 col-lg-12">
                <a href="<?= BASEPATH ?>/categories/">
                    <div class="card orange-gradient lighten-1 text-center z-depth-2">
                        <div class="card-body">
                            <p class="white-text mb-0">Sorry no products match this Category</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

    <hr/>
    <a href="<?= BASEPATH ?>/categories/fruit/">
        <h2>Fruit</h2>
    </a>
    <div class="row">
        <?php if ($fruitProducts) {
            foreach ($fruitProducts as $product) { ?>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <?php require('Website/Views/Partials/Product-Card.php'); ?>
                </div>
            <?php }
        } else { ?>
            <div class="card-category col-sm-12 col-md-12 col-lg-12">
                <a href="<?= BASEPATH ?>/categories/">
                    <div class="card orange-gradient lighten-1 text-center z-depth-2">
                        <div class="card-body">
                            <p class="white-text mb-0">Sorry no products match this Category</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<?php
    require ('Website/Views/Partials/Footer.php');
?>