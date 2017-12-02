<?php
    namespace YewTree\Website\Controllers;

    use YewTree\Core\Contracts\ICategoryRepository;
    use YewTree\Core\Contracts\IProductRepository;

    class AdministrationCategoryController
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
            require_once('Website/Views/Administration/Categories/create.php');
        }

        public function postCreate()
        {
            $result = $this->categoryRepository->addCategory();
            ($result)
                ? header('Location: '. BASEPATH . '/admin/')
                : header('Location: '. BASEPATH . '/admin/category/create/');
            exit();
        }

        public function getEdit($id)
        {
            $category = $this->categoryRepository->getCategoryById($id);
            ($category)
                ? require_once('Website/Views/Administration/Categories/edit.php')
                : header('Location: ' . BASEPATH . '/admin/');

        }

        public function postEdit($id)
        {
            $this->categoryRepository->updateCategory($id);

            header('Location: '. BASEPATH . '/admin/');
            exit();
        }
    }