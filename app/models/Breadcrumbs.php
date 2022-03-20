<?php


namespace app\models;


class Breadcrumbs
{
    private static $categories;
    private static $categories_chain;

    public static function getBreadcrumbs($category_id, $title)
    {
        self::getAllCategories();
        self::getBreadcrumbsParts(self::$categories, $category_id);
        return self::$categories_chain;
    }

    private static function getAllCategories()
    {
        self::$categories = \R::getAssoc('SELECT * FROM category');
    }

    private static function getBreadcrumbsParts($categories, $category_id)
    {
        if (!$category_id) return false;
        return self::findAllParentCategories($categories, $category_id);
    }

    private static function findAllParentCategories($categories, $category_id)
    {
        static $categories_chain = [];
        if ($categories[$category_id]['parent_id'] != 0){
            $categories_chain[] = $categories[$category_id]['title'];
            self::findAllParentCategories($categories, $categories[$category_id]['parent_id']);
        } else {
            $categories_chain[] = $categories[$category_id]['title'];
            self::$categories_chain = array_reverse($categories_chain);
        }
    }
}