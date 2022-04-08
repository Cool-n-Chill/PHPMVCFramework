<?php


namespace app\models;


class Category extends AppModel
{

    private $category;
    private $categoryAndChildrenIDs;

    public function __construct($alias)
    {
        parent::__construct();
        $this->setCategory($alias);
        $this->setCategoryAndChildrenIDs();
    }

    public function getCategoryProductsQuantity()
    {
        $categoryIDs = implode(',', $this->categoryAndChildrenIDs);
        return \R::count('product', "category_id IN ($categoryIDs)");
    }

    public function getCategoryProductsPerPage($startAndPerPage)
    {
        extract($startAndPerPage);
        $categoryIDs = implode(',', $this->categoryAndChildrenIDs);
        return \R::find('product', "category_id IN ($categoryIDs) LIMIT $start, $perPage");
    }

    public function getCategory()
    {
        return $this->category;
    }

    private function setCategory($alias)
    {
        $this->category = $this->getCategoryFromDB($alias);
    }

    private function getCategoryFromDB($alias)
    {
        if (\R::findOne('category', 'alias = ?', [$alias])) {
            return \R::findOne('category', 'alias = ?', [$alias]);
        } else {
            throw new \Exception("Category $alias not found", 404);
        }
    }

    private function setCategoryAndChildrenIDs()
    {
        $this->categoryAndChildrenIDs = $this->getCategoryAndChildrenIDs($this->category->id);
    }

    private function getCategoryAndChildrenIDs($categoryID)
    {
        $categoryAndChildrenIDs = $this->getIDChildrenOfCategory($categoryID);
        $categoryAndChildrenIDs[] = $categoryID;
        return $categoryAndChildrenIDs;
    }

    private function getIDChildrenOfCategory($categoryID)
    {
        $allChildrenCategories = $this->getAllChildrenCategories();
        static $listOfCategoriesIDs;
        foreach ($allChildrenCategories as $category){
            if ($category->parent_id == $categoryID) {
                $listOfCategoriesIDs[] = $category->id;
                $this->getIDChildrenOfCategory($category->id);
            }
        }
        return $listOfCategoriesIDs;
    }

    private function getAllChildrenCategories()
    {
        return \R::find('category', "parent_id != '0'");
    }

}