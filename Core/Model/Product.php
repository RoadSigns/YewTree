<?php

    namespace YewTree\Core\Model;

    use DateTime;

    /**
     * Class Product
     * @package YewTree\Core\Model
     */
    class Product
    {
        public $id;
        public $name;
        public $price;
        public $description;
        public $thumbnail;
        public $uriName;

        public $postedDate;
        public $lastUpdated;

        public $disabled;

        public $categories;

        public function __construct($product, $categories)
        {
            $this->id          = $product->id;
            $this->name        = $product->name;
            $this->price       = $product->price;
            $this->description = $product->description;

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
                if (!$category->categoryID == null) {
                    $this->categories[] = $category->categoryID;
                }
            }
        }

        public function previewDescription($length = 30)
        {
            $preview  = substr($this->description, 0, $length);
            $preview .= "...";
            return $preview;
        }
    }