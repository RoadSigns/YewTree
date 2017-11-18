<?php
    define('PROJECTNAME', 'YewTree');
    require ('bootstrap/autoloader.php');


    use YewTree\Test;

    $test = new Test();

    echo $test->sayHello('Zack');

    echo "<hr/>";

    echo $test->whoAmI();