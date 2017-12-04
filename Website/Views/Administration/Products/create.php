<?php
    if (!isset($categories)) {
        header('Location' . BASEPATH . '/admin/');
    }
?>

<body>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create Product</h1>
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
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label class="sr-only">Product Name</label>
                                        <input name='name' class="form-control" type="text" placeholder="Product Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputAmount">Amount (in GBP)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">£</div>
                                            <input name='price' type="text" class="form-control" id="exampleInputAmount" placeholder="Amount" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="md-form">
                                            <textarea type="text" id="description" class="md-textarea" name="description"></textarea>
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
                                                    <input name="categories[<?= $category->id ?>]" type="checkbox" value="<?= $category->id ?>"><?= $category->category ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
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


