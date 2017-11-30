<?php
    foreach($products as $product) {
        echo "<h1> $product->name </h1>";
    }

    echo $_SERVER['REQUEST_URI'];
?>

<form action="" method="post">
    <button>Submit</button>
</form>
