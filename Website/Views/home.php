<?php
?>

  <h1><?= $product->name ?>Hello World</h1>

<?php
    foreach($products as $product) {
        echo "<h1> $product->name </h1>";
    }

