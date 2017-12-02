<?php
    namespace YewTree\Infrastructure\ProductRepository\MyPdoProductRepository;


    use YewTree\Core\Contracts\ICategoryRepository;
    use YewTree\Infrastructure\CategoryRepository\MyPdoCategoryRepository\MyPDO;

    class MyPdoCategoryRepository implements ICategoryRepository
    {
        public $link;

        public function __construct(MyPDO $link)
        {
            $this->link = $link;
        }

        public function getAllCategories()
        {
            // TODO: Implement getAllCategories() method.
        }

        public function getCategoryById()
        {
            // TODO: Implement getCategoryById() method.
        }

        public function getCategoryByName()
        {
            // TODO: Implement getCategoryByName() method.
        }

        public function addCategory()
        {
            // TODO: Implement addCategory() method.
        }

        public function updateCategory()
        {
            // TODO: Implement updateCategory() method.
        }

        public function removeCategory()
        {
            // TODO: Implement removeCategory() method.
        }

    }