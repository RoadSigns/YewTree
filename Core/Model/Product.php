<?php

    namespace YewTree\Core\Model;


    class Product
    {
        public $id;
        public $name;
        public $price;
        public $postedDate;
        public $photos;

        /**
         * @var \stdClass
         */
        public $user;

        /**
         * Product constructor.
         * @param      $id
         * @param      $name
         * @param      $price
         * @param User $user
         */
        public function  __construct($id, $name, $price, User $user)
        {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;

            $this->photos = array();
            $this->photos = $this->getPhotos($this->id);
        }

        private function getPhotos($id)
        {
            // return array
        }


    }