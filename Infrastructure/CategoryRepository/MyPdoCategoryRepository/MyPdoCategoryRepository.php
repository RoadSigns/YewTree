<?php
    namespace YewTree\Infrastructure\CategoryRepository\MyPdoCategoryRepository;


    use YewTree\Core\Contracts\ICategoryRepository;
    use YewTree\Infrastructure\Services\MyPDO;
    use YewTree\Website\Helpers\Urlify;

    class MyPdoCategoryRepository implements ICategoryRepository
    {
        public $link;

        public function __construct(MyPDO $link)
        {
            $this->link = $link;
        }

        public function getAllCategories()
        {
            $sql = "SELECT categories.id, categories.category, count(products_categories.productID) as count FROM `categories`
                    LEFT JOIN `products_categories` ON categories.id = products_categories.categoryID
                    GROUP BY categories.id";

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
            $table = "categories";

            $category    = filter_input(INPUT_POST, 'category',  FILTER_SANITIZE_STRING);
            $lastUpdated = date("Y-m-d H:i:s");
            $uriName     = Urlify::urlify($category);

            $columns = array (
                "id"          => "",
                "category"    => $category,
                "lastUpdated" => $lastUpdated,
                "uriName"     => $uriName
            );
            return $this->link->insert($table, $columns);
        }

        public function updateCategory($id)
        {
            $table = "categories";

            $category    = filter_input(INPUT_POST, 'category',  FILTER_SANITIZE_STRING);
            $lastUpdated = date("Y-m-d H:i:s");
            $uriName     = Urlify::urlify($category);

            $columns = array (
                "lastUpdated" => $lastUpdated,
                "category"    => $category,
                "uriName"     => $uriName
            );

            $where = "id = '$id'";

            return $this->link->update($table, $columns, $where);
        }

        public function removeCategory($id)
        {
            // TODO: Implement removeCategory() method.
        }

    }