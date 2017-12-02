<?php

    namespace YewTree\Infrastructure\ProductRepository\MyPdoProductRepository;

        use YewTree\Core\Contracts\IProductRepository;
        use YewTree\Infrastructure\Services\MyPDO;
        use YewTree\Website\Controllers\CategoryController;
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

            public function getAllNonDisabledProducts()
            {
                $sql = "SELECT * FROM products WHERE disabled = 0";
                return $this->link->query($sql)->fetchAll();
            }

            public function getAllDisabledProducts()
            {
                $sql = "SELECT * FROM products WHERE disabled = 1";
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


            /**
             * @return bool
             */
            public function addProduct()
            {
                $table = "products";

                $name        = filter_input(INPUT_POST, 'name',  FILTER_SANITIZE_STRING);
                $price       = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $postedDate  = date("Y-m-d H:i:s");
                $lastUpdated = date("Y-m-d H:i:s");
                $uriName     = Urlify::urlify($name);
                $thumbnail   = $name . '.jpg';

                $columns = array (
                    "id"          => "",
                    "name"        => $name,
                    "price"       => $price,
                    "postedDate"  => $postedDate,
                    "lastUpdated" => $lastUpdated,
                    "thumbnail"   => $thumbnail,
                    "uriName"     => $uriName
                );
                return $this->link->insert($table, $columns);
            }

            /**
             * @return bool
             */
            public function updateProduct($id)
            {
                $table = "products";

                $name        = filter_input(INPUT_POST, 'name',  FILTER_SANITIZE_STRING);
                $price       = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $lastUpdated = date("Y-m-d H:i:s");
                $uriName     = Urlify::urlify($name);
                $thumbnail   = $name . '.jpg';

                $columns = array (
                    "name"        => $name,
                    "price"       => $price,
                    "lastUpdated" => $lastUpdated,
                    "uriName"     => $uriName,
                    "thumbnail"   => $thumbnail
                );

                $where = "id = '$id'";

                return $this->link->update($table, $columns, $where);
            }

            public function disableProduct($id)
            {
                $table = "products";

                $lastUpdated = date("Y-m-d H:i:s");

                $columns = array (
                    "lastUpdated" => $lastUpdated,
                    "disabled"    => 1
                );

                $where = "id = '$id'";

                return $this->link->update($table, $columns, $where);
            }

            public function enableProduct($id)
            {
                $table = "products";

                $lastUpdated = date("Y-m-d H:i:s");

                $columns = array (
                    "lastUpdated" => $lastUpdated,
                    "disabled"    => 0
                );

                $where = "id = '$id'";

                return $this->link->update($table, $columns, $where);
            }


        }