<?php

    namespace YewTree\Infrastructure\Router;

        use YewTree\Core\Contracts\ICategoryRepository;
        use YewTree\Core\Contracts\IProductRepository;
        use YewTree\Core\Contracts\IRouter;

        use YewTree\Infrastructure\Services\MyPDO;

        use YewTree\Infrastructure\ProductRepository\FakeProductRespository\FakeProductRespository;
        use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPdoProductRepository;
        use YewTree\Infrastructure\CategoryRepository\MyPdoCategoryRepository\MyPdoCategoryRepository;

        use YewTree\Website\Controllers\AdministrationController;
        use YewTree\Website\Controllers\AdministrationProductController;
        use YewTree\Website\Controllers\AdministrationCategoryController;
        use YewTree\Website\Controllers\HomeController;
        use YewTree\Website\Controllers\ProductController;
        use YewTree\Website\Controllers\CategoryController;

        class Router implements IRouter
        {
            public $router;

            private $myPdo;

            private $productController;
            private $categoryController;

            private $administrationController;
            private $administrationCategoryController;
            private $administrationProductController;

            public function __construct(RouterEngine $router)
            {
                $this->router = $router;
                $this->router->setBasePath(BASEPATH);

                $this->_generateControllers();

                $this->generateRoutes();
            }

            public function generateRoutes()
            {
                $this->router->map('GET', '/', function(){
                    $tmp = new HomeController(new FakeProductRespository());
                    $tmp->showView();
                });

                $this->router->map('GET', '/admin/', function(){
                    $this->administrationController->showView();
                });


                $this->_generateProductsRoutes();

                $this->_generateCategoryRoutes();

                $this->_generateAdministrationProductRoutes();

                $this->_generateAdministrationCategoryRoutes();


            }

            public function getController()
            {
                $match = $this->router->match();

                if( $match && is_callable( $match['target'] ) ) {
                    call_user_func_array( $match['target'], $match['params'] );
                } else {
                    // no route was matched
                    header('Location: '. BASEPATH .'/');
                    exit();
                }
            }

            private function _generateProductsRoutes()
            {
                $this->router->map('GET', '/products/', function () {
                    $tmpPdo = new MyPDO();
                    $tmp = new ProductController(new MyPdoProductRepository($tmpPdo));
                    $tmp->showView();
                });

                $this->router->map('POST', '/products/', function () {
                    $tmpPdo = new MyPDO();
                    $tmp = new ProductController(new MyPdoProductRepository($tmpPdo));
                    $tmp->postView();
                });


                $this->router->map('GET', '/product/[i:id]/', function ($id) {
                    $tmp = new ProductController(new FakeProductRespository());
                    $tmp->showView($id);
                });
            }

            private function _generateCategoryRoutes()
            {
                // TODO Create Routes for Categories
            }

            private function _generateAdministrationProductRoutes()
            {
                $this->router->map('GET', '/admin/product/create/', function () {
                    $this->administrationProductController->getCreate();
                });

                $this->router->map('POST', '/admin/product/create/', function () {
                    $this->administrationProductController->postCreate();
                });

                $this->router->map('GET', '/admin/product/edit/[i:id]/', function ($uriName) {
                    $this->administrationProductController->getEdit($uriName);
                });

                $this->router->map('POST', '/admin/product/edit/[i:id]/', function ($id) {
                    $this->administrationProductController->postEdit($id);
                });

                $this->router->map('GET', '/admin/product/enable/[i:id]/', function ($id) {
                    $this->administrationProductController->getEnable($id);
                });

                $this->router->map('GET', '/admin/product/disable/[i:id]/', function ($id) {
                    $this->administrationProductController->getDisable($id);
                });
            }

            private function _generateAdministrationCategoryRoutes()
            {
                $this->router->map('GET', '/admin/category/edit/[i:id]/', function ($id) {
                   $this->administrationCategoryController->getEdit($id);
                });

                $this->router->map('POST', '/admin/category/edit/[i:id]/', function ($id) {
                    $this->administrationCategoryController->postEdit($id);
                });

                $this->router->map('GET', '/admin/category/create/', function () {
                    $this->administrationCategoryController->getCreate();
                });

                $this->router->map('POST', '/admin/category/create/', function () {
                    $this->administrationCategoryController->postCreate();
                });


            }

            private function _generateControllers()
            {
                // Building Services
                $myPdo = new MyPDO();

                // Building Repositories
                $ICategoryRepository = new MyPdoCategoryRepository($myPdo);
                $IProductRepository  = new MyPdoProductRepository($myPdo);

                // Building the Controllers
                $this->homeController    = new HomeController($IProductRepository);
                $this->productController = new ProductController($IProductRepository);

                // Building Administration Controllers
                $this->administrationController          = new AdministrationController($IProductRepository, $ICategoryRepository);
                $this->administrationProductController   = new AdministrationProductController($IProductRepository, $ICategoryRepository);
                $this->administrationCategoryController  = new AdministrationCategoryController($IProductRepository, $ICategoryRepository);
            }

        }