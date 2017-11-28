<?php

    // Required for Start up
    require ('bootstrap/config.php'    );
    require ('bootstrap/autoloader.php');

    // Debugging Tools
    require ('bootstrap/debug.php');

    // Calling in Classes required
    use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPDO;
    use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPdoProductRepository;

    // Helpers
    use YewTree\Website\Services\Url;
    use YewTree\Website\Services\FormValidator;

    // Database connection
    $myPdoConnection    = new MyPDO();
    $databaseConnection = new MyPdoProductRepository($myPdoConnection);

    // Url Parser
    $urlParser = new Url();

    // Form Validation
    $formValidator = new FormValidator();


    if (count($urlParser->urlArray) > 0) {
        if ($urlParser->getFirstElement() == 'product') {
            if (count($urlParser->urlArray) >= 1) {
                echo "Product: " . $urlParser->urlArray[1];
            } else {
                echo "List Products";
            }

        } elseif ($urlParser->getFirstElement() == 'category') {
            if (count($urlParser->urlArray) >= 1) {
                echo "Category: " . $urlParser->urlArray[1];
            } else {
                echo "List Categories";
            }
        } else {
            header('Location :' . $_SERVER['DOCUMENT_ROOT']);
        }
    } else {
        echo "Homepage";
    }








    dumpr($databaseConnection);
    dumpr($urlParser);
    dumpr($urlParser->urlArray);