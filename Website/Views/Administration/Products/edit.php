<?php
    if (isset($product) && isset($categories)) {
        $productName = (isset($_GET['name']))  ? $_GET['name']  : $product->name;
        $price       = (isset($_GET['price'])) ? $_GET['price'] : $product->price;
    } else {
        header('Location' . BASEPATH . '/admin/');
    }

    if (isset($_POST)) {
        dumpr($_POST);
    }
?>
<body>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Product</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" action="">
                                <div class="form-group">
                                    <label for="product">Product Name</label>
                                    <input name='name' class="form-control" type="text" placeholder="Product Name" value="<?= $productName ?>"  id="product" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Amount (in GBP)</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">£</div>
                                        <input name='price' type="text" class="form-control" id="price" placeholder="Amount" value="<?= $price ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Categories</label>
                                    <?php foreach ($categories as $category) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <input name="categories[<?= $category->id ?>]" type="checkbox" value="<?= $category->id ?>"><?= $category->category ?>
                                        </label>
                                    </div>
                                    <?php } ?>
                                </div>
                                <input value="<?= $product->id ?>" name="id" type="hidden">
                                <button type="submit" class="btn btn-default">Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


