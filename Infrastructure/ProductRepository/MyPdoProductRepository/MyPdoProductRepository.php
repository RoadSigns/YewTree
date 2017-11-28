<?php

    namespace YewTree\Infrastructure\ProductRepository\MyPdoProductRepository;

    use YewTree\Core\Contracts\IProductRepository;

    class MyPdoProductRepository implements IProductRepository
    {
        private $link;
        public function __construct(MyPDO $link)
        {
            $this->link = $link;
        }

        public function getAllProducts()
        {
            // TODO: Implement getAllProducts() method.
        }

        public function getProductById($id)
        {
            // TODO: Implement getProductById() method.
        }


        public function getProductsByCategory($category)
        {
            // TODO: Implement getProductsByCategory() method.
        }

        public function getProductUser()
        {
            // TODO: Implement getProductUser() method.
        }

        public function addProduct()
        {
            // TODO: Implement addProduct() method.
        }

        public function disableProduct($id)
        {
            // TODO: Implement disableProduct() method.
        }


    }