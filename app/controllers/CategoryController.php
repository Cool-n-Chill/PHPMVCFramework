<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use app\Traits\TPaginationController;

class CategoryController extends AppController
{

    use TPaginationController;

    private $alias;
    private $totalProductInCategory;

    public function viewAction()
    {
        $this->setVariables();
        $this->setMeta();
        $this->setData($this->setViewVariables());
    }

    private function setVariables()
    {
        $this->alias = $this->route['alias'];
        $this->currentPageNumber = $this->getCurrentPageNumber();
        $this->totalProductInCategory;
    }

    private function setViewVariables()
    {
        $category = new Category($this->alias);
        $products = Category::getCategoryProducts($this->alias);
        $breadcrumbs = Breadcrumbs::getBreadcrumbs(Category::$category->id);
        $count = count($products);
        return compact('products', 'breadcrumbs', 'count');
    }

}