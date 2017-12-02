<?php

    namespace YewTree\Core\Contracts;

    interface ICategoryRepository
    {
        public function getAllCategories();
        public function getCategoryById($id);
        public function getCategoryByName($name);

        public function addCategory();
        public function updateCategory($id);
        public function removeCategory($id);
    }