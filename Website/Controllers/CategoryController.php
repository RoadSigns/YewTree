<?php

    namespace YewTree\Website\Controllers;

    use YewTree\Core\Contracts\ICategoryRepository;
    use YewTree\Core\Contracts\IProductRepository;

    class CategoryController
    {
        private $productRepository;
        private $categoryRepository;

        /**
         * CategoryController constructor.
         * @param IProductRepository  $productRepository
         * @param ICategoryRepository $categoryRepository
         */
        public function __construct(
            IProductRepository $productRepository,
            ICategoryRepository $categoryRepository
        )
        {
            $this->productRepository  = $productRepository;
            $this->categoryRepository = $categoryRepository;
        }


        public function showView($category)
        {
            $categories = $this->categoryRepository->getAllCategories();
            $products = $this->productRepository->getProductsByCategory($category);

            require('Website/Views/Categories/category.php');

        }

        public function showList()
        {
            $categories = $this->categoryRepository->getAllCategories();
            require('Website/Views/Categories/index.php');

        }
    }