<?php
    require ('Website/Views/Partials/Navigation.php');
?>
<div class="container">
    <h2>Last Updated</h2>
    <div class="row">
        <?php
            foreach ($lastUpdatedProducts as $product) {
                require('Website/Views/Partials/Product-Card.php');
            }
        ?>
    </div>

    <hr/>
    <a href="<?= BASEPATH ?>/category/electronics/">
        <h2>Electronics</h2>
    </a>
    <div class="row">
        <?php
            foreach ($electronicProducts as $product) {
                require('Website/Views/Partials/Product-Card.php');
            }
        ?>
    </div>

    <hr/>
    <a href="<?= BASEPATH ?>/category/fruit/">
        <h2>Fruit</h2>
    </a>
    <div class="row">
        <?php
            foreach ($fruitProducts as $product) {
                require('Website/Views/Partials/Product-Card.php');
            }
        ?>
    </div>
</div>
