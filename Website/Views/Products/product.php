<?php
    require('Website/Views/Partials/Navigation.php');
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-9">
            <div class="card mt-4">
                <img class="card-img-top img-fluid" src="http://learn.cf.ac.uk/webstudent/sem6zl/yewtree/Website/Images/<?=$product->thumbnail?>" alt="">
                <div class="card-body">
                    <h3 class="card-title"><?= $product->name ?></h3>
                    <h4>£<?= $product->price ?></h4>
                    <p class="card-text"><?= $product->description ?></p>
                </div>
            </div>
        </div>
        <!-- /.col-lg-9 -->

        <div class="col-lg-3">
            <h1 class="my-4"><?= $product->name?> Categories</h1>
            <div class="list-group">
                <?php foreach($product->categories as $category) { ?>
                <a href="<?= BASEPATH ?>/categories/<?= $category ?>" class="list-group-item"><?= $category ?></a>
                <?php } ?>
            </div>
        </div>
        <!-- /.col-lg-3 -->

    </div>

</div>
<!-- /.container -->
<?php
    require ('Website/Views/Partials/Footer.php');
?>