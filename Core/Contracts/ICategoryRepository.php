<?php

    namespace YewTree\Core\Contracts;

    interface ICategoryRepository
    {
        public function getAllCategories();
        public function getCategoryById();
        public function getCategoryByName();

        public function addCategory();
        public function updateCategory();
        public function removeCategory();
    }