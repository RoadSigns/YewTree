<?php

namespace YewTree\Website\Controllers;

use YewTree\Core\Contracts\IProductRepository;

class CategoryController
{
    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function showView()
    {
        $products = $this->productRepository->getAllProducts();

        dumpr($products);
    }
}