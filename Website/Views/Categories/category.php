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
                        <a href="<?= BASEPATH ?>/categories/<?= $category->category ?>" class="orange-text list-group-item"><?= $category->category ?></a>
                    <?php } ?>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">
                <?php if ($products) { ?>
                    <div class="row">
                        <?php foreach ($products as $product) { ?>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <?php require('Website/Views/Partials/Product-Card.php'); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
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
            <!-- /.col-lg-9 -->
        </div>

    </div>
    <!-- /.container -->
<?php
    require ('Website/Views/Partials/Footer.php');
?>