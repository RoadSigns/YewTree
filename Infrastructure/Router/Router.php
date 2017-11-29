<?php

    namespace YewTree\Infrastructure\Router;

    use YewTree\Core\Contracts\IRouter;
    use YewTree\Infrastructure\ProductRepository\FakeProductRespository\FakeProductRespository;
    use YewTree\Website\Controllers\HomeController;
    use YewTree\Website\Controllers\ProductController;

    class Router implements IRouter
    {
        public $router;

        public function __construct(RouterEngine $router)
        {
            $this->router = $router;
            $this->router->setBasePath(BASEPATH);

            $this->generateRoutes();
        }

        public function generateRoutes()
        {
            $this->router->map('GET', '/', function(){
                 $tmp = new HomeController(new FakeProductRespository());
                 $tmp->showView();
            });

            $this->router->map('GET', '/products/', function(){
                $tmp = new ProductController(new FakeProductRespository());
                $tmp->showView();
            });

            $this->router->map('GET', '/product/[i:id]/', function($id){
                $tmp = new ProductController(new FakeProductRespository());
                $tmp->showView($id);
            });

            $this->router->map('GET', '/category/', function(){
               echo "Hello World";
            });

//            $this->router->map('GET', '/[a:controller]/[a:method]/[i:id]/', function($controller, $method, $id){
//                echo $controller . " " . $method . " " . $id;
//            });
        }

        public function getController()
        {
            $match = $this->router->match();

            if( $match && is_callable( $match['target'] ) ) {
                call_user_func_array( $match['target'], $match['params'] );
            } else {
                // no route was matched
                header('Location: '. BASEPATH);
                exit();
            }
        }

    }