<?php
    session_start();

    // Required for Start up
    require ('bootstrap/config.php'    );
    require ('bootstrap/autoloader.php');

    // Debugging Tools
    require ('bootstrap/debug.php');

    // Global Styles
    require ('bootstrap/style.php');

    // Calling in Classes required
    use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPDO;
    use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPdoProductRepository;
    use YewTree\Website\Website;

    // Router
    use YewTree\Infrastructure\Router\RouterEngine;
    use YewTree\Infrastructure\Router\Router;

    // Repository connection
    $myPdoConnection = new MyPDO();
    $repository      = new MyPdoProductRepository($myPdoConnection);

    // Router
    $routerEngine = new RouterEngine();
    $router       = new Router($routerEngine);

    // Create a Website Class
    $website = new Website($repository, $router);

    // Display the Page
    $website->display();