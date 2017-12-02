<?php
    namespace YewTree\Infrastructure\ProductRepository\FakeProductRespository;

    use YewTree\Core\Contracts\IProductRepository;
    use YewTree\Core\Model\Product;

    class FakeProductRespository implements IProductRepository
    {
        private $productList;

        public function __construct()
        {
            $this->productList = array();

            $this->productList[] = new Product(1, 'Cup', 12.99, '2017-11-28 00:00:00', 'Cup.jpg', null);
            $this->productList[] = new Product(2, 'Mug', 15.99, '2017-11-28 00:00:00', 'Mug.jpg', null);
            $this->productList[] = new Product(3, 'Bowl', 18.99, '2017-11-28 00:00:00', 'Bowl.jpg', null);
        }

        public function getAllProducts()
        {
            return $this->productList;
        }

        public function getProductById($id)
        {
            return $this->productList[$id];
        }

        public function getProductByName($name)
        {
            // TODO: Implement getProductByName() method.
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
            // TODO: Implement addProduct() method.
        }

        public function updateProduct($id)
        {
            // TODO: Implement updateProduct() method.
        }

        public function disableProduct($id)
        {
            // TODO: Implement disableProduct() method.
        }

        public function enableProduct($id)
        {
            // TODO: Implement enableProduct() method.
        }


    }