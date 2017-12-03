<?php

    namespace YewTree\Core\Model;


    class Product
    {
        public $id;
        public $name;
        public $price;
        public $thumbnail;
        public $uriName;

        public $postedDate;
        public $updatedDate;

        public $categories;

        public function __construct($product, $categories)
        {
            $this->id         = $product->id;
            $this->name       = $product->name;
            $this->price      = $product->price;
            $this->thumbnail  = $product->thumbnail;
            $this->uriName    = $product->uriName;

            $this->postedDate  = $product->postedDate;
            $this->lastUpdated = $product->lastUpdated;

            $this->disabled = $product->disabled;

            $this->categories = array();
            $this->_buildCategories($categories);
        }

        private function _buildCategories($categories)
        {
            foreach ($categories as $category) {
                $this->categories[] = $category->categoryID;
            }
        }
    }