<?php
    require('Website/Views/Partials/Navigation.php');
?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Categories</h1>
            <div class="list-group">
                <?php foreach($categories as $category) { ?>
                    <a href="<?= BASEPATH ?>/categories/<?= $category->category ?>" class="list-group-item"><?= $category->category ?></a>
                <?php } ?>
            </div>

            <h1 class="my-4">Filters</h1>
            <div class="list-group">
                <a href="" class="list-group-item">Test</a>
            </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <div class="row">
                <?php foreach ($products as $product) { ?>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <?php require('Website/Views/Partials/Product-Card.php'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /.col-lg-9 -->
    </div>

</div>
<!-- /.container -->
<?php
    require ('Website/Views/Partials/Footer.php');
?>