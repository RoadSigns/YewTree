<?php

    namespace YewTree\Core\Contracts;


    interface IProductRepository
    {
        public function getProductById($id);
        public function getProductByName($name);
        public function getAllProducts();

        public function addProduct();
        public function updateProduct($id);

        public function enableProduct($id);
        public function disableProduct($id);
    }