<?php
namespace YewTree\Website\Controllers;

use YewTree\Core\Contracts\IProductRepository;

class HomeController
{
    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function showView()
    {
        $products = $this->productRepository->getAllProducts();
        require_once ('Website/Views/home.php');
    }

}