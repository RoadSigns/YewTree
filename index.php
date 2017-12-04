<?php
    session_start();

    // Required for Start up
    require ('bootstrap/config.php'    );
    require ('bootstrap/autoloader.php');

    // Debugging Tools
    require ('bootstrap/debug.php');

    // Global Styles
    require ('bootstrap/style.php');

    // Services
    use YewTree\Infrastructure\Services\MyPDO;

    // Repositories
    use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPdoProductRepository;
    use YewTree\Infrastructure\CategoryRepository\MyPdoCategoryRepository\MyPdoCategoryRepository;

    // Router
    use YewTree\Infrastructure\Router\RouterEngine;
    use YewTree\Infrastructure\Router\Router;

    // Website
    use YewTree\Website\Website;

    // Calling Services
    $myPdoConnection = new MyPDO();

    // Repository connection
    $productRepository = new MyPdoProductRepository($myPdoConnection);
    $categoryRepository = new MyPdoCategoryRepository($myPdoConnection);

    // Router
    $routerEngine = new RouterEngine();
    $router       = new Router($routerEngine);

    // Create a Website Class
    $website = new Website($productRepository, $categoryRepository, $router);

    // Display the Page
    $website->display();