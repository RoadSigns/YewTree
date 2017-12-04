<?php

    namespace YewTree\Infrastructure\ProductRepository\MyPdoProductRepository;

        use YewTree\Core\Contracts\IProductRepository;
        use YewTree\Core\Services\FileUpload;
        use YewTree\Infrastructure\Services\MyPDO;
        use YewTree\Website\Controllers\CategoryController;
        use YewTree\Website\Helpers\Urlify;

        use YewTree\Core\Model\Product;
        use YewTree\Website\Services\FormValidator;

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
                $sql = " SELECT * FROM products WHERE uriName = :uriName AND disabled = 0";
                $result = $this->link->query($sql)->bind(':uriName', $uriName)->fetchRow();

                if ($result) {
                    $categories = $this->getProductsCategories($result->id);
                    return new Product($result, $categories);
                } else {
                    return false;
                }
            }


            /**
             * @return bool
             */
            public function addProduct()
            {
                $table = "products";

                $this->validateForms();
                $this->formVal->validate('name')->clean();
                $this->formVal->validate('price')->clean();
                $this->formVal->validate('description')->clean();

                $fields = $this->formVal->getFields();

                $postedDate  = date("Y-m-d H:i:s");
                $lastUpdated = date("Y-m-d H:i:s");
                $uriName     = Urlify::urlify($fields['name']);

                $columns = array (
                    "id"          => "",
                    "name"        => $fields['name'],
                    "price"       => $fields['price'],
                    "description" => $fields['description'],
                    "postedDate"  => $postedDate,
                    "lastUpdated" => $lastUpdated,
                    "uriName"     => $uriName
                );

                if ($_FILES['thumbnail']['name'] != '') {
                    $thumbnailInformation = $this->uploadImage();
                    $thumbnail = $thumbnailInformation['filename'];
                    $columns["thumbnail"] = $thumbnail;
                }

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

                $this->validateForms();
                $this->formVal->validate('name')->clean();
                $this->formVal->validate('price')->clean();
                $this->formVal->validate('description')->clean();

                $fields = $this->formVal->getFields();

                $lastUpdated = date("Y-m-d H:i:s");
                $uriName     = Urlify::urlify($fields['name']);

                $columns = array (
                    "name"        => $fields['name'],
                    "price"       => $fields['price'],
                    "description" => $fields['description'],
                    "lastUpdated" => $lastUpdated,
                    "uriName"     => $uriName
                );


                if ($_FILES['thumbnail']['name'] != '') {
                    $thumbnailInformation = $this->uploadImage();
                    $thumbnail = $thumbnailInformation['filename'];
                    $columns["thumbnail"] = $thumbnail;
                }

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
                $sql = "SELECT categories.category
                        FROM  `products` 
                        LEFT JOIN  `products_categories` ON products.id = products_categories.productID
                        LEFT JOIN `categories` ON categories.id = products_categories.categoryID
                        WHERE products.id = ". $productId ." AND disabled = 0";

                return $this->link->query($sql)->fetchAll();
            }

            public function getLastUpdated($limit = 4)
            {
                $sql = "SELECT * 
                        FROM  `products` 
                        WHERE disabled = 0
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
                        WHERE categories.category = '$category' AND disabled = 0";

                $result = $this->link->query($sql)->fetchAll();

                if ($result) {
                    foreach ($result as $product) {
                        $categories = $this->getProductsCategories($product->id);
                        $products[] = new Product($product, $categories);
                    }

                    return $products;
                } else {
                    return false;
                }
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

            public function validateForms()
            {
                $this->formVal = new FormValidator();
                $this->formVal->setMethod('POST');
                $this->formVal->registerFields();
            }
            public function uploadImage()
            {
                $fileUpload = new FileUpload('thumbnail');
                $fileUpload->targetPath = $_SERVER['DOCUMENT_ROOT'] ."/webstudent/sem6zl/yewtree/Website/Images/";

                if ($fileUpload->validate()) {
                    return $fileUpload->process();
                } else {
                    return $fileUpload->getError();
                }
            }


        }