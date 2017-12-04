<?php
namespace YewTree\Website\Controllers;

use YewTree\Core\Contracts\ICategoryRepository;
use YewTree\Core\Contracts\IProductRepository;


class ProductController
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

    public function showView($uriName)
    {
        $product = $this->productRepository->getProductByName($uriName);
        ($product)
            ? require_once ('Website/Views/Products/product.php')
            : header('Location: '. BASEPATH. '/products/');
    }

    public function showList()
    {
        $products   = $this->productRepository->getAllNonDisabledProducts();
        $categories = $this->categoryRepository->getAllCategories();
        require_once('Website/Views/Products/index.php');
    }
}