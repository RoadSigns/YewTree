<?php
namespace YewTree\Website\Controllers;

use YewTree\Core\Contracts\IProductRepository;


class ProductController
{
    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function showView($id = '')
    {
        ($id == '')
         ? $products = $this->productRepository->getAllProducts()
         : $products = $this->productRepository->getProductById($id);

        dumpr($products);
    }
}