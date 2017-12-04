<?php

    namespace YewTree\Website;

        use YewTree\Core\Contracts\ICategoryRepository;
        use YewTree\Core\Contracts\IProductRepository;
        use YewTree\Core\Contracts\IRouter;

        class Website
        {
            private $productRepository;
            private $categoryRepository;
            private $router;

            public function __construct(
                IProductRepository  $productRepository,
                ICategoryRepository $categoryRepository,
                IRouter $router
            )
            {
                // Assigning Repositories
                $this->productRepository  = $productRepository;
                $this->categoryRepository = $categoryRepository;

                // Assigning Router
                $this->router = $router;
            }

            public function display()
            {
                $this->router->getController();
            }
        }