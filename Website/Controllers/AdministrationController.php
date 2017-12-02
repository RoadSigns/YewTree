<?php

    namespace YewTree\Website\Controllers;

    use YewTree\Core\Contracts\ICategoryRepository;
    use YewTree\Core\Contracts\IProductRepository;

    class AdministrationController
    {
        private $productRepository;
        private $categoryRepository;

        public function __construct(IProductRepository $productRepository, ICategoryRepository $categoryRepository)
        {
            $this->productRepository  = $productRepository;
            $this->categoryRepository = $categoryRepository;
        }

        public function showView()
        {
            $products   = $this->productRepository->getAllProducts();
            $categories = $this->categoryRepository->getAllCategories();

            require_once('Website/Views/Administration/index.php');
        }

        public function postView()
        {
            $this->productRepository;
        }
    }