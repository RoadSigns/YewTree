<?php
    echo "<a href='" . BASEPATH . "/admin/create/'><button class='btn btn-success'>Create New Product</button></a>";
?>
<hr/>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Striped Rows
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Product Name</th>
                            <th>Price (£)</th>
                            <th>Posted Date</th>
                            <th>URI Name</th>
                            <th>Edit</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (isset($products)) {
                                    foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?= $product->id ?></td>
                                            <td><?= $product->thumbnail ?></td>
                                            <td><?= $product->name?></td>
                                            <td><?= $product->price?></td>
                                            <td><?= $product->postedDate?></td>
                                            <td><?= $product->uriName?></td>
                                            <td><a href='<?= BASEPATH ?>/admin/edit/<?= $product->id ?>/'><button class="btn btn-warning">Edit</button></a></td>
                                            <?php
                                                echo ($product->disabled)
                                                    ? "<td><a href='". BASEPATH ."/admin/enable/{$product->id}/'><button class='btn btn-success'>Enable</button></a></td>"
                                                    : "<td><a href='". BASEPATH ."/admin/disable/{$product->id}/'><button class='btn btn-danger'>Disable</button></a></td>";
                                            ?>
                                        </tr>
                                    <?php }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

<?php