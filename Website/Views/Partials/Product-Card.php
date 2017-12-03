<div class="col-sm-6 col-md-3 col-lg-3">
    <div class="card-product card">

        <!--Card image-->
        <div class="view overlay hm-white-slight">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%287%29.jpg" class="img-fluid" alt="">
            <a href="#">
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
            <a href="#" class="card-btn btn btn-secondary">Button</a>
        </div>
    </div>
</div>