
<div class="card-product card">

    <!--Card image-->
    <div class="view overlay hm-white-slight">
        <img src="http://learn.cf.ac.uk/webstudent/sem6zl/yewtree/Website/Images/<?=$product->thumbnail?>" class="img-fluid" alt="">
        <a href="<?= BASEPATH ?>/products/<?= $product->uriName ?>/">
            <div class="mask"></div>
        </a>
    </div>

    <!--Card content-->
    <div class="card-body">
        <!--Title-->
        <h4 class="card-title"><?= $product->name ?></h4>
        <!--Text-->
        <p class="card-text"><?= $product->previewDescription(50) ?></p>
        <p class="card-text">£ <?= $product->price ?></p>
        <p class="card-text"><small class="text-muted"><?= date("F j, Y, g:i a", strtotime($product->lastUpdated)) ?></small></p>
        <a href="<?= BASEPATH ?>/products/<?= $product->uriName ?>/" class="card-btn btn orange-gradient">Button</a>
    </div>
</div>