<?php
    if (isset($product) && isset($categories)) {
        $productName = (isset($_GET['name']))        ? $_GET['name']  : $product->name;
        $price       = (isset($_GET['price']))       ? $_GET['price'] : $product->price;
        $description = (isset($_GET['description'])) ? $_GET['description'] : $product->description;
    } else {
        header('Location' . BASEPATH . '/admin/');
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
                            <form role="form" method="post" action="" enctype="multipart/form-data">
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
                                    <div class="md-form">
                                        <textarea type="text" id="description" class="md-textarea" name="description"><?= $description ?></textarea>
                                        <label for="description">Description</label>
                                    </div>
                                </div>
                                <div class="file-field">
                                    <div class="btn orange-gradient btn-sm">
                                        <label for="thumbnail">Upload Thumbnail</label>
                                        <input type="file" name="thumbnail" id="thumbnail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Categories</label>
                                    <?php foreach ($categories as $category) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                    name="categories[<?= $category->id ?>]"
                                                    type="checkbox"
                                                    value="<?= $category->id ?>"
                                                    <?= (in_array($category->category, $product->categories)) ? "checked" : "" ?>
                                            > <?= $category->category ?>
                                        </label>
                                    </div>
                                    <?php } ?>
                                </div>
                                <input value="<?= $product->id ?>" name="id" type="hidden">
                                <button type="submit" class="btn orange-gradient">Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


