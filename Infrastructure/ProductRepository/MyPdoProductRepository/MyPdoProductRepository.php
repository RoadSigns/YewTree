<?php

    namespace YewTree\Infrastructure\ProductRepository\MyPdoProductRepository;

        use YewTree\Core\Contracts\IProductRepository;

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
                $sql = " SELECT * FROM  products WHERE uriName = :uriName";
                return $this->link->query($sql)->bind(':uriName', $uriName)->fetchRow();
            }


            public function getProductsByCategory($category)
            {
                // TODO: Implement getProductsByCategory() method.
            }

            public function getProductUser()
            {
                // TODO: Implement getProductUser() method.
            }

            public function addProduct()
            {
                $table = "products";
                $columns = array (
                    "id"         => "",
                    "name"       => "Test",
                    "price"      => "4.50",
                    "postedDate" => "2017-11-30 00:00:00",
                    "thumbnail"  => "test.gif"
                );
                return $this->link->insert($table, $columns);
            }

            public function disableProduct($id)
            {
                // TODO: Implement disableProduct() method.
            }


        }