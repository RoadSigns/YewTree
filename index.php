<?php

    // Required for Start up
    require ('bootstrap/config.php'    );
    require ('bootstrap/autoloader.php');

    // Debugging Tools
    require ('bootstrap/debug.php');

    // Calling in Classes required
    use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPDO;
    use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPdoProductRepository;
    use YewTree\Website\Website;

    // Router
    use YewTree\Website\Services\Router\Url;
    use YewTree\Website\Services\Router\RouterEngine;
    use YewTree\Website\Services\Router\Router;

    // Repository connection
    $myPdoConnection = new MyPDO();
    $repository      = new MyPdoProductRepository($myPdoConnection);

    // Router
    $urlParser    = new Url();
    $routerEngine = new RouterEngine();
    $router       = new Router($routerEngine);

    // Create a Website Class
    $website = new Website($repository, $router);

    // Display the Page
    $website->display();

    echo "<hr/>";

    $variables = array(
      $_SERVER,
      $router,
      $website,
      $repository
    );

    foreach ($variables as $variable) {
        dumpr($variable);
    }
