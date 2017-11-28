<?php

    namespace YewTree\Core\Contracts;


    interface IProductRepository
    {
        public function getProductById($id);
        public function getAllProducts();
        public function getProductsByCategory($category);
        public function getProductUser();

        public function addProduct();

        public function disableProduct($id);
    }