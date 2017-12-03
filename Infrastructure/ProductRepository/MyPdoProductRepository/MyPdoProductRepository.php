<?php

    namespace YewTree\Infrastructure\ProductRepository\MyPdoProductRepository;

        use YewTree\Core\Contracts\IProductRepository;
        use YewTree\Infrastructure\Services\MyPDO;
        use YewTree\Website\Controllers\CategoryController;
        use YewTree\Website\Helpers\Urlify;

        use YewTree\Core\Model\Product;

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

                $result = $this->link->query($sql)->fetchAll();

                foreach ($result as $product) {
                    $categories = $this->getProductsCategories($product->id);
                    $products[] = new Product($product, $categories);
                }

                return $products;

            }

            public function getAllNonDisabledProducts()
            {
                $sql = "SELECT * FROM products WHERE disabled = 0";

                $result = $this->link->query($sql)->fetchAll();

                foreach ($result as $product) {
                    $categories = $this->getProductsCategories($product->id);
                    $products[] = new Product($product, $categories);
                }

                return $products;
            }

            public function getAllDisabledProducts()
            {
                $sql = "SELECT * FROM products WHERE disabled = 1";
                return $this->link->query($sql)->fetchAll();
            }

            public function getProductById($id)
            {
                $sql        = " SELECT * FROM  products WHERE id = :id";
                $result     = $this->link->query($sql)->bind(':id', $id)->fetchRow();
                $categories = $this->getProductsCategories($result->id);

                return new Product($result, $categories);
            }

            public function getProductByName($uriName)
            {
                $sql = " SELECT * FROM products WHERE uriName = :uriName";
                $result = $this->link->query($sql)->bind(':uriName', $uriName)->fetchRow();

                $categories = $this->getProductsCategories($result->id);
                return new Product($result, $categories);
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

                $result = $this->link->insert($table, $columns);

                if (!$result) {
                    return false;
                }

                $productID = $this->link->insertID();
                $this->updateProductsCategories($productID);

                return true;
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

                $productResult  = $this->link->update($table, $columns, $where);
                $categoryResult = $this->updateProductsCategories($id);

                return ($productResult && $categoryResult);
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

            private function getProductsCategories($productId)
            {
                $sql = "SELECT products_categories.categoryID
                        FROM  `products` 
                        LEFT JOIN  `products_categories` ON products.id = products_categories.productID
                        WHERE products.id = ". $productId;

                return $this->link->query($sql)->fetchAll();
            }

            public function getLastUpdated($limit = 4)
            {
                $sql = "SELECT * 
                        FROM  `products` 
                        ORDER BY  `products`.`lastUpdated` DESC 
                        LIMIT 0 , $limit";

                $result = $this->link->query($sql)->fetchAll();

                foreach ($result as $product) {
                    $categories = $this->getProductsCategories($product->id);
                    $products[] = new Product($product, $categories);
                }

                return $products;
            }


            public function getProductsByCategory($category)
            {
                $sql = "SELECT products.id, products.name, products.price, products.description, products.lastUpdated, products.postedDate, products.thumbnail, products.uriName, products.disabled
                        FROM `products`
                        LEFT JOIN `products_categories` ON products.id = products_categories.productID
                        LEFT JOIN `categories` ON categories.id = products_categories.categoryID
                        WHERE categories.category = '$category'";

                $result = $this->link->query($sql)->fetchAll();

                foreach ($result as $product) {
                    $categories = $this->getProductsCategories($product->id);
                    $products[] = new Product($product, $categories);
                }

                return $products;
            }

            private function updateProductsCategories($productId)
            {
                $table = "products_categories";

                $this->deleteProductCategories($productId, $table);

                $categories = $_POST['categories'];

                foreach ($categories as $category) {
                    $columns = array (
                        "id" => "",
                        "productID"  => $productId,
                        "categoryID" => $category
                    );

                    $this->link->insert($table, $columns);
                }

            }

            private function deleteProductCategories($productId, $table)
            {
                $where  = "productID = $productId";
                return $this->link->delete($table,$where);
            }


        }