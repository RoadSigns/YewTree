<?php

    namespace YewTree\Website\Controllers;

    use YewTree\Core\Contracts\IProductRepository;

    class AdministrationController
    {
        public function __construct(IProductRepository $productRepository)
        {
            $this->productRepository = $productRepository;
        }

        public function showView()
        {
            $products = $this->productRepository->getAllProducts();
            require_once('Website/Views/Administration/index.php');
        }

        public function postView()
        {
            $this->productRepository;
        }

        public function getCreate()
        {
            require_once('Website/Views/Administration/create.php');
        }

        public function postCreate()
        {
            $result = $this->productRepository->addProduct();
            dumpr($result);
            ($result)
                ? header('Location: '. BASEPATH . '/admin/')
                : header('Location: '. BASEPATH . '/admin/create/');
            exit();
        }

        public function getEdit($uriName)
        {
            $product = $this->productRepository->getProductByName($uriName);
            ($product)
                ? require_once('Website/Views/Administration/edit.php')
                : header('Location: ' . BASEPATH . '/admin/');

        }

        public function postEdit($id)
        {
            $this->productRepository->updateProduct();

        }

        public function getDisable()
        {
            require_once('Website/Views/Administration/disable.php');
        }

        public function postDisable()
        {

        }
    }