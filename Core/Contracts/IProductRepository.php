<?php

    namespace YewTree\Core\Contracts;


    interface IProductRepository
    {
        public function getProductById($id);
        public function getProductByName($name);
        public function getAllProducts();
        public function getProductsByCategory($category);

        public function addProduct();

        public function updateProduct();

        public function disableProduct($id);
    }