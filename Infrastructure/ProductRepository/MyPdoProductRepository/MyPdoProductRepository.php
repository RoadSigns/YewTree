<?php

    namespace YewTree\Infrastructure\ProductRepository\MyPdoProductRepository;

        use YewTree\Core\Contracts\IProductRepository;
        use YewTree\Website\Helpers\Urlify;

        class MyPdoProductRepository implements IProductRepository
        {
            private $link;
            public function __construct(MyPDO $link)
            {
                $this->link = $link;
            }

            public function getAllProducts()
            {
                $sql = "SELECT * FROM products";
                return $this->link->query($sql)->fetchAll();
            }

            public function getProductById($id)
            {
                $sql = " SELECT * FROM  products WHERE id = :id";
                return $this->link->query($sql)->bind(':id', $id)->fetchRow();
            }

            public function getProductByName($uriName)
            {
                $sql = " SELECT * FROM products WHERE uriName = :uriName";
                return $this->link->query($sql)->bind(':uriName', $uriName)->fetchRow();
            }


            public function getProductsByCategory($category)
            {
                // TODO: Implement getProductsByCategory() method.
            }

            public function addProduct()
            {
                $table = "products";

                $name       = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                $price      = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $postedDate = date("Y-m-d H:i:s");
                $uriName    = Urlify::urlify($name);
                $thumbnail  = $name . '.jpg';

                $columns = array (
                    "id"         => "",
                    "name"       => $name,
                    "price"      => $price,
                    "postedDate" => $postedDate,
                    "thumbnail"  => $thumbnail,
                    "uriName"    => $uriName
                );
                return $this->link->insert($table, $columns);
            }

            public function updateProduct()
            {

            }

            public function disableProduct($id)
            {
                // TODO: Implement disableProduct() method.
            }


        }