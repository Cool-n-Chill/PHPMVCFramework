<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;

class CategoryController extends AppController
{

    private $alias;

    public function viewAction()
    {
        $this->setAlias();
        $this->setMeta();
        $this->setData($this->setVariables());
    }

    private function setAlias()
    {
        $this->alias = $this->route['alias'];
    }

    private function setVariables()
    {
        $products = Category::getCategoryProducts($this->alias);
        $breadcrumbs = Breadcrumbs::getBreadcrumbs(Category::$category->id);
        return compact('products', 'breadcrumbs');
    }

}