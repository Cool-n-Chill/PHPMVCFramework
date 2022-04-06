<?php


namespace app\models;


class Category extends AppModel
{

    private static $category;
    private static $categoryAndChildrenIDs;

    public static function getCategoryProducts($alias)
    {
        self::setCategory($alias);
        self::setCategoryAndChildrenIDs();
        $categoryIDs = implode(',', self::$categoryAndChildrenIDs);
        return \R::find('product', "category_id IN ($categoryIDs)");
    }

    private static function setCategory($alias)
    {
        self::$category = self::getCategory($alias);
    }

    private static function getCategory($alias)
    {
//        return \R::findOne('category', 'alias = ?', [$alias]) ?? throw new \Exception("Category $alias not found", 404);
        if (\R::findOne('category', 'alias = ?', [$alias])) {
            return \R::findOne('category', 'alias = ?', [$alias]);
        } else {
            throw new \Exception("Category $alias not found", 404);
        }
    }

    private static function setCategoryAndChildrenIDs()
    {
        self::$categoryAndChildrenIDs = self::getCategoryAndChildrenIDs(self::$category->id);
    }

    private static function getCategoryAndChildrenIDs($categoryID)
    {
        $categoryAndChildrenIDs = self::getIDChildrenOfCategory($categoryID);
        $categoryAndChildrenIDs[] = $categoryID;
        return $categoryAndChildrenIDs;
    }

    private static function getIDChildrenOfCategory($categoryID)
    {
        $allChildrenCategories = self::getAllChildrenCategories();
        static $listOfCategoriesIDs;
        foreach ($allChildrenCategories as $category){
            if ($category->parent_id == $categoryID) {
                $listOfCategoriesIDs[] = $category->id;
                self::getIDChildrenOfCategory($category->id);
            }
        }
        return $listOfCategoriesIDs;
    }

    private static function getAllChildrenCategories()
    {
        return \R::find('category', "parent_id != '0'");
    }

}