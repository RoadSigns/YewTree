<?php

    namespace YewTree\Website;

        use YewTree\Core\Contracts\IProductRepository;
        use YewTree\Core\Contracts\IRouter;

        class Website
        {
            private $repository;
            private $router;

            public function __construct(IProductRepository $repository, IRouter $router)
            {
                $this->repository = $repository;
                $this->router     = $router;
            }

            public function display()
            {
                $this->router->getController();
            }
        }