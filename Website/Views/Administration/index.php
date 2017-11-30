<?php
    dumpr($products);
    foreach($products as $product) {
        echo "<h1> $product->name </h1>";
        echo "<a href='/yewtree/admin/edit/".$product->uriName."/'><button>Edit</button></a>";
        echo "<a href='/yewtree/admin/disable/".$product->uriName."/'><button>Disable</button></a>";
    }

    echo $_SERVER['REQUEST_URI'];
?>
