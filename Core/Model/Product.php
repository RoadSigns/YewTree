<?php

    namespace YewTree\Core\Model;


    class Product
    {
        public $id;
        public $name;
        public $price;
        public $postedDate;
        public $thumbnail;

        public $productImages;

        public function __construct($id, $name, $price, $postedDate, $thumbnail, $productImages)
        {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->postedDate = $postedDate;
            $this->thumbnail = $thumbnail;

            $this->productImages = array();
            $this->productImages = $productImages;
        }


    }