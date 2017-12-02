<?php
    if (!isset($category)) {
        header('Location' . BASEPATH . '/admin/');
    }
?>
<body>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Category</h1>
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
                                    <label for="product">Category Name</label>
                                    <input name='category' class="form-control" type="text" placeholder="Category Name" value="<?= $category->category ?>"  id="category" required>
                                </div>
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

