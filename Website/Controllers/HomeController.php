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
        $lastUpdatedProducts = $this->productRepository->getLastUpdated();
        $electronicProducts  = $this->productRepository->getProductsByCategory('Electronics');
        $fruitProducts       = $this->productRepository->getProductsByCategory('Fruit');
        require_once ('Website/Views/home.php');
    }

}