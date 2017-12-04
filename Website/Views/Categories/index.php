<?php
    require('Website/Views/Partials/Navigation.php');
?>
<!-- Page Content -->
<br/>
<div class="container">

    <h1>Categories</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <?php foreach($categories as $category) { ?>
                    <div class="card-category col-sm-6 col-md-5 col-lg-5">
                        <a href="<?= BASEPATH ?>/categories/<?=$category->category?>/">
                            <div class="card orange-gradient lighten-1 text-center z-depth-2">
                                <div class="card-body">
                                    <p class="white-text mb-0"><?= $category->category ?></p>
                                </div>
                            </div>
                        </a>
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