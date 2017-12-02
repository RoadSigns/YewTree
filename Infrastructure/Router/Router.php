<?php

    namespace YewTree\Infrastructure\Router;

        use YewTree\Core\Contracts\IRouter;
        use YewTree\Infrastructure\ProductRepository\FakeProductRespository\FakeProductRespository;
        use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPDO;
        use YewTree\Infrastructure\ProductRepository\MyPdoProductRepository\MyPdoProductRepository;
        use YewTree\Website\Controllers\AdministrationController;
        use YewTree\Website\Controllers\HomeController;
        use YewTree\Website\Controllers\ProductController;

        class Router implements IRouter
        {
            public $router;

            public function __construct(RouterEngine $router)
            {
                $this->router = $router;
                $this->router->setBasePath('/webstudent/sem6zl/yewtree');

                $this->generateRoutes();
            }

            public function generateRoutes()
            {
                $this->router->map('GET', '/', function(){
                    $tmp = new HomeController(new FakeProductRespository());
                    $tmp->showView();
                });

                $this->router->map('GET', '/products/', function(){
                    $tmpPdo = new MyPDO();
                    $tmp    = new ProductController(new MyPdoProductRepository($tmpPdo));
                    $tmp->showView();
                });

                $this->router->map('POST', '/products/', function(){
                    $tmpPdo = new MyPDO();
                    $tmp    = new ProductController(new MyPdoProductRepository($tmpPdo));
                    $tmp->postView();
                });

                $this->router->map('GET', '/admin/create/', function(){
                    $tmpPdo = new MyPDO();
                    $tmp    = new AdministrationController(new MyPdoProductRepository($tmpPdo));
                    $tmp->getCreate();
                });

                $this->router->map('POST', '/admin/create/', function(){
                    $tmpPdo = new MyPDO();
                    $tmp    = new AdministrationController(new MyPdoProductRepository($tmpPdo));
                    $tmp->postCreate();
                });

                $this->router->map('GET', '/admin/edit/[i:id]/', function($uriName){
                    $tmpPdo = new MyPDO();
                    $tmp    = new AdministrationController(new MyPdoProductRepository($tmpPdo));
                    $tmp->getEdit($uriName);
                });

                $this->router->map('POST', '/admin/edit/[i:id]/', function($id){
                    $tmpPdo = new MyPDO();
                    $tmp    = new AdministrationController(new MyPdoProductRepository($tmpPdo));
                    $tmp->postEdit($id);
                });

                $this->router->map('GET', '/admin/enable/[i:id]/', function($id){
                    $tmp    = new AdministrationController(new MyPdoProductRepository(new MyPDO()));
                    $tmp->getEnable($id);
                });

                $this->router->map('GET', '/admin/disable/[i:id]/', function($id){
                    $tmp    = new AdministrationController(new MyPdoProductRepository(new MyPDO()));
                    $tmp->getDisable($id);
                });

                $this->router->map('GET', '/product/[i:id]/', function($id){
                    $tmp = new ProductController(new FakeProductRespository());
                    $tmp->showView($id);
                });

                $this->router->map('GET', '/category/', function(){
                    echo "Hello World";
                });

                $this->router->map('GET', '/admin/', function(){
                    $tmp = new AdministrationController(new MyPdoProductRepository(new MyPDO()));
                    $tmp->showView();
                });

                $this->router->map('GET', '/[a:controller]/[a:method]/[i:id]/', function($controller, $method, $id){
                    echo $controller . " " . $method . " " . $id;
                    echo "<form method='post' action=''><input value='' name='test' type='text'/><button></button></form>";
                });

                $this->router->map('POST', '/[a:controller]/[a:method]/[i:id]/', function($controller, $method, $id){
                    dumpr($_POST);
                });
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

        }