<?php
    namespace YewTree\Infrastructure\CategoryRepository\MyPdoCategoryRepository;


    use YewTree\Core\Contracts\ICategoryRepository;
    use YewTree\Infrastructure\Services\MyPDO;

    class MyPdoCategoryRepository implements ICategoryRepository
    {
        public $link;

        public function __construct(MyPDO $link)
        {
            $this->link = $link;
        }

        public function getAllCategories()
        {
            $sql = "SELECT * FROM categories";
            return $this->link->query($sql)->fetchAll();
        }

        public function getCategoryById($id)
        {
            $sql = " SELECT * FROM categories WHERE id = :id";
            return $this->link->query($sql)->bind(':id', $id)->fetchRow();
        }

        public function getCategoryByName($name)
        {
            // TODO: Implement getCategoryByName() method.
        }

        public function addCategory()
        {
            // TODO: Implement addCategory() method.
        }

        public function updateCategory($id)
        {
            $table = "categories";

            $category    = filter_input(INPUT_POST, 'category',  FILTER_SANITIZE_STRING);
            $lastUpdated = date("Y-m-d H:i:s");

            $columns = array (
                "lastUpdated" => $lastUpdated,
                "category"    => $category
            );

            $where = "id = '$id'";

            return $this->link->update($table, $columns, $where);
        }

        public function removeCategory($id)
        {
            // TODO: Implement removeCategory() method.
        }

    }