<?php
    namespace YewTree\Website\Controllers;

    use YewTree\Core\Contracts\ICategoryRepository;
    use YewTree\Core\Contracts\IProductRepository;

    class AdministrationProductController
    {
        private $productRepository;
        private $categoryRepository;

        public function __construct(
            IProductRepository  $productRepository,
            ICategoryRepository $categoryRepository
        )
        {
            $this->productRepository  = $productRepository;
            $this->categoryRepository = $categoryRepository;
        }

        public function getCreate()
        {
            $categories = $this->categoryRepository->getAllCategories();
            require_once('Website/Views/Administration/Products/create.php');
        }

        public function postCreate()
        {
            $result = $this->productRepository->addProduct();
            ($result)
                ? header('Location: '. BASEPATH . '/admin/')
                : header('Location: '. BASEPATH . '/admin/products/create/');
            exit();
        }

        public function getEdit($id)
        {
            $product    = $this->productRepository->getProductById($id);
            $categories = $this->categoryRepository->getAllCategories();

            ($product && $categories)
                ? require_once('Website/Views/Administration/Products/edit.php')
                : header('Location: ' . BASEPATH . '/admin/products/');

        }

        public function postEdit($id)
        {
            $this->productRepository->updateProduct($id);

            header('Location: '. BASEPATH . '/admin/');
            exit();
        }

        public function getDisable($id)
        {
            $this->productRepository->disableProduct($id);

            header('Location: '. BASEPATH . '/admin/');
            exit();
        }

        public function getEnable($id)
        {
            $this->productRepository->enableProduct($id);

            header('Location: '. BASEPATH . '/admin/');
            exit();
        }
    }